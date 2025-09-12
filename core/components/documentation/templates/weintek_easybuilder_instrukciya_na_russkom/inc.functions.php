<?php
global $ROOT_FOLDER_FOR_IMAGES;
$ROOT_FOLDER_FOR_IMAGES = $_SERVER["DOCUMENT_ROOT"] . "/weintek-easybuilder-instrukciya-na-russkom/images/";


global $arrResult;
handle_route($arguments["route_string"]);

function get_menu_items()
{
    global $mysqli_db;
    $out = array();
    $query = "SELECT * FROM `weintek_easybuilder_instrukciya_na_russkom_sections` order by `position`, `id`";
    $result = mysqli_query($mysqli_db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($mysqli_db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row["parent_id"] > 0) {
            $out[$row["parent_id"]]["sub_items"][] = $row;

        } else {
            if (isset($out[$row["id"]]) and !isset($out[$row["id"]]["name"])) {
                $temp = $out[$row["id"]]["sub_items"];
                $out[$row["id"]] = $row;
                $out[$row["id"]]["sub_items"] = $temp;
            } else {
                $out[$row["id"]] = $row;
            }
        }
    }

    usort($out, "cmp_menu_items");
    return $out;
}

function cmp_menu_items($a, $b)
{
    if ($a["position"] == $b["position"]) {
        if ($a["id"] > $b["id"]) {
            return 1;
        } else return -1;
    }
    return ($a["position"] < $b["position"]) ? -1 : 1;
}

function handle_route($query_string)
{
    global $arrResult;
    $query_string = trim($query_string, "/");
    $arrResult["route"] = explode("/", $query_string);
}

function get_content($query_string)
{
    global $arrResult;
    $num_chunks = count($arrResult["route"]);
    switch ($num_chunks) {
        case 1:
            $url = "/" . $arrResult["route"][0] . "/";
            break;
        case 2:
            $url = "/" . $arrResult["route"][0] . "/" . $arrResult["route"][1] . "/";
            break;
        default;
    }
    global $mysqli_db;
    $query = "SELECT * FROM `weintek_easybuilder_instrukciya_na_russkom` where `url` = '{$url}'";
    $result = mysqli_query($mysqli_db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($mysqli_db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $row['images'] = get_list_of_images($row['id']);

        return $row;
    }
    return false;
}

function get_list_of_images($id)
{
    global $ROOT_FOLDER_FOR_IMAGES;
    $out = array();
    $path = $ROOT_FOLDER_FOR_IMAGES . $id . "/";
    if (file_exists($path)) {
        $files = scandir($path);
        foreach ($files as $file) {
            $full_name = $ROOT_FOLDER_FOR_IMAGES . $id . '/' . $file;
            if (mime_content_type($full_name) == 'image/jpeg' or mime_content_type($full_name) == 'image/png') {
                $out[] = str_replace($_SERVER["DOCUMENT_ROOT"], "", $full_name);
            }
        }
    }
    return $out;
}

function get_section_id_by_code($code)
{
    global $mysqli_db;
    $query = "SELECT `id` FROM `weintek_easybuilder_instrukciya_na_russkom_sections` where `code` = '{$code}'";
    $result = mysqli_query($mysqli_db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($mysqli_db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);
    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }
    return false;
}


function get_current_component_from_query_string($query_string)
{
    $route_params = array();
// 1 - section
// 2 - brand
// 3 - series
// 4 - detail
    $arrChunks = explode("/", $query_string);
    $arrChunks = array_filter($arrChunks, static function ($var) {
        return $var !== "";
    });
    $num_of_chunks = count($arrChunks);
    switch ($num_of_chunks) {
        case 1:
            $component_name = "detail";
            break;
        default:
            $component_name = "list";
            break;
    }
    if (isset($arrChunks[0])) $route_params["detail"] = $arrChunks[0];

    return array("component_name" => $component_name, "component_route_params" => $route_params);
}

