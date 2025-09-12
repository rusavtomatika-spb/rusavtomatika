<?php

// включать тут  D:\1PROJECTS\rusavto.moisait.net\rusavto\config.php



if (EX != "_") {

    $url = $url2 = $_SERVER['REQUEST_URI'];

    $url = explode('&', $url);

    if (isset($url[1])) $get_params = "?" . $url[1];

    else $get_params = "";

    $url = $url[0];




// статические страницы

    $ar_links_to_redirect = [

        '/smatipc/IEXP-302/' => '/ifc/IFC-BOX-NS11/',
        '/smatipc/IEXP-304/' => '/ifc/IFC-BOX-NS31/',
        '/smatipc/IEXP-322/' => '/ifc/IFC-BOX-NS32/',
        '/smatipc/IEXP-332/' => '/ifc/IFC-BOX-NS33/',
        '/smatipc/IEXP-332-B/' => '/ifc/IFC-BOX-NS15/',
        '/smatipc/IEXP-502/' => '/ifc/IFC-BOX-NS51/',
        '/smatipc/IEXP-504/' => '/ifc/IFC-BOX-NS52/',
        '/smatipc/IEXP-512/' => '/ifc/IFC-BOX-NS53/',
        '/smatipc/IEXP-522/' => '/ifc/IFC-BOX-NS54/',
        '/smatipc/IEXP-732/' => '/ifc/IFC-BOX-NS71/',
		
		'/ifc/IFC-BOX-NS12/' => '/ifc/IFC-BOX-NS31/',
        '/ifc/IFC-BOX-NS13/' => '/ifc/IFC-BOX-NS32/',
        '/ifc/IFC-BOX-NS14/' => '/ifc/IFC-BOX-NS33/',
        '/ifc/IFC-BOX-NS75/' => '/ifc/IFC-BOX-NS71/',

        '/weintek/iR-DQ8-R/' => '/weintek/iR-DQ08-R/',
		
        '/catalog/operator_panels/?&screenless=yes' => '/catalog/operator_panels/?&brand=Weintek&screenless=yes',
		
        '/weintek_/' => '/weintek/',

        '/ifc_/' => '/ifc/',

        '/aplex_/' => '/aplex/',

        '/samkoon_/' => '/samkoon/',

        '/ewon_/' => '/ewon/',

        '/faraday_/' => '/faraday/',

        '/about.php' => '/about/',

        '/advanced_search.php' => '/catalog/',

        '/antikrizisnoe-predlozhenie.php' => '/discounted/',

        '/sertificates.php' => '/certificates/',

        '/sertificates/' => '/certificates/',

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

        '/gateways/' => '/catalog/gateways/',

        '/plc/haiwell/communication-plc-expansion/pc2zb/' => '/weintek/cMT-CTRL01/',

        '/plc/haiwell/' => '/weintek/cMT-CTRL01/',

        '/plc/yottacontrol/A-3288.php' => '/404.php',

        '/plc/weintek/' => '/catalog/modules_io/',

        '/discounted_/' => '/discounted/',

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

        '/modules/EBM-B.php' => '/catalog/modules_io/',

        '/modules/CPM-C.php' => '/catalog/modules_io/',

        '/cincoze/' => '/articles/promyshlennye-kompyutery/',

        '/cincoze/CV-108-P1001.php' => '/catalog/panel_computers/',

        '/cincoze/CV-110-P1001.php' => '/catalog/panel_computers/',

        '/cincoze/CV-112-P1001.php' => '/catalog/panel_computers/',

        '/cincoze/CV-112H-P1001.php' => '/catalog/panel_computers/',

        '/cincoze/CV-115-P1001.php' => '/catalog/panel_computers/',

        '/cincoze/CV-W115-P1001.php' => '/catalog/panel_computers/',

        '/cincoze/CV-117-P1001.php' => '/catalog/panel_computers/',

        '/cincoze/CV-119-P1001.php' => '/catalog/panel_computers/',

        '/cincoze/CV-112-P2002.php' => '/catalog/panel_computers/',

        '/cincoze/CV-112-P2002E.php' => '/catalog/panel_computers/',

        '/cincoze/CV-112H-P2002.php' => '/catalog/panel_computers/',

        '/cincoze/CV-112H-P2002E.php' => '/catalog/panel_computers/',

        '/cincoze/CV-115-P2002.php' => '/catalog/panel_computers/',

        '/cincoze/CV-115-P2002E.php' => '/catalog/panel_computers/',

        '/cincoze/CV-W115-P2002.php' => '/catalog/panel_computers/',

        '/cincoze/CV-W115-P2002E.php' => '/catalog/panel_computers/',

        '/cincoze/CV-117-P2002.php' => '/catalog/panel_computers/',

        '/cincoze/CV-117-P2002E.php' => '/catalog/panel_computers/',

        '/cincoze/CV-119-P2002.php' => '/catalog/panel_computers/',

        '/cincoze/CV-119-P2002E.php' => '/catalog/panel_computers/',

        '/cincoze/CV-W121-P2002.php' => '/catalog/panel_computers/',

        '/cincoze/CV-W121-P2002E.php' => '/catalog/panel_computers/',

        '/cincoze/DA-1000.php' => '/catalog/embedded_computers/',

        '/cincoze/DC-1100.php' => '/catalog/embedded_computers/',

        '/cincoze/DS-1000.php' => '/catalog/embedded_computers/',

        '/cincoze/DS-1002.php' => '/catalog/embedded_computers/',

        '/cincoze/CV-108-M1001.php' => '/catalog/industrial_monitors/',

        '/cincoze/CV-110-M1001.php' => '/catalog/industrial_monitors/',

        '/cincoze/CV-112-M1001.php' => '/catalog/industrial_monitors/',

        '/cincoze/CV-115-M1001.php' => '/catalog/industrial_monitors/',

        '/cincoze/CV-W115-M1001.php' => '/catalog/industrial_monitors/',

        '/cincoze/CV-117-M1001.php' => '/catalog/industrial_monitors/',

        '/cincoze/CV-119-M1001.php' => '/catalog/industrial_monitors/',
        '/news/cmt3161x-novaya-panel-operatora-ot-kompanii-weintek/' => '/news/cmt2166x-novaya-panel-operatora-ot-kompanii-weintek/',

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

        ['brand' => 'aplex', 'reg' => '/^\/vstraivaemye-kompyutery\/aplex\/.*\.php$/'],

        ['brand' => 'ewon', 'reg' => '/^\/ewon\/.*\.php$/'],

        ['brand' => 'faraday', 'reg' => '/^\/bloki-pitaniya\/faraday\/.*\.php$/'],

        //['brand' => 'aplex', 'reg' => '/^\/monitors\/aplex\/.*\.php$/'],

        //['brand' => 'ifc', 'reg' => '/^\/monitors\/ifc\/.*\.php$/'],

        //['brand' => 'ifc', 'reg' => '/^\/.*\/ifc\/.*\.php$/'],

        //'/monitors/.*' => '/catalog/industrial_monitors/',

        ['brand' => 'catalog/industrial_monitors', 'reg' => '/^\/monitors\/.*\/$/'],



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

        ['brand' => 'aplex', 'reg' => '/^\/monitors\/aplex\/.*\/$/'],

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

        ['brand' => 'articles', 'reg' => '/^\/articles_\/.*\/$/'],

        ['brand' => 'video', 'reg' => '/^\/video_\/.*\/$/'],

        ['brand' => 'news', 'reg' => '/^\/news_\/.*\/$/'],

        ['brand' => 'discounted', 'reg' => '/^\/discounted_\/.*\/$/'],

        ['brand' => 'documents', 'reg' => '/^\/documents_\/.*\/$/'],

        ['brand' => 'weintek_librares', 'reg' => '/^\/weintek_librares_\/.*\/$/'],

        ['brand' => 'weintek_drivers', 'reg' => '/^\/weintek_drivers_\/.*\/$/'],

        ['brand' => 'weintek_drivers_brands', 'reg' => '/^\/weintek_drivers_brands_\/.*\/$/'],

        ['brand' => 'weintek_projects', 'reg' => '/^\/weintek_projects_\/.*\/$/'],

        ['brand' => 'aplex', 'reg' => '/^\/aplex\/ACS\/.*\/$/'],
        ['brand' => 'catalog/embedded_computers', 'reg' => '/brand=smatipc$/'],

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