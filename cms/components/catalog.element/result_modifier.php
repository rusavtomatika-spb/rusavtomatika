<?php

$arResult = array();
$arResult["element"] = $DBWORK->get_catalog_element_by_code($arguments["element_code"], $arguments["section_code"]);
$properties = $DBWORK->get_list_catalog_element_fields_by_id(array("id" => $arResult["element"]["id"]));
if (isset($arResult["element"]["picture_detail"])) {
    if ($arResult["element"]["picture_detail"] == "") {
        $arResult["element"]["picture_detail"] = $arguments["path_to_images"] . "models/" . $arResult["element"]["name"] . ".jpg";
    }
} else {
    $arResult["element"]["picture_detail"] = $arguments["path_to_images"] . "models/" . $arResult["element"]["name"] . ".jpg";
}

$arr = array();

foreach ($properties as $key => $value) {

    $arr[$value["code"]]["id"] = $value["id"];

    if (isset($value["name_rus"]) and $value["name_rus"] != "") {
        $arr[$value["code"]]["name"] = $value["name_rus"];
    } else {
        $arr[$value["code"]]["name"] = $value["name"];
    }
    $arr[$value["code"]]["type"] = $value["type"];

    if (isset($value["value"]["value_rus"]) and $value["value"]["value_rus"] != "") {
        $arr[$value["code"]]["value"] = $value["value"]["value_rus"];
    } elseif (isset($value["value"]["value"])) {
        $arr[$value["code"]]["value"] = $value["value"]["value"];
    } else
        $arr[$value["code"]]["value"] = "";
}
$arResult["element"]["properties"] = $arr;

if (isset($arResult["element"]["properties"]["files"]["value"]) and $arResult["element"]["properties"]["files"]["value"] != "") {
    $files = array();
    $element_files = preg_split("/[\s,]+/", trim($arResult["element"]["properties"]["files"]["value"]));
    rsort($element_files, SORT_NUMERIC);
    foreach ($element_files as $file) {
        //echo "=" . $value . "=<br>";
        if ($file != "") {
            $arFile = $DBWORK->get_catalog_file_by_id(intval($file));
            $files[$file] = $arFile;
        }
    }
    $arResult["element"]["properties"]["files"] = $files;
} else {
    $arResult["element"]["properties"]["files"] = "";
}
$parent_section_name = $DBWORK->get_catalog_section_field_by_section_code($arResult["element"]["section_code"], "name");
$parent_section_title = $DBWORK->get_catalog_section_field_by_section_code($arResult["element"]["section_code"], "title");
if (isset($parent_section_title["title"]) and $parent_section_title["title"] != "")
    $parent_section_title = $parent_section_title["title"];
else
    $parent_section_title = "";
if (isset($parent_section_name["name"]))
    $arResult["element"]["parent_section_name"] = $parent_section_name["name"];

$extra_text1 = $DBWORK->get_catalog_section_field_by_section_code($arResult["element"]["section_code"], "extra_text1");
if (isset($extra_text1["extra_text1"]))
    $arResult["element"]["extra_text1"] = $extra_text1["extra_text1"];
/* ?><pre><? var_dump($arResult) ?></pre><? */


if (isset($arResult["element"]["properties"]["com-port"]["value"]) and $arResult["element"]["properties"]["com-port"]["value"] != "") {
    $arResult["element"]["properties"]["com-port"]["value"] = str_replace("Built-in ", "", $arResult["element"]["properties"]["com-port"]["value"]);
}
if (isset($arResult["element"]["properties"]["dido-points"]["value"]) and $arResult["element"]["properties"]["dido-points"]["value"] != "") {
    $arResult["element"]["properties"]["dido-points"]["value"] = str_replace("Transistor", "Транзистор", $arResult["element"]["properties"]["dido-points"]["value"]);
    $arResult["element"]["properties"]["dido-points"]["value"] = str_replace("Relay", "Реле", $arResult["element"]["properties"]["dido-points"]["value"]);
    $arResult["element"]["properties"]["dido-points"]["value"] = str_replace("output", "", $arResult["element"]["properties"]["dido-points"]["value"]);
}
if (isset($arResult["element"]["properties"]["io-points"]["value"]) and $arResult["element"]["properties"]["io-points"]["value"] != "") {
    $arResult["element"]["properties"]["io-points"]["value"] = str_replace("Transistor", "Транзистор", $arResult["element"]["properties"]["io-points"]["value"]);
    $arResult["element"]["properties"]["io-points"]["value"] = str_replace("Relay", "Реле", $arResult["element"]["properties"]["io-points"]["value"]);
    $arResult["element"]["properties"]["io-points"]["value"] = str_replace("output", "", $arResult["element"]["properties"]["io-points"]["value"]);
}
if (isset($arResult["element"]["properties"]["do-type"]["value"]) and $arResult["element"]["properties"]["do-type"]["value"] != "") {
    $arResult["element"]["properties"]["do-type"]["value"] = str_replace("Transistor", "Транзистор", $arResult["element"]["properties"]["do-type"]["value"]);
    $arResult["element"]["properties"]["do-type"]["value"] = str_replace("Relay", "Реле", $arResult["element"]["properties"]["do-type"]["value"]);
}
if (isset($arResult["element"]["properties"]["dimension"]["value"])
        and $arResult["element"]["properties"]["dimension"]["value"] != "") {
    $arResult["element"]["properties"]["dimension"]["value"] = str_replace("mm", " мм", $arResult["element"]["properties"]["dimension"]["value"]);
}

if (isset($arResult["element"]["properties"]["execution-speed"]["value"]) and $arResult["element"]["properties"]["execution-speed"]["value"] != "") {
    $pos = strpos($arResult["element"]["properties"]["execution-speed"]["value"], "0.05");
    if ($pos !== false) {
        $arResult["element"]["properties"]["execution-speed"]["value"] = "Время исполнения инструкции 0.05 мкс";
    }
}
if (isset($arResult["element"]["properties"]["com-port"]["value"]) and $arResult["element"]["properties"]["com-port"]["value"] != "") {
    $arResult["element"]["properties"]["com-port"]["value"] = str_replace("*", "x", $arResult["element"]["properties"]["com-port"]["value"]);
}
if (isset($arResult["element"]["properties"]["com-port"]["value"]) and $arResult["element"]["properties"]["com-port"]["value"] != "") {
    $arResult["element"]["properties"]["com-port"]["value"] = str_replace("+", ", ", $arResult["element"]["properties"]["com-port"]["value"]);
}
if (isset($arResult["element"]["properties"]["com-port"]["value"]) and $arResult["element"]["properties"]["com-port"]["value"] != "") {
    $arResult["element"]["properties"]["com-port"]["value"] = str_replace(" port", "", $arResult["element"]["properties"]["com-port"]["value"]);
}






/* SEO */
global $TITLE, $KEYWORDS, $DESCRIPTION, $CANONICAL;
$CANONICAL = "";
if (isset($arguments["SEO"]["element_title"]) and $arguments["SEO"]["element_title"] != "") {
    $arguments["SEO"]["element_title"] = str_replace("#element_name#", $arResult["element"]["name"], $arguments["SEO"]["element_title"]);
    $arguments["SEO"]["element_title"] = str_replace("#section_title#", $parent_section_title, $arguments["SEO"]["element_title"]);
    $arguments["SEO"]["element_title"] = str_replace("#section_name#", $arResult["element"]["parent_section_name"], $arguments["SEO"]["element_title"]);
    $TITLE = $arguments["SEO"]["element_title"];

    if ($arResult["element"]["description"] != "")
        $TITLE = $arResult["element"]["description"];
    else
        $DESCRIPTION = "";

    if ($arResult["element"]["keywords"] != "")
        $TITLE = $arResult["element"]["keywords"];
    else
        $KEYWORDS = "";
}
if (isset($arResult["element"]["title"]) and $arResult["element"]["title"] != "") {
    global $TITLE;
    $TITLE = $arResult["element"]["title"];
}