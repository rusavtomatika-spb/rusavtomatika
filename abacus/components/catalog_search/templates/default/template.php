<?php
CoreApplication::add_style( str_replace( $_SERVER[ "DOCUMENT_ROOT" ], "", __DIR__ ) . "/style.css" );
CoreApplication::add_script( str_replace( $_SERVER[ "DOCUMENT_ROOT" ], "", __DIR__ ) . "/script.js?10092026" );
if (isset($_GET['type']) && $_GET['type'] === 'products') {
    CoreApplication::add_style( "/abacus/components/catalog_section/templates/default/style.css" );
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/abacus/components/catalog_layout/CatalogLayout.php';

global $H1, $TITLE, $userCountry;
global $arSettings;
$arSettings[ 'path_to_product_images' ] = '/images/';
require "inc_functions.php";

require_once $_SERVER['DOCUMENT_ROOT'] . '/abacus/services/CountryDetector.php';
$userCountry = CountryDetector::getCountry();
if (!$userCountry) {
    $userCountry = 'UNKNOWN';
}

$arrResult = array();
$arrResult_texts = array();
$arr_search_words = array();
$search_type = isset($_GET['type']) ? $_GET['type'] : 'all';
$use_grid_layout = ($search_type === 'products');
$extra_h1 = '';

function myStrToLower($string) {
    $upperCaseRu = ['А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я'];
    $lowerCaseRu = ['а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п','р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я'];
    return str_replace($upperCaseRu, $lowerCaseRu, $string);
}

if (isset($_GET['search']) && $_GET['search'] != "") {
    $search_text = strip_tags($_GET['search']);
    $search_text = $search_text_orig = myStrToLower($search_text);

    $vesa_filter = false;
    if (isset($_GET['vesa']) && $_GET['vesa'] == 'yes') {
        $vesa_filter = true;
    }

    $arr_sinonims = CoreApplication::get_rows_from_table('search_sinonim', '', '');
    $sinonims = $arr_sinonims[0]['sinonim'];
    $lines = explode(",\n", trim($sinonims));
    $synonyms = [];
    foreach ($lines as $line) {
        $parts = array_map('trim', explode("=", $line));
        if (!isset($parts[1])) { continue; }
        $key = strtolower($parts[0]);
        $value = strtolower($parts[1]);
        $synonyms[$key] = $value;
    }

    function replaceSynonyms($query, $synonyms) {
        $query_lower = strtolower($query);
        if (isset($synonyms[$query_lower])) {
            return $synonyms[$query_lower];
        }
        return $query;
    }

    $search_text = replaceSynonyms($search_text, $synonyms);
    $arr_search_words = search_string_to_array($search_text);
    $extra_h1 = ": «" . $search_text_orig . "»";
}

if ( isset($arr_search_words) and is_array($arr_search_words) and count($arr_search_words) > 0 ) {

    global $arr_catalog_types;
    $arr_all_catalog_types = CoreApplication::get_rows_from_table( 'catalog_types', "", "" );
    foreach ( $arr_all_catalog_types as $type ) {
        $arr_catalog_types[ $type['code'] . $type['series'] ] = $type["template_h1"];
    }

    if ($search_type == 'all' || $search_type == 'products') {

        $arrResult = search_by_words($arr_search_words, $vesa_filter);
        if (!is_array($arrResult)) { $arrResult = array(); }

        if (isset($_GET['vesa']) && $_GET['vesa'] == 'yes') {
            global $mysqli_db;
            $sql = "SELECT * FROM products_all
                    WHERE parent=''
                    AND status!='0'
                    AND (vesa75 IS NOT NULL AND vesa75 != ''
                    OR vesa100 IS NOT NULL AND vesa100 != '')";
            $result = mysqli_query($mysqli_db, $sql);
            if ($result) {
                $existing_indices = array();
                foreach ($arrResult as $item) {
                    $existing_indices[] = $item['index'];
                }
                while ($row = mysqli_fetch_assoc($result)) {
                    if (!in_array($row['index'], $existing_indices)) {
                        $row['freqs'] = 500;
                        $arrResult[] = $row;
                    }
                }
                mysqli_free_result($result);
            }
        }

        if (isset($_GET['interfaces']) && $_GET['interfaces'] == 'wifi') {
            global $mysqli_db;
            $sql = "SELECT * FROM products_all
                    WHERE parent=''
                    AND status!='0'
                    AND (wifi IS NOT NULL AND wifi != '' AND wifi != '0')";
            $result = mysqli_query($mysqli_db, $sql);
            if ($result) {
                $existing_indices = array();
                foreach ($arrResult as $item) {
                    $existing_indices[] = $item['index'];
                }
                while ($row = mysqli_fetch_assoc($result)) {
                    if (!in_array($row['index'], $existing_indices)) {
                        $row['freqs'] = 500;
                        $arrResult[] = $row;
                    }
                }
                mysqli_free_result($result);
            }
        }

        usort($arrResult, function($a, $b) {
            $a_discontinued = isset($a['discontinued']) && $a['discontinued'] == 1 ? 1 : 0;
            $b_discontinued = isset($b['discontinued']) && $b['discontinued'] == 1 ? 1 : 0;
            if ($a_discontinued != $b_discontinued) {
                return $a_discontinued - $b_discontinued;
            }
            $a_freqs = isset($a['freqs']) ? $a['freqs'] : 0;
            $b_freqs = isset($b['freqs']) ? $b['freqs'] : 0;
            if ($a_freqs == $b_freqs) { return 0; }
            return ($a_freqs > $b_freqs) ? -1 : 1;
        });
    }

    if ($search_type == 'all' || $search_type == 'articles') {
        $arrResult_texts = search_by_words_texts( $arr_search_words );
        if (!is_array($arrResult_texts)) { $arrResult_texts = array(); }
    }

    if ( count($arrResult) == 0 && count($arrResult_texts) == 0 ) {
        $extra_h1 = '';
    }
}

$H1 = "Поиск" . $extra_h1;
$TITLE = "Поиск по сайту www.rusavtomatika.com";
if ( isset($search_text) and $search_text != "" ) {
    $TITLE = "Поиск - &laquo;" . $search_text . "&raquo; - www.rusavtomatika.com";
}
CoreApplication::add_breadcrumbs_chain( $H1 );

if (!empty($arrResult_texts)) {
    foreach ($arrResult_texts as &$cl_item) {
        if (!isset($cl_item['date'])) { continue; }
        $cl_date = trim($cl_item['date']);
        if (!$cl_date || !preg_match('/^\d{4}-\d{2}-\d{2}(?: \d{2}:\d{2}:\d{2})?$/', $cl_date)) {
            unset($cl_item['date']);
            continue;
        }
        if (strlen($cl_date) <= 10) { $cl_date .= ' 00:00:00'; }
        $cl_item['date'] = $cl_date;
    }
    unset($cl_item);

    usort($arrResult_texts, function ($a, $b) {
        if (!isset($a['date']) || !isset($b['date'])) { return 0; }
        return strcmp($b['date'], $a['date']);
    });
}

$count_products = count($arrResult);
$count_texts    = count($arrResult_texts);
$two_columns    = ($search_type == 'all' && $count_products > 0 && $count_texts > 0);
$has_results    = ($count_products > 0 || $count_texts > 0);

$cl_products_mode = $use_grid_layout ? 'tile' : 'table';
$cl_wrapper_class = $two_columns ? 'in_two_cols' : '';
?>
<?php if ($use_grid_layout): ?>
<div id="vue_app_component_catalog_search">
    <div class="component_catalog_section">
        <div class="component_wrapper">
            <? CoreApplication::include_component( array( "component" => "breadcrumbs" ) ); ?>
            <div class="columns is-gapless">
                <div class="column is-12-desktop column_content">
                    <div class="search_type_selector">
                        <h1 class="search__title"><?= $H1 ?></h1>
                        <select onchange="window.location.href='?search=<?= urlencode(isset($_GET['search']) ? $_GET['search'] : '') ?>&type=' + this.value">
                            <option value="all" <?= $search_type == 'all' ? 'selected' : '' ?>>Везде</option>
                            <option value="products" <?= $search_type == 'products' ? 'selected' : '' ?>>По товарам</option>
                            <option value="articles" <?= $search_type == 'articles' ? 'selected' : '' ?>>По статьям</option>
                        </select>
                    </div>
                    <div class="view-mode-list">
                        <div class="catalog_search__results">
                            <?php if ($has_results): ?>

                                <?php if ($two_columns): ?>
                                <div class="columns ">
                                    <div class="column is-half">
                                        <h2>Каталог</h2>
                                <?php endif; ?>

                                <?php if ($count_products > 0): ?>
                                    <div class="component_catalog_section__panel_of_products_wrapper">
                                        <div class="component_catalog_section__panel_of_products">
                                            <?= CatalogLayout::render(array(
                                                'items'         => $arrResult,
                                                'mode'          => $cl_products_mode,
                                                'cols'          => array(1, 2, 3),
                                                'is_ajax'       => false,
                                                'wrapper_class' => $cl_wrapper_class,
                                                'country'       => $userCountry,
                                            )) ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if ($two_columns): ?>
                                    </div>
                                    <div class="column is-half">
                                        <h2>Текстовые материалы</h2>
                                <?php endif; ?>

                                <?php if ($count_texts > 0): ?>
                                    <?= CatalogLayout::render(array(
                                        'items'     => $arrResult_texts,
                                        'item_type' => 'article',
                                        'country'   => $userCountry,
                                    )) ?>
                                <?php endif; ?>

                                <?php if ($two_columns): ?>
                                    </div>
                                </div>
                                <?php endif; ?>

                            <?php else: ?>
                                <?php if (isset($search_text) and $search_text != ""): ?>
                                    <h2 style="margin-left: 30px;">По запросу <?= ": &laquo;" . $search_text . "&raquo;" ?> ничего не найдено...</h2>
                                <?php else: ?>
                                    <h2 style="margin-left: 30px;">Введите текст для поиска...</h2>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php else: ?>
<div class="component_catalog_search" id="vue_app_component_catalog_search">
    <div class="component_wrapper">
        <? CoreApplication::include_component( array( "component" => "breadcrumbs" ) ); ?>
        <div class="search_type_selector">
            <h1 class="search__title"><?= $H1 ?></h1>
            <select onchange="window.location.href='?search=<?= urlencode(isset($_GET['search']) ? $_GET['search'] : '') ?>&type=' + this.value">
                <option value="all" <?= $search_type == 'all' ? 'selected' : '' ?>>Везде</option>
                <option value="products" <?= $search_type == 'products' ? 'selected' : '' ?>>По товарам</option>
                <option value="articles" <?= $search_type == 'articles' ? 'selected' : '' ?>>По статьям</option>
            </select>
        </div>
        <div class="view-mode-list">
            <div class="catalog_search__results">
                <?php if ($has_results): ?>

                    <?php if ($two_columns): ?>
                    <div class="columns gap-10">
                        <div class="column is-half">
                            <h2>Каталог</h2>
                    <?php endif; ?>

                    <?php if ($count_products > 0): ?>
                        <?= CatalogLayout::render(array(
                            'items'         => $arrResult,
                            'mode'          => $cl_products_mode,
                            'is_ajax'       => false,
                            'wrapper_class' => $cl_wrapper_class,
                            'country'       => $userCountry,
                        )) ?>
                    <?php endif; ?>

                    <?php if ($two_columns): ?>
                        </div>
                        <div class="column is-half">
                            <h2>Текстовые материалы</h2>
                    <?php endif; ?>

                    <?php if ($count_texts > 0): ?>
                        <?= CatalogLayout::render(array(
                            'items'     => $arrResult_texts,
                            'item_type' => 'article',
                            'country'   => $userCountry,
                        )) ?>
                    <?php endif; ?>

                    <?php if ($two_columns): ?>
                        </div>
                    </div>
                    <?php endif; ?>

                <?php else: ?>
                    <?php if (isset($search_text) and $search_text != ""): ?>
                        <h2>По запросу <?= ": &laquo;" . $search_text . "&raquo;" ?> ничего не найдено...</h2>
                    <?php else: ?>
                        <h2>Введите текст для поиска...</h2>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>