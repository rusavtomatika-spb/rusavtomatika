<?php

global $arrResult;


function get_menu_items()
{
    global $mysqli_db;
    $out = array();
    $query = "SELECT * FROM `weintek_easybuilder_instrukciya_na_russkom_sections`";
    $result = mysqli_query($mysqli_db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($mysqli_db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row["parent_id"] > 0) {
            $out[$row["parent_id"]]["sub_items"][] = $row;
        } else {
            $out[$row["id"]] = $row;
        }
    }
    return $out;
}
