<?php
global $product, $arr_catalog_types;

if (!isset($product) || !is_array($product)) { return; }

if (empty($product['model_fullname'])) {

    if (!isset($arr_catalog_types) || !is_array($arr_catalog_types)) {
        $arr_catalog_types = array();
    }

    if (empty($arr_catalog_types) && class_exists('CoreApplication')) {
        $__types = CoreApplication::get_rows_from_table('catalog_types', '', '');
        if (is_array($__types)) {
            foreach ($__types as $__t) {
                $arr_catalog_types[$__t['code'] . $__t['series']] = $__t['template_h1'];
            }
        }
    }

    $__type   = isset($product['type']) ? $product['type'] : '';
    $__series = isset($product['series']) ? $product['series'] : '';
    $__key    = $__type . $__series;

    if (isset($arr_catalog_types[$__key]) && $arr_catalog_types[$__key] != '') {
        $__name = str_replace(
            array('#brand#', '#model#'),
            array(
                isset($product['brand']) ? $product['brand'] : '',
                isset($product['model']) ? $product['model'] : ''
            ),
            $arr_catalog_types[$__key]
        );
        $__diag = '';
        if (isset($product['diagonal']) && $product['diagonal'] > 0
            && (!isset($product['diagonal_hide']) || $product['diagonal_hide'] != '1')) {
            $__diag = str_replace('.0', '', $product['diagonal']);
        }
        $product['model_fullname'] = str_replace('#diagonal#', $__diag, $__name);
    }
}

$cl_defaults = array(
    'model' => '', 'brand' => '', 'type' => '', 'series' => '',
    'short_name' => '', 'preview_text' => '', 'preview_text_extra' => '',
    'codesys' => 'N', 'currency' => '', 'date_pub' => '',
    'retail_price' => 0, 'retail_price_hide' => 0, 'action_price' => 0,
    'show_rub_po_kursu_usd' => 0, 'onstock_spb' => 0, 'screenless' => 0,
    'diagonal' => '', 'diagonal_hide' => 0, 'freqs' => 0, 'link_detail_page' => '',
);
foreach ($cl_defaults as $cl_k => $cl_v) {
    if (!isset($product[$cl_k])) { $product[$cl_k] = $cl_v; }
}