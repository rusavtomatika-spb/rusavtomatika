<?php
require_once "newslist_functions.php";
$arrCurrent_component = CoreComponentsNewslist::get_current_component_from_query_string($arguments["route_string"]);
if (isset($arrCurrent_component["component_route_params"])) $arguments["component_route_params"] = $arrCurrent_component["component_route_params"];
$arguments["template"] = (isset($arguments["template"])?$arguments["template"]:"default");
$arguments["component"] = $arrCurrent_component["component_name"];
switch ($arrCurrent_component["component_name"]){
    case "newslist":
        CoreApplication::include_template($arguments);
        break;
    default :
        CoreApplication::include_component($arguments);
        break;
}
