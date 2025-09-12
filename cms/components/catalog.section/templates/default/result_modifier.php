<?php

/*
  catalog.section
 */
global $DBWORK;
$arResult = array();
//var_dump($arguments["filter"]);
$arResult["section"] = $DBWORK->get_list_catalog_section($arguments["filter"]);
/**/
$section_picture_preview = $DBWORK->get_catalog_section_field_by_section_code($arguments["section_code"], "picture_preview");
if (isset($section_picture_preview["picture_preview"]) and $section_picture_preview["picture_preview"] != "")
    $arResult["section_picture_preview"] = $section_picture_preview["picture_preview"];
/**/
$section_text_preview = $DBWORK->get_catalog_section_field_by_section_code($arguments["section_code"], "text_preview");
if (isset($section_text_preview["text_preview"]) and $section_text_preview["text_preview"] != "")
    $arResult["section_text_preview"] = $section_text_preview["text_preview"];
/* ?><pre><? var_dump($section_text_preview) ?></pre><? */
if (isset($arResult["section"]) and is_array($arResult["section"])) {
    foreach ($arResult["section"] as $key => $value) {
        $fields = $DBWORK->get_list_catalog_element_fields_by_id(Array("id" => $value["id"]));
        if (is_array($fields)) {
            $properties = array();
            foreach ($fields as $field) {
                if (isset($field["value"]["value_rus"]) and $field["value"]["value_rus"] != "")
                    $field_value = $field["value"]["value_rus"];
                elseif (isset($field["value"]["value"]))
                    $field_value = $field["value"]["value"];
                else
                    $field_value = "";

                $properties[$field["code"]] = array("name" => $field["name"], "value" => $field_value);
            }
            $value['properties'] = $properties;
        }
        $link = str_replace("#section_code#", $arguments["section_code"], $arguments["SEF"]["element"]);
        $value["link"] = str_replace("#element_code#", $value["code"], $link);
        if (isset($value["picture_preview"])) {
            if ($value["picture_preview"] == "") {
                $value["picture_preview"] = $arguments["path_to_images"] . 'models/small/' . $value["name"] . ".jpg";
            }
        } else {
            $value["picture_preview"] = $arguments["path_to_images"] . 'models/small/' . $value["name"] . ".jpg";
        }
        //var_dump($properties);
        $arResult["section"][$key] = $value;
    }
}

