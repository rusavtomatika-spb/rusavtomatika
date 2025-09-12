<?php
CoreApplication::add_style(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/style.css");
CoreApplication::add_script(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/script.js");

global $H1, $TITLE;
global $arSettings;
$arSettings['path_to_product_images'] = '/images/';

/*!!!!!!!!!!!!!!!!!!!!!!*/
require "inc_functions.php";
/*!!!!!!!!!!!!!!!!!!!!!!*/

$extra_h1 = '';
if (isset($_GET['search']) and $_GET['search'] != "") {
    $search_text = strip_tags($_GET['search']);
    $arr_search_words = search_string_to_array($search_text);
    $extra_h1 = ": &laquo;" . $search_text . "&raquo;";
}

if (isset($arr_search_words) and is_array($arr_search_words) and count($arr_search_words) > 0) {

    global $arr_catalog_types;
    $arr_all_catalog_types = CoreApplication::get_rows_from_table('catalog_types', "", "");
    foreach ($arr_all_catalog_types as $type) {
        $arr_catalog_types[$type['code'] . $type['series']] = $type["template_h1"];
    }


    $arrResult = search_by_words($arr_search_words);
    $arrResult_texts = search_by_words_texts($arr_search_words);
    if (count($arrResult) == 0) {
        $extra_h1 = '';
    }

}

$H1 = "Поиск" . $extra_h1;
$TITLE = "Поиск по сайту www.rusavtomatika.com";
if (isset($search_text) and $search_text != "") {
    $TITLE = "Поиск - &laquo;" . $search_text . "&raquo; - www.rusavtomatika.com";
}

CoreApplication::add_breadcrumbs_chain($H1);


//$arrSections = CoreApplication::get_rows_from_table("catalog_sections", '', "active='1'", "position ASC");


?>
<div class="component_catalog_search" id="vue_app_component_catalog_search">
    <div class="component_wrapper">
        <?
        CoreApplication::include_component(array("component" => "breadcrumbs"));
        ?>
        <?php
        ?>
        <h1><?= $H1 ?></h1>
        <div class="view-mode-list">
            <div class="catalog_search__results">
                <?
                if ((isset($arrResult) and is_array($arrResult) and count($arrResult) > 0) or (isset($arrResult_texts) and is_array($arrResult_texts) and count($arrResult_texts) > 0)) {
                    $count_products = count($arrResult);
                    $count_texts = count($arrResult_texts);
                    if ($count_products > 10 and $count_texts > 0) {
                        $two_columns = true;
                    } else $two_columns = false;
                    if ($two_columns) {
                        ?>
                        <div class="columns ">
                        <div class="column is-half">
                        <h2>Каталог</h2>
                        <?
                    }
                    if ($count_products > 0) {
                        ?>
                        <table class="series_products  <? if ($two_columns) {
                            echo "in_two_cols";
                        } ?>">
                            <?
                            global $product;
                            foreach ($arrResult as $product) {
                                include "inc_template_result_item.php";
                            }
                            ?>
                        </table>
                        <?
                    }
                if ($two_columns){
                    ?>
                    </div>
                    <div class="column is-half">
                    <h2>Текстовые материалы</h2>
                    <?
                }

                    global $article;
                    if (count($count_texts) > 0) {
                        ?>
                        <table class="series_products">
                            <tr class="separator">
                                <td colspan="2"></td>
                            </tr>
                            <?
                            foreach ($arrResult_texts as $article) {
                                include "inc_template_result_item_article.php";
                            }
                            ?>
                        </table>
                        <?
                    }
                    if ($two_columns) {
                        ?>
                        </div>
                        </div>
                        <?
                    }

                } else {
                    if (isset($search_text) and $search_text != "") {
                        ?><h2>По запросу <?= ": &laquo;" . $search_text . "&raquo;" ?> ничего не найдено...</h2><?
                    }else{
                        ?><h2>Введите текст для поиска...</h2><?
                    }
                }

                ?>
            </div>
        </div>
    </div>
</div>
