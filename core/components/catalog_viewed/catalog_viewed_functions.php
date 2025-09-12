<?php
global $arResult;

require_once $_SERVER["DOCUMENT_ROOT"] . '/core/database/Core_database_products_all.php';

if (isset($_COOKIE['box2_viewed']) and $_COOKIE['box2_viewed'] != '') {
    $arr_products = array_reverse(explode(',', trim($_COOKIE['box2_viewed'],", ")));
}


if (isset($arr_products) and is_array($arr_products) and count($arr_products) > 0) {
    foreach ($arr_products as $item) {
        $arResult["ITEMS"][] = Core_database_products_all::get_element($item);
    }


}




