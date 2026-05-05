<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/prolog.php";

global $mysqli_db, $db, $arResult;

if (!function_exists('database_connect')) {
    include $_SERVER["DOCUMENT_ROOT"] . "/sc/dbcon.php";
    database_connect();
    mysqli_set_charset($mysqli_db, "utf8");
}

$route_string = isset($_REQUEST["q"]) ? trim($_REQUEST["q"], '/') : "";
$route_string = preg_replace('/[^a-zA-Z0-9\-_\/]/', '', $route_string);

$route_parts = !empty($route_string) ? explode('/', $route_string) : array();
$action = isset($route_parts[0]) ? $route_parts[0] : '';

$section_url = '';
if ($action === 'section' && isset($route_parts[1])) {
    $section_url = $route_parts[1];
}

$sections_sql = "SELECT DISTINCT section, section_url, section_order 
                 FROM faq_global 
                 ORDER BY section_order ASC, section ASC";
$sections_result = mysqli_query($mysqli_db, $sections_sql);
$sections = array();
$sections_map = array();
while ($row = mysqli_fetch_assoc($sections_result)) {
    $sections[] = $row;
    $sections_map[$row['section_url']] = $row['section'];
}

$current_section = '';
if ($section_url && isset($sections_map[$section_url])) {
    $current_section = $sections_map[$section_url];
}

$where_conditions = array();
if ($current_section) {
    $current_section_escaped = mysqli_real_escape_string($mysqli_db, $current_section);
    $where_conditions[] = "section = '$current_section_escaped'";
}
$where_sql = !empty($where_conditions) ? 'WHERE ' . implode(' AND ', $where_conditions) : '';

$sql = "SELECT * FROM faq_global $where_sql ORDER BY section_order ASC, section ASC, id ASC";
$result = mysqli_query($mysqli_db, $sql);

$faq_items = array();
while ($row = mysqli_fetch_assoc($result)) {
    $faq_items[] = $row;
}

$grouped_items = array();
foreach ($faq_items as $item) {
    $section_key = $item['section'];
    if (!isset($grouped_items[$section_key])) {
        $grouped_items[$section_key] = array(
            'section_url' => $item['section_url'],
            'section_order' => $item['section_order'],
            'items' => array()
        );
    }
    $grouped_items[$section_key]['items'][] = $item;
}

include 'template.php';

require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/epilog.php";
?>