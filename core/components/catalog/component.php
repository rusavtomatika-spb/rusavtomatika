<?php
// $arguments
// ["route_string"]
// ["template_core_component"]
// ["template_sections_list"]
// ["template_section_detail"]
// ["template_elements_list"]
// ["template_element_detail"]
require_once "catalog_functions.php";
$arrCurrent_component = CoreComponentsCatalog::get_current_component_from_query_string();

if (isset($arrCurrent_component["component_route_params"])) $arguments["component_route_params"] = $arrCurrent_component["component_route_params"];
$arguments["component"] = $arrCurrent_component["component_name"];
$arguments["template"] = isset($arguments["template"])?$arguments["template"]:"default";

switch ($arguments["component"]){
    case "catalog":
        CoreApplication::include_template($arguments);
        break;
    default :
        CoreApplication::include_component($arguments);
        break;
}
