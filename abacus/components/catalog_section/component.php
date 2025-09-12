<?php

//echo "COMPONENT SECTION";

if (!(isset($arguments["template_section_detail"]) and $arguments["template_section_detail"] != "")){
    $arguments["template_section_detail"] = "default";
}
$arguments["template"] = $arguments["template_section_detail"];
$arguments["component"] = "catalog_section";


if(isset($arguments["component_route_params"]["section"])){
    switch ($arguments["component_route_params"]["section"]){
        case "search":
            $arguments["component"] = "catalog_search";
            $arguments["template"] = "default";
            CoreApplication::include_component($arguments);
            break;

        case "favorites":
            $arguments["component"] = "catalog_favorites";
            $arguments["template"] = "default";
            CoreApplication::include_component($arguments);
            break;
        case "cart":
            $arguments["component"] = "catalog_cart";
            $arguments["template"] = "default";
            CoreApplication::include_component($arguments);
            break;
        case "viewed":
            $arguments["component"] = "catalog_viewed";
            $arguments["template"] = "default";
            CoreApplication::include_component($arguments);
            break;
        case "compare":
            $arguments["component"] = "catalog_compare";
            $arguments["template"] = "default";
            CoreApplication::include_component($arguments);
            break;
        default:
            CoreApplication::include_template($arguments);
            break;
    }
}









