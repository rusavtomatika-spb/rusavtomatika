<?php
if (!function_exists('cl_get_all_series')) {
    function cl_get_all_series()
    {
        static $cache = null;
        if ($cache !== null) { return $cache; }

        $cache = array();

        if (function_exists('get_all_series')) {
            $rows = get_all_series();
            if (is_array($rows)) { $cache = $rows; return $cache; }
        }

        if (!class_exists('CoreApplication')) { return $cache; }

        $rows = CoreApplication::get_rows_from_table('catalog_series', '', "active = '1'", 'position');
        if (is_array($rows)) { $cache = $rows; }
        return $cache;
    }
}

if (!function_exists('cl_new_label')) {
    function cl_new_label($date_pub, $months = 12)
    {
        if (function_exists('renderNewLabel')) {
            return renderNewLabel($date_pub, $months);
        }
        $date_pub = trim((string)$date_pub);
        if ($date_pub === '') { return ''; }

        if (preg_match('/^(\d{2})-(\d{2})-(\d{4})$/', $date_pub, $m)) {
            $ts = mktime(0, 0, 0, (int)$m[2], (int)$m[1], (int)$m[3]);
        } else {
            $ts = strtotime($date_pub);
        }
        if (!$ts) { return ''; }

        return ($ts > strtotime('-' . (int)$months . ' months'))
            ? '<span class="new_plate">Новинка</span>'
            : '';
    }
}

if (!function_exists('cl_product_image')) {
    function cl_product_image($product)
    {
        global $arSettings;

        $base = !empty($arSettings['path_to_product_images']) ? $arSettings['path_to_product_images'] : '/images/';
        $model = isset($product['model']) ? $product['model'] : '';
        if (isset($product['brand']) && $product['brand'] === 'Faraday') {
            $model = str_replace(array('/', ' '), '_', $model);
        }

        $src = $base
            . mb_strtolower(isset($product['brand']) ? $product['brand'] : '') . '/'
            . mb_strtolower(isset($product['type']) ? $product['type'] : '') . '/'
            . $model . '/580/' . $model . '_1.webp';

        if (isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] === 'www.rusavtomatika.com') {
            $src = '/upload_files' . $src;
        }
        return $src;
    }
}

if (!function_exists('cl_product_link')) {
    function cl_product_link($product)
    {
        if (!empty($product['link_detail_page'])) { return $product['link_detail_page']; }
        $brand = isset($product['brand']) ? $product['brand'] : '';
        $model = isset($product['model']) ? $product['model'] : '';
        if ($brand === '' || $model === '') { return '#'; }
        return '/' . strtolower($brand) . '/' . $model . '/';
    }
}

if (!function_exists('cl_price_html')) {
    function cl_price_html($product)
    {
        global $usd_currency;

        $model        = isset($product['model']) ? $product['model'] : '';
        $retail_price = isset($product['retail_price']) ? $product['retail_price'] : 0;
        $price_hide   = isset($product['retail_price_hide']) ? $product['retail_price_hide'] : 0;
        $action_price = isset($product['action_price']) ? $product['action_price'] : 0;
        $currency     = isset($product['currency']) ? $product['currency'] : '';
        $show_rub     = isset($product['show_rub_po_kursu_usd']) ? intval($product['show_rub_po_kursu_usd']) : 0;

        $html = '';

        if (intval($retail_price) > 0 && $price_hide == 0 && $model !== 'IFC-M-Series') {
            switch ($currency) {
                case 'USD':
                    $html .= '<div class="price_row">';
                    if ($action_price > 0) {
                        $html .= '<span class="act_price">' . $action_price . ' $</span>';
                    }
                    $html .= '<span class="usd_price">' . $retail_price . ' $</span></div>';
                    if ($usd_currency && $show_rub !== 1) {
                        $html .= '<span class="rub_price">' . intval($retail_price * $usd_currency) . ' &#8381;</span>';
                    }
                    break;

                case 'RUR':
                    $html .= '<div class="price_row">';
                    if ($action_price > 0) {
                        $html .= '<span class="act_price green">' . $action_price . ' &#8381;</span>';
                    }
                    if ($usd_currency) {
                        $html .= '<span class="usd_price green">' . intval($retail_price / $usd_currency) . ' $</span>';
                    }
                    $html .= '</div><span class="rub_price green">' . intval($retail_price) . ' &#8381;</span>';
                    break;
            }
        } else {
            $html .= '<button class="series_products__button active" data-rel-model="'
                . htmlspecialchars($model, ENT_QUOTES, 'UTF-8')
                . '" @click="open_form_require_price"><i class="fa-solid fa-comment-dollar"></i> Запрос цены</button>';
            if (isset($_COOKIE['dev_mode']) && $_COOKIE['dev_mode'] > 0) {
                $html .= '<span class="show_in_dev_mode">' . $retail_price . '</span>';
            }
        }
        return $html;
    }
}

if (!function_exists('cl_series_tags')) {
    function cl_series_tags($product, $all_series)
    {
        if (empty($product['series']) || !is_array($all_series)) { return ''; }

        $prod_series = explode(',', $product['series']);
        $type        = isset($product['type']) ? $product['type'] : '';
        $pattern     = '/[^_,\w]*' . preg_quote($type, '/') . '[^_,\w]*/im';

        $html = '';
        $prev_ser = '';
        foreach ($prod_series as $serie) {
            foreach ($all_series as $all_serie) {
                if (
                    $all_serie['name'] !== 'INDUSTRIAL'
                    && $all_serie['name'] !== $prev_ser
                    && $all_serie['name'] === $serie
                    && preg_match($pattern, $all_serie['type'])
                ) {
                    $html .= '<a class="tag mr-1" href="/catalog/' . $all_serie['menu_category_item_code']
                        . '/?&series=' . $all_serie['name'] . '">' . $all_serie['name'] . '</a>';
                }
                $prev_ser = $all_serie['name'];
            }
        }
        return $html;
    }
}

if (!function_exists('cl_brand_tag')) {
    function cl_brand_tag($brand)
    {
        $linked = array('Weintek', 'IFC', 'Aplex', 'Spiktek', 'Samkoon', 'eWON', 'Faraday', 'LicOS');
        return in_array($brand, $linked)
            ? '<a class="tag" href="/' . strtolower($brand) . '/">' . $brand . '</a>'
            : '<span class="tag">' . $brand . '</span>';
    }
}

if (!function_exists('cl_brand_plate')) {
    function cl_brand_plate($brand)
    {
        $linked = array('Weintek', 'IFC', 'Aplex', 'Spiktek', 'Samkoon', 'eWON', 'Faraday');
        return in_array($brand, $linked)
            ? '<a class="brand_plate" href="/' . strtolower($brand) . '/">' . $brand . '</a>'
            : '<span class="brand_plate">' . $brand . '</span>';
    }
}

if (!function_exists('cl_skip_product')) {
    function cl_skip_product($product, $userCountry)
    {
        if (!is_array($product)) { return true; }

        if (isset($product['model']) && $product['model'] === 'Codesys' && $userCountry !== 'RU') {
            return true;
        }
        $qs = isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : '';
        if (
            preg_match('/(operator_panels)/i', $qs)
            && !preg_match('/(screenless)/i', $qs)
            && isset($product['screenless']) && $product['screenless'] == 1
            && !preg_match('/(series)/i', $qs)
        ) {
            return true;
        }
        return false;
    }
}

if (!function_exists('cl_short_description')) {
    function cl_short_description($product, $fields)
    {
        if (!is_array($fields) || empty($fields)) { return ''; }
        $parts = array();
        foreach ($fields as $field) {
            $code = $field['code'];
            if (isset($product[$code]) && $product[$code] != '') {
                $parts[] = '<span class="name_short">' . $field['name_short'] . ':</span>&nbsp;'
                    . $product[$code] . $field['units'];
            }
        }
        return implode(', ', $parts);
    }
}