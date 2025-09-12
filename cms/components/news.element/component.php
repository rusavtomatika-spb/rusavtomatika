<?php

if (!defined('cms'))
    exit;
/*
  news.element
 */
global $APPLICATION;
global $DBWORK;

$arResult = array();

$arResult["element"] = $DBWORK->get_news_element_by_code($arguments["db_table"], $arguments["element_code"]);
/* ?><pre><? var_dump($arResult) ?></pre><? */
/* SEO */
global $TITLE, $KEYWORDS, $DESCRIPTION, $CANONICAL;
$CANONICAL = "";
if (isset($arguments["SEO"]["element_title"]) and $arguments["SEO"]["element_title"] != "") {
    $arguments["SEO"]["element_title"] = str_replace("#element_name#", $arResult["element"]["name"], $arguments["SEO"]["element_title"]);
    if (isset($parent_section_title)) {
        $arguments["SEO"]["element_title"] = str_replace("#section_title#", $parent_section_title, $arguments["SEO"]["element_title"]);
    }
    if (isset($arResult["element"]["parent_section_name"])) {
        $arguments["SEO"]["element_title"] = str_replace("#section_name#", $arResult["element"]["parent_section_name"], $arguments["SEO"]["element_title"]);
    }
    $TITLE = $arguments["SEO"]["element_title"];

    if (isset($arResult["element"]["keywords"]) and $arResult["element"]["keywords"] != "")
        $TITLE = $arResult["element"]["keywords"];
    else
        $KEYWORDS = "";
}
if (isset($arResult["element"]["title"]) and $arResult["element"]["title"] != "") {
    global $TITLE;
    $TITLE = $arResult["element"]["title"];
}
if (isset($arResult["element"]["description"]) and $arResult["element"]["description"] != "")
    $DESCRIPTION = $arResult["element"]["description"];
else
    $DESCRIPTION = $arResult["element"]["text_preview"];



/* END SEO */
include dirname(__FILE__) . '/templates/' . $arguments["template_element"] . "/template.php";

