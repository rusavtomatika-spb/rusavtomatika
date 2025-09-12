<?php

if (!defined('cms'))
    exit;
global $APPLICATION;
global $DBWORK;
$arResult["news_list"] = $DBWORK->get_news_list($arguments["db_table"], "position", $arguments["filter"]);
include_once dirname(__FILE__) . '/templates/' . $arguments["template"] . "/template.php";


