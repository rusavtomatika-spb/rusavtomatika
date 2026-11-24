<?php
global $usd_currency, $arSettings;

$apiKey      = 'b237155b14c4b6f777d91207ebc3775cb712ad6d';
$userIp      = $_SERVER['REMOTE_ADDR'];
$userCountry = getCountryFromDaData($userIp, $apiKey);
?>
<table class="<?= defined('SERVER_RENDERING') ? 'IS_SERVER_RENDERING' : 'IS_NOT_SERVER_RENDERING' ?> series_products">
    <?php if (isset($series['products']) && is_array($series['products'])): ?>
        <?php foreach ($series['products'] as $product): ?>
            <?php
            if ($product['model'] === 'codesys_license' && $userCountry !== 'RU') {
                continue;
            }

            $diagonal = '';
            if (
                isset($product['diagonal'])
                && $product['diagonal'] != ''
                && $product['diagonal'] != 0
                && $product['diagonal_hide'] == 0
            ) {
                $product['diagonal'] = str_replace('.0', '', $product['diagonal']);
                $diagonal = '<b>' . $product['diagonal'] . '&Prime;&nbsp;</b>';
            }

            $short_description = '';
            if (isset($arrPreviewFields_withNames) && is_array($arrPreviewFields_withNames)) {
                $parts = [];
                foreach ($arrPreviewFields_withNames as $field) {
                    $code = $field['code'];
                    if (isset($product[$code]) && $product[$code] != '') {
                        $parts[] = '<span class="name_short">' . $field['name_short'] . ':</span>&nbsp;'
                            . $product[$code] . $field['units'];
                    }
                }
                $short_description = implode(', ', $parts);
            }

            $model = $product['model'];
            if ($product['brand'] === 'Faraday') {
                $model = str_replace(['/', ' '], '_', $model);
            }
            $image_src = $arSettings['path_to_product_images']
                . mb_strtolower($product['brand']) . '/'
                . mb_strtolower($product['type']) . '/'
                . $model . '/580/' . $model . '_1.webp';

            if ($_SERVER['HTTP_HOST'] === 'www.rusavtomatika.com') {
                $image_src = '/upload_files' . $image_src;
            }

            $brand = $product['brand'];

            $price_html = '';
            if (
                isset($product['retail_price'])
                && intval($product['retail_price']) > 0
                && $product['retail_price_hide'] == 0
            ) {
                switch ($product['currency']) {
                    case 'USD':
                        if ($product['action_price'] > 0) {
                            $price_html .= '<span class="act_price"><span class="value">' . $product['action_price'] . '</span>&nbsp;<span class="usd">$</span></span>';
                        }
                        $price_html .= '<div class="usd_price"><span class="value">' . $product['retail_price'] . '</span>&nbsp;<span class="usd">$</span></div>';
                        if ($usd_currency) {
                            $price_html .= '<div class="rub_price">' . intval($product['retail_price'] * $usd_currency) . '&nbsp;&#8381;</div>';
                        }
                        break;

                    case 'RUR':
                        if ($product['action_price'] > 0) {
                            $price_html .= '<span class="act_price"><span class="value">' . $product['action_price'] . '</span>&nbsp;<span class="usd">&#8381;</span></span>';
                        }
                        if ($usd_currency) {
                            $price_html .= '<span><span class="value">' . intval($product['retail_price'] / $usd_currency) . '&nbsp;$</span></span>';
                        }
                        $price_html .= '<span class="rub_price">'
                            . $product['retail_price'] . ' <span class="rub">&#8381;</span>'
                            . '</span>';
                        break;
                }
            } else {
                $price_html .= '<span class="no_price series_products__button" data-rel-model="' . $product['model'] . '" @click="open_form_require_price">Запросить цену</span>';
                if (isset($_COOKIE['dev_mode']) && $_COOKIE['dev_mode'] > 0) {
                    $price_html .= '<span class="show_in_dev_mode">' . $product['retail_price'] . '</span>';
                }
            }
            ?>

            <tr class="tr_product_<?= $product['model'] ?>"
                data-type="<?= $product['type'] ?>"
                data-series="<?= $product['series'] ?>">
                <td class="td_preview_image">
                    <a href="<?= $product['link_detail_page'] ?>">
                        <div class="preview_image">
                            <img alt="<?= $product['short_name'] ?> <?= $product['brand'] !== 'IFC' ? $product['brand'] : '' ?> <?= $product['model'] ?>"
                                 loading="lazy"
                                 src="<?= $image_src ?>">
                        </div>
                    </a>
                </td>

                <td class="td_short_description">
                    <a href="<?= $product['link_detail_page'] ?>">
                        <span class="model">
                            <?php if ($product['type'] === 'controllers'): ?>ПЛК <?php endif; ?>
                            <?= $product['model'] ?>
                            <?php if ($product['type'] === 'controllers'): ?> с CODESYS<?php endif; ?>
                        </span>
                    </a>

                    <div class="preview_text_block">
                        <a href="<?= $product['link_detail_page'] ?>">
                            <div><?= $diagonal . ' ' . $product['short_name'] ?></div>
                        </a>
                        <span class="preview_text"><?= $product['preview_text'] ?></span>;
                        <span class="preview_text_extra"><?= $product['preview_text_extra'] ?></span>
                    </div>

                    <div class="series_products__panel_buttons">
                        <?php if (in_array($brand, ['Weintek', 'IFC', 'Aplex', 'Samkoon', 'eWON', 'Faraday'])): ?>
                            <a class="brand" href="/<?= strtolower($brand) ?>/"><?= $brand ?></a>
                        <?php else: ?>
                            <span class="brand"><?= $brand ?></span>
                        <?php endif; ?>

                        <span class="buttons_add">
                            <span title="Добавить в сравнение"
                                  class="series_products__button compare"
                                  @click="add_too_box"
                                  data-model="<?= $product['model'] ?>"
                                  data-box="compare"><span></span>В сравнение</span>
                            <span title="Добавить в избранное"
                                  class="series_products__button favorites"
                                  @click="add_too_box"
                                  data-model="<?= $product['model'] ?>"
                                  data-box="favorites"><span></span>В избранное</span>
                        </span>
                    </div>
                </td>

                <td class="td_buttons">
                    <div class="indicator_availability">
                        <?php if ($product['onstock_spb'] > 0 || $product['onstock_msk'] > 0): ?>
                            <span class="green">В&nbsp;наличии</span>
                        <?php else: ?>
                            <span class="red">Под&nbsp;заказ</span>
                        <?php endif; ?>
                    </div>

                    <div class="price_block_wrapper">
                        <div class="price_block"><?= $price_html ?></div>
                    </div>

                    <div class="buttons_panel">
                        <button title="Добавить в заказ"
                                class="series_products__button cart"
                                @click="add_too_box"
                                data-model="<?= $product['model'] ?>"
                                data-box="cart">В заказ</button>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <hr>Нет товаров...<hr>
    <?php endif; ?>
</table>