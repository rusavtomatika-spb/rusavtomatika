<?php
if (!(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')){exit();}
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

if (!defined('MAIN_FILE_EXECUTED')) {define('MAIN_FILE_EXECUTED', TRUE);}
if (!defined('bullshit')) {define('bullshit', TRUE);}


//require_once($_SERVER["DOCUMENT_ROOT"].'/sc/lib_new_includes/inc_dbconnect.php');
require_once('../model/inc_dbconnect.php');
require_once('../assets/inc_exclude_words.php');
require_once('../controller/inc_functions.php');

ob_start();
echo "<pre>";
////////////////////////////////////////////////////////////////////////////////

if (isset($_POST["form_name"]) and $_POST["form_name"] == "form_add_pages_from_xml") {
    switch ($_POST["form_action"]) {
        case "action_add_pages_from_xml":
            if (isset($_POST["search_index_sitemap_filename"]) and $_POST["search_index_sitemap_filename"] != '') {
                search_index__add_pages_from_xml(
                        htmlspecialchars(addslashes($_POST["search_index_sitemap_filename"])),$_POST["search_index_sitemap_filter_text"], 
                        isset($_POST["search_index_clear_table"]) ? $_POST["search_index_clear_table"] : false,
                        isset($_POST["search_index_clear_index_table"]) ? $_POST["search_index_clear_index_table"] : false);
            } else {
                echo "<script>alert(\"¬ведите адрес sitemap.xml\");</script>";
            }
            break;
        default:
            break;
    }
}
////////////////////////////////////////////////////////////////////////////////

echo "</pre>";
$rest_rows = search_index__get_amount_of_rows_from_table('search_index_pages_candidates');
$out = array( 
    "status" => 1, 
    "rest_rows" => $rest_rows,
); 
$out["buffer"] = iconv("windows-1251", "utf-8", ob_get_contents());
ob_end_clean();        
echo json_encode($out);
?>

