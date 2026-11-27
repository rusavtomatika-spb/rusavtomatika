<?php
require_once 'inc_c_processing_files.php';
define('bullshit', 1);
require_once $_SERVER["DOCUMENT_ROOT"] . '/sc/dbcon.php';
global $db;
global $mysqli_db;
database_connect();


class c_updater_source
{
    public function get_current_step()
    {
        $out = ["current_step" => "1"];
        return json_encode($out);
    }

    public function take_dest_list_of_files($data)
    {
        if (!$result = file_exists(DATA_PATH)) {
            $result = mkdir(DATA_PATH);
        }

        $success = file_put_contents(FILENAME_DEST_LIST_OF_FILES, json_encode($data));
        //file_put_contents(PRINT_FILENAME_DEST_LIST_OF_FILES, print_r($data,true));

        if ($success > 0) {
            $out = ["reply" => 'dest_list_of_files_is_saved_on_source'];
        } else {
            $out = ["reply" => 'failing_saving_dest_list_of_files_on_source'];
        }
        return json_encode($out);
    }

        public function create_source_list_of_files($data)
    {
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
                'reply'  => 'failed_creating_source_list_of_files_on_source',
                'buffer' => 'Сканер не нашёл файлов. Проверь ограничители и папку: ' . $folder,
            ), JSON_UNESCAPED_UNICODE);
        }

        $ok = file_put_contents(FILENAME_SOURCE_LIST_OF_FILES, json_encode($arr, JSON_UNESCAPED_SLASHES), LOCK_EX);

        return json_encode(array(
            'reply'   => $ok ? 'source_list_of_files_is_created_on_source' : 'failed_creating_source_list_of_files_on_source',
            'counter' => count($arr['names']),
            'buffer'  => 'Файлов источника: ' . count($arr['names']) . ', пропущено по размеру: ' . $scanner->skipped_big,
        ), JSON_UNESCAPED_UNICODE);
    }

    public function create_difference_list_of_files()
    {
        if (!file_exists(FILENAME_SOURCE_LIST_OF_FILES) || !file_exists(FILENAME_DEST_LIST_OF_FILES)) {
            return json_encode(array('reply' => 'fail_creating_difference_list_of_files_on_source', 'buffer' => 'Нет списков файлов'));
        }

        $source = json_decode(file_get_contents(FILENAME_SOURCE_LIST_OF_FILES), true);
        $dest   = json_decode(file_get_contents(FILENAME_DEST_LIST_OF_FILES), true);
        if (!is_array($source) || !is_array($dest)) {
            return json_encode(array('reply' => 'fail_creating_difference_list_of_files_on_source', 'buffer' => 'Списки повреждены'));
        }

        /* быстрый индекс приёмника: путь => хеш */
        $dest_map = array();
        foreach ($dest['names'] as $k => $name) {
            $dest_map[$dest['dirs'][$k] . '/' . $name] = $dest['hashes'][$k];
        }

        $diff = array();
        foreach ($source['names'] as $k => $name) {
            $path = $source['dirs'][$k] . '/' . $name;
            $hash = $source['hashes'][$k];
            if (!isset($dest_map[$path]) || $dest_map[$path] !== $hash) {
                $diff[] = $path;
            }
        }

        $ok = file_put_contents(FILENAME_DIFFERENCE_LIST_OF_FILES, json_encode($diff, JSON_UNESCAPED_SLASHES), LOCK_EX);

        return json_encode(array(
            'reply'   => $ok ? 'difference_list_of_files_is_created_on_source' : 'fail_creating_difference_list_of_files_on_source',
            'counter' => count($diff),
            'data'    => '(Total files: ' . count($diff) . ')',
        ), JSON_UNESCAPED_UNICODE);
    }

    public function create_zip_list_of_files($data = array())
    {
        @set_time_limit(0);
        @ini_set('memory_limit', '512M');

        if (!file_exists(FILENAME_DIFFERENCE_LIST_OF_FILES)) {
            return json_encode(array('reply' => 'fail_creating_zip_file', 'buffer' => 'Нет списка отличий'));
        }
        $list = json_decode(file_get_contents(FILENAME_DIFFERENCE_LIST_OF_FILES), true);
        if (!is_array($list) || count($list) === 0) {
            return json_encode(array('reply' => 'fail_creating_zip_file', 'buffer' => 'Список отличий пуст'));
        }

        $total  = count($list);
        $chunk  = defined('UPDATER_ZIP_CHUNK') ? (int)UPDATER_ZIP_CHUNK : 300;
        $offset = isset($data['offset']) ? (int)$data['offset'] : 0;
        if ($offset < 0) { $offset = 0; }

        if (!is_dir(DATA_PATH)) { @mkdir(DATA_PATH, 0755, true); }

        $mode = ($offset === 0) ? (ZipArchive::CREATE | ZipArchive::OVERWRITE) : ZipArchive::CREATE;
        $zip = new ZipArchive();
        if ($zip->open(FILENAME_ZIP_DIFF_FILES, $mode) !== true) {
            return json_encode(array('reply' => 'fail_creating_zip_file', 'buffer' => 'Не удалось открыть архив'));
        }

        $added = 0;
        $end = min($offset + $chunk, $total);
        for ($i = $offset; $i < $end; $i++) {
            $rel = $list[$i];
            $abs = rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/' . ltrim(str_replace('\\', '/', $rel), '/');
            if (is_file($abs)) { $zip->addFile($abs, ltrim($rel, '/')); $added++; }
        }
        $zip->close();

        if ($end < $total) {
            return json_encode(array(
                'reply'       => 'zip_file_is_created_partially',
                'next_offset' => $end,
                'done'        => $end,
                'total'       => $total,
            ));
        }

        return json_encode(array(
            'reply' => 'zip_file_is_created_on_source',
            'data'  => array('link' => URL_FILENAME_ZIP_DIFF_FILES),
            'done'  => $total,
            'total' => $total,
        ));
    }

    public function update_database_create_sql_dump()
    {
        echo $this->export_database();
    }
    ///////////////////////////////////////////////////////
    ///
    ////
    ///

    private function export_database()
    {
        ob_start();
        global $mysqli_db;
        $db = $mysqli_db;
        $this->test_PATH_TO_EXPORT_BACKUPS();
/*        define('DUMP_FILE_NAME', PATH_TO_EXPORT_BACKUPS . date("d.m.Y[H-i-s]") . '_DBASE' . '.sql');
        define('URL_DUMP_FILE_NAME', URL_PATH_TO_EXPORT_BACKUPS_PATH . date("d.m.Y[H-i-s]") . '_DBASE' . '.sql');*/
        define('DUMP_FILE_NAME', PATH_TO_EXPORT_BACKUPS . 'SQL_DUMP_DBASE' . '.sql');
        define('URL_DUMP_FILE_NAME', URL_PATH_TO_EXPORT_BACKUPS_PATH . 'SQL_DUMP_DBASE' . '.sql');
        $count_tables = 0;
        $count_rows = 0;
        mysqli_query($db, "SET NAMES 'cp1251'");
        $OUT = '';
        $data = array();
        $ret = array();
        // @header("Content-Type: text/html; charset=windows-1251");
        $query = "SHOW TABLES";
        $r = mysqli_query($db, $query) or die(mysqli_error($db) . "<br>file: " . __FILE__ . "<br>line: " . __LINE__);
        if (mysqli_num_rows($r) > 0) {
//        $exclude_settings = "/orders|back|temp|w_sessions|20|sale/i";
            $exclude_settings = $this->get_tables_excludes();
            $counter = 0;
            while ($row = mysqli_fetch_row($r)) {
                $pos = strpos($exclude_settings, $row[0]);
//            if (!preg_match($exclude_settings, $row[0])) {
                if ($pos === FALSE) {
                    $counter++;
                    //echo $counter . ": " . $row[0] . " " . $row[1] . "<br>";
                    $ret[] = $row[0];
                    $co = count($row);
                    $count_tables++;
                } else {
                    //   echo "[" . $row[0] . "] - has been omitted due to settings!<br>";
                };
            }
        } else {
            // echo 'no tables to dump<br />';
        };
        while (list($key, $val) = each($ret)) {
            $OUT .= <<<EOD
DROP TABLE IF EXISTS `{$val}_temp`;nYn;
EOD;
            $string = "SHOW COLUMNS FROM `{$val}`;";
            $query = mysqli_query($db, $string) or die("error 2 in \"$string\"");

            if (mysqli_num_rows($query) > 0) {
                $colomns = '';
                $co = '';
                while ($row = mysqli_fetch_array($query)) {//MYSQL_NUM
                    if ($row[2] == 'NO') {
                        $ro2 = ' NOT NULL';
                    } else {
                        $ro2 = '';
                    };
                    if ($row[3] == 'PRI') {
                        $pri = 'PRIMARY KEY (`' . $row[0] . '`)';
                    };
                    if ($row[4] != '') {
                        $default = " DEFAULT '{$row[4]}'";
                    } else {
                        $default = '';
                    };
                    if ($row[5] != '') {
                        $auto = ' ' . $row[5];
                    } else {
                        $auto = '';
                    };
                    $colomns .= '`' . $row[0] . '` ' . $row[1] . $ro2 . $default . $auto . ',';

                    $co .= '`' . $row[0] . '`, ';
                }
                $co = substr($co, 0, -2);
                $OUT .= <<<EOD
CREATE TABLE IF NOT EXISTS `{$val}_temp` ({$colomns}{$pri}) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;nYn;
EOD;
            } else {
                // echo 'no colomns in ' . $val;
            };
            $rows = '';
            $query = mysqli_query($db, "SELECT * FROM `{$val}`");
            if (mysqli_num_rows($query) > 0) {
//            while ($row = mysqli_fetch_array($query, MYSQL_NUM)) {
                while ($row = mysqli_fetch_row($query)) {
                    $count_rows++;
                    $ro = array();
//                while (list($ke, $va) = each($row)) {
                    foreach ($row as $ke => $va) {
                        //echo " val: $va ";
                        $r = mysqli_escape_string($db, $va);
                        $ro[] = $r;
                    }
                    $rows .= "('" . implode("', '", $ro) . "'),";
                }
                $rows = substr($rows, 0, -1) . ';nYn;';

                $OUT .= <<<EOD
INSERT INTO `{$val}_temp` ({$co}) VALUES {$rows}
EOD;
            } else {
                ;
            };
        }
        if (unlink(DUMP_FILE_NAME)) {
            ;//  echo '<div>Old file ' . DUMP_FILE_NAME . ' is deleted.</div>';
        }
        $file = fopen(DUMP_FILE_NAME, 'w');
        $bites = fwrite($file, $OUT);
        fclose($file);
        // echo '<p>New database dump-file has been created:<br>[' . DUMP_FILE_NAME . ']</p>';
        // echo '<p>Number of tables: [' . $count_tables . '].</p>';
        // echo '<p>Number of rows: [' . $count_rows . '].</p>';
        // echo '<p>Number of recorded bytes: [' . $bites . '].</p>';

        $buffer = ob_get_clean();
        //$buffer = iconv('UTF-8', 'UTF-8//IGNORE', utf8_encode($buffer));
        if ($bites > 0) {
            $out = ["reply"=> 'sql_backup_is_created',"data"=>["link"=> URL_DUMP_FILE_NAME,'bites'=> $bites]];
        }else $out = ["reply"=> 'fail_creating_sql_backup'];
        return json_encode($out);
    }


    private function test_PATH_TO_EXPORT_BACKUPS()
    {
        if (!$result = file_exists(PATH_TO_EXPORT_BACKUPS)) {
            $result = mkdir(PATH_TO_EXPORT_BACKUPS);
        }
        return $result;
    }


    private function get_tables_excludes()
    {
        global $mysqli_db;
        $db = $mysqli_db;
        $out = "";

        $query = "SELECT * FROM `export_tables_excludes` WHERE `active` = 'Y'";
        $result = mysqli_query($db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($db));
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                if ($row["tablename"] == 'disable_filter_of_tables') return '';
                $out .= $row["tablename"] . "|";
            }
            //$out = substr($out,0,-1);

            return $out;
        } else {
            return "";
        }
    }


}

