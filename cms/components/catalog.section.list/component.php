<?php

if (!defined('cms'))
    exit;

global $DBWORK;
/*
  echo "<pre>";
  var_dump($arguments);
  echo "</pre>";
 */
$arResult["sections"] = $DBWORK->get_list_catalog_sections($arguments["filter"], $arguments["table_name"], $arguments["order_by"], $arguments["group_by"]);




include_once dirname(__FILE__) . '/templates/' . $template . "/template.php";

