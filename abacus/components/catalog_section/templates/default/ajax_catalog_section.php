<?php
$_POST = json_decode(file_get_contents('php://input'), true);
if (!is_array($_POST)) { $_POST = array(); }

if (!defined('ENCODING')) { define('ENCODING', 'UTF-8'); }
header('Content-Type: text/html; charset=utf-8');

$is_server_rendering = defined('SERVER_RENDERING');

if (!$is_server_rendering) {
    ini_set('error_reporting', E_ALL & ~E_DEPRECATED);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    if (!defined('bullshit')) { define('bullshit', 1); }
}

require_once __DIR__ . '/functions/inc_class_C_DB_WORK_CATALOG.php';
require_once __DIR__ . '/functions/inc_functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/abacus/components/catalog_layout/CatalogLayout.php';

global $ajax_message, $arSettings, $usd_currency, $mysqli_db, $db, $userCountry;
$ajax_message = '';
$arSettings['path_to_product_images'] = '/images/';

$usd_currency = file_exists($_SERVER['DOCUMENT_ROOT'] . '/usdrate.txt')
    ? floatval(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/usdrate.txt'))
    : 0;

if (!$is_server_rendering) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/sc/dbcon.php';
    database_connect();
    mysqli_set_charset($mysqli_db, 'utf8');
}

if (!isset($userCountry) || $userCountry == '') {
    if (class_exists('CountryDetector')) { $userCountry = CountryDetector::getCountry(); }
    if (!$userCountry) { $userCountry = 'UNKNOWN'; }
}

$section_code = isset($_GET['section']) ? $_GET['section'] : '';
$DB_WORK_CATALOG = new C_DB_WORK_CATALOG(array('current_section_code' => $section_code));

ob_start();

$allowed_view_modes = array('list', 'tile', 'tiles', 'table');
$view_mode = 'tile';
if (isset($GLOBALS['server_view_mode']) && in_array($GLOBALS['server_view_mode'], $allowed_view_modes, true)) {
    $view_mode = $GLOBALS['server_view_mode'];
} elseif (!empty($_POST['view_mode']) && in_array($_POST['view_mode'], $allowed_view_modes, true)) {
    $view_mode = $_POST['view_mode'];
} elseif (isset($_COOKIE['section_catalog_view_mode']) && in_array($_COOKIE['section_catalog_view_mode'], $allowed_view_modes, true)) {
    $view_mode = $_COOKIE['section_catalog_view_mode'];
}

$arr_current_section = $DB_WORK_CATALOG->get_section_by_code($section_code);
$sec_current = isset($arr_current_section['code']) ? $arr_current_section['code'] : $section_code;

$sort_mode = 'recommended';
if (!empty($_POST['sort'])) {
    $sort_mode = $_POST['sort'];
} elseif (isset($_COOKIE['section_catalog_view_sort_' . $sec_current])) {
    $sort_mode = $_COOKIE['section_catalog_view_sort_' . $sec_current];
}

$query = '';
if (!empty($arr_current_section['products_selected_by_query'])) {
    $sort_mode = 'products_selected_by_query';
    $query = $arr_current_section['products_selected_by_query'];
}

require_once __DIR__ . '/functions/inc_build_mysql_filter.php';
global $mysql_product_filter;
$ajax_message .= $mysql_product_filter;

$arr_products = array();
$arrSeries    = array();
$grouped      = false;

if (!function_exists('cl_flatten_series')) {
function cl_flatten_series($arrSeries, $with_usd = false)
{
    global $usd_currency;
    $out = array();
    if (!is_array($arrSeries)) { return $out; }
    foreach ($arrSeries as $brand) {
        if (!is_array($brand)) { continue; }
        foreach ($brand as $series) {
            if (!isset($series['products']) || !is_array($series['products'])) { continue; }
            foreach ($series['products'] as $product) {
                if ($with_usd && isset($product['currency']) && $product['currency'] === 'RUR' && $usd_currency > 0) {
                    $product['retail_price_usd'] = intval($product['retail_price'] / $usd_currency);
                }
                $out[] = $product;
            }
        }
    }
    return $out;
}
}

switch ($sort_mode) {

    case 'products_selected_by_query':
        $arr_products = $DB_WORK_CATALOG->get_products_by_query($query);
        break;

    case 'price_small':
    case 'price_big':
        $arrSeries = $DB_WORK_CATALOG->get_series_by_section_code_grouped_by_brand($section_code, $mysql_product_filter);
        $arr_products = cl_flatten_series($arrSeries, true);
        sort_array_by($arr_products, array(
            'field_name'     => 'retail_price',
            'sort_direction' => ($sort_mode === 'price_small') ? 'ASC' : 'DESC',
        ));
        break;

    case 'diagonal_small':
    case 'diagonal_big':
        $arrSeries = $DB_WORK_CATALOG->get_series_by_section_code_grouped_by_brand($section_code, $mysql_product_filter);
        $arr_products = cl_flatten_series($arrSeries);
        sort_array_by($arr_products, array(
            'field_name'     => 'diagonal',
            'sort_direction' => ($sort_mode === 'diagonal_small') ? 'ASC' : 'DESC',
        ));
        break;

    case 'popular':
        $arrSeries = $DB_WORK_CATALOG->get_series_with_views_by_section_code_grouped_by_brand($section_code, $mysql_product_filter);
        $arr_products = cl_flatten_series($arrSeries);
        sort_array_by($arr_products, array('field_name' => 'views', 'sort_direction' => 'DESC'));
        break;

    case 'new':
        $arrSeries = $DB_WORK_CATALOG->get_series_by_section_code_grouped_by_brand($section_code, $mysql_product_filter);
        $arr_products = cl_flatten_series($arrSeries);
        sort_array_by($arr_products, array('field_name' => 'index', 'sort_direction' => 'DESC'));
        break;

    case 'recommended':
        $arrSeries = $DB_WORK_CATALOG->get_series_by_section_code_grouped_by_brand($section_code, $mysql_product_filter);
        $by_recommended = array();
        $by_diagonal    = array();
        foreach (cl_flatten_series($arrSeries) as $product) {
            if ((int)$product['recommended'] > 0) {
                $by_recommended[] = $product;
            } else {
                $by_diagonal[] = $product;
            }
        }
        usort($by_recommended, function ($a, $b) {
            return (int)$b['recommended'] - (int)$a['recommended'];
        });
        sort_array_by($by_diagonal, array('field_name' => 'diagonal', 'sort_direction' => 'ASC'));
        $arr_products = array_merge($by_recommended, $by_diagonal);
        break;

    default:
        $arrSeries = $DB_WORK_CATALOG->get_series_by_section_code_grouped_by_brand($section_code, $mysql_product_filter);
        $grouped = true;
        break;
}

$preview_fields_map = array();
if ($grouped && is_array($arrSeries)) {
    foreach ($arrSeries as $brand) {
        if (!is_array($brand)) { continue; }
        foreach ($brand as $series) {
            if (empty($series['set_of_preview_fields'])) { continue; }
            foreach (explode(',', trim($series['set_of_preview_fields'], ', ')) as $code) {
                $code = trim($code);
                if ($code === '' || isset($preview_fields_map[$code])) { continue; }
                $desc = $DB_WORK_CATALOG->get_field_describtion_by_code($code);
                $preview_fields_map[$code] = array(
                    'name_short' => isset($desc['name_short']) ? $desc['name_short'] : $code,
                    'units'      => isset($desc['units']) ? $desc['units'] : '',
                );
            }
        }
    }
}

echo CatalogLayout::render(array(
    'items'              => $arr_products,
    'groups'             => $grouped ? $arrSeries : array(),
    'mode'               => $view_mode,
    'cols'               => array(1, 2, 3),
    'country'            => $userCountry,
    'is_ajax'            => !$is_server_rendering,
    'show_titles'        => true,
    'preview_fields_map' => $preview_fields_map,
    'return_html'        => false,
));
?>
<div id="ajax_message" style="display: none"><?= $ajax_message ?></div>
<?php
$buffer = ob_get_clean();
echo $buffer;

if ($is_server_rendering) {
    $HTTP_REFERER = $_SERVER['REQUEST_URI'];
} elseif (isset($_POST['page_url']) && $_POST['page_url'] !== '') {
    $HTTP_REFERER = $_POST['page_url'];
} else {
    $HTTP_REFERER = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
}
$HTTP_REFERER = str_replace(
    array('https://www.rusavto.moisait.net', 'https://www.rusavtomatika.com', 'https://www.test.rusavtomatika.com'),
    '',
    $HTTP_REFERER
);

if ($HTTP_REFERER == '') { return; }

global $H1, $TITLE, $DESCRIPTION, $KEYWORDS, $CANONICAL, $UPPER_SEO_TEXT, $LOWER_SEO_TEXT, $pretext, $posttext;
global $H1_original, $TITLE_original, $SEO_URL;

$url = $HTTP_REFERER;
if (!function_exists('getCanonicalSeoUrl')) {
    function getCanonicalSeoUrl($rawUrl)
    {
        $parts = parse_url($rawUrl);
        $path  = isset($parts['path']) ? $parts['path'] : '';
        if (empty($parts['query'])) { return $path; }
        parse_str(ltrim($parts['query'], '&'), $params);
        unset($params['sort'], $params['ysclid'], $params['utm_source'], $params['utm_medium'], $params['utm_campaign']);
        if (empty($params)) { return $path; }
        ksort($params);
        return $path . '?&' . http_build_query($params);
    }
}
$canonical_url = getCanonicalSeoUrl($url);
?>
<meta name="fragment" content="!">
<?php
$row = $DB_WORK_CATALOG->get_rows_from_table('seo', '', "url = '" . addslashes($canonical_url) . "'", '', '1');

if (!isset($row[0]) || $row[0]['active'] != '1') {
    ?>
    <slot type="hidden" id="component_seo_UPPER_SEO_TEXT"></slot>
    <slot type="hidden" id="component_seo_LOWER_SEO_TEXT"></slot>
    <?php
    return;
}

$seo_data = $row[0];

if (!empty($seo_data['TITLE'])) {
    $TITLE = $TITLE_original = $seo_data['TITLE'];
    ?><meta name="component_seo_title" content="<?= htmlspecialchars($TITLE, ENT_QUOTES, 'UTF-8') ?>"><?php
}
if (!empty($seo_data['H1'])) {
    $H1 = $H1_original = $seo_data['H1'];
    ?><meta name="component_seo_h1" content="<?= htmlspecialchars($H1, ENT_QUOTES, 'UTF-8') ?>"><?php
}
if (!empty($seo_data['DESCRIPTION'])) {
    $DESCRIPTION = $seo_data['DESCRIPTION'];
    ?><meta name="component_seo_DESCRIPTION" content="<?= htmlspecialchars($DESCRIPTION, ENT_QUOTES, 'UTF-8') ?>"><?php
}
if (!empty($seo_data['KEYWORDS'])) {
    $KEYWORDS = $seo_data['KEYWORDS'];
    ?><meta name="component_seo_KEYWORDS" content="<?= htmlspecialchars($KEYWORDS, ENT_QUOTES, 'UTF-8') ?>"><?php
}
if (isset($seo_data['UPPER_SEO_TEXT']) && $seo_data['UPPER_SEO_TEXT'] !== '') {
    $UPPER_SEO_TEXT = $pretext = $seo_data['UPPER_SEO_TEXT'];
    ?><noindex><slot class="is-hidden" id="component_seo_UPPER_SEO_TEXT"><?= $UPPER_SEO_TEXT ?></slot></noindex><?php
}
if (!empty($seo_data['LOWER_SEO_TEXT'])) {
    $LOWER_SEO_TEXT = $posttext = $seo_data['LOWER_SEO_TEXT'];
    ?><noindex><slot class="is-hidden" id="component_seo_LOWER_SEO_TEXT"><?= $LOWER_SEO_TEXT ?></slot></noindex><?php
}
if (!empty($seo_data['rel_canonical'])) {
    $CANONICAL = $seo_data['rel_canonical'];
}