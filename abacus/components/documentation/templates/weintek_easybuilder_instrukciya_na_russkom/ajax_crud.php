<?php
ini_set('error_reporting', E_ALL && ~e_deprecated);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
header('Content-Type: text/html; charset=utf-8');

//file_put_contents("1.txt", "!!!\n");
//file_put_contents("1.txt", print_r($_POST,true));
//file_put_contents("1.txt", print_r(!(is_array($_FILES) && count($_FILES) > 0),true),FILE_APPEND);
//file_put_contents("1.txt", print_r(((isset($_POST["action"]) && $_POST["action"] != '') or isset($_FILES)),true),FILE_APPEND);

ob_start();
//file_put_contents("1.txt", print_r($_FILES,true),FILE_APPEND);


if (is_array($_FILES) && count($_FILES) > 0) {
//    file_put_contents("1.txt", "1",FILE_APPEND);

    if (!(isset($_POST["action"]) && $_POST["action"] != '')) {
//        file_put_contents("1.txt", "2",FILE_APPEND);
        exit();
    }
} else {
//    file_put_contents("1.txt", "3",FILE_APPEND);
    $_POST = json_decode(file_get_contents('php://input'), true);
    if (!(isset($_POST["action"]) && $_POST["action"] != '')) {
//        file_put_contents("1.txt", "4",FILE_APPEND);
        exit();
    }
}


define("bullshit", 1);
global $mysqli_db;
global $db;
include $_SERVER["DOCUMENT_ROOT"] . "/sc/dbcon.php";
database_connect();
include "settings.php";

mysqli_set_charset($mysqli_db, "cp1251");


switch ($_POST["action"]) {
    case "get":
        $result = get_element($_POST["item"]);
        break;
    case "copy":
        $result = create_element($_POST["item"]);
        break;
    case "update":
        $result = update_element($_POST["item"]);
        break;
    case "update_sections":
        $result = update_sections($_POST["sections"]);
        break;
    case "delete_section":
        $result = delete_section($_POST["section"]);
        break;
    case "delete":
        $result = delete_element($_POST["item"]["id"]);
        break;
    case "upload_file":
        $result = upload_file($_FILES["file"]);
        break;
    case "delete_image_file":
        $result = delete_image_file($_POST["crud_arr_extra_params"]["file"]);
        break;
    default:
        exit();
}
$out["buffer"] = ob_get_clean();
$out["result"] = $result;
file_put_contents("1.txt", print_r($out, true));
echo json_encode($out);

function upload_file($file)
{
    global $ROOT_FOLDER_FOR_IMAGES;
    file_put_contents("1.txt", print_r($_POST, true));
    file_put_contents("1.txt", print_r($_FILES, true), FILE_APPEND);
    if (!$result = file_exists($ROOT_FOLDER_FOR_IMAGES)) {
        $result = mkdir($ROOT_FOLDER_FOR_IMAGES);
    }

    $uploaddir = $ROOT_FOLDER_FOR_IMAGES . $_POST["id"] . "/";
    if (!$result = file_exists($uploaddir)) {
        $result = mkdir($uploaddir);
    }

    if (isset($_POST["new_file_name"]) and $_POST["new_file_name"] != '') {
        $uploadfile = $uploaddir . basename($_POST["new_file_name"]);
    } else {
        $uploadfile = $uploaddir . basename($_FILES['file']['name']);
    }


    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
        return ["uploaded_file" => str_replace($_SERVER["DOCUMENT_ROOT"], "", $uploadfile)];
    } else {
        return "";
    }
}

function delete_image_file($file)
{
    if (unlink($_SERVER["DOCUMENT_ROOT"] . $file)) {
        $out["success"] = 1;
    } else $out["success"] = 0;
    return $out;
}


function delete_element($id)
{
    //file_put_contents("1.txt", print_r($id,true));
    global $mysqli_db;
    if (!(isset($id) and $id > 0)) {
        return false;
    }
    echo $query = "DELETE FROM `articles` WHERE `id` = '$id'";
    $result = mysqli_query($mysqli_db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($mysqli_db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);
    if ($result) {
        $out["success"] = 1;
    } else $out["success"] = 0;

    return $out;
}
function delete_section($id)
{
    //file_put_contents("1.txt", print_r($id,true));
    global $mysqli_db;
    if (!(isset($id) and $id > 0)) {
        return false;
    }
    echo $query = "DELETE FROM `weintek_easybuilder_instrukciya_na_russkom_sections` WHERE `id` = '$id'";
    $result = mysqli_query($mysqli_db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($mysqli_db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);
    if ($result) {
        $out["success"] = 1;
    } else $out["success"] = 0;
    return $out;
}


function update_sections($sections)
{
    //
    if (is_array($sections) and count($sections) > 0) {
        $items = array();
        foreach ($sections as $section) {
            $new_item = [
                'id' => $section["id"],
                'name' => $section["name"],
                'url' => $section["url"],
                'position' => $section["position"],
                'parent_id' => $section["parent_id"],
                'type' => $section["type"],
                'active' => $section["active"],
            ];
            $items[] = $new_item;
            if (isset($section["subitems"]) and is_array($section["subitems"])) {
                foreach ($section["subitems"] as $sub_section) {
                    $new_subitem = [
                        'id' => $sub_section["id"],
                        'name' => $sub_section["name"],
                        'url' => $sub_section["url"],
                        'position' => $sub_section["position"],
                        'parent_id' => $sub_section["parent_id"],
                        'type' => $sub_section["type"],
                        'active' => $sub_section["active"],
                    ];
                    $items[] = $new_subitem;
                }
            }
        }
        file_put_contents("1.txt", print_r($items, true));
    }

    global $mysqli_db;

    foreach ($items as $item) {

        if (!isset($item["id"]) or $item["id"] == 1) {
            continue;
        }
        foreach ($item as $key => $field) {
            if (is_string($field)) {
                $encoding = mb_detect_encoding($field);
                if (mb_detect_encoding($field) == "UTF-8") {
                    $item[$key] = iconv("utf-8", "windows-1251//IGNORE", $field);
                }
            }
        }
        $core_url = "/weintek-easybuilder-instrukciya-na-russkom/";
        $item["url"] = str_replace($core_url, "", $item["url"]);
        $item["url"] = trim($item["url"], "/");
        $item["url"] = trim($item["url"], "#");

        if ($item["id"] > 0) {
            $query = "UPDATE `weintek_easybuilder_instrukciya_na_russkom_sections` SET " .
                "`name`='{$item["name"]}'," .
                "`code`='{$item["url"]}'," .
                "`type`='{$item["type"]}'," .
                "`parent_id`='{$item["parent_id"]}'," .
                "`position`='{$item["position"]}'," .
                "`active`='{$item["active"]}' " .
                " WHERE `id` = '{$item["id"]}';";

        } else {
            $query = "INSERT INTO `weintek_easybuilder_instrukciya_na_russkom_sections` (`id`, `code`, `name`, `type`, `parent_id`, `position`, `active`) VALUES
            ('', '{$item["url"]}', '{$item["name"]}', '{$item["type"]}', '{$item["parent_id"]}', '{$item["position"]}', '{$item["active"]}')";
        }


        $result = mysqli_query($mysqli_db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($mysqli_db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);
        if ($result) {
            $out["success"] = 1;
        } else {
            $out["success"] = 0;
            return $out;
        }
        //file_put_contents("1.txt", print_r($fields, true));
    }

    return $out;
}

function update_element($fields)
{
    global $mysqli_db;
    if (!isset($fields["id"])) {
        return false;
    }
    if ($fields["id"] == 0) {

        return create_element($_POST["item"]);
    }
    foreach ($fields as $key => $field) {
        if (is_string($field)) {
            $encoding = mb_detect_encoding($field);
            if (mb_detect_encoding($field) == "UTF-8") {
                $fields[$key] = iconv("utf-8", "windows-1251//IGNORE", $field);
            }
        }
    }
    $text = mysqli_real_escape_string($mysqli_db, $fields["text"]);
    $query = "UPDATE `weintek_easybuilder_instrukciya_na_russkom` SET `name`='{$fields["name"]}',`url`='{$fields["url"]}'," .
        "`text`='{$text}',`active`='{$fields["active"]}',`title`='{$fields["title"]}'," .
        "`description`='{$fields["description"]}' WHERE `id` = '{$fields["id"]}';";

    $result = mysqli_query($mysqli_db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($mysqli_db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);
    if ($result) {
        $out["success"] = 1;
    } else $out["success"] = 0;
    //file_put_contents("1.txt", print_r($fields, true));
    return $out;
}

function create_element($fields)
{
    global $mysqli_db;
    $text = mysqli_real_escape_string($mysqli_db, $fields["text"]);
    foreach ($fields as $key => $field) {
        if (is_string($field)) {
            $encoding = mb_detect_encoding($field);
            if (mb_detect_encoding($field) == "UTF-8") {
                $fields[$key] = iconv("utf-8", "windows-1251//IGNORE", $field);
            }
        }
    }

    $core_url = "/weintek-easybuilder-instrukciya-na-russkom/";
    $fields["url"] = str_replace($core_url, "", $fields["url"]);
    $fields["url"] = trim($fields["url"], "/");
    $fields["url"] = trim($fields["url"], "#");
    $fields["url"] = "/".$fields["url"]."/";


    $query = "INSERT INTO `weintek_easybuilder_instrukciya_na_russkom` (`id`, `url`, `name`, `title`, `description`, `text`, `active`) VALUES
            ('', '{$fields["url"]}', '{$fields["name"]}', '{$fields["title"]}', '{$fields["description"]}', '{$fields["text"]}', '{$fields["active"]}')";
    $result = mysqli_query($mysqli_db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($mysqli_db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);
    $lastInsertedId = mysqli_insert_id($mysqli_db);
    if ($result) {
        $out["success"] = 1;
        $out["last_inserted_id"] = $lastInsertedId;
    } else $out["success"] = 0;

    return $out;
}




















