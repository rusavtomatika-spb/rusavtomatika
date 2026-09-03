<?php

function get_rows_from_table($table_name, $selected_fields = "", $condition = " `action_price` IS NOT NULL AND `action_price` != '' AND `action_price` > 0 ", $order = "", $limit = "")
{
    global $mysqli_db;
    mysqli_set_charset($mysqli_db, "utf8");
    $out = array();
    $query = "SELECT ";
    if ($selected_fields != '') $query .= " " . $selected_fields . " ";
    else $query .= " * ";
    $query .= " FROM " . $table_name . " ";
    if ($condition != '') $query .= " WHERE " . $condition . " ";
    if ($order != '') $query .= " ORDER BY " . $order . " ";
    if ($limit != '') $query .= " LIMIT " . $limit . " ";

    $result = mysqli_query($mysqli_db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($mysqli_db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);
    while ($row = mysqli_fetch_assoc($result)) {
        $out[] = $row;
    }
    return $out;
}
?>