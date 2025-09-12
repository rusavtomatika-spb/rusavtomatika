<?php
global $arResult;

require_once $_SERVER["DOCUMENT_ROOT"] . '/core/database/Core_database_products_all.php';

if (isset($_COOKIE["box2_cart"])) {
    $arr_products = array_reverse(explode(',', trim($_COOKIE["box2_cart"],", ")));

}
if (isset($_COOKIE["box_cart_quantities"])) {
    $arr_cookie_products_qty = json_decode($_COOKIE["box_cart_quantities"]);
    foreach ($arr_cookie_products_qty as $item){
        $arr_products_qty[$item->model] = $item->qty;
    }
}
if (isset($arr_products) and is_array($arr_products) and count($arr_products) > 0) {
    foreach ($arr_products as $item) {
        $item = Core_database_products_all::get_element($item);
        if(isset($item["model"]) and $item["model"] != ''){
            if(isset($arr_products_qty) and isset($arr_products_qty[$item["model"]])){
                $item["qty"] =$arr_products_qty[$item["model"]];
            }
            $arResult["ITEMS"][] = $item;
        }
    }
}




