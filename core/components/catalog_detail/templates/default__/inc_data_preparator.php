<?php
require_once __DIR__ . '/inc_template_detail_functions.php';
require_once __DIR__ . "/inc_functions_linked_products.php";
require_once __DIR__ . "/inc_prepare_link_advanced_search.php";

$arResult = array(
    "model" => $arguments["component_route_params"]["detail"],
);


$product = CoreApplication::get_rows_from_table("`products_all`", "*", "model = '{$arResult["model"]}'", "", 1)[0];
$arrSection = CoreApplication::get_rows_from_table("catalog_sections", "", "FIND_IN_SET('" . $product["type"] . "', product_types)>0")[0];
$arr_product_types = CoreApplication::get_rows_from_table("`catalog_types`", "*", "code = '{$product["type"]}' and series = '{$product["series"]}'", "");
if(count($arr_product_types)>0){
    $product_type = $arr_product_types[0];
}else {
    $arr_product_types = CoreApplication::get_rows_from_table("`catalog_types`", "*", "code = '{$product["type"]}'", "");
    $product_type = $arr_product_types[0];
}


$template_h1 = $product_type["template_h1"];
$template_title = $product_type["template_title"];
$product_type_genitive_case = $product_type["genitive_case"];

global $TITLE;
global $H1;


if (isset($product["title"]) and $product["title"] != '') {
    $TITLE = $product["title"];
} else {
    $template_title = str_replace('#model#', $product["model"], $template_title);
    $template_title = str_replace('#brand#', $product["brand"], $template_title);
    if ($product["diagonal"] != '') {
        $template_title = str_replace('#diagonal#', $product["diagonal"] . "&Prime;", $template_title);
    }
    $TITLE = $template_title;
}

$template_h1 = str_replace('#model#', $product["model"], $template_h1);
$template_h1 = str_replace('#brand#', $product["brand"], $template_h1);
if ($product["diagonal"] != '') {
    $template_h1 = str_replace('#diagonal#', $product["diagonal"] . "&Prime;", $template_h1);
}


$H1 = $template_h1;
