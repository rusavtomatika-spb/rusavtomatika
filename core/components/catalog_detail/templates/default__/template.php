<?php

require_once __DIR__ . '/inc_data_preparator.php';

CoreApplication::add_script(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/script.js?". rand());
CoreApplication::add_style(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/style.css?" . rand());
CoreApplication::add_breadcrumbs_chain("Каталог оборудования", "/catalog/");
CoreApplication::add_breadcrumbs_chain($arrSection["name"], "/catalog/" . $arrSection["code"] . "/");
CoreApplication::add_breadcrumbs_chain($H1);


?>
<div id="vue_component_catalog_detail" data-model="<?= $product["model"] ?>">
    <div class="component_catalog_detail">
        <div class="component_wrapper">

            <?
            CoreApplication::include_component(array("component" => "breadcrumbs"));
            ?>
            <div class="component_catalog_detail_section_1">
                <div class="row">
                    <div class="col-md-8">
                        <h1><?= $H1 ?></h1>
                    </div>
                    <div class="col-md-4">
                        <div class="block_shpr__usd_rate">
                            <div id="usdrate" title="Курс ЦБ РФ на сегодня"> 1 USD = <span
                                        id="curusd">74.8569</span><span id="cureur"
                                                                        style="display:none">91.1458</span> РУБ
                            </div>
                            <input id="valuta" style="display:none;" value="USD"></div>
                        <div id="shpr" onclick="recalc_valute()">Отобразить цены в РУБ</div>
                    </div>
                </div>
            </div>
            <div class="component_catalog_detail_section_2">
                <div class="row">
                    <div class="col-md-6">
                        <?
                        echo CoreApplication::print_pictures_in_detail_template($product["brand"], $product["type"], $product["model"], $product["pics_number"]);
                        ?>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="availability_panel">
                                        <span class="availability_value">
                                            <span class="green_square"></span> В НАЛИЧИИ</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="price_panel">
                                    <?
                                    if (intval($product["retail_price"]) > 0 and $product['retail_price_hide'] == "0") {
                                        ?>
                                        <span>ЦЕНА С НДС: </span>
                                        <span class="price_value"><?= $product["retail_price"] ?></span>
                                        <span class="price_currency"><?= $product["currency"] ?></span>
                                        <?
                                    } else {
                                        ?>
                                        <div class="zakazbut" idm="<?= $product["model"] ?>"
                                             onclick="show_backup_call(6, &quot;<?= $product["model"] ?>&quot;)">
                                            Запросить&nbsp;цену
                                        </div>
                                        <?
                                    }

                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <?
                                if ($link_advanced_search):
                                    ?>
                                    <table width=100%>
                                        <? if ($product["discontinued"] != '1') { ?>
                                            <tr>
                                                <? if ($product["retail_price"] > 0 and $product['retail_price_hide'] == "0"): ?>
                                                    <td>
                                                        <div class=but_wr>
                                                            <div class='zakazbut addToCart'
                                                                 idm='<?= $product["model"] ?>'>
                                                                <span>В корзину</span></div>
                                                        </div>
                                                    </td>
                                                <? else: ?>
                                                    <td>
                                                        <div class=but_wr>
                                                            <div class='zakazbut disabled'><span>В корзину</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                <? endif; ?>
                                                <td>
                                                    <div class=but_wr>
                                                        <div class='zakazbut' idm='<?= $product["model"] ?>'
                                                             onclick='show_backup_call(2, "<?= $product["model"] ?>")'>
                                                            <span>Заказ в 1 клик</span></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class=but_wr>
                                                        <div class='zakazbut' idm='<?= $product["model"] ?>'
                                                             onclick='show_backup_call(1, "<?= $product["model"] ?>")'>
                                                            <span>Получить скидку</span></div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <? } ?>
                                        <tr>
                                            <td>
                                                <div class=but_wr>
                                                    <div class='zakazbut' idm='<?= $product["model"] ?>'
                                                         onclick='show_compare(this)'><span>В сравнение</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td colspan=2>
                                                <div class=but_wr>
                                                    <div class='link_advanced_search_wrapper'><?= $link_advanced_search ?></div>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td colspan=4><br>
                                                <div class=hc1></div>
                                            </td>
                                        </tr>
                                    </table>
                                <?
                                else:
                                    ?>
                                    <table width=100%>
                                        <tr>
                                            <td>
                                                <div class=but_wr>
                                                    <div class='zakazbut addToCart' idm='<?= $product["model"] ?>'>
                                                        <span>В корзину</span></div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class=but_wr>
                                                    <div class='zakazbut' idm='<?= $product["model"] ?>'
                                                         onclick='show_backup_call(2, "<?= $product["model"] ?>")'>
                                                        <span>Заказ в 1 клик</span></div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class=but_wr>
                                                    <div class='zakazbut' idm='<?= $product["model"] ?>'
                                                         onclick='show_backup_call(1, "<?= $product["model"] ?>")'>
                                                        <span>Получить скидку</span></div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class=but_wr>
                                                    <div class='zakazbut' idm='<?= $product["model"] ?>'
                                                         onclick='show_compare(this)'><span>В сравнение</span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan=4><br>
                                                <div class=hc1></div>
                                            </td>
                                        </tr>
                                    </table>
                                <?
                                endif; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="advantages_block">
                                    <?= $product["text_features"] ?>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <div class="component_catalog_detail_section_3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="linked_products_block">
                            <? LinkedProducts::printPanel($product["model"], $mysqli_db); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="component_catalog_detail_section_4">
                <div class="row">
                    <div class="col-md-12">
                        <div id="tabs">
                            <ul>
                                <li class="urlup" data="functions"><a href="#tabs-1">ХАРАКТЕРИСТИКИ</a></li>
                                <li class="urlup" data="dimensions"><a href="#tabs-2">ГАБАРИТЫ</a></li>
                                <li class="urlup" data="scheme"><a href="#tabs-3">СХЕМЫ</a></li>
                                <li class="urlup" data="software"><a href="#tabs-4">СКАЧАТЬ</a></li>
                            </ul>

                            <div id="tabs-1">

                                <h2>Технические
                                    характеристики <?= $product_type_genitive_case ?> <?= $product["brand"] ?> <?= $product["model"] ?></h2>
                                <? $product_field_descriptions = get_product_field_descriptions();
                                foreach ($product_field_descriptions as $group) {
                                    ?>
                                    <table class="table_characteristics">
                                        <tr>
                                            <td colspan="2" class="par_name1"><?= $group['name'] ?></td>
                                        </tr>
                                        <?
                                        foreach ($group['items'] as $field) {
                                            if ($product[$field["field_code"]] == '') continue;
                                            ?>
                                            <tr>
                                                <td class="par_name1"><?= $field["field_name"] ?></td>
                                                <td class="par_val1"><?= $product[$field["field_code"]] ?> <?= $field["field_units"] ?></td>
                                            </tr>
                                            <?
                                        }
                                        ?>
                                    </table>
                                    <?
                                }
                                ?>
                            </div>
                            <div id="tabs-2">
                                <h2>
                                    Габариты <?= $product_type_genitive_case ?> <?= $product["brand"] ?> <?= $product["model"] ?></h2>
                                <img src="/images/weintek/dim/<?= $product["model"] ?>.png">
                            </div>
                            <div id="tabs-3">
                                <h2>COM-порты <?= $product["brand"] ?> <?= $product["model"] ?></h2>
                                <? echo get_schemes($product["model"]); ?>
                            </div>
                            <div id="tabs-4">
                                <h2>Файлы для работы с <?= $product["brand"] ?> <?= $product["model"] ?></h2>
                                <?
                                $files_product = $files_product2 = $files_common = array();
                                $arguments["where"] = "product_name='{$product["model"]}'";
                                $arguments["order"] = "position desc";
                                $files_product = get_list_of_files($arguments);

                                $arguments["where"] = "product_name like '%{$product["model"]},%'";
                                $arguments["order"] = "position desc";
                                $files_product2 = get_list_of_files($arguments);

                                $arguments["where"] = "brand='Weintek'";
                                $files_common = get_list_of_files($arguments);
                                $files = array_merge($files_product, $files_product2, $files_common);


                                require_once __DIR__ . "/inc_template_detail_files.php";
                                ?>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div><a href="<?= "/catalog/" . $arrSection["code"] . "/" ?>">< Назад в раздел
                    &laquo;<?= $arrSection["name"] ?>&raquo;</a></div>

        </div>
    </div>
</div>
</div>
</div>
<div class="result" v-html="result"></div>
</div>
