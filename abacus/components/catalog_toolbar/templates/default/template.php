<?php

CoreApplication::add_style(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/style.css");
CoreApplication::add_script(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/script.js");

$currentType = isset($_GET['type']) ? $_GET['type'] : 'all';
$typeLabels = array(
    'all' => 'везде',
    'products' => 'по товарам',
    'articles' => 'по статьям'
);
$currentTypeLabel = isset($typeLabels[$currentType]) ? $typeLabels[$currentType] : 'везде';

?>
<div class="catalog_toolbar_wrapper">
    <div class="catalog_toolbar" style="opacity: 0">
    <div class="container is-widescreen">
                <div class="catalog_toolbar__wrapper">
                    <div class="catalog_toolbar__item_group">
                            <a href="/catalog/">
                                <div class="button is-success is-small-mobile"><span class="icon_hamburger"></span>Каталог</div>
                            </a>
                            <span class="open_pop_catalog"></span>
                        <?
                        CoreApplication::include_component(array("component" => "catalog_pop_menu"));
                        ?>
                        <?
                        CoreApplication::include_component(array(
                            "component" => "catalog_search_portable",
                            "template"  => "default",
                        ));
                        ?>
                    </div>
                    <div class="catalog_toolbar__item_group">
                        <a class="catalog_toolbar__item compare" href="/catalog/compare/">
                           <span class="fa-solid fa-align-right fa-rotate-90"></span>&nbsp;<span class="catalog_toolbar__item_text">Сравнение</span><span class="catalog_toolbar__item_number"></span>
                        </a>
                        <a class="catalog_toolbar__item favorites" href="/catalog/favorites/">
                            <span class="fa-solid fa-heart"></span>&nbsp;<span class="catalog_toolbar__item_text">Избранное</span><span class="catalog_toolbar__item_number"></span>
                        </a>
                        <a class="catalog_toolbar__item cart" href="/catalog/cart/">
                            <span class="fa-solid fa-cart-shopping"></span>&nbsp;<span class="catalog_toolbar__item_text">Корзина</span><span class="catalog_toolbar__item_number"></span>
                        </a>
                    </div>
                </div>
    </div>
    <div class="catalog_toolbar__dialog_wrapper"><div class="catalog_toolbar__dialog"><div class="title"></div><div class="question"></div><div class="buttons"><div class="button button_confirm"></div><div class="button button_cancel"></div></div></div></div>
    </div>
</div>