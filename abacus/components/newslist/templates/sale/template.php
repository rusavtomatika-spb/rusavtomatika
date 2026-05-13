<?php

CoreApplication::add_style(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/style.css");

global $TITLE, $CANONICAL, $DESCRIPTION, $usd_currency;
$TITLE = "Распродажа | Акции и скидки | Русавтоматика";
$CANONICAL = "https://www.rusavtomatika.com/sale/";
$DESCRIPTION = "Акционные товары, распродажа, товары со скидкой. Покупайте со скидкой в интернет-магазине rusavtomatika.com";
CoreApplication::add_breadcrumbs_chain("Распродажа", "/sale/");

include 'functions.php';
$rows = get_rows_from_table("products_all", "", "`action_price` IS NOT NULL AND `action_price` != '' AND `action_price` > 0", "");

$filteredRows = array();
$ifcMProducts = array();
$hasIfcMProducts = false;

foreach ($rows as $product_item) {
    $brand = $product_item["brand"];
    $model = $product_item["model"];
    
    if ($brand == 'IFC' && strpos($model, 'IFC-M') === 0) {
        $ifcMProducts[] = $product_item;
        $hasIfcMProducts = true;
        continue;
    }
    
    $filteredRows[] = $product_item;
}

if ($hasIfcMProducts) {
    $minPrice = PHP_INT_MAX;
    $maxPrice = 0;
    $hasStock = false;
    $firstProduct = $ifcMProducts[0];
    
    foreach ($ifcMProducts as $item) {
        $price = floatval($item["retail_price"]);
        if ($price > 0 && $price < $minPrice) $minPrice = $price;
        if ($price > $maxPrice) $maxPrice = $price;
        if (($item["onstock_spb"] > 0 || $item["onstock_msk"] > 0)) $hasStock = true;
    }
    
    $mergedProduct = array(
        "brand" => "IFC",
        "model" => "IFC-M-Series",
        "name" => "IFC M-Series",
        "s_name" => "Промышленные мониторы IFC серии M",
        "type" => "monitor",
        "currency" => "USD",
        "retail_price" => $minPrice,
        "action_price" => $maxPrice,
        "onstock_spb" => $hasStock ? 1 : 0,
        "onstock_msk" => $hasStock ? 1 : 0,
        "preview_text" => "Промышленные мониторы IFC серии M. Диагонали от 10.1 до 21.5 дюймов",
        "preview_text_extra" => "Сенсорный экран (емкостный/резистивный), интерфейсы: VGA, DVI, HDMI",
        "link_detail_page" => "/catalog/industrial_monitors/?&series=IFC-200",
        "preview_picture_override" => "/images/ifc/monitor/IFC-M210C/580/IFC-M210C_1.webp",
        "price_range" => true,
        "min_price" => $minPrice,
        "max_price" => $maxPrice
    );
    
    array_unshift($filteredRows, $mergedProduct);
}

$rows = $filteredRows;

usort($rows, function($a, $b) {
    if ($a['brand'] == 'Weintek' && $b['brand'] != 'Weintek') {
        return -1;
    }
    if ($a['brand'] != 'Weintek' && $b['brand'] == 'Weintek') {
        return 1;
    }
    if ($a['brand'] == 'IFC' && isset($a['model']) && $a['model'] == 'IFC-M-Series') {
        return -1;
    }
    if ($b['brand'] == 'IFC' && isset($b['model']) && $b['model'] == 'IFC-M-Series') {
        return 1;
    }
    return strcmp($a['brand'], $b['brand']);
});

?>

<div class="component_newslist">
    <? CoreApplication::include_component(array("component"=> "breadcrumbs")); ?>
    <div class="component_wrapper">
        <div class="row" style="position: relative;">
            <div class="col-md-12">
                <h1 style="margin:0 auto 70px; text-align: center">Распродажа, акции и скидки!</h1>
            </div>
            <a href="/sale/discounted" class="discounted__link">Уцененные товары</a>
            
            <div class="sale__items-wrapper">
                <? foreach ($rows as $product_item): ?>
                    <?php
                    $brand = strtolower($product_item["brand"]);
                    $type = isset($product_item["type"]) ? $product_item["type"] : "monitor";
                    $model = $product_item["model"];
                    $size = "580";
                    
                    if (isset($product_item["preview_picture_override"])) {
                        $preview_picture = $product_item["preview_picture_override"];
                    } else {
                        $preview_picture = "/images/{$brand}/{$type}/{$model}/{$size}/{$model}_1.webp";
                    }
                    
                    $product_name = !empty($product_item["s_name"]) ? $product_item["s_name"] : $product_item["model"];
                    $onstock = ($product_item["onstock_spb"] > 0 || $product_item["onstock_msk"] > 0);
                    $preview_text = !empty($product_item["preview_text"]) ? $product_item["preview_text"] : "";
                    $preview_text_extra = !empty($product_item["preview_text_extra"]) ? $product_item["preview_text_extra"] : "";
                    
                    if (isset($product_item["link_detail_page"])) {
                        $detail_link = $product_item["link_detail_page"];
                    } else {
                        $detail_link = "/{$brand}/{$model}/";
                    }
                    
                    $display_model = ($product_item["model"] == "IFC-M-Series") ? "M-Series (промышленные мониторы)" : $product_item["model"];
                    
                    $hidePrice = ($product_item["model"] == "IFC-M-Series");
                    
                    $discountPercent = 0;
                    if (!$hidePrice && isset($product_item["action_price"]) && $product_item["action_price"] > 0 && isset($product_item["retail_price"]) && $product_item["retail_price"] > 0) {
                        $oldPrice = floatval($product_item["action_price"]); // старая цена (больше)
                        $newPrice = floatval($product_item["retail_price"]);  // новая цена (меньше)
                        if ($oldPrice > $newPrice && $newPrice > 0) {
                            $discountPercent = round(100 - ($newPrice / $oldPrice * 100));
                        }
                    }
                    ?>
                    <a href="<?= $detail_link ?>" class="item" data-model="<?= $product_item["model"] ?>">
                        <div class="preview_image_wrapper">
                            <img src="<?= $preview_picture ?>" alt="<?= $product_item["model"] ?>">
                        </div>

                        <?php if ($discountPercent > 0 && !$hidePrice): ?>
                        <div class="item__percent-wrapper">
                            <p>-<?= $discountPercent ?>%</p>
                        </div>
                        <?php endif; ?>
                        
                        <div class="item__description">
                            <div class="item__text-wrapper">
                                <p class="item__title">
                                    <?= $product_item["brand"] ?> <?= $display_model ?>
                                </p>

                                <? if (!empty($preview_text)): ?>
                                    <div class="preview_text">
                                        <?= $preview_text ?>
                                        <? if (!empty($preview_text_extra)): ?>
                                            <span class="preview_text_extra"><?= $preview_text_extra ?></span>
                                        <? endif; ?>
                                    </div>
                                <? endif; ?>
                                
                                <p style="margin: 0;">Серия: <span class="tag mr-1">IFC-200</span></p>
                            </div>
                            
                            <div class="item__info-wrapper">
                                <div class="td_onstock" style="margin: 0;">
                                    <? if ($onstock): ?>
                                        <span class="green" style="white-space: nowrap;">В наличии</span>
                                    <? else: ?>
                                        <span class="red">Под заказ</span>
                                    <? endif; ?>
                                </div>

                                <? if (!$hidePrice): ?>
                                <div class="price-wrapper">
                                    <div class="actual__price-wrapper">
                                        <? if ($product_item["currency"] == 'USD'): ?>
                                            <div class="current__price-wrapper">
                                                <span class="old_price"><?= number_format($product_item["action_price"], 0, '', ' ') ?> $</span>
                                                <span class="price_usd_value"><?= number_format($product_item["retail_price"], 0, '', ' ') ?> $</span>
                                            </div>
                                            <? if(isset($usd_currency) && $usd_currency > 0): ?>
                                                <span class="price_rub_value">
                                                    <?= number_format($product_item["retail_price"] * $usd_currency, 0, '', ' ') ?> ₽
                                                </span>
                                            <? endif; ?>
                                        <? else: ?>
                                            <div class="current__price-wrapper">
                                                <span class="old_price"><?= number_format($product_item["action_price"], 0, '', ' ') ?> ₽</span>
                                                <span class="price_usd_value"><?= number_format($product_item["retail_price"], 0, '', ' ') ?> ₽</span>
                                            </div>
                                        <? endif; ?>
                                    </div>
                                </div>
                                <? endif; ?>
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