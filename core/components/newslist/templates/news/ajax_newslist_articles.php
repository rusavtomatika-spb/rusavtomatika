<?php

/* Settings */
$number_elements_per_page = 5;


ini_set('error_reporting', E_ALL && ~e_deprecated);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
header('Content-Type: text/html; charset=utf-8');

define("bullshit", 1);
global $mysqli_db;
global $db;
include $_SERVER["DOCUMENT_ROOT"] . "/sc/dbcon.php";
database_connect();
mysqli_set_charset($mysqli_db, "utf8");
include "settings.php";
$all = iconv("windows-1251", "utf-8", "Все");

$_POST = json_decode(file_get_contents('php://input'), true);

//file_put_contents("1.txt", print_r($_POST, true));


$filter_brands = array();
$filter_categories = array();

$filter_str = "";
$filter_brands_str = "";
$filter_categories_str = "";

$offset = 0;
$current_page = 0;
if (isset($_POST["page"]) && intval($_POST["page"]) > 0) {
    $current_page = $_POST["page"];
    $offset = $number_elements_per_page * (intval($current_page - 1));
}

$do_not_show_pager = false;
if (is_array($_POST["brands"])) {
    foreach ($_POST["brands"] as $brand) {
        if ($brand["active"]) {
            if ($brand["name"] == $all) {
                $filter_categories_str = "";
                break;
            }
            $filter_brands[] = $brand["name"];
            $filter_brands_str .= "'" . $brand["name"] . "', ";
            $do_not_show_pager = true;
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

if(isset($_COOKIE['edit_mode']) and $_COOKIE['edit_mode'] == '1'){
    $filter_str = " `id` != '' ";
}
else $filter_str = "`show` = '1' ";

if (strlen($filter_brands_str) > 0 or strlen($filter_categories_str) > 0) {
    $filter_str .= " AND ";

    if (strlen($filter_brands_str) > 0) {
        $filter_str .= "`brand` IN (" . $filter_brands_str . ")";
    }
    if (strlen($filter_categories_str) > 0) {
        if (strlen($filter_brands_str) > 0) {
            $filter_str .= " AND ";
        }
        $filter_str .= " `section` IN (" . $filter_categories_str . ")";
    }

}

//require_once '/core/application/CoreApplication.php';
//include "popup_catalog_menu_functions.php";


ob_start();

$rows = get_rows_from_table("`news`");

$brands_out[] = array("name" => $all, "active" => true);

foreach ($rows as $row) {
    $brands[] = $row["brand"];
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

if (!$do_not_show_pager) {
    $rows = get_rows_from_table("`news`", "", $filter_str, "id DESC", $offset . "," . $number_elements_per_page);
}else{
    $rows = get_rows_from_table("`news`", "", $filter_str, "id DESC");
}
foreach ($rows as $key => $row) {
    $rows[$key]['date'] = date('d.m.Y', strtotime($row['date']));
    $rows[$key]['link'] = $row['sys_name'] . "/";
    $rows[$key]['images'] = get_list_of_images($row['id']);
}

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

if (!$do_not_show_pager) {
    $arr_pager_items = get_pager("news", $filter_str, $number_elements_per_page, $current_page);
}else $arr_pager_items = [];

$buffer = ob_get_clean();
/*if (mb_detect_encoding($buffer) == 'UTF-8') {
    $buffer = iconv("utf-8", "windows-1251", $buffer);
}*/

$out["buffer"] = $buffer;
$out["products"] = $rows;
$out["all_brands"] = get_all_brands("news");
$out["brands"] = $brands_out;
$out["pager_items"] = $arr_pager_items;


echo json_encode($out);


//file_put_contents("1.html", $buffer, FILE_APPEND);

function get_list_of_images($id){
    global $ROOT_FOLDER_FOR_IMAGES;
    $files = scandir($ROOT_FOLDER_FOR_IMAGES.$id);
    foreach ($files as $file){
        $full_name = $ROOT_FOLDER_FOR_IMAGES.$id.'/'.$file;
        if(mime_content_type($full_name) == 'image/jpeg' or mime_content_type($full_name) == 'image/png'){
            $out[] = str_replace($_SERVER["DOCUMENT_ROOT"], "", $full_name);
        }
    }
    return $out;
}

function get_all_brands($table_name)
{
    return get_enum_values($table_name, "brand");
}


function get_enum_values( $table, $field )
{
    global $mysqli_db;
    $query = "SHOW COLUMNS FROM {$table} WHERE Field = '{$field}'";
    $result = mysqli_query($mysqli_db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($mysqli_db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);
    $row = mysqli_fetch_assoc($result);
    preg_match("/^enum\(\'(.*)\'\)$/", $row["Type"], $matches);
    $enum = explode("','", $matches[1]);
    return $enum;
}

function get_rows_from_table($table_name, $selected_fields = "", $condition = "", $order = "", $limit = "")
{
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
    //file_put_contents("1.txt", print_r($query, true));

    $result = mysqli_query($mysqli_db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($mysqli_db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);
    while ($row = mysqli_fetch_assoc($result)) {
        $out[] = $row;
    }
    return $out;
}

function get_pager($table_name, $condition,$number_elements_per_page, $current_page)
{
    global $mysqli_db;
    mysqli_set_charset($mysqli_db, "utf8");
    $arr_pager_items = array();
    $query = "SELECT count(*) FROM $table_name WHERE $condition ";
    $result = mysqli_query($mysqli_db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($mysqli_db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);
    $row = mysqli_fetch_row($result);
    $num_elements = $row[0];
    $num_pages = intval(ceil($num_elements / $number_elements_per_page));
    for ($x = 1; $x <= $num_pages; $x++) {
        $name = $x;
        if ($x == 1) $link = "";
        else $link = "?page=$x";
        if ($current_page == $x or ($current_page == 0 && $x == 1)) {
            $active = true;
        } else {
            $active = false;
        }
        $arr_pager_items[] = ["name" => "$name", "link" => $link, "active" => $active];
    }
    return $arr_pager_items;

}





