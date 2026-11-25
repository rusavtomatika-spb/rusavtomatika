<?php
global $userCountry, $arSettings, $product, $article, $usd_currency;

require_once __DIR__ . '/inc_helpers.php';

$CL_items     = (isset($arguments['items']) && is_array($arguments['items'])) ? $arguments['items'] : array();
$CL_groups    = (isset($arguments['groups']) && is_array($arguments['groups'])) ? $arguments['groups'] : array();
$CL_item_type = isset($arguments['item_type']) ? $arguments['item_type'] : 'product';
$CL_mode      = isset($arguments['mode']) ? $arguments['mode'] : 'tile';
$CL_return    = !empty($arguments['return_html']);
$CL_wrapper   = isset($arguments['wrapper_class']) ? $arguments['wrapper_class'] : '';
$CL_cols      = (isset($arguments['cols']) && is_array($arguments['cols'])) ? $arguments['cols'] : array(1, 2, 3);
$CL_titles    = isset($arguments['show_titles']) ? (bool)$arguments['show_titles'] : true;
$CL_pfmap     = (isset($arguments['preview_fields_map']) && is_array($arguments['preview_fields_map'])) ? $arguments['preview_fields_map'] : array();

if ($CL_mode === 'tiles') { $CL_mode = 'tile'; }
if ($CL_mode === 'list')  { $CL_mode = 'table'; }
if (!in_array($CL_mode, array('tile', 'table', 'articles'))) { $CL_mode = 'tile'; }
if ($CL_item_type === 'article') { $CL_mode = 'articles'; }

if (isset($arguments['country']) && $arguments['country'] != '') {
    $userCountry = $arguments['country'];
}
if (!isset($userCountry) || $userCountry == '') {
    if (class_exists('CountryDetector')) { $userCountry = CountryDetector::getCountry(); }
    if (!$userCountry) { $userCountry = 'UNKNOWN'; }
}
if (!isset($arSettings['path_to_product_images']) || $arSettings['path_to_product_images'] == '') {
    $arSettings['path_to_product_images'] = '/images/';
}

$CL_css_abs = str_replace('\\', '/', __DIR__) . '/style.css';
$CL_css_url = '/abacus/components/catalog_layout/templates/default/style.css';

if (class_exists('CoreApplication')) {
    if (!defined('CATALOG_LAYOUT_CSS_ADDED')) {
        define('CATALOG_LAYOUT_CSS_ADDED', 1);
        if (file_exists($CL_css_abs)) {
            CoreApplication::add_style($CL_css_url);
        }
    }
} elseif (!defined('CATALOG_LAYOUT_CSS_LINK_PRINTED')) {
    define('CATALOG_LAYOUT_CSS_LINK_PRINTED', 1);
    if (file_exists($CL_css_abs)) {
        echo '<link rel="stylesheet" href="' . $CL_css_url . '?v=' . filemtime($CL_css_abs) . '">';
    }
}

$CL_here = str_replace('\\', '/', __DIR__);

$CL_grouped = !empty($CL_groups);
if (!$CL_grouped && empty($CL_items)) { return ''; }

$CL_view_class = 'view-mode-list';
if ($CL_mode === 'tile')  { $CL_view_class = 'view-mode-tile'; }
if ($CL_mode === 'table') { $CL_view_class = 'view-mode-table'; }

$CL_render_class = defined('SERVER_RENDERING') ? 'IS_SERVER_RENDERING' : 'IS_NOT_SERVER_RENDERING';

$CL_c0 = isset($CL_cols[0]) ? (int)$CL_cols[0] : 1;
$CL_c1 = isset($CL_cols[1]) ? (int)$CL_cols[1] : 2;
$CL_c2 = isset($CL_cols[2]) ? (int)$CL_cols[2] : 3;

if (!function_exists('cl_render_list')) {
function cl_render_list($rows, $mode, $render_class, $country, $wrapper, $c0, $c1, $c2, $dir)
{
    $visible = array();
    foreach ($rows as $row) {
        if (!is_array($row)) { continue; }
        if ($mode === 'articles') {
            if (!isset($row['name']) || $row['name'] == '') { continue; }
        } elseif (cl_skip_product($row, $country)) {
            continue;
        }
        $visible[] = $row;
    }
    if (empty($visible)) { return; }

    if ($mode === 'tile') {
        ?>
        <div class="<?= $render_class ?> series_products_tiles fixed-grid has-<?= $c0 ?>-cols-mobile has-<?= $c1 ?>-cols-tablet has-<?= $c2 ?>-cols-desktop <?= htmlspecialchars($country) ?> <?= htmlspecialchars($wrapper) ?>">
            <div class="grid">
                <?php foreach ($visible as $GLOBALS['product']): ?>
                    <?php include $dir . '/inc_item_tile.php'; ?>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
    } elseif ($mode === 'table') {
        ?>
        <table class="<?= $render_class ?> series_products <?= htmlspecialchars($country) ?> <?= htmlspecialchars($wrapper) ?>">
            <tbody class="catalog__table-body">
                <?php foreach ($visible as $GLOBALS['product']): ?>
                    <?php include $dir . '/inc_item_table.php'; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php
    } else {
        ?>
        <table class="series_products <?= htmlspecialchars($wrapper) ?>">
            <tbody>
                <tr class="separator"><td colspan="2"></td></tr>
                <?php foreach ($visible as $GLOBALS['article']): ?>
                    <?php include $dir . '/inc_item_article.php'; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php
    }
}
}

ob_start();
?>
<div class="catalog_layout <?= $CL_view_class ?>">
<?php if ($CL_grouped): ?>
    <?php foreach ($CL_groups as $CL_brand_name => $CL_brand_series): ?>
        <?php if (!is_array($CL_brand_series) || empty($CL_brand_series)) { continue; } ?>
        <?php
        $CL_first = reset($CL_brand_series);
        $CL_brand_info = (isset($CL_first['brand']) && is_array($CL_first['brand'])) ? $CL_first['brand'] : array();
        ?>
        <?php if ($CL_titles && !empty($CL_brand_info)): ?>
            <div class="brand_logo_wrapper">
                <div class="brand_logo" style="background-image: url('<?= isset($CL_brand_info['preview_picture']) ? $CL_brand_info['preview_picture'] : '' ?>')"></div>
                <div class="brand_name font_md"><?= isset($CL_brand_info['name']) ? $CL_brand_info['name'] : $CL_brand_name ?></div>
            </div>
        <?php endif; ?>

        <?php foreach ($CL_brand_series as $CL_series): ?>
            <?php
            if (!isset($CL_series['products']) || !is_array($CL_series['products']) || count($CL_series['products']) == 0) { continue; }

            $GLOBALS['cl_preview_fields'] = array();
            if (!empty($CL_series['set_of_preview_fields'])) {
                foreach (explode(',', trim($CL_series['set_of_preview_fields'], ', ')) as $CL_code) {
                    $CL_code = trim($CL_code);
                    if ($CL_code === '') { continue; }
                    $CL_meta = isset($CL_pfmap[$CL_code]) ? $CL_pfmap[$CL_code] : array();
                    $GLOBALS['cl_preview_fields'][] = array(
                        'code'       => $CL_code,
                        'name_short' => isset($CL_meta['name_short']) ? $CL_meta['name_short'] : $CL_code,
                        'units'      => isset($CL_meta['units']) ? $CL_meta['units'] : '',
                    );
                }
            }
            ?>
            <?php if ($CL_titles && !empty($CL_series['name_russian'])): ?>
                <div class="series_title"><?= $CL_series['name_russian'] ?></div>
            <?php endif; ?>
            <?php cl_render_list($CL_series['products'], $CL_mode, $CL_render_class, $userCountry, $CL_wrapper, $CL_c0, $CL_c1, $CL_c2, $CL_here); ?>
        <?php endforeach; ?>
    <?php endforeach; ?>
<?php else: ?>
    <?php cl_render_list($CL_items, $CL_mode, $CL_render_class, $userCountry, $CL_wrapper, $CL_c0, $CL_c1, $CL_c2, $CL_here); ?>
<?php endif; ?>
</div>
<?php
$CL_html = ob_get_clean();

if ($CL_return) { return $CL_html; }
echo $CL_html;