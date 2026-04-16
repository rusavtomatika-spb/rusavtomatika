<?

global $product;

global $usd_currency,$rur_currency, $arSettings;

if (isset($product["diagonal"]) and $product["diagonal"] != "" and $product["diagonal"] != 0 and $product["diagonal_hide"] == 0) {

    $product["diagonal"] = str_replace(".0", "", $product["diagonal"]);

    $diagonal = '<b>' . $product["diagonal"] . '&Prime;&nbsp;</b>';

} else $diagonal = '';



if (!(isset($product["link_detail2"]) and $product["link_detail2"] != "")) {

    $link = "/" . strtolower($product["brand"]) . "/" . $product["model"] . "/";

} else $link = $product["link_detail2"];



//file_put_contents(__DIR__."/test.txt",print_r($product,true),FILE_APPEND);

?>

<tr class="tr_product_<?= $product["model"]; ?> <?= "freqs_" . $product['freqs'] ?> <?= "series_" . $product['series'] ?> <?= "type_" . $product['type'] ?> <?= $userCountry ?>">



    <td class="td_preview_image product_id_<?= $product["index"]; ?>">

        <a target="_blank" href="<?= $link ?>">

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

        <?



        ?>

        <a target="_blank" href="<?= $link; ?>"><span class="model">



                <?

                if ($product["brand"] == 'IFC' and 0) {

                    $brand = '';

                } else {

                    $brand = $product["brand"];

                }

                if (isset($product["h1"]) and $product["h1"] != "") $s_h1 = $product["h1"];

                elseif (isset($product["model_fullname"]) and $product["model_fullname"] != "") $s_h1 =  $product["model_fullname"];

                else $s_h1 =  $product["model"] . " - ". str_replace(".0", "", $product["diagonal"]) ."&Prime; " . $product["short_name"] . " " . $product["brand"];
			
	$tech = array();
	if ($product["brand"] == 'Weintek') {
		if ($product["mqtt"] == 1) {
        $tech[] = "MQTT";
		}
		if ($product["easy_access"] == 'optional') {
        $tech[] = "EasyAccess2 опция";
		}
		if ($product["easy_access"] == 'build_in') {
        $tech[] = "EasyAccess2 с лиц.";
		}
		if ($product["opc_ua"] == 1) {
        $tech[] = "OPC UA клиент";
		}
		if ($product["opc_ua"] == 2) {
        $tech[] = "OPC UA клиент/сервер";
		}
		if ($product["opc_ua"] == 3) {
        $tech[] = "OPC UA клиент/сервер-опция";
		}
		if ($product["codesys"] == 'build_in') {
        $tech[] = "Codesys c лиц.";
		}
		if ($product["codesys"] == 'optional') {
        $tech[] = "Codesys опция";
		}
		if ($product["dashboard"] == 1) {
        $tech[] = "Dashboard";
		}
		if ($product["matrix"] != '') {
        $tech[] = $product["matrix"];
		}
    }
		if ($product["wifi_support"] == 1) {
        $tech[] = "Wi-Fi";
		}
		if ($product["wifi_support"] == 2) {
        $tech[] = "Wi-Fi опция";
		}
	if (count($tech)>0) {
		$tech_out = ' (' . implode(', ', $tech) . ')';
	}
    if (isset($tech_out) && $tech_out != FALSE) {
        $s_h1 .= $tech_out;
    }
		echo $s_h1;

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



            <?/* не учитывает, что снят с производства

            if ($product['onstock_spb'] > 0 or $product['onstock_msk'] > 0) {

                echo '<span class="green">В&nbsp;наличии</span>';

            } else echo '<span class="red">Под&nbsp;заказ</span>';

            */?>

            <?

            if ($product['discontinued'] == 0) {

                if (intval($product['onstock_spb']) > 0) {

                    echo '<span class="green">В&nbsp;наличии</span>';

                } else echo '<span class="red">Под&nbsp;заказ</span>';

            }

            else echo '<span class="red">Снят&nbsp;с&nbsp;производства</span>';

            ?>

        </div>

        <div class="price_block_wrapper">

            <div class="price_block"><?

                if ($product["discontinued"] == 0) { // проверяем, не снят ли товар с производства

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

                                ?><span><span class="value"><? echo $product['retail_price']; ?>&nbsp;&#8381;</span>

                                </span>

                                <span class="rub_price">

                                                <?

                                                echo intval($product['retail_price'] / $usd_currency) . ' <span class="rub">$</span>'; ?>

                                            </span>

                            <? } else {
                                echo intval($product['retail_price'])
                                 . ' <span class="rub">&#8381;</span>';

                            }



                            break;

                    }

                } else  {

                    echo '<span class="no_price series_products__button" data-rel-model="' . $product['model'] . '" @click="open_form_require_price">Запросить цену</span>';

                    if (isset($_COOKIE["dev_mode"]) and $_COOKIE["dev_mode"] > 0) {

                        echo '<span class="show_in_dev_mode">' . $product['retail_price'] . '</span>';

                    }

                }

                }

                ?>

            </div>

        </div>

        <? if ($product['discontinued'] == 0) {?>

        <div class="buttons_panel">

            <button title="Добавить в заказ" class="series_products__button cart" @click="add_too_box"

                    data-model="<?= $product["model"]; ?>" data-box="cart"><span></span>В заказ

            </button>

        </div>

        <?}?>

    </td>

</tr>



