<?php

CoreApplication::add_style(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/style.css");
CoreApplication::add_script(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/script.js");

global $TITLE, $CANONICAL, $DESCRIPTION, $usd_currency;
$TITLE = "Распродажа | Акции и скидки | Русавтоматика";
$CANONICAL = "https://www.rusavtomatika.com/sale/";
$DESCRIPTION = "Акционные товары, распродажа, товары со скидкой. Покупайте со скидкой в интернет-магазине rusavtomatika.com";
CoreApplication::add_breadcrumbs_chain("Распродажа", "/sale/");

include 'functions.php';
$rows = get_rows_from_table("products_all", "", "`action_price` IS NOT NULL AND `action_price` != '' AND `action_price` > 0", "");
?>
<style>
    [v-cloak] {
        display: none;
    }
    
    .sale__items-wrapper {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }
    
    .sale__items-wrapper .item {
        width: calc(50% - 10px);
        display: flex;
        gap: 20px;
        border: 1px solid #eee;
        padding: 15px;
        border-radius: 8px;
        transition: box-shadow 0.3s;
        position: relative;
    }
    
    .sale__items-wrapper .item:hover {
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .sale__items-wrapper .preview_image_wrapper {
        width: 150px;
        flex-shrink: 0;
        display: block;
    }
    
    .sale__items-wrapper .preview_image_wrapper img {
        width: 100%;
        height: auto;
        object-fit: contain;
    }
    
    .sale__items-wrapper .item__description {
        flex: 1;
    }
    
    .sale__items-wrapper .description__header-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 10px;
    }
    
    .sale__items-wrapper .description__header-wrapper > a {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        text-decoration: none;
    }
    
    .sale__items-wrapper .description__header-wrapper > a:hover {
        color: #00ad61;
    }
    
    .sale__items-wrapper .price-wrapper {
        text-align: right;
    }
    
    .sale__items-wrapper .actual__price-wrapper {
        white-space: nowrap;
    }
    
    .sale__items-wrapper .price_usd_value {
        font-size: 20px;
        font-weight: bold;
        color: #00ad61;
    }
    
    .sale__items-wrapper .price_usd_currency {
        font-size: 18px;
        font-weight: bold;
        color: #00ad61;
    }
    
    .sale__items-wrapper .old_price {
        text-decoration: line-through;
        color: #999;
        font-size: 14px;
        margin-left: 10px;
        font-weight: normal;
    }
    
    .sale__items-wrapper .price_rub_value {
        font-size: 14px;
        color: #666;
        display: block;
    }
    
    .sale__items-wrapper .preview_text {
        color: #666;
        font-size: 14px;
        margin: 5px 0;
    }
    
    .sale__items-wrapper .preview_text_extra {
        font-size: 13px;
        color: #888;
    }
    
    .sale__items-wrapper .td_onstock {
        margin: 5px 0;
    }
    
    .sale__items-wrapper .green {
        color: #00ad61;
        font-size: 13px;
        font-weight: 500;
    }
    
    .sale__items-wrapper .red {
        color: #e00;
        font-size: 13px;
        font-weight: 500;
    }
    
    .sale__items-wrapper .item_buttons {
        display: flex;
        gap: 15px;
        margin-top: 10px;
        align-items: center;
        flex-wrap: wrap;
    }
    
    .sale__items-wrapper .item_buttons a {
        color: #00ad61;
        text-decoration: none;
    }
    
    .sale__items-wrapper .item_buttons a:hover {
        text-decoration: underline;
    }
    
    .sale__items-wrapper .button_order {
        background: #00ad61;
        color: white;
        padding: 5px 15px;
        border-radius: 3px;
        cursor: pointer;
        transition: background 0.3s;
        border: none;
    }
    
    .sale__items-wrapper .button_order:hover {
        background: #008c4e;
    }
    
    .td_quantity {
        display: inline-block;
        margin-right: 15px;
    }
    
    .quantity {
        display: flex;
        align-items: center;
        gap: 5px;
    }
    
    .quantity_button_minus, 
    .quantity_button_plus {
        width: 25px;
        height: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f0f0f0;
        border: 1px solid #ddd;
        cursor: pointer;
        user-select: none;
        border-radius: 3px;
        font-weight: bold;
    }
    
    .quantity_button_minus:hover, 
    .quantity_button_plus:hover {
        background: #e0e0e0;
    }
    
    .quantity_value {
        width: 50px;
        text-align: center;
        border: 1px solid #ddd;
        border-radius: 3px;
        padding: 4px;
    }
    
    @media (max-width: 768px) {
        .sale__items-wrapper .item {
            width: 100%;
            flex-direction: column;
        }
        
        .sale__items-wrapper .preview_image_wrapper {
            width: 100%;
            text-align: center;
        }
        
        .sale__items-wrapper .preview_image_wrapper img {
            max-width: 200px;
        }
        
        .sale__items-wrapper .description__header-wrapper {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .sale__items-wrapper .price-wrapper {
            text-align: left;
        }
    }
</style>

<div class="component_newslist">
    <? CoreApplication::include_component(array("component"=> "breadcrumbs")); ?>
    <div class="component_wrapper">
        <div class="row">
            <div class="col-md-12">
                <h1 style="margin:0 auto 30px; text-align: center">Распродажа, акции и скидки!</h1>
            </div>
            
            <div class="sale__items-wrapper" id="vue_sale_wrapper">
                <? foreach ($rows as $product_item): ?>
                    <?php
                    $seo_url = $product_item["model"];
                    
                    $brand = strtolower($product_item["brand"]);
                    $type = $product_item["type"];
                    $model = $product_item["model"];
                    $size = "580";
                    
                    $preview_picture = "/images/{$brand}/{$type}/{$model}/{$size}/{$model}_1.webp";
                    $product_name = !empty($product_item["s_name"]) ? $product_item["s_name"] : $product_item["model"];
                    
                    $onstock = ($product_item["onstock_spb"] > 0 || $product_item["onstock_msk"] > 0);
                    $qty = isset($product_item["qty"]) && $product_item["qty"] > 1 ? $product_item["qty"] : 1;
                    
                    $preview_text = !empty($product_item["preview_text"]) ? $product_item["preview_text"] : "";
                    $preview_text_extra = !empty($product_item["preview_text_extra"]) ? $product_item["preview_text_extra"] : "";
                    ?>
                    <div class="item" data-model="<?= $product_item["model"] ?>">
                        <a href="/<?= $brand ?>/<?= $model ?>/" class="preview_image_wrapper">
                            <img src="<?= $preview_picture ?>" alt="<?= $product_item["model"] ?>">
                        </a>
                        
                        <div class="item__description">
                            <div class="item__text-wrapper">
                                <a href="/<?= $brand ?>/<?= $model ?>/" class="item__title">
                                    <?= $product_item["brand"] ?> <?= $product_item["model"] ?>
                                </a>

                                <? if (!empty($preview_text)): ?>
                                    <div class="preview_text">
                                        <?= $preview_text ?>
                                        <? if (!empty($preview_text_extra)): ?>
                                            <span class="preview_text_extra"><?= $preview_text_extra ?></span>
                                        <? endif; ?>
                                    </div>
                                <? endif; ?>
                                
                                <p style="margin: 0;">Серия: <span class="tag mr-1"><?= htmlspecialchars($product_name) ?></span></p>
                            </div>
                            
                            <div class="item__info-wrapper">
                                <div class="td_onstock" style="margin: 0;">
                                    <? if ($onstock): ?>
                                        <span class="green">В наличии</span>
                                    <? else: ?>
                                        <span class="red">Под заказ</span>
                                    <? endif; ?>
                                </div>

                                <div class="price-wrapper">
                                    <div class="actual__price-wrapper">
                                        <? if ($product_item["currency"] == 'USD'): ?>
                                            <div class="current__price-wrapper">
                                                <span class="price_usd_value"><?= number_format($product_item["retail_price"], 0, '', ' ') ?> $</span>
                                                <span class="old_price"><?= number_format($product_item["action_price"], 0, '', ' ') ?> $</span>
                                            </div>
                                            <? if(isset($usd_currency) && $usd_currency > 0): ?>
                                                <span class="price_rub_value" style="font-size: 14px; color: #666;">
                                                    <?= number_format($product_item["action_price"] * $usd_currency, 0, '', ' ') ?> ₽
                                                </span>
                                            <? endif; ?>
                                        <? else: ?>
                                            <div class="current__price-wrapper">
                                                <span class="price_usd_value"><?= number_format($product_item["retail_price"], 0, '', ' ') ?> ₽</span>
                                                <span class="old_price"><?= number_format($product_item["action_price"], 0, '', ' ') ?> ₽</span>
                                            </div>
                                        <? endif; ?>
                                    </div>
                                </div>

                                <div @click="add_too_box" class='button is-primary add_to_cart'
                                                         data-model='<?= $rows['product']["model"] ?>'
                                                         data-box="cart"> <span class="btn_icon_order"></span> <span class="btn_icon_order_text">В заказ</span> </div>
                            </div>
                        </div>
                    </div>
                <? endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?
CoreApplication::include_component(array("component" => "form_require_price", "template" => "default",));
?>