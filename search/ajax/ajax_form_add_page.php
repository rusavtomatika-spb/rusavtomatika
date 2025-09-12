<?php
ob_start();
/*ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);*/

if (!(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
    exit();
}
if (!defined('MAIN_FILE_EXECUTED'))
{define(MAIN_FILE_EXECUTED, TRUE);}
if (!defined('bullshit'))
{define(bullshit, TRUE);}



require_once('../model/inc_dbconnect.php');
require_once('../assets/inc_exclude_words.php');
require_once('../controller/inc_functions.php');


echo "<pre>";
/*
if (isset($_GET["form_name"]) and $_GET["form_name"] == "form_add_page") {
    switch ($_GET["form_action"]) {
        case "action_add_page":
            if (isset($_GET["search_index_url"]) and $_GET["search_index_url"] != '') {
                $url = htmlspecialchars(addslashes($_GET["search_index_url"]));
                if (search_index__add_page($url, $url)) {
                    $result = "URL's been added! $url";
                }else{$result = "URL's NOT added! $url";}
            } else {
                $result = "Enter url!";
            }
            break;
        default:
            break;
    }
}
*/



if (isset($_POST["form_name"]) and $_POST["form_name"] == "form_add_page") {
    switch ($_POST["form_action"]) {
        case "action_add_page":
            if (isset($_POST["search_index_url"]) and $_POST["search_index_url"] != '') {
                $url = htmlspecialchars(addslashes($_POST["search_index_url"]));                
                if($_POST["search_index_add_url_to_xml"] !='')$add_url_to_xml = true;
                else{$add_url_to_xml = false;}
                
                if (search_index__add_page($url, $url, $add_url_to_xml)) {
                    $result = "URL's been added! $url";
                }else{$result = "URL's NOT added! $url";}
            } else {
                $result = "Enter url!";
            }
            break;
        default:
            break;
    }
}

if ($result) {
    $out = array(
        "status" => 1,
       "result" => $result,
    );
} else {
    $out = array(
        "status" => 0,
        "result" => "something went wrong!",
    );
}
echo "</pre>";
$out["buffer"] = iconv("windows-1251", "utf-8", ob_get_contents());
ob_end_clean();
echo json_encode($out);
?>

