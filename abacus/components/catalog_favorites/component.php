<?php
// $arguments
// ["route_string"]
// ["template_core_component"]
// ["template_sections_list"]
// ["template_section_detail"]
// ["template_elements_list"]
// ["template_element_detail"]

require_once "catalog_favorites_functions.php";
$arguments["component"] = "catalog_favorites";
$arguments["template"] = "default";
CoreApplication::include_template($arguments);

