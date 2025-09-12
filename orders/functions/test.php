<?php
if (1) {
    ini_set('error_reporting', E_ALL & ~E_DEPRECATED);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
}
ob_start();
echo "Yes!";
var_dump($_POST);
$out["buffer"] = iconv("windows-1251", "utf-8", ob_get_contents());
$out["status"] = 1;
ob_end_clean();
echo json_encode($out);

