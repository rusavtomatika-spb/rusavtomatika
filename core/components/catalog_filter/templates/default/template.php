<?php
require_once "catalog_filter_settings.php";

CoreApplication::add_style(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/style.css");
CoreApplication::add_script(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/fixed-filter-column.js");

//CoreApplication::add_script(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/script.js");

if ($arguments["section"]["filters"] != "") {
    $list_of_filter_items = explode(",", $arguments["section"]["filters"]);
    if (is_array($list_of_filter_items) and count($list_of_filter_items) > 0) {
        $condition = "";
        foreach ($list_of_filter_items as $item) {
            if ($item != "") {
                $condition .= " `filter_code`= '$item' ";
                if (end($list_of_filter_items))
                    if ($item == end($list_of_filter_items)) {
                        $condition .= ") ";
                    } else {
                        $condition .= " or ";
                    }
            }
        }
        if ($condition != "") $condition = " (" . $condition;
        $arr_filter_items = CoreApplication::get_rows_from_table("`catalog_filters`", "*", $condition, "position");
        ?>

        <div id="float_filter_block"><span class="is-hidden-desktop button_close_mobile_filter">ok</span>
            <div class="component_catalog_section__filter">
                <div class="title is-hidden-desktop">Фильтры</div>


                <!--div class="filter_block__title"><span class="filter_block__title_icon active"></span>Фильтр</div-->
                <div class="filter_panel">
                    <?
                    foreach ($arr_filter_items as $item) {
                        ?>
                        <div class="filter_code_<?= $item['filter_code'] ?>"><?
                        include "inc.template_filter_{$item['filter_code']}.php";
                        ?></div><?
                    }
                    ?>
                </div>

            </div>
        </div>
        <?php
    }
} ?>


