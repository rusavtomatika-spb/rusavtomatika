<?php
if (!defined('EX')) {
    define('EX', '');
}
if (EX === '_') {
    return;
}

$requestParts = explode('?', $_SERVER['REQUEST_URI'], 2);
$url          = $requestParts[0];
$queryString  = isset($requestParts[1]) ? '?' . $requestParts[1] : '';
$host         = $_SERVER['HTTP_HOST'];

$staticRedirects = [
    '/weintek_/'   => '/weintek/',
    '/ifc_/'       => '/ifc/',
    '/aplex_/'     => '/aplex/',
    '/samkoon_/'   => '/samkoon/',
    '/ewon_/'      => '/ewon/',
    '/faraday_/'   => '/faraday/',
    '/about.php'                      => '/about/',
    '/advanced_search.php'            => '/catalog/',
    '/antikrizisnoe-predlozhenie.php' => '/discounted/',
    '/sertificates.php'               => '/sertificates/',
    '/support.php'                    => '/support/',
    '/oformit_zakaz.php'              => '/catalog/cart/',
    '/comparison.php'                 => '/catalog/compare/',
    '/payment-shipping.php'           => '/payment-shipping/',
    '/download.php'                   => '/download/',
    '/contacts.php'                   => '/contacts/',
    '/weintek-stavnenie-seriy.php'    => '/weintek-stavnenie-seriy/',
    '/search/' => '/catalog/search/' . $queryString,
    '/accessories/'             => '/catalog/accessories/',
    '/bloki-pitaniya/faraday/'  => '/catalog/power_supplies/',
    '/monitors/'                => '/catalog/industrial_monitors/',
    '/vstraivaemye-kompyutery/' => '/catalog/embedded_computers/',
    '/paneli-operatora/'        => '/catalog/operator_panels/',
    '/promyshlennye-kompyutery-box-pc/' => '/catalog/embedded_computers/',
    '/plc/yottacontrol/' => '/weintek/cMT-CTRL01/',
    '/weintek/series_MT8000iP.php' => '/catalog/operator_panels/?&series=iP',
    '/weintek/series_MT8000iE.php' => '/catalog/operator_panels/?&series=MT8000iE',
    '/weintek/series_MT8000XE.php' => '/catalog/operator_panels/?&series=MT8000XE',
    '/weintek/series_MT8000i.php'  => '/catalog/operator_panels/?&series=iP',
    '/weintek/series_eMT3000.php'  => '/catalog/operator_panels/?&series=eMT3000',
    '/weintek/cmt-x.php'           => '/catalog/operator_panels/?&series=cMT-X',
    '/weintek/CloudHMI.php'        => '/catalog/operator_panels/?&series=cMT',
    '/weintek/mTV-100.php'         => '/weintek/mTV-100/',
    '/accessories/license/easyaccess/'              => '/accessories/easyaccess/',
    '/accessories/antennae/termit-antenna-pin-sma/' => '/accessories/termit-antenna-pin-sma/',
    '/panelnie-computery/ifc/'   => '/catalog/panel_computers/?&brand=ifc',
    '/panelnie-computery/aplex/' => '/catalog/panel_computers/?&brand=aplex',
    '/sborka-electro-shkafov.php' => '/',
];

if (isset($staticRedirects[$url])) {
    header('Location: https://' . $host . $staticRedirects[$url], true, 301);
    exit();
}

$dynamicRules = [
    ['brand' => 'weintek', 'prefix' => '/weintek/',                    'suffix' => '.php'],
    ['brand' => 'weintek', 'prefix' => '/plc/weintek/',                'suffix' => '.php'],
    ['brand' => 'samkoon', 'prefix' => '/samkoon/',                    'suffix' => '.php'],
    ['brand' => 'ifc',     'prefix' => '/panelnie-computery/ifc/',     'suffix' => '.php'],
    ['brand' => 'ifc',     'prefix' => '/promyshlennye-kompyutery-box-pc/', 'suffix' => '.php'],
    ['brand' => 'aplex',   'prefix' => '/panelnie-computery/aplex/',   'suffix' => '.php'],
    ['brand' => 'ewon',    'prefix' => '/ewon/',                       'suffix' => '.php'],
    ['brand' => 'faraday', 'prefix' => '/bloki-pitaniya/faraday/',     'suffix' => '.php'],
    ['brand' => 'ifc',     'prefix' => '/monitors/',                   'suffix' => '.php'],

    ['brand' => 'aplex',       'prefix' => '/monitors/aplex/ADP/'],
    ['brand' => 'aplex',       'prefix' => '/vstraivaemye-kompyutery/aplex/ACS/'],
    ['brand' => 'accessories', 'prefix' => '/accessories/HF/'],
    ['brand' => 'accessories', 'prefix' => '/accessories/audiomodule/'],
    ['brand' => 'accessories', 'prefix' => '/accessories/wifi/'],
    ['brand' => 'accessories', 'prefix' => '/routers/md/4G/'],
    ['brand' => 'accessories', 'prefix' => '/accessories/antennae/'],
    ['brand' => 'accessories', 'prefix' => '/accessories/license/'],
    ['brand' => 'accessories', 'prefix' => '/accessories_/'],
    ['brand' => 'weintek',     'prefix' => '/weintek_/'],
    ['brand' => 'ifc',         'prefix' => '/ifc_/'],
    ['brand' => 'aplex',       'prefix' => '/aplex_/'],
    ['brand' => 'samkoon',     'prefix' => '/samkoon_/'],
    ['brand' => 'ewon',        'prefix' => '/ewon_/'],
    ['brand' => 'faraday',     'prefix' => '/faraday_/'],
];

foreach ($dynamicRules as $rule) {
    $prefix = $rule['prefix'];

    if (strpos($url, $prefix) !== 0) {
        continue;
    }

    $model = substr($url, strlen($prefix));
    if ($model === '' || $model === false) {
        continue;
    }

    if (!empty($rule['suffix'])) {
        $s = $rule['suffix'];
        if (substr($model, -strlen($s)) === $s) {
            $model = substr($model, 0, -strlen($s));
        }
    }

    if ($model === '' || $model === false) {
        continue;
    }

    $trailingSlash = !empty($rule['suffix']) ? '/' : '';
    $newUrl = '/' . $rule['brand'] . '/' . $model . $trailingSlash;

    header('Location: https://' . $host . $newUrl, true, 301);
    exit();
}