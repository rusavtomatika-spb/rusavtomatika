<?php
global $arSettings;
$arSettings['path_to_product_images'] = '/images/';
CoreApplication::add_style(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/style.css");
CoreApplication::add_script(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/script.js");

global $arResult;
global $TITLE;
global $H1;
global $DESCRIPTION;
$TITLE = "Избранное - Русавтоматика";
$H1 = "Избранное";
$DESCRIPTION = "Избранное | Русавтоматика. Официальный дистрибьютор в РФ. Оптимальная цена. Бесплатная доставка в регионы, гарантия, техподдержка.";

CoreApplication::add_breadcrumbs_chain("Избранное");
$series["products"] = $arResult["ITEMS"];
?>
<div class="catalog_favorites">
    <div class="row">
        <div class="col-lg-12">
            <?
            CoreApplication::include_component(array("component" => "breadcrumbs"));
            ?>
            <h1><?= $H1 ?></h1><br>
            <div class="component_catalog_section__panel_of_products">
                <div class="view-mode-list" id="vue_app_component_favorites">
                    <?
                    include __DIR__ . "/inc_template_list_of_products_list.php";
                    ?>
                </div>
            </div>
        </div>
        <?php if(!empty($arResult["ITEMS"]) && is_array($arResult["ITEMS"])) { ?>
            <div class="col-lg-12">
                <div class="catalog_favorites__button_clearall_wrapper">
                    <div class="catalog_favorites__button_clearall">Очистить список <i class="fa-solid fa-circle-xmark fa-lg"></i></div>
                </div>
            </div>
        <?php }?>
    </div>
</div>