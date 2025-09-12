<?php

// включать тут  D:\1PROJECTS\rusavto.moisait.net\rusavto\config.php



if (EX != "_") {

    $url = $_SERVER['REQUEST_URI'];

    $url = explode('?', $url);

    if (isset($url[1])) $get_params = "?" . $url[1];

    else $get_params = "";

    $url = $url[0];





// статические страницы

    $ar_links_to_redirect = [

        '/weintek_/' => '/weintek/',

        '/ifc_/' => '/ifc/',

        '/aplex_/' => '/aplex/',

        '/samkoon_/' => '/samkoon/',

        '/ewon_/' => '/ewon/',

        '/faraday_/' => '/faraday/',

        '/about.php' => '/about/',

        '/advanced_search.php' => '/catalog/',

        '/antikrizisnoe-predlozhenie.php' => '/discounted/',

        '/sertificates.php' => '/sertificates/',

        '/support.php' => '/support/',

        '/search/' => '/catalog/search/' . $get_params,

        '/oformit_zakaz.php' => '/catalog/cart/',

        '/comparison.php' => '/catalog/compare/',

        '/payment-shipping.php' => '/payment-shipping/',

        '/download.php' => '/download/',

        '/contacts.php' => '/contacts/',

        '/accessories/' => '/catalog/accessories/',

        '/bloki-pitaniya/faraday/' => '/catalog/power_supplies/',

        '/plc/yottacontrol/' => '/weintek/cMT-CTRL01/',

        '/monitors/' => '/catalog/industrial_monitors/',

        '/weintek/series_MT8000iP.php' => '/catalog/operator_panels/?&series=iP',

        '/weintek/series_MT8000iE.php' => '/catalog/operator_panels/?&series=MT8000iE',

        '/weintek/series_MT8000XE.php' => '/catalog/operator_panels/?&series=MT8000XE',

        '/weintek/cmt-x.php' => '/catalog/operator_panels/?&series=cMT-X',

        '/weintek/CloudHMI.php' => '/catalog/operator_panels/?&series=cMT',

        '/weintek/series_eMT3000.php' => '/catalog/operator_panels/?&series=eMT3000',

        '/weintek/mTV-100.php' => '/weintek/mTV-100/',

        '/accessories/license/easyaccess/' => '/accessories/easyaccess/',

        '/weintek-stavnenie-seriy.php' => '/weintek-stavnenie-seriy/',

        '/panelnie-computery/ifc/' => '/catalog/panel_computers/?&brand=ifc',

        '/accessories/antennae/termit-antenna-pin-sma/' => '/accessories/termit-antenna-pin-sma/',

        '/vstraivaemye-kompyutery/' => '/catalog/embedded_computers/',

        '/panelnie-computery/aplex/' => '/catalog/panel_computers/?&brand=aplex',

        '/promyshlennye-kompyutery-box-pc/' => '/catalog/embedded_computers/',

        '/weintek/series_MT8000i.php' => '/catalog/operator_panels/?&series=iP',

        '/paneli-operatora/' => '/catalog/operator_panels/',

        '/sborka-electro-shkafov.php/' => '/'




        //





    ];

    if (isset($ar_links_to_redirect[$url])) {

        $new_url = $ar_links_to_redirect[$url];

        header("Location: https://" . $_SERVER['HTTP_HOST'] . $new_url, true, 301);

        exit();

    }

// динамические страницы с .php

    $ar_links_to_redirect = [

        ['brand' => 'weintek', 'reg' => '/^\/weintek\/.*\.php$/'],

        ['brand' => 'weintek', 'reg' => '/^\/plc\/weintek\/.*\.php$/'],

        ['brand' => 'samkoon', 'reg' => '/^\/samkoon\/.*\.php$/'],

        ['brand' => 'ifc', 'reg' => '/^\/panelnie-computery\/ifc\/.*\.php$/'],

        ['brand' => 'ifc', 'reg' => '/^\/promyshlennye-kompyutery-box-pc\/.*\.php$/'],

        ['brand' => 'aplex', 'reg' => '/^\/panelnie-computery\/aplex\/.*\.php$/'],

        ['brand' => 'ewon', 'reg' => '/^\/ewon\/.*\.php$/'],

        ['brand' => 'faraday', 'reg' => '/^\/bloki-pitaniya\/faraday\/.*\.php$/'],

        ['brand' => 'ifc', 'reg' => '/^\/monitors\/.*\.php$/'],



    ];

    foreach ($ar_links_to_redirect as $item) {

        if (preg_match($item['reg'], $url)) {

            $pos = strpos($item['reg'], ".*");

            if ($pos !== false) {

                $first_part = substr($item['reg'], 1, $pos - 1);

                $model = preg_replace("/{$first_part}/", '', $url);

                $model = preg_replace("/\.php/", '', $model);

                $new_url = "/{$item['brand']}/$model/";



            }

            header("Location: https://" . $_SERVER['HTTP_HOST'] . $new_url, true, 301);

            exit();

        }

    }



// динамические страницы с /

    $ar_links_to_redirect = [

        ['brand' => 'aplex', 'reg' => '/^\/monitors\/aplex\/ADP\/.*\/$/'],

        ['brand' => 'aplex', 'reg' => '/^\/vstraivaemye-kompyutery\/aplex\/ACS\/.*\/$/'],

        ['brand' => 'accessories', 'reg' => '/^\/accessories\/HF\/.*/'],

        ['brand' => 'accessories', 'reg' => '/^\/accessories\/audiomodule\/.*/'],

        ['brand' => 'accessories', 'reg' => '/^\/accessories\/wifi\/.*/'],

        ['brand' => 'accessories', 'reg' => '/^\/routers\/md\/4G\/.*/'],

        ['brand' => 'accessories', 'reg' => '/^\/accessories\/antennae\/.*/'],

        ['brand' => 'accessories', 'reg' => '/^\/accessories\/license\/.*/'],

        ['brand' => 'accessories', 'reg' => '/^\/accessories_\/.*\/$/'],

        ['brand' => 'weintek', 'reg' => '/^\/weintek_\/.*\/$/'],

        ['brand' => 'ifc', 'reg' => '/^\/ifc_\/.*\/$/'],

        ['brand' => 'aplex', 'reg' => '/^\/aplex_\/.*\/$/'],

        ['brand' => 'samkoon', 'reg' => '/^\/samkoon_\/.*\/$/'],

        ['brand' => 'ewon', 'reg' => '/^\/ewon_\/.*\/$/'],

        ['brand' => 'faraday', 'reg' => '/^\/faraday_\/.*\/$/'],

    ];

    foreach ($ar_links_to_redirect as $item) {

        if (preg_match($item['reg'], $url)) {

            $pos = strpos($item['reg'], ".*");

            if ($pos !== false) {

                $first_part = substr($item['reg'], 1, $pos - 1);

                $model = preg_replace("/{$first_part}/", '', $url);

                $new_url = "/{$item['brand']}/$model";

            }

            header("Location: https://" . $_SERVER['HTTP_HOST'] . $new_url, true, 301);

            exit();

        }

    }





}