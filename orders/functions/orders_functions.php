<?php

abstract class  Aplication{
    static function showPanel(){
        $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
        switch ($uri_parts[0]){
            case "/orders/products/":
                include $_SERVER['DOCUMENT_ROOT'].'/orders/template/component_templates/control_panel_products.php';
                break;
            default:
                include $_SERVER['DOCUMENT_ROOT'].'/orders/template/component_templates/control_panel.php';
                break;
        }
    }
}

