<?php
global $arResult;

require_once $_SERVER["DOCUMENT_ROOT"] . '/core/database/Core_database_products_all.php';


if (isset($_GET['models']) and $_GET['models'] != '') {
    $str_models = urldecode($_GET['models']);
    $str_models = iconv('UTF-8//IGNORE', 'windows-1251//IGNORE', $str_models);
    $pattern = '/[^a-zA-Z-\d\,]/';
    $str_models = preg_replace($pattern, '', $str_models);
    //$arr_products = array_reverse(explode(',', $str_models));
    $arr_models = explode(',', $str_models);
    //$arr_products = array_reverse($arr_models);
    $arr_products = ($arr_models);
/*    var_dump_pre($arr_models);
    var_dump_pre($arr_products);*/
} elseif (isset($_COOKIE["box2_compare"]) and $_COOKIE["box2_compare"] != '') {
//    $arr_products = array_reverse(explode(',', trim($_COOKIE["box2_compare"], ", ")));
    $arr_products = (explode(',', trim($_COOKIE["box2_compare"], ", ")));

}

global $arr_model_collection;
$arr_model_collection = [];
if (isset($arr_products) and is_array($arr_products) and count($arr_products) > 0) {
    //var_dump_pre($arr_products);
    foreach ($arr_products as $item) {
        $cur_item = Core_database_products_all::get_element($item);
      //  var_dump_pre($cur_item["model"]);
        if (isset($cur_item["index"]) and $cur_item["index"] != '') {
            $arResult["ITEMS"][] = $cur_item;
            $arr_model_collection[] = $cur_item["model"];
        }
    //    var_dump_pre($arr_model_collection);
    }

    $arr_model_collection = array_reverse($arr_model_collection);

    if(count($arr_model_collection)>0){
        setcookie('box2_compare', implode(',',$arr_model_collection) , time() + 60 * 60 * 24 * 365, "/", $_SERVER['SERVER_NAME'], 0);
    }
}




