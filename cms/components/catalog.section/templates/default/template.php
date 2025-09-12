<?
if (!defined('cms'))
    exit;
include "result_modifier.php";

global $APPLICATION;
if (isset($arguments["catalog_section_H1"]) and $arguments["catalog_section_H1"] != "") {
    ?>
    <h1><?= $arguments["catalog_section_H1"] ?></h1>
    <?
}
//var_dump($arguments["SEF"]);

if (isset($arResult["section"]) and is_array($arResult["section"])) {
    ?><div class="h2 block_section_roll_link" data-rel="<?= $arguments["section_code"] ?>">
        <div class="block_section_roll_link_wrapinn"><span class="block_section_preview_image" style="background-image: url('<?= $arResult["section_picture_preview"] ?>')"></span><?= $arguments["section_name"] ?></div>
        <? if (isset($arResult["section_text_preview"]) and $arResult["section_text_preview"] != ""): ?><div class="block_section_roll_description"><?= $arResult["section_text_preview"] ?></div><? endif; ?>
        <span class="block_section_roll_link_arrow"></span>
    </div>

    <div class="block_section_roll <?= $arguments["section_code"] ?>"><?
        $x = 0;
        foreach ($arResult["section"] as $value) {
            /* ?><pre><? //var_dump($value["properties"]) ?></pre><? */
            $x++;
            $text = "";
            if (isset($value["properties"]["di"]) and isset($value["properties"]["do"])) {
                $class = $value["properties"]["di"]["value"] . "_" . $value["properties"]["do"]["value"] . "_" . $APPLICATION->translitURL($value["properties"]["do-type"]["value"]);
                if ($value["properties"]["di"]["value"] != "") {
                    $text .= "<span class='DI_span'>Дискретных входов:</span> <b>" . $value["properties"]["di"]["value"] . "</b>";
                    if ($value["properties"]["di"]["value"] < 10)
                        $text .= "&nbsp;&nbsp;";
                    if ($value["properties"]["do"]["value"] != "") {
                        $text .= " выходов: <b>" . $value["properties"]["do"]["value"] . "</b>";
                        if ($value["properties"]["do"]["value"] < 10)
                            $text .= "&nbsp;&nbsp;";
                    }else {
                        $text .= "<span class='no_DO_span'></span>";
                    }
                } elseif ($value["properties"]["do"]["value"] != "") {
                    $text .= "<span class='no_DO_span2'></span><span class='DO_span'>Дискретных выходов:</span> <b>" . $value["properties"]["do"]["value"] . "</b>";
                    if ($value["properties"]["do"]["value"] < 10)
                        $text .= "&nbsp;&nbsp;";
                }
                if ($value["properties"]["do-type"]["value"] != "") {
                    $value["properties"]["do-type"]["value"] = str_replace("Transistor", "Транзистор", $value["properties"]["do-type"]["value"]);
                    $value["properties"]["do-type"]["value"] = str_replace("Relay", "Реле", $value["properties"]["do-type"]["value"]);
                    $text .= " <b class='minwidth1'>(" . $value["properties"]["do-type"]["value"] . ")</b>";
                }
            } elseif (isset($value["properties"]["ai"]) or isset($value["properties"]["ao"])) {
                $class = $value["properties"]["ai"]["value"] . "_" . $value["properties"]["ao"]["value"];
                $text = "";
                if ($value["properties"]["ai"]["value"] != "") {
                    if ($arguments["section_code"] != "temperature-plc-expansion") {
                        $text .= "<span class='AI_span'>Аналоговых входов:</span> ";
                    }
                    $text .= "<b>";
                    if ($value["properties"]["ai"]["value"] < 10 and $arguments["section_code"] != "temperature-plc-expansion")
                        $text .= "&nbsp;&nbsp;";

                    $text .= $value["properties"]["ai"]["value"] . "</b>";
                    if ($value["properties"]["ai"]["value"] != ""
                            and $arguments["section_code"] != "analog-plc-expansion"
                            and $arguments["section_code"] != "temperature-plc-expansion") {
                        $text .= ", ";
                    }
                    $text .= "";
                } else {
                    if ($arguments["section_code"] != "temperature-plc-expansion") {
                        $text .= "<span class='no_AI_span'></span>";
                    }
                }
                if ($value["properties"]["ao"]["value"] != "") {



                    if ($value["properties"]["ai"]["value"] == "") {
                        $text .= "<span class='AO_span'>Аналоговых выходов:</span> <b>";
                    } else {
                        $text .= "<span class='AO_span'>выходов:</span> <b>";
                    }





                    if ($value["properties"]["ao"]["value"] < 10)
                        $text .= "&nbsp;&nbsp;";
                    $text .= $value["properties"]["ao"]["value"] . "</b>";
                }else {
                    if ($arguments["section_code"] != "temperature-plc-expansion") {
                        $text .= "<span class='no_AO_span'></span>";
                    }
                }
                if ($value["properties"]["input-type"]["value"] != "") {
                    if ($value["properties"]["ai"]["value"] == 4 and $value["properties"]["input-type"]["value"] == "термопар") {
                        $value["properties"]["input-type"]["value"] = "термопары";
                    }
                    if ($value["properties"]["ai"]["value"] == 4 and $value["properties"]["input-type"]["value"] == "термосопротивлений") {
                        $value["properties"]["input-type"]["value"] = "термосопротивления";
                    }
                    $text .= " <span class='input-type_span'>" . $value["properties"]["input-type"]["value"] . "</span>";
                    $class .= $APPLICATION->translitURL($value["properties"]["input-type"]["value"]);
                }
            } else {
                $class = "";
                $text = "";
            }
            if (isset($value["properties"]["specification"]["value"]) and $value["properties"]["specification"]["value"] != "") {
                $text .= " " . $value["properties"]["specification"]["value"];
            }
            if (isset($value["properties"]["com-port"]["value"]) and $value["properties"]["com-port"]["value"] != "") {
                if ($arguments["section_code"] == "temperature-plc-expansion")
                    $text .= $value["properties"]["com-port"]["value"];
                if ($arguments["section_code"] == "analog-plc-expansion") {
                    $value["properties"]["com-port"]["value"] = str_replace(",", "", $value["properties"]["com-port"]["value"]);
                    $text .= "<span class='com-port_span'><span class='wrapp_in'>" . $value["properties"]["com-port"]["value"] . "</span></span>";
                }
            }

            /*
              if (isset($value["properties"]["communication"]["value"]) and $value["properties"]["communication"]["value"] != "") {
              $text .= ";&nbsp; " . $value["properties"]["communication"]["value"];
              } */
            /* if (isset($value["properties"]["max-module"]["value"]) and $value["properties"]["max-module"]["value"] != "") {
              if (intval($value["properties"]["max-module"]["value"]) > 0) {
              $text .= ";&nbsp; до&nbsp;" . $value["properties"]["max-module"]["value"] . "&nbsp;расш. ";
              }
              } */
            if (isset($value["properties"]["power"]["value"]) and $value["properties"]["power"]["value"] != "") {
                $text .= "<span class='power_span'>" . $value["properties"]["power"]["value"] . "</span>";
            }
            /* if (isset($value["properties"]["dimension"]["value"]) and $value["properties"]["dimension"]["value"] != "") {
              $text .= ";&nbsp; " . $value["properties"]["dimension"]["value"];
              } */
            /*  switch ($arguments["section_code"]) {
              case "analog-plc-expansion":
              case "digital-plc-expansion":
              case "temperature-plc-expansion":
              case "communication-plc-expansion":
              case "programmable-power-module":
              if (isset($value["properties"]["com"]["value"])) {
              $pos = strripos($value["properties"]["com"]["value"], "RS485");
              if ($pos !== false) {
              $pos2 = strripos($value["name"], "-e");
              if ($pos !== false) {
              $text .= ";&nbsp; <b class='catalog_section_default_item__text_b'>Может использоваться как модуль удаленного ввода по RS-485, Ethernet,  Modbus RTU,  Modbus TCP</b>";
              } else {
              $text .= ";&nbsp; <b class='catalog_section_default_item__text_b'>Может использоваться как модуль удаленного ввода по RS-485,  Modbus RTU,  Modbus TCP</b>";
              }
              }
              } elseif (isset($value["properties"]["communication"]["value"])) {
              $pos = strripos($value["properties"]["communication"]["value"], "RS485");
              if ($pos !== false) {
              $pos2 = strripos($value["name"], "-e");
              if ($pos !== false) {
              $text .= ";&nbsp; <b class='catalog_section_default_item__text_b'>Может использоваться как модуль удаленного ввода по RS-485, Ethernet,  Modbus RTU,  Modbus TCP</b>";
              } else {
              $text .= ";&nbsp; <b class='catalog_section_default_item__text_b'>Может использоваться как модуль удаленного ввода по RS-485,  Modbus RTU,  Modbus TCP</b>";
              }
              }
              }
              break;
              default:
              break;
              } */
            ?>
            <div class="catalog_section_default_item <?= $class ?>">
                <a class="catalog_section_default_item__link" href="<?= $value["link"] ?>">
                    <? if ($value["picture_preview"] != ""): ?>
                        <div class="catalog_section_default_item__image" style="background-image: url('<?= $value["picture_preview"] ?>')"></div>
                    <? else: ?>
                        <div class="catalog_section_default_item__image"  style="background-image: url('/images/<?= $value["picture_preview"] ?>')" ></div>
                    <? endif; ?>
                    <div class="catalog_section_default_item__name"><span><?= $value["name"] ?></span></div>
                    <div class="catalog_section_default_item__text"><span><?= $text ?></span></div>
                </a>
                <div class="catalog_section_default_item__btn_cart">
                    <? if ($value["price"] > 0 and $value["in_stock"] > 0): ?>
                        <div class="catalog_section_default_item__price">
                            <span class="table_cell"><span class="span_in_stock">в&nbsp;наличии</span>
                                <span class="prpr"><?= $value["price"] ?></span>
                                <span class="val_name">USD</span>
                            </span>
                        </div>
                        <a  title="Положить в корзину" idm="<?= $value["name"] ?>" class="put_in_cart addToCart" >В корзину</a>
                    <? elseif ($value["price"] < 1 and $value["in_stock"] < 1): ?>
                        <div class="catalog_section_default_item__no_price_no_stock"><span class="table_cell">Цена и наличие по запросу</span></div>
                        <a title="Сделать запрос" class="require" onclick="show_backup_call(7, '<?= $value["name"] ?>')" href="#">Запрос</a>
                    <? elseif ($value["in_stock"] > 0 and $value["price"] < 1): ?>
                        <div class="catalog_section_default_item__no_price_no_stock">
                            <span class="table_cell"><span class="span_in_stock">в&nbsp;наличии</span>цена по&nbsp;запросу</span>
                        </div>
                        <a  class="require" title="Сделать запрос" onclick="show_backup_call(6, '<?= $value["name"] ?>')" href="#">Запрос</a>
                    <? elseif ($value["in_stock"] < 1 and $value["price"] > 0): ?>
                        <div class="catalog_section_default_item__no_price_no_stock">
                            <span class="table_cell"><span class="require_in_stock">под заказ</span>
                                <span class="prpr"><?= $value["price"] ?></span>
                                <span class="val_name">USD</span>
                            </span>
                        </div>
                        <a class="require" title="Сделать запрос" onclick="show_backup_call(8, '<?= $value["name"] ?>')" href="#">Запрос</a>
                    <? endif; ?>
                </div>

            </div>
        <? }
        ?>
    </div>
    <?
}
?>



