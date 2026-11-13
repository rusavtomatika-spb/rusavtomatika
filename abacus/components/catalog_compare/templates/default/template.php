<?php
global $arSettings;
$arSettings['path_to_product_images'] = '/images/';

function formatMemoryField(&$fieldName, &$fieldValue, $fieldUnits) {
    $memoryFieldNames = ['ram', 'ram_max', 'flash', 'hdd_size_gb'];

    $isMemoryField = false;
    foreach ($memoryFieldNames as $memField) {
        if ($fieldName === $memField) {
            $isMemoryField = true;
            break;
        }
    }

    if (!$isMemoryField || empty($fieldValue) || $fieldValue == '0') {
        return false;
    }

    $mbValue = floatval($fieldValue);
    $valueInGB = $mbValue / 1024;

    if ($valueInGB >= 1) {
        if ($valueInGB == intval($valueInGB)) {
            $displayValue = intval($valueInGB) . ' Гб';
        } else {
            $displayValue = rtrim(rtrim(number_format($valueInGB, 2, '.', ''), '0'), '.') . ' Гб';
        }
    } elseif ($mbValue > 0) {
        $displayValue = round($mbValue) . ' Мб';
    } else {
        return false;
    }

    $fieldValue = $displayValue;

    return true;
}

function is_field_filled($raw) {
    if ($raw === null || $raw === false || $raw === '') {
        return false;
    }
    if (is_numeric($raw) && floatval($raw) == 0) {
        return false;
    }
    $trim = trim((string)$raw);
    if ($trim === '' || preg_match('/^[0\.,]+$/', $trim)) {
        return false;
    }
    return true;
}

CoreApplication::add_script(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/script.js");
CoreApplication::add_style(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/style.css");
CoreApplication::add_style("/abacus/components/catalog_section/templates/default/style.css");

global $arResult;
global $TITLE;
global $H1;
global $DESCRIPTION;
global $arr_model_collection;

$TITLE = "Сравнение товаров";
$H1 = "Сравнение товаров";

CoreApplication::add_breadcrumbs_chain("Сравнение товаров");
$series["products"] = $arResult["ITEMS"];


$num_columns = count($series["products"]);
$arr_types = [
    "hmi" => "Панель оператора",
    "panel_pc" => "Панельный компьютер",
    "open_hmi" => "Open HMI",
    "machine-tv-interface" => "Интерфейс Machine-TV",
    "cloud_hmi" => "Интерфейс",
    "box-pc" => "Встраиваемый компьютер",
    "web-panel" => "Web-панель",
    "panel-terminal" => "Панель терминал",
    "monitor" => "Монитор",
    "module" => "Модуль ввода-вывода",
    "coupler" => "Коммуникационный модуль",
    "controllers" => "Программируемый логический контроллер",
    "servo-drivers" => "Сервопривод",
    "monitors" => "Промышленный монитор",
    "Gateway" => "Шлюз данных",
    "panel_pc_wce" => "Панельный компьютер Windows CE",
    "panel_pc_ip65" => "Панельный компьютер IP65",
    "ps" => "Блок питания",
    "frame" => "Рамка",
    "accessories" => "Аксессуар",
    "antenna" => "Антенна",
    "vpn-router" => "VPN-роутер",
    "serial-server" => "Serial-сервер",
    "ethernet-switch" => "Ethernet-коммутатор",
    "bloki-pitaniya" => "Блок питания",
    "" => "",
];

$arr_fields = [

    ["name" => "image", "rus_name" => "", "type" => ""],
    ["name" => "model", "rus_name" => "Модель", "type" => "title"],
    ["name" => "brand", "rus_name" => "Бренд", "type" => "text"],
    ["name" => "retail_price", "rus_name" => "Цена", "type" => ""],
    ["name" => "onstock_spb", "rus_name" => "Наличие", "type" => ""],
    ["name" => "series", "rus_name" => "Серия", "type" => ""],
    ["name" => "type", "rus_name" => "Тип", "type" => ""],

    ["name" => "separator", "rus_name" => "Дисплей", "type" => "separator"],
    ["name" => "diagonal", "rus_name" => "Диагональ", "type" => "text", "units" => "&Prime;"],
    ["name" => "resolution", "rus_name" => "Разрешение", "type" => "text"],
    ["name" => "colors", "rus_name" => "Цветность", "type" => "text"],
    ["name" => "brightness", "rus_name" => "Яркость", "type" => "text"],
    ["name" => "contrast", "rus_name" => "Контраст", "type" => "text"],
    ["name" => "view_angle", "rus_name" => "Угол обзора", "type" => "text"],
    ["name" => "backlight", "rus_name" => "Подсветка", "type" => "text"],
    ["name" => "backlight_life", "rus_name" => "Время жизни подсветки", "type" => "text", "units" => "час."],
    ["name" => "touch", "rus_name" => "Тип сенсора", "type" => "text"],

    ["name" => "separator", "rus_name" => "Параметры", "type" => "separator"],

    ["name" => "module_ai", "rus_name" => "Аналоговые входы", "type" => "text"],
    ["name" => "module_ao", "rus_name" => "Аналоговые выходы", "type" => "text"],
    ["name" => "module_di", "rus_name" => "Цифровые входы", "type" => "text"],
    ["name" => "module_do", "rus_name" => "Цифровые выходы", "type" => "text"],
    ["name" => "response_time", "rus_name" => "Время преобразования", "type" => "text"],
    ["name" => "conversion_time", "rus_name" => "Время переключения", "type" => "text"],

    ["name" => "cpu_type", "rus_name" => "Процессор", "type" => "text"],
    ["name" => "cpu_speed", "rus_name" => "Частота", "type" => "text", "units" => "МГц"],
    ["name" => "chipset", "rus_name" => "Чипсет", "type" => "text"],
    ["name" => "graphics", "rus_name" => "Графика", "type" => "text"],
    ["name" => "audio", "rus_name" => "Аудио", "type" => "text"],
    ["name" => "ram", "rus_name" => "ОЗУ", "type" => "text"],
    ["name" => "ram_type", "rus_name" => "Тип ОЗУ", "type" => "text"],
    ["name" => "ram_slots", "rus_name" => "Кол-во слотов ОЗУ", "type" => "text"],
    ["name" => "ram_max", "rus_name" => "Макс. объем ОЗУ", "type" => "text"],
    ["name" => "flash", "rus_name" => "Flash", "type" => "text", "units" => "Гб"],
    ["name" => "hdd_size_gb", "rus_name" => "Накопитель", "type" => "text"],
    ["name" => "hdd_type", "rus_name" => "Тип накопителя", "type" => "text"],
    ["name" => "rtc", "rus_name" => "Часы реального времени", "type" => "text"],
    ["name" => "power", "rus_name" => "Мощность", "type" => "text", "units" => "Вт"],
    ["name" => "current", "rus_name" => "Потребляемый ток", "type" => "text", "units" => "А"],
    ["name" => "voltage", "rus_name" => "Напряжение", "type" => "text"],
    ["name" => "battery", "rus_name" => "Аккумулятор", "type" => "text"],

    ["name" => "separator", "rus_name" => "Интерфейсы", "type" => "separator"],

    ["name" => "serial_full", "rus_name" => "СОМ порты", "type" => "text"],
    ["name" => "lpt", "rus_name" => "Параллельный порт", "type" => "text"],
    ["name" => "ps2_klava", "rus_name" => "PS/2 клавиатура", "type" => "text"],
    ["name" => "ps2_mouse", "rus_name" => "PS/2 мышь", "type" => "text"],
    ["name" => "usb_host", "rus_name" => "USB host", "type" => "text"],
    ["name" => "usb_client", "rus_name" => "USB client", "type" => "text"],
    ["name" => "ethernet", "rus_name" => "Ethernet", "type" => "text"],
    ["name" => "can_bus", "rus_name" => "CAN", "type" => "text"],
    ["name" => "sdcard", "rus_name" => "SD карта", "type" => "text"],
    ["name" => "speakers", "rus_name" => "Встроенные динамики", "type" => "text"],
    ["name" => "linear_out", "rus_name" => "Линейный аудиовыход", "type" => "text"],
    ["name" => "mic_in", "rus_name" => "Микрофонный вход", "type" => "text"],
    ["name" => "video_input", "rus_name" => "Видео вход", "type" => "text"],
    ["name" => "pci_slot", "rus_name" => "PCI", "type" => "text"],
    ["name" => "vga_port", "rus_name" => "Порт VGA", "type" => "text"],
    ["name" => "dvi_port", "rus_name" => "Порт DVI", "type" => "text"],
    ["name" => "displayport", "rus_name" => "Порт DisplayPort", "type" => "text"],
    ["name" => "hdmi", "rus_name" => "Порт HDMI", "type" => "text"],
    ["name" => "dio", "rus_name" => "Дискретные входы / выходы", "type" => "text"],
    ["name" => "sim", "rus_name" => "Слот для SIM-карты", "type" => "text"],

    ["name" => "separator", "rus_name" => "Конструкция", "type" => "separator"],

    ["name" => "case_material", "rus_name" => "Материал корпуса", "type" => "text"],
    ["name" => "cpu_fan", "rus_name" => "Тип охлаждения", "type" => "text"],
    ["name" => "mount", "rus_name" => "Варианты установки", "type" => "text"],
    ["name" => "power_switch", "rus_name" => "Выключатель питания", "type" => "text"],
    ["name" => "power_adapter", "rus_name" => "Внешний блок питания", "type" => "text"],
    ["name" => "set", "rus_name" => "Комплект поставки", "type" => "text"],
    ["name" => "dimentions", "rus_name" => "Размеры, мм", "type" => "text"],
    ["name" => "cutout", "rus_name" => "Вырез под посадку, мм", "type" => "text"],
    ["name" => "netto", "rus_name" => "Вес, кг", "type" => "text"],
    ["name" => "temp_operating", "rus_name" => "Рабочая темп-ра, &degC\"", "type" => "text"],
];

$field_filled_count = [];
foreach ($arr_fields as $field) {
    if ($field["type"] === "separator") continue;
    if ($field["name"] === 'image') {
        $field_filled_count[$field["name"]] = 1;
        continue;
    }
    $cnt = 0;
    if (is_array($series["products"])) {
        foreach ($series["products"] as $product) {
            $raw = isset($product[$field["name"]]) ? $product[$field["name"]] : '';
            if (is_field_filled($raw)) $cnt++;
        }
    }
    $field_filled_count[$field["name"]] = $cnt;
}

$separator_has_visible_field = [];
$current_separator_idx = null;
foreach ($arr_fields as $idx => $field) {
    if ($field["type"] === "separator") {
        $current_separator_idx = $idx;
        $separator_has_visible_field[$idx] = false;
        continue;
    }
    if ($current_separator_idx !== null && !empty($field_filled_count[$field["name"]])) {
        $separator_has_visible_field[$current_separator_idx] = true;
    }
}

$extra_h1 = ' ';
if (is_array($series["products"])) {
    $models = [];
    foreach ($series["products"] as $product) {
        if (isset($product["model"]) && $product["model"] !== '') {
            $models[] = $product["model"];
        }
    }
    if (!empty($models)) {
        $extra_h1 = ' ' . implode(', ', $models);
    }
}

$html_result = '';
if ($num_columns > 0) {
    ob_start();
    ?>
    <div id="vue_app_component_compare">
        <div class="table-container_">

            <? if ($num_columns > 5) { ?>
                <div class="wrapper1">
                    <div class="div1"></div>
                </div>
                <?
            } ?>
            <div class="wrapper2">
                <div class="div2">

                    <table v-cloak class="table is-hoverable table_compare is-fullwidth num_columns_<?= $num_columns ?>"
                           v-bind:class="'view_mode_'+view_mode">
                        <?php
                        foreach ($arr_fields as $field_idx => $field) {

                            if ($field["type"] === "separator") {
                                if (empty($separator_has_visible_field[$field_idx])) {
                                    continue;
                                }
                                ?>
                                <tr class="num_values_0 field_name_separator">
                                    <td class="noborder" style="text-align: left;padding-top: 1rem"
                                        colspan="<?= $num_columns + 1 ?>">
                                        <?
                                        if (isset($field["rus_name"]) and $field["rus_name"] != "") {
                                            echo "<h3>" . $field["rus_name"] . "</h3>";
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?
                                continue;
                            }

                            if (empty($field_filled_count[$field["name"]])) {
                                continue;
                            }

                            if ($field["name"] === 'image') {
                                $different = 'service';
                                $num_values = 0;
                            } else {
                                $values = [];
                                $hasEmpty = false;
                                $num_values = 0;

                                if (is_array($series["products"])) {
                                    foreach ($series["products"] as $product) {
                                        $raw = isset($product[$field["name"]]) ? $product[$field["name"]] : '';
                                        if (is_field_filled($raw)) {
                                            $values[] = (string)$raw;
                                            $num_values++;
                                        } else {
                                            $hasEmpty = true;
                                        }
                                    }
                                }

                                if ($hasEmpty) {
                                    $different = 'different';
                                } else {
                                    $unique = array_unique($values);
                                    $different = (count($unique) === 1) ? 'same' : 'different';
                                }
                            }
                            ?>
                            <tr class="num_values_<?= $num_values ?> field_name_<?= $field["name"] ?> <?= $different ?>">
                                <?
                                $counter = 0;
                                if (is_array($series["products"])) {
                                    foreach ($series["products"] as $product) {
                                        if (isset($product["link_detail2"]) and $product["link_detail2"] != "") {
                                            $product["link_detail_page"] = $product["link_detail2"];
                                        } else {
                                            $product["link_detail_page"] = "/" . strtolower($product["brand"]) . "/" . $product["model"] . "/";
                                        }

                                        switch ($field["name"]) {
                                            case "image":
                                                if ($counter == 0) {
                                                    ?>
                                                    <td class="noborder first_column">
                                                        <div class="table_compare__choice_features_block">
                                                            <div class="table_compare__choice_features_block__title">
                                                                Показать
                                                            </div>
                                                            <ul>
                                                                <li>
                                                                    <input id="choice_features_0" type="radio" checked
                                                                           name="choice_features" v-model="view_mode" value="0">
                                                                    <label for="choice_features_0"> Все характеристики</label>
                                                                </li>
                                                                <li>
                                                                    <input id="choice_features_1" type="radio"
                                                                           name="choice_features" v-model="view_mode" value="1">
                                                                    <label for="choice_features_1">Только различия</label>
                                                                </li>
                                                                <li>
                                                                    <input id="choice_features_2" type="radio"
                                                                           name="choice_features" v-model="view_mode" value="2">
                                                                    <label for="choice_features_2">Только совпадения</label>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                    <?
                                                }
                                                ?>
                                                <td class="noborder">
                                                    <div class="table_compare_tools_wrapper">
                                                        <a href="<?= $product["link_detail_page"]; ?>">
                                                            <div class="preview_image">
                                                                <?
                                                                $brandLower = isset($product["brand"]) ? mb_strtolower($product["brand"]) : '';
                                                                $typeLower = isset($product["type"]) ? mb_strtolower($product["type"]) : '';
                                                                $model = isset($product["model"]) ? $product["model"] : '';
                                                                $img_190 = "/images/" . $brandLower . "/" . $typeLower . "/" . $model . "/190/" . $model . "_1.webp";
                                                                $img_580 = "/images/" . $brandLower . "/" . $typeLower . "/" . $model . "/580/" . $model . "_1.webp";
                                                                $img_src = file_exists($_SERVER['DOCUMENT_ROOT'] . $img_190) ? $img_190 : $img_580;
                                                                ?>
                                                                <img alt="<?= $model; ?>" loading="lazy" src="<?= $img_src ?>">
                                                            </div>
                                                        </a>
                                                        <div class="table_compare_tools">
                                                            <span class="table_compare__button favorites"
                                                                  @click="add_too_box" data-box="favorites"
                                                                  data-model="<?= $model ?>"><i class="fa-regular fa-heart"></i> В ИЗБРАННОЕ</span>
                                                            <button title="Добавить в заказ"
                                                                    class="table_compare__button table_compare__button_cart"
                                                                    @click="add_too_box"
                                                                    data-model="<?= $model ?>"
                                                                    data-box="cart"><i class="fa-solid fa-cart-shopping"></i> В ЗАКАЗ
                                                            </button>
                                                            <span class="delete_item active" @click="add_too_box"
                                                                  data-box="compare"
                                                                  data-model="<?= $model ?>"></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <?
                                                break;

                                            case "type":
                                                if ($counter == 0) {
                                                    ?>
                                                    <td class="first_column">
                                                        <?
                                                        if (isset($field["rus_name"]) and $field["rus_name"] != "")
                                                            echo $field["rus_name"];
                                                        ?>
                                                    </td>
                                                    <?
                                                } ?>
                                                <td>
                                                    <?
                                                    $typeVal = isset($product["type"]) ? $product["type"] : '';
                                                    if (isset($arr_types[$typeVal]) and $arr_types[$typeVal] != "") {
                                                        echo $arr_types[$typeVal];
                                                    } else {
                                                        echo '&mdash;';
                                                    }
                                                    ?>
                                                </td>
                                                <?
                                                break;

                                            case "onstock_spb":
                                                if ($counter == 0) {
                                                    ?>
                                                    <td class="first_column">
                                                        <?
                                                        if (isset($field["rus_name"]) and $field["rus_name"] != "")
                                                            echo $field["rus_name"];
                                                        ?>
                                                    </td>
                                                    <?
                                                } ?>
                                                <td>
                                                    <?
                                                    if (isset($product["onstock_spb"]) && $product["onstock_spb"] > 0) {
                                                        echo "в наличии";
                                                    } elseif (isset($product['discontinued']) && $product['discontinued'] == '1') {
                                                        echo '<span class="has-text-danger">снято&nbsp;с&nbsp;производства</span>';
                                                    } else {
                                                        echo "под заказ";
                                                    }
                                                    ?>
                                                </td>
                                                <?
                                                break;

                                            case "retail_price":
                                                if ($counter == 0) {
                                                    ?>
                                                    <td class="first_column">
                                                        <?
                                                        if (isset($field["rus_name"]) and $field["rus_name"] != "")
                                                            echo $field["rus_name"];
                                                        ?>
                                                    </td>
                                                    <?
                                                } ?>
                                                <td>
                                                    <?
                                                    $priceVal = isset($product["retail_price"]) ? $product["retail_price"] : '';
                                                    $priceHide = isset($product["retail_price_hide"]) ? $product["retail_price_hide"] : '';
                                                    if ($priceVal > 0 and $priceHide != '1') {
                                                        if ($field["type"] == 'title') {
                                                            echo "<h3>" . $priceVal . "</h3>";
                                                        } else {
                                                            echo $priceVal;
                                                        }
                                                        $cur = isset($product["currency"]) ? $product["currency"] : '';
                                                        if ($cur == 'USD') echo " $";
                                                        if ($cur == 'RUB') echo ' руб.';
                                                    } else {
                                                        echo "по запросу";
                                                    }
                                                    ?>
                                                </td>
                                                <?
                                                break;

                                            default:
                                                if ($counter == 0) {
                                                    ?>
                                                    <td class="first_column">
                                                        <?
                                                        if (isset($field["rus_name"]) and $field["rus_name"] != "")
                                                            echo $field["rus_name"];
                                                        ?>
                                                    </td>
                                                    <?
                                                } ?>
                                                <td>
                                                    <?
                                                    $raw = isset($product[$field["name"]]) ? $product[$field["name"]] : '';
                                                    if ($field["type"] == 'title') {
                                                        echo "<h4>" . (is_field_filled($raw) ? $raw : '&mdash;') . "</h4>";
                                                    } else {
                                                        if (is_field_filled($raw)) {
                                                            $fieldValue = $raw;
                                                            $fieldName = $field["name"];
                                                            $fieldUnits = isset($field["units"]) ? $field["units"] : '';

                                                            $memoryConverted = formatMemoryField($fieldName, $fieldValue, $fieldUnits);

                                                            if ($memoryConverted) {
                                                                echo $fieldValue;
                                                            } else {
                                                                echo $raw;
                                                                if (isset($field["units"]) and $field["units"] != '') {
                                                                    if ($field["name"] == 'current' and isset($product['type']) and $product['type'] == 'module') {
                                                                    } else {
                                                                        echo " " . $field["units"];
                                                                    }
                                                                }
                                                            }
                                                        } else {
                                                            echo '&mdash;';
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <?
                                                break;
                                        }
                                        $counter++;
                                    }
                                }
                                ?>
                            </tr>
                            <?
                        }
                        ?>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <?php
    $html_result = ob_get_clean();
} else {
    $html_result = 'Товары для сравнения не выбраны';
}
?>
<div class="catalog_compare">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?
                CoreApplication::include_component(array("component" => "breadcrumbs"));
                ?>
                <h1><?= $H1 . $extra_h1 ?></h1>

                <?
                echo $html_result;
                ?>
            </div>
        </div>
    </div>
</div>

<div class="catalog_compare">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="catalog_compare__button_clearall_wrapper">
                    <div class="catalog_compare__button_clearall">Очистить список товаров</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="link_to_this_page">
    <b>Ссылка на текущую страницу:</b> <input class="copy_link_input js-copytextarea input" type="text"
                                              value="<?= $url = "https://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"; ?>">
    <div id="message_copy_link" class="has-text-weight-bold py-2"></div>
    <button class="button is-success is-small js-textareacopybtn">Копировать ссылку</button>
</div>
<div id="vue_data" data-models="<?= implode(',', $arr_model_collection) ?>"></div>

<script>
    $(document).ready(function () {
        $('.catalog_compare__button_clearall').on('click', function () {
            $(this).css('display', 'none');
            setCookie('box2_compare', "", {'max-age': -1});
            $('.catalog_toolbar__item.compare .number').html('');
            localStorage.setItem('compare', Date.now());
            location.href = '/catalog/compare/';
            $('.component_catalog_section__panel_of_products .view-mode-list').html('<hr>Нет товаров...<hr>');
        });

        function setCookie(name, value, options = {}) {
            let date = new Date;
            date.setDate(date.getDate() + 365);
            date = date.toUTCString();
            options = {
                path: '/',
                'expires': date,
                domain: '.' + window.location.host,
            };
            if (options.expires instanceof Date) {
                options.expires = options.expires.toUTCString();
            }
            let updatedCookie = encodeURIComponent(name) + "=" + encodeURIComponent(value);
            for (let optionKey in options) {
                updatedCookie += "; " + optionKey;
                let optionValue = options[optionKey];
                if (optionValue !== true) {
                    updatedCookie += "=" + optionValue;
                }
            }


            updatedCookie += ';SameSite=Strict;Secure';
            document.cookie = updatedCookie;
            console.log(updatedCookie);
        }

    });

    $(function () {
        $('.wrapper1').on('scroll', function (e) {
            $('.wrapper2').scrollLeft($('.wrapper1').scrollLeft());
        });
        $('.wrapper2').on('scroll', function (e) {
            $('.wrapper1').scrollLeft($('.wrapper2').scrollLeft());
        });
    });
    $(window).on('load', function (e) {
        $('.div1').width($('table').width());
        $('.div2').width($('table').width());
    });


    $(window).on('load', function (e) {

        function handle_mousedown(e) {

            $('.div2').addClass('active');

            window.my_dragging = {};
            my_dragging.pageX0 = e.pageX;
            my_dragging.pageY0 = e.pageY;
            my_dragging.elem = this;
            my_dragging.offset0 = $(this).offset();


            function handle_dragging(e) {
                var left = my_dragging.offset0.left + (e.pageX - my_dragging.pageX0);
                var top = my_dragging.offset0.top + (e.pageY - my_dragging.pageY0);


                var moving = (my_dragging.pageX0 - e.pageX) / 20 + $('.wrapper2').scrollLeft();


                $('.wrapper2').scrollLeft(moving);
            }

            function handle_mouseup(e) {
                $('body').off('mousemove', handle_dragging).off('mouseup', handle_mouseup);
                $('.div2').removeClass('active');
            }

            $('body').on('mouseup', handle_mouseup).on('mousemove', handle_dragging);
        }

        $('.div2').mousedown(handle_mousedown);


    });


    var copyTextareaBtn = document.querySelector('.js-textareacopybtn');

    copyTextareaBtn.addEventListener('click', function (event) {
        var copyTextarea = document.querySelector('.js-copytextarea');
        copyTextarea.focus();
        copyTextarea.select();

        try {
            var successful = document.execCommand('copy');
            var msg = successful ? 'successful' : 'unsuccessful';
            console.log('Copying text command was ' + msg);
            $('#message_copy_link').html('Ссылка скопирована в буффер');
        } catch (err) {
            $('#message_copy_link').html('Ваш браузер не поддерживает копирование. Используйте комбинацию клавиш "Ctrl+C"');
        }
    });
</script>