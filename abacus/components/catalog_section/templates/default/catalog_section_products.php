<?php
if (!defined('SERVER_RENDERING')) { define('SERVER_RENDERING', '1'); }

$GLOBALS['server_view_mode'] = isset($GLOBALS['server_view_mode']) ? $GLOBALS['server_view_mode'] : 'tile';
$view_mode = $GLOBALS['server_view_mode'];

$_GET['section'] = isset($arguments['component_route_params']['section'])
    ? $arguments['component_route_params']['section']
    : (isset($_GET['section']) ? $_GET['section'] : '');

include __DIR__ . '/ajax_catalog_section.php';