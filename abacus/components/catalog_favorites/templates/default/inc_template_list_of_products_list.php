<?php
global $usd_currency, $arSettings;
?>
<div class="series_products">
  <?
  if ( isset( $series[ "products" ] )and is_array( $series[ "products" ] ) ) {
    foreach ( $series[ "products" ] as $product ) {
      if ( isset( $product[ "diagonal" ] )and $product[ "diagonal" ] != ""
        and $product[ "diagonal" ] != 0 and $product[ "diagonal_hide" ] == 0 ) {
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
    <div class="product__item-wrapper">
      <a href="<?= $product["link_detail_page"]; ?>" class="product__link-wrapper">
        <div class="preview_image">
          <img alt="<?= $product["model"]; ?>" loading="lazy" src="<?= $arSettings['path_to_product_images'] . mb_strtolower($product["brand"]) . "/" . mb_strtolower($product["type"]) . "/" . $product["model"] ?>/580/<?= $product["model"] ?>_1.webp">
        </div>
        <div class="product__description-wrapper">
          <h2 class="product__model"><? echo $product["h1"] ?></h2>
          <div><?= $product["preview_text"] ? $product["preview_text"] : $product["preview_text_extra"] ; ?></div>
        </div>
        <div class="price__stock-wrapper">
          <div class="price_block">
            <?
              if ( isset( $product[ 'retail_price' ] )and intval( $product[ 'retail_price' ] ) > 0 and $product[ "retail_price_hide" ] == 0 ) {
                switch ( $product[ 'currency' ] ) {
                  case 'USD':
            ?>
            <span class="usd_price_value" data-model="<?=$product["model"]?>"><?= $product['retail_price'] ?> $</span>
            <?
            if ( $usd_currency ) {
              ?>
                <span class="rub_price_value" data-model="<?=$product["model"]?>"><? echo intval($product['retail_price'] * $usd_currency); ?> ₽</span>
              <?
            }
            break;
            case 'RUR':
              if ( $usd_currency ) {
                ?>
                <span class="usd_price_value" data-model="<?=$product["model"]?>"><? echo intval($product['retail_price'] / $usd_currency); ?> $</span>
            <?
            }
            ?>
              <span class="rub_price_value" data-model="<?=$product["model"]?>"><?= $product['retail_price'] ?> ₽</span>
            <?
            break;
            }
            $class_no_price = "";
            }
            else {
              echo '<span class="no_price">Цена по запросу</span>';
              $class_no_price = "no_price";
            }
            ?>
          </div>
          <?
          if ( $product[ 'onstock_spb' ] > 0 or $product[ 'onstock_msk' ] > 0 ) {
            echo '<span class="green"><i class="fa-solid fa-check"></i> В наличии</span>';
          } else echo '<span class="red">Под заказ</span>';
          ?>
        </div>
      </a>
      <div class="product__actions-wrapper">
        <button title="Добавить в сравнение" class="fa-solid fa-align-right fa-rotate-90" @click="add_too_box" data-model="<?= $product["model"]; ?>" data-box="compare"></button>
        <button title="Удалить из избранного" class="fa-solid fa-xmark" @click="add_too_box" data-model="<?= $product["model"]; ?>" data-box="favorites"></button>
      </div>
    </div>
  <?
  }
  } else {
    echo "<hr>Нет товаров...<hr>";
  }
  ?>
</div>