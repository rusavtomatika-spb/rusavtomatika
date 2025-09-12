<?php
global $arSettings;
$arSettings[ 'path_to_product_images' ] = '/images/';
CoreApplication::add_style( str_replace( $_SERVER[ "DOCUMENT_ROOT" ], "", __DIR__ ) . "/style.css" );
CoreApplication::add_style( "https://cdn.jsdelivr.net/jquery.suggestions/17.2/css/suggestions.css" );
CoreApplication::add_script( '//code.jquery.com/ui/1.9.2/jquery-ui.js' );
CoreApplication::add_script( 'https://cdn.jsdelivr.net/jquery.suggestions/17.2/js/jquery.suggestions.min.js' );
//CoreApplication::add_script(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/jquery.form.min.js");
?><!--[if lt IE 10]><?
CoreApplication::add_script( 'https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxtransport-xdomainrequest/1.0.1/jquery.xdomainrequest.min.js' );
?><![endif]--><?
CoreApplication::add_script( 'https://cdn.jsdelivr.net/npm/js-cookie@3.0.5/dist/js.cookie.min.js' );
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
      <div class="view-mode-cart">
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
          <div class="tr columns tr_product_<?= $product["model"]; ?>">
            <div class="td_preview_image is-narrow"> <a href="<?= $product["link_detail_page"]; ?>">
              <div class="preview_image"> <img alt="<?= $product["model"]; ?>" loading="lazy" src="<?= $arSettings['path_to_product_images'] . mb_strtolower($product["brand"]) . "/" . mb_strtolower($product["type"]) . "/" . $product["model"] ?>/130/<?= $product["model"] ?>_1.webp"> </div>
              </a> </div>
            <div class="td_model is-left" style="max-width: 850px;"><a href="<?= $product["link_detail_page"]; ?>"><span class="model"><? echo $diagonal . " " . $product["short_name"] . " " . $product["brand"] . " " . $product["model"]; ?></span></a> <br>
              
              <!--a href="<?= $product["link_detail_page"]; ?>"-->
              <?= $product["preview_text"]; ?>
              ; <span>
              <?= $product["preview_text_extra"]; ?>
              </span> 
              <!--/a-->
              <div class="td_onstock is-narrow">
                <?
                if ( $product[ 'onstock_spb' ] > 0 or $product[ 'onstock_msk' ] > 0 ) {
                  echo '<span class="green">В&nbsp;наличии</span>';
                } else echo '<span class="red">Под&nbsp;заказ</span>';
                ?>
              </div>
            </div>
            <div class="columns td_price" style="display: inline-block;padding:0 15px;min-width: 150px;">
              <div class="td_quantity is-center" style="width:100%;padding-top: 15px;">
                <div class="quantity"> <span class="quantity_button_minus">-</span>
                  <input data-model="<?=$product["model"]?>" class="quantity_value" value="<? if(isset($product["qty"]) and  $product["qty"]>1) echo $product["qty"];else echo "1";?>" onchange="//bapl_ch(0, this.value );" type="text">
                  <span class="quantity_button_plus">+</span> </div>
              </div>
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
                  echo '<span class="no_price">Цена по<br>запросу</span>';
                  $class_no_price = "no_price";
                  //echo $product['retail_price'];
                }
                ?>
              </div>
            </div>
            <div class="td_buttons columns" style="right: 0;" >
              <div class="buttons_panel" style="white-space: nowrap;">
                <button title="Добавить в избранное" class="favorites fa-solid fa-heart fa-xl" @click="add_too_box" data-model="<?= $product["model"]; ?>" data-box="favorites"></button>
                <button title="Добавить в сравнение" class="compare fa-solid fa-square-poll-vertical fa-xl" @click="add_too_box" data-model="<?= $product["model"]; ?>" data-box="compare"></button>
                <button title="Удалить" class="cart fa-solid fa-trash-can fa-xl" @click="add_too_box" data-model="<?= $product["model"]; ?>" data-box="delete_from_cart"></button>
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
      </div>
      <?if (isset($series["products"]) and is_array($series["products"])) {?>
      <div class="panel_itogo"> 
        <!--div class="panel_itogo_group">
          <div><span class="total_noprice_value"></span></div>
        </div-->
        <div class="panel_itogo_group">
          <div>Итого:</div>
          <div><span class="total_quantity_value"></span> шт.<br>
            <span class="total_usd_value"></span> $<br>
            <span class="total_rub_value"></span> руб </div>
        </div>
      </div>
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
    <div class="col-lg-12">
      <div class="block_order">
        <div class="block_order__title">Оформление заказа</div>
        <div class="block_order__gray_panel">
          <div class="columns block_order__flex_block">
            <div class="column">
              <h2>Способ доставки:</h2>
              <br>
              <div class="oformit_zakaz_delivery_block">
                <div class="item">
                  <input type="radio" id="dost7" name="dost" checked="checked">
                  <label for="dost7"><b>Бесплатная</b> доставка</label>
                  <a href="/payment-shipping/" target="_blank'"> курьерской службой «СДЭК»</a> по РФ<br>
                  (1-10 дней) </div>
                <div class="item">
                  <input type="radio" id="dost3" name="dost">
                  <label for="dost3">Самовывоз
                    со</label>
                  <a href="//www.rusavtomatika.com/contacts/" target="_blank"> склада в Петербурге</a> </div>
              </div>
            </div>
            <div class="column">
              <h2>Контактная информация:</h2>
              <p>
                <?
                if ( isset( $_COOKIE[ "cookie_contacts" ] ) ) {
                  $conts = split( "#", $_COOKIE[ "cookie_contacts" ], 6 );
					$name = $conts[ 0 ];
                  echo "Здравствуйте, " . $name . "!<br>";
                  $fields = array( "query" => $conts[ 4 ], "count" => 5 );
                }
                ?>
              </p>
              <br>
              <div class="oformit_zakaz_contact_block">
                <div class="form-group">
                  <div class="form-label">Ваше имя</div>
                  <div class="form-input">
                    <input type="text" id="formname" class="phoneNumber"                 <?
                if ( isset( $name) ) {
                  echo 'value="'  . $name.'"';
                }
                ?>>
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-label">Ваша компания</div>
                  <div class="form-input">
                    <input type="text" id="formcompany" name="dd" class="phoneNumber"  value="" placeholder="Введите название, адрес, ИНН или ОГРН" required="" autocomplete="off" style="box-sizing: border-box;" >
                    <div class="suggestions-wrapper"><span class="suggestions-addon" data-addon-type="spinner" style="left: -21px; top: 2px; height: 19px; width: 19px;"></span>
                      <ul class="suggestions-constraints" style="left: -676px; top: 12px;"></ul>
                      <div class="suggestions-suggestions" style="position: absolute; display: none; left: -680px; top: 21px; width: 680px;"></div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-label" id="forminn_label">ИНН:&nbsp;</div>
                  <div class="form-input">
                    <input class="form-control" type="text" name="forminn" id="forminn" value="" placeholder="Например, 1111111111" readonly="" required="">
                    <div id="checkinn" class="dost_text"></div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="form-label" for="kpp">КПП:</label>
                  <input class="form-control" type="text" name="kpp" id="kpp" value="" placeholder="Например, 111111111" readonly="">
                </div>
                <div class="form-group">
                  <label class="form-label" for="ogrn">ОГРН:</label>
                  <input class="form-control" type="text" name="ogrn" id="ogrn" value="" placeholder="Например, 1111111111111" readonly="" required="">
                </div>
                <div class="form-group">
                  <label class="form-label" for="address">Адрес:</label>
                  <input class="form-control" type="text" name="address" id="address" value="" placeholder="Невский пр., 1" required="">
                </div>
                <div class="form-group">
                  <div class="form-label" id="formphone_label">Телефон<span class="required">*</span></div>
                  <div class="form-input">
                    <input type="text" id="formphone" placeholder="+79998887766" class="phoneNumber">
                    <div id="checkphone" class="dost_text"></div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-label" id="formemail_label">Email<span class="required">*</span></div>
                  <div class="form-input">
                    <input type="text" placeholder="name@domain.zone" id="formemail" class="phoneNumber">
                    <div id="checkmail" class="dost_text"></div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-label">Примечание:</div>
                  <div class="form-input">
                    <textarea id="formdop" rows="5"></textarea>
                  </div>
                </div>
                <!--form class="fileform" id="fileform" action="/abacus/components/catalog_cart/ajax_upload_file.php" method="post" enctype="multipart/form-data">
                  <div id="out_file_res">
                    <div class="form-group">
                      <div class="form-label">Отправить файл с реквизитами: &nbsp;</div>
                      <div class="form-input">
                        <input type="file" name="myFile" id="formfile">
                        <div id="checkfile" class="dost_text"></div>
                      </div>
                    </div>
                  </div>
                </form-->
              </div>
            </div>
          </div>
        </div>
        <div class="block_order__block_button">
          <div class="zakazbut"> Получить счет</div>
        </div>
      </div>
    </div>
    <?}?>
  </div>
</div>
