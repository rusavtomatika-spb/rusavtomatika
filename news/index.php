<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/prolog.php";

global $arguments;
$arguments = array();
$arguments["route_string"] = (isset($_REQUEST["q"])) ? $_REQUEST["q"] : "";

$arguments["template"] = "news";
$arguments["table"] = "news";

$root_folder_url = trim(explode('?', $_SERVER['REQUEST_URI'])[0], "/");
$root_folder_url = explode('/',$root_folder_url)[0];
$arguments["root_folder_url"] = $root_folder_url;
$arguments["component"] = "newslist";

CoreApplication::include_component($arguments);
?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/epilog.php"; ?>

