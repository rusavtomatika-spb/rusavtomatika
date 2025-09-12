<?
global $product;
global $usd_currency, $arSettings;

if (isset($product["diagonal"]) and $product["diagonal"] != "" and $product["diagonal"] != 0 and $product["diagonal_hide"] == 0) {
    $product["diagonal"] = str_replace(".0", "", $product["diagonal"]);
    $diagonal = '<b>' . $product["diagonal"] . '&Prime;&nbsp;</b>';
} else $diagonal = '';

if (!(isset($product["link_detail2"]) and $product["link_detail2"] != "")) {
    $link = "/" . strtolower($product["brand"]) . "/" . $product["model"] . "/";
} else $link = $product["link_detail2"];

//file_put_contents(__DIR__."/test.txt",print_r($product,true),FILE_APPEND);
?>
<tr class="tr_product_<?= $product["model"]; ?> <?= "freqs_" . $product['freqs'] ?> <?= "series_" . $product['series'] ?> <?= "type_" . $product['type'] ?>">

    <td class="td_preview_image product_id_<?= $product["index"]; ?>">
        <a target="_blank" href="<?= $link ?>">
            <div class="preview_image">
                <img alt="<?= $product["model"]; ?>" loading="lazy"
                     src="<?= $arSettings['path_to_product_images'] . mb_strtolower($product["brand"]) . "/" . mb_strtolower($product["type"]) . "/" . $product["model"] ?>/130/<?= $product["model"] ?>_1.webp">
            </div>
        </a>
    </td>
    <td class="td_short_description">
        <?

        ?>
        <a target="_blank" href="<?= $link; ?>"><span class="model">

                <?
                if ($product["brand"] == 'IFC' and 0) {
                    $brand = '';
                } else {
                    $brand = $product["brand"];
                }
                if (isset($product["h1"]) and $product["h1"] != "") echo $product["h1"];
                elseif (isset($product["model_fullname"]) and $product["model_fullname"] != "") echo $product["model_fullname"];
                else echo $product["model"];
                ?></span>
        </a>
        <div class="series_products__panel_buttons">
            <span class="brand"><? echo $brand; ?></span>
            <span class="buttons_add">
                        <span title="Добавить в избранное" class="series_products__button favorites"
                              @click="add_too_box"
                              data-model="<?= $product["model"]; ?>" data-box="favorites"><span></span>В избранное
                        </span>
                        <span title="Добавить в сравнение" class="series_products__button compare" @click="add_too_box"
                              data-model="<?= $product["model"]; ?>" data-box="compare"><span></span>В сравнение
                        </span>
                        </span>
        </div>
    </td>
    <td class="td_buttons">
        <div class="indicator_availability">
            <?
            if ($product['onstock_spb'] > 0 or $product['onstock_msk'] > 0) {
                echo '<span class="green">В&nbsp;наличии</span>';
            } else echo '<span class="red">Под&nbsp;заказ</span>';
            ?>
        </div>
        <div class="price_block_wrapper">
            <div class="price_block"><?
                if (isset($product['retail_price']) and intval($product['retail_price']) > 0 and $product["retail_price_hide"] == 0) {

                    switch ($product['currency']) {
                        case 'USD':
                            echo '<span><span class="value">' . $product['retail_price'] . '</span>';
                            echo '&nbsp;<span class="usd">$</span></span>';
                            if ($usd_currency) {
                                ?>
                                <div class="rub_price"><? echo intval($product['retail_price'] * $usd_currency); ?>
                                    &#8381;
                                </div>
                                <?
                            }
                            break;
                        case 'RUR':
                            ?><?
                            if ($usd_currency) {
                                ?><span><span class="value"><? echo intval($product['retail_price'] / $usd_currency); ?>&nbsp;$</span>
                                </span>
                                <span class="rub_price">
                                                <?
                                                echo $product['retail_price'] . ' <span class="rub">&#8381;</span>'; ?>
                                            </span>
                            <? } else {
                                echo $product['retail_price'] . ' <span class="rub">&#8381;</span>';
                            }

                            break;
                    }
                } else {
                    echo '<span class="no_price series_products__button" data-rel-model="' . $product['model'] . '" @click="open_form_require_price">Запросить цену</span>';
                    if (isset($_COOKIE["dev_mode"]) and $_COOKIE["dev_mode"] > 0) {
                        echo '<span class="show_in_dev_mode">' . $product['retail_price'] . '</span>';
                    }
                }
                ?>
            </div>
        </div>
        <div class="buttons_panel">
            <button title="Добавить в заказ" class="series_products__button cart" @click="add_too_box"
                    data-model="<?= $product["model"]; ?>" data-box="cart"><span></span>В заказ
            </button>
        </div>
    </td>
</tr>

