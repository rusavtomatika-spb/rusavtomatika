<?
if (!defined('cms'))
    exit;

include 'result_modifier.php';

if (isset($arResult["element"]["properties"])) $properties = $arResult["element"]["properties"];
else $properties = array();

$path_core_images = $arguments["path_to_images"] ;
if ($arResult["element"]["model_fullname"]){
    $model_name = ($arResult["element"]["model_fullname"]);
}else{
    $model_name = $arResult["element"]["model"];
}
$model_name_no_quots = $arResult["element"]["model"];


?>
<div class="catalog_element_accessories xxxxx">
    <nav>
        <a href="/">Главная</a>&nbsp;/&nbsp;<a href="/accessories/">Аксессуары</a>&nbsp;/&nbsp; <?= $model_name ?>
    </nav>

    <? if (isset($arResult["element"]["h1"]) and $arResult["element"]["h1"] != ""): ?>
        <h1><?= $arResult["element"]["h1"] ?></h1>
    <? else: ?>
        <h1><?=$model_name ?>, со склада</h1>
    <? endif; ?>
    <div style="height: 20px"></div>

    <div class="blockofcols_container">
        <div class="blockofcols_row">
            <div class="col-6">
            <?=print_pictures_in_detail_template($arResult["element"]["brand"],$arResult["element"]["type"],$arResult["element"]["model"],$arResult["element"]["pics_number"])?>



            </div>



            <div class="col-6" style="position: initial;">

                <? if (isset($model_name)): ?>
                    <div class="catalog_element_monitors_aplex_property catalog_element_monitors_aplex_name  catalog_element_monitors_aplex_gray catalog_element_monitors_aplex_block_price">
                        <div class="blockofcols_container">
                            <div class="blockofcols_row">
<!--                                <div class="col-4">
                                    <span class="field_title"></span>
                                    <span style="overflow: hidden;max-height: 48px;" class="field_value"><?/*= $model_name */?></span>
                                </div>
-->                                <div class="col-5">
                                    <div class="field_title">Цена с НДС: </div>
                                    <span class="field_value">
                                        <? if ($arResult["element"]["retail_price"] > 0){
                                            switch ($arResult["element"]["currency"]) {
                                                        case "RUR":
                                                            ?>
                                                            <?= $arResult["element"]["retail_price"] ?>
                                                            <span style="font-size:12px;" >РУБ</span>
                                                            <?
                                                            break;
                                                        case "USD":
                                                        default:
                                                            ?>
                                                            <span class="catalog_element_monitors_aplex_price">
                                                                <span class="prpr" title="Нажмите для пересчета в РУБ"><?= $arResult["element"]["retail_price"] ?></span>
                                                                <span class="val_name" title="Нажмите для пересчета в РУБ">USD</span>
                                                            </span><?
                                                            break;
                                                        }
                                            ?>

                                        <?} else{ ?>
                                            <span class="val_no_price">Цена по запросу</span>
                                        <? } ?>
                                    </span>
                                </div>
                                <div class="col-5">
                                    <div>
                                        <div class="field_title">Наличие: </div>
                                        <span class="field_value">
                                            <? if ($arResult["element"]["onstock"] > 0 or $arResult["element"]["onstock_spb"] > 0 or $arResult["element"]["onstock_msk"] > 0 ): ?>
                                                <span class="val_in_stock">есть на складе</span>
                                            <? else: ?>
                                                <span class="val_no_in_stock absent">под заказ</span>
                                            <? endif; ?>
                                        </span>
                                    </div>
                                </div>

                                <? if ($arResult["element"]["retail_price"] > 0 and $arResult["element"]["onstock"] > 0): ?>
                                    <div class="but_wr"><div class="zakazbut addToCart" idm="<?= $model_name ?>"><span>В корзину</span></div></div>
                                <? else: ?>
                                    <div class="but_wr"><div class="zakazbut blocked" idm="<?= $model_name?>" ><span>В корзину</span></div></div>
                                <? endif; ?>

                            </div>
                        </div>
                    </div>


                <? endif; ?>
                <div class="catalog_element_monitors_aplex_property catalog_element_monitors_aplex_buttons">
                    <div class="blockofcols_container">
                        <div class="blockofcols_row">
                            <div  style="display:none;width: 33%" class="col-5-5"><div class="but_wr"> <div class="zakazbut" idm="<?= $model_name ?>" onclick="show_compare(this)"><span>В&nbsp;сравнение</span></div></div></div>
                            <div class="col-5-5" style="width: 50%"><div class="but_wr"><div class="zakazbut" idm="<?= $model_name ?>" onclick="show_backup_call(2, '<?= $model_name ?>')"><span>Заказ&nbsp;в&nbsp;1&nbsp;клик</span></div></div></div>
                            <div class="col-5-5" style="width: 50%"><div class="but_wr"><div class="zakazbut" idm="<?= $model_name ?>" onclick="show_backup_call(1, '<?= $model_name ?>')"><span>Получить&nbsp;скидку</span></div> </div></div>
                        </div>
                    </div>
                </div>


                <div class="catalog_element_monitors_aplex_property catalog_element_monitors_aplex_text_detail">
                    <div class="blockofcols_container">
                        <div class="blockofcols_row">

                            <?= $arResult["element"]["text_features"] ?>

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
                <?if ($arResult["element"]["text_detail"] != ''
                        || $arResult["element"]["dimentions"] != ''
                        || is_array($arResult["element"]["files"])):?>
                <div id="tabs">
                    <ul>
                        <li class="urlup" data="presentation"><a href="#tabs-1">ОПИСАНИЕ</a></li>
<?
if ($arResult["element"]["dimentions"] != ''):?>
                        <li class="urlup" data="dimension"><a href="#tabs-3">ГАБАРИТЫ</a></li>
<? endif; ?>
                        <?
if (is_array($arResult["element"]["files"])):?>
                        <li class="urlup" data="software"><a href="#tabs-4">СКАЧАТЬ</a></li>
<? endif; ?>
                    </ul>
                    <?if(isset($arResult["element"]["text_detail"]) and $arResult["element"]["text_detail"] != ''):?>

                    <div id="tabs-1">
                        <?= $arResult["element"]["text_detail"]?>
                    </div>
                    <?endif;?>
<?
if ($arResult["element"]["dimentions"] != ''):?>
                    <div id="tabs-3">
                        <div class="catalog_element_monitors_aplex_diagrams">

                            <table class="table_style2">
                                <colgroup><col style="width:33%;"/><col style="width:66%;"/></colgroup>
                                <tr>
                                    <th colspan="2"></th>
                                </tr>
                                <tr>
                                    <td>Габариты</td><td><?= $arResult["element"]["dimentions"] ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align:center;">
                                        <p><img src="<?= "/images/"
        . strtolower($arResult["element"]["brand"])
        ."/".strtolower($arResult["element"]["type"])
        ."/".$arResult["element"]["model"]
        ."/".$arResult["element"]["model"]
        . "_dimentions.png" ?>" alt="Габариты <?= $model_name ?>" /></p>
                                    </td>
                                </tr>
<? if ($arResult["element"]["cutout"]): ?>
                                    <tr>
                                        <td>Посадочное отверстие</td><td><?= $arResult["element"]["cutout"] ?></td>
                                    </tr>
                                <? endif; ?>
                                <?
                                if ($arResult["element"]["wall_mount"] or $arResult["element"]["vesa75"] or $arResult["element"]["vesa100"]):
                                    ?>
                                    <tr>
                                        <td>Крепление</td><td><?
                                            echo $arResult["element"]["wall_mount"];
                                            echo $arResult["element"]["vesa75"] != "" ? ", " . $arResult["element"]["vesa75"] : "";
                                            echo $arResult["element"]["vesa100"] != "" ? ", " . $arResult["element"]["vesa100"] : "";
                                            ?></td>
                                    </tr>
<? endif; ?>
                            </table>

                        </div>
                    </div>
<? endif; ?>
<?
if (is_array($arResult["element"]["files"])):
?>



                    <div id="tabs-4">
                        <h2>Файлы для работы с <?= $model_name ?></h2>
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
<?endif;?>
                </div>
            <?endif;?>
            </div>
        </div>
    </div>
    <style>
        .catalog_element_monitors_aplex_picture_detail_wrap{margin-bottom: 10px;}
        .catalog_element_monitors_aplex__thumbnails{
            overflow: hidden;
            text-align: center;
            background: #fff;
        }
        .catalog_element_monitors_aplex__thumb{
            display: inline-block;
            width: 60px;
            height: 40px;
            margin: 5px 5px;
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
    $TITLE = str_replace("#element_name#", $model_name, $arguments["SEO"]["element_title"]);
    global $DESCRIPTION;
    $DESCRIPTION = $arResult["element"]["description"];
    global $KEYWORDS;
    $KEYWORDS = $arResult["element"]["keywords"];
    global $CANONICAL;
    $CANONICAL = "/accessories/{$arResult["element"]["series"]}/" . $arResult["element"]["model"] . "/";
    ?>
