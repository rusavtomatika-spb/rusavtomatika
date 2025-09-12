<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/prolog.php"; ?>

<?php
$arguments = array();
$arguments["route_string"] = (isset($_REQUEST["q"])) ? $_REQUEST["q"] : "";
$arguments["template"] = "discounted";
$arguments["component"] = "newslist";

CoreApplication::include_component($arguments);
?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/epilog.php"; ?>
