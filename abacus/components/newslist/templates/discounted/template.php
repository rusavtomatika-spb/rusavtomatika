<?php

CoreApplication::add_style(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/style.css");
CoreApplication::add_script(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/newslist_discounted_scripts.js");

global $TITLE, $CANONICAL, $DESCRIPTION;
$TITLE = "Неликвиды, уцененные товары, распродажа неликвидов, АКЦИЯ, Панели оператора, Панельные компьютеры, Промышленные компьютеры full IP65, Встраиваемые компьютеры, Промышленные мониторы, VPN-роутеры, Контроллеры (PLC), Модули ввода-вывода, Блоки питания";
$CANONICAL = "https://www.rusavtomatika.com/sale/discounted/";
$DESCRIPTION = "Каталог уценённых товаров, цены, фотографии, описание уценки. Покупайте со скидкой уценённые товары в интернет-магазине rusavtomatika.com";
CoreApplication::add_breadcrumbs_chain("Уцененные товары", "/sale/discounted/");

include 'functions.php';
$rows = get_rows_from_table("discounted", "", "`show` = '1'", "position");
?>
<style>
    [v-cloak] {
        display: none;
    }
</style>

<noscript>
    <div class="component_newslist">
        <div class="component_wrapper">
            <div class="row">
                <div class="col-md-12"><h1 style="margin:0 auto 30px; text-align: center">Уцененные товары, распродажа неликвидов, АКЦИЯ!</h1></div>
                <? foreach ($rows as $product_item): ?>
                    <div class="col-md-6 discount_item">
                        <div class="item">
                            <div class="preview_image_wrapper">
                                <a href="/sale/discounted/<?= $product_item["seo_url"] ?>/">
                                    <div class="preview_image" style="background-image: url('<?= $product_item["preview_picture"] ?>')"></div>
                                    <span class="price"><?= $product_item["price"] ?> <span class="rub">Р</span></span>
                                </a>
                            </div>
                            <div>
                                <div class="title">
                                    <a href="/sale/discounted/<?= $product_item["seo_url"] ?>/"><?= $product_item["section"] ?> <?= $product_item["brand"] ?> <?= $product_item["model"] ?></a>
                                </div>
                                <hr>
                                <div class="text"><?= $product_item["name"] ?></div>
                                <div class="item_buttons">
                                    <a href="/sale/discounted/<?= $product_item["seo_url"] ?>/">Описание товара</a>
                                    <span class="button_order" onclick="show_backup_call(2,'Уцененный товар <?= $product_item["brand"] ?> <?= $product_item["model"] ?>')">Заказать</span>
                                </div>
                            </div>
                        </div>
                    </div>
                <? endforeach; ?>
            </div>
        </div>
    </div>
</noscript>

<div id="vue_app_discounted" class="discounted-wrapper">
    <div id="backup_call" style="display: none;">
        <button onclick="backup_call_hide()" class="close__btn">
            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0 0 50 50">
                <path d="M 7.71875 6.28125 L 6.28125 7.71875 L 23.5625 25 L 6.28125 42.28125 L 7.71875 43.71875 L 25 26.4375 L 42.28125 43.71875 L 43.71875 42.28125 L 26.4375 25 L 43.71875 7.71875 L 42.28125 6.28125 L 25 23.5625 Z"></path>
            </svg>
        </button>
        <div class="backup_call_block_phoneNumber">
            <h3 id="backup_call_h"></h3>
            <div class="discounted__form-actions">
                <input type="text" name="phone" placeholder="Номер телефона (например, 79123456789)" class="phone__form-input">
                <button class="btn_send" onclick="backup_call_go()">Отправить</button>
            </div>
        </div>
        <div id="backup_call_message"></div>
    </div>
    
    <div class="component_newslist">
        <? CoreApplication::include_component(array("component"=> "breadcrumbs")); ?>
        <div class="component_wrapper">
            <div class="row">
                <div class="col-md-12"><h1 style="margin:0 auto 30px; text-align: center">Уцененные товары, распродажа неликвидов, АКЦИЯ!</h1></div>
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
                            <a :href="'/sale/discounted/' + (product_item.seo_url || product_item.model) + '/'">
                                <div class="preview_image" :style="{ backgroundImage: 'url(' + product_item.preview_picture + ')' }"></div>
                                <span class="price">{{product_item.price}} <span class="rub">Р</span></span>
                            </a>
                        </div>
                        <div>
                            <div class="title">
                                <a :href="'/sale/discounted/' + (product_item.seo_url || product_item.model) + '/'">{{product_item.section}} {{product_item.brand}} {{product_item.model}}</a>
                            </div>
                            <hr>
                            <div class="text">{{product_item.name}}</div>
                            <div class="item_buttons">
                                <a class="detail_link" :href="'/sale/discounted/' + (product_item.seo_url || product_item.model) + '/'">Описание товара</a>
                                <span class="button_order"
                                      :idm="'Уцененный товар ' + product_item.brand + ' ' + product_item.model"
                                      @click="show_backup_call('Уцененный товар ' + product_item.brand + ' ' + product_item.model)">
                                    Заказать
                                </span>
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