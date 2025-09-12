<?php

CoreApplication::add_style(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/style.css");
CoreApplication::add_script(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/newslist_discounted_scripts.js");

global $TITLE;
$TITLE = "Неликвиды, уцененные товары, распродажа неликвидов, АКЦИЯ, Панели оператора, Панельные компьютеры, Промышленные компьютеры full IP65, Встраиваемые компьютеры, Промышленные мониторы, VPN-роутеры, Контроллеры (PLC), Модули ввода-вывода, Блоки питания";
CoreApplication::add_breadcrumbs_chain("Уцененные товары", "/discounted/");
?>
<style>
    [v-cloak] {
        display: none;
    }
</style>
<div id="vue_app_discounted">
    <div style="display: none" id="prerendered_content">
        <?
        include 'functions.php';
        $rows = get_rows_from_table("discounted", "", "`show` = '1'", "position");
        ?>
        <div class="component_newslist">
            <div class="component_wrapper">
                <div class="row">
                    <div class="all_buttons"></div>
                    <div class="col-md-12"><h1 style="margin:0 auto 30px; text-align: center">Уцененные товары,
                            распродажа неликвидов, АКЦИЯ!</h1></div>
                    <? foreach ($rows as $product_item): ?>
                        <div class="col-md-6 discount_item">
                            <div class="item">
                                <div class="preview_image_wrapper">
                                    <a href="<?= $product_item["link"] ?>">
                                        <div class="preview_image"
                                             style="background-image: url('<?= $product_item["preview_picture"] ?>'"></div>
                                        <span class="price"><?= $product_item["price"] ?><span
                                                    class="rub">Р</span></span>
                                    </a>
                                </div>
                                <div>
                                    <div class="title">
                                        <a href="<?= $product_item["link"] ?>"><?= $product_item["section"] ?> <?= $product_item["brand"] ?> <?= $product_item["model"] ?></a>
                                    </div>
                                    <hr>
                                    <div class="text"><?= $product_item["name"] ?></div>
                                    <div class="item_buttons">
                                        <a target="_blank" class="detail_link" href="<?= $product_item["link"] ?>">Описание
                                            товара</a>
                                        <span class="button_order"
                                              idm="Уцененный товар <?= $product_item["brand"] ?> <?= $product_item["model"] ?>"
                                              onclick="show_backup_call(2,'Уцененный товар <?= $product_item["brand"] ?> <?= $product_item["model"] ?>')">Заказать</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <? endforeach; ?>
                </div>
            </div>
        </div>


    </div>
    <div class="component_newslist" v-cloak>
        <?
        CoreApplication::include_component(array("component"=> "breadcrumbs"));
        ?>
        <div class="component_wrapper" v-cloak>
            <div class="row">
                <div class="col-md-12"><h1 style="margin:0 auto 30px; text-align: center">Уцененные товары, распродажа
                        неликвидов, АКЦИЯ!</h1></div>
                <div class="all_buttons">
                    <div class="col-md-12">
                        <div class="component_newslist_buttons_panel">
                        <span @click="select_brand(brand_item)"
                              :key="brand_index"
                              :class="['discount_brand_item', {'active': brand_item.active}]"
                              v-for="(brand_item, brand_index) in arr_brands">
                            {{brand_item.name}}
                        </span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="component_newslist_buttons_panel">
                    <span @click="select_category(categories_item)"
                          :key="categories_index"
                          :class="['discount_categories_item', {'active': categories_item.active}]"
                          v-for="(categories_item, categories_index) in arr_categories">
                        {{categories_item.name}}
                    </span>
                        </div>
                    </div>
                </div>
                <div :key="product_index"
                     :class="['col-md-6 discount_item', {'active': product_item.active}]"
                     v-for="(product_item, product_index) in arr_filtered_items">
                    <div class="item">
                        <div class="preview_image_wrapper">
                            <a :href="product_item.link">
                                <div class="preview_image"
                                     :style="{ backgroundImage: 'url(' + product_item.preview_picture + ')' }"></div>
                                <span class="price">{{product_item.price}} <span class="rub">Р</span></span>
                            </a>
                        </div>
                        <div>
                            <div class="title">
                                <a :href="product_item.link">{{product_item.section}} {{product_item.brand}}
                                    {{product_item.model}}

                                </a>
                            </div>
                            <hr>
                            <div class="text">{{product_item.name}}</div>
                            <div class="item_buttons">
                                <a target="_blank" class="detail_link" :href="product_item.link">Описание товара</a>
                                <span class="button_order"
                                      :idm="'Уцененный товар ' + product_item.brand + ' ' + product_item.model"
                                      @click="show_backup_call('Уцененный товар ' + product_item.brand + ' ' + product_item.model)">Заказать</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<?
CoreApplication::include_component(array("component" => "form_require_price", "template" => "default",));
?>