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
        ob_start();
var_dump($data);
        $processing_files = new c_processing_files();
        if (isset($data["folder_for_updating"]) and $data["folder_for_updating"] != '') $in_dir = $data["folder_for_updating"];
        else $in_dir = "/";




        $processing_files->find($in_dir);

        $arr = array(
            "names" => $processing_files->a_fname,
            "dirs" => $processing_files->a_fdir,
            "hashes" => $processing_files->a_hash_file,
        );
        if (count($arr) > 0) {


            //$out = ["reply" => "source_list_of_files_is_created_on_source"];
            //$out["files"] = $arr;
            $out = json_encode($arr, 0, 1024);
            $success = file_put_contents(FILENAME_SOURCE_LIST_OF_FILES, $out);
            //file_put_contents(PRINT_FILENAME_SOURCE_LIST_OF_FILES, print_r($arr,true));

            if ($success > 0) {
                $out = ["reply" => 'source_list_of_files_is_created_on_source'];
            } else {
                $out = ["reply" => 'failed_creating_source_list_of_files_on_source'];
            }
        } else {
            $out = ["reply" => 'failed_creating_source_list_of_files_on_source'];
        }

        $out["buffer"] =ob_get_clean();
        return json_encode($out);
    }

    public function create_difference_list_of_files()
    {
        $arr_diff_list_of_files = [];
        $success = false;
        ob_start();
        if (file_exists(FILENAME_SOURCE_LIST_OF_FILES) and file_exists(FILENAME_DEST_LIST_OF_FILES)) {
            $source_file_content = file_get_contents(FILENAME_SOURCE_LIST_OF_FILES);
            $dest_file_content = file_get_contents(FILENAME_DEST_LIST_OF_FILES);
            $source_data = json_decode($source_file_content, true);
            $dest_data = json_decode($dest_file_content, true);

            $dest_str = "";

            foreach ($dest_data["names"] as $key=>$name){
                $dest_str .= " | ".$dest_data["dirs"][$key]."/".$name." hash:".$dest_data["hashes"][$key];
            }

            //echo "dest_str: ".$dest_str."!!!!!!!!!!!!!!!!!!!!!!!!!!!<br>";

            $source_names = $source_data["names"];
            $counter = 0;
            foreach ($source_names as $key => $name) {
                 $source_str = $source_data["dirs"][$key]."/".$name." hash:".$source_data["hashes"][$key];
                if (strpos($dest_str,$source_str) === false) {
                    $counter++;
                    $arr_diff_list_of_files[] = $source_data["dirs"][$key] . "/" . $source_data["names"][$key];
                    //echo "<br>".$source_data["dirs"][$key] . "/" . $source_data["names"][$key].$source_data["hashes"][$key]."<br>";
                }
            }
            echo " (Total files: " . $counter . ")\n";
            $success = file_put_contents(FILENAME_DIFFERENCE_LIST_OF_FILES, json_encode($arr_diff_list_of_files));
            /*            echo "<pre style='font-size: small'>";
                        var_dump($dest_data);
                        echo "</pre>";*/

        } else {
            echo "no file!!! " . __FILE__ . "<br>";
        }


        $buffer = ob_get_clean();
        $buffer = iconv('UTF-8', 'UTF-8//IGNORE', utf8_encode($buffer));
        if ($success) {
            $out = ["reply" => 'difference_list_of_files_is_created_on_source', "data" => $buffer, "counter" => $counter];
        } else {
            $out = ["reply" => 'fail_creating_difference_list_of_files_on_source', "data" => $buffer];
        }
        return json_encode($out);
    }

    public function create_zip_list_of_files()
    {
        ob_start();
        echo "<div style='font-size: 10px'>";
        if (file_exists(FILENAME_DIFFERENCE_LIST_OF_FILES)) {
            $diff_file_content = file_get_contents(FILENAME_DIFFERENCE_LIST_OF_FILES);
            $list = json_decode($diff_file_content, true);
            if (is_array($list) and count($list) > 0) {
                $zip = new ZipArchive;
                if (file_exists(FILENAME_ZIP_DIFF_FILES)) {
                    unlink(FILENAME_ZIP_DIFF_FILES);
                }
                if ($zip->open(FILENAME_ZIP_DIFF_FILES, ZipArchive::CREATE) === TRUE) {
                    echo "Backup file's been created:<br>" . FILENAME_ZIP_DIFF_FILES . "<br><br>";
                    $counter = 1;
                    foreach ($list as $file) {
                        // echo $counter++ . " " . $file . "<br>";
                        $zip->addFile($_SERVER["DOCUMENT_ROOT"] . $file, $file);
                    }
                    $zip->close();
                    echo '<br>Files are added to an archive.<br>';
                }
            }
            //var_dump($data);
        }
        echo "</div>";
        $buffer = ob_get_clean();
        $buffer = iconv('UTF-8', 'UTF-8//IGNORE', utf8_encode($buffer));
        $out = ["reply" => 'zip_file_is_created_on_source', "data" => ["link" => URL_FILENAME_ZIP_DIFF_FILES], "buffer" => $buffer];
        return json_encode($out);
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

