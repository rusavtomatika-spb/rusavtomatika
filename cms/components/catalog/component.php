<?php

if (!defined('cms'))
    exit;
global $APPLICATION;


if ($template)
    $tmpl = $template;
else
    $tmpl = "default";


switch ($arguments["current_component"]) {
    case "element":
        global $DBWORK;
        $template_element = $DBWORK->get_catalog_section_field_by_section_code($arguments["section_code"], "template_element");

        if (isset($template_element["template_element"])) {
            if ($template_element["template_element"] != "") {
                $tmpl = $template_element["template_element"];
            } else {
                $tmpl = "default";
            }
        } else {
            $tmpl = "default";
        }
        if ($template == "weintek-ir")
            $tmpl = "weintek-ir";
        if ($template == "monitors_aplex")
            $tmpl = "monitors_aplex";
        if ($template == "box-pc-aplex")
            $tmpl = "box-pc-aplex";
        if ($template == "router-md")
            $tmpl = "router-md";
        if ($template == "accessories_all_products")
            $tmpl = "accessories_all_products";


        $APPLICATION->IncludeComponent("catalog.element", $tmpl, $arguments);
        break;
    default:
        $APPLICATION->IncludeComponent("catalog.section.list", $tmpl, $arguments);
        break;
}

