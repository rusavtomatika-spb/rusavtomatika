<?php

require_once __DIR__ . '/inc_data_preparator.php';
//error_reporting( E_ALL ^ E_NOTICE );

global $TITLE;
global $DESCRIPTION;
global $DESCRIPTION_micro;
global $KEYWORDS;
global $CANONICAL;
global $H1;
global $SEO_URL;
global $UPPER_SEO_TEXT, $LOWER_SEO_TEXT, $model;
//ini_set("error_reporting", E_ALL);
//ini_set("display_errors", 1);
//ini_set("display_startup_errors", 1);

function startsWith( $haystack, $needle ) {
  return substr( $haystack, 0, strlen( $needle ) ) === $needle;
}

function transformString( $str ) {
  if ( !startsWith( $str, 'Faraday' ) ) {
    return $str;
  }

  list( $prefix, $suffix ) = explode( ' ', trim( $str ), 2 );
  $transformedSuffix = preg_replace( '/[\s\/]+/', '-', $suffix );
  return "$prefix-$transformedSuffix";
}


if ( ERROR_404 ) {
  global $TITLE;
  global $H1;
  $TITLE = $H1 = "Ошибка 404";
  CoreApplication::add_style( "/abacus/components/catalog/templates/default/style.css" );
  CoreApplication::add_breadcrumbs_chain( "Каталог оборудования", "/catalog/" );
  include "inc_404.php";
} else {
  CoreApplication::add_style( str_replace( $_SERVER[ "DOCUMENT_ROOT" ], "", __DIR__ ) . "/style.css" );
  CoreApplication::add_script( str_replace( $_SERVER[ "DOCUMENT_ROOT" ], "", __DIR__ ) . "/script.js" );

  CoreApplication::add_breadcrumbs_chain( $arResult[ 'section' ][ "name" ], "/catalog/" . $arResult[ 'section' ][ "code" ] . "/" );
  CoreApplication::add_breadcrumbs_chain( $H1 );
  $schemes = get_schemes( $arResult[ 'product' ][ "model" ] );
  //$mod_viewed = transformString($arResult['product']["model"]);

  ?>
<div id="vue_component_catalog_detail" data-model="<?= $arResult['product']["model"] ?>">
<div class="component_catalog_detail" itemscope itemtype="https://schema.org/Product">
<meta itemprop="model" content="<?= $arResult['product']['model'] ?>">
<span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
<?
if ( intval( $arResult[ 'product' ][ "price_usd_value" ] ) > 0 and $arResult[ 'product' ][ 'retail_price_hide' ] == "0" ): ?>
<meta itemprop="price" content="<?= $arResult['product']['price_usd_value'] ?>">
<meta itemprop="priceCurrency" content="<?= $arResult['product']['currency'] ?>">
<? endif; ?>
<? if ($arResult['product']["onstock_spb"] > 0): ?>
<link itemprop="availability" href="http://schema.org/InStock">
<? else: ?>
<link itemprop="availability" href="https://schema.org/PreOrder">
<? endif; ?>
<span itemprop="seller" itemscope itemtype="https://schema.org/Organization">
<meta itemprop="name" content="ООО Русавтоматика">
<meta itemprop="description"
              content="Поставка оборудования для автоматизации производства. Официальный дистрибьютор брендов Weintek, IFC, Aplex, Samkoon.">
<link itemprop="url" href="https://www.rusavtomatika.com/">
<span itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
<meta itemprop="addressLocality" content="Санкт-Петербург">
<meta itemprop="postalCode" content="199178">
<meta itemprop="streetAddress" content="Малый пр. В.О. 57 корп. 3">
</span>
<meta itemprop="telephone" content="+7 812 648-03-47">
<meta itemprop="email" content="sales@rusavtomatika.com">
</span> </span> <span itemprop="brand" itemscope itemtype="https://schema.org/Brand">
<meta itemprop="name" content="<?= $arResult['product']['brand'] ?>">
</span>
<div class="component_wrapper">
<?
CoreApplication::include_component( array( "component" => "breadcrumbs" ) );
?>
<section id="start">
  <div class="sticky_block_wrapper">
    <div class="sticky_block">
      <div class="sticky_block_wrap_inn">
        <div class="container is-widescreen">
          <div class="sticky_block_inner_wrapper">
            <div class="left"> <span class="metadata"
                                                  data-brand="<?= $arResult['product']["brand"] ?>"
                                                  data-type="<?= $arResult['product']["type"] ?>"
                                                  data-series="<?= $arResult['product']["series"] ?>"
                                            > </span>
              <h1 itemprop="name">
                <?= $H1; echo $arrChunks__; ?>
              </h1>
              <?
              echo $var_dump;
              if ( $arResult[ 'product' ][ 'brand' ] == "eWON" ) {
                include $_SERVER[ "DOCUMENT_ROOT" ] . "/include_utf_8/widgets/inc_no_ewon.php";
              }
              ?>
              <? if ($arResult['product']["replace_detail_text_with_file"] == ""): ?>
              <div class="component_catalog_detail__nav">
                <nav>
                  <div class="tabs is-boxed is-primary">
                    <ul>
                      <li class="is-active"> <a href="#start"> <span>Краткий обзор</span> </a> </li>
                      <li> <a href="#specifications"> <span>Характеристики</span> </a> </li>
                      <li> <a href="#dimensions"> <span>Габариты</span> </a> </li>
                      <?
                      if ( $schemes != '' ):
                        ?>
                      <li> <a href="#schemes"> <span>Схемы</span> </a> </li>
                      <? endif; ?>
                      <?
                      if ( $arResult[ 'product' ][ "set_tab_html" ] != '' ):
                        ?>
                      <li> <a href="#set_tab_html"> <span>Комплектность</span> </a> </li>
                      <? endif; ?>
                      <li> <a href="#files"> <span>Файлы</span> </a> </li>
                      <? if (isset($arResult['product']['text_seo'])&&$arResult['product']['text_seo']!='') : ?>
                      <li> <a href="#text"> <span>Описание</span> </a> </li>
                      <? endif ?>
                      <? if (count($arSelected_articles)>0) : ?>
                      <li> <a href="#articles"> <span>Статьи</span> </a> </li>
                      <? endif ?>
                      <? if (count($arSelected_videos)>0) : ?>
                      <li> <a href="#videos"> <span>Видео</span> </a> </li>
                      <? endif ?>
                      <li class="button_open_this_menu"> <span class="button_open_menu__icon"></span> </li>
                    </ul>
                  </div>
                </nav>
              </div>
              <? endif; ?>
            </div>
            <div class="right">
              <div class="component_catalog_detail__panel_info_currency_rate is-hidden-touch">
                <?
                global $usd_currency;
                if ( isset( $usd_currency )and $usd_currency > 0 ): ?>
                <div class="section_list_currency_block">
                  <div class="info">
                    <?
                    echo "1&nbsp;USD&nbsp;=&nbsp;" . $usd_currency . "&nbsp;РУБ";
                    ?>
                  </div>
                </div>
                <? endif; ?>
              </div>
              <div class="component_catalog_detail__small_info_block">
                <div class="component_catalog_detail__price">
                  <div class="item">
                    <div class="component_catalog_detail__small_info_block__image"> <img itemprop="image"
                                                                 class="img_product-inner"
                                                                 src="<? echo $arResult['imgRemoteDir'] . "130/" . $arResult['product']["arr_pics"][0]; ?>"
                                                                 alt="<?= $arResult['product']["model"] ?>"> </div>
                  </div>
                  <?

                  if ( intval( $arResult[ 'product' ][ "price_usd_value" ] ) > 0 and $arResult[ 'product' ][ 'retail_price_hide' ] == "0" ):
                    ?>
                  <div class="item price">
                    <div> <span class="price_usd_value">
                      <?= $arResult['product']['price_usd_value'] ?>
                      </span> <span class="price_usd_currency">
                      <?= $arResult['product']['price_usd_currency'] ?>
                      </span>
                      <? if ( intval( $arResult[ 'product' ][ "price_usd_act_value" ] ) > 0 ) { ?>
                      <span class="price_act">
                      <?= $arResult['product']['price_usd_act_value'] ?>
                      <?= $arResult['product']['price_usd_currency'] ?>
                      </span>
                      <? } ?>
                    </div>
                    <?
                    if ( intval( $arResult[ 'product' ][ "price_rub_value" ] ) > 0 ) {
                      ?>
                    <div> <span class="price_rub_value">
                      <?= $arResult['product']['price_rub_value'] ?>
                      </span> <span class="price_rub_currency">
                      <?= $arResult['product']['price_rub_currency'] ?>
                      </span>
                      <? if ( intval( $arResult[ 'product' ][ "price_rub_act_value" ] ) > 0 ) { ?>
                      <span class="price_act">
                      <?= $arResult['product']['price_rub_act_value'] ?>
                      <?= $arResult['product']['price_rub_currency'] ?>
                      </span>
                      <? } ?>
                    </div>
                    <?
                    }
                    ?>
                  </div>
                  <?
                  else :
                    ?>
                  <div class="button button_demand_price"
                                                         idm="<?= $arResult['product']["model"] ?>"
                                                         onclick="show_backup_call(6, &quot;<?= $arResult['product']["model"] ?>&quot;)"> Запросить&nbsp;цену </div>
                </div>
                <?
                endif;
                ?>
                <? if ($arResult['product']["discontinued"] != '1') { ?>
                <div @click="add_too_box" class='button is-primary add_to_cart'
                                                         data-model='<?= $arResult['product']["model"] ?>'
                                                         data-box="cart"> <span class="btn_icon_order"></span> <span class="btn_icon_order_text">В заказ</span> </div>
                <? } ?>
                <div @click="add_too_box"
                                                     class='button button_like_link add_to_compare'
                                                     data-model='<?= $arResult['product']["model"] ?>'
                                                     data-box="compare"> <span class="btn_icon"></span> <span class="btn_text">В сравнение</span> </div>
                <div @click="add_too_box"
                                                     class='button button_like_link add_to_favorites'
                                                     data-model='<?= $arResult['product']["model"] ?>'
                                                     data-box="favorites"> <span class="btn_icon"></span> <span class="btn_text">В избранное</span> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="">
    <div class="columns">
      <div class="column is-6">
        <?
        //echo CoreApplication::print_pictures_in_detail_template($arResult['product']["brand"], $arResult['product']["type"], $arResult['product']["model"], $arResult['product']["pics_number"]);
        ?>
        <div class="component_catalog_detail__images_wrapper">
          <?
          $counter = 0;
          if ( isset( $arResult[ 'product' ][ "arr_pics" ] )and count( $arResult[ 'product' ][ "arr_pics" ] ) > 0 ) {
            foreach ( $arResult[ 'product' ][ "arr_pics" ] as $image_url ):
              $counter++;
            ?>
          <a class="component_catalog_detail__image-main_link"
                                               id="component_catalog_detail__image-main_link_<?= $counter ?>"
                                               style="display: none;" data-fancybox="product"
                                                <?
                                                if ($arResult['product']["brand"] != "IFC") $brand = $arResult['product']["brand"];
                                                else $brand = "";
                                                ?>
                                               data-caption="<?
                                               if($arResult['product']["brand"] != "IFC") echo $arResult['product']["brand"]." ";
                                               echo  $arResult['product']["model"];
                                               ?>"
                                               href="<? echo $arResult['imgRemoteDir'] . "1330/" . $image_url ?>"> <img class="img_product-inner"
                                                     src="<? echo $arResult['imgRemoteDir'] . "580/" . $image_url ?>"
                                                     alt="<?= $arResult['product']["model"] . '_' . $counter ?>"> </a>
          <?
          endforeach;
          }
          ?>
          <?

          if ( isset( $arResult[ 'product' ][ "arr_pics" ] )and count( $arResult[ 'product' ][ "arr_pics" ] ) > 0 ):
            $num_pics = count( $arResult[ 'product' ][ "arr_pics" ] );
          ?>
          <div class="component_catalog_detail__images-mini__wrapper num_pics_<?= $num_pics ?>">
            <div class="component_catalog_detail__images-mini__inner">
              <?

              $counter = 0;
              foreach ( $arResult[ 'product' ][ "arr_pics" ] as $image_url ):
                $counter++;
              ?>
              <div data-rel="component_catalog_detail__image-main_link_<?= $counter ?>"
                                                         class="component_catalog_detail__images-mini"> <img src="<? echo $arResult['imgRemoteDir'] . "67/" . $image_url; ?>"
                                                             alt="<?= $arResult['product']["model"] . '_' . $counter ?>"/> </div>
              <?
              endforeach;

              ?>
            </div>
          </div>
          <?
          endif;
          ?>
        </div>
        <?
        if ( isset( $arResult[ 'product' ][ 'youtube_video' ] ) && $arResult[ 'product' ][ 'youtube_video' ] != '' ) {
          //          $youtube_video = '<div class="block_view_video">';
          $youtube_video = $arResult[ 'product' ][ 'youtube_video' ];
          //          $youtube_video .= '</div>';
        } else $youtube_video = '';
        echo $youtube_video;
        ?>
        <?
        if ( isset( $arResult[ 'product' ][ 'view360' ] ) && $arResult[ 'product' ][ 'view360' ] != '' ) {
          //          $view360 = '<div class="block_view_video">';
          $view360 = $arResult[ 'product' ][ 'view360' ];
          //          $view360 .= '</div>';
        } else $view360 = '';
        echo $view360;
        ?>
      </div>
      <div class="column is-6">
        <div class="component_catalog_detail__info_block">
          <div class="component_catalog_detail__info1">
            <div class="item">
              <?
              $prod_serie = $product[ "series" ];
              $prod_series = explode( ',', $product[ 'series' ] );
              $all_series = get_all_series();

              if ( in_array( $arResult[ 'product' ][ 'brand' ], [ "Weintek", "IFC", "Aplex", "Samkoon", "eWON", "Faraday", "Cincoze" ] ) ) {
                ?>
              <a href="/<? echo strtolower($arResult['product']['brand']); ?>/"> <span
                                                        class="info_tag info_brand">
              <?= $arResult['product']['brand'] ?>
              </span> </a>
              <?
              } else {
                ?>
              <span><span
                                                        class="info_tag info_brand">
              <?= $arResult['product']['brand'] ?>
              </span> </span>
              <?
              }
              ?>
              <?
              if ( count( $prod_series ) > 0 ) {
                echo '';
                foreach ( $prod_series as $ind => $serie ) {
                  foreach ( $all_series as $i => $all_serie ) {
                    $pattern = '/' . $product[ "type" ] . '/';
                    if ( $all_serie[ 'name' ] != 'INDUSTRIAL' && $all_serie[ 'name' ] == $serie && preg_match( $pattern, $all_serie[ "type" ] ) )
                      echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Серия: <a class="tag mr-1" href="/catalog/' . $all_serie[ 'menu_category_item_code' ] . '/?&series=' . $all_serie[ 'name' ] . '">' . $all_serie[ 'name' ] . '</a>';
                  }
                }
                echo '</span>';
              }
              ?>
            </div>
            <div class="item">
              <? if ($arResult['product']["discontinued"] == "1"): ?>
              <span class="info_button info_discontinued">снят с производства<br>
              не доступен для заказа</span>
              <? if ($arResult['product']["analogs"] != ""): ?>
              <br>
              <span class="info_button info_analogs">Аналоги:
              <?= $arResult['product']["analogs"] ?>
              </span>
              <? endif; ?>
              <? elseif ($arResult['product']["discontinued"] == "0"):?>
              <? if ($arResult['product']["onstock_spb"] > 0): ?>
              <span class="info_tag info_available">в наличии</span>
              <? elseif ($arResult['product']["onstock_spb"] < 0): ?>
              <span class="info_tag info_not_available">наличие уточняйте</span>
              <? elseif ($arResult['product']["discontinued"] != "1"): ?>
              <span class="info_tag info_not_available">под заказ</span>
              <? endif; ?>
              <? endif; ?>
            </div>
          </div>
          <div class="component_catalog_detail__info2"> </div>
          <div class="component_catalog_detail__price">
            <? if ($arResult['product']["discontinued"] != '1') { ?>
            <div class="item price">
              <?
              if ( intval( $arResult[ 'product' ][ "price_usd_value" ] ) > 0 and $arResult[ 'product' ][ 'retail_price_hide' ] == "0" ):
                ?>
              <div>
                <? if ( $arResult['product']['currency'] == 'USD' ) { ?>
                <span class="price_usd_value">
                <?= $arResult['product']['price_usd_value'] ?>
                </span> <span class="price_usd_currency">
                <?= $arResult['product']['price_usd_currency'] ?>
                </span>
                <? } ?>
                <? if ( intval( $arResult[ 'product' ][ "price_usd_act_value" ] ) > 0 ) { ?>
                <span class="price_act">
                <?= $arResult['product']['price_usd_act_value'] ?>
                <?= $arResult['product']['price_usd_currency'] ?>
                </span>
                <? } ?>
                <? if ( $arResult['product']['currency'] == 'USD' ) { ?>
                <br><span class="price_rub_value">
                <?= $arResult['product']['price_rub_value'] ?>
                <?= $arResult['product']['price_rub_currency'] ?>
                </span>
                <? } ?>
              </div>
              <?
              if ( intval( $arResult[ 'product' ][ "currency" ] ) == "RUR" ) {
                ?>
              <div>
                <? if ( $arResult['product']['currency'] == 'RUR' ) { ?>
                <span class="price_usd_value">
                <?= $arResult['product']['price_rub_value'] ?>
                <?= $arResult['product']['price_rub_currency'] ?>
                </span>
                <? } ?>
				  <? if ( intval( $arResult[ 'product' ][ "price_rub_act_value" ] ) > 0 ) { ?>
 <span class="price_act">
                <?= $arResult['product']['price_rub_act_value'] ?>
                <?= $arResult['product']['price_rub_currency'] ?>
                </span>
                <? } ?>
              </div>
              <?
              }
              ?>
            </div>
            <div class="item">
              <div class="component_catalog_detail__price_extra_info"> Цена указана с учетом НДС </div>
            </div>
            <?
            else :
              ?>
            <div class="button button_demand_price"
                                             data-rel-model="<?= $arResult['product']["model"] ?>"> Запросить&nbsp;цену </div>
            <?
            endif;
            ?>
            <?}?>
          </div>
        </div>
        <div class="component_catalog_detail__buttons1">
          <? if ($arResult['product']["discontinued"] != '1') { ?>
          <div @click="add_too_box" class='button is-primary add_to_cart'
                                             data-model='<?= $arResult['product']["model"] ?>' data-box="cart"> <span class="btn_icon_order"></span> <span class="btn_icon_order_text">В заказ</span> </div>
          <? } ?>
          <div></div>
          <div @click="add_too_box"
                                         class='button button_like_link add_to_compare'
                                         data-model='<?= $arResult['product']["model"] ?>' data-box="compare"> <span class="btn_icon"></span> <span class="btn_text">В сравнение</span> </div>
          <div @click="add_too_box"
                                         class='button button_like_link add_to_favorites'
                                         data-model='<?= $arResult['product']["model"] ?>' data-box="favorites"> <i class="fa-regular fa-heart"></i> <span class="btn_text">&nbsp;В избранное</span> </div>
          
          <!--                                        <div class='button is-light order_one_click'
                                             data-model='<? /*= $arResult['product']["model"] */ ?>'>
                                            заказ в 1 клик
                                        </div>
                                        <div class='button is-light order_callback'
                                             data-model='<? /*= $arResult['product']["model"] */ ?>'
                                             onclick='show_backup_call(1, "<? /*= $arResult['product']["model"] */ ?>")'>
                                            Получить скидку
                                        </div>
--> 
        <?php if ($arResult['product']['view3d'] == 1): ?>
          <?php
            $modelName = $arResult['product']["model"];
            $cleanModelName = preg_replace('/[\s\/]+/', '-', $modelName);
            $model3dPath = "models/{$cleanModelName}-model/";
          ?>
          <a href="/<?= $model3dPath ?>" class='button' target="_blank" style="text-decoration: none;">
            3D просмотр
          </a>
        <?php endif; ?>
        </div>
        <div class="component_catalog_detail__advantages">
          <?= $arResult['product']["text_features"] ?>
          <?
          if ( $UPPER_SEO_TEXT ) {
            ?>
          <div class="UPPER_SEO_TEXT">
            <?=$UPPER_SEO_TEXT?>
          </div>
          <?
          }

          ?>
        </div>
        <div class="component_catalog_detail__buttons2">
          <div>
            <?= $link_advanced_search ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>
<?
$product_field_descriptions = get_product_field_descriptions( $arResult[ 'product' ][ "type" ] );

if ( $arResult[ 'product' ][ 'type' ] == 'controllers'
  or $arResult[ 'product' ][ 'type' ] == 'coupler' ) {
  include "inc_io_modules_table.php";

}


?>
<meta itemprop="description" content="<?= $DESCRIPTION_micro ?>">
<?
if ( count( $product_field_descriptions ) > 0 and $arResult[ 'product' ][ "replace_detail_text_with_file" ] == "" ):
  ?>
<section id="specifications">
  <h2>Технические
    характеристики
    <?= $product_type_genitive_case ?>
    <? if ($arResult['product']["brand"] != "IFC") echo $arResult['product']["brand"]; ?>
    <?= $arResult['product']["model"] ?>
  </h2>
  <?
  //var_dump_pre($product_field_descriptions);
  foreach ( $product_field_descriptions as $group ) {
    ob_start();
    ?>
  <h3 class="table_characteristics_group_name">
    <?= $group['name'] ?>
  </h3>
  <div class="table-container">
    <table class="table_characteristics table is-striped is-fullwidth is-bordered">
      <tbody>
        <tr> </tr>
        
        <!--  -->
        <?
        $groups_counter = 0;
        foreach ( $group[ 'items' ] as $field ) {
          if ( $arResult[ 'product' ][ $field[ "field_code" ] ] == '' || $arResult[ 'product' ][ $field[ "field_code" ] ] == '0' ) continue;
          $groups_counter++;
          if ( $field[ "field_type" ] == 'text' ):
            ?>
        <tr>
          <td colspan="2"><?= $arResult['product'][$field["field_code"]] ?></td>
        </tr>
        <?
        else :
          ?>
        <tr>
          <td class="field_code__<?= $field["field_code"] ?>"><?= $field["field_name"] ?></td>
          <td><?= $arResult['product'][$field["field_code"]] ?>
            <?= $field["field_units"] ?></td>
        </tr>
        <?
        endif;

        }

        ?>
      </tbody>
    </table>
  </div>
  <?
  $group = ob_get_clean();
  if ( $groups_counter > 0 )echo $group;
  }

  if ( isset( $arResult[ 'product' ][ "options" ] )and $arResult[ 'product' ][ "options" ] != "" ) {
    ?>
  <h3 class="table_characteristics_group_name">Дополнительные опции</h3>
  <div class="table-container">
    <table class="table_characteristics table is-striped is-fullwidth is-bordered">
      <tr>
        <td colspan="2"><?= $arResult['product']["options"] ?></td>
      </tr>
    </table>
  </div>
  <?
  }
  ?>
</section>
<?
endif;
if ( $arResult[ 'product' ][ 'articuls' ] != '' ) {
  ?>
<h2>Информация для заказа:</h2>
<div class="table-container">
<table class="table  is-bordered is-hoverable">
<tr>
  <td class="is-size-7 has-text-grey-light has-text-weight-light" style="border: none;">АРТИКУЛ</td>
  <td style="border: none;" class="is-size-7 has-text-grey-light has-text-weight-light">КОНФИГУРАЦИЯ</td>
</tr>
<?$arts = explode("\n",$arResult[ 'product' ][ 'articuls' ]);
		foreach ($arts as $art) {
		$articul = explode(":",$art);
		echo '<tr id="'.$articul[0].'"><td class="is-size-7" style="border-bottom:1px solid white;background:#dbdbdb"><strong>';
		echo $articul[0].'</strong></td><td class=" is-size-7">'.$articul[1].'</td><td style="border:none;    vertical-align: middle;"><a title="Скопировать" class="is-pulled-right" style="text-decoration: none;" onclick="copyToClipboard(\''.htmlentities($art).'\')"><i class="fa-regular fa-copy" style="color:#ccc;"></i></a></td></tr>';
					}
		echo '</table></div><br>';
	}
	  
	  ?>
<?
if ( $arResult[ 'product' ][ "replace_detail_text_with_file" ] == "" ):
  $model = str_replace( "/", "_", $product[ "model" ] );
$model = str_replace( " ", "_", $model );
$dim_picture_src = "/images/" . strtolower( $arResult[ 'product' ][ "brand" ] ) . "/dim/" . $model . ".png";
if ( !CoreApplication::test_file_existing_by_url( "https://www.rusavtomatika.com/upload_files" . $dim_picture_src ) ) {
  //echo $dim_picture_src;
  $dim_picture_src = "";
  if ( $arResult[ 'product' ][ "brand" ] == "Faraday" ) {
    $dim_picture_src = "/images/faraday/dim/" . $arResult[ 'product' ][ "s_name" ] . ".png";
    if ( !CoreApplication::test_file_existing_by_url( "https://www.rusavtomatika.com/upload_files" . $dim_picture_src ) ) {
      $dim_picture_src = "";
    }
  }
}
?>
<section id="dimensions">
  <? if ($arResult['product']["dimentions"] != '' or $arResult['product']["cutout"] != '' or $dim_picture_src != ''): ?>
  <h2> Габариты
    <?= $product_type_genitive_case ?>
    <? if ($arResult['product']["brand"] != "IFC") echo $arResult['product']["brand"]; ?>
    <?= $arResult['product']["model"] ?>
  </h2>
  <? endif; ?>
  <? if ($arResult['product']["dimentions"] != '') { ?>
  <div class="component_catalog_detail__dimentions"> Габариты:
    <?= $arResult['product']["dimentions"] ?>
    мм</div>
  <? } ?>
  <? if ($arResult['product']["cutout"] != '') { ?>
  <div class="component_catalog_detail__dimentions">Посадочное
    отверстие:
    <?= $arResult['product']["cutout"] ?>
    мм</div>
  <? } ?>
  <?

  if ( $dim_picture_src != '' ) {
    ?>
  <img alt="Габариты <?= $arResult['product']["model"] ?>"
                             class="component_catalog_detail__image_dimensions"
                             src="<?= $dim_picture_src ?>"/>
  <?
  }
  ?>
</section>
<? endif; ?>
<?
if ( $schemes != ''
  and $arResult[ 'product' ][ "replace_detail_text_with_file" ] == "" ):
  ?>
<section id="schemes">
  <h2>Схема
    соединения
    <? if ($arResult['product']["brand"] != "IFC") echo $arResult['product']["brand"]; ?>
    <?= $arResult['product']["model"] ?>
  </h2>
  <div class="component_catalog_detail__schemes_wrapper">
    <?
    echo $schemes;
    //show_com_connector_temp($arResult['product']["model"]);

    ?>
  </div>
</section>
<? endif; ?>
<?
if ( $arResult[ 'product' ][ "set_tab_html" ] != '' ):
  ?>
<section id="set_tab_html">
  <h2>Комплектность</h2>
  <?= $arResult['product']["set_tab_html"] ?>
</section>
<? endif; ?>
<? if (isset($arResult['product']['files']) and is_array($arResult['product']['files']) and count($arResult['product']['files']) > 0 and $arResult['product']["replace_detail_text_with_file"] == "") : ?>
<section id="files">
  <h2>Файлы для работы
    с
    <? if ($arResult['product']["brand"] != "IFC") echo $arResult['product']["brand"]; ?>
    <?= $arResult['product']["model"] ?>
  </h2>
  <?


  require_once __DIR__ . "/inc_template_detail_files.php";
  ?>
</section>
<? endif; ?>
<? if (isset($arResult['product']['text_seo'])&&$arResult['product']['text_seo']!='') : ?>
<section id="text">
  <?
  echo $arResult[ 'product' ][ 'text_seo' ];
  ?>
</section>
<? endif; ?>
<? if (count($arSelected_articles)>0) : ?>
<section id="articles">
  <h2>Статьи о
    <?= $arResult['product']["model"] ?>
  </h2>
  <div class="fixed-grid has-5-cols has-1-cols-mobile has-3-cols-tablet has-4-cols-desktop has-5-cols-widescreen has-5-cols-fullhd">
    <div class="grid">
      <?
      foreach ( $arSelected_articles as $article ) {
        ?>
      <div class="cell">
        <div class="card">
          <div class="card-image" style="padding: 30px;"><a href="/articles/<?= $article['sys_name']?>" target="_art">
            <figure class="image is-3by2"> <img
        src="<?= $article['img']?>"
        alt="<?= htmlspecialchars($article['name'])?>"
      /> </figure>
            </a> </div>
          <div class="card-content pt-0">
            <div class="media-content">
              <p class="title is-4 is-size-6 mb-2"><a href="/articles/<?= $article['sys_name']?>" target="_art">
                <?= $article['name']?>
                </a></p>
              <p class="is-6 is-size-7">
                <?= date("m.d.Y", strtotime($article['date']))?>
              </p>
            </div>
            <div class="content is-size-7">
              <?= mb_substr($article['description'],0,150)?>
              ... </div>
          </div>
        </div>
      </div>
      <?}?>
    </div>
  </div>
</section>
<? endif; ?>
<? if (count($arSelected_videos)>0) : ?>
<section id="videos">
  <h2>Видео о
    <?= $arResult['product']["model"] ?>
  </h2>
  <div class="fixed-grid has-5-cols has-1-cols-mobile has-3-cols-tablet has-4-cols-desktop has-5-cols-widescreen has-5-cols-fullhd">
    <div class="grid">
      <?
      foreach ( $arSelected_videos as $video ) {
        ?>
      <div class="cell">
        <div class="card">
          <div class="card-image"><a href="/video/<?= $video['code']?>" target="_art">
            <figure class="image is-3by2"><img
        src="<?= $video['picture_preview']?>"
        alt="<? echo htmlspecialchars($video['name']);?>"/> </figure>
            </a> </div>
          <div class="card-content">
            <div class="media-content">
              <p class="title is-4 is-size-6 mb-2"><a href="/video/<?= $video['code']?>" target="_art">
                <?= $video['name']?>
                </a></p>
              <p class="is-6 is-size-7">
                <?= date("m.d.Y", strtotime($video['date']))?>
              </p>
            </div>
            <div class="content is-size-7">
              <?= mb_substr($video['text_preview'],0,150)?>
              ... </div>
          </div>
        </div>
      </div>
      <?}?>
    </div>
  </div>
</section>
<? endif; ?>
</section>
<?
if ( isset( $arResult[ 'product' ][ "replace_detail_text_with_file" ] )and $arResult[ 'product' ][ "replace_detail_text_with_file" ] != "" ):
  ?>
<section id="replace_detail_text_with_file">
  <?
  if ( defined( 'ENCODING' )and ENCODING == "UTF-8" ) {
    $path = $_SERVER[ "DOCUMENT_ROOT" ] . $arResult[ 'product' ][ "replace_detail_text_with_file" ];
    $path = str_replace( "/include/", "/include_utf_8/", $path );
    include $path;
  } else {
    include $_SERVER[ "DOCUMENT_ROOT" ] . $arResult[ 'product' ][ "replace_detail_text_with_file" ];
  }
  ?>
</section>
<?
endif;

?>
</div>
</div>
<div class="component_catalog_detail_section_3">
  <div class="linked_products_block">
    <? //LinkedProducts::printPanel($arResult['product']["model"], $mysqli_db);
    ?>
  </div>
</div>
<?
CoreApplication::include_component( array( "component" => "linked_products", "model" => $arResult[ 'product' ][ "model" ] ) );
?>
<?
if ( isset( $LOWER_SEO_TEXT )and $LOWER_SEO_TEXT != "" ) {
  ?>
<div class="section_description p-5">
  <?= $LOWER_SEO_TEXT ?>
</div>
<?
}
?>
<!--div><a class="button is-primary" href="<?= "/catalog/" . $arResult['section']["code"] . "/" ?>">Назад в
  &laquo;
  <?= $arResult['section']["name"] ?>
  &raquo;</a></div-->
</div>
</div>
</div>
<div class="result" v-html="result"></div>
</div>
<script type="text/javascript">
//let table = document.querySelector('#table-download-files');
//$(document).ready(function() {
//  sort();
//});
function sortTable(table_id, sortColumn){
    var tableData = document.getElementById(table_id).getElementsByTagName('tbody').item(0);
    //var tableData = document.getElementById(table_id).getElementsByTagName('tbody');
    var rowData = tableData.getElementsByTagName('tr');            
	console.log(rowData.length);
    for(var i = 0; i < rowData.length - 1; i++){
        for(var j = 0; j < rowData.length - (i + 1); j++){
            if(Number(rowData.item(j).getElementsByTagName('td').item(sortColumn).innerHTML.replace(/[^0-9\.]+/g, "")) > Number(rowData.item(j+1).getElementsByTagName('td').item(sortColumn).innerHTML.replace(/[^0-9\.]+/g, ""))){
    		    tableData.insertBefore(rowData.item(j+1),rowData.item(j));
		    }
        }
    }
}
$(document).ready(function() {
    // pass the id and the <td> place you want to sort by (td counts from 0)
    sortTable('table-download-files',5);
	//alert('111');
});
</script>
<?


}


CoreApplication::include_component( array( "component" => "form_require_price", "template" => "default", ) );
?>
