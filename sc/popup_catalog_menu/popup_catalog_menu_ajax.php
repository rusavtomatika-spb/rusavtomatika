<?php
ini_set('error_reporting', E_ALL && ~e_deprecated);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
header('Content-Type: text/html; charset=windows-1251');
ob_start();
$_POST = json_decode(file_get_contents('php://input'), true);
if (isset($_POST["current_filter_type"]) and $_POST["current_filter_type"] != "") {
    define("bullshit", 1);
    global $mysqli_db;
    global $db;
    include $_SERVER["DOCUMENT_ROOT"]."/sc/dbcon.php";
    include "popup_catalog_menu_functions.php";
    database_connect();
    $ddm = new CDropDownMenu();

    switch ($_POST["current_filter_type"]) {
        case 'category':
            $ddm->print_list_of_brands_by_category();
            break;
        case 'brand':
            $ddm->print_list_of_categories_by_brand();
            break;
        default:
            break;
    }
}

$buffer = ob_get_clean();
if (mb_detect_encoding($buffer) == 'UTF-8') {
    $buffer = iconv("utf-8", "windows-1251", $buffer);
}
echo $buffer;
//file_put_contents("1.html", $buffer, FILE_APPEND);



