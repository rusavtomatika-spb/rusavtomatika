<?php

if (!defined('cms'))
    exit;
global $APPLICATION;
global $DBWORK;
if (!isset($arguments["filter"])) {
    $arguments["filter"] = "";
}

if (isset($arguments["db_table2"]) and $arguments["db_table2"]){
    $arResult["news_list"] = $DBWORK->get_news_list_from_two_tables(
        $arguments["db_table"],
        $arguments["db_table2"],
        "date desc",
        $arguments["filter"],
        (isset($arguments["number_of_elements"]) and $arguments["number_of_elements"] > 0) ? $arguments["number_of_elements"] : "6",
        $arguments["str_fields_to_select"]
);
}else {
    $arResult["news_list"] = $DBWORK->get_news_list(
        $arguments["db_table"],
        "date desc",
        $arguments["filter"],
        (isset($arguments["number_of_elements"]) and $arguments["number_of_elements"] > 0) ? $arguments["number_of_elements"] : "6");
}




include_once dirname(__FILE__) . '/templates/' . $arguments["template"] . "/template.php";


