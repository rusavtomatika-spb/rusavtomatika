<?php

CoreApplication::add_style(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/style_catalog_pop_menu.css");
CoreApplication::add_script(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/script.js");

$arrSections = CoreApplication::get_rows_from_table("catalog_sections", '', "active='1'", "position ASC");
$arrBrands = CoreApplication::get_rows_from_table("catalog_brands", '', "active='1'", "position ASC");

for ($x = 0; $x < count($arrBrands); $x++) {
    $arrBrands[$x]['sections'] = array();
    foreach ($arrSections as $section) {
        $pos = strpos($section['filter_brands'], $arrBrands[$x]['name']);
        if ($pos !== false) {
            $arrBrands[$x]['sections'][] = array("id" => $section['id'],"code" => $section['code'], 'name' => $section['name'], 'category_link' => $section['category_link'], 'is_direct_link' => $section['is_direct_link']);
        }
    }
}


?>
<div id="vue_catalog_pop_menu" v-cloak="" style="display: none">
    <div class="catalog_pop_menu">
        <div class="catalog_pop_menu_wrap_inn">
            <div class="hidden-menu ">
                <div class=" container_ ">
                    <div class="box cataloge">
                        <div class="cataloge-left-side">
                            <ul class="cataloge-left-side-switch">
                                <li @click="pop_menu_switch_category" class="cataloge-switch active" data-show="cataloge-list" >
                                    Категории
                                </li>
                                <li @click="pop_menu_switch_category" class="cataloge-switch" data-show="brand-list">Бренды
                                </li>
                                <li @click="pop_menu_switch_category" class="cataloge-switch" data-show="option-list">Опции
                                </li>
                            </ul>
                            <ul class="cataloge-list">
                                <?
                                foreach ($arrSections as $section) {
                                    if (isset($section['category_link']) and $section['category_link'] != '') {
                                        $link = $section['category_link'];
                                    } else {
                                        $link = "";
                                    }

                                    ?>
                                    <li class="cataloge_list_item_icon">
                                        <div class="cataloge_list_item__picture">
                                            <?
                                            if(isset($section['preview_picture_small']) and $section['preview_picture_small']!='') $preview_picture = $section['preview_picture_small'];
                                            else $preview_picture = $section['preview_picture'];
                                            ?>
                                            <img class="is-hidden-mobile" src="<?= $preview_picture ?>"
                                                 alt="">
                                        </div>
                                        <ul>
                                            <li>
                                                <?
                                                if ($section['is_direct_link'] == "1") {
                                                    ?>
                                                    <a  href="<?= $link ?>" class="cataloge_list-title button_show_items"><?= $section['name'] ?></a>
                                                    <?
                                                } else {
                                                    ?>
                                                    <span @click="handle_button_show_items"
                                                          data-link="<?= $section["category_link"] ?>"
                                                          data-section-id="<?= $section['id'] ?>"
                                                          data-section-code="<?= $section['code'] ?>"
                                                          data-action="show_section_by_categories"
                                                          data-brand="all"
                                                          class="cataloge_list-title button_show_items"
                                                    >
                                                    <?= $section['name'] ?>
                                                </span>
                                                    <?
                                                }
                                                ?>
                                                <? if (isset($section['filter_brands']) and $section['filter_brands'] != '') {
                                                    $arr_section_brands = explode(",", $section['filter_brands']);
                                                    if (count($arr_section_brands) > 1) {

                                                        ?>
                                                        <ul><?
                                                        foreach ($arr_section_brands as $section_brand) {
                                                            $section_brand = trim($section_brand);
                                                            ?>
                                                            <li class="cataloge_list_item_subitem">
                                                                <span @click="handle_button_show_items"
                                                                      class="button_show_items"
                                                                      data-action="show_section_by_categories_one_brand_only"
                                                                      data-link="<?= $section["category_link"] ?>"
                                                                      data-section-code="<?= $section['code'] ?>"
                                                                      data-section-id="<?= $section['id'] ?>"
                                                                      data-brand="<?= $section_brand ?>"><?= $section_brand ?></span>
                                                            </li>
                                                            <?
                                                        }
                                                        ?></ul><?
                                                    };
                                                }
                                                ?>
                                            </li>
                                        </ul>
                                    </li>
                                    <?
                                }
                                ?>
                            </ul>
                            <ul class="brand-list" wfd-invisible="true" style="display: none;">
                                <?
                                for ($x = 0;
                                $x < count($arrBrands);
                                $x++){
                                ?>
                                <li class="brand-list-item">
                                    <span @click="handle_button_show_items"
                                          class="cataloge_list_item_subitem button_show_items"
                                          data-action="show_all_sections_by_brand"
                                          data-brand="<?= $arrBrands[$x]["name"] ?>" data-section-code="all">
                                        <?= $arrBrands[$x]["name"] ?>
                                    </span>
                                    <ul>
                                        <?
                                        if (count($arrBrands[$x]["sections"]) > 0) {

                                            foreach ($arrBrands[$x]["sections"] as $section) {

                                                ?>
                                                <li>
                                                    <span @click="handle_button_show_items"
                                                          data-section-id="<?= $section["id"] ?>"
                                                          data-section-code="<?= $section['code'] ?>"
                                                          data-action="show_one_section_by_brand"
                                                          data-brand="<?= $arrBrands[$x]["name"] ?>"
                                                          data-link="<?= $section["category_link"] ?>"
                                                          class="cataloge_list-title button_show_items"><?= $section['name'] ?></span>
                                                </li>
                                                <?
                                            }
                                        }
                                        ?>
                                    </ul>
                                    <?
                                    }
                                    ?>
                            </ul>
                            <ul class="option-list" wfd-invisible="true" style="display: none;">
                                <li class="cataloge_list_item_icon" @click="pop_menu_filter_options"><span data-filter="all" class="cataloge_list-title button_show_items active-item">Все</span></li>
                                <li class="cataloge_list_item_icon" @click="pop_menu_filter_options"><span data-filter="hmi" class="cataloge_list-title button_show_items">Панели оператора</span></li>
                                <li class="cataloge_list_item_icon" @click="pop_menu_filter_options"><span data-filter="monitors" class="cataloge_list-title button_show_items">Мониторы</span></li>
                                <li class="cataloge_list_item_icon" @click="pop_menu_filter_options"><span data-filter="computers" class="cataloge_list-title button_show_items">Компьютеры</span></li>
                            </ul>
                        </div>
                        <div :class="[{loading: loading_status}, 'cataloge-right-side']">
                            <span  @click="close_catalog_popmenu" class="button_close_catalog_popmenu">x</span>
                            <div class="cataloge-right-side__html_content" v-html="html_result"></div>
                            <div class="loading_info_panel"></div>
                        </div>
                        <div class="cataloge-extra-side__html_content"></div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>


