<?php
global $usd_currency, $arSettings;

$apiKey      = 'b237155b14c4b6f777d91207ebc3775cb712ad6d';
$userIp      = $_SERVER['REMOTE_ADDR'];
$userCountry = getCountryFromDaData($userIp, $apiKey);

$renderClass = defined('SERVER_RENDERING') ? 'IS_SERVER_RENDERING' : 'IS_NOT_SERVER_RENDERING';
?>
<table class="<?= $renderClass ?> series_products <?= $userCountry ?>">
    <tbody class="catalog__table-body">
    <?php if (isset($series['products']) && is_array($series['products'])): ?>
        <?php foreach ($series['products'] as $product): ?>
            <?php
            if ($product['model'] === 'Codesys' && $userCountry !== 'RU') {
                continue;
            }
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

            $prod_series = explode(',', $product['series']);
            $all_series  = get_all_series();

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
                $price_html .= '<button class="series_products__button active" data-rel-model="' . $product['model'] . '" @click="open_form_require_price"><i class="fa-solid fa-comment-dollar"></i> Запрос цены</button>';
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
                    <div class="brand-model-wrapper" style="align-items: center;">
                        <a href="<?= $product['link_detail_page'] ?>">
                            <span class="model">
                                <?php if ($product['type'] === 'controllers'): ?>ПЛК <?php endif; ?>
                                <?= $product['model'] ?>
                                <?php if ($product['type'] === 'controllers' && $product['codesys'] !== 'N'): ?> с CODESYS<?php endif; ?>
                            </span>
                        </a>
                        <?php if (count($prod_series) > 0): ?>
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
                        <?php endif; ?>
                    </div>

                    <div class="preview_text_block">
                        <span class="preview_text"><?= $product['preview_text'] ?></span>
                        <span class="preview_text_extra"><?= $product['preview_text_extra'] ?></span>
                    </div>
                </td>

                <td class="td_buttons">
                    <div class="indicator_availability">
                        <?php if (intval($product['onstock_spb']) > 0): ?>
                            <span class="green">
                                <i class="fa-solid fa-check"></i>
                                В наличии
                            </span>
                        <?php else: ?>
                            <span class="red">
                            <i class="fa-solid fa-clipboard-check"></i>
                                Под заказ
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="price_block_wrapper">
                        <div class="price_block"><?= $price_html ?></div>
                    </div>

                    <div class="series_products__panel_buttons">
                        <button title="Добавить в сравнение"
                                class="series_products__button compare"
                                @click="add_too_box"
                                data-model="<?= $product['model'] ?>"
                                data-box="compare">
                                <i class="fa-solid fa-align-right fa-rotate-90"></i>
                        </button>
                        <button title="Добавить в избранное"
                                class="series_products__button favorites"
                                @click="add_too_box"
                                data-model="<?= $product['model'] ?>"
                                data-box="favorites"><i class="fa-regular fa-heart"></i>
                        </button>
                    </div>

                    <button title="Добавить в заказ"
                            class="series_products__button cart"
                            @click="add_too_box"
                            data-model="<?= $product['model'] ?>"
                            data-box="cart">
                        <i class="fa-solid fa-cart-plus"></i> В заказ
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <hr>Нет товаров...<hr>
    <?php endif; ?>
    </tbody>
</table>