<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/prolog.php";

global $mysqli_db, $db, $arResult;

if (!function_exists('database_connect')) {
    include $_SERVER["DOCUMENT_ROOT"] . "/sc/dbcon.php";
    database_connect();
    mysqli_set_charset($mysqli_db, "utf8");
}

$sections_sql = "SELECT DISTINCT section FROM faq_global ORDER BY section";
$sections_result = mysqli_query($mysqli_db, $sections_sql);
$sections = array();
while ($row = mysqli_fetch_assoc($sections_result)) {
    $sections[] = $row['section'];
}

$current_section = isset($_GET['section']) ? mysqli_real_escape_string($mysqli_db, $_GET['section']) : '';

$where_conditions = array();
if ($current_section) {
    $where_conditions[] = "section = '$current_section'";
}
$where_sql = !empty($where_conditions) ? 'WHERE ' . implode(' AND ', $where_conditions) : '';

$sql = "SELECT * FROM faq_global $where_sql ORDER BY section, id ASC";
$result = mysqli_query($mysqli_db, $sql);

$faq_items = array();
while ($row = mysqli_fetch_assoc($result)) {
    $faq_items[] = $row;
}

$grouped_items = array();
foreach ($faq_items as $item) {
    $section = $item['section'];
    if (!isset($grouped_items[$section])) {
        $grouped_items[$section] = array();
    }
    $grouped_items[$section][] = $item;
}

include 'template.php';

require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/epilog.php";
?>