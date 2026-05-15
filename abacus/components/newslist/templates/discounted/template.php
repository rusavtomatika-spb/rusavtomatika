<?php

CoreApplication::add_style(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/style.css");

global $TITLE, $CANONICAL, $DESCRIPTION, $usd_currency;
$TITLE = "Неликвиды, уцененные товары, распродажа неликвидов, АКЦИЯ, Панели оператора, Панельные компьютеры, Промышленные компьютеры full IP65, Встраиваемые компьютеры, Промышленные мониторы, VPN-роутеры, Контроллеры (PLC), Модули ввода-вывода, Блоки питания";
$CANONICAL = "https://www.rusavtomatika.com/sale/discounted/";
$DESCRIPTION = "Каталог уценённых товаров, цены, фотографии, описание уценки. Покупайте со скидкой уценённые товары в интернет-магазине rusavtomatika.com";
CoreApplication::add_breadcrumbs_chain("Уцененные товары", "/sale/discounted/");

include 'functions.php';

$rows_from_products = get_rows_from_table("products_all", "", "`discounted` = '1'", "");

$rows_from_discounted = get_rows_from_table("discounted", "", "`show` = '1'", "position");

$typeDictionary = [
    'hmi' => 'Панель оператора',
    'cloud_hmi' => 'Облачная панель',
    'panel-terminal' => 'Панель-терминал',
    'web-panel' => 'Web-панель',
    'panel_pc' => 'Панельный компьютер',
    'panel_pc_wce' => 'Панельный компьютер Windows CE',
    'panel_pc_ip65' => 'Панельный компьютер IP65',
    'monitor' => 'Промышленный монитор',
    'monitors' => 'Промышленный монитор',
    'box-pc' => 'Встраиваемый компьютер',
    'pc_module' => 'PC-модуль',
    'vpn-router' => 'VPN-роутер',
    'serial-server' => 'Serial-сервер',
    'ethernet-switch' => 'Ethernet-коммутатор',
    'controllers' => 'Контроллер ПЛК',
    'module' => 'Модуль ввода-вывода',
    'bloki-pitaniya' => 'Блок питания',
    'ps' => 'Блок питания',
    'Gateway' => 'Шлюз данных',
    'frame' => 'Рамка',
    'accessories' => 'Аксессуар',
    'antenna' => 'Антенна'
];

function getFirstLiElements($html, $count = 3) {
    if (empty($html)) return '';
    
    $html = str_replace('</ li>', '</li>', $html);
    $html = preg_replace('/(\S)\s+li>/', '$1</li>', $html);
    
    if (preg_match('/<ul[^>]*>(.*?)<\/ul>/s', $html, $ulMatch)) {
        $ulContent = $ulMatch[1];
    } else {
        $ulContent = $html;
    }
    
    preg_match_all('/<li[^>]*>(.*?)<\/li>/s', $ulContent, $matches);
    
    if (empty($matches[1])) return '';
    
    $shortItems = [];
    $longItems = [];
    
    foreach ($matches[1] as $index => $item) {
        $cleanItem = $item;
        $cleanItem = preg_replace('/<a[^>]*>(.*?)<\/a>/s', '$1', $cleanItem);
        $cleanItem = strip_tags($cleanItem);
        $cleanItem = trim($cleanItem);
        
        $cleanLi = '<li>' . $cleanItem . '</li>';
        
        if (!empty($cleanItem)) {
            if (mb_strlen($cleanItem) <= 45) {
                $shortItems[] = $cleanLi;
            } else {
                $longItems[] = $cleanLi;
            }
        }
    }
    
    if (!empty($shortItems)) {
        $items = array_slice($shortItems, 0, $count);
    } else {
        $items = array_slice($longItems, 0, 1);
    }
    
    if (empty($items)) return '';
    
    $output = '<ul>';
    foreach ($items as $item) {
        $output .= $item;
    }
    $output .= '</ul>';
    
    return $output;
}

$productsFromAll = [];
foreach ($rows_from_products as $item) {
    $brand = strtolower($item["brand"]);
    $type = isset($item["type"]) ? $item["type"] : "monitor";
    $model = $item["model"];
    
    $productsFromAll[] = [
        "brand" => $item["brand"],
        "model" => $model,
        "type" => $type,
        "series" => isset($item["series"]) ? $item["series"] : "",
        "s_name" => !empty($item["s_name"]) ? $item["s_name"] : $model,
        "text_features" => !empty($item["text_features"]) ? $item["text_features"] : "",
        "retail_price" => $item["retail_price"],
        "action_price" => isset($item["action_price"]) ? $item["action_price"] : 0,
        "currency" => isset($item["currency"]) ? $item["currency"] : "RUB",
        "onstock_spb" => $item["onstock_spb"],
        "onstock_msk" => $item["onstock_msk"],
        "preview_picture" => "/images/{$brand}/{$type}/{$model}/580/{$model}_1.webp",
        "link_detail_page" => "/{$brand}/{$model}/",
        "source" => "products_all"
    ];
}

$productsFromDiscounted = [];
foreach ($rows_from_discounted as $item) {
    $productsFromDiscounted[] = [
        "brand" => $item["brand"],
        "model" => $item["model"],
        "type" => isset($item["type"]) ? $item["type"] : "",
        "series" => "",
        "s_name" => $item["name"],
        "text_features" => !empty($item["text_features"]) ? $item["text_features"] : "",
        "retail_price" => $item["price"],
        "action_price" => 0,
        "currency" => "RUB",
        "onstock_spb" => isset($item["quantity"]) && $item["quantity"] > 0 ? 1 : 0,
        "onstock_msk" => 0,
        "preview_picture" => $item["preview_picture"],
        "link_detail_page" => "/sale/discounted/" . $item["seo_url"] . "/",
        "source" => "discounted"
    ];
}

$rows = array_merge($productsFromAll, $productsFromDiscounted);

?>

<div class="component_newslist">
    <? CoreApplication::include_component(array("component"=> "breadcrumbs")); ?>
    <div class="component_wrapper">
        <div class="row" style="position: relative;">
            <div class="col-md-12">
                <h1 style="margin:0 auto 70px; text-align: center">Уцененные товары, распродажа неликвидов</h1>
            </div>
            
            <div class="sale__items-wrapper">
                <? foreach ($rows as $product_item): ?>
                    <?php
                    $brand = strtolower($product_item["brand"]);
                    $type = isset($product_item["type"]) ? $product_item["type"] : "monitor";
                    $display_model = $product_item["model"];
                    if (strtoupper($brand) === 'IFC' && strtoupper(substr($display_model, 0, 4)) === 'IFC-') {
                        $display_model = substr($display_model, 4);
                    }
                    
                    $typeTranslated = isset($typeDictionary[$type]) ? $typeDictionary[$type] : $type;
                    
                    $preview_picture = $product_item["preview_picture"];
                    $onstock = ($product_item["onstock_spb"] > 0 || $product_item["onstock_msk"] > 0);
                    $text_features = $product_item["text_features"];
                    $detail_link = $product_item["link_detail_page"];
                    $series = $product_item["series"];
                    
                    $discountPercent = 0;
                    if (isset($product_item["action_price"]) && $product_item["action_price"] > 0 && $product_item["retail_price"] > 0) {
                        $oldPrice = floatval($product_item["action_price"]);
                        $newPrice = floatval($product_item["retail_price"]);
                        if ($oldPrice > $newPrice && $newPrice > 0) {
                            $discountPercent = round(100 - ($newPrice / $oldPrice * 100));
                        }
                    }
                    ?>
                    <a href="<?= $detail_link ?>" class="item" data-model="<?= $product_item["model"] ?>">
                        <div class="preview_image_wrapper">
                            <img src="<?= $preview_picture ?>" alt="<?= $product_item["model"] ?>">
                        </div>

                        <?php if ($discountPercent > 0): ?>
                        <div class="item__percent-wrapper">
                            <p>-<?= $discountPercent ?>%</p>
                        </div>
                        <?php endif; ?>
                        
                        <div class="item__description">
                            <div class="item__text-wrapper">
                                <div class="item__categories">
                                    <p class="item__title"><?= $product_item["brand"] ?> <?= $display_model ?></p>
                                    <p class="category__item"><?= $typeTranslated ?></p>
                                    <?php if (!empty($series)): ?>
                                    <p class="category__item">Серия: <span class="tag mr-1"><?= htmlspecialchars($series) ?></span></p>
                                    <?php endif; ?>
                                </div>
                                <? if (!empty($text_features)): ?>
                                    <?= getFirstLiElements($text_features, strpos($model, 'iR') !== false ? 1 : 3) ?>
                                <? endif; ?>
                            </div>
                            
                            <div class="item__info-wrapper">
                                <div class="td_onstock" style="margin: 0;">
                                    <? if ($onstock): ?>
                                        <span class="green" style="white-space: nowrap;">В наличии</span>
                                    <? else: ?>
                                        <span class="red">Под заказ</span>
                                    <? endif; ?>
                                </div>

                                <div class="price-wrapper">
                                    <div class="actual__price-wrapper">
                                        <? if ($product_item["currency"] == 'USD'): ?>
                                            <div class="current__price-wrapper">
                                                <? if ($product_item["action_price"] > 0): ?>
                                                <span class="old_price"><?= number_format($product_item["action_price"], 0, '', ' ') ?> $</span>
                                                <? endif; ?>
                                                <span class="price_usd_value"><?= number_format($product_item["retail_price"], 0, '', ' ') ?> $</span>
                                            </div>
                                        <? else: ?>
                                            <div class="current__price-wrapper">
                                                <? if ($product_item["action_price"] > 0): ?>
                                                <span class="old_price"><?= number_format($product_item["action_price"], 0, '', ' ') ?> ₽</span>
                                                <? endif; ?>
                                                <span class="price_usd_value"><?= number_format($product_item["retail_price"], 0, '', ' ') ?> ₽</span>
                                            </div>
                                        <? endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                <? endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?
CoreApplication::include_component(array("component" => "form_require_price", "template" => "default",));
?>