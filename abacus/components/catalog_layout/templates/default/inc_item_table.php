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
$cl_extra      = isset($product['preview_text_extra']) ? $product['preview_text_extra'] : '';
$cl_onstock    = isset($product['onstock_spb']) ? intval($product['onstock_spb']) : 0;
$cl_alt        = trim($cl_short . ' ' . ($cl_brand !== 'IFC' ? $cl_brand : '') . ' ' . $cl_model);
$cl_fields     = isset($GLOBALS['cl_preview_fields']) ? $GLOBALS['cl_preview_fields'] : array();
$cl_short_desc = cl_short_description($product, $cl_fields);
?>
<tr class="tr_product_<?= $cl_model ?>"
    data-type="<?= $cl_type ?>"
    data-series="<?= $cl_series ?>">

    <td class="td_preview_image">
        <a href="<?= $cl_link ?>">
            <div class="preview_image">
                <img alt="<?= $cl_alt ?>" loading="lazy" src="<?= $cl_image ?>">
            </div>
        </a>
    </td>

    <td class="td_short_description">
        <div class="brand-model-wrapper" style="align-items: center;">
            <a href="<?= $cl_link ?>">
                <span class="model"><?php if ($cl_type === 'controllers'): ?>ПЛК <?php endif; ?><?= $cl_model ?><?php if ($cl_type === 'controllers' && $cl_codesys !== 'N'): ?> с CODESYS<?php endif; ?></span>
            </a>
            <?php if ($cl_series !== ''): ?>
                <div><span>Серия: </span><?= $cl_series_tag ?></div>
                <div><span>Бренд: </span><?= cl_brand_tag($cl_brand) ?></div>
            <?php endif; ?>
        </div>

        <?php if ($cl_short_desc !== ''): ?>
            <div class="preview__text-wrapper"><?= $cl_short_desc ?></div>
        <?php endif; ?>

        <div class="preview_text_block">
            <span class="preview_text"><?= $cl_preview ?></span>
            <span class="preview_text_extra"><?= $cl_extra ?></span>
        </div>
    </td>

    <td class="td_buttons">
        <div class="indicator_availability">
            <?php if ($cl_onstock > 0): ?>
                <span class="green"><i class="fa-solid fa-check"></i> В наличии</span>
            <?php else: ?>
                <span class="red"><i class="fa-solid fa-clipboard-check"></i> Под заказ</span>
            <?php endif; ?>
        </div>

        <div class="price_block_wrapper">
            <div class="price_block"><?= $cl_price ?></div>
        </div>

        <div class="series_products__panel_buttons">
            <button title="Добавить в сравнение"
                    class="series_products__button compare"
                    @click="add_too_box"
                    data-model="<?= $cl_model ?>"
                    data-box="compare">
                <i class="fa-solid fa-align-right fa-rotate-90"></i>
            </button>
            <button title="Добавить в избранное"
                    class="series_products__button favorites"
                    @click="add_too_box"
                    data-model="<?= $cl_model ?>"
                    data-box="favorites">
                <i class="fa-regular fa-heart"></i>
            </button>
        </div>

        <button title="Добавить в заказ"
                class="series_products__button cart"
                @click="add_too_box"
                data-model="<?= $cl_model ?>"
                data-box="cart">
            <i class="fa-solid fa-cart-plus"></i> В заказ
        </button>
    </td>
</tr>