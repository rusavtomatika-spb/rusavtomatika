<?php


function get_rows_from_table($table_name, $selected_fields = "", $condition = "", $order = "", $limit = "")
{
    global $mysqli_db;
    mysqli_set_charset($mysqli_db, "cp1251");
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

