<?
if (!defined('cms'))
    exit;

include 'result_modifier.php';




if (isset($arResult["element"]["properties"])) {
    $properties = $arResult["element"]["properties"];
} else {
    $properties = array();
}

$path_core_images = $arguments["path_to_images"] . "/" . $arResult["element"]["model"] . "/";


?>
<div class="catalog_element_monitors_aplex">
    <nav>
        <a href="/">Главная</a>&nbsp;/&nbsp;Роутеры&nbsp;/&nbsp;Роутер <?= $arResult["element"]["model"] ?>
    </nav>

    <? if (isset($arResult["element"]["h1"]) and $arResult["element"]["h1"] != ""): ?>
        <h1><?= $arResult["element"]["h1"] ?></h1>
    <? else: ?>
        <h1>Роутер <?= $arResult["element"]["series"] . " " . $arResult["element"]["model"] ?>, со склада</h1>
    <? endif; ?>

    <div class="blockofcols_container">
        <div class="blockofcols_row">
            <div class="col-4">
                <?
                $first_picture = 0;

                foreach ($arResult["element"]["images"] as $image) {

                    $first_picture++;
                    ?>
                    <a class="catalog_element_monitors_aplex__main_picture number_of_picture_<?= $first_picture ?>"
                       data-fancybox="group"
                       data-caption="<?= $arResult["element"]["model"] ?>"
                       href="<?= $path_core_images . $image["b_img_path"]; ?>">
                        <? if ($first_picture == 1) {


                            ?>
                            <div class="catalog_element_monitors_aplex_picture_detail_wrap">
                            <div class="catalog_element_monitors_aplex_picture_detail"
                                 style="background-image: url(<?= $path_core_images .
                                 $image["m_img_path"]; ?>);"></div>
                            </div><? } ?>
                    </a>
                <? } ?>
                <div class="catalog_element_monitors_aplex__thumbnails">
                    <?
                    foreach ($arResult["element"]["images"] as $image) {
                        ?><span class="catalog_element_monitors_aplex__thumb"
                                data-rel-large="<?= $path_core_images . $image["b_img_path"] ?>"
                                data-rel-middle="<?= $path_core_images . $image["m_img_path"] ?>"

                                style="background-image: url('<?= $path_core_images . $image["s_img_path"] ?>')"></span><?
                    }
                    ?>
                </div>
                <script>
                    $(document).ready(function () {
                        $(".catalog_element_monitors_aplex__thumb").click(function () {
                            $(".catalog_element_monitors_aplex__thumb").removeClass("active");
                            $(this).addClass("active");
                            $(".catalog_element_monitors_aplex__main_picture.number_of_picture_1 .catalog_element_monitors_aplex_picture_detail").css("background-image",
                                "url('" + $(this).attr('data-rel-middle') + "')");
                            $("a.catalog_element_monitors_aplex__main_picture.number_of_picture_1").attr("href", $(this).attr('data-rel-large'));

                        });
                        /*$("a.catalog_element_monitors_aplex__main_picture").fancybox();*/
                        $(".catalog_element_monitors_aplex__thumb:first").click();
                    });
                </script>


            </div>


            <div class="col-8" style="position: initial;">

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
                                        <? if ($arResult["element"]["retail_price"] > 0):
                                            switch ($arResult["element"]["currency"]) {
                                                case "RUR":
                                                    ?>
                                                    <?= $arResult["element"]["retail_price"] ?>
                                                    <span style="font-size:12px;">РУБ</span>
                                                    <?
                                                    break;
                                                case "USD":
                                                default:
                                                    ?>
                                                    <span class="catalog_element_monitors_aplex_price">
                                                    <span class="prpr"
                                                          title="Нажмите для пересчета в РУБ"><?= $arResult["element"]["retail_price"] ?></span>
                                                                <span class="val_name"
                                                                      title="Нажмите для пересчета в РУБ">USD</span>
                                                    </span><?
                                                    break;
                                            }
                                            ?>
                                        <? else: ?>
                                            <span class="val_no_price">Цена по запросу</span>
                                        <? endif; ?>
                                    </span>
                                </div>
                                <div class="col-3">
                                    <div>
                                        <span class="field_title">Наличие: </span>
                                        <span class="field_value">
                                            <? if (($arResult["element"]["onstock"] > 0) and ($arResult["element"]["discontinued"] == 0)): ?>
                                                <span class="val_in_stock">есть на складе</span>
                                            <?elseif($arResult["element"]["discontinued"] == 1):?>
                                                Снят с производства. <?if(!empty($arResult["element"]["analogs"])):?><?=$arResult["element"]["analogs"]?><?endif;?>
                                            <? else: ?>
                                                <span class="val_no_in_stock absent">под заказ</span>
                                            <? endif; ?>
                                        </span>
                                    </div>
                                </div>

                                <? if ($arResult["element"]["retail_price"] > 0 and $arResult["element"]["onstock"] > 0 and $arResult["element"]["discontinued"] == 0): ?>
                                    <div class="but_wr">
                                        <div class="zakazbut addToCart" idm="<?= $arResult["element"]["model"] ?>"
                                             ><span>В корзину</span></div>
                                    </div>
                                <? else: ?>
                                    <div class="but_wr">
                                        <div class="zakazbut blocked" idm="<?= $arResult["element"]["model"] ?>"><span>В корзину</span>
                                        </div>
                                    </div>
                                <? endif; ?>

                            </div>
                        </div>
                    </div>


                <? endif; ?>
                <div class="catalog_element_monitors_aplex_property catalog_element_monitors_aplex_buttons">
                    <div class="blockofcols_container">
                        <div class="blockofcols_row">
                            <div style="display:none;width: 33%" class="col-5-5">
                                <div class="but_wr">
                                    <div class="zakazbut" idm="<?= $arResult["element"]["model"] ?>"
                                         onclick="show_compare(this)"><span>В&nbsp;сравнение</span></div>
                                </div>
                            </div>
                            <div class="col-5-5" style="width: 50%">
                                <div class="but_wr">
                                    <div class="zakazbut" idm="<?= $arResult["element"]["model"] ?>"
                                         onclick="show_backup_call(2, '<?= $arResult["element"]["model"] ?>')"><span>Заказ&nbsp;в&nbsp;1&nbsp;клик</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-5-5" style="width: 50%">
                                <div class="but_wr">
                                    <div class="zakazbut" idm="<?= $arResult["element"]["model"] ?>"
                                         onclick="show_backup_call(1, '<?= $arResult["element"]["model"] ?>')"><span>Получить&nbsp;скидку</span>
                                    </div>
                                </div>
                            </div>
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
            <?
            $current_model = $arResult["element"]["model"];
            require_once $_SERVER['DOCUMENT_ROOT'] . "/sc/lib_new_includes/functions_linked_products.php";
            ?>
            <div class="col-12"><br></div>
            <div class="col-12">
                <div id="tabs">
                    <ul>
                        <li class="urlup" data="presentation"><a href="#tabs-1">ОПИСАНИЕ</a></li>
                        <li class="urlup" data="dimension"><a href="#tabs-3">ГАБАРИТЫ</a></li>
                        <?
                        if (is_array($arResult["element"]["files"])):?>
                            <li class="urlup" data="software"><a href="#tabs-4">СКАЧАТЬ</a></li>
                        <? endif; ?>
                    </ul>
                    <div id="tabs-1">
                        <?= $arResult["element"]["text_detail"] ?>
                    </div>

                    <div id="tabs-3">
                        <div class="catalog_element_monitors_aplex_diagrams">

                            <table class="table_style2">
                                <colgroup>
                                    <col style="width:33%;"/>
                                    <col style="width:66%;"/>
                                </colgroup>
                                <tr>
                                    <th colspan="2"></th>
                                </tr>
                                <tr>
                                    <td>Габариты</td>
                                    <td><?= $arResult["element"]["dimentions"] ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align:center;">
                                        <p>
                                            <img src="<?= $path_core_images . $arResult["element"]["model"] . "_dimentions.png" ?>"
                                                 alt="Габариты <?= $arResult["element"]["model"] ?>"/></p>
                                    </td>
                                </tr>
                                <? if ($arResult["element"]["cutout"]): ?>
                                    <tr>
                                        <td>Посадочное отверстие</td>
                                        <td><?= $arResult["element"]["cutout"] ?></td>
                                    </tr>
                                <? endif; ?>
                                <?
                                if ($arResult["element"]["wall_mount"] or $arResult["element"]["vesa75"] or $arResult["element"]["vesa100"]):
                                    ?>
                                    <tr>
                                        <td>Крепление</td>
                                        <td><?
                                            echo $arResult["element"]["wall_mount"];
                                            echo $arResult["element"]["vesa75"] != "" ? ", " . $arResult["element"]["vesa75"] : "";
                                            echo $arResult["element"]["vesa100"] != "" ? ", " . $arResult["element"]["vesa100"] : "";
                                            ?></td>
                                    </tr>
                                <? endif; ?>
                            </table>

                        </div>
                    </div>

                    <?
                    if (is_array($arResult["element"]["files"])):
                        ?>


                        <div id="tabs-4">
                            <h2>Файлы для работы с <?= $arResult["element"]["model"] ?></h2>
                            <table class="table_style1">
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
                                        <td class="text_align_center">
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
                    <? endif; ?>
                </div>
            </div>
        </div>
    </div>

    <style>
        .catalog_element_monitors_aplex_picture_detail_wrap {
            margin-bottom: 10px;
        }

        .catalog_element_monitors_aplex__thumbnails {
            overflow: hidden;
            text-align: center;
            background: #fff;
        }

        .catalog_element_monitors_aplex__thumb {
            display: inline-block;
            width: 60px;
            height: 40px;
            margin: 5px 5px;
            background: center / contain no-repeat;
            cursor: pointer;
            border: 2px solid #f0f0f0;

        }

        .catalog_element_monitors_aplex__thumb.active {
            border: 2px solid #34ab5e;
        }

    </style>

    <?
    global $TITLE;
    $TITLE = str_replace("#element_name#", $arResult["element"]["model"], $arguments["SEO"]["element_title"]);
    global $DESCRIPTION;
    $DESCRIPTION = "Купить Роутер 3G\WiFi MD " . $arResult["element"]["model"];
    global $KEYWORDS;
    $KEYWORDS = $arResult["element"]["model"] . ", Роутер, MD";
    global $CANONICAL;
    $CANONICAL = "/routers/md/{$arResult["element"]["series"]}/" . $arResult["element"]["model"] . "/";
    global $extra_openGraph;
    $extra_openGraph = array(
        "openGraph_image" => $path_core_images . $image["b_img_path"],
        "openGraph_title" => "Роутер " . $arResult["element"]["model"],
        "openGraph_siteName" => "Русавтоматика"
    );
    
    ?>

