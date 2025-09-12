<?php

global $APPLICATION;
global $DBWORK;

$arResult["element"] = $DBWORK->get_element_by_code_for_products_all($arguments["element_code"]);

$arResult["element"]["images"] = $DBWORK->get_gallery_images_for_products_all($arguments["element_code"]);

$arResult["element"]["files"] = $DBWORK->get_products_files($arguments["element_code"]);

 ?>



