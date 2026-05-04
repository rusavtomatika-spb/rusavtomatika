<?php
ini_set('error_reporting', E_ALL & ~E_DEPRECATED);
ini_set('display_errors', 1);

define("bullshit", 1);
global $mysqli_db;
global $db;

include $_SERVER["DOCUMENT_ROOT"] . "/sc/dbcon.php";

header('Content-Type: application/json; charset=utf-8');
database_connect();
mysqli_set_charset($mysqli_db, "utf8");

$all = "Все";

$brands_string = '';
$categories_string = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['brands'])) {
        $brands_string = trim($_POST['brands']);
        $categories_string = trim($_POST['categories']);
    } 
    else {
        $raw = file_get_contents('php://input');
        $data = json_decode($raw, true);
        if ($data) {
            $brands_string = isset($data['brands']) ? trim($data['brands']) : '';
            $categories_string = isset($data['categories']) ? trim($data['categories']) : '';
        }
    }
}

$where = "`show` = 1";

if (!empty($brands_string) && $brands_string !== 'Все') {
    $brand = mysqli_real_escape_string($mysqli_db, $brands_string);
    $where .= " AND `brand` = '$brand'";
}

if (!empty($categories_string) && $categories_string !== 'Все') {
    $category = mysqli_real_escape_string($mysqli_db, $categories_string);
    $where .= " AND `section` = '$category'";
}

$query = "SELECT * FROM `discounted` WHERE $where ORDER BY `position`";
$result = mysqli_query($mysqli_db, $query);
$products = array();
while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
}

$query_brands = "SELECT DISTINCT `brand` FROM `discounted` WHERE `show` = 1 AND `brand` IS NOT NULL AND `brand` != '' ORDER BY `brand`";
$result_brands = mysqli_query($mysqli_db, $query_brands);
$all_brands = array();
while ($row = mysqli_fetch_assoc($result_brands)) {
    $all_brands[] = $row['brand'];
}

$query_cats = "SELECT DISTINCT `section` FROM `discounted` WHERE `show` = 1 AND `section` IS NOT NULL AND `section` != '' ORDER BY `section`";
$result_cats = mysqli_query($mysqli_db, $query_cats);
$all_categories = array();
while ($row = mysqli_fetch_assoc($result_cats)) {
    $all_categories[] = $row['section'];
}

$brands_out = array();
$brands_out[] = array("name" => $all, "active" => (empty($brands_string) || $brands_string === 'Все'));
foreach ($all_brands as $brand) {
    $brands_out[] = array("name" => $brand, "active" => ($brands_string === $brand));
}

$categories_out = array();
$categories_out[] = array("name" => $all, "active" => (empty($categories_string) || $categories_string === 'Все'));
foreach ($all_categories as $category) {
    $categories_out[] = array("name" => $category, "active" => ($categories_string === $category));
}

$out = array(
    "products" => $products,
    "brands" => $brands_out,
    "categories" => $categories_out
);

echo json_encode($out, JSON_UNESCAPED_UNICODE);
?>