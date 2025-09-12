<?php
global $arSettings;
$arSettings[ 'path_to_product_images' ] = '/images/';
CoreApplication::add_style( str_replace( $_SERVER[ "DOCUMENT_ROOT" ], "", __DIR__ ) . "/style.css" );
CoreApplication::add_style( "https://cdn.jsdelivr.net/jquery.suggestions/17.2/css/suggestions.css" );
CoreApplication::add_style( "/js/jquery-ui.css" );
CoreApplication::add_script( 'https://code.jquery.com/ui/1.13.2/jquery-ui.js' );
//CoreApplication::add_script( '//code.jquery.com/ui/1.9.2/jquery-ui.js' );
//CoreApplication::add_script( 'https://cdn.jsdelivr.net/jquery.suggestions/17.2/js/jquery.suggestions.min.js' );
CoreApplication::add_script( str_replace( $_SERVER[ "DOCUMENT_ROOT" ], "", __DIR__ ) . "/jquery.suggestions.min.js" );
CoreApplication::add_script( str_replace( $_SERVER[ "DOCUMENT_ROOT" ], "", __DIR__ ) . "/lib.js" );
?>
<!--[if lt IE 10]><?
CoreApplication::add_script( 'https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxtransport-xdomainrequest/1.0.1/jquery.xdomainrequest.min.js' );
?><![endif]-->
<?
CoreApplication::add_script( str_replace( $_SERVER[ "DOCUMENT_ROOT" ], "", __DIR__ ) . "/js.cookie.min.js" );
//CoreApplication::add_script( 'https://cdn.jsdelivr.net/npm/js-cookie@3.0.5/dist/js.cookie.min.js' );
CoreApplication::add_script( 'https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js' );
CoreApplication::add_script( str_replace( $_SERVER[ "DOCUMENT_ROOT" ], "", __DIR__ ) . "/script.js" );
//CoreApplication::add_script( 'https://kit.fontawesome.com/874ca36921.js' );
global $arResult;
global $TITLE;
global $H1;
global $DESCRIPTION;
global $usd_currency, $arSettings;
if ( file_exists( $_SERVER[ "DOCUMENT_ROOT" ] . "/usdrate.txt" ) ) {
  $usd_currency = floatval( file_get_contents( $_SERVER[ "DOCUMENT_ROOT" ] . "/usdrate.txt" ) );
} else $usd_currency = 0;
$TITLE = "Корзина - Русавтоматика";
$H1 = "Корзина";
//CoreApplication::add_breadcrumbs_chain("Каталог оборудования", "/catalog/");
CoreApplication::add_breadcrumbs_chain( "Корзина" );
$series[ "products" ] = $arResult[ "ITEMS" ];
?>
<div class="catalog_cart">
<div class="container">
<div class="row">
  <div class="col-lg-12">
    <?
    CoreApplication::include_component( array( "component" => "breadcrumbs" ) );
    ?>
    <h1>
      <?= $H1 ?>
    </h1>
    <br>
    <div id=order_send_mess></div>
    <div class="component_catalog_cart__panel_of_products">
      <div class="view-mode-cart columns">
		  <div class="column is-9">
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
          <div class="tr columns tr_product_<?= $product["model"]; ?>" style="text-align: center;">
            <div class="td_preview_image is-narrow" style="display: inline-block;"> <a href="<?= $product["link_detail_page"]; ?>">
              <div class="preview_image"> <img alt="<?= $product["model"]; ?>" loading="lazy" src="<?= $arSettings['path_to_product_images'] . mb_strtolower($product["brand"]) . "/" . mb_strtolower($product["type"]) . "/" . $product["model"] ?>/130/<?= $product["model"] ?>_1.webp"> </div>
              </a> </div>
            <div class="td_model is-left" style="max-width: 850px;width:100%; display: inline-block;text-align: left;"><a href="<?= $product["link_detail_page"]; ?>"><span class="model"><? echo $diagonal . " " . $product["short_name"] . " " . $product["brand"] . " " . $product["model"]; ?></span></a> <br>
              
              <!--a href="<?= $product["link_detail_page"]; ?>"-->
              <?= $product["preview_text"]; ?>
              ; <span>
              <?= $product["preview_text_extra"]; ?>
              </span> 
              <!--/a-->
              <div class="td_onstock is-narrow">
                <?
                if ( $product[ 'onstock_spb' ] > 0 or $product[ 'onstock_msk' ] > 0 ) {
                  echo '<br><span class="green"><i class="fa-solid fa-check"></i>&nbsp;В&nbsp;наличии</span>';
                } else echo '<br><span class="podzakaz">Под&nbsp;заказ</span>';
                ?>
              </div>
            </div>
            <div class="columns td_price" style="display: inline-block;padding:0 15px;width: 150px;">
              <div class="td_quantity is-center" style="width:100%;">
                <div class="quantity"> <span class="quantity_button_minus">-</span>
                  <input data-model="<?=$product["model"]?>" name="<?=$product["model"]?>" class="kolvo quantity_value<?
                if ( $product[ "retail_price_hide" ] == 1 OR $product[ "retail_price" ] == 0 ) {
					echo ' no_price';
				} ?>" value="<? if(isset($product["qty"]) and  $product["qty"]>1) echo $product["qty"];else echo "1";?>" onchange="//bapl_ch(0, this.value );" type="text">
                  <span class="quantity_button_plus">+</span> </div>
              </div>
            </div>
            <div class="columns td_price" style="display: inline-block;padding:0 15px;width: 150px;">
              <div class="price_block is-center" style="width:130px;">
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
                  echo '<div class="no_price">Цена по запросу</div>';
                  ?>
                <?
                $class_no_price = "no_price";
                //echo $product['retail_price'];
                }
                ?>
              </div>
            </div>
            <div class="td_buttons columns" style="display: inline-block;" >
              <div class="buttons_panel" style="white-space: nowrap;">
                <button title="Добавить в избранное" class="favorites fa-solid fa-heart" @click="add_too_box" data-model="<?= $product["model"]; ?>" data-box="favorites"></button>
                <br>
                <button title="Добавить в сравнение" class="compare fa-solid fa-align-right fa-rotate-90" @click="add_too_box" data-model="<?= $product["model"]; ?>" data-box="compare"></button>
                <br>
                <button title="Удалить" class="cart fa-solid fa-xmark" @click="add_too_box" data-model="<?= $product["model"]; ?>" data-box="delete_from_cart"></button>
              </div>
            </div>
          </div>
          <hr>
          <div class="is-clearfix">&nbsp;</div>
          <?
          }
          } else {
            echo "<hr>Нет товаров...<hr>";
          }
          ?>
        </div>
		  </div>
		  <div class="column is-3">
        <div class="panel_itogo2 column is-fixed-top">
			<p>В корзине <span class="total_quantity_value" style="font-weight: bold;"></span><span class="total_quantity_word"></span><span class="bezcen1"><span class="bezcen2">, <span class="total_noprice_value" style="font-weight: bold;"></span> из которых</span> с ценой по запросу</span>.</p>
			<span class="cena"><p>Общая сумма:   <span class="digits"><span class="total_usd_value" name="total_usd_row" style="font-weight: bold;"></span>&nbsp;<i class="fa-solid fa-dollar-sign" style="font-size: 1.4rem;color:#B7B7B7"></i>&nbsp;<span style="color: white;">|</span>&nbsp;<span class="total_rub_value" name="total_rub_row" style="font-weight: bold;"></span>&nbsp;<i class="fa-solid fa-ruble-sign" style="font-size: 1.4rem;color:#B7B7B7"></i></span></p></span>
        </div>
<div class="spasibo">
            <div class="spasibodiv" style="display: none;">
              <p>Все товары в наличии и будут отправлены в день поступления средств на наш счет.</p>
            </div>
            <div class="nali4iediv" style="display: none;">
              <p>О сроках поставки товаров, которых нет в наличии, менеджер сообщит дополнительно.</p>
            </div>
          </div>
		  </div>
     </div>
      <?if (isset($series["products"]) and is_array($series["products"])) {?>
      <!--div class="columns">
        <div class="column is-9">          <div class="spasibo">
			<h3>Дополнительная информация:</h3>
            <div class="spasibodiv" style="display: none;">
              <p>Все товары в наличии и будут отправлены в день поступления средств на наш счет.</p>
            </div>
            <div class="nali4iediv" style="display: none;">
              <p>О сроках поставки товаров, которых нет в наличии, менеджер сообщит дополнительно.</p>
            </div>
          </div>
</div>
        <div class="panel_itogo2 column is-3">
			<p>В корзине <span class="total_quantity_value" style="font-weight: bold;"></span><span class="total_quantity_word"></span><span class="bezcen1"><span class="bezcen2">, <span class="total_noprice_value" style="font-weight: bold;"></span> из которых</span> с ценой по запросу</span>.</p>
			<span class="cena"><p>Общая сумма:   <span class="digits"><span class="total_usd_value" name="total_usd_row" style="font-weight: bold;"></span>&nbsp;<i class="fa-solid fa-dollar-sign" style="font-size: 1.4rem;color:#B7B7B7"></i>&nbsp;<span style="color: white;">|</span>&nbsp;<span class="total_rub_value" name="total_rub_row" style="font-weight: bold;"></span>&nbsp;<i class="fa-solid fa-ruble-sign" style="font-size: 1.4rem;color:#B7B7B7"></i></span></p></span>
        </div>
      </div-->
      <?}?>
    </div>
    <!-----------------------------------------------
                <div class="component_catalog_cart__panel_of_products is-hidden-touch">
                    <div class="view-mode-cart">
                        <table class="series_products">
                            <?
                            if (isset($series["products"]) and is_array($series["products"])) {
                                foreach ($series["products"] as $product) {
                                    if (isset($product["diagonal"]) and $product["diagonal"] != "" and $product["diagonal"] != 0 and $product["diagonal_hide"] == 0) {
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
                                                         src="<?= $arSettings['path_to_product_images'] . mb_strtolower($product["brand"]) . "/" . mb_strtolower($product["type"]) . "/" . $product["model"] ?>/130/<?= $product["model"] ?>_1.webp">
                                                </div>
                                            </a>
                                        </td>
                                        <td class="td_model"><a href="<?= $product["link_detail_page"]; ?>"><span
                                                        class="model"><? echo $diagonal . " " . $product["short_name"] . " " . $product["brand"] . " " . $product["model"]; ?></span></a>
                                        </td>
                                        <td class="td_short_description">
                                            <a href="<?= $product["link_detail_page"]; ?>">
                                                <?= $product["preview_text"]; ?>;
                                                <span> <?= $product["preview_text_extra"]; ?> </span>
                                            </a>
                                        </td>
                                        <td class="td_onstock">
                                            <a href="<?= $product["link_detail_page"]; ?>">
                                                <?
                                                if ($product['onstock_spb'] > 0 or $product['onstock_msk'] > 0) {
                                                    echo '<span class="green">В&nbsp;наличии</span>';
                                                } else echo '<span class="red">Под&nbsp;заказ</span>';
                                                ?>
                                            </a>
                                        </td>
                                        <td class="td_price">
                                            <a href="<?= $product["link_detail_page"]; ?>"><?
                                                if (isset($product['retail_price']) and intval($product['retail_price']) > 0 and $product["retail_price_hide"] == 0) {
                                                    ?>&nbsp;<?
                                                    switch ($product['currency']) {
                                                        case 'USD':
                                                            ?>
                                                            <div class="usd_price">
                                                            <span class="usd_price_value" data-model="<?=$product["model"]?>"><?= $product['retail_price'] ?></span>
                                                            <span class="usd">$</span>
                                                            </div><?
                                                            if ($usd_currency) {
                                                                ?>
                                                                <div class="rub_price">
                                                                    <span class="rub_price_value" data-model="<?=$product["model"]?>"><? echo intval($product['retail_price'] * $usd_currency); ?></span>
                                                                    <span class="usd">&#8381;</span>
                                                                </div>
                                                                <?
                                                            }
                                                            break;
                                                        case 'RUR':
                                                            if ($usd_currency) {
                                                                ?>
                                                                <div class="usd_price">
                                                                    <span class="usd_price_value" data-model="<?=$product["model"]?>"><? echo intval($product['retail_price'] / $usd_currency); ?></span>
                                                                    <span class="usd">$</span></div>
                                                                <?
                                                            }
                                                            ?>
                                                            <div class="rub_price">
                                                            <span class="rub_price_value" data-model="<?=$product["model"]?>"><?= $product['retail_price'] ?></span>
                                                            <span class="rub">&#8381;</span></div><?
                                                            break;
                                                    }
                                                    $class_no_price = "";
                                                } else {
                                                    echo '<span class="no_price">Цена по запросу</span>';
                                                    $class_no_price = "no_price";
                                                    //echo $product['retail_price'];
                                                }
                                                ?>
                                            </a>
                                        </td>
                                        <td class="td_quantity">
                                            <div class="quantity">
                                                <span class="quantity_button_minus">-</span>
                                                <input data-model="<?=$product["model"]?>" class="quantity_value <?=$class_no_price?>" value="<? if(isset($product["qty"]) and  $product["qty"]>1) echo $product["qty"];else echo "1";?>"
                                                       onchange="//bapl_ch(0, this.value );" type="text">
                                                <span class="quantity_button_plus">+</span>
                                            </div>
                                        </td>
                                        <td class="td_buttons">
                                            <div class="buttons_panel">
                                                <button title="Добавить в избранное" class="favorites"
                                                        @click="add_too_box"
                                                        data-model="<?= $product["model"]; ?>" data-box="favorites">
                                                    <span></span>В избранное
                                                </button>
                                                <button title="Добавить в сравнение" class="compare"
                                                        @click="add_too_box"
                                                        data-model="<?= $product["model"]; ?>" data-box="compare">
                                                    <span></span>В сравнение
                                                </button>
                                                <button title="Добавить в корзину" class="cart" @click="add_too_box"
                                                        data-model="<?= $product["model"]; ?>"
                                                        data-box="delete_from_cart">
                                                    <span></span>Удалить
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
                    </div>
                    <?if (isset($series["products"]) and is_array($series["products"])) {?>
                    <div class="panel_itogo">
                        <div class="panel_itogo_group">
                            <div><span class="total_noprice_value"></span></div>
                        </div>
                        <div class="panel_itogo_group">
                            <div>Итого:</div>
                            <div><span class="total_quantity_value"></span> шт.</div>
                            <div><span class="total_usd_value"></span> $</div>
                            <div><span class="total_rub_value"></span> руб</div>
                        </div>
                    </div>
                    <?}?>
                </div>
            </div>
            -->
    <?if (isset($series["products"]) and is_array($series["products"])) {?>
    <script>
  $( function() {
    $( 'input[type="radio"]' ).checkboxradio();
  } );
  </script>
    <div class="col-lg-12">
      <div class="block_order">
        <div class="block_order__title">Оформление заказа</div>
        <div class="block_order__gray_panel">
          <div class="columns block_order__flex_block">
            <div class="column">
              <p>
                <?
                $status = 'urlico';
                if ( isset( $_COOKIE[ "cookie_contact" ] ) ) {
                  $conts = split( "#", $_COOKIE[ "cookie_contact" ], 10 );
                  $conts_kol = count( $conts );
                  $name = $conts[ 0 ];
                  $company = $conts[ 5 ];
                  if ( $conts_kol == 0 ) {
                    $status = '';
                  } else {
                    $status = $conts[ 4 ];
                  }
                  if ( $name != '' ) {
                    echo 'Здравствуйте, ' . $name . '!<br>';
                  }
                }
                ?>
              </p>
              <h2>Контактная информация:</h2>
              <br>
              <div class="oformit_zakaz_contact_block widget">
                <fieldset>
                  <legend>Организационно-правовая форма</legend>
                  <div class="form-group">
                    <div class="form-input">
                      <label for="urlico" style="margin-right: 15px;">Организация</label>
                      <input name="status" type="radio" value="urlico" id="urlico" <?
                if ( $status == 'urlico' ) {
                  echo 'checked';
                }
                ?>>
                      <label for="fizlico">Физическое лицо</label>
                      <input name="status" type="radio" value="fizlico" id="fizlico" <?
                if ( $status == 'fizlico' ) {
                  echo 'checked';
                }
                ?>>
                    </div>
                  </div>
                </fieldset>
                <div id="urlicobox" style="display: <?
										                   if ( $status == 'urlico' ) {
                  echo 'block';
                } else {
					echo 'none';}							

										   ?>;">
                  <fieldset>
                    <legend>Реквизиты юридического лица</legend>
                    <div class="form-group">
                      <div class="form-label" id="org_leg">Название <span style="color:red">*</span></div>
                      <div class="form-input">
                        <input type="text" id="formcompany" name="dd" class="phoneNumber" value="<?
                if ( isset( $company) ) {
                  echo 'value="'.$company.'"';
                }
                ?>" placeholder="Название, ИНН или ОГРН" required autocomplete="off" style="box-sizing: border-box;" >
                        <div class="suggestions-wrapper"><span class="suggestions-addon" data-addon-type="spinner" style="left: -21px; top: 2px; height: 19px; width: 19px;"></span>
                          <ul class="suggestions-constraints" style="left: -676px; top: 12px;">
                          </ul>
                          <div class="suggestions-suggestions" style="position: absolute; display: none; left: -680px; top: 21px; width: 680px;"></div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-label" id="forminn_label">ИНН:&nbsp;</div>
                      <div class="form-input disabled">
                        <input class="form-control" type="text" name="forminn" id="forminn" value="" readonly="" required="">
                        <div id="checkinn" class="dost_text"></div>
                      </div>
                    </div>
                    <div class="form-group disabled">
                      <div class="form-label" for="kpp">КПП:</div>
                      <input class="form-control" type="text" name="kpp" id="kpp" value="" readonly="">
                    </div>
                    <div class="form-group disabled">
                      <div class="form-label" for="ogrn">ОГРН:</div>
                      <input class="form-control" type="text" name="ogrn" id="ogrn" value="" readonly="" required="">
                    </div>
                  </fieldset>
                </div>
                <fieldset>
                  <legend>Контактная информация</legend>
                  <div class="form-group">
                    <div class="form-label" id="name_leg">Контактное лицо:</div>
                    <div class="form-input">
                      <input type="text" id="formname" class="phoneNumber"                 <?
                if ( isset( $name) ) {
                  echo 'value="'  . $name.'"';
                }
                ?>>
                    </div>
                  </div>
                  <div class="form-group" id="adr">
                    <div class="form-label" for="address">Адрес:</div>
                    <input class="form-control" type="text" name="address" id="address" value="" placeholder="Невский пр., 1" required="">
                  </div>
                  <div class="form-group">
                    <div class="form-label" id="formphone_label">Телефон:<span class="required">*</span></div>
                    <div class="form-input">
                      <input type="tel" id="formphone" class="phoneNumber">
                      <div id="checkphone" class="dost_text"></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-label" id="formemail_label">Email:<span class="required">*</span></div>
                    <div class="form-input">
                      <input type="text" placeholder="name@domain.zone" id="formemail" class="phoneNumber">
                      <div id="checkmail" class="dost_text"></div>
                    </div>
                  </div>
                </fieldset>
                <div class="form-group">
                  <div class="form-label">Примечание к заказу:</div>
                  <div class="form-input">
                    <textarea id="formdop" rows="5"></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="column">
              <p></p>
              <h2 style="margin-bottom: 32px">Способ доставки:</h2>
              <div class="oformit_zakaz_delivery_block">
                <div class="item">
                  <input type="radio" id="dost7" name="dost" checked="checked">
                  <label style="width: 100%;" for="dost7"><span style="white-space: nowrap;">Бесплатная доставка «СДЭК»</span> <span style="white-space: nowrap;">по РФ (1-10 дней) <a href="/payment-shipping/" target="_blank'"><i class="fa-solid fa-circle-question" style="margin-left: auto;margin-right: 0;"></i></a></span></label>
                </div>
                <br>
                <div class="item">
                  <input type="radio" id="dost3" name="dost">
                  <label style="width: 100%;" for="dost3" ><span style="white-space: nowrap;">Самовывоз со склада</span> <span style="white-space: nowrap;">в Петербурге <a href="//www.rusavtomatika.com/contacts/" target="_blank"><i class="fa-solid fa-circle-question"></i></a></span></label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="block_order__block_button">
          <div class="zakazbut">Получить счет &nbsp;&nbsp;<i class="fa-solid fa-file-invoice fa-xl"></i></i></div>
        </div>
      </div>
    </div>
    <?}?>
  </div>
</div>
