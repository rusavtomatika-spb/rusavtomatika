<?php

if (!function_exists('get_all_series')) {
    $f = $_SERVER['DOCUMENT_ROOT'] . '/abacus/components/catalog_section/templates/default/functions/inc_functions.php';
    
    if (file_exists($f)) {
        $existingFunctions = array(
            'getCountryFromDaData' => function_exists('getCountryFromDaData'),
        );
        
        $content = file_get_contents($f);
        
        $content = preg_replace('/function\s+getCountryFromDaData\s*\([^)]*\)\s*\{.*?\n\}/s', '', $content);
        
        eval('?>' . $content);
    }
}

global $product;
global $usd_currency, $rur_currency, $arSettings;

if (isset($product["diagonal"]) && $product["diagonal"] != "" && $product["diagonal"] != 0 && $product["diagonal_hide"] == 0) {
    $product["diagonal"] = str_replace(".0", "", $product["diagonal"]);
    $diagonal = '<b>' . $product["diagonal"] . '&Prime;&nbsp;</b>';
} else {
    $diagonal = '';
}

if (!(isset($product["link_detail2"]) && $product["link_detail2"] != "")) {
    $link = "/" . strtolower($product["brand"]) . "/" . $product["model"] . "/";
} else {
    $link = $product["link_detail2"];
}

if ($product["brand"] == "Faraday") {
    $model = str_replace("/", "_", $product["model"]);
    $model = str_replace(" ", "_", $model);
    $image_src = $arSettings['path_to_product_images'] . mb_strtolower($product["brand"]) . "/" .
        mb_strtolower($product["type"]) . "/" . $model . "/580/" . $model . "_1.webp";
} else {
    $image_src = $arSettings['path_to_product_images'] . mb_strtolower($product["brand"]) . "/" .
        mb_strtolower($product["type"]) . "/" . $product["model"] . "/580/" . $product["model"] . "_1.webp";
}

if ($_SERVER["HTTP_HOST"] == "www.rusavtomatika.com") {
    $image_src = "/upload_files" . $image_src;
}

if ($product["brand"] == 'IFC' && 0) {
    $brand = '';
} else {
    $brand = $product["brand"];
}

if (isset($product["h1"]) && $product["h1"] != "") {
    $s_h1 = $product["h1"];
} elseif (isset($product["model_fullname"]) && $product["model_fullname"] != "") {
    $s_h1 = $product["model_fullname"];
} else {
    $s_h1 = $product["model"] . " - " . str_replace(".0", "", $product["diagonal"]) . "&Prime; " . $product["short_name"] . " " . $product["brand"];
}

$tech = array();
if ($product["brand"] == 'Weintek') {
    if ($product["mqtt"] == 1) $tech[] = "MQTT";
    if ($product["easy_access"] == 'optional') $tech[] = "EasyAccess2 опция";
    if ($product["easy_access"] == 'build_in') $tech[] = "EasyAccess2 с лиц.";
    if ($product["opc_ua"] == 1) $tech[] = "OPC UA клиент";
    if ($product["opc_ua"] == 2) $tech[] = "OPC UA клиент/сервер";
    if ($product["opc_ua"] == 3) $tech[] = "OPC UA клиент/сервер-опция";
    if ($product["codesys"] == 'build_in') $tech[] = "Codesys c лиц.";
    if ($product["codesys"] == 'optional') $tech[] = "Codesys опция";
    if ($product["dashboard"] == 1) $tech[] = "Dashboard";
    if ($product["matrix"] != '') $tech[] = $product["matrix"];
}
if ($product["wifi_support"] == 1) $tech[] = "Wi-Fi";
if ($product["wifi_support"] == 2) $tech[] = "Wi-Fi опция";

$tech_out = '';
if (count($tech) > 0) {
    $tech_out = ' (' . implode(', ', $tech) . ')';
}
if ($tech_out != '') {
    $s_h1 .= $tech_out;
}

$prod_series = explode(',', $product['series']);
$all_series = get_all_series();
?>
<div class="tr_product_<?php echo $product["model"]; ?> tile <?php echo "freqs_" . $product['freqs']; ?> <?php echo "series_" . $product['series']; ?> <?php echo "type_" . $product['type']; ?> <?php echo $userCountry; ?> cell" data-type="<?php echo $product['type']; ?>" data-series="<?php echo $product['series']; ?>">
    
    <div class="preview">
        <div class="preview_image">
            <?php
            if (in_array($brand, array("Weintek", "IFC", "Aplex", "Spiktek", "Samkoon", "eWON", "Faraday"))) {
                ?>
                <a class="brand_plate" href="/<?php echo strtolower($brand); ?>/"><?php echo $brand; ?></a>
                <?php
            } else {
                ?>
                <span class="brand_plate"><?php echo $brand; ?></span>
                <?php
            }
            echo renderNewLabel($product["date_pub"], 12);
            ?>
            <a target="_blank" href="<?php echo $link; ?>">
                <img alt="<?php echo $product["short_name"]; ?> <?php if ($product["brand"] != 'IFC') { echo $product["brand"]; } ?> <?php echo $product["model"]; ?>" loading="lazy" src="<?php echo $image_src; ?>">
            </a>
        </div>
    </div>
    
    <div class="td_short_description">
        <a target="_blank" href="<?php echo $link; ?>">
            <span class="model"><?php echo $product["model"]; ?></span>
        </a>
        
        <div class="preview_text_block">
            <a target="_blank" href="<?php echo $link; ?>">
                <span class="model_fullname"><?php echo $s_h1; ?></span>
            </a>
            
            <p>
                <?php
                if (count($prod_series) > 0) {
                    echo '<span>Серия: ';
                    $prev_ser = '';
                    foreach ($prod_series as $ind => $serie) {
                        foreach ($all_series as $i => $all_serie) {
                            $pattern = '/[^_,\w]*' . $product["type"] . '[^_,\w]*/im';
                            if ($all_serie['name'] != 'INDUSTRIAL' && $all_serie['name'] != $prev_ser && $all_serie['name'] == $serie && preg_match($pattern, $all_serie["type"])) {
                                echo '<a class="tag mr-1" href="/catalog/' . $all_serie['menu_category_item_code'] . '/?&series=' . $all_serie['name'] . '">' . $all_serie['name'] . '</a>';
                            }
                            $prev_ser = $all_serie['name'];
                        }
                    }
                    echo '</span>';
                }
                ?>
            </p>
        </div>
        
        <div class="series_products__panel_buttons">
            <span class="brand"><?php echo $brand; ?></span>
        </div>
    </div>
    
    <div class="td_buttons">
        <div class="series_products__panel_buttons">
            <div class="price_block" style="align-items: center;">
                <div class="price_block_wrapper">
                    <div class="price_block">
                        <div class="noflex">
                            <?php
                            if ($product["discontinued"] == 0) {
                                if (isset($product['retail_price']) && intval($product['retail_price']) > 0 && $product["retail_price_hide"] == 0 && $product['model'] != 'IFC-M-Series') {
                                    switch ($product['currency']) {
                                        case 'USD':
                                            if ($product['action_price'] > 0) {
                                                echo '<span class="act_price"><span class="value">' . $product['action_price'] . '</span>';
                                                echo '&nbsp;<span class="usd">$</span></span>';
                                            }
                                            echo '<div class="price_block m-0">';
                                            if (intval($product['show_rub_po_kursu_usd']) != 1) {
                                                echo '<div class="usd_price"><span class="value">' . $product['retail_price'] . '</span>';
                                                echo '&nbsp;<span class="usd">$</span>';
                                            } else {
                                                echo '<div class="usd_price"><span class="value">' . (int)round($product['retail_price'] * $usd_currency) . '</span>';
                                                echo '&nbsp;<span class="usd">&#8381;</span>';
                                            }
                                            echo '</div>';
                                            if ($usd_currency) {
                                                if (intval($product['show_rub_po_kursu_usd']) != 1) {
                                                    ?>
                                                    <div class="rub_price"><?php echo intval($product['retail_price'] * $usd_currency); ?> &#8381; </div></div>
                                                    <?php
                                                }
                                            }
                                            break;
                                        case 'RUR':
                                            if ($usd_currency) {
                                                if ($product['action_price'] > 0) {
                                                    echo '<span class="act_price"><span class="value">' . $product['action_price'] . '</span>';
                                                    echo '&nbsp;<span class="usd">&#8381;</span></span>';
                                                }
                                            } else {
                                                echo $product['retail_price'] . ' <span class="rub">&#8381;</span>';
                                            }
                                            ?>
                                            <span><span class="value"><?php echo intval($product['retail_price']); ?>&nbsp;&#8381;</span></span>
                                            <?php
                                            break;
                                    }
                                } else {
                                    echo '<span class="no_price series_products__button" data-rel-model="' . $product['model'] . '" @click="open_form_require_price"><i class="fa-solid fa-comment-dollar"></i>&nbsp;Запросить цену</span>';
                                    if (isset($_COOKIE["dev_mode"]) && $_COOKIE["dev_mode"] > 0) {
                                        echo '<span class="show_in_dev_mode">' . $product['retail_price'] . '</span>';
                                    }
                                }
                            } else {
                                echo '<span class="no_price series_products__button red">Снят&nbsp;с&nbsp;производства</span>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="indicator_availability">
                    <?php
                    if ($product['discontinued'] == 0) {
                        if (intval($product['onstock_spb']) > 0) {
                            echo '<span style="color:#00ad61; margin-right: 10px;"><i class="fa-solid fa-check"></i>&nbsp;В&nbsp;наличии</span>';
                            if ($_SERVER['SERVER_NAME'] == 'www.rusavto.moisait.net' || $_SERVER['SERVER_NAME'] == 'www.test.rusavtomatika.com') {
                                echo($product['onstock_spb']);
                            }
                        } else {
                            echo '<span class="red" style="margin-right: 10px;"><i class="fa-solid fa-clipboard-check"></i>&nbsp;Под&nbsp;заказ</span>';
                            if ($_SERVER['SERVER_NAME'] == 'www.rusavto.moisait.net' || $_SERVER['SERVER_NAME'] == 'www.test.rusavtomatika.com') {
                                echo($product['onstock_spb']);
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="buttons_panel">
            <div class="buttons_add">
                <div title="Добавить в сравнение" class="series_products__button compare butt fa-solid fa-align-right fa-rotate-90" @click="add_too_box" data-model="<?php echo $product["model"]; ?>" data-box="compare"></div>
                <div title="Добавить в избранное" class="series_products__button favorites butt fa-regular fa-heart" @click="add_too_box" data-model="<?php echo $product["model"]; ?>" data-box="favorites"></div>
            </div>
            <?php
            if ($product['discontinued'] == 0) {
            ?>
            <button title="Добавить в заказ" class="series_products__button cart" @click="add_too_box" data-model="<?php echo $product["model"]; ?>" data-box="cart">
                <i class="fa-solid fa-cart-plus" style="font-size: 20px"></i>
                <span style="position: relative;top: -1px; font-size: 18px;">&nbsp;&nbsp;&nbsp;В&nbsp;ЗАКАЗ</span>
            </button>
            <?php
            }
            ?>
        </div>
    </div>
</div>