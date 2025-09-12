<?php

if (!defined('cms'))
    exit;
 
global $DBWORK;

if (!isset($arguments["limit"]) or $arguments["limit"] == "") $arguments["limit"] = 1000;
if (!isset($arguments["str_fields_to_select"]) or $arguments["str_fields_to_select"] == "") $arguments["str_fields_to_select"] = "";


if(!isset($arguments["order_by"])) $arguments["order_by"] = "";
$arResult["news_list"] = $DBWORK->get_news_list($arguments["db_table"], $arguments["order_by"], $arguments["filter"],
    $arguments["limit"], $arguments["str_fields_to_select"]);

if ($arguments["template_list"] == ""){$arguments["template_list"] = "default";}

include_once dirname(__FILE__) . '/templates/' . $arguments["template_list"] . "/template.php";

