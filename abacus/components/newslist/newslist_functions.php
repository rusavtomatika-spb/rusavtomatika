<?php

class CoreComponentsNewslist{

    public static function get_current_component_from_query_string($query_string) {

        $route_params = array();

        $arrChunks = explode("/",$query_string);
        $arrChunks = array_filter($arrChunks, static function($var){return $var !== "";} );
        $num_of_chunks = count($arrChunks);

        switch ($num_of_chunks){
            case 1:
                $component_name = "newslist_detail";
                break;
            default:
                $component_name = "newslist";
                break;
        }

        if (isset($arrChunks[0])) $route_params["detail"] = $arrChunks[0];

        return array("component_name" => $component_name, "component_route_params" => $route_params);
    }

}