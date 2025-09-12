<?php
CoreApplication::add_script(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/script.js");
CoreApplication::add_style(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/style.css");
global $arrSection;
$sections = CoreApplication::get_rows_from_table("`catalog_sections`");
$arrSection = CoreApplication::get_rows_from_table("catalog_sections", "", "`is_main_item`='1' and `code`='" . $arguments["component_route_params"]["section"] . "'")[0];

global $TITLE;
global $H1;
global $DESCRIPTION;
$TITLE = $arrSection["title"];
if ($arrSection["h1"] != "") {
    $H1 = $arrSection["h1"];
} else $H1 = $arrSection["name"];
if ($arrSection["description"] != "") {
    $DESCRIPTION = $arrSection["description"];
}
//CoreApplication::add_breadcrumbs_chain("Каталог оборудования", "/catalog/");
if(isset($arrSection["name_breadcrumbs"]) and $arrSection["name_breadcrumbs"] != ''){
    $breadcrumbs_name = $arrSection["name_breadcrumbs"];
}else $breadcrumbs_name = $arrSection["name"];

CoreApplication::add_breadcrumbs_chain($breadcrumbs_name);

//var_dump_pre($arrSection["product_sort"]);

$arr_product_sort = [];


if ($arrSection["product_sort"] != "") {
    $arr_product_sort = explode(",", $arrSection["product_sort"]);
}

//var_dump_pre($arr_product_sort);


?>
<?
CoreApplication::include_component(array("component" => "breadcrumbs"));
?>

<div id="vue_component_catalog_section" xmlns:v-bind="http://www.w3.org/1999/xhtml">
    <div class="component_catalog_section">
        <div class="component_wrapper">


            <? /*?><div class="row">
                <div class="col-md-12">
                    <div class="component_catalog_section__tags">
                        <h3>Тэги</h3>
                    </div>
                </div>
            </div><?*/ ?>
            <div class="columns is-gapless">
                <div class="is-hidden-touch column is-2-desktop column_filter">
                    <?
                    $arguments["template"] = "default";
                    $arguments["component"] = "catalog_filter";
                    $arguments["section"] = $arrSection;
                    //$arguments["filter_items"] = $arrSection["filters"];
                    CoreApplication::include_component($arguments);
                    ?>
                </div>
                <div class=" column is-10-desktop is-12-tablet">

                    <h1 class="title"><?= $H1 ?></h1>

                    <div class="panel_chosen_filters"
                         v-if="filterSelectedBrands.length > 0
                         || filterSelectedSeries != ''
                         || filterSelectedInterfaces.length > 0
                         || filterSelectedCodesys
                         || filterSelectedOss.length > 0
                         || filterSelectedResolutions.length > 0
                         || filterSelectedProcessors.length > 0
                         || filterSelectedAvailablity > 0
                         || filterSelectedRangePrice_min > 0
                         || filterSelectedRangePrice_max < filterSelectedRangePrice_max_start
                         || filterSelectedRangeDiagonal_min > filterSelectedRangeDiagonal_min_start
                         || filterSelectedRangeDiagonal_max < filterSelectedRangeDiagonal_max_start"
                         || filterSelectedRangeEthernets_min > filterSelectedRangeEthernets_min_start
                         || filterSelectedRangeEthernets_max < filterSelectedRangeEthernets_max_start"
                        v-cloak>
                        <span class="item"><span class="clear_all">очистить фильтры <span
                                        @click="clear_filter_item('all','')" class="button_clear_filter"> </span></span></span>

                        <span class="item" v-if="filterSelectedSeries != ''"><span>серия: <b>{{filterSelectedSeries}}</b> <span
                                        @click="clear_filter_item('filterSelectedSeries','')"
                                        class="button_clear_filter"> </span></span></span>

                        <span class="item" v-if="filterSelectedBrands.length > 0"><span
                                    v-for="brand in filterSelectedBrands">бренд: <b>{{ brand }}</b> <span
                                        @click="clear_filter_item('filterSelectedBrands',brand)"
                                        class="button_clear_filter"> </span></span></span>

                        <span class="item" v-if="filterSelectedCodesys"><span>Codesys <span @click="clear_filter_item('filterSelectedCodesys')"
                                        class="button_clear_filter"> </span></span></span>

                        <span class="item" v-if="filterSelectedOss.length > 0"><span
                                    v-for="Os in filterSelectedOss">ОС: <b>{{ Os }}</b> <span
                                        @click="clear_filter_item('filterSelectedOss',Os)"
                                        class="button_clear_filter"> </span></span></span>
                        <span class="item" v-if="filterSelectedInterfaces.length > 0"><span
                                    v-for="Interface in filterSelectedInterfaces">интерфейс: <b>{{ Interface }}</b> <span
                                        @click="clear_filter_item('filterSelectedInterfaces',Interface)"
                                        class="button_clear_filter"> </span></span></span>
                        <span class="item" v-if="filterSelectedResolutions.length > 0"><span
                                    v-for="Resolution in filterSelectedResolutions">разрешение: <b>{{ Resolution }}</b> <span
                                        @click="clear_filter_item('filterSelectedResolutions',Resolution)"
                                        class="button_clear_filter"> </span></span></span>
                        <span class="item" v-if="filterSelectedProcessors.length > 0"><span
                                    v-for="Processor in filterSelectedProcessors">процессор: <b>{{ Processor }}</b> <span
                                        @click="clear_filter_item('filterSelectedProcessors',Processor)"
                                        class="button_clear_filter"> </span></span></span>
                        <span class="item" v-if="filterSelectedAvailablity > 0"><span>доступность: <b
                                        v-if="filterSelectedAvailablity == 1">В наличии</b><b
                                        v-if="filterSelectedAvailablity == 2">Под заказ</b> <span
                                        @click="clear_filter_item('filterSelectedAvailablity','')"
                                        class="button_clear_filter"> </span></span></span>
                        <span class="item" v-if="filterSelectedRangePrice_min > 0"><span>цена от: <b>{{ filterSelectedRangePrice_min }} $</b> <span
                                        @click="clear_filter_item('filterSelectedRangePrice_min','')"
                                        class="button_clear_filter"> </span></span></span>
                        <span class="item" v-if="filterSelectedRangePrice_max < filterSelectedRangePrice_max_start"><span>цена до: <b>{{ filterSelectedRangePrice_max }} $</b> <span
                                        @click="clear_filter_item('filterSelectedRangePrice_max','')"
                                        class="button_clear_filter"> </span></span></span>

                        <span class="item" v-if="filterSelectedRangeDiagonal_min > filterSelectedRangeDiagonal_min_start"><span>диагональ от: <b>{{ filterSelectedRangeDiagonal_min }}&Prime;</b> <span
                                        @click="clear_filter_item('filterSelectedRangeDiagonal_min', '')"
                                        class="button_clear_filter"> </span></span></span>
                        <span class="item" v-if="filterSelectedRangeDiagonal_max < filterSelectedRangeDiagonal_max_start"><span>диагональ до: <b>{{ filterSelectedRangeDiagonal_max }}&Prime;</b> <span
                                        @click="clear_filter_item('filterSelectedRangeDiagonal_max', '')"
                                        class="button_clear_filter"> </span></span></span>

                        <span class="item" v-if="filterSelectedRangeEthernets_min > filterSelectedRangeEthernets_min_start"><span>количество Ethernet от: <b>{{ filterSelectedRangeEthernets_min }}&Prime;</b> <span
                                        @click="clear_filter_item('filterSelectedRangeDiagonal_min', '')"
                                        class="button_clear_filter"> </span></span></span>
                        <span class="item" v-if="filterSelectedRangeEthernets_max < filterSelectedRangeEthernets_max_start"><span>количество Ethernet до: <b>{{ filterSelectedRangeEthernets_max }}&Prime;</b> <span
                                        @click="clear_filter_item('filterSelectedRangeEthernets_max', '')"
                                        class="button_clear_filter"> </span></span></span>




                    </div>

                    <div class="section_list_view_mode_button_wrapper" v-cloak>

                            <div class="is-hidden-desktop button is-success  is-small button_open_filter">
                                <span class="button_open_filter__icon"></span> <span class="button_open_filter___text">Фильтры</span>
                            </div>

                        <div class="is-hidden-touch section_list__set_diagonal_span" v-if="section_list__set_diagonal_span_show">
                            <div class="section_list__title">Диагональ</div>
                            <div class="elements">
                            <span v-if="filterSelectedRangeDiagonal_min_start <= 5"
                                  v-bind:class="['section_list__set_diagonal_span__button' , {'active': (filterSelectedRangeDiagonal_min_start >= '0' && filterSelectedRangeDiagonal_max <= '5')} ]"
                                  @click="set_diagonal_span(0, 5, $event)"><5&Prime;</span>
                                <span v-bind:class="['section_list__set_diagonal_span__button' , {'active': (filterSelectedRangeDiagonal_min >= '5' && filterSelectedRangeDiagonal_max <= '9')} ]"
                                      @click="set_diagonal_span(5, 9, $event)">5-9&Prime;</span>
                                <span v-bind:class="['section_list__set_diagonal_span__button' , {'active': (filterSelectedRangeDiagonal_min >= '9' && filterSelectedRangeDiagonal_max <= '12')} ]"
                                      @click="set_diagonal_span(9, 12, $event)">9-12&Prime;</span>
                                <span v-bind:class="['section_list__set_diagonal_span__button' , {'active': (filterSelectedRangeDiagonal_min >= '12' && filterSelectedRangeDiagonal_max <= '17')} ]"
                                      @click="set_diagonal_span(12, 17, $event)">12-17&Prime;</span>
                                <span v-if="filterSelectedRangeDiagonal_max > 17"
                                      v-bind:class="['section_list__set_diagonal_span__button' , {'active': (filterSelectedRangeDiagonal_min >= '17' && filterSelectedRangeDiagonal_max <= '31.5')} ]"
                                      @click="set_diagonal_span(17, 31.5, $event)">>17&Prime;</span>
                                <span v-bind:class="['section_list__set_diagonal_span__button clear_button' , {'active': (filterSelectedRangeDiagonal_min == '0' && filterSelectedRangeDiagonal_max == filterSelectedRangeDiagonal_max_start)} ]"
                                      @click="set_diagonal_span(0, 31.5, $event)"></span>
                            </div>
                        </div>
                        <div class="is-hidden-touch section_list__set_availablity" v-if="section_list__set_availability_show">
                            <div class="section_list__title">Наличие</div>
                            <div class="elements">
                            <span v-bind:class="['section_list__set_availablity__button' , {'active': (filterSelectedAvailablity == '1')} ]"
                                  @click="change_availablity">На складе</span>

                            </div>
                        </div>
                        <? if (count($arr_product_sort) > 0): ?>
                        <div class="section_list_view_sort">
                            <div class="section_list__title is-hidden-touch ">Сортировка</div>
                            <div class="elements">
                                <select v-model="product_sort" @change="change_view_sort"><?
                                        $arr_product_sort_names = [
                                            "recommended" => 'рекомендуемые',
                                            "new" => 'по новизне',
                                            "series" => 'по сериям',
                                            "diagonal_small" => 'меньше диагональ',
                                            "diagonal_big" => 'больше диагональ',
                                            "price_small" => 'меньше цена',
                                            "price_big" => 'больше цена',
                                        ];
                                        foreach ($arr_product_sort as $item) {
                                            echo '<option value="' . $item . '">' . $arr_product_sort_names[$item] . '</option>';
                                        }
                                        ?>

                                </select>
                            </div>
                        </div>
                        <? endif; ?>
                        <div class="section_list_view_mode is-hidden-touch ">
                            <div class="section_list__title">Вид списка</div>
                            <div class="elements">
                            <span v-bind:class="['section_list_view_mode_button button_view_mode_list' , {'active': (view_mode == 'list')} ]"
                                  @click="change_view_mode('list')"></span>
                                <span v-bind:class="['section_list_view_mode_button button_view_mode_table' , {'active': (view_mode == 'table')} ]"
                                      @click="change_view_mode('table')"></span>
                                <? /*?><span class="section_list_view_mode_button button_view_mode_tiles"></span><?*/ ?>
                            </div>
                        </div>
                        <?
                        global $usd_currency;
                        if (isset($usd_currency) and $usd_currency > 0):?>
                            <div class="section_list_currency_block is-hidden-touch ">
                                <div class="section_list__title">Курс</div>
                                <div class="info">
                                    <?
                                    echo "1 USD = " . $usd_currency . " РУБ";
                                    ?>
                                </div>
                            </div>
                        <? endif; ?>
                        <!--div class="filter_string" v-html="filter_string"></div-->
                    </div>
                    <div class="component_catalog_section__panel_of_products_wrapper">
                        <div class="component_catalog_section__panel_of_products" v-html="html_filtered_products"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="result" v-html="result"></div>
    <div class="component_catalog_section__bottom_of_list"></div>
    <div style="display: none" class="vue-data">
        <span class="current_section" data-value="<?= $arguments["component_route_params"]["section"] ?>"></span>
        <span class="current_min_price" data-value="<?= $arguments["component_route_params"]["section"] ?>"></span>
        <span class="current_max_price" data-value="<?= $arguments["component_route_params"]["section"] ?>"></span>
        <span class="filter_diagonal_min" data-value="<?= $arrSection["filter_diagonal_min"] ?>"></span>
        <span class="filter_diagonal_max" data-value="<?= $arrSection["filter_diagonal_max"] ?>"></span>
        <span class="filter_price_min" data-value="<?= $arrSection["filter_price_min"] ?>"></span>
        <span class="filter_price_max" data-value="<?= $arrSection["filter_price_max"] ?>"></span>
        <span class="filter_com_min" data-value="<?= $arrSection["filter_com_min"] ?>"></span>
        <span class="filter_com_max" data-value="<?= $arrSection["filter_com_max"] ?>"></span>
        <span class="filter_ethernets_min" data-value="<?= $arrSection["filter_ethernets_min"] ?>"></span>
        <span class="filter_ethernets_max" data-value="<?= $arrSection["filter_ethernets_max"] ?>"></span>
    </div>
</div>
<?
CoreApplication::include_component(array("component" => "form_require_price", "template" => "default",));
?>
