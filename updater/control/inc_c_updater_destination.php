<?php
if (!defined('EXTRACT_TO_FOLDER'))      define('EXTRACT_TO_FOLDER', __DIR__ . "/../../");
if (!defined('FILENAME_ZIP_DIFF_FILES')) define('FILENAME_ZIP_DIFF_FILES', __DIR__ . "/../data/archive_difference_files.zip");
if (!defined('PATH_TO_DATA'))            define('PATH_TO_DATA', __DIR__ . "/../data/");
if (!defined('UPDATER_SETTINGS_FILE'))   define('UPDATER_SETTINGS_FILE', __DIR__ . "/../settings/settings.php");
if (!defined('UPDATER_DEBUG_LOGS'))      define('UPDATER_DEBUG_LOGS', false);
require_once __DIR__ . '/inc_c_processing_files.php';

if (!function_exists('var_dump_pre')) {
    function var_dump_pre($value)
    {
        echo "<pre style='font-size:11px;color:red;max-width:1000px;overflow:scroll;padding:10px;'>";
        var_dump($value);
        echo "</pre>";
    }
}

class c_updater_destination
{
    /** @var mysqli|null */
    private $db = null;
    private $db_source = '';

    /* ------------------------------------------------------------------ */
    /* Настройки                                                          */
    /* ------------------------------------------------------------------ */

    private function settings_read()
    {
        if (!file_exists(UPDATER_SETTINGS_FILE)) {
            return array('settings' => array(
                'database_server' => array(
                    'database_host' => '', 'database_name' => '',
                    'database_user' => '', 'database_password' => '',
                ),
                'updater_password' => '',
            ));
        }
        $raw = file_get_contents(UPDATER_SETTINGS_FILE);
        $arr = json_decode($raw, true);
        if (!is_array($arr)) { $arr = array(); }
        if (!isset($arr['settings']) || !is_array($arr['settings'])) { $arr['settings'] = array(); }
        if (!isset($arr['settings']['database_server']) || !is_array($arr['settings']['database_server'])) {
            $arr['settings']['database_server'] = array();
        }
        foreach (array('database_host', 'database_name', 'database_user', 'database_password') as $k) {
            if (!isset($arr['settings']['database_server'][$k])) {
                $arr['settings']['database_server'][$k] = '';
            }
        }
        if (!isset($arr['settings']['updater_password'])) {
            $arr['settings']['updater_password'] = '';
        }
        return $arr;
    }

    private function settings_write($arr)
    {
        $dir = dirname(UPDATER_SETTINGS_FILE);
        if (!is_dir($dir)) { @mkdir($dir, 0755, true); }
        $json = json_encode($arr, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        return file_put_contents(UPDATER_SETTINGS_FILE, $json, LOCK_EX);
    }

    public function save_settings($settings)
    {
        $orig = $this->settings_read();
        $new  = is_array($settings) ? $settings : array();

        if (isset($new['database_server']) && is_array($new['database_server'])) {
            foreach (array('database_host', 'database_name', 'database_user', 'database_password') as $k) {
                if (isset($new['database_server'][$k])) {
                    $orig['settings']['database_server'][$k] = trim($new['database_server'][$k]);
                }
            }
        }

        if (!empty($new['updater_password_new'])) {
            $orig['settings']['updater_password'] = md5($new['updater_password_new']);
            /* пароль сменён — старая кука auth больше не валидна */
            setcookie('auth', '', time() - 3600, '/');
        }

        $this->settings_write($orig);
        return $this->read_settings();
    }

    public function read_settings()
    {
        $arr = $this->settings_read();
        return json_encode(array(
            'reply'    => 'take_settings',
            'settings' => $arr['settings'],
        ), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    /* ------------------------------------------------------------------ */
    /* Соединение с БД: settings → фолбэк на sc/dbcon.php                  */
    /* ------------------------------------------------------------------ */

    private function db_connect()
    {
        if ($this->db instanceof mysqli) { return $this->db; }

        @set_time_limit(0);
        @ini_set('memory_limit', '512M');

        $s    = $this->settings_read();
        $host = trim($s['settings']['database_server']['database_host']);
        $user = trim($s['settings']['database_server']['database_user']);
        $pass = (string)$s['settings']['database_server']['database_password'];
        $name = trim($s['settings']['database_server']['database_name']);

        if ($host !== '' && $user !== '' && $name !== '') {
            $port = 3306;
            if (strpos($host, ':') !== false) {
                list($host, $port) = explode(':', $host, 2);
                $port = (int)$port;
            }
            $db = @mysqli_connect($host, $user, $pass, $name, $port);
            if ($db) {
                $this->db = $db;
                $this->db_source = 'settings.php (' . $name . ')';
                return $this->db;
            }
            throw new Exception(
                'Не удалось подключиться по настройкам updater: ' . mysqli_connect_error()
                . ' [host=' . $host . ', db=' . $name . ', user=' . $user . ']'
            );
        }

        /* Настройки пустые — берём соединение сайта */
        $dbcon = $_SERVER['DOCUMENT_ROOT'] . '/sc/dbcon.php';
        if (!file_exists($dbcon)) {
            throw new Exception('Настройки БД в updater пусты, и не найден ' . $dbcon);
        }
        require_once $dbcon;
        if (!function_exists('database_connect')) {
            throw new Exception('В sc/dbcon.php нет функции database_connect()');
        }
        database_connect();

        if (empty($GLOBALS['mysqli_db']) || !($GLOBALS['mysqli_db'] instanceof mysqli)) {
            throw new Exception('sc/dbcon.php не создал соединение $mysqli_db');
        }

        $this->db = $GLOBALS['mysqli_db'];
        $res = mysqli_query($this->db, 'SELECT DATABASE()');
        $row = $res ? mysqli_fetch_row($res) : array('');
        $this->db_source = 'sc/dbcon.php (' . $row[0] . ')';
        return $this->db;
    }

    private function q($sql, $error_label = '')
    {
        $r = mysqli_query($this->db, $sql);
        if ($r === false) {
            throw new Exception(
                ($error_label !== '' ? $error_label . ': ' : '')
                . mysqli_error($this->db) . "\nSQL: " . mb_substr($sql, 0, 400, 'UTF-8')
            );
        }
        return $r;
    }

    /* ------------------------------------------------------------------ */
    /* Обновление БД                                                      */
    /* ------------------------------------------------------------------ */

    public function update_database()
    {
        ob_start();
        $dump_file = PATH_TO_DATA . 'sql_dump.sql';

        try {
            $db = $this->db_connect();
            echo 'Соединение: ' . $this->db_source . "<br>";

            if (!file_exists($dump_file)) {
                throw new Exception('Файл дампа не найден: ' . $dump_file . '. Сначала скачайте бэкап с источника.');
            }

            /* Дамп с источника в cp1251 — импортируем в той же кодировке */
            mysqli_set_charset($db, 'cp1251');

            $dump = file_get_contents($dump_file);
            $dump = str_replace(array("\r\n", "\n", "\r"), '', $dump);
            echo 'Размер дампа: ' . number_format(strlen($dump) / 1024, 2, '.', ' ') . ' KB<br>';

            $pieces = explode(';nYn;', $dump);
            $done = 0;
            foreach ($pieces as $piece) {
                $piece = trim($piece);
                if ($piece === '') { continue; }
                $this->q($piece . ';', 'Ошибка импорта запроса #' . ($done + 1));
                $done++;
            }
            echo 'Выполнено запросов: ' . $done . '<br>';

            /* Список временных таблиц */
            $tmp_tables = array();
            $r = $this->q("SHOW TABLES LIKE '%\_temp'", 'SHOW TABLES');
            while ($row = mysqli_fetch_row($r)) { $tmp_tables[] = $row[0]; }
            mysqli_free_result($r);

            if (count($tmp_tables) === 0) {
                throw new Exception('В дампе не найдено ни одной таблицы *_temp — импорт не выполнен.');
            }

            $preserve_stock = array('products_all', 'controllers');
            $stock_fields = array(
                'onstock', 'onstock_spb', 'onstock_msk', 'onstock_kiv', 'onstock_ptg',
                'res_onstock_spb', 'res_onstock_msk', 'res_onstock_kiv', 'res_onstock_ptg',
            );

            echo '<p>Обработанные таблицы:</p><p style="text-align:left;">';
            $counter = 0;

            foreach ($tmp_tables as $tmp) {
                $original = preg_replace('/_temp$/', '', $tmp);
                $counter++;
                echo htmlspecialchars($original, ENT_QUOTES, 'UTF-8') . ', ';

                $exists = mysqli_num_rows($this->q("SHOW TABLES LIKE '" . mysqli_real_escape_string($db, $original) . "'")) > 0;

                /* Сохраняем остатки/складские поля из текущей таблицы */
                if ($exists && in_array($original, $preserve_stock, true)) {
                    $cols_res = $this->q("SHOW COLUMNS FROM `{$original}`");
                    $cols = array();
                    while ($c = mysqli_fetch_assoc($cols_res)) { $cols[$c['Field']] = true; }
                    mysqli_free_result($cols_res);

                    $use_fields = array();
                    foreach ($stock_fields as $f) { if (isset($cols[$f])) { $use_fields[] = $f; } }

                    if (!empty($use_fields) && isset($cols['model'])) {
                        $sel = '`model`';
                        foreach ($use_fields as $f) { $sel .= ', `' . $f . '`'; }
                        $res = $this->q("SELECT {$sel} FROM `{$original}`", 'Чтение остатков');

                        $updated = 0; $missing = 0;
                        while ($ro = mysqli_fetch_assoc($res)) {
                            $model = mysqli_real_escape_string($db, $ro['model']);
                            $check = $this->q("SELECT 1 FROM `{$tmp}` WHERE `model`='{$model}' LIMIT 1");
                            $found = mysqli_num_rows($check);
                            mysqli_free_result($check);

                            if ($found === 0) {
                                $missing++;
                                continue;
                            }
                            $set = array();
                            foreach ($use_fields as $f) {
                                $v = $ro[$f];
                                $set[] = "`{$f}`=" . (($v === null || $v === '') ? '0' : (int)$v);
                            }
                            $this->q(
                                "UPDATE `{$tmp}` SET " . implode(', ', $set) . " WHERE `model`='{$model}'",
                                'Перенос остатков'
                            );
                            $updated++;
                        }
                        mysqli_free_result($res);
                        echo '<br><small>' . htmlspecialchars($original, ENT_QUOTES, 'UTF-8')
                            . ': остатков перенесено ' . $updated
                            . ', нет в новом дампе ' . $missing . '</small><br>';
                    }
                }

                if ($exists) {
                    $this->q("DROP TABLE IF EXISTS `{$original}`", 'DROP старой таблицы');
                }
                $this->q("RENAME TABLE `{$tmp}` TO `{$original}`", 'RENAME временной таблицы');

                if ($original === 'products_all') {
                    $utf8_cols = array('temp', 'temp_storage', 'temp_operating', 'brightness', 'current');
                    $cols_res = $this->q("SHOW COLUMNS FROM `products_all`");
                    $have = array();
                    while ($c = mysqli_fetch_assoc($cols_res)) { $have[$c['Field']] = true; }
                    mysqli_free_result($cols_res);
                    foreach ($utf8_cols as $col) {
                        if (!isset($have[$col])) { continue; }
                        @mysqli_query($db, "ALTER TABLE `products_all` MODIFY `{$col}` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci");
                    }
                }
            }

            echo '</p><p>Всего таблиц: ' . $counter . '</p>';

            /* Возвращаем кодировку соединения сайта */
            mysqli_set_charset($db, 'utf8mb4');

            $log = $_SERVER['DOCUMENT_ROOT'] . '/error_log';
            if (file_exists($log) && is_readable($log)) {
                $tail = substr(file_get_contents($log), -4000);
                if (trim($tail) !== '') {
                    echo '<p>Последние записи error_log:</p><pre style="white-space:pre-wrap;font-size:11px">'
                        . htmlspecialchars($tail, ENT_QUOTES, 'UTF-8') . '</pre>';
                }
            }

            echo '<br>База данных обновлена.<br>';
            $buffer = ob_get_clean();

            return json_encode(array(
                'reply'  => 'database_is_updated',
                'buffer' => $buffer,
            ), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        } catch (Exception $e) {
            if ($this->db instanceof mysqli) { @mysqli_set_charset($this->db, 'utf8mb4'); }
            echo '<br><b style="color:#c00">Ошибка:</b> '
                . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . '<br>';
            $buffer = ob_get_clean();

            return json_encode(array(
                'reply'  => 'fail_updating_database',
                'buffer' => $buffer,
            ), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }
    }

    /* ------------------------------------------------------------------ */
    /* Загрузка файлов с источника                                        */
    /* ------------------------------------------------------------------ */

        /**
     * Качает URL сразу в файл, минуя память.
     * Возвращает array(байты|false, текст_ошибки)
     */
    private function fetch_url_to_file($url, $target)
    {
        $url = trim((string)$url);
        if ($url === '') { return array(false, 'Пустая ссылка'); }

        @set_time_limit(0);
        @ini_set('memory_limit', '512M');

        $dir = dirname($target);
        if (!is_dir($dir)) { @mkdir($dir, 0755, true); }

        /* curl — пишем потоком в файл */
        if (function_exists('curl_init')) {
            $fp = @fopen($target, 'wb');
            if (!$fp) { return array(false, 'Не открыть для записи: ' . $target); }

            $ch = curl_init($url);
            curl_setopt_array($ch, array(
                CURLOPT_FILE           => $fp,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_MAXREDIRS      => 5,
                CURLOPT_TIMEOUT        => 1800,
                CURLOPT_CONNECTTIMEOUT => 30,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_FAILONERROR    => true,
                CURLOPT_ENCODING       => '',
            ));
            $ok   = curl_exec($ch);
            $code = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $size = (int)curl_getinfo($ch, CURLINFO_SIZE_DOWNLOAD);
            $err  = curl_error($ch);
            curl_close($ch);
            fclose($fp);

            if ($ok && $size > 0) { return array($size, ''); }
            @unlink($target);
            return array(false, 'curl: HTTP ' . $code . ($err !== '' ? ' / ' . $err : ''));
        }

        /* фолбэк: потоки PHP */
        if (ini_get('allow_url_fopen')) {
            $ctx = stream_context_create(array(
                'http' => array('timeout' => 1800, 'follow_location' => 1),
                'ssl'  => array('verify_peer' => false, 'verify_peer_name' => false),
            ));
            $in = @fopen($url, 'rb', false, $ctx);
            if (!$in) { return array(false, 'Не открыть URL: ' . $url); }
            $out = @fopen($target, 'wb');
            if (!$out) { fclose($in); return array(false, 'Не открыть для записи: ' . $target); }
            $copied = stream_copy_to_stream($in, $out);
            fclose($in);
            fclose($out);
            if ($copied > 0) { return array($copied, ''); }
            @unlink($target);
            return array(false, 'Скачано 0 байт');
        }

        return array(false, 'На сервере нет ни curl, ни allow_url_fopen');
    }

    private function ensure_data_dir()
    {
        if (!is_dir(PATH_TO_DATA)) { @mkdir(PATH_TO_DATA, 0755, true); }
        return is_dir(PATH_TO_DATA);
    }

    public function download_sql_backup($link)
    {
        if (!$this->ensure_data_dir()) {
            return json_encode(array('reply' => 'fail_downloading_sql_backup', 'buffer' => 'Нет папки ' . PATH_TO_DATA));
        }

        $tmp  = PATH_TO_DATA . 'sql_dump.sql.part';
        $dest = PATH_TO_DATA . 'sql_dump.sql';

        list($bytes, $err) = $this->fetch_url_to_file($link, $tmp);
        if ($bytes === false || $bytes <= 0) {
            @unlink($tmp);
            return json_encode(array('reply' => 'fail_downloading_sql_backup', 'buffer' => $err), JSON_UNESCAPED_UNICODE);
        }

        $head = '';
        $fh = @fopen($tmp, 'rb');
        if ($fh) { $head = fread($fh, 200); fclose($fh); }
        if (stripos($head, '<html') !== false || stripos($head, '<!doctype') !== false) {
            @unlink($tmp);
            return json_encode(array('reply' => 'fail_downloading_sql_backup', 'buffer' => 'Вместо дампа пришёл HTML'), JSON_UNESCAPED_UNICODE);
        }

        if (!@rename($tmp, $dest)) {
            @unlink($tmp);
            return json_encode(array('reply' => 'fail_downloading_sql_backup', 'buffer' => 'Не удалось переименовать в ' . $dest));
        }

        return json_encode(array(
            'reply'  => 'sql_backup_is_downloaded',
            'buffer' => number_format($bytes / 1024, 2, '.', ' ') . ' KB',
        ));
    }

    public function download_zip_from_source($link)
    {
        if (!$this->ensure_data_dir()) {
            return json_encode(array('reply' => 'fail_downloading_zip_file', 'buffer' => 'Нет папки ' . PATH_TO_DATA));
        }

        $tmp = FILENAME_ZIP_DIFF_FILES . '.part';

        list($bytes, $err) = $this->fetch_url_to_file($link, $tmp);
        if ($bytes === false || $bytes <= 0) {
            @unlink($tmp);
            return json_encode(array('reply' => 'fail_downloading_zip_file', 'buffer' => $err), JSON_UNESCAPED_UNICODE);
        }

        /* проверяем сигнатуру ZIP — иначе сервер отдал страницу ошибки */
        $sig = '';
        $fh = @fopen($tmp, 'rb');
        if ($fh) { $sig = fread($fh, 2); fclose($fh); }
        if ($sig !== 'PK') {
            @unlink($tmp);
            return json_encode(array(
                'reply'  => 'fail_downloading_zip_file',
                'buffer' => 'Скачан не ZIP (сигнатура "' . htmlspecialchars($sig, ENT_QUOTES, 'UTF-8') . '", ' . $bytes . ' байт). Вероятно, сервер отдал HTML-ошибку.',
            ), JSON_UNESCAPED_UNICODE);
        }

        if (!@rename($tmp, FILENAME_ZIP_DIFF_FILES)) {
            @unlink($tmp);
            return json_encode(array('reply' => 'fail_downloading_zip_file', 'buffer' => 'Не удалось переименовать архив'));
        }

        return json_encode(array(
            'reply'  => 'zip_file_is_downloaded',
            'buffer' => number_format($bytes / 1024, 2, '.', ' ') . ' KB',
        ));
    }

        public function extract_zip_list_of_files($data = array())
    {
        @set_time_limit(0);
        @ini_set('memory_limit', '512M');

        if (!class_exists('ZipArchive')) {
            return json_encode(array('reply' => 'fail_extracting_zip_file', 'buffer' => 'Нет расширения PHP zip'));
        }
        if (!file_exists(FILENAME_ZIP_DIFF_FILES)) {
            return json_encode(array('reply' => 'fail_extracting_zip_file', 'buffer' => 'Архив не найден'));
        }

        $zip = new ZipArchive();
        if ($zip->open(FILENAME_ZIP_DIFF_FILES) !== true) {
            return json_encode(array('reply' => 'fail_extracting_zip_file', 'buffer' => 'Архив повреждён'));
        }

        $root = realpath(EXTRACT_TO_FOLDER);
        $total = $zip->numFiles;
        $chunk = defined('UPDATER_EXTRACT_CHUNK') ? (int)UPDATER_EXTRACT_CHUNK : 150;
        $offset = isset($data['offset']) ? (int)$data['offset'] : 0;
        if ($offset < 0) { $offset = 0; }

        $protect = array();
        if (defined('UPDATER_PROTECT_FILES')) {
            foreach (explode(',', strtolower(UPDATER_PROTECT_FILES)) as $p) {
                $p = trim($p);
                if ($p !== '') { $protect[] = $p; }
            }
        }

        $done = 0; $skipped = 0; $i = $offset; $end = min($offset + $chunk, $total);
        for (; $i < $end; $i++) {
            $name = $zip->getNameIndex($i);
            if ($name === false || substr($name, -1) === '/') { continue; }

            $clean = str_replace('\\', '/', $name);
            if (strpos($clean, '..') !== false || strpos($clean, "\0") !== false) { $skipped++; continue; }
            if (in_array(strtolower(basename($clean)), $protect, true)) { $skipped++; continue; }

            $target = $root . '/' . ltrim($clean, '/');
            $dir = dirname($target);
            if (!is_dir($dir)) { @mkdir($dir, 0755, true); }

            $stream = $zip->getStream($name);
            if (!$stream) { $skipped++; continue; }
            $content = stream_get_contents($stream);
            fclose($stream);

            if (file_put_contents($target, $content, LOCK_EX) !== false) { $done++; } else { $skipped++; }
        }
        $zip->close();

        if ($i < $total) {
            return json_encode(array(
                'reply'       => 'zip_file_is_extracted_partially',
                'next_offset' => $i,
                'done'        => $i,
                'total'       => $total,
            ));
        }

        return json_encode(array(
            'reply'  => 'zip_file_is_extracted',
            'buffer' => 'Распаковано файлов: ' . $done . ', пропущено: ' . $skipped,
            'done'   => $total,
            'total'  => $total,
        ), JSON_UNESCAPED_UNICODE);
    }

    public function create_dest_list_of_files($data = array())
    {
        @set_time_limit(0);
        $this->ensure_data_dir();

        $folder = (isset($data['folder_for_updating']) && $data['folder_for_updating'] !== '')
            ? $data['folder_for_updating'] : '/';

        $scanner = new c_processing_files();
        $scanner->find($folder);

        $arr = array(
            'names'  => $scanner->a_fname,
            'dirs'   => $scanner->a_fdir,
            'hashes' => $scanner->a_hash_file,
        );

        if (count($arr['names']) === 0) {
            return json_encode(array(
                'reply'  => 'failing_creating_dest_list_of_files',
                'buffer' => 'Сканер не нашёл файлов. Папка: ' . $folder,
            ), JSON_UNESCAPED_UNICODE);
        }

        $ok = file_put_contents(PATH_TO_DATA . 'dest_list_of_files.txt', json_encode($arr, JSON_UNESCAPED_SLASHES), LOCK_EX);
        if (!$ok) {
            return json_encode(array('reply' => 'failing_creating_dest_list_of_files', 'buffer' => 'Не удалось записать список'));
        }

        return json_encode(array(
            'reply'   => 'dest_list_of_files_is_created',
            'files'   => $arr,
            'counter' => count($arr['names']),
        ), JSON_UNESCAPED_SLASHES);
    }
}