<?php
ini_set('error_reporting', E_ALL && ~e_deprecated);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
header('Content-Type: text/html; charset=windows-1251');
var_dump($arguments["component_route_params"]["detail"]);
define("bullshit", 1);
//$arSettings['path_to_product_images'] = '/images/';

global $mysqli_db;
include $_SERVER["DOCUMENT_ROOT"] . "/sc/dbcon.php";
database_connect();
$DB_WORK_NEWS_DETAIL = new C_DB_WORK_NEWS_DETAIL();

//$DB_WORK_NEWS_DETAIL->get_element_by_code("", "articles");



class C_DB_WORK_NEWS_DETAIL
{
    function get_element_by_code($code, $table)
    {
        global $mysqli_db;
        $query = "SELECT `id` FROM `$table` WHERE `sname` = '$code' ";
        $result = mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($mysqli_db));
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $row;
    }

}


