<?php
global $arSettings;
$arSettings[ 'path_to_product_images' ] = '/images/';
CoreApplication::add_style( str_replace( $_SERVER[ "DOCUMENT_ROOT" ], "", __DIR__ ) . "/style.css" );
//CoreApplication::add_style( "/abacus/templates/rusavtomatika_bulma/bulma/css/bulma.min.css" );
CoreApplication::add_script( '//code.jquery.com/ui/1.9.2/jquery-ui.js' );
//CoreApplication::add_script('//malsup.github.com/jquery.form.js');
//CoreApplication::add_script(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/jquery.form.min.js");
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

class TooManyRequests extends Exception
{
}

class Dadata
{
    private $clean_url = "https://cleaner.dadata.ru/api/v1/clean";
    private $suggest_url = "https://suggestions.dadata.ru/suggestions/api/4_1/rs";
    private $token;
    private $secret;
    private $handle;

    public function __construct($token, $secret)
    {
        $this->token = $token;
        $this->secret = $secret;
    }

    /**
     * Initialize connection.
     */
    public function init()
    {
        $this->handle = curl_init();
        curl_setopt($this->handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->handle, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "Accept: application/json",
            "Authorization: Token " . $this->token,
            "X-Secret: " . $this->secret,
        ));
        curl_setopt($this->handle, CURLOPT_POST, 1);
    }

    /**
     * Clean service.
     * See for details:
     *   - https://dadata.ru/api/clean/address
     *   - https://dadata.ru/api/clean/phone
     *   - https://dadata.ru/api/clean/passport
     *   - https://dadata.ru/api/clean/name
     * 
     * (!) This is a PAID service. Not included in free or other plans.
     */
    public function clean($type, $value)
    {
        $url = $this->clean_url . "/$type";
        $fields = array($value);
        return $this->executeRequest($url, $fields);
    }

    /**
     * Find by ID service.
     * See for details:
     *   - https://dadata.ru/api/find-party/
     *   - https://dadata.ru/api/find-bank/
     *   - https://dadata.ru/api/find-address/
     */
    public function findById($type, $fields)
    {
        $url = $this->suggest_url . "/findById/$type";
        return $this->executeRequest($url, $fields);
    }

    /**
     * Reverse geolocation service.
     * See https://dadata.ru/api/geolocate/ for details.
     */
    public function geolocate($lat, $lon, $count = 10, $radius_meters = 100)
    {
        $url = $this->suggest_url . "/geolocate/address";
        $fields = array(
            "lat" => $lat,
            "lon" => $lon,
            "count" => $count,
            "radius_meters" => $radius_meters
        );
        return $this->executeRequest($url, $fields);
    }

    /**
     * Detect city by IP service.
     * See https://dadata.ru/api/iplocate/ for details.
     */
    public function iplocate($ip)
    {
        $url = $this->suggest_url . "/iplocate/address";
        $fields = array(
            "ip" => $ip
        );
        return $this->executeRequest($url, $fields);
    }

    /**
     * Suggest service.
     * See for details:
     *   - https://dadata.ru/api/suggest/address
     *   - https://dadata.ru/api/suggest/party
     *   - https://dadata.ru/api/suggest/bank
     *   - https://dadata.ru/api/suggest/name
     *   - ...
     */
    public function suggest($type, $fields)
    {
        $url = $this->suggest_url . "/suggest/$type";
        return $this->executeRequest($url, $fields);
    }

    /**
     * Close connection.
     */
    public function close()
    {
        curl_close($this->handle);
    }

    private function executeRequest($url, $fields)
    {
        curl_setopt($this->handle, CURLOPT_URL, $url);
        if ($fields != null) {
            curl_setopt($this->handle, CURLOPT_POST, 1);
            curl_setopt($this->handle, CURLOPT_POSTFIELDS, json_encode($fields));
        } else {
            curl_setopt($this->handle, CURLOPT_POST, 0);
        }
        $result = $this->exec();
        $result = json_decode($result, true);
        return $result;
    }

    private function exec()
    {
        $result = curl_exec($this->handle);
        $info = curl_getinfo($this->handle);
        if ($info['http_code'] == 429) {
            throw new TooManyRequests();
        } elseif ($info['http_code'] != 200) {
            throw new Exception('Request failed with http code ' . $info['http_code'] . ': ' . $result);
        }
        return $result;
    }
}
$token = "2fe032454318a8fa0c013d2927d70ccc28154d1b";
$secret = "04ed0e671bc66d9d6cd17d739f359836cee91069";

$dadata = new Dadata($token, $secret);
$dadata->init();
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
				<p><? if(isset($_COOKIE["cookie_contacts"])){
	$conts = split("#", $_COOKIE["cookie_contacts"], 6);
    echo "Здравствуйте, " . $conts[0]."!<br>";
	$fields = array("query" => $conts[4], "count" => 5);
$result = $dadata->suggest("party", $fields);
	$org_name = $result['suggestions'][0]['unrestricted_value'];
	echo "Прошлый заказ вы делали на компанию ".$org_name.".";
	$arr_inn = json_encode($result,JSON_UNESCAPED_UNICODE);
	file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/test/inn.txt',$arr_inn);
//var_dump($result);
	$dadata->close();

}
?></p>
              <br>
              <div class="oformit_zakaz_contact_block">
                <div class="form-group">
                  <div class="form-label">Ваше имя</div>
                  <div class="form-input">
                    <input type="text" id="formname" class="phoneNumber">
                  </div>
                </div>
                <div height="40" style="font-size:0.8rem"> <br>
                  Для выписки счета необходимы реквизиты Вашей компании.<br>
                  Достаточно указать ИНН.<br>
                  <br>
                </div>
                <div class="form-group">
                  <div class="form-label" id="forminn_label">ИНН:&nbsp;</div>
                  <div class="form-input">
                    <input type="text" id="forminn" class="phoneNumber">
                    <div id="checkinn" class="dost_text"></div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-label">Ваша компания</div>
                  <div class="form-input">
                    <input type="text" id="formcompany" name="dd" class="phoneNumber">
                  </div>
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
                <form class="fileform" id="fileform" action="/abacus/components/catalog_cart/ajax_upload_file.php" method="post" enctype="multipart/form-data">
                  <div id="out_file_res">
                    <div class="form-group">
                      <div class="form-label">Отправить файл с реквизитами: &nbsp;</div>
                      <div class="form-input">
                        <input type="file" name="myFile" id="formfile">
                        <div id="checkfile" class="dost_text"></div>
                      </div>
                    </div>
                  </div>
                </form>
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
