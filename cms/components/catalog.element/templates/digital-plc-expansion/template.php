<?
if (!defined('cms'))
    exit;
$properties = $arResult["element"]["properties"];
?>
<div class="catalog_element_default">
    <nav><a href="/">Главная</a>&nbsp;/&nbsp;<a href="/plc/haiwell/">Контроллеры Haiwell</a>&nbsp;/&nbsp;<a href="/plc/haiwell/#<?= $arResult["element"]["section_code"] ?>"><?= $arResult["element"]["parent_section_name"] ?></a>&nbsp;/&nbsp;Модуль расширения <?= $arResult["element"]["name"] ?></nav>

    <? if (isset($arResult["element"]["h1"]) and $arResult["element"]["h1"] != ""): ?>
        <h1><?= $arResult["element"]["h1"] ?></h1>
    <? else: ?>
        <h1>Дискретный модуль расширения ПЛК Haiwell: <?= $arResult["element"]["name"] ?>, со склада</h1>
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
                <? if (isset($properties["dido-points"]["value"]) and $properties["dido-points"]["value"] != ""): ?>
                    <div class="catalog_element_default_property catalog_element_default_dido-points">
                        <span class="field_title tick"><?= $properties["dido-points"]["name"] ?>: </span>
                        <span class="field_value"><?= $properties["dido-points"]["value"] ?></span></div><? endif; ?>
                <? if (isset($properties["com-port"]["value"]) and $properties["com-port"]["value"] != ""): ?>
                    <div class="catalog_element_default_property catalog_element_default_com-port">
                        <span class="field_title tick"><?= $properties["com-port"]["name"] ?>: </span>
                        <span class="field_value"><?= $properties["com-port"]["value"] ?></span>
                    </div>
                <? endif; ?>
                <? /* if (isset($properties["remote-io-module"]["value"]) and $properties["remote-io-module"]["value"] != ""): ?>
                  <div class="catalog_element_default_property catalog_element_default_remote-io-module">
                  <span class="field_title tick"><?= $properties["remote-io-module"]["name"] ?>: </span>
                  <span class="field_value"><?= $properties["remote-io-module"]["value"] ?></span>
                  </div>
                  <? endif; */ ?>

                <?
                $pos = strpos($properties["com-port"]["value"], "RS485");
                if ($pos !== false) {
                    $pos2 = strpos($arResult["element"]["text_detail"], "Наличие интерфейса RS-485");
                    if ($pos2 === false) {
                        ?>
                        <div class="catalog_element_default_property">
                            <span class="field_title tick">Наличие интерфейса RS-485 позволяет использовать модуль как удаленный модуль ввода-вывода ( с управлением по Mоdbus RTU )</span>
                        </div>
                        <?
                    }
                }
                ?>
                <?
                $pos = strpos($properties["com-port"]["value"], "Ethernet");
                if ($pos !== false) {
                    $pos2 = strpos($arResult["element"]["text_detail"], "Ethernet");
                    if ($pos2 === false) {
                        ?>
                        <div class="catalog_element_default_property">
                            <span class="field_title tick">Модуль оснащен Ethernet, что позволяет удаленно управлять им по протоколу Modbus TCP</span>
                        </div>
                        <?
                    }
                }
                ?>


                <? if (isset($arResult["element"]["extra_text1"]) and $arResult["element"]["extra_text1"] != ""): ?>
                    <div class="catalog_element_default_property catalog_element_default_text-for-detail">
                        <?= $arResult["element"]["extra_text1"] ?>
                    </div>
                <? endif; ?>
            </div>
            <div class="col-12"><br></div>
            <div class="col-12">
                <div id="tabs">
                    <ul>
                        <li class="urlup" data="presentation"><a href="#tabs-description">ОПИСАНИЕ</a></li>
                        <li class="urlup" data="functions"><a href="#tabs-schemes">СХЕМЫ ПОДКЛЮЧЕНИЯ</a></li>
                        <?
                        if (isset($properties["dimension"]["value"]) and $properties["dimension"]["value"] != "") {
                            ?>
                            <li class="urlup" data="dimension"><a href="#tabs-dimension">ГАБАРИТЫ</a></li>
                        <? } ?>
                        <? if ($properties["communication"]["value"] != "" and $properties["communication"]["value"] != "нет") { ?>
                            <li class="urlup" data="functions"><a href="#tabs-3">ТАБЛИЦА РЕГИСТРОВ</a></li>
                        <? } ?>
                        <?
                        if (isset($properties["files"]) and is_array($properties["files"]) and count($properties["files"]) > 0) {
                            ?>
                            <li class="urlup" data="software"><a href="#tabs-4">СКАЧАТЬ</a></li>
                        <? } ?>
                    </ul>
                    <div id="tabs-description">
                        <h2>Описание <?= $arResult["element"]["name"] ?></h2>
                        <table class="table_style2">
                            <colgroup><col style="width:33%;"/><col/></colgroup>
                            <tbody>
                                <tr>
                                    <th>Характеристика</th><th>Значение</th>
                                </tr>

                                <? if (isset($properties["di"]["value"]) and $properties["di"]["value"] != ""): ?>
                                    <tr>
                                        <td>Дискретные входы (DI)</td><td><?= $properties["di"]["value"] ?></td>
                                    </tr>
                                <? endif; ?>
                                <? if (isset($properties["do"]["value"]) and $properties["do"]["value"] != ""): ?>
                                    <tr>
                                        <td>Дискретные выходы (DO)</td><td><?= $properties["do"]["value"] . "&nbsp;" . $properties["do-type"]["value"] ?></td>
                                    </tr>
                                <? endif; ?>
                                <? if (isset($properties["com-port"]["value"]) and $properties["com-port"]["value"] != ""): ?>
                                    <tr>
                                        <td><?= $properties["com-port"]["name"] ?></td><td><?= $properties["com-port"]["value"] ?></td>
                                    </tr>
                                <? endif; ?>
                            </tbody>
                        </table>
                        <div class="catalog_element_default_extra_tables">
                            <?
                            if (isset($properties["consumed-watt"]["value"]) and $properties["consumed-watt"]["value"] != "") {
                                $consumed_watt = '<tr><td>' . $properties["consumed-watt"]["name"] . '</td><td>' . $properties["consumed-watt"]["value"] . '</td></tr>';
                            }
                            $pos = strpos($properties["power"]["value"], "24");
                            if ($pos !== false) {
                                include $_SERVER['DOCUMENT_ROOT'] . '/include/haiwell/power-specification-24.php';
                            }
                            $pos = strpos($properties["power"]["value"], "220");
                            if ($pos !== false) {
                                include $_SERVER['DOCUMENT_ROOT'] . '/include/haiwell/power-specification-220.php';
                            }
                            ?>
                            <?
                            $dimensions = "";
                            if (isset($properties["dimension"]["value"]) and $properties["dimension"]["value"] != "") {
                                $dimensions = '<tr><td>' . $properties["dimension"]["name"] . '</td><td>' . $properties["dimension"]["value"] . '</td></tr>';
                            }
                            if (isset($properties["net-weight"]["value"]) and $properties["net-weight"]["value"] != "") {
                                $dimensions .= '<tr><td>' . $properties["net-weight"]["name"] . '</td><td>' . $properties["net-weight"]["value"] . '</td></tr>';
                            }
                            if (isset($properties["gross-weight"]["value"]) and $properties["gross-weight"]["value"] != "") {
                                $dimensions .= '<tr><td>' . $properties["gross-weight"]["name"] . '</td><td>' . $properties["gross-weight"]["value"] . '</td></tr>';
                            }
                            include $_SERVER['DOCUMENT_ROOT'] . '/include/haiwell/product-environment-specification.php';
                            ?>
                        </div>
                    </div>
                    <div id="tabs-schemes">
                        <div class="catalog_element_default_diagrams">
                            <? if ($properties["terminal-wiring-diagram"]["value"] != "") { ?>
                                <h3><?= $properties["terminal-wiring-diagram"]["name"] ?></h3>
                                <div><img src="<?= $properties["terminal-wiring-diagram"]["value"] ?>" alt="<?= $properties["terminal-wiring-diagram"]["name"] ?>" /></div>
                                <?
                            }
                            if ($properties["di"]["value"] != "") {
                                include $_SERVER['DOCUMENT_ROOT'] . '/include/haiwell/plc-product-di-specification.php';
                            }
                            ?>
                            <? if ($properties["digital-input-di-wiring-diagram"]["value"] != "" and $properties["di"]["value"] != "") { ?>
                                <h3><?= $properties["digital-input-di-wiring-diagram"]["name"] ?></h3>
                                <div><img src="<?= $properties["digital-input-di-wiring-diagram"]["value"] ?>" alt="<?= $properties["digital-input-di-wiring-diagram"]["name"] ?>" /></div>
                                <?
                            }
                            ?>
                            <?
                            if ($properties["do"]["value"] != "") {
                                if ($properties["do-type"]["value"] == "Реле") {
                                    include $_SERVER['DOCUMENT_ROOT'] . '/include/haiwell/plc-product-do-specification_relay.php';
                                }
                                if ($properties["do-type"]["value"] == "Транзистор NPN" or $properties["do-type"]["value"] == "Транзистор PNP") {
                                    include $_SERVER['DOCUMENT_ROOT'] . '/include/haiwell/plc-product-do-specification_transistor.php';
                                }
                            }
                            ?>
                            <? if ($properties["digital-output-do-wiring-diagram"]["value"] != "" and $properties["do"]["value"] != "") { ?>
                                <h3><?= $properties["digital-output-do-wiring-diagram"]["name"] ?></h3>
                                <div><img src="<?= $properties["digital-output-do-wiring-diagram"]["value"] ?>" alt="<?= $properties["digital-output-do-wiring-diagram"]["name"] ?>" /></div>
                            <? } ?>
                        </div>
                    </div>
                    <?
                    if (isset($properties["dimension"]["value"]) and $properties["dimension"]["value"] != "") {
                        ?>
                        <div id="tabs-dimension">
                            <div class="catalog_element_default_diagrams">
                                <h2>Габариты</h2>
                                <p><b><?= $properties["dimension"]["value"] ?></b></p>
                                <?
                                $dimension_img_url = "";
                                switch ($properties["dimension"]["value"]) {
                                    case "30*95*82 мм":
                                        $dimension_img_url = "/images/haiwell/dimensions/30_95_82.png";
                                        break;
                                    case "70*95*82 мм":
                                        $dimension_img_url = "/images/haiwell/dimensions/70_95_82.png";
                                        break;
                                    case "93*95*82 мм":
                                        $dimension_img_url = "/images/haiwell/dimensions/93_95_82.png";
                                        break;
                                    case "131*95*82 мм":
                                        $dimension_img_url = "/images/haiwell/dimensions/131_95_82.png";
                                        break;
                                    case "177*95*82 мм":
                                        $dimension_img_url = "/images/haiwell/dimensions/177_95_82.png";
                                        break;
                                    default:
                                        break;
                                }
                                if ($dimension_img_url != "") {
                                    ?><p><img src="<?= $dimension_img_url ?>" alt="Габариты <?= $arResult["element"]["name"] ?>" /></p><?
                                }
                                ?>

                            </div>
                        </div>
                    <? } ?>

                    <? if ($properties["communication"]["value"] != "" and $properties["communication"]["value"] != "нет") { ?>
                        <div id="tabs-3">
                            <div class="catalog_element_default_specifications">
                                <? include $_SERVER['DOCUMENT_ROOT'] . '/include/haiwell/digital-plc-expansion-rc.php'; ?>
                            </div>
                        </div>
                    <? } ?>

                    <? if (isset($properties["files"]) and is_array($properties["files"]) and count($properties["files"]) > 0) { ?>
                        <div id="tabs-4">
                            <h2>Файлы для работы с <?= $arResult["element"]["name"] ?></h2>
                            <table class="table_style1" >
                                <tbody>
                                    <tr>
                                        <th style="width: 60%;">Название</th>
                                        <th style="width: 10%;">Дата обновления</th>
                                        <th style="width: 15%;">Примечание</th>
                                        <th style="width: 15%;">Файл</th>
                                    </tr>
                                    <?
                                    foreach ($properties["files"] as $arFile) {
                                        ?>
                                        <tr>
                                            <td class="text_align_left">
                                                <b><?= $arFile["name_rus"] ?></b>
                                            </td>
                                            <td class="">
                                                <? echo date_format(date_create($arFile["date"]), "d/m/Y"); ?>
                                            </td>
                                            <td class="text_align_left">
                                                <?= $arFile["description"] ?>
                                            </td>
                                            <td>
                                                <a class="green_button" target="_blank" href="<?= $arFile["path"] ?>">Скачать</a>
                                            </td>
                                        </tr>
                                        <?
                                    }
                                    ?>
                                    <tr>
                                        <td class="text_align_left">
                                            <b>Руководство по приложению HaiwellHappy для программирования ПЛК (eng)</b>
                                        </td>
                                        <td class="">
                                            20/04/2017
                                        </td>
                                        <td class="text_align_left">
                                            [chm, 4.92MB]
                                        </td>
                                        <td>
                                            <a class="green_button" target="_blank" href="http://rusavtomatika.com/upload_files/catalogs/haiwell/HaiwellHappy_en.rar">Скачать</a>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <?
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
