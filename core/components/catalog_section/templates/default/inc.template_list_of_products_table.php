<?php
if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/usdrate.txt")) {
    $usd_currency = floatval(file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/usdrate.txt"));
} else $usd_currency = 0;


?>
<table class="series_products">
    <?
    foreach ($series["products"] as $product) {

        if (isset($product["diagonal"]) and $product["diagonal"] != "" and $product["diagonal"] != 0) {
            $diagonal = $product["diagonal"] . '&Prime;&nbsp;';
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
        <tr>
            <td class="td_preview_image">
                <a href="<?= $product["link_detail_page"]; ?>">
                    <div class="preview_image"
                         style="background-image:url('<?= $arSettings['path_to_product_images'] . mb_strtolower($product["brand"]) . "/" . mb_strtolower($product["type"]) . "/" . $product["model"] ?>/sm/<?= $product["model"] ?>_1.png');">
                    </div>
                </a>
            </td>
            <td class="td_model"><a href="<?= $product["link_detail_page"]; ?>"><span
                            class="model"><? echo $diagonal . $product["model"]; ?></span></a></td>
            <td class="td_short_description"><a
                        href="<?= $product["link_detail_page"]; ?>"><?= $product["preview_text"];  ?></a></td>
            <td class="td_onstock">
                <a href="<?= $product["link_detail_page"]; ?>">
                <?
                if ($product['onstock_spb'] > 0 or $product['onstock_msk'] > 0) {
                    echo '<span class="green">�&nbsp;�������</span>';
                } else echo '<span class="red">���&nbsp;�����</span>';
                ?>
                </a>
            </td>
            <td class="td_price">
                <a href="<?= $product["link_detail_page"]; ?>">
                    <?
                    if (isset($product['retail_price']) and intval($product['retail_price']) > 0) {
                        echo $product['retail_price']; ?>&nbsp;<?
                        switch ($product['currency']) {
                            case 'USD':
                                echo '<span class="usd">$</span>';

                                if ($usd_currency) {
                                    ?>
                                    <div class="rub_price"><? echo intval($product['retail_price'] * $usd_currency); ?> �.
                                    </div>
                                    <?
                                }
                                break;
                            case 'RUR':
                                echo '<span class="rub">�</span>';
                                break;
                        }
                    } else {
                        echo '<span class="no_price">���� �� �������</span>';
                    }
                    ?>
                </a>
            </td>
            <td class="td_buttons">
                <div class="buttons_panel">
                    <button title="�������� � ��������" class="favorite"></button>
                    <button title="�������� � ���������" class="compare"></button>
                    <button title="��������" class="cart"></button>
                </div>
            </td>
        </tr>
    <? }
    ?>
</table>
