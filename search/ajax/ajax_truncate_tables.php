<?php
define('MAIN_FILE_EXECUTED',true);
ob_start();
require_once('../model/inc_dbconnect.php');
require_once('../controller/inc_functions.php');
if ($_POST["action"] == 'truncate_tables') {
    if (search_index__truncate_tables()) {
        $out = array("status" => 1);
    } else {
        $out = array("status" => 0);
    }
    $out["buffer"] = iconv("windows-1251", "utf-8", ob_get_contents());
} else {
    $out = array("status" => 0);
}
ob_end_clean();
echo json_encode($out);
