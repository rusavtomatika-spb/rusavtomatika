<?php
global $usd_currency;

$apiKey      = 'b237155b14c4b6f777d91207ebc3775cb712ad6d';
$userIp      = $_SERVER['REMOTE_ADDR'];
$userCountry = getCountryFromDaData($userIp, $apiKey);
?>
<table class="series_products">
    <tbody class="catalog__table-body">
        <?php foreach ($series['products'] as $product): ?>
            <?php
            if ($product['model'] === 'codesys_license') {
                continue;
            }

            $diagonal = '';
            if (
                isset($product['diagonal'])
                && $product['diagonal'] != ''
                && $product['diagonal'] != 0
                && $product['diagonal_hide'] == 0
            ) {
                $diagonal = str_replace('.0', '', $product['diagonal']) . '&Prime;&nbsp;';
            }

            $model = str_replace(['/', ' '], '_', $product['model']);
            $image_src = $arSettings['path_to_product_images']
                . mb_strtolower($product['brand']) . '/'
                . mb_strtolower($product['type']) . '/'
                . $model . '/67/' . $model . '_1.webp';

            $price_html = '';
            if (
                isset($product['retail_price'])
                && intval($product['retail_price']) > 0
                && $product['retail_price_hide'] == '0'
            ) {
                switch ($product['currency']) {
                    case 'USD':
                        $price_html .= '<div class="price_row">';
                        if ($product['action_price'] > 0) {
                            $price_html .= '<span class="act_price">' . $product['action_price'] . ' $</span>';
                        }
                        $price_html .= '<span class="usd_price">' . $product['retail_price'] . ' $</span>';
                        $price_html .= '</div>';
                        if ($usd_currency) {
                            $price_html .= '<span class="rub_price">' . intval($product['retail_price'] * $usd_currency) . ' &#8381;</span>';
                        }
                        break;

                    case 'RUR':
                        $price_html .= '<div class="price_row">';
                        if ($product['action_price'] > 0) {
                            $price_html .= '<span class="act_price green">' . $product['action_price'] . ' &#8381;</span>';
                        }
                        $price_html .= '</div>';
                        $price_html .= '<span class="rub_price green">' . $product['retail_price'] . ' &#8381;</span>';
                        break;
                }
            } else {
                $price_html .= '<span class="no_price">Цена по запросу</span>';
            }
            ?>
            <tr class="tr_product_<?= $product['model'] ?>">
                <td class="td_preview_image">
                    <a href="<?= $product['link_detail_page'] ?>">
                        <div class="preview_image">
                            <img alt="<?= $product['model'] ?>"
                                 loading="lazy"
                                 src="<?= $image_src ?>">
                        </div>
                    </a>
                </td>

                <td class="td_model">
                    <a href="<?= $product['link_detail_page'] ?>">
                        <span class="model">
                            <?= $diagonal ?>
                            <?php if ($product['type'] === 'controllers'): ?>ПЛК <?php endif; ?>
                            <?= $product['model'] ?>
                            <?php if ($product['type'] === 'controllers'): ?> с CODESYS<?php endif; ?>
                        </span>
                    </a>
                </td>

                <td class="td_short_description">
                    <a href="<?= $product['link_detail_page'] ?>">
                        <?= $product['short_name'] ?> <b><?= $product['brand'] ?></b> | <?= $product['preview_text'] ?>
                    </a>
                </td>

                <td class="td_onstock">
                    <a href="<?= $product['link_detail_page'] ?>">
                        <?php if ($product['onstock_spb'] > 0 || $product['onstock_msk'] > 0): ?>
                            <span class="green">В&nbsp;наличии</span>
                        <?php else: ?>
                            <span class="red">Под&nbsp;заказ</span>
                        <?php endif; ?>
                    </a>
                </td>

                <td class="td_price">
                    <a href="<?= $product['link_detail_page'] ?>"><?= $price_html ?></a>
                </td>

                <td class="td_buttons">
                    <div class="buttons_panel">
                        <button title="Добавить в избранное"
                                class="series_products__button favorite"
                                @click="add_too_box"
                                data-model="<?= $product['model'] ?>"
                                data-box="favorites"></button>
                        <button title="Добавить в сравнение"
                                class="series_products__button compare"
                                @click="add_too_box"
                                data-model="<?= $product['model'] ?>"
                                data-box="compare"></button>
                        <button title="Заказать"
                                class="series_products__button cart"
                                @click="add_too_box"
                                data-model="<?= $product['model'] ?>"
                                data-box="cart"></button>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>