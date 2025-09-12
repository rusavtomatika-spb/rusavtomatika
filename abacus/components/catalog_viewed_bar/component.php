<?php
// $arguments
// ["route_string"]
// ["template_core_component"]
// ["template_sections_list"]
// ["template_section_detail"]
// ["template_elements_list"]
// ["template_element_detail"]

require_once "catalog_viewed_bar_functions.php";
$arguments["component"] = "catalog_viewed_bar";
$arguments["template"] = "default";

$arguments["viewed_products"] = [];
if(isset($arr_viewed_products["ITEMS"])){
    $arguments["viewed_products"] = $arr_viewed_products["ITEMS"];
}

CoreApplication::include_template($arguments);

