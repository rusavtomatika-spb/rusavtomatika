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
$cl_preview    = isset($product['preview_text']) ? $product['preview_text'] : '';
$cl_extra      = isset($product['preview_text_extra']) ? $product['preview_text_extra'] : '';
$cl_onstock    = isset($product['onstock_spb']) ? intval($product['onstock_spb']) : 0;
$cl_alt        = htmlspecialchars(trim((isset($product['short_name']) ? $product['short_name'] : '') . ' ' . ($cl_brand !== 'IFC' ? $cl_brand : '') . ' ' . $cl_model), ENT_QUOTES, 'UTF-8');
$cl_fields     = isset($GLOBALS['cl_preview_fields']) ? $GLOBALS['cl_preview_fields'] : array();
$cl_specs      = cl_short_description($product, $cl_fields);
?>
<div class="cl-card cl-card--table tr_product_<?= $cl_model ?>"
     data-type="<?= $cl_type ?>"
     data-series="<?= $cl_series ?>">

    <div class="cl-card__media">
        <a class="cl-card__media-link" href="<?= $cl_link ?>" aria-label="<?= $cl_alt ?>">
            <img class="cl-card__image" alt="<?= $cl_alt ?>" loading="lazy" src="<?= $cl_image ?>">
        </a>
    </div>

    <div class="cl-card__body">
        <a class="cl-card__title-link" href="<?= $cl_link ?>">
            <span class="cl-card__title"><?php if ($cl_type === 'controllers'): ?>ПЛК <?php endif; ?><?= $cl_model ?><?php if ($cl_type === 'controllers' && $cl_codesys !== 'N'): ?> с CODESYS<?php endif; ?></span>
        </a>

        <?php if ($cl_series !== ''): ?>
            <div class="cl-card__meta">
                <span class="cl-card__meta-item"><span class="cl-card__meta-label">Серия:</span><?= $cl_series_tag ?></span>
                <span class="cl-card__meta-item"><span class="cl-card__meta-label">Бренд:</span><?= cl_brand_tag($cl_brand) ?></span>
            </div>
        <?php endif; ?>

        <?php if ($cl_specs !== ''): ?>
            <div class="cl-card__specs"><?= $cl_specs ?></div>
        <?php endif; ?>

        <div class="cl-card__text">
            <?= $cl_preview ?>
            <?php if ($cl_extra !== ''): ?><span class="cl-card__text-extra"><?= $cl_extra ?></span><?php endif; ?>
        </div>
    </div>

    <div class="cl-card__aside">
        <div class="cl-card__deal">
            <div class="cl-card__price"><?= $cl_price ?></div>
            <div class="cl-card__stock">
                <?php if ($cl_onstock > 0): ?>
                    <span class="green"><i class="fa-solid fa-check"></i> В наличии</span>
                <?php else: ?>
                    <span class="red"><i class="fa-solid fa-clipboard-check"></i> Под заказ</span>
                <?php endif; ?>
            </div>
        </div>

        <div class="cl-card__actions">
            <div class="cl-card__actions-pair">
                <button title="Добавить в сравнение"
                        class="series_products__button compare"
                        @click="add_too_box"
                        data-model="<?= $cl_model ?>"
                        data-box="compare"><i class="fa-solid fa-align-right fa-rotate-90"></i></button>
                <button title="Добавить в избранное"
                        class="series_products__button favorites"
                        @click="add_too_box"
                        data-model="<?= $cl_model ?>"
                        data-box="favorites"><i class="fa-regular fa-heart"></i></button>
            </div>
            <button title="Добавить в заказ"
                    class="series_products__button cart"
                    @click="add_too_box"
                    data-model="<?= $cl_model ?>"
                    data-box="cart"><i class="fa-solid fa-cart-plus"></i> В заказ</button>
        </div>
    </div>
</div>