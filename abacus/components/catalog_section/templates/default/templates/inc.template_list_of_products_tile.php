<?php

/*if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/usdrate.txt")) {

    $usd_currency = floatval(file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/usdrate.txt"));

} else $usd_currency = 0;*/

global $usd_currency, $arSettings;

//echo $_SERVER['SCRIPT_NAME'];



?>

<div class="<? if ( defined('SERVER_RENDERING')) {echo " IS_SERVER_RENDERING ";} else { echo " IS_NOT_SERVER_RENDERING "; }?> series_products_tiles fixed-grid has-1-cols-mobile has-2-cols-tablet has-3-cols-desktop">

  <div class="grid">

  <?

    if (isset($series["products"]) and is_array($series["products"])) {
if (preg_match('/(operator_panels|industrial-communication-equipment)/i',$_SERVER[ "QUERY_STRING" ]))	{
usort($series["products"], function ($a, $b) {
    $valueA = intval($a['sort']); // Приводим строку к числу
    $valueB = intval($b['sort']); // Приводим строку к числу

    // Проверяем условие сортировки по возрастанию
    if ($valueA === $valueB) {
        return 0; // Элементы равны
    } elseif ($valueA < $valueB) {
        return -1; // Первый элемент меньше, значит идет раньше
    } else {
        return 1; // Первый элемент больше, значит идет позже
    }
});
}

        foreach ($series["products"] as $product) {

			//if ((preg_match('/(operator_panels)/i',$_SERVER[ "QUERY_STRING" ]) && !preg_match('/(screenless)/i',$_SERVER[ "QUERY_STRING" ])) && ($product["screenless"] == 1) && preg_match('/(series=cMT-X)/i',$_SERVER[ "QUERY_STRING" ]) && preg_match('/cMT/i',$product["series"]) ) continue;

			if ((preg_match('/(operator_panels)/i',$_SERVER[ "QUERY_STRING" ]) && !preg_match('/(screenless)/i',$_SERVER[ "QUERY_STRING" ])) && ($product["screenless"] == 1) && !preg_match('/(series)/i',$_SERVER[ "QUERY_STRING" ]) ) continue;



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

			$prod_serie = $product["series"];

			$prod_series = explode(',',$product['series']);

			$all_series = get_all_series();

            ?>

  <div class="tr_product_<?= $product["model"]; ?> tile" data-type="<?=$product['type']?>" data-series="<?=$product['series']?> cell">

    <div class="preview">

      <?

                    /*

                    <a href="<?= $product["link_detail_page"]; ?>">

                        <div class="preview_image"

                             style="background-image:url('<?= $arSettings['path_to_product_images'] . mb_strtolower($product["brand"]) . "/" . mb_strtolower($product["type"]) . "/" . $product["model"] ?>/md/<?= $product["model"] ?>_1.png');">                    </div>

                    </a>



                    */



                    ?>

      <?



                        if($product["brand"] == "Faraday"):

                            $model = str_replace("/", "_", $product["model"]);

                            $model = str_replace(" ", "_", $model);



                            $image_src = $arSettings['path_to_product_images'] . mb_strtolower($product["brand"]) . "/" .

                                mb_strtolower($product["type"]) . "/" . $model."/580/". $model."_1.webp";

                            else:

                            $image_src = $arSettings['path_to_product_images'] . mb_strtolower($product["brand"]) . "/" .

                                mb_strtolower($product["type"]) . "/" . $product["model"]."/580/". $product["model"]."_1.webp";

                                endif;



                        ?>

      <div class="preview_image">

        <?

                             if($_SERVER["HTTP_HOST"] == "www.rusavtomatika.com"){

                                 $image_src = "/upload_files".$image_src;

                             }

                            ?>

        <?

                            if ($product["brand"] == 'IFC' and 0) {

                                $brand = '';

                            } else {

                                $brand = $product["brand"];

                            }

                            ?>

        <?

                        if(in_array($brand,["Weintek","IFC","Aplex","Samkoon","eWON","Faraday"])){

                        ?>

        <a class="brand_plate" href="/<? echo strtolower($brand); ?>/"><? echo $brand; ?></a>

        <?

                        }else{

                            ?>

        <span class="brand_plate"><? echo $brand; ?></span>

        <?

                        }

                        ?>

        <a href="<?= $product["link_detail_page"]; ?>"> <img alt="<?= $product["short_name"]?> <? if ($product["brand"] != 'IFC') { echo $product["brand"];} ?> <?=$product["model"];?>" loading="lazy"

                                 src="<?=$image_src?>"></a> </div>

    </div>

     <div class="td_short_description"><a href="<?= $product["link_detail_page"]; ?>"><span

                                class="model"> <? echo $product["model"];?> </span> 

      <div class="preview_text_block">

        <div class="has-text-weight-bold"><? echo $diagonal . " " . $product["short_name"]; ?></div></a>

		 <p>

          <? if (count($prod_series)>0){ 

			echo '<span>Серия: ';

							$prev_ser = '';

							foreach ($prod_series as $ind=>$serie) {

								foreach ($all_series as $i=>$all_serie) {

					$pattern = '/[^_,\w]*'.$product["type"].'[^_,\w]*/im';

					if ($all_serie['name'] != 'INDUSTRIAL' && $all_serie['name'] != $prev_ser && $all_serie['name'] == $serie && preg_match($pattern,$all_serie["type"] ) && preg_match($pattern,$all_serie["type"] ))

					//if ($all_serie['name'] == $serie  && preg_match($pattern,$all_serie["type"] ) && $all_serie["type"] == $product["type"])

					//if ($all_serie['name'] == $serie  && preg_match($pattern,$all_serie["type"] ))

                    echo '<a class="tag mr-1" href="/catalog/'.$all_serie['menu_category_item_code'].'/?&series='.$all_serie['name'].'">'.$all_serie['name'].'</a>';

					$prev_ser = $all_serie['name'];

								}

							}

			echo '</span> ';			}

			 ?>

			</p>

        <a href="<?= $product["link_detail_page"]; ?>"><span class="preview_text">

        <?= $product["preview_text"]; ?>

        </span>;<span class="preview_text_extra">

        <?= $product["preview_text_extra"]; ?>

        </span></a></div>

       </div>

    <div class="td_buttons">

      <div class="series_products__panel_buttons">

        <div class="price_block">

          <div class="price_block_wrapper">

            <div class="price_block">

              <?

                            if (isset($product['retail_price']) and intval($product['retail_price']) > 0 and $product["retail_price_hide"] == 0) {



                                switch ($product['currency']) {

                                    case 'USD':

                                        echo '<div class="usd_price"><span class="value">' . $product['retail_price'] . '</span>';

                                        echo '&nbsp;<span class="usd">$</span>';

										if ($product['action_price'] > 0) {

										echo '<br><span class="act_price"><span class="value">' . $product['action_price'] . '</span>';

                                        echo '&nbsp;<span class="usd">$</span></span>';

										}

										echo '</div>';

                                        if ($usd_currency) {

                                            ?>

              <div class="rub_price"><? echo intval($product['retail_price'] * $usd_currency); ?> &#8381; </div>

              <?

                                        }

                                        break;

                                    case 'RUR':

                                        ?>

              <?

                                        if ($usd_currency) {

                                            ?>

              <span><span class="value"><? echo intval($product['retail_price']); ?>&nbsp;&#8381;</span>



				</span> 

										<? if ($product['action_price'] > 0) {

										echo '<span class="act_price"><span class="value">' . $product['action_price'] . '</span>';

                                        echo '&nbsp;<span class="usd">&#8381;</span></span>';

										} ?>

              <?

                                                //echo $product['retail_price'] . ' <span class="rub">&#8381;</span>'; ?>

				

              <? }

                                        else{

                                            echo $product['retail_price'] . ' <span class="rub">&#8381;</span>';

                                        }



                                        break;

                                }

                            } else {

                                echo '<span class="no_price series_products__button" data-rel-model="' . $product['model'] . '" @click="open_form_require_price"><i class="fa-solid fa-comment-dollar"></i>&nbsp;Запросить цену</span>';

                                if(isset($_COOKIE["dev_mode"]) and $_COOKIE["dev_mode"] > 0){

                                    echo '<span class="show_in_dev_mode">' . $product['retail_price'] . '</span>';

                                }

                            }

                            ?>

            </div>

          </div>

          <div class="indicator_availability">

            <?

                        if ($product['onstock_spb'] > 0 or $product['onstock_msk'] > 0) {

                            echo '<span style="color:#00ad61"><i class="fa-solid fa-check"></i>&nbsp;В&nbsp;наличии</span>';

                        } else echo '<span class="red"><i class="fa-solid fa-clipboard-check"></i>&nbsp;Под&nbsp;заказ</span>';

                        ?>

          </div>

        </div>

      </div>

      <div class="buttons_panel">

        <div class="buttons_add">

          <div title="Добавить в сравнение" class="series_products__button compare butt fa-solid fa-align-right fa-rotate-90" @click="add_too_box" data-model="<?= $product["model"]; ?>" data-box="compare"></div>

          <div title="Добавить в избранное" class="series_products__button favorites butt fa-regular fa-heart" @click="add_too_box" data-model="<?= $product["model"]; ?>" data-box="favorites"></div>

        </div>

        <button title="Добавить в заказ" class="series_products__button cart" @click="add_too_box"

                                data-model="<?= $product["model"]; ?>" data-box="cart"><i class="fa-solid fa-cart-plus" style="font-size: 20px"></i><span style="position: relative;top: -1px; font-size: 18px;">&nbsp;&nbsp;&nbsp;В&nbsp;ЗАКАЗ</span></button>

      </div>

    </div>

  </div>

  <? }

		

		

		

    } else {

        echo "<hr>Нет товаров...<hr>";

    }



    ?>

</div>

</div>

