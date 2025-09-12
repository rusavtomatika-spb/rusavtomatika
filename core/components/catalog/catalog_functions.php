<?php

class CoreComponentsCatalog{
    public static function get_current_component_from_query_string() {
        $route_params = array();
// 1 - section
// 2 - brand
// 3 - series
// 4 - detail

        $arrChunks = explode("/",ROUTE_STRING);
        $arrChunks = array_filter($arrChunks, static function($var){return $var !== "";} );
        $num_of_chunks = count($arrChunks);
        switch ($num_of_chunks){
            case 4:
                $component_name = "catalog_detail";
                break;
            case 3:
                $component_name = "catalog_series";
                break;
            case 2:
                $component_name = "catalog_brand";
                break;
            case 1:
                if (isset($_GET["component"]) and $_GET["component"] == 'catalog_detail' and isset($arrChunks[0])){
                    $route_params["detail"] = $arrChunks[0];
                    $component_name = "catalog_detail";
                }else{
                    $component_name = "catalog_section";
                }
                break;
            default:
                $arr_brands = ['weintek'.EX,'samkoon'.EX,'ifc'.EX,'aplex'.EX,'ewon'.EX,'faraday'.EX];
                $URL = trim(explode('?',$_SERVER['REQUEST_URI'])[0], "/");
                if($URL != 'catalog' and in_array($URL,$arr_brands)){
                    $component_name = "catalog_brand";
                    $route_params["brand"] = $URL;
                }else{
                    $component_name = "catalog";
                }
                break;
        }
        if (isset($arrChunks[0])) $route_params["section"] = $arrChunks[0];
        if (isset($arrChunks[1])) $route_params["brand"] = $arrChunks[1];
        if (isset($arrChunks[2])) $route_params["series"] = $arrChunks[2];
        //if (isset($arrChunks[3])) $route_params["detail"] = $arrChunks[3];


        return array("component_name" => $component_name, "component_route_params" => $route_params);
    }
}
