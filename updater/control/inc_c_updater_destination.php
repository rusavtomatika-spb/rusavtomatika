<?php
define("EXTRACT_TO_FOLDER", __DIR__ . "/../../");
define("FILENAME_ZIP_DIFF_FILES", __DIR__ . "/../data/archive_difference_files.zip");
define("PATH_TO_DATA", __DIR__ . "/../data/");

if (!function_exists('var_dump_pre')) {
    function var_dump_pre($value)
    {
        echo "<pre style='font-size: 11px;color: red;max-width: 1000px;overflow: scroll;padding: 10px;'>";
        var_dump($value);
        echo "</pre>";
    }
}


class c_updater_destination
{


    /*"database_server": this.database_server,
    "database_name": this.database_name,
    "database_user": this.database_user,
    "database_password": this.database_password,*/


    public function save_settings($settings)
    {
        //
        $content_new = ["settings" => $settings];
        //
        $content_orig = file_get_contents(__DIR__ . "/../settings/settings.php");
        $content_orig = json_decode($content_orig, true);
        //


        $content_orig["settings"]["database_server"]["database_host"] = $content_new["settings"]["database_server"]["database_host"];
        $content_orig["settings"]["database_server"]["database_name"] = $content_new["settings"]["database_server"]["database_name"];
        $content_orig["settings"]["database_server"]["database_user"] = $content_new["settings"]["database_server"]["database_user"];
        $content_orig["settings"]["database_server"]["database_password"] = $content_new["settings"]["database_server"]["database_password"];

        if (isset($content_new["settings"]["updater_password_new"]) and $content_new["settings"]["updater_password_new"] != "") {
            $updater_password_new_md5 = md5($content_new["settings"]["updater_password_new"]);
            $content_orig["settings"]["updater_password"] = $updater_password_new_md5;
        }else{
            if(!isset($content_orig["settings"]["updater_password"])){
                $content_orig["settings"]["updater_password"] = "";
            }
        }



        $put_content = json_encode($content_orig);
        $success = file_put_contents(__DIR__."/../settings/settings.php",$put_content);
/*        $settings = file_get_contents(__DIR__ . "/../settings/settings.php");
        $out = ["reply" => 'take_settings', "settings" => $settings];*/
/*        return json_encode($out);*/
        return $this->read_settings();
    }

    public function read_settings()
    {
        $content = file_get_contents(__DIR__ . "/../settings/settings.php");
        //$content = iconv('UTF-8', 'UTF-8//IGNORE', utf8_encode($content));
        $content = json_decode($content);
        $out = ["reply" => 'take_settings', "settings" => $content->settings];
        return json_encode($out);
    }

    public function update_database()
    {
        ob_start();
        $dump_file = __DIR__ . '/../data/sql_dump.sql';
        $mess = "";

        $content = file_get_contents(__DIR__ . "/../settings/settings.php");
        $settings = json_decode($content);


        define('LOCAL_DB_SERVER', $settings->settings->database_server->database_host);
        define('LOCAL_DB_USER', $settings->settings->database_server->database_user);
        define('LOCAL_DB_DBNAME', $settings->settings->database_server->database_name);
        define('LOCAL_DB_PASSWORD', $settings->settings->database_server->database_password);

        $success = FALSE;
        $dt = date('Y-m-d-H-i');
        $dtb = date('Y-m-d');
        $dump_file_short = $dump_file;
        //$dump_file = LOCAL_TEMPORARY_FOLDER . $dump_file;
        $db = mysql_connect(LOCAL_DB_SERVER, LOCAL_DB_USER, LOCAL_DB_PASSWORD); // Соединяемся с сервером БД
        if (!$db) {
            print("Database connection failed.");
        } else {
            if (!mysql_select_db(LOCAL_DB_DBNAME)) { // Если нет такой БД
                print("Database select failed.");
            } else {

                mysql_query("SET NAMES 'cp1251'");


                if (file_exists($dump_file)) {

                    $dump = file_get_contents($dump_file);
                    $dump = str_replace("\r\n", "", $dump);
                    $dump = str_replace("\n", "", $dump);
                    $dump = str_replace("\r", "", $dump);
                    $qk = 1;
                    $pieces = explode(";nYn;", $dump);
                    $mess = strlen($dump);
                    echo " length: " . $mess;
                    while (list($key, $val) = each($pieces)) {
                        if ($val != '') {
                            $val = $val . ';';


                            $query_result = mysql_query($val) or die("file: " . __FILE__ . " line: " . __LINE__ . " error $qk" . mysql_error() . " val:" . $val);

                        };
                        $qk++;
                    };
// Конец загрузки временных таблиц
// Перенос в основные таблицы
                    if (!mysql_error()) {
                        $query = "SHOW TABLES LIKE '%_temp';";
                        $r = mysql_query($query) or die("error 2");
                        if (!mysql_error()) {
                            if (mysql_num_rows($r) > 0) {
                                echo "<p>Extracted tables:</p><p style='text-align:left;'>";
                                $counter = 0;
                                while ($row = mysql_fetch_array($r, MYSQL_NUM)) {
                                    $counter++;
//                                if (true) {
                                    if (($row[0] != 'products_all_temp') and ($row[0] != 'controllers_temp')) {
                                        $table = str_replace("_temp", "", $row[0]);
                                        echo $table . ", ";
                                        $query = "DROP TABLE IF EXISTS `{$table}`;";////////////!!!!!!!!!!!!!!!
                                        mysql_query($query) or die("error " . $query);
                                        /*$tableex = "SHOW TABLES LIKE '{$table}'";
                                        $ru = mysql_query($tableex) or die("error 10");
                                        if (mysql_num_rows($ru) > 0) {
                                            $query = "RENAME TABLE `{$table}` TO `{$table}-{$dt}`;";
                                            $query_result = mysql_query($query) or die("error 3 $query");
                                        };*/
                                        $query = "RENAME TABLE `{$row[0]}` TO `{$table}`;";
                                        $query_result = mysql_query($query) or die("error 4");
                                    } else {
                                        $tableOriginal = str_replace('_temp', '', $row[0]);
                                        echo $tableOriginal . ", ";
                                        $tableex = "SHOW TABLES LIKE '{$tableOriginal}'";
                                        $ru = mysql_query($tableex) or die("error 10");
                                        if (mysql_num_rows($ru) > 0) {

//                                        $query = "SELECT  `index` ,  `model` ,  `onstock` ,  `show_on_stock`, `onstock_spb` ,  `onstock_msk` ,  `onstock_kiv` ,  `onstock_ptg` ,  `res_onstock_spb` , `res_onstock_msk` ,  `res_onstock_kiv` ,  `res_onstock_ptg` ,  `retail_price` FROM  `{$tableOriginal}`;";
                                            $query = "SELECT  `index` ,  `model` ,  `onstock` ,  `show_on_stock`, `onstock_spb` ,  `onstock_msk` ,  `onstock_kiv` ,  `onstock_ptg` ,  `res_onstock_spb` , `res_onstock_msk` ,  `res_onstock_kiv` ,  `res_onstock_ptg`  FROM  `{$tableOriginal}`;";
                                            $query_result = mysql_query($query) or die("error 5");
                                            $j = mysql_num_rows($query_result);


                                            if (!mysql_error()) {
                                                for ($i = 0; $i < $j; $i++) {
                                                    $ro = mysql_fetch_assoc($query_result);
                                                    $q1 = "SELECT * FROM `{$tableOriginal}_temp` WHERE `model`='{$ro[model]}';";
                                                    $query_re = mysql_query($q1) or die("error 6");

                                                    $q = mysql_num_rows($query_re);

                                                    if ($q > 0) {
//                                                    $qp = "UPDATE `{$tableOriginal}_temp` SET `onstock`='{$ro[onstock]}', `show_on_stock`='{$ro[show_on_stock]}', `onstock_spb` ='{$ro[onstock_spb]}',  `onstock_msk` ='{$ro[onstock_msk]}',  `onstock_kiv` ='{$ro[onstock_kiv]}',  `onstock_ptg` ='{$ro[onstock_ptg]}',  `res_onstock_spb` ='{$ro[res_onstock_spb]}', `res_onstock_msk` ='{$ro[res_onstock_msk]}',  `res_onstock_kiv` ='{$ro[res_onstock_kiv]}',  `res_onstock_ptg` ='{$ro[res_onstock_ptg]}',  `retail_price` ='{$ro[retail_price]}' WHERE `{$tableOriginal}_temp`.`model` = '{$ro[model]}';";
                                                        $qp = "UPDATE `{$tableOriginal}_temp` SET `onstock`='{$ro[onstock]}', `show_on_stock`='{$ro[show_on_stock]}', `onstock_spb` ='{$ro[onstock_spb]}',  `onstock_msk` ='{$ro[onstock_msk]}',  `onstock_kiv` ='{$ro[onstock_kiv]}',  `onstock_ptg` ='{$ro[onstock_ptg]}',  `res_onstock_spb` ='{$ro[res_onstock_spb]}', `res_onstock_msk` ='{$ro[res_onstock_msk]}',  `res_onstock_kiv` ='{$ro[res_onstock_kiv]}',  `res_onstock_ptg` ='{$ro[res_onstock_ptg]}' WHERE `{$tableOriginal}_temp`.`model` = '{$ro[model]}';";

                                                        $queryp = mysql_query($qp) or die("error 7");

                                                        if ($q != 1) {

                                                            $mess .= '<br />' . $ro[model] . ' - ' . $q . ' записей в новой базе данных<br />';
                                                        };
                                                    } else {
                                                        $mess .= '<br />' . $ro[model] . ' - ' . $q . ' записей в новой базе данных<br />';
                                                    };
                                                };
                                            };
                                        };

                                        if (!mysql_error()) {

//$query =  "DROP TABLE IF EXISTS `products_all`;";
                                            $query = "DROP TABLE IF EXISTS `{$tableOriginal}`;";
                                            mysql_query($query) or die("error " . $query);
                                            /*
                                            $tableex = "SHOW TABLES LIKE '{$tableOriginal}'";
                                            $ru = mysql_query($tableex) or die("error 15");
                                            if (mysql_num_rows($ru) > 0) {
                                                $query = "RENAME TABLE `{$tableOriginal}` TO `{$tableOriginal}-{$dt}`;";
                                                $query_result = mysql_query($query) or die("Error 8");
                                            };*/
                                            $query = "RENAME TABLE `{$tableOriginal}_temp` TO `{$tableOriginal}`;";
                                            $query_result = mysql_query($query) or die("Error 9");
                                        } else {
                                            echo 'ended error 4';
                                        };
                                    };
                                };
                                echo "</p><p>[total amount: $counter]</p>";
                                $params["sql"] = $dump_file_short;
                                //save_current_versions($params);
                                //delete_file($dump_file_short);
                                $success = TRUE;
                                //!!!!!!!!!!
                                //get_current_versions_html();

                            };
                        };
                    } else {
                        echo 'ended error 2';
                    };
                    $mess .= '<br />Конец обновления базы данных<br />';
                } else {
                    $mess .= 'Файл с выгрузкой базы данных ' . $dump_file . ' не найден! База данных обновляться не будет!<br />';
                }
            };
        }
        $buffer = ob_get_clean();
        $buffer = iconv('UTF-8', 'UTF-8//IGNORE', utf8_encode($buffer));
        $out = ["reply" => "database_is_updated", "buffer" => $buffer];

        return json_encode($out);

    }


    public function download_sql_backup($link)
    {
        if (!$result = file_exists(PATH_TO_DATA)) {
            $result = mkdir(PATH_TO_DATA);
        }
        $local_file = PATH_TO_DATA . '/sql_dump.sql';
        $success = file_put_contents($local_file, file_get_contents($link));
        if ($success) {
            $bytes = number_format($success / 1024, 2) . ' KB';
            $out = ["reply" => "sql_backup_is_downloaded", "buffer" => $bytes];

        } else {
            $out = ["reply" => "fail_downloading_sql_backup", "buffer" => $success];
        }
        return json_encode($out);
    }

    public function extract_zip_list_of_files()
    {
        ob_start();
        $zip = new ZipArchive;
        $res = $zip->open(FILENAME_ZIP_DIFF_FILES);
        if ($res === TRUE) {
            $zip->extractTo(EXTRACT_TO_FOLDER); //$_SERVER['DOCUMENT_ROOT'] . '/'
            $zip->close();

            $out = ["reply" => 'zip_file_is_extracted'];
        } else {
            $out = ["reply" => 'fail_extracting_zip_file'];
        }
        $buffer = ob_get_clean();
        $out["buffer"] = $buffer;
        return json_encode($out);
    }


    public function download_zip_from_source($link)
    {
        $local_file = __DIR__ . '/../data/archive_difference_files.zip';
        $success = file_put_contents($local_file, file_get_contents($link));
        if ($success) {

            $bytes = number_format($success / 1024, 2) . ' KB';

            $out = ["reply" => "zip_file_is_downloaded", "buffer" => $bytes];

        } else {
            $out = ["reply" => "fail_downloading_zip_file", "buffer" => $success];
        }
        return json_encode($out);
    }

    public function create_dest_list_of_files()
    {
        if (!$result = file_exists(__DIR__ . "/../data/")) {
            $result = mkdir(__DIR__ . "/../data/");
        }
        global $processing_files;
        $out = [];
        $processing_files = new c_processing_files();
        $processing_files->find("/");

        $arr = array(
            "names" => $processing_files->a_fname,
            "dirs" => $processing_files->a_fdir,
            "hashes" => $processing_files->a_hash_file,
        );
        if (count($arr) > 0) {
            $data_file = json_encode($arr, 0, 1024);


            file_put_contents(__DIR__ . "/../data/dest_list_of_files_print.txt", print_r($arr, true));
            $success = file_put_contents(__DIR__ . "/../data/dest_list_of_files.txt", $data_file);
            if ($success > 0) {
                $out = ["reply" => "dest_list_of_files_is_created", "files" => $arr];
            }
        } else {
            $out = ["reply" => "failing_creating_dest_list_of_files"];
        };
        /*       switch (json_last_error()) {
                   case JSON_ERROR_NONE:
                       echo ' - Ошибок нет';
                       break;
                   case JSON_ERROR_DEPTH:
                       echo ' - Достигнута максимальная глубина стека';
                       break;
                   case JSON_ERROR_STATE_MISMATCH:
                       echo ' - Некорректные разряды или несоответствие режимов';
                       break;
                   case JSON_ERROR_CTRL_CHAR:
                       echo ' - Некорректный управляющий символ';
                       break;
                   case JSON_ERROR_SYNTAX:
                       echo ' - Синтаксическая ошибка, некорректный JSON';
                       break;
                   case JSON_ERROR_UTF8:
                       echo ' - Некорректные символы UTF-8, возможно неверно закодирован';
                       break;
                   default:
                       echo ' - Неизвестная ошибка';
                       break;
               }*/

        return json_encode($out, 0, 1024);
    }
}

class c_processing_files
{
    public $a_fname = [];
    public $a_fsize = [];
    public $a_fdir = [];
    public $a_hash_file = [];

    public $cofiles = 0;

    function find($in_dir)
    {
        $regexp_folders = "/^\/\/(backup|updater_source|admin|service|images|export|import|_.*)\/*.*/i";
        $regexp_files_include = "/\.(htaccess|js|json|css|php|html|xml|txt|jpg|png|svg|gif|woff2|ttf|csv|z)$/i";
        $regexp_files_exclude = "/dbcon.php|settings.php/";
        $dir_handle = opendir($_SERVER['DOCUMENT_ROOT'] . '/' . $in_dir);
        while ($file = readdir($dir_handle)) {
            $file = iconv('UTF-8', 'UTF-8//IGNORE', utf8_encode($file));
            if ($file != ".." && $file != "." && is_dir($_SERVER['DOCUMENT_ROOT'] . '/' . $in_dir . "/" . $file)) {
                if (!preg_match($regexp_folders, $in_dir)) $this->find($in_dir . "/" . $file);
                else file_put_contents("excludes.txt", $in_dir . "\n", FILE_APPEND | LOCK_EX);
            }
            if (is_file($_SERVER['DOCUMENT_ROOT'] . '/' . $in_dir . "/" . $file) && $file != ".." && $file != ".") {
                if (preg_match($regexp_files_include, $file) and !preg_match($regexp_folders, $in_dir) and !preg_match($regexp_files_exclude, $file)) {
                    $this->a_fname[$this->cofiles] = $file;
                    $this->a_fsize[$this->cofiles] = filesize($_SERVER['DOCUMENT_ROOT'] . '/' . $in_dir . "/" . $file);
                    $this->a_hash_file[$this->cofiles] = hash_file("md5", $_SERVER['DOCUMENT_ROOT'] . '/' . $in_dir . "/" . $file);
                    $this->a_fdir [$this->cofiles] = $in_dir;
                    $this->cofiles++;
                    file_put_contents("includes_files.txt", $_SERVER['DOCUMENT_ROOT'] . '/' . $in_dir . "/" . $file . "\n", FILE_APPEND | LOCK_EX);
                    if ($this->cofiles > 100000) break;
                }else{
                    file_put_contents("excludes_files.txt", $_SERVER['DOCUMENT_ROOT'] . '/' . $in_dir . "/" . $file . "\n", FILE_APPEND | LOCK_EX);
                }
            }
        }
        closedir($dir_handle);
    }
}


