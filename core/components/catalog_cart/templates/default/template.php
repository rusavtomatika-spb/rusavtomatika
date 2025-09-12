<?php
global $arSettings;
$arSettings['path_to_product_images'] = '/images/';
CoreApplication::add_style(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/style.css");
//CoreApplication::add_style("/core/components/catalog_section/templates/default/style.css");
CoreApplication::add_script('//code.jquery.com/ui/1.9.2/jquery-ui.js');
//CoreApplication::add_script('//malsup.github.com/jquery.form.js');
CoreApplication::add_script(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/jquery.form.min.js");
CoreApplication::add_script(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/script.js");


global $arResult;
global $TITLE;
global $H1;
global $DESCRIPTION;
global $usd_currency, $arSettings;
if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/usdrate.txt")) {
    $usd_currency = floatval(file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/usdrate.txt"));
} else $usd_currency = 0;

$TITLE = "Корзина - Русавтоматика";
$H1 = "Корзина";
//CoreApplication::add_breadcrumbs_chain("Каталог оборудования", "/catalog/");
CoreApplication::add_breadcrumbs_chain("Корзина");
$series["products"] = $arResult["ITEMS"];
?>
<div class="catalog_cart">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?
                CoreApplication::include_component(array("component" => "breadcrumbs"));
                ?>
                <h1><?= $H1 ?></h1>
                <br>
                <div class='catalog_cart__warning'>
                    <p>При необходимости Вы можете уточнить <b>наличие</b> товара по Вашему заказу, условия
                        <b>доставки</b>, возможную <b>скидку</b>. Введите Ваш номер телефона и мы вам позвоним.</p>
                    <? include $_SERVER["DOCUMENT_ROOT"]."/include/widgets/inc_button_callback_call.php"; ?>
                </div>
                <div>

                </div>
                <br>
                <div id=order_send_mess></div>
                <div class="component_catalog_cart__panel_of_products">
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

            <?if (isset($series["products"]) and is_array($series["products"])) {?>
            <div class="col-lg-12">
                <div class="block_order">
                    <div class="block_order__title">Оформление заказа</div>
                    <div class="block_order__gray_panel">
                        <div class="block_order__flex_block">
                            <div class="">
                                <h2>Способ доставки:</h2>
                                <div class="oformit_zakaz_delivery_block">
                                    <div class="item">
                                        <input type="radio" id="dost7" name="dost" checked="checked"> <label
                                                for="dost7"><b>Бесплатная</b> доставка</label> <a
                                                href="/payment-shipping/" target="_blank'"> курьерской службой
                                            «DPD»</a> по РФ (1-2 недели)
                                    </div>
                                    <div class="item">
                                        <input type="radio" id="dost2" name="dost"> <label for="dost2">Доставка курьером
                                            по РФ ( 3-4 дня )</label>
                                    </div>
                                    <div class="item">
                                        <input type="radio" id="dost3" name="dost"> <label for="dost3">Самовывоз
                                            со</label> <a href="//www.rusavtomatika.com/contacts/" target="_blank">
                                            склада в Петербурге</a>
                                    </div>
                                    <div class="item">
                                        <input type="radio" id="dost4" name="dost"> <label for="dost4">Самовывоз
                                            со</label> <a href="//www.rusavtomatika.com/contacts/" target="_blank">
                                            склада в Москве</a>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <h2>Контактная информация:</h2>

                                <div class="oformit_zakaz_contact_block">
                                    <table>
                                        <tbody>
                                        <tr height="40">
                                            <td class="dost_text"> Ваше имя</td>
                                            <td><input type="text" id="formname" class="phoneNumber"></td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;Телефон <span style="color: red">*</span></td>
                                            <td><input type="text" id="formphone" placeholder="+79998887766" class="phoneNumber"></td>
                                            <td>
                                                <div id="checkphone" class="dost_text"><font
                                                            color="red">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </font></div>
                                            </td>
                                        </tr>
                                        <tr height="40">
                                            <td class="dost_text">Ваша компания</td>
                                            <td class="dost_text"><input type="text" id="formcompany" name="dd"
                                                                         class="phoneNumber">
                                            </td>
                                            <td class="dost_text">&nbsp;&nbsp;&nbsp;&nbsp;Email <span style="color: red">*</span></td>
                                            <td class="dost_text"><input type="text" placeholder="name@domain.zone" id="formemail" class="phoneNumber">
                                            </td>
                                            <td>
                                                <div id="checkmail" class="dost_text"><font color="red"></font></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="dost_text"></td>
                                            <td class="dost_text">&nbsp;&nbsp;</td>
                                            <td>
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                    <form class="fileform" action="/core/components/catalog_cart/ajax_upload_file.php" method="post"
                                          enctype="multipart/form-data">
                                        <div id="out_file_res">
                                            <table width="90%">
                                                <tbody>
                                                <tr>
                                                    <td class="dost_text"
                                                        title="Для выставления счета на понадобятся реквизиты Вашей компании"
                                                        width="106" height="30">
                                                        Реквизиты
                                                    </td>
                                                    <td><input type="file" name="myFile" id="formfile"></td>
                                                    <td>
                                                        <div id="checkfile" class="dost_text"></div>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
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


