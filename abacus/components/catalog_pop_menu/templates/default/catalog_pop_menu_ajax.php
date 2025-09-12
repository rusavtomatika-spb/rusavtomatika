<?php
ini_set('error_reporting', E_ALL && ~e_deprecated);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
define("bullshit", 1);
define("PROLOG_INCLUDED", 1);


if (!defined('EX')) {
    define('EX', "");
}

define("CATALOG_PRODUCT_URL_TEMPATE", "/#brand#".EX."/#model#/");
define("CATALOG_SECTION_URL_TEMPATE", "/catalog/#section#/");




global $mysqli_db;
global $db;
include $_SERVER["DOCUMENT_ROOT"] . "/sc/dbcon.php";
header('Content-Type: text/html; charset=utf8');
header('Cache-Control: no-cache');
header('Pragma: no-cache');
header('If-Modified-Since: Sat, 1 Jan 2000 00:00:00 GMT');
database_connect();

global $mysqli_db,$mysql_db;
if ($mysqli_db){
    mysqli_query($mysqli_db, "SET NAMES utf8");
}else{
    mysql_query("SET NAMES utf8",$mysql_db);
}




require_once $_SERVER["DOCUMENT_ROOT"].'/abacus/config.php';
require_once CORE_PATH . '/application/CoreApplication.php';

if (!function_exists('var_dump_pre')) {
    function var_dump_pre(...$values)
    {
        foreach ($values as $value) {
            echo "<pre style='font-size: 12px;color: red;max-width: 1000px;overflow: scroll;padding: 10px;text-align: left;'>";
            echo "</pre>";
        }
    }
}





ob_start();
$_POST = json_decode(file_get_contents('php://input'), true);



if(isset($_POST['action']) and $_POST['action'] !=''){

    switch ($_POST['action']){
        case 'show_section_by_categories':
            require __DIR__.'/response_templates/inc_show_section_by_categories.php';
            break;
        case 'show_section_by_categories_one_brand_only':
            require __DIR__.'/response_templates/inc_show_section_by_categories.php';
//            require __DIR__.'/response_templates/inc_show_section_by_categories_one_brand_only.php';
            break;
        case 'show_all_sections_by_brand':
            require __DIR__.'/response_templates/inc_show_all_sections_by_brand.php';
            break;
        case 'show_one_section_by_brand':
            require __DIR__.'/response_templates/inc_show_all_sections_by_brand.php';
//            require __DIR__.'/response_templates/inc_show_one_section_by_brand.php';
            break;
        case 'show_options':
            require __DIR__.'/response_templates/inc_show_options.php';
            break;
        default:
            break;
    }
}

$buffer = ob_get_clean();
/*try {
    if (mb_detect_encoding($buffer) == 'UTF-8') {
        $buffer = iconv("utf-8", "windows-1251//TRANSLIT", $buffer);
    }
}
catch (Exception $ex) {
    //Выводим сообщение об исключении.
    echo $ex->getMessage();
}*/


echo $buffer;
//file_put_contents("1.html", $buffer, FILE_APPEND);


/*
 <ul class="series-list">
    <li class="series-list-item">
        <a href="#">Серия MT8000iP</a>
        <ul class="series-list-item-list">
            <li class="series-list-item-subitem">
                <a href="">4.3? MT8051iP </a>
            </li>
            <li class="series-list-item-subitem">
                <a href="">7.0? MT8071iP </a>
            </li>
            <li class="series-list-item-subitem">
                <a href="">7.0? MT8071iP2 </a>
            </li>
            <li class="series-list-item-subitem">
                <a href="">10.1? MT8102iP</a>
            </li>
        </ul>
    </li>
</ul>
 *
 * */



