<?php
global $product, $userCountry, $usd_currency, $arSettings;

if (!isset($product) || !is_array($product)) { return; }
if (cl_skip_product($product, $userCountry)) { return; }

require __DIR__ . '/inc_product_prepare.php';

$cl_model      = isset($product['model']) ? $product['model'] : '';
$cl_brand      = isset($product['brand']) ? $product['brand'] : '';
$cl_type       = isset($product['type']) ? $product['type'] : '';
$cl_series     = isset($product['series']) ? $product['series'] : '';
$cl_link       = cl_product_link($product);
$cl_image      = cl_product_image($product);
$cl_price      = cl_price_html($product);
$cl_series_tag = cl_series_tags($product, cl_get_all_series());
$cl_codesys    = isset($product['codesys']) ? $product['codesys'] : 'N';
$cl_short      = isset($product['short_name']) ? $product['short_name'] : '';
$cl_preview    = isset($product['preview_text']) ? $product['preview_text'] : '';
$cl_onstock    = isset($product['onstock_spb']) ? intval($product['onstock_spb']) : 0;
$cl_alt        = trim($cl_short . ' ' . ($cl_brand !== 'IFC' ? $cl_brand : '') . ' ' . $cl_model);
$cl_fields     = isset($GLOBALS['cl_preview_fields']) ? $GLOBALS['cl_preview_fields'] : array();
$cl_short_desc = cl_short_description($product, $cl_fields);
?>
<div class="tr_product_<?= $cl_model ?> tile"
     data-type="<?= $cl_type ?>"
     data-series="<?= $cl_series ?>">

    <div class="preview">
        <div class="preview_image">
            <?= cl_brand_plate($cl_brand) ?>
            <?= cl_new_label(isset($product['date_pub']) ? $product['date_pub'] : '', 12) ?>
            <a href="<?= $cl_link ?>">
                <img alt="<?= $cl_alt ?>" loading="lazy" src="<?= $cl_image ?>">
            </a>
        </div>
    </div>

    <div class="td_short_description">
        <a href="<?= $cl_link ?>">
            <span class="model"><?php if ($cl_type === 'controllers'): ?>ПЛК <?php endif; ?><?= $cl_model ?><?php if ($cl_type === 'controllers' && $cl_codesys !== 'N'): ?> с CODESYS<?php endif; ?></span>
        </a>

        <div class="preview_text_block">
            <?php if ($cl_series !== ''): ?>
                <div class="brand-model-wrapper">
                    <div><span>Серия: </span><?= $cl_series_tag ?></div>
                    <div><span>Бренд: </span><?= cl_brand_tag($cl_brand) ?></div>
                </div>
            <?php endif; ?>

            <?php if ($cl_short_desc !== ''): ?>
                <div class="preview__text-wrapper"><?= $cl_short_desc ?></div>
            <?php endif; ?>

            <a href="<?= $cl_link ?>"><span class="preview_text"><?= $cl_preview ?></span></a>
        </div>
    </div>

    <div class="td_buttons">
        <div class="series_products__panel_buttons">
            <div class="price_block"><?= $cl_price ?></div>
            <div class="indicator_availability">
                <?php if ($cl_onstock > 0): ?>
                    <span class="green"><i class="fa-solid fa-check"></i> В наличии</span>
                <?php else: ?>
                    <span class="red"><i class="fa-solid fa-clipboard-check"></i> Под заказ</span>
                <?php endif; ?>
            </div>
        </div>

        <div class="buttons_panel">
            <button title="Добавить в сравнение"
                    class="series_products__button compare fa-solid fa-align-right fa-rotate-90"
                    style="min-width: 32.6px; max-width: 32.6px; height: 32.6px;"
                    @click="add_too_box"
                    data-model="<?= $cl_model ?>"
                    data-box="compare"></button>
            <button title="Добавить в избранное"
                    class="series_products__button favorites fa-regular fa-heart"
                    style="min-width: 32.6px; max-width: 32.6px; height: 32.6px;"
                    @click="add_too_box"
                    data-model="<?= $cl_model ?>"
                    data-box="favorites"></button>
            <button title="Добавить в заказ"
                    class="series_products__button cart"
                    @click="add_too_box"
                    data-model="<?= $cl_model ?>"
                    data-box="cart">
                <i class="fa-solid fa-cart-plus"></i> В заказ
            </button>
        </div>
    </div>
</div>