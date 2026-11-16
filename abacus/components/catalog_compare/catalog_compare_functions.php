<?php
global $arResult;

require_once $_SERVER["DOCUMENT_ROOT"] . '/abacus/database/Core_database_products_all.php';

if (isset($_GET['models']) and $_GET['models'] != '') {
    $str_models = urldecode($_GET['models']);
    $pattern = '/[^a-zA-Z-\d\,\(\)]/';
    $str_models = preg_replace($pattern, '', $str_models);
    $arr_models = explode(',', $str_models);
    $arr_products = ($arr_models);
} elseif (isset($_COOKIE["box2_compare"]) and $_COOKIE["box2_compare"] != '') {
    $arr_products = (explode(',', trim($_COOKIE["box2_compare"], ", ")));
}

global $arr_model_collection;
$arr_model_collection = [];
if (isset($arr_products) and is_array($arr_products) and count($arr_products) > 0) {
    foreach ($arr_products as $item) {
        $cur_item = Core_database_products_all::get_element($item);
        if (isset($cur_item["index"]) and $cur_item["index"] != '') {
            $arResult["ITEMS"][] = $cur_item;
            $arr_model_collection[] = $cur_item["model"];
        }
    }

    $arr_model_collection = array_reverse($arr_model_collection);

    if(count($arr_model_collection)>0){
        setcookie('box2_compare', implode(',',$arr_model_collection) , time() + 60 * 60 * 24 * 365, "/", $_SERVER['SERVER_NAME'], 0);
    }
}