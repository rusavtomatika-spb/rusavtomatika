<?php

if (!defined('cms'))
    exit;
global $APPLICATION;
global $DBWORK;
$arResult["news_list"] = $DBWORK->get_news_list($arguments["db_table"], "date", $arguments["filter"], ($arguments["number_of_elements"]) ? $arguments["number_of_elements"] : "6");
include_once dirname(__FILE__) . '/templates/' . $arguments["template"] . "/template.php";


