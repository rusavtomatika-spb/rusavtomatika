<?
if (!defined('cms'))
    exit;

include 'result_modifier.php';

if(isset($arResult["element"]["properties"])) $properties = $arResult["element"]["properties"];
else $properties = array();

$path_core_images = $arguments["path_to_images"] . "/" . $arResult["element"]["series"] . "/" . $arResult["element"]["model"] . "/";
?>
<div class="catalog_element_monitors_aplex">
    <nav>
        <a href="/">Главная</a>&nbsp;/&nbsp;<a href="/monitors/aplex/">Мониторы Aplex</a>&nbsp;/&nbsp;Монитор Aplex <?= $arResult["element"]["model"] ?>
    </nav>

    <? if (isset($arResult["element"]["h1"]) and $arResult["element"]["h1"] != ""): ?>
        <h1><?= $arResult["element"]["h1"] ?></h1>
    <? else: ?>
        <h1>Промышленный монитор <?= $arResult["element"]["diagonal"] ?>&#8243; <?= $arResult["element"]["model"] ?>, со склада</h1>
    <? endif; ?>

    <div class="blockofcols_container">
        <div class="blockofcols_row">
            <div class="col-6">
            <?=print_pictures_in_detail_template($arResult["element"]["brand"],$arResult["element"]["type"],$arResult["element"]["model"],$arResult["element"]["pics_number"])?>


            </div>
            <div class="col-6" style="position: initial;">

                <? if (isset($arResult["element"]["model"])): ?>
                    <div class="catalog_element_monitors_aplex_property catalog_element_monitors_aplex_name  catalog_element_monitors_aplex_gray catalog_element_monitors_aplex_block_price">
                        <div class="blockofcols_container">
                            <div class="blockofcols_row">
                                <div class="col-3">
                                    <span class="field_title">Модель: </span>
                                    <span class="field_value"><?= $arResult["element"]["model"] ?></span>
                                </div>
                                <div class="col-3">
                                    <span class="field_title">Цена с НДС: </span>
                                    <span class="field_value">
                                        <? if ($arResult["element"]["retail_price"] > 0 && $arResult["element"]["retail_price_hide"] != 1): ?>
                                            <span class="catalog_element_monitors_aplex_price">
                                                <span class="prpr" title="Нажмите для пересчета в РУБ"><?= $arResult["element"]["retail_price"] ?></span>
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
                                            <? if ($arResult["element"]["onstock"] > 0): ?>
                                                <span class="val_in_stock">есть на складе</span>
                                            <? else: ?>
                                                <span class="val_no_in_stock absent">под заказ</span>
                                            <? endif; ?>
                                        </span>
                                    </div>
                                </div>

                                <? if ($arResult["element"]["retail_price"] > 0 and $arResult["element"]["onstock"] > 0): ?>
                                    <div class="but_wr"><div class="zakazbut addToCart" idm="<?= $arResult["element"]["model"] ?>"><span>В корзину</span></div></div>
                                <? else: ?>
                                    <div class="but_wr"><div class="zakazbut blocked" idm="<?= $arResult["element"]["model"] ?>" ><span>В корзину</span></div></div>
                                <? endif; ?>

                            </div>
                        </div>
                    </div>


                <? endif; ?>
                <div class="catalog_element_monitors_aplex_property catalog_element_monitors_aplex_buttons">
                    <div class="blockofcols_container">
                        <div class="blockofcols_row">
                            <div  style="display:none;width: 33%" class="col-5-5"><div class="but_wr"> <div class="zakazbut" idm="<?= $arResult["element"]["model"] ?>" onclick="show_compare(this)"><span>В&nbsp;сравнение</span></div></div></div>
                            <div class="col-5-5" style="width: 50%"><div class="but_wr"><div class="zakazbut" idm="<?= $arResult["element"]["model"] ?>" onclick="show_backup_call(2, '<?= $arResult["element"]["model"] ?>')"><span>Заказ&nbsp;в&nbsp;1&nbsp;клик</span></div></div></div>
                            <div class="col-5-5" style="width: 50%"><div class="but_wr"><div class="zakazbut" idm="<?= $arResult["element"]["model"] ?>" onclick="show_backup_call(1, '<?= $arResult["element"]["model"] ?>')"><span>Получить&nbsp;скидку</span></div> </div></div>
                        </div>
                    </div>
                </div>


                <div class="catalog_element_monitors_aplex_property catalog_element_monitors_aplex_text_detail">
                    <div class="blockofcols_container">
                        <div class="blockofcols_row">

                            <?= $arResult["element"]["text_detail"] ?>

                        </div>
                    </div>
                </div>



                <? /* if (isset($properties["series"]["value"]) and $properties["series"]["value"] != ""): ?>
                  <div class="catalog_element_monitors_aplex_property catalog_element_monitors_aplex_series">
                  <span class="field_title"><?= $properties["series"]["model"] ?>: </span>
                  <span class="field_value"><?= $properties["series"]["value"] ?></span></div>
                  <? endif; */ ?>
                <? if (isset($properties["io-points"]["value"]) and $properties["io-points"]["value"] != ""): ?>
                    <div class="catalog_element_monitors_aplex_property catalog_element_monitors_aplex_io-points">
                        <span class="field_title tick"><?= $properties["io-points"]["model"] ?>: </span>
                        <span class="field_value"><?= $properties["io-points"]["value"] ?></span></div><? endif; ?>
                <? if (isset($properties["program-capacity"]["value"]) and $properties["program-capacity"]["value"] != ""): ?>
                    <div class="catalog_element_monitors_aplex_property catalog_element_monitors_aplex_program-capacity">
                        <span class="field_title tick"><?= $properties["program-capacity"]["model"] ?>: </span>
                        <span class="field_value"><?= $properties["program-capacity"]["value"] ?> шагов</span>
                    </div>
                <? endif; ?>
                <? if (isset($properties["execution-speed"]["value"]) and $properties["execution-speed"]["value"] != ""): ?>
                    <div class="catalog_element_monitors_aplex_property catalog_element_monitors_aplex_execution-speed">
                        <span class="field_title tick"><?= $properties["execution-speed"]["model"] ?>: </span>
                        <span class="field_value"><?= $properties["execution-speed"]["value"] ?></span>
                    </div>
                <? endif; ?>
                <? if (isset($properties["com-port"]["value"]) and $properties["com-port"]["value"] != ""): ?>
                    <div class="catalog_element_monitors_aplex_property catalog_element_monitors_aplex_com-port">
                        <span class="field_title tick"><?= $properties["com-port"]["model"] ?>: </span>
                        <span class="field_value"><?= $properties["com-port"]["value"] ?></span>
                    </div>
                <? endif; ?>
                <? if (isset($properties["protocol"]["value"]) and $properties["protocol"]["value"] != ""): ?>
                    <div class="catalog_element_monitors_aplex_property catalog_element_monitors_aplex_protocol">
                        <span class="field_title tick"><?= $properties["protocol"]["model"] ?>: </span>
                        <span class="field_value"><?= $properties["protocol"]["value"] ?></span>
                    </div>
                <? endif; ?>
                <? if (isset($arResult["element"]["extra_text1"]) and $arResult["element"]["extra_text1"] != ""): ?>
                    <div class="catalog_element_monitors_aplex_property catalog_element_monitors_aplex_text-for-detail">
                        <?= $arResult["element"]["extra_text1"] ?>
                    </div>
                <? endif; ?>
            </div>
            <div class="col-12"><br></div>
            <div class="col-12">
                <div id="tabs">
                    <ul>
                        <li class="urlup" data="presentation"><a href="#tabs-1">ОПИСАНИЕ</a></li>
                        <li class="urlup" data="dimension"><a href="#tabs-3">ГАБАРИТЫ</a></li>
                        <li class="urlup" data="software"><a href="#tabs-4">СКАЧАТЬ</a></li>
                    </ul>
                    <div id="tabs-1">
                        <span style='float:right;margin-top:11px;'>Серия: <?= $arResult["element"]["series"] ?></span>
                        <h2>Описание <?= $arResult["element"]["model"] ?></h2>

                        <h3>Экран</h3>
                        <table class="table_style2">
                            <colgroup><col style="width:33%;"/><col style="width:66%;"/></colgroup>
                            <tbody>
                                <tr>
                                    <th>Характеристика</th><th>Значение</th>
                                </tr>

                                <tr>
                                    <td>Диагональ</td><td><?= $arResult["element"]["diagonal"] ?>&#8243;</td>
                                </tr>
                                <tr>
                                    <td>Разрешение</td><td><?= $arResult["element"]["resolution"] ?></td>
                                </tr>
                                <tr>
                                    <td>Яркость</td><td><?= $arResult["element"]["brightness"] ?></td>
                                </tr>
                                <tr>
                                    <td>Углы обзора</td><td><?= $arResult["element"]["view_angle"] ?></td>
                                </tr>
                                <tr>
                                    <td>Тип подсветки</td><td><?= $arResult["element"]["backlight"] ?></td>
                                </tr>
                                <tr>
                                    <td>Время жизни подсветки</td><td><?= $arResult["element"]["backlight_life"] ?></td>
                                </tr>
                                <tr>
                                    <td>Контрастность</td><td><?= $arResult["element"]["contrast"] ?></td>
                                </tr>
                                <tr>
                                    <td>Цветность</td><td><?= $arResult["element"]["colors"] ?></td>
                                </tr>
                                <tr>
                                    <td>Тип сенсора</td><td><?= $arResult["element"]["touch"] ?></td>
                                </tr>
                        </table>
                        <h3>Интерфейсы</h3>
                        <table class="table_style2">
                            <colgroup><col style="width:33%;"/><col style="width:66%;"/></colgroup>
                            <tr>
                                <th>Параметр</th><th>Значение</th>
                            </tr>
                            <tr>
                                <td>VGA</td><td><? echo ($arResult["element"]["vga_port"] == "VGA" || $arResult["element"]["vga_port"] == "есть") ? "есть" : " - " ?></td>
                            </tr>
                            <tr>
                                <td>DVI</td><td><? echo ($arResult["element"]["dvi_port"] == "DVI"  || $arResult["element"]["dvi_port"] == "есть") ? "есть" : " - " ?></td>
                            </tr>
                        </table>
                        <h3>Конструкция</h3>
                        <table class="table_style2">
                            <colgroup><col style="width:33%;"/><col style="width:66%;"/></colgroup>
                            <tr>
                                <th>Параметр</th><th>Значение</th>
                            </tr>
                            <tr>
                                <td>Материал корпуса</td><td><?= $arResult["element"]["case_material"] ?></td>
                            </tr>
                            <tr>
                                <td>Крепление</td><td><?
                                    echo $arResult["element"]["wall_mount"];
                                    echo $arResult["element"]["vesa75"] != "" ? ", " . $arResult["element"]["vesa75"] : "";
                                    echo $arResult["element"]["vesa100"] != "" ? ", " . $arResult["element"]["vesa100"] : "";
                                    ?></td>
                            </tr>
                            <tr>
                                <td>Посадочное отверстие</td><td><?= $arResult["element"]["cutout"] ?></td>
                            </tr>
                            <tr>
                                <td>Габариты</td><td><?= $arResult["element"]["dimentions"] ?></td>
                            </tr>
                            <tr>
                                <td>Вес (нетто)</td><td><?= $arResult["element"]["netto"] ?></td>
                            </tr>
                        </table>
                        <h3>Эксплуатация и хранение</h3>
                        <table class="table_style2">
                            <colgroup><col style="width:33%;"/><col style="width:66%;"/></colgroup>
                            <tr>
                                <td>Рабочая температура</td><td><?= $arResult["element"]["temp_min"] ?>~<?= $arResult["element"]["temp_max"] ?>&deg;C</td>
                            </tr>
                            <tr>
                                <td>Температура хранения</td><td><?= $arResult["element"]["temp_storage"] ?></td>
                            </tr>
                            <tr>
                                <td>Влажность при хранении</td><td><?= $arResult["element"]["humidity"] ?></td>
                            </tr>
                            <tr>
                                <td>Напряжение питания</td><td><?= $arResult["element"]["voltage_min"] ?>~<?= $arResult["element"]["voltage_max"] ?>V DC</td>
                            </tr>
                            <tr>
                                <td>Потребляемый ток</td><td><?= $arResult["element"]["current"] ?></td>
                            </tr>
                            <tr>
                                <td>Сертификаты</td><td><?= $arResult["element"]["certification"] ?></td>
                            </tr>
                        </table>
                    </div>

                    <div id="tabs-3">
                        <div class="catalog_element_monitors_aplex_diagrams">
                            <p><img src="<?= $path_core_images . $arResult["element"]["model"] . "_dimentions.png" ?>" alt="Габариты <?= $arResult["element"]["model"] ?>" /></p>
                            <table class="table_style2">
                                <colgroup><col style="width:33%;"/><col style="width:66%;"/></colgroup>
                                <tr>
                                    <th colspan="2"></th>
                                </tr>
                                <tr>
                                    <td>Габариты</td><td><?= $arResult["element"]["dimentions"] ?></td>
                                </tr>
                                <tr>
                                    <td>Посадочное отверстие</td><td><?= $arResult["element"]["cutout"] ?></td>
                                </tr>
                                <tr>
                                    <td>Крепление</td><td><?
                                        echo $arResult["element"]["wall_mount"];
                                        echo $arResult["element"]["vesa75"] != "" ? ", " . $arResult["element"]["vesa75"] : "";
                                        echo $arResult["element"]["vesa100"] != "" ? ", " . $arResult["element"]["vesa100"] : "";
                                        ?></td>
                                </tr>
                            </table>

                        </div>
                    </div>
                    <div id="tabs-4">
                        <h2>Файлы для работы с <?= $arResult["element"]["model"] ?></h2>
                        <table class="table_style1" >
                            <tbody>
                                <tr>
                                    <th style="width: 60%;">Название</th>
                                    <th style="width: 25%;">Примечание</th>
                                    <th style="width: 10%;">Файл</th>
                                </tr>
                                <?
                                foreach ($arResult["element"]["files"] as $file) {
                                    ?>

                                    <tr>

                                        <td class="text_align_left">
                                            <a target="_blank"
                                               href="<?= $file["path"] ?>"><b>
                                                       <?
                                                       echo $file["name"];
                                                       if ($file["language"])
                                                           echo " (" . $file["language"] . ")";
                                                       ?></b>
                                            </a>
                                        </td>
                                        <td>
                                            [&nbsp;<?
                                            $prim = "";
                                            if ($file["type"])
                                                $prim .= ", " . $file["type"];
                                            if ($file["date"])
                                                $prim .= ", " . $file["date"];
                                            if ($file["size"])
                                                $prim .= ", " . $file["size"];
                                            echo $prim = substr($prim, 2);
                                            ?>&nbsp;]
                                        </td>
                                        <td  class="text_align_center">
                                            <a class="green_button" target="_blank"
                                               href="<?= $file["path"] ?>">
                                                Скачать
                                            </a>
                                        </td>
                                    </tr>


                                    <?
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <style>
        .catalog_element_monitors_aplex__thumbnails{
            overflow: hidden;
            text-align: center;
            background: #f0f0f0;
        }
        .catalog_element_monitors_aplex__thumb{
            display: inline-block;
            width: 70px;
            height: 40px;
            margin: 5px 10px;
            background: center / contain no-repeat;
            cursor: pointer;
            border: 2px solid #f0f0f0;

        }
        .catalog_element_monitors_aplex__thumb.active{
            border: 2px solid #34ab5e;
        }

    </style>

    <?
    global $TITLE;
    $TITLE = str_replace("#element_name#", $arResult["element"]["diagonal"] . "&Prime; " . $arResult["element"]["model"], $arguments["SEO"]["element_title"]);
    global $DESCRIPTION;
    $DESCRIPTION = "Купить промышленный монитор " . $arResult["element"]["model"] . ". В наличии на крупнейшем в России складе продукции Aplex.";
    global $KEYWORDS;
    $KEYWORDS = $arResult["element"]["model"] . ", промышленный монитор";
    global $CANONICAL;
    $CANONICAL = "/monitors/aplex/ADP/" . $arResult["element"]["model"] . "/";
    global $EXTENTIONPARAM;
    $imgRemoteDir = "/images/" . mb_strtolower($arResult["element"]["brand"]) . "/" . mb_strtolower($arResult["element"]["type"]) . "/" . $arResult["element"]["model"] . "/";
    ob_start();?>


    <meta property="og:title" content="<?=$TITLE?>" />
    <meta property="og:image" content="<?echo 'http://www.rusavtomatika.com' . $imgRemoteDir . 'md/' . $arResult["element"]["model"] . '_1.png'?>" />
    <meta property='og:site_name' content='Русавтоматика' />
    <link rel='image_src' href="<?echo 'http://www.rusavtomatika.com' . $imgRemoteDir . 'md/' . $arResult["element"]["model"] . '_1.png'?>">
    
    <?$EXTENTIONPARAM = ob_get_clean();
    ?>

