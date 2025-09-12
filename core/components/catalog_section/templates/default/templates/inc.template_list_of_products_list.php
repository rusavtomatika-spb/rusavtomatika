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
                $product["diagonal"] = str_replace(".0", "", $product["diagonal"]);
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
            <tr class="tr_product_<?= $product["model"]; ?>" data-type="<?=$product['type']?>" data-series="<?=$product['series']?>">
                <td class="td_preview_image">
                    <?
                    /*
                    <a href="<?= $product["link_detail_page"]; ?>">
                        <div class="preview_image"
                             style="background-image:url('<?= $arSettings['path_to_product_images'] . mb_strtolower($product["brand"]) . "/" . mb_strtolower($product["type"]) . "/" . $product["model"] ?>/md/<?= $product["model"] ?>_1.png');">                    </div>
                    </a>

                    */

                    ?>


                    <a href="<?= $product["link_detail_page"]; ?>">
                        <?

                        if($product["brand"] == "Faraday"):
                            $model = str_replace("/", "_", $product["model"]);
                            $model = str_replace(" ", "_", $model);

                            $image_src = $arSettings['path_to_product_images'] . mb_strtolower($product["brand"]) . "/" .
                                mb_strtolower($product["type"]) . "/" . $model."/130/". $model."_1.webp";
                            else:
                            $image_src = $arSettings['path_to_product_images'] . mb_strtolower($product["brand"]) . "/" .
                                mb_strtolower($product["type"]) . "/" . $product["model"]."/130/". $product["model"]."_1.webp";
                                endif;

                        ?>

                        <div class="preview_image">
                            <?
                             if($_SERVER["HTTP_HOST"] == "www.rusavtomatika.com"){
                                 $image_src = "/upload_files".$image_src;
                             }
                            ?>
                            <img alt="<?= $product["short_name"]?> <? if ($product["brand"] != 'IFC') { echo $product["brand"];} ?> <?=$product["model"];?>" loading="lazy"
                                 src="<?=$image_src?>">
                        </div>
                    </a>
                </td>
                <td class="td_short_description">
                    <a href="<?= $product["link_detail_page"]; ?>"><span
                                class="model"><?
                            if ($product["brand"] == 'IFC' and 0) {
                                $brand = '';
                            } else {
                                $brand = $product["brand"];
                            }
                            echo $product["model"];
                            ?></span></a>

                    <a href="<?= $product["link_detail_page"]; ?>">
                        <div><? echo $diagonal . " " . $product["short_name"]; ?></div>
                    </a>


                    <span class="preview_text"><?= $product["preview_text"]; ?></span>;<span class="preview_text_extra"> <?= $product["preview_text_extra"]; ?> </span>
                    <div class="series_products__panel_buttons">
                        <?
                        if(in_array($brand,["Weintek","IFC","Aplex","Samkoon","eWON","Faraday"])){
                        ?><a class="brand" href="/<? echo strtolower($brand); ?>/"><? echo $brand; ?></a><?
                        }else{
                            ?><span class="brand"><? echo $brand; ?></span><?
                        }
                        ?>

                        <span class="buttons_add">
                        <span title="Добавить в сравнение" class="series_products__button compare" @click="add_too_box"
                              data-model="<?= $product["model"]; ?>" data-box="compare"><span></span>В сравнение
                        </span>
                        <span title="Добавить в избранное" class="series_products__button favorites"
                              @click="add_too_box"
                              data-model="<?= $product["model"]; ?>" data-box="favorites"><span></span>В избранное
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
                                            ?><span><span class="value"><? echo intval($product['retail_price'] / $usd_currency); ?>&nbsp;$</span></span>
                                            <span class="rub_price">
                                                <?
                                                echo $product['retail_price'] . ' <span class="rub">&#8381;</span>'; ?>
                                            </span>
                                        <? }
                                        else{
                                            echo $product['retail_price'] . ' <span class="rub">&#8381;</span>';
                                        }

                                        break;
                                }
                            } else {
                                echo '<span class="no_price series_products__button" data-rel-model="' . $product['model'] . '" @click="open_form_require_price">Запросить цену</span>';
                                if(isset($_COOKIE["dev_mode"]) and $_COOKIE["dev_mode"] > 0){
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
        <? }
    } else {
        echo "<hr>Нет товаров...<hr>";
    }

    ?>
</table>
