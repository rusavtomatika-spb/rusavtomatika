<?php
define("SERVER_RENDERING", "1");
$view_mode = isset($GLOBALS['server_view_mode']) ? $GLOBALS['server_view_mode'] : 'tile';
$_GET["section"] = $arguments["component_route_params"]["section"];
include 'ajax_catalog_section.php';