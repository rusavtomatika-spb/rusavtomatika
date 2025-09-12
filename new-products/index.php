<?
//include $_SERVER['DOCUMENT_ROOT'] . "/cms/core/check_news_404.php";
global $CONTENT_ON_WIDE_SCREEN;
$CONTENT_ON_WIDE_SCREEN = false;
require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/prolog.php";

global $arguments;
$arguments = array();
$arguments["route_string"] = (isset($_REQUEST["q"])) ? $_REQUEST["q"] : "";
$arguments["template"] = "new_products";
$arguments["table"] = "new_products";
$arguments["name_of_code_field"] = "code";
$root_folder_url = trim(explode('?', $_SERVER['REQUEST_URI'])[0], "/");
$root_folder_url = explode('/', $root_folder_url)[0];
$arguments["root_folder_url"] = $root_folder_url;
$arguments["component"] = "newslist";
?>
<article>
    <?php
    CoreApplication::include_component($arguments);
    ?>
</article>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/abacus/epilog.php";
?>

