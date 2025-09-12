<?php
/*if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/usdrate.txt")) {
    $usd_currency = floatval(file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/usdrate.txt"));
} else $usd_currency = 0;*/
global $usd_currency, $arSettings;

?>
<div class="series_products">
  <?
  if ( isset( $series[ "products" ] )and is_array( $series[ "products" ] ) ) {
    foreach ( $series[ "products" ] as $product ) {
      if ( isset( $product[ "diagonal" ] )and $product[ "diagonal" ] != ""
        and $product[ "diagonal" ] != 0 and $product[ "diagonal_hide" ] == 0 ) {
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
        $diagonal = '<b>' . $product[ "diagonal" ] . '&Prime;&nbsp;</b>';
      } else $diagonal = '';

      if ( isset( $arrPreviewFields_withNames )and is_array( $arrPreviewFields_withNames ) ) {
        $short_description = "";
        foreach ( $arrPreviewFields_withNames as $arrPreviewFields_withName ) {
          if ( isset( $product[ $arrPreviewFields_withName[ "code" ] ] )and $product[ $arrPreviewFields_withName[ "code" ] ] != '' ) {
            $short_description .= '<span class="name_short">' . $arrPreviewFields_withName[ "name_short" ] . ":</span>&nbsp;" . $product[ $arrPreviewFields_withName[ "code" ] ] . $arrPreviewFields_withName[ "units" ] . ", ";
          }
        }
        $short_description = trim( $short_description, ", " );
      } else $short_description = "";
      ?>
  <div class="tr columns tr_product_<?= $product["model"]; ?>" style="text-align: center;">
    <div class="td_preview_image is-narrow column is-full-mobile is-3-tablet is-2-desktop"> <a href="<?= $product["link_detail_page"]; ?>">
      <div class="preview_image"> <img alt="<?= $product["model"]; ?>" loading="lazy" src="<?= $arSettings['path_to_product_images'] . mb_strtolower($product["brand"]) . "/" . mb_strtolower($product["type"]) . "/" . $product["model"] ?>/580/<?= $product["model"] ?>_1.webp"> </div>
      </a></div>
    <div class="td_model column is-6-desktop is-5-tablet is-6-widescreen" style="text-align: left;"><a href="<?= $product["link_detail_page"]; ?>"><span class="model"><? echo $diagonal . " " . $product["short_name"] . " " . $product["brand"] . " " . $product["model"]; ?></span></a> <br>
      
      <!--a href="<?= $product["link_detail_page"]; ?>"-->
      <?= $product["preview_text"]; ?>
      ; <span>
      <?= $product["preview_text_extra"]; ?>
      </span> 
      <!--/a-->
    </div>
    <div class=" column td_price is-2-desktop" style="padding:0 15px;">
      <div class="price_block is-center">
        <?
        if ( isset( $product[ 'retail_price' ] )and intval( $product[ 'retail_price' ] ) > 0 and $product[ "retail_price_hide" ] == 0 ) {
          switch ( $product[ 'currency' ] ) {
            case 'USD':
              ?>
        <div class="usd_price"> <span class="usd_price_value" data-model="<?=$product["model"]?>">
          <?= $product['retail_price'] ?>
          </span> <span class="usd">$</span> </div>
        <?
        if ( $usd_currency ) {
          ?>
        <div class="rub_price"> <span class="rub_price_value" data-model="<?=$product["model"]?>"><? echo intval($product['retail_price'] * $usd_currency); ?></span> <span class="usd">&#8381;</span> </div>
        <?
        }
        break;
        case 'RUR':
          if ( $usd_currency ) {
            ?>
        <div class="usd_price"> <span class="usd_price_value" data-model="<?=$product["model"]?>"><? echo intval($product['retail_price'] / $usd_currency); ?></span> <span class="usd">$</span></div>
        <?
        }
        ?>
        <div class="rub_price"> <span class="rub_price_value" data-model="<?=$product["model"]?>">
          <?= $product['retail_price'] ?>
          </span> <span class="rub">&#8381;</span></div>
        <?
        break;
        }
        $class_no_price = "";
        }
        else {
          echo '<span class="no_price">Цена по<br>запросу</span>';
          $class_no_price = "no_price";
          //echo $product['retail_price'];
        }
        ?>
      </div>
      <div class="td_onstock is-narrow">
        <?
        if ( $product[ 'onstock_spb' ] > 0 or $product[ 'onstock_msk' ] > 0 ) {
          echo '<span class="green"><span class="green"><i class="fa-solid fa-check"></i>&nbsp;В&nbsp;наличии</span>';
        } else echo '<span class="black">Под&nbsp;заказ</span>';
        ?>
      </div>
    </div>
    <div class="td_buttons column is-1 is-2-tablet is-2-desktop">
      <div class="buttons_panel is-flex is-justify-content-center">
        <button title="Добавить в избранное" class="favorites fa-solid fa-heart mr-1" @click="add_too_box" data-model="<?= $product["model"]; ?>" data-box="favorites"></button>
        <button title="Добавить в сравнение" class="compare fa-solid fa-align-right fa-rotate-90 mr-1" @click="add_too_box" data-model="<?= $product["model"]; ?>" data-box="compare"></button>
        <button title="Удалить" class="cart fa-solid fa-xmark" @click="add_too_box" data-model="<?= $product["model"]; ?>" data-box="delete_from_cart"></button>
      </div>
    </div>
    <div class="is-clearfix">&nbsp;</div>
  </div>
  <?
  }
  } else {
    echo "<hr>Нет товаров...<hr>";
  }

  ?>
</div>
