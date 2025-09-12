<?php
ob_start();
ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_DEPRECATED);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
if (!(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')){exit();}
define('MAIN_FILE_EXECUTED',TRUE);

global $time_start;
global $time_finish;

$start = microtime(true);

if (!defined('MAIN_FILE_EXECUTED'))
{define('MAIN_FILE_EXECUTED', TRUE);}
if (!defined('bullshit'))
{define('bullshit', TRUE);}

require_once('../model/inc_dbconnect.php');
require_once('../assets/inc_exclude_words.php');
require_once('../controller/inc_functions.php');



$row = search_index__get_first_row_from_table('search_index_pages_candidates');

$added_page_id = search_index__add_page($row['url'],$row['url_original']);

if ($added_page_id)
    {
    search_index__delete_page_from_candidats($row['url']);    
    }
else {
    $url = htmlspecialchars(addslashes($row['url']));
    search_index__add_page_to_failed($url,$row['url_original']);
    search_index__delete_page_from_candidats($url);
    echo "URL отправлен в таблицу с фейлами ".$url;
    
}
$rest_rows = search_index__get_amount_of_rows_from_table('search_index_pages_candidates');
 $out = array( 
    "status" => 1,
    "rest_rows" => $rest_rows,
    "url" => $row['url'],
    "time" => 'time: '.(microtime(true) - $start).' s. ',
   
);

$out["buffer"] = iconv("windows-1251", "utf-8", ob_get_contents());
ob_end_clean();        
echo json_encode($out);
?>
