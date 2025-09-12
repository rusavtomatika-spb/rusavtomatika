<?
if (!defined('cms'))
    exit;
$properties = $arResult["element"]["properties"];
?>
<div class="catalog_element_default">
    <nav><a href="/">Главная</a>&nbsp;/&nbsp;<a href="/plc/haiwell/">Контроллеры Haiwell</a>&nbsp;/&nbsp;<a href="/plc/haiwell/#<?= $arResult["element"]["section_code"] ?>"><?= $arResult["element"]["parent_section_name"] ?></a>&nbsp;/&nbsp;<?= $arResult["element"]["text_detail"] ?></nav>
    <? if (isset($arResult["element"]["h1"]) and $arResult["element"]["h1"] != ""): ?>
        <h1><?= $arResult["element"]["h1"] ?></h1>
    <? else: ?>
        <h1><?= $arResult["element"]["text_detail"] ?>, со склада</h1>
    <? endif; ?>

    <div class="blockofcols_container">
        <div class="blockofcols_row">
            <div class="col-4">
                <a data-fancybox data-fancybox="group" data-caption="<?= $arResult["element"]["name"] ?>" href="<?= $arResult["element"]["picture_detail"] ?>">
                    <div class="catalog_element_default_picture_detail_wrap">
                        <div class="catalog_element_default_picture_detail" style="background-image: url(<?= $arResult["element"]["picture_detail"] ?>);"></div>
                    </div>
                </a>
            </div>
            <div class="col-8" style="position: initial;">
                <? if (isset($arResult["element"]["name"])): ?>
                    <div class="catalog_element_default_property catalog_element_default_name  catalog_element_default_gray catalog_element_default_block_price">
                        <div class="blockofcols_container">
                            <div class="blockofcols_row">
                                <div class="col-3">
                                    <span class="field_title">Модель: </span>
                                    <span class="field_value"><?= $arResult["element"]["name"] ?></span>
                                </div>
                                <div class="col-3">
                                    <span class="field_title">Цена с НДС: </span>
                                    <span class="field_value">
                                        <? if ($arResult["element"]["price"] > 0): ?>
                                            <span class="catalog_element_default_price">
                                                <span class="prpr" title="Нажмите для пересчета в РУБ"><?= $arResult["element"]["price"] ?></span>
                                                <span class="val_name" title="Нажмите для пересчета в РУБ">USD</span>
                                            </span>
                                        <? else: ?>
                                            <span class="val_no_price">Цена по запросу</span>
                                        <? endif; ?>
                                    </span>
                                </div>
                                <div class="col-3">
                                    <div>
                                        <span class="field_title">Наличие: </span>
                                        <span class="field_value">
                                            <? if ($arResult["element"]["in_stock"] > 0): ?>
                                                <span class="val_in_stock">есть на складе</span>
                                            <? else: ?>
                                                <span class="val_no_in_stock absent">под заказ</span>
                                            <? endif; ?>
                                        </span>
                                    </div>
                                </div>

                                <? if ($arResult["element"]["price"] > 0 and $arResult["element"]["in_stock"] > 0): ?>
                                    <div class="but_wr"><div class="zakazbut addToCart" idm="<?= $arResult["element"]["name"] ?>"><span>В корзину</span></div></div>
                                <? else: ?>
                                    <div class="but_wr"><div class="zakazbut blocked" idm="<?= $arResult["element"]["name"] ?>" ><span>В корзину</span></div></div>
                                <? endif; ?>

                            </div>
                        </div>
                    </div>


                <? endif; ?>
                <div class="catalog_element_default_property catalog_element_default_buttons">
                    <div class="blockofcols_container">
                        <div class="blockofcols_row">
                            <div  style="display:none;width: 33%" class="col-5-5"><div class="but_wr"> <div class="zakazbut" idm="<?= $arResult["element"]["name"] ?>" onclick="show_compare(this)"><span>В&nbsp;сравнение</span></div></div></div>
                            <div class="col-5-5" style="width: 50%"><div class="but_wr"><div class="zakazbut" idm="<?= $arResult["element"]["name"] ?>" onclick="show_backup_call(2, '<?= $arResult["element"]["name"] ?>')"><span>Заказ&nbsp;в&nbsp;1&nbsp;клик</span></div></div></div>
                            <div class="col-5-5" style="width: 50%"><div class="but_wr"><div class="zakazbut" idm="<?= $arResult["element"]["name"] ?>" onclick="show_backup_call(1, '<?= $arResult["element"]["name"] ?>')"><span>Получить&nbsp;скидку</span></div> </div></div>
                        </div>
                    </div>
                </div>

                <? /* if (isset($properties["series"]["value"]) and $properties["series"]["value"] != ""): ?>
                  <div class="catalog_element_default_property catalog_element_default_series">
                  <span class="field_title"><?= $properties["series"]["name"] ?>: </span>
                  <span class="field_value"><?= $properties["series"]["value"] ?></span></div>
                  <? endif; */ ?>

                <? /* if (isset($properties["com-port"]["value"]) and $properties["com-port"]["value"] != ""): ?>
                  <div class="catalog_element_default_property catalog_element_default_com-port">
                  <span class="field_title tick"><?= $properties["com-port"]["name"] ?>: </span>
                  <span class="field_value"><?= $properties["com-port"]["value"] ?></span>
                  </div>
                  <? endif; */ ?>
                <? if (isset($properties["remote-io-module"]["value"]) and $properties["remote-io-module"]["value"] != ""): ?>
                    <div class="catalog_element_default_property catalog_element_default_remote-io-module">
                        <span class="field_title tick"><?= $properties["remote-io-module"]["name"] ?>: </span>
                        <span class="field_value"><?= $properties["remote-io-module"]["value"] ?></span>
                    </div>
                <? endif; ?>
                <? if (isset($properties["isolation"]["value"]) and $properties["isolation"]["value"] != ""): ?>
                    <div class="catalog_element_default_property catalog_element_default_remote-io-module">
                        <span class="field_title tick"><?= $properties["isolation"]["name"] ?>: </span>
                        <span class="field_value"><?= $properties["isolation"]["value"] ?></span>
                    </div>
                <? endif; ?>
                <? if (isset($arResult["element"]["extra_text1"]) and $arResult["element"]["extra_text1"] != ""): ?>
                    <div class="catalog_element_default_property catalog_element_default_text-for-detail">
                        <?= $arResult["element"]["extra_text1"] ?>
                    </div>
                <? endif; ?>
                <? if (isset($properties["specification"]["value"]) and $properties["specification"]["value"] != ""): ?>
                    <div class="catalog_element_default_property catalog_element_default_specification">
                        <?= $properties["specification"]["value"] ?>
                    </div>
                <? endif; ?>

                <? if ($properties["product-introduction"]["value"] != "") { ?>
                    <br><div class="catalog_element_default_property"><div class="catalog_element_default_text_detail">
                            <?= $properties["product-introduction"]["value"] ?></div></div>
                        <? } ?>
                        <? if ($properties["programming-cable-wiring-diagram"]["value"] != "") { ?>
                    <br>
                    <h3><?= $properties["programming-cable-wiring-diagram"]["name"] ?></h3>
                    <div><p><img src="<?= $properties["programming-cable-wiring-diagram"]["value"] ?>" alt="<?= $properties["programming-cable-wiring-diagram"]["name"] ?>" /></p></div>
                <? } ?>

            </div>
        </div>
    </div>
