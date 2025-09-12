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
    case "copy":
        $result = create_element($_POST["item"]);
        break;
    case "update":
        $result = update_element($_POST["item"]);
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

    if( isset($_POST["new_file_name"]) and $_POST["new_file_name"] != ''){
        $uploadfile = $uploaddir . basename($_POST["new_file_name"]);
    }else{
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
    echo $query = "DELETE FROM `blog` WHERE `id` = '$id'";
    $result = mysqli_query($mysqli_db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($mysqli_db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);
    if ($result) {
        $out["success"] = 1;
    } else $out["success"] = 0;

    return $out;
}

function update_element($fields)
{
    global $mysqli_db;
    if (!(isset($fields["id"]) and $fields["id"] > 0)) {
        return false;
    }
    $fields["date"] = preg_replace('#(\d{2}).(\d{2}).(\d{4})#', '$3-$2-$1', $fields["date"]);

    foreach ($fields as $key => $field) {
        if (is_string($field)) {
            $encoding = mb_detect_encoding($field);
            if (mb_detect_encoding($field) == "UTF-8") {
                $fields[$key] = iconv("utf-8", "windows-1251//IGNORE", $field);
            }
        }
    }
    $stext = mysqli_real_escape_string($mysqli_db, $fields["stext"]);
    $btext = mysqli_real_escape_string($mysqli_db, $fields["btext"]);
    $query = "UPDATE `blog` SET `brand`='{$fields["brand"]}',`date`='{$fields["date"]}',`update`= NOW(),`name`='{$fields["name"]}',`sys_name`='{$fields["sys_name"]}'," .
        "`stext`='{$stext}',`btext`='{$btext}',`show`='{$fields["show"]}',`title_cat`='{$fields["title_cat"]}'," .
        "`description`='{$fields["description"]}',`keywords`='{$fields["keywords"]}',`img`='{$fields["img"]}',`alt`='{$fields["alt"]}' WHERE `id` = '{$fields["id"]}';";

    //$query = iconv("utf-8", "windows-1251", $query);

    //echo $query;

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
    if (!(isset($fields["id"]) and $fields["id"] > 0)) {
        return false;
    }
    $query = "INSERT INTO blog (SELECT NULL, `brand`, `date`, `update`, `parent`, `name`, `sys_name`, `stext`, `btext`, `show`, `por`, `title_cat`, `description`, `keywords`, `img`, `alt` FROM blog WHERE id = {$fields["id"]})";
    $result = mysqli_query($mysqli_db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($mysqli_db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);
    $lastInsertedId = mysqli_insert_id($mysqli_db);
    if ($result) {
        $out["success"] = 1;
        $out["last_inserted_id"] = $lastInsertedId;
    } else $out["success"] = 0;
    //file_put_contents("1.txt", print_r($fields, true));
    return $out;
}




















