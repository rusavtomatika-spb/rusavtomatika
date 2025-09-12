<?php

/*
  catalog.section
 */
global $DBWORK;
$arResult = array();
//var_dump($arguments["filter"]);
$arResult = $DBWORK->get_list_catalog_section($arguments["filter"], "products_all", " ORDER BY `view_order` ASC ");

foreach ($arResult as $key => $element) {
    $arResult[$key]["images"] = $DBWORK->get_gallery_images_for_products_all($element["model"]);
    $making_page_url = $arguments["SEF"]["element"];
    $making_page_url = str_replace("#section_code#", $element["series"], $making_page_url);
    $making_page_url = str_replace("#element_code#", $element["model"], $making_page_url);
    $arResult[$key]["page_url"] = $making_page_url;
}


/**/
