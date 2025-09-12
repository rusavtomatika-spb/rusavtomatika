<?php

if (!defined('cms'))
    exit;

/*
  catalog.section
 */
global $APPLICATION;
global $DBWORK;

switch ($template) {
    case "accessories":
    case "analog-plc-expansion":
    case "communication-plc-expansion":
    case "default":
    case "digital-plc-expansion":
    case "programmable-power-module":
    case "temperature-plc-expansion":
        include 'result_modifier.php';
        break;
    case "monitors_aplex":
        include 'result_modifier_monitors_aplex.php';
        break;
    default:
        break;
}
/* END SEO */

include dirname(__FILE__) . '/templates/' . $template . "/template.php";

