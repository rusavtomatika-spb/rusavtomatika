<?php
/*if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/usdrate.txt")) {
    $usd_currency = floatval(file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/usdrate.txt"));
} else $usd_currency = 0;*/
global $usd_currency, $arSettings;

?>
<table class="series_products">
    <?
    if (isset($series["products"]) and is_array($series["products"])) {
        foreach ($series["products"] as $product) {
            if (isset($product["diagonal"]) and $product["diagonal"] != "" and $product["diagonal"] != 0 and $product["diagonal_hide"] == 0) {
                /*            if(count($arDiagonals) > 0 and !in_array($product["diagonal"], $arDiagonals)){
                                continue;
                            }
                            if(count($arDiagonals) > 0 and !in_array($product["diagonal"], $arDiagonals)){
                                continue;
                            }

                            if (isset($range_diagonal_min) and $range_diagonal_min != '' and floatval($product["diagonal"]) < floatval($range_diagonal_min)) {
                                continue;
                            }
                            if (isset($range_diagonal_max) and $range_diagonal_max != '' and floatval($product["diagonal"]) > floatval($range_diagonal_max)) {
                                continue;
                            }*/
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
                                 src="<?= $arSettings['path_to_product_images'] . mb_strtolower($product["brand"]) . "/" . mb_strtolower($product["type"]) . "/" . $product["model"] ?>/190/<?= $product["model"] ?>_1.webp">
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
                        } elseif($product['discontinued'] == '1'){
                            echo '<span class="red">Снято&nbsp;с&nbsp;производства</span>';
                        }else{
                            echo '<span class="red">Под&nbsp;заказ</span>';
                        }
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
                                        <div class="rub_price"><? echo intval($product['retail_price'] * $usd_currency); ?>
                                            р.
                                        </div>

                                        <?
                                    }

                                    break;
                                case 'RUR':
                                    echo '<span class="rub">Р</span>';
                                    break;
                            }
                        } else {
                            echo '<span class="no_price">Цена по запросу</span>';
                            //echo $product['retail_price'];
                        }
                        ?>
                    </a>
                </td>
                <td class="td_buttons">
                    <div class="buttons_panel">
                        <button title="Добавить в избранное" class="favorites" @click="add_too_box"
                                data-model="<?= $product["model"]; ?>" data-box="favorites"><span></span>Удалить
                        </button>
                        <button title="Добавить в сравнение" class="compare" @click="add_too_box"
                                data-model="<?= $product["model"]; ?>" data-box="compare"><span></span>В сравнение
                        </button>
                        <button title="Добавить в корзину" class="cart" @click="add_too_box"
                                data-model="<?= $product["model"]; ?>" data-box="cart"><span></span>В корзину
                        </button>
                    </div>
                </td>
            </tr>
        <? }
    }
    else{
        echo "<hr>Нет товаров...<hr>";
    }

    ?>
</table>
