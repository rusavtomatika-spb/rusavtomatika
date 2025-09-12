<?php

if (!defined('cms'))
    exit;
global $APPLICATION;
//$arguments["current_component"];

switch ($arguments["current_component"]) {
    case "element":
        global $DBWORK;
        $tmpl = "default";
        $template_element = $DBWORK->get_catalog_section_field_by_section_code($arguments["section_code"], "template_element");
        if (isset($template_element["template_element"])) {
            if ($template_element["template_element"] == "") {
                $tmpl = "default";
            } else {
                $tmpl = $template_element["template_element"];
            }
        }
        $APPLICATION->IncludeComponent("news.element", $tmpl, $arguments);
        break;
    default:
        if (isset($template_element["template_list"])) {
            if ($template_element["template_list"] == "") {
                $tmpl = "default";
            } else {
                $tmpl = $template_element["template_list"];
            }
        } else $tmpl = "default";

        $APPLICATION->IncludeComponent("news.list", $tmpl, $arguments);
        break;
}
