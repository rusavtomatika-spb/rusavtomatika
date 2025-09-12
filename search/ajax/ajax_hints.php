<?php

ini_set('error_reporting', E_ALL & ~E_DEPRECATED);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

if (!(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
    exit();
}
header('Content-Type: text/html; charset=windows-1251');
define('MAIN_FILE_EXECUTED', true);
require_once('../model/inc_dbconnect.php');
require_once('../assets/inc_exclude_words.php');
require_once('../controller/inc_functions.php');
////////////////////////////////////////////////////////////////////////////////

if (isset($_POST ["search_text"]) and $_POST ["search_text"] != "") {
    $search_text = strip_tags(trim($_POST["search_text"]));
    $search_text = mb_strtoupper($search_text);
    if (mb_detect_encoding($search_text) == 'UTF-8') {
        $search_text = iconv("utf-8", "windows-1251", $search_text);
    }
    $search_text = preg_replace('|[\s]+|s', ' ', $search_text); //eliminate repititive space
    $search_text2 = switcher($search_text,2);
    $arSearch_text = explode(" ", $search_text);
     $arSearch_text2 = explode(" ", $search_text2);
     
    $arSearch_text = array_merge((array)$arSearch_text, (array)$arSearch_text2);
    //var_dump($arSearch_text);
    $where_str = "false";
    foreach ($arSearch_text as $word) {
        $where_str .= " or `word` like '%$word%'";
    }
       
    $query = "SELECT * FROM `search_index_words` WHERE $where_str order by `word`;";
    $result = mysqli_query($db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($db));
    while ($row = mysqli_fetch_array($result)) {
        echo "<p class='word_hint'>{$row["word"]}</p>";
    }
}

////////////////////////////////////////////////////////////////////////////////

