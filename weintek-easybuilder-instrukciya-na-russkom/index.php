<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/prolog.php"; ?>

<?php
global $arguments;
$arguments = array();
$arguments["route_string"] = (isset($_REQUEST["q"])) ? $_REQUEST["q"] : "";

$arguments["component"] = "documentation";
$arguments["template"] = "weintek_easybuilder_instrukciya_na_russkom";
$arguments["table"] = "weintek_easybuilder_instrukciya_na_russkom";
$root_folder_url = trim(explode('?', $_SERVER['REQUEST_URI'])[0], "/");
$root_folder_url = explode('/',$root_folder_url)[0];
$arguments["root_folder_url"] = $root_folder_url;

CoreApplication::include_component($arguments);
?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/epilog.php"; ?>
