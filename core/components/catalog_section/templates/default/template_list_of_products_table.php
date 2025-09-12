<table>
    <?
    foreach ($series["products"] as $product) {
        if (isset($product["diagonal"]) and $product["diagonal"] != "") $diagonal = $product["diagonal"] . '&Prime;&nbsp;';
        else $diagonal = '';
        if(isset($arrPreviewFields_withNames) and is_array($arrPreviewFields_withNames)){
            $short_description = "";
            foreach ($arrPreviewFields_withNames as $arrPreviewFields_withName) {

                $short_description .= '<span class="name_short">'.$arrPreviewFields_withName["name_short"].":</span>&nbsp;".$product[$arrPreviewFields_withName["code"]].$arrPreviewFields_withName["units"].", ";
            }
            $short_description = trim($short_description, ", ");
        }else $short_description = "";


        ?>
        <tr>
            <td class="td_preview_image">
                <a href=""><? $arguments["route_string"]."/".$product["brand"]."/".$product["series"]."/".$product["model"]."/";?></a>
                <pre><? var_dump($product); ?></pre>

                <div class="preview_image"
                     style="background-image:url('<?= $arSettings['path_to_product_images'] . mb_strtolower($product["brand"]) . "/" . mb_strtolower($product["type"]) . "/" . $product["model"] ?>/sm/<?= $product["model"] ?>_1.png');">
                </div>
            </td>
            <td class="td_model"><span class="model"><? echo $diagonal . $product["model"]; ?></span></td>
            <td class="td_short_description"><?=$short_description?></td>
            <td class="td_price">
                <?= $product['retail_price'] ?>
            </td>
            <td class="td_buttons">
                buttons
            </td>
        </tr>
    <? }
    ?>
</table>
