<?php
include $_SERVER["DOCUMENT_ROOT"]."/config.php";
if(EX != "_"){
    header($_SERVER['SERVER_PROTOCOL'] . " 301 Moved Permanently");
    header('Location: https://' . $_SERVER['HTTP_HOST'] ."/catalog/search/");
    exit();
}
ob_start();
ini_set('error_reporting', E_ALL & ~E_DEPRECATED);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
//header('Content-Type: text/html; charset=windows-1251');
session_start();
define("bullshit", 1);
define("MAIN_FILE_EXECUTED", TRUE);

$extra_openGraph = Array(
    "openGraph_image" => "http://www.rusavtomatika.com/upload_files/images/openGraph_images/search.png",
    "openGraph_title" => "Поиск по сайту",
    "openGraph_siteName" => "Русавтоматика"
);

global $TITLE;
    $DESCRIPTION = 'Новости автоматизации управления — панели оператора Weintek, панельные компьютеры Aplex, панельные и встраиваемые компьютеры IFC, промышленные мониторы IFC, панели оператора Samkoon, vpn-роутеры eWON';
    $KEYWORDS = 'Weintek, IFC, Aplex, eWON, Samkoon, панельные компьютеры, панели оператора, операторские панели, встраиваемые компьютеры, промышленные компьютеры, промышленные мониторы, новости, новинки, автоматизация производства';
    $TITLE = 'Поиск по сайту www.rusavtomatika.com';
    
    if (isset($_GET["search"])) {
    $word = $_GET["search"];
    if (mb_detect_encoding($word) == 'UTF-8') {
        $word = iconv("utf-8", "windows-1251", $word);
    }
    $search_word = strip_tags($word);
    $TITLE = "«".$search_word."» - поиск по сайту www.rusavtomatika.com";
}




require_once ($_SERVER['DOCUMENT_ROOT'] . "/sc/dbcon.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/sc/lib_new.php");
require_once ("assets/inc_exclude_words.php");
temp0("weintek");
top_buttons();
basket();
temp1_no_menu();
show_price_val();
temp2(); 

//require_once('model/inc_dbconnect.php');    
require_once('controller/inc_functions.php'); 
require_once('controller/inc_search_functions.php'); 
//require_once('view/inc_search_form_for_header.php'); 
?>
<br>
<div class="page_width_universal">
<div class="page_search">
    <h1>Поиск по сайту<?
        if (isset($search_word)) {
            echo ": &laquo;" . $search_word . "&raquo;";
        }
        ?></h1>
    
<?
require_once('view/inc_search_form.php'); 
?>

</div>
</div>
    <?

temp3();
$buffer = ob_get_clean();

if ((isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
    
    $buffer = explode("<!--ajax-->", $buffer);
    echo $buffer[1];
} else {
    if (isset($header_url) and $header_url != "") {
        header("Location: " . $header_url);
        exit();
    }
    echo $buffer;
}
?>


