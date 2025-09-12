<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/abacus/database/Core_database_products_all.php';
if (isset($_COOKIE['box2_viewed']) and $_COOKIE['box2_viewed'] != '') {
    $arr_viewed_models = array_reverse(explode(',', trim($_COOKIE['box2_viewed'], ", ")));
    if (isset($arr_viewed_models) and is_array($arr_viewed_models) and count($arr_viewed_models) > 0) {

        foreach ($arr_viewed_models as $item) {
            $arr_item = Core_database_products_all::get_element($item);
            $arr_viewed_products["ITEMS"][] = $arr_item;
        }
    }
}
