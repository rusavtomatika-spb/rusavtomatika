<?php
ini_set('error_reporting', E_ALL && ~e_deprecated);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

define("bullshit", 1);
global $mysqli_db;
global $db;
include $_SERVER["DOCUMENT_ROOT"] . "/sc/dbcon.php";
header('Content-Type: text/html; charset=utf-8');
database_connect();
mysqli_set_charset($mysqli_db, "utf8");

$all = "Все";
//$all = iconv("windows-1251", "utf-8", "Все");

$_POST = json_decode(file_get_contents('php://input'), true);

//file_put_contents("1.txt", print_r($_POST, true));


$filter_brands = array();
$filter_categories = array();

$filter_str = "";
$filter_brands_str = "";
$filter_categories_str = "";

if (is_array($_POST["brands"])) {
    foreach ($_POST["brands"] as $brand) {
        if ($brand["active"]) {
            if ($brand["name"] == $all) {
                $filter_categories_str = "";
                break;
            }
            $filter_brands[] = $brand["name"];
            $filter_brands_str .= "'" . $brand["name"] . "', ";
        }
    }
}
$filter_brands_str = trim($filter_brands_str, ", ");

if (is_array($_POST["categories"])) {
    foreach ($_POST["categories"] as $category) {
        if ($category["active"]) {
            if ($category["name"] == $all) {
                $filter_categories_str = "";
                break;
            }
            $filter_categories[] = $category["name"];
            $filter_categories_str .= "'" . $category["name"] . "', ";
        }
    }
}
$filter_categories_str = trim($filter_categories_str, ", ");

if (strlen($filter_brands_str) > 0 or strlen($filter_categories_str) > 0) {
    $filter_str = " `show` = 1 ";
    if (strlen($filter_brands_str) > 0) {
        $filter_str .= " and `brand` IN (" . $filter_brands_str . ")";
    }
    if (strlen($filter_categories_str) > 0) {
        if (strlen($filter_brands_str) > 0) {
            $filter_str .= " AND ";
        }
        $filter_str .= " and `section` IN (" . $filter_categories_str . ")";
    }

}

//require_once '/abacus/application/CoreApplication.php';
//include "popup_catalog_menu_functions.php";


ob_start();

$rows = get_rows_from_table("`discounted`", ""," `show` = 1 ");

$brands_out[] = array("name" => $all, "active" => true);
$categories_out[] = array("name" => $all, "active" => true);

foreach ($rows as $row) {
    $brands[] = $row["brand"];
    $categories[] = $row["section"];
}
$brands = array_unique($brands);
sort($brands);

$something_selected = false;
foreach ($brands as $brand) {
    if (in_array($brand, $filter_brands)) {
        $activeness = true;
        $something_selected = true;
    } else $activeness = false;
    $brands_out[] = array("name" => $brand, "active" => $activeness);;
}
if ($something_selected) {
    $brands_out[0]["active"] = false;
}

$categories = array_unique($categories);
$something_selected = false;
foreach ($categories as $category) {
    if (in_array($category, $filter_categories)) {$activeness = true;$something_selected = true;}
    else $activeness = false;
    $categories_out[] = array("name" => $category, "active" => $activeness);;
}
if ($something_selected) {
    $categories_out[0]["active"] = false;
}
if(trim($filter_str) == ''){ $filter_str =  "`show` = 1"; }
$rows = get_rows_from_table("`discounted`", "", $filter_str, "position");



/*
if (isset($_POST["current_filter_brand"]) and $_POST["current_filter_brand"] != "") {
}
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
}*/

$buffer = ob_get_clean();
/*if (mb_detect_encoding($buffer) == 'UTF-8') {
    $buffer = iconv("utf-8", "windows-1251", $buffer);
}*/

$out["buffer"] = $buffer;
$out["products"] = $rows;
$out["categories"] = $categories_out;
$out["brands"] = $brands_out;

echo json_encode($out);


//file_put_contents("1.html", $buffer, FILE_APPEND);


function get_rows_from_table($table_name, $selected_fields = "", $condition = "", $order = "", $limit = "")
{

    if($condition == "") $condition == "`show` = 1";
    global $mysqli_db;
    mysqli_set_charset($mysqli_db, "utf8");
    $out = array();
    $query = "SELECT ";
    if ($selected_fields != '') $query .= " " . $selected_fields . " ";
    else $query .= " * ";
    $query .= " FROM " . $table_name . " ";
    if ($condition != '') $query .= " WHERE " . $condition . " ";
    if ($order != '') $query .= " ORDER BY  " . $order . " ";
    if ($limit != '') $query .= " LIMIT  " . $limit . " ";
    file_put_contents("1.txt", print_r($query, true), FILE_APPEND);


    $result = mysqli_query($mysqli_db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($mysqli_db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);
    while ($row = mysqli_fetch_assoc($result)) {
        $out[] = $row;
    }
    return $out;
}






