<?
global $current_component;
global $TITLE, $KEYWORDS, $DESCRIPTION, $CANONICAL;

$DESCRIPTION = 'Самая свежая версия! Weintek EasyBuilder Pro 6 инструкция на английском языке.';
$KEYWORDS = '';
$TITLE = 'Weintek EasyBuilder Pro 6 инструкция на английском языке';
$SERVER_PROTOCOL = $_SERVER['SERVER_PROTOCOL'] == "HTTP/1.1" ? "http://" : "https://";
//$CANONICAL = "https://www.rusavtomatika.com/weintek-easybuilderpro-user-manual-en/";
if(defined("ENCODING") and ENCODING == "UTF-8" ){
    header('Content-type: text/html; charset=windows-1251');
}
else{
    header('Content-type: text/html; charset=windows-1251');
}

global $extra_openGraph;
$extra_openGraph = Array(
    "openGraph_image" => "//www.rusavtomatika.com/upload_files/manuals/weintek/UserManual_separate_chapter/easybuilder-pro.png",
    "openGraph_title" => "Weintek Easybuilder Pro руководство",
    "openGraph_siteName" => "Русавтоматика"
);
include "inc_functions.php";
include $_SERVER["DOCUMENT_ROOT"]."/config.php";
if(EX !="_"){
    require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/prolog.php";
}
?>
<link rel="stylesheet" type="text/css" href="/weintek-easybuilderpro-user-manual-en/styles.css">
<?
if (isset($_GET["q"]))
    $current_url = substr(strip_tags(trim($_GET["q"])), 0, -1);
else {
    $current_url = "";
}

$update_version = "https://www.rusavtomatika.com/upload_files/manuals/weintek/UserManual_separate_chapter/versionEBPro.txt";
$update_version = getRemoteContentByURL($update_version);
if (!$update_version) {
    $update_version = "V6.09.01.322";
}


//include "metatags.php";
$path_to_metatags = "https://www.rusavtomatika.com/upload_files/manuals/weintek/UserManual_separate_chapter/metatags.php";
$metatags = getRemoteContentByURL($path_to_metatags);
eval($metatags);
?>


<?
if(EX !="_"){
    require_once "content.php";
    ?>
    <script src="/weintek-easybuilderpro-user-manual-en/script.js"></script>
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/epilog.php";
}

?>