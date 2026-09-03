<?php

global $usd_currency, $arSettings;

// Получаем страну пользователя (как в catalog_detail)
$userCountry = 'RU'; // По умолчанию Россия

if (function_exists('getCountryFromDaData')) {
    $apiKey = 'b237155b14c4b6f777d91207ebc3775cb712ad6d';
    $userIp = $_SERVER['REMOTE_ADDR'];
    $userCountry = getCountryFromDaData($userIp, $apiKey);
    
    if (!$userCountry) {
        $userCountry = 'UNKNOWN';
    }
} else {
    // Пробуем подключить файл с функцией
    $funcFile = $_SERVER['DOCUMENT_ROOT'] . '/abacus/components/catalog_search/templates/default/inc_functions.php';
    if (file_exists($funcFile)) {
        require_once $funcFile;
        
        if (function_exists('getCountryFromDaData')) {
            $apiKey = 'b237155b14c4b6f777d91207ebc3775cb712ad6d';
            $userIp = $_SERVER['REMOTE_ADDR'];
            $userCountry = getCountryFromDaData($userIp, $apiKey);
            
            if (!$userCountry) {
                $userCountry = 'UNKNOWN';
            }
        }
    }
}

?>

<table class="series_products">
    <?
    if (isset($series["products"]) and is_array($series["products"])) {
        foreach ($series["products"] as $product) {
            // Пропускаем Codesys для не-российских пользователей
            if ($product["model"] == 'Codesys' && $userCountry != 'RU') {
                continue;
            }
            
            if (isset($product["diagonal"]) and $product["diagonal"] != "" and $product["diagonal"] != 0 and $product["diagonal_hide"] == 0) {
                $diagonal = '<b>' . $product["diagonal"] . '&Prime;&nbsp;</b>';
            } else $diagonal = '';

            if (isset($arrPreviewFields_withNames) and is_array($arrPreviewFields_withNames)) {
                $short_description = "";
                foreach ($arrPreviewFields_withNames as $arrPreviewFields_withName) {
                    if (isset($product[$arrPreviewFields_withName["code"]]) and $product[$arrPreviewFields_withName["code"]] != '') {
                        $short_description .= '<span class="name_short">' . $arrPreviewFields_withName["name_short"] . ":</span>&nbsp;" . $product[$arrPreviewFields_withName["code"]] . $arrPreviewFields_withName["units"] . ", ";
                    }
                }
                $short_description = trim($short_description, ", ");
            } else $short_description = "";
            ?>
            <tr class="tr_product_<?= $product["model"]; ?>">
                <td class="td_preview_image">
                    <a href="<?= $product["link_detail_page"]; ?>">
                        <div class="preview_image">
                            <img alt="<?= $product["model"]; ?>" loading="lazy"
                                 src="<?= $arSettings['path_to_product_images'] . mb_strtolower($product["brand"]) . "/" . mb_strtolower($product["type"]) . "/" . $product["model"] ?>/130/<?= $product["model"] ?>_1.webp">
                        </div>
                    </a>
                </td>
                <td class="td_model"><a href="<?= $product["link_detail_page"]; ?>"><span
                                class="model"><? echo $diagonal . " " . $product["short_name"] . " " . $product["brand"] . " " . $product["model"]; ?></span></a>
                </td>
                <td class="td_short_description">
                    <a href="<?= $product["link_detail_page"]; ?>">
                        <?= $product["preview_text"]; ?>; <span> <?= $product["preview_text_extra"]; ?> </span>
                    </a>
                </td>
                <td class="td_onstock">
                    <a href="<?= $product["link_detail_page"]; ?>">
                        <?
                        if ($product['onstock_spb'] > 0 or $product['onstock_msk'] > 0) {
                            echo '<span class="green">В&nbsp;наличии</span>';
                        } else echo '<span class="red">Под&nbsp;заказ</span>';
                        ?>
                    </a>
                </td>
                <td class="td_price">
                    <a href="<?= $product["link_detail_page"]; ?>">
                        <?
                        if (isset($product['retail_price']) and intval($product['retail_price']) > 0 and $product["retail_price_hide"] == 0) {
                            echo $product['retail_price']; ?>&nbsp;<?
                            switch ($product['currency']) {
                                case 'USD':
                                    echo '<span class="usd">$</span>';
                                    if ($usd_currency) {
                                        ?>
                                        <div class="rub_price"><? echo intval($product['retail_price'] * $usd_currency); ?> р.</div>
                                        <?
                                    }
                                    break;
                                case 'RUR':
                                    echo '<span class="rub">Р</span>';
                                    break;
                            }
                        } else {
                            echo '<span class="no_price">Цена по запросу</span>';
                        }
                        ?>
                    </a>
                </td>
                <td class="td_buttons">
                    <div class="buttons_panel">
                        <button title="Добавить в избранное" class="favorites" @click="add_too_box"
                                data-model="<?= $product["model"]; ?>" data-box="favorites"><span></span>В избранное
                        </button>
                        <button title="Добавить в сравнение" class="compare" @click="add_too_box"
                                data-model="<?= $product["model"]; ?>" data-box="compare"><span></span>В сравнение
                        </button>
                        <button title="Добавить в корзину" class="cart" @click="add_too_box"
                                data-model="<?= $product["model"]; ?>" data-box="cart"><span></span>В корзину
                        </button>
                        <button title="Удалить из списка" class="viewed" @click="add_too_box"
                                data-model="<?= $product["model"]; ?>" data-box="delete_from_viewed"><span></span>Удалить
                        </button>
                    </div>
                </td>
            </tr>
        <? }
    } else {
        echo "<hr>Нет товаров...<hr>";
    }
    ?>
</table>