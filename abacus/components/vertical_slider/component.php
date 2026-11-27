<?php
global $APPLICATION;

if (!isset($arguments["filter"])) {
    $arguments["filter"] = "";
}

$limit = (isset($arguments["number_of_elements"]) && (int)$arguments["number_of_elements"] > 0)
    ? (int)$arguments["number_of_elements"]
    : 6;

$filter = $arguments["filter"];
$order = "date desc";
$fields = (isset($arguments["str_fields_to_select"]) && $arguments["str_fields_to_select"] !== '')
    ? $arguments["str_fields_to_select"]
    : "*";

$condition = '';
if (is_array($filter) && count($filter) > 0) {
    $parts = array();
    foreach ($filter as $key => $value) {
        $parts[] = "`$key`='" . addslashes($value) . "'";
    }
    $condition = implode(' AND ', $parts);
} elseif (is_string($filter) && trim($filter) !== '') {
    $condition = trim($filter);
}

if (isset($arguments["db_table2"]) && $arguments["db_table2"]) {
    $where1 = $condition !== '' ? " WHERE " . $condition : "";
    $where2 = $condition !== '' ? " WHERE " . $condition : "";

    $sql = "SELECT " . $fields . " FROM `" . $arguments["db_table"] . "`" . $where1
         . " UNION ALL "
         . "SELECT " . $fields . " FROM `" . $arguments["db_table2"] . "`" . $where2
         . " ORDER BY date DESC"
         . " LIMIT " . $limit;

    $arResult["news_list"] = CoreApplication::direct_sql_query($sql);
} else {
    $arResult["news_list"] = CoreApplication::get_rows_from_table(
        $arguments["db_table"],
        $fields,
        $condition !== '' ? $condition : "1",
        $order,
        $limit
    );
}

include_once dirname(__FILE__) . '/templates/' . $arguments["template"] . "/template.php";