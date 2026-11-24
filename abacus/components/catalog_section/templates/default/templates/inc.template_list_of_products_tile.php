<?php
global $usd_currency, $arSettings;

$apiKey      = 'b237155b14c4b6f777d91207ebc3775cb712ad6d';
$userIp      = $_SERVER['REMOTE_ADDR'];
$userCountry = getCountryFromDaData($userIp, $apiKey);

$renderClass = defined('SERVER_RENDERING') ? 'IS_SERVER_RENDERING' : 'IS_NOT_SERVER_RENDERING';
?>
<div class="<?= $renderClass ?> series_products_tiles fixed-grid has-1-cols-mobile has-2-cols-tablet has-3-cols-desktop <?= $userCountry ?>">
    <div class="grid">
        <?php if (isset($series['products']) && is_array($series['products'])): ?>
            <?php foreach ($series['products'] as $product): ?>
                <?php
                if (
                    preg_match('/(operator_panels)/i', $_SERVER['QUERY_STRING'])
                    && !preg_match('/(screenless)/i', $_SERVER['QUERY_STRING'])
                    && ($product['screenless'] == 1)
                    && !preg_match('/(series)/i', $_SERVER['QUERY_STRING'])
                ) {
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

                $prod_series = explode(',', $product['series']);
                $all_series  = get_all_series();

                $model = $product['model'];
                if ($product['brand'] === 'Faraday') {
                    $model = str_replace(['/', ' '], '_', $model);
                    $image_src = $arSettings['path_to_product_images']
                        . mb_strtolower($product['brand']) . '/'
                        . mb_strtolower($product['type']) . '/'
                        . $model . '/580/' . $model . '_1.webp';
                } else {
                    $image_src = $arSettings['path_to_product_images']
                        . mb_strtolower($product['brand']) . '/'
                        . mb_strtolower($product['type']) . '/'
                        . $model . '/580/' . $model . '_1.webp';
                }

                if ($_SERVER['HTTP_HOST'] === 'www.rusavtomatika.com') {
                    $image_src = '/upload_files' . $image_src;
                }

                $brand = $product['brand'];

                $price_html = '';
                if (
                    isset($product['retail_price'])
                    && intval($product['retail_price']) > 0
                    && $product['retail_price_hide'] == 0
                    && $product['model'] !== 'IFC-M-Series'
                ) {
                    switch ($product['currency']) {
                        case 'USD':
                            $price_html .= '<div class="price_row">';
                            if ($product['action_price'] > 0) {
                                $price_html .= '<span class="act_price">' . $product['action_price'] . ' $</span>';
                            }
                            $price_html .= '<span class="usd_price">' . $product['retail_price'] . ' $</span>';
                            $price_html .= '</div>';
                            if ($usd_currency && intval($product['show_rub_po_kursu_usd']) !== 1) {
                                $price_html .= '<span class="rub_price">' . intval($product['retail_price'] * $usd_currency) . ' &#8381;</span>';
                            }
                            break;

                        case 'RUR':
                            $price_html .= '<div class="price_row">';
                            if ($product['action_price'] > 0) {
                                $price_html .= '<span class="act_price green">' . $product['action_price'] . ' &#8381;</span>';
                            }
                            if ($usd_currency) {
                                $price_html .= '<span class="usd_price green">' . intval($product['retail_price'] / $usd_currency) . ' $</span>';
                            }
                            $price_html .= '</div>';
                            $price_html .= '<span class="rub_price green">' . intval($product['retail_price']) . ' &#8381;</span>';
                            break;
                    }
                } else {
                    $price_html .= '<span class="no_price series_products__button" data-rel-model="' . $product['model'] . '" @click="open_form_require_price"><i class="fa-solid fa-comment-dollar"></i>&nbsp;Запросить цену</span>';
                    if (isset($_COOKIE['dev_mode']) && $_COOKIE['dev_mode'] > 0) {
                        $price_html .= '<span class="show_in_dev_mode">' . $product['retail_price'] . '</span>';
                    }
                }
                ?>

                <div class="tr_product_<?= $product['model'] ?> tile"
                     data-type="<?= $product['type'] ?>"
                     data-series="<?= $product['series'] ?>">

                    <div class="preview">
                        <div class="preview_image">
                            <?php if (in_array($brand, ['Weintek', 'IFC', 'Aplex', 'Spiktek', 'Samkoon', 'eWON', 'Faraday'])): ?>
                                <a class="brand_plate" href="/<?= strtolower($brand) ?>/"><?= $brand ?></a>
                            <?php else: ?>
                                <span class="brand_plate"><?= $brand ?></span>
                            <?php endif; ?>

                            <?= renderNewLabel($product['date_pub'], 12) ?>

                            <a href="<?= $product['link_detail_page'] ?>">
                                <img alt="<?= $product['short_name'] ?> <?= $product['brand'] !== 'IFC' ? $product['brand'] : '' ?> <?= $product['model'] ?>"
                                     loading="lazy"
                                     src="<?= $image_src ?>">
                            </a>
                        </div>
                    </div>

                    <div class="td_short_description">
                        <a href="<?= $product['link_detail_page'] ?>">
                            <span class="model">
                                <?php if ($product['type'] === 'controllers'): ?>ПЛК <?php endif; ?>
                                <?= $product['model'] ?>
                                <?php if ($product['type'] === 'controllers' && $product['codesys'] !== 'N'): ?> с CODESYS<?php endif; ?>
                            </span>
                        </a>

                        <div class="preview_text_block">
                            <?php if (count($prod_series) > 0): ?>
                                <div class="brand-model-wrapper">
                                    <div>
                                        <span>Серия: </span>
                                        <?php
                                        $prev_ser = '';
                                        foreach ($prod_series as $serie) {
                                            foreach ($all_series as $all_serie) {
                                                $pattern = '/[^_,\w]*' . $product['type'] . '[^_,\w]*/im';
                                                if (
                                                    $all_serie['name'] !== 'INDUSTRIAL'
                                                    && $all_serie['name'] !== $prev_ser
                                                    && $all_serie['name'] === $serie
                                                    && preg_match($pattern, $all_serie['type'])
                                                ) {
                                                    echo '<a class="tag mr-1" href="/catalog/'
                                                        . $all_serie['menu_category_item_code']
                                                        . '/?&series=' . $all_serie['name'] . '">'
                                                        . $all_serie['name'] . '</a>';
                                                }
                                                $prev_ser = $all_serie['name'];
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div>
                                        <span>
                                            Бренд: 
                                        </span>
                                        <?php if (in_array($brand, ['Weintek', 'IFC', 'Aplex', 'Spiktek', 'Samkoon', 'eWON', 'Faraday', 'LicOS'])): ?>
                                            <a class="tag" href="/<?= strtolower($brand) ?>/"><?= $brand ?></a>
                                        <?php else: ?>
                                            <span class="tag"><?= $brand ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <a href="<?= $product['link_detail_page'] ?>">
                                <span class="preview_text"><?= $product['preview_text'] ?></span>
                            </a>
                        </div>
                    </div>

                    <div class="td_buttons">
                        <div class="series_products__panel_buttons">
                            <div class="price_block"><?= $price_html ?></div>

                            <div class="indicator_availability">
                                <?php if ($product['onstock_spb'] > 0): ?>
                                    <span class="green"><i class="fa-solid fa-check"></i> В наличии</span>
                                <?php else: ?>
                                    <span class="red"><i class="fa-solid fa-clipboard-check"></i> Под заказ</span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="buttons_panel">
                          <button title="Добавить в сравнение"
                                  class="series_products__button compare fa-solid fa-align-right fa-rotate-90"
                                  style="min-width: 35px; max-width: 35px; height: 35px;"
                                  @click="add_too_box"
                                  data-model="<?= $product['model'] ?>"
                                  data-box="compare"></button>
                          <button title="Добавить в избранное"
                                  class="series_products__button favorites fa-regular fa-heart"
                                  style="min-width: 35px; max-width: 35px; height: 35px;"
                                  @click="add_too_box"
                                  data-model="<?= $product['model'] ?>"
                                  data-box="favorites"></button>
                            <button title="Добавить в заказ"
                                    class="series_products__button cart active"
                                    @click="add_too_box"
                                    data-model="<?= $product['model'] ?>"
                                    data-box="cart">
                                <i class="fa-solid fa-cart-plus"></i> В ЗАКАЗ
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <hr>Нет товаров...<hr>
        <?php endif; ?>
    </div>
</div>