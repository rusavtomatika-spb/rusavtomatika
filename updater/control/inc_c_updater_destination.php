<?php
/**
 * Updater: приёмник обновлений (файлы + БД).
 * Кодировка файла: UTF-8.
 */

if (!defined('EXTRACT_TO_FOLDER'))      define('EXTRACT_TO_FOLDER', __DIR__ . "/../../");
if (!defined('FILENAME_ZIP_DIFF_FILES')) define('FILENAME_ZIP_DIFF_FILES', __DIR__ . "/../data/archive_difference_files.zip");
if (!defined('PATH_TO_DATA'))            define('PATH_TO_DATA', __DIR__ . "/../data/");
if (!defined('UPDATER_SETTINGS_FILE'))   define('UPDATER_SETTINGS_FILE', __DIR__ . "/../settings/settings.php");
if (!defined('UPDATER_DEBUG_LOGS'))      define('UPDATER_DEBUG_LOGS', false);

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

    private function fetch_url($url)
    {
        $url = trim((string)$url);
        if ($url === '') { return false; }

        if (ini_get('allow_url_fopen')) {
            $ctx = stream_context_create(array(
                'http' => array('timeout' => 300, 'follow_location' => 1),
                'ssl'  => array('verify_peer' => false, 'verify_peer_name' => false),
            ));
            $data = @file_get_contents($url, false, $ctx);
            if ($data !== false && strlen($data) > 0) { return $data; }
        }

        if (function_exists('curl_init')) {
            $ch = curl_init($url);
            curl_setopt_array($ch, array(
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_MAXREDIRS      => 5,
                CURLOPT_TIMEOUT        => 600,
                CURLOPT_CONNECTTIMEOUT => 20,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => 0,
            ));
            $data = curl_exec($ch);
            $code = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            if ($data !== false && strlen($data) > 0 && ($code === 0 || $code === 200)) { return $data; }
        }

        return false;
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
        $data = $this->fetch_url($link);
        if ($data === false) {
            return json_encode(array('reply' => 'fail_downloading_sql_backup', 'buffer' => 'Не удалось скачать: ' . $link));
        }
        $bytes_written = file_put_contents(PATH_TO_DATA . 'sql_dump.sql', $data, LOCK_EX);
        if (!$bytes_written) {
            return json_encode(array('reply' => 'fail_downloading_sql_backup', 'buffer' => 'Не удалось записать sql_dump.sql'));
        }
        return json_encode(array(
            'reply'  => 'sql_backup_is_downloaded',
            'buffer' => number_format($bytes_written / 1024, 2, '.', ' ') . ' KB',
        ));
    }

    public function download_zip_from_source($link)
    {
        if (!$this->ensure_data_dir()) {
            return json_encode(array('reply' => 'fail_downloading_zip_file', 'buffer' => 'Нет папки ' . PATH_TO_DATA));
        }
        $data = $this->fetch_url($link);
        if ($data === false) {
            return json_encode(array('reply' => 'fail_downloading_zip_file', 'buffer' => 'Не удалось скачать: ' . $link));
        }
        $bytes_written = file_put_contents(FILENAME_ZIP_DIFF_FILES, $data, LOCK_EX);
        if (!$bytes_written) {
            return json_encode(array('reply' => 'fail_downloading_zip_file', 'buffer' => 'Не удалось записать архив'));
        }
        return json_encode(array(
            'reply'  => 'zip_file_is_downloaded',
            'buffer' => number_format($bytes_written / 1024, 2, '.', ' ') . ' KB',
        ));
    }

    public function extract_zip_list_of_files()
    {
        ob_start();

        if (!class_exists('ZipArchive')) {
            ob_end_clean();
            return json_encode(array('reply' => 'fail_extracting_zip_file', 'buffer' => 'Нет расширения PHP zip (ZipArchive)'));
        }
        if (!file_exists(FILENAME_ZIP_DIFF_FILES)) {
            ob_end_clean();
            return json_encode(array('reply' => 'fail_extracting_zip_file', 'buffer' => 'Архив не найден: ' . FILENAME_ZIP_DIFF_FILES));
        }

        $zip = new ZipArchive();
        if ($zip->open(FILENAME_ZIP_DIFF_FILES) !== true) {
            ob_end_clean();
            return json_encode(array('reply' => 'fail_extracting_zip_file', 'buffer' => 'Архив повреждён'));
        }

        $root = realpath(EXTRACT_TO_FOLDER);
        $extracted = 0;
        $skipped = array();

        for ($i = 0; $i < $zip->numFiles; $i++) {
            $name = $zip->getNameIndex($i);
            if ($name === false || substr($name, -1) === '/') { continue; }

            /* защита от выхода за пределы корня и от служебных файлов */
            $clean = str_replace('\\', '/', $name);
            if (strpos($clean, '..') !== false || strpos($clean, "\0") !== false) {
                $skipped[] = $name; continue;
            }
            $base = basename($clean);
            if ($base === 'dbcon.php' || $base === 'settings.php' || $base === '.htaccess') {
                $skipped[] = $name; continue;
            }

            $target = $root . '/' . ltrim($clean, '/');
            $dir = dirname($target);
            if (!is_dir($dir)) { @mkdir($dir, 0755, true); }

            $stream = $zip->getStream($name);
            if (!$stream) { $skipped[] = $name; continue; }
            $content = stream_get_contents($stream);
            fclose($stream);
            if (file_put_contents($target, $content, LOCK_EX) !== false) {
                $extracted++;
                echo htmlspecialchars($clean, ENT_QUOTES, 'UTF-8') . '<br>';
            } else {
                $skipped[] = $name;
            }
        }
        $zip->close();

        echo '<b>Распаковано файлов: ' . $extracted . '</b><br>';
        if (!empty($skipped)) {
            echo 'Пропущено: ' . htmlspecialchars(implode(', ', $skipped), ENT_QUOTES, 'UTF-8') . '<br>';
        }

        $buffer = ob_get_clean();
        return json_encode(array(
            'reply'  => $extracted > 0 ? 'zip_file_is_extracted' : 'fail_extracting_zip_file',
            'buffer' => $buffer,
        ), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    /* ------------------------------------------------------------------ */
    /* Список своих файлов                                                */
    /* ------------------------------------------------------------------ */

    public function create_dest_list_of_files()
    {
        $this->ensure_data_dir();

        $scanner = new c_processing_files();
        $scanner->find('/');

        $arr = array(
            'names'  => $scanner->a_fname,
            'dirs'   => $scanner->a_fdir,
            'hashes' => $scanner->a_hash_file,
        );

        if (count($arr['names']) === 0) {
            return json_encode(array('reply' => 'failing_creating_dest_list_of_files'));
        }

        $json = json_encode($arr, JSON_UNESCAPED_SLASHES);
        $ok = file_put_contents(PATH_TO_DATA . 'dest_list_of_files.txt', $json, LOCK_EX);

        if (UPDATER_DEBUG_LOGS) {
            file_put_contents(PATH_TO_DATA . 'dest_list_of_files_print.txt', print_r($arr, true));
        }

        if (!$ok) {
            return json_encode(array('reply' => 'failing_creating_dest_list_of_files'));
        }

        return json_encode(array(
            'reply' => 'dest_list_of_files_is_created',
            'files' => $arr,
        ), JSON_UNESCAPED_SLASHES);
    }
}

/* ---------------------------------------------------------------------- */
/* Сканер файлов                                                          */
/* ---------------------------------------------------------------------- */

if (!class_exists('c_processing_files')) {
    class c_processing_files
    {
        public $a_fname = array();
        public $a_fsize = array();
        public $a_fdir = array();
        public $a_hash_file = array();
        public $cofiles = 0;

        private $re_folders_exclude = "/^\/(backup|test|updater_source|admin|service|images|export|upl|import|cache|node_modules|\.git|_.+)(\/|$)/i";
        private $re_files_include   = "/\.(htaccess|js|json|css|php|html|xml|txt|jpg|png|svg|webp|gif|woff2|ttf|csv|zip)$/i";
        private $re_files_exclude   = "/(dbcon\.php|settings\.php)$/i";

        public function find($in_dir)
        {
            $in_dir = '/' . trim(str_replace('\\', '/', $in_dir), '/');
            if ($in_dir === '/') { $in_dir = ''; }

            $abs = rtrim($_SERVER['DOCUMENT_ROOT'], '/') . $in_dir;
            if (!is_dir($abs)) { return; }

            $dh = @opendir($abs);
            if (!$dh) { return; }

            while (($file = readdir($dh)) !== false) {
                if ($file === '.' || $file === '..') { continue; }

                $rel_dir  = ($in_dir === '') ? '/' : $in_dir . '/';
                $abs_path = $abs . '/' . $file;

                if (is_dir($abs_path)) {
                    if (!preg_match($this->re_folders_exclude, $rel_dir)) {
                        $this->find($rel_dir . $file);
                    }
                    continue;
                }

                if (!is_file($abs_path)) { continue; }
                if (!preg_match($this->re_files_include, $file)) { continue; }
                if (preg_match($this->re_files_exclude, $file)) { continue; }
                if (preg_match($this->re_folders_exclude, $rel_dir)) { continue; }

                $this->a_fname[]     = $file;
                $this->a_fsize[]     = filesize($abs_path);
                $this->a_hash_file[] = hash_file('md5', $abs_path);
                $this->a_fdir[]      = rtrim($rel_dir, '/');
                if ($this->a_fdir[count($this->a_fdir) - 1] === '') {
                    $this->a_fdir[count($this->a_fdir) - 1] = '/';
                }
                $this->cofiles++;

                if ($this->cofiles > 100000) { break; }
            }
            closedir($dh);
        }
    }
}