<?php
//include_once $_SERVER['DOCUMENT_ROOT'] . "/sc/lib_new_includes/functions_you_watched_panel.php";
function temp00($name) {  // UTF8
    ?>
    <!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html>
        <head>
            <link rel="stylesheet" type="text/css" href="/css/ra.css?31012020" />
            <link rel="stylesheet" type="text/css" href="/css/menu4.css<?php echo version('/css/menu4.css'); ?>" />
            <link rel="stylesheet" type="text/css" href="/css/tabs.css<?php echo version('/css/tabs.css'); ?>" />
            <link rel="stylesheet" type="text/css" href="/css/button.css<?php echo version('/css/button.css'); ?>" />
            <link rel="stylesheet" type="text/css" href="/css/tango/skin.css<?php echo version('/css/tango/skin.css'); ?>" />


            <meta http-equiv=Content-Type content=text/html; charset=utf-8>
                <title>dialog demo</title>
                <link rel="stylesheet" href="/css/jquery-ui-smoothness.css<?php echo version('/css/jquery-ui-smoothness.css'); ?>">
                    <link rel="stylesheet" href="/css/jquery-ui-base.css<?php echo version('/css/jquery-ui-base.css'); ?>" />
                    <script src="/js/jquery-1.10.2.js<?php echo version('/js/jquery-1.10.2.js'); ?>"></script>
                    <script src="/js/jquery-ui.js<?php echo version('/js/jquery-ui.js'); ?>"></script>
                    <script type="text/javascript" src="/js/jquery.cookie.js<?php echo version('/js/jquery.cookie.js'); ?>"></script>
                    <script type="text/javascript" src="/js/jquery.jcarousel.js<?php echo version('/js/jquery.jcarousel.js'); ?>"></script>
                    <script type="text/javascript" src="/js/ra_scripts.js<?php echo version('/js/ra_scripts.js'); ?>"></script>
                    <!--script type="text/javascript" src="/js/s.js"></script-->
                    <script type="text/javascript" src="/js/jquery.maskedinput.js<?php echo version('/js/jquery.maskedinput.js'); ?>"></script>
                    <script src="/js/search.js<?php echo version('/js/search.js'); ?>"></script>
<link rel="stylesheet" type="text/css" href="/css/styles_of_george_martin.css" />
<link rel="stylesheet" type="text/css" href="/css/styles_of_victor_pelevin.css" />
                    </head>
                    <body>





                        <noscript>
                            This page needs JavaScript activated to work.<br>
                                Пожалуйста, включите Javascript чтобы просмотреть эту страницу

                                <style>div { display:none; }</style>
                        </noscript>


                        <div id='body_cont' >
                            <? include $_SERVER["DOCUMENT_ROOT"] . "/include/header_menu.php"; ?>
                            <table width=100% bgcolor=white><tr><td width=300px>
                                        <a href="/"><img src=/images/logo2017.png style="cursor: pointer;" /></a>
                                    </td>
                                    <td> </td>
                                </tr>
                            </table>

                            <?
                            if ($name == 'new') {
                                $c = 1;
                            } else {
                                $c = '';
                            };
                            top_menu($c);

                            //usd_rate();
                            search();
                            compare();
                        }


function get_extra_openGraph(){

     global $extra_openGraph;

                            $extra_openGraph_out = "";
        if (isset($extra_openGraph) and $extra_openGraph != ''){
            foreach ($extra_openGraph as $paramName => $paramValue) {
                switch ($paramName) {
                    case "openGraph_image":
                        $extra_openGraph_out .= "<meta property='og:image' content='" . $paramValue . "'/>" ;
                        $extra_openGraph_out .= '
                        ';
                        $extra_openGraph_out .= "<link rel='image_src' href='" . $paramValue . "'>";
                        $extra_openGraph_out .= '
                        ';
                        break;
                    case "openGraph_title":
                        $extra_openGraph_out .= "<meta property='og:title' content='" . $paramValue . "'/>" ;
                        $extra_openGraph_out .= '
                        ';
                        break;
                    case "openGraph_siteName":
                        $extra_openGraph_out .= "<meta property='og:site_name' content='" . $paramValue . "'/>";
                        $extra_openGraph_out .= '
                        ';
                        break;
                }
            }
        }
        return $extra_openGraph_out;
                        }

                        function head($template_file, $title, $description, $keywords, $styles = "", $scripts = "") {
                            
                            $head = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/sc/" . $template_file);
                            preg_match_all('/(href|src)=\"(\/.*?\.(css|js))\"/i', $head, $matches, PREG_PATTERN_ORDER);
                            foreach ($matches[2] as $key => $value) {
                                $head = str_replace($value, $value . version($value), $head);
                            }
  global $extra_openGraph;
                            
                            $extra_openGraph_out = "";
        if (isset($extra_openGraph) and $extra_openGraph != ''){
            foreach ($extra_openGraph as $paramName => $paramValue) {
                switch ($paramName) {
                    case "openGraph_image":
                        $extra_openGraph_out .= "<meta property='og:image' content='" . $paramValue . "'/>" ;
                        $extra_openGraph_out .= '
                        ';
                        $extra_openGraph_out .= "<link rel='image_src' href='" . $paramValue . "'>";
                        $extra_openGraph_out .= '
                        ';
                        break;
                    case "openGraph_title":
                        $extra_openGraph_out .= "<meta property='og:title' content='" . $paramValue . "'/>" ;
                        $extra_openGraph_out .= '
                        ';
                        break;
                    case "openGraph_siteName":
                        $extra_openGraph_out .= "<meta property='og:site_name' content='" . $paramValue . "'/>";
                        $extra_openGraph_out .= '
                        ';
                        break;
                }
            }
        }
                            $head = str_replace('[>TITLE<]', $title, $head);
                            $head = str_replace('[>DESCRIPTION<]', $description, $head);
                            $head = str_replace('[>KEYWORDS<]', $keywords, $head);
                            $head = str_replace('[>STYLES<]', $styles, $head);
                            $head = str_replace('[>SCRIPTS<]', $scripts, $head);
                            $head = str_replace('[>EXPANSIONPARAM<]', "", $head);
                            $head = str_replace('[>OPENGRAPH<]', $extra_openGraph_out, $head);


                            $mistakes = '
                    <script type="text/javascript" src="/sc/mistakes-4.1/mistakes.js"></script>
                    <link href="/sc/mistakes-4.1/mistakes.css" rel="stylesheet" type="text/css" />
';
                            $mistakes_link = '
<a class="mistakes_link" href="javascript:void(0)" onclick="PressLink()">Отправить сообщение об ошибке</a>
';
                            if ($_SERVER['HTTP_HOST'] == "www.rusavto.moisait.net") {
                                $head = str_replace('[>MISTAKES<]', $mistakes, $head);
                                $head = str_replace('[>MISTAKES_LINK<]', $mistakes_link, $head);
                            } else {
                                $head = str_replace('[>MISTAKES<]', "", $head);
                                $head = str_replace('[>MISTAKES_LINK<]', "", $head);
                            }

                            return $head;
                        }

                        function setHeaderExpansionParam($template_file, $title, $description, $keywords, $expansionParam, $styles = "", $scripts = "") {
global $extra_openGraph;
                            $extra_openGraph_out = "";
        if (isset($extra_openGraph) and $extra_openGraph != ''){
            foreach ($extra_openGraph as $paramName => $paramValue) {
                switch ($paramName) {
                    case "openGraph_image":
                        $extra_openGraph_out .= "<meta property='og:image' content='" . $paramValue . "'/>" ;
                        $extra_openGraph_out .= '
                        ';
                        $extra_openGraph_out .= "<link rel='image_src' href='" . $paramValue . "'>";
                        $extra_openGraph_out .= '
                        ';
                        break;
                    case "openGraph_title":
                        $extra_openGraph_out .= "<meta property='og:title' content='" . $paramValue . "'/>" ;
                        $extra_openGraph_out .= '
                        ';
                        break;
                    case "openGraph_siteName":
                        $extra_openGraph_out .= "<meta property='og:site_name' content='" . $paramValue . "'/>";
                        $extra_openGraph_out .= '
                        ';
                        break;
                }
            }
        }
                            $head = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/sc/" . $template_file);
                            preg_match_all('/(href|src)=\"(\/.*?\.(css|js))\"/i', $head, $matches, PREG_PATTERN_ORDER);
                            foreach ($matches[2] as $key => $value) {
                                $head = str_replace($value, $value . version($value), $head);
                            }

                            $head = str_replace('[>TITLE<]', $title, $head);
                            $head = str_replace('[>DESCRIPTION<]', $description, $head);
                            $head = str_replace('[>KEYWORDS<]', $keywords, $head);
                            $head = str_replace('[>STYLES<]', $styles, $head);
                            $head = str_replace('[>SCRIPTS<]', $scripts, $head);
                            $head = str_replace('[>EXPANSIONPARAM<]', $expansionParam, $head);
                             $head = str_replace('[>OPENGRAPH<]', $extra_openGraph_out, $head);

                            $mistakes = '
                    <script type="text/javascript" src="/sc/mistakes-4.1/mistakes.js"></script>
                    <link href="/sc/mistakes-4.1/mistakes.css" rel="stylesheet" type="text/css" />
';
                            $mistakes_link = '
<a class="mistakes_link" href="javascript:void(0)" onclick="PressLink()">Отправить сообщение об ошибке</a>
';

                            if ($_SERVER['HTTP_HOST'] == "www.rusavto.moisait.net") {
                                $head = str_replace('[>MISTAKES<]', $mistakes, $head);
                                $head = str_replace('[>MISTAKES_LINK<]', $mistakes_link, $head);
                            } else {
                                $head = str_replace('[>MISTAKES<]', "", $head);
                                $head = str_replace('[>MISTAKES_LINK<]', "", $head);
                            }

                            return $head;
                        }

                        function temp0($name) {
                            include $_SERVER['DOCUMENT_ROOT'] . "/include/template/header.php";
                            ?>
                            <body>
<?//                            include $_SERVER['DOCUMENT_ROOT'] . "/include/template/top-banner.php"; ?>
                            <?
                            if ($_SERVER['HTTP_HOST'] == "www.rusavto.moisait.net") {
                                echo '
<a class="mistakes_link" href="javascript:void(0)" onclick="PressLink()">Отправить сообщение об ошибке</a>
';
                            }
                            ?>
                                <noscript>
                                    This page needs JavaScript activated to work.<br>
                                        Пожалуйста, включите Javascript чтобы просмотреть эту страницу

                                        <style>div { display:none; }</style>
                                </noscript>

                                <!--[if IE 7]>
            
                                Вы используете устаревший браузер Internet explorer 7<br>
                                Пожалуйста, обновите браузер, чтобы просмотреть эту страницу
                                <style> div { display:none; }</style>
                                <![endif]-->

                                <!--[if IE 6]>
            
                                Вы используете устаревший браузер Internet explorer 6<br>
                                Пожалуйста, обновите браузер, чтобы просмотреть эту страницу
                                <style> div { display:none; }</style>
                                <![endif]-->


                                <div id=mes_backgr> </div>
                                <div id='body_cont'>
    <? include $_SERVER["DOCUMENT_ROOT"] . "/include/header_menu.php"; ?>
                                    <div class="block_logo"><a href="/"><img src="/images/logo2017.png" style="cursor: pointer;" /></a></div>
                                    <? /* ?><table width=100% bgcolor=white>
                                      <tr height=93>
                                      <td width=300px>

                                      </td>
                                      <td> </td>
                                      </tr>
                                      </table><? */ ?>





    <?
    if ($name == 'new' or $name == 'mainnew') {
        top_menu(1);
    } else {
        top_menu();
    };
    search();
    compare();
    backup_call();
}


function temp3($insert_scripts = '') {
    
    $RUPRODUCTS = "";
    ?>
    </td><!-- MAIN TABLE     end td right content --></tr></table><!-- end main table -->

    <? include $_SERVER['DOCUMENT_ROOT'] . "/include/template/footer.php" ?>

    </div> <!-- end main div -->


<script type="text/javascript" src="/js/vue.js"></script>
<script type="text/javascript" src="/js/axios.min.js"></script>
<script type="text/javascript" src="/js/vue-router.js"></script>
<script type="text/javascript" src="/js/vue-meta.min.js"></script>
<script type="text/javascript" src="/sc/popup_catalog_menu/popup_catalog_menu.js"></script>
<script type="text/javascript" src="/js/fancybox.umd.js"></script>

<?
global $GLOBAL_ARR_SCRIPTS_TO_FOOTER;
       if (isset($GLOBAL_ARR_SCRIPTS_TO_FOOTER) and is_array($GLOBAL_ARR_SCRIPTS_TO_FOOTER) and count($GLOBAL_ARR_SCRIPTS_TO_FOOTER) > 0) {
            echo '
                ';
            foreach ($GLOBAL_ARR_SCRIPTS_TO_FOOTER as $item) {
                echo '<script type="text/javascript" src="' . $item . '"></script>
';
            }
        }
?>

        <? if ($_SERVER['HTTP_HOST'] != "www.rusavto.moisait.net" && $_SERVER['HTTP_HOST'] != "www.rusavtomatika.valovenko.tmweb.ru"): ?>
        <script src="//code.jivosite.com/widget.js" data-jv-id="gno75izSm3" async></script>
        <?/*?>
        <!-- BEGIN JIVOSITE CODE {literal} -->
        <script type="text/javascript">
            (function () {
                var widget_id = '9991';
                var s = document.createElement('script');
                s.type = 'text/javascript';
                s.async = true;
                s.src = '//code.jivosite.ru/script/widget/' + widget_id;
                var ss = document.getElementsByTagName('script')[0];
                ss.parentNode.insertBefore(s, ss);
            })();</script> <div id='jivo_copyright' style='display: none'>Модуль <a href='http://www.jivosite.ru' target='_blank'>онлайн консультант</a><br> работает на JivoSite</div>
        <!-- {/literal} END JIVOSITE CODE -->
        <?*/?>
    <? endif; ?>
    <?




    $SEARCHFILD = '';
    $PRICES = '';
    $SMALL = '';
    $EURPRODUCTS = '';

    $query = "SELECT `name`,`price` FROM `ib_catalog_elements`;";
    global $mysqli_db;
    $query_result = mysqli_query($mysqli_db, $query) or die("ошибка запроса " . $query);
    $j = mysqli_num_rows($query_result);
    if ($j > 0) {
        for ($i = 1; $i <= $j; $i++) {
            $row = mysqli_fetch_assoc($query_result);

            $SEARCHFILD .= '"' . $row['name'] . '",';
            $PRICES .= '"' . $row['price'] . '",';
        };
    };

    $query = "SELECT `model`,`model_fullname`,`s_name`,`brand`,`retail_price` FROM `products_all` WHERE `modification`<>'1' ;";
    $query_result = mysqli_query($mysqli_db, $query) or die("ошибка запроса05");
    $j = mysqli_num_rows($query_result);
    if ($j > 0) {
        for ($i = 1; $i <= $j; $i++) {
            $row = mysqli_fetch_assoc($query_result);
            if ($row['brand'] == "Cincoze") {
                $SEARCHFILD .= '"' . $row['s_name'] . '",';                
            } 
            else 
                {                
                if ($row['model_fullname'] != '') {
                    $SEARCHFILD .= '"' .$row['model_fullname'] . '",';                    
                } 
                else 
                    { 
                    $SEARCHFILD .= '"' . $row['model'] . '",';                    
                    }                
            };
              $PRICES .= '"' . $row['retail_price'] . '",';                
            }
        };
    

    $query = "SELECT `model`,`retail_price` FROM `controllers`;";
    $query_result = mysqli_query($mysqli_db, $query) or die("ошибка запроса05");
    $j = mysqli_num_rows($query_result);
    if ($j > 0) {
        for ($i = 1; $i <= $j; $i++) {
            $row = mysqli_fetch_assoc($query_result);
            $SEARCHFILD .= '"' . $row['model'] . '",';
            $PRICES .= '"' . $row['retail_price'] . '",';
        };
    };

    $query = "SELECT `name`,`section_code` FROM `ib_catalog_elements` WHERE `active`='1';";
    $query_result = mysqli_query($mysqli_db, $query) or die("ошибка запроса " . $query);
    $j = mysqli_num_rows($query_result);
    if ($j > 0) {
        for ($i = 1; $i <= $j; $i++) {
            $row = mysqli_fetch_assoc($query_result);

            $SMALL .= '"Haiwell/' . $row['section_code'] . '/<b>' . $row['name'] . '</b>",';
        };
    };

    $query = "SELECT `model`,`s_name`,`brand`,`retail_price` FROM `products_all` WHERE  (`modification`<>'1') AND (`show_in_cat`='1');";
    $query_result = mysqli_query($mysqli_db, $query) or die("ошибка запроса05");
    $j = mysqli_num_rows($query_result);
    if ($j > 0) {
        for ($i = 1; $i <= $j; $i++) {
            $row = mysqli_fetch_assoc($query_result);
            if ($row['brand'] == "Cincoze") {
                $SMALL .= '"' . $row['s_name'] . '",';
            } else {
                $SMALL .= '"' . $row['model'] . '",';
            }
        };
    };

    $query = "SELECT `model`,`retail_price` FROM `controllers` WHERE `model` NOT LIKE '%x%';";
    $query_result = mysqli_query($mysqli_db, $query) or die("ошибка запроса05");
    $j = mysqli_num_rows($query_result);
    if ($j > 0) {
        for ($i = 1; $i <= $j; $i++) {
            $row = mysqli_fetch_assoc($query_result);

            $SMALL .= '"' . $row['model'] . '",';
        };
    };


    $query = "SELECT `model` FROM `products_all` WHERE `brand` IN ('eWON', '2N');";
    $query_result = mysqli_query($mysqli_db, $query) or die("ошибка запроса05");
    $j = mysqli_num_rows($query_result);
    if ($j > 0) {
        for ($i = 1; $i <= $j; $i++) {
            $row = mysqli_fetch_assoc($query_result);

            $EURPRODUCTS .= '"' . $row['model'] . '",';
        };
    };

    $query = "SELECT `model`,`model_fullname` FROM `products_all` WHERE `brand`='Faraday' or `currency` = 'RUR';";
    $query_result = mysqli_query($mysqli_db, $query) or die("ошибка запроса05");
    $j = mysqli_num_rows($query_result);
    if ($j > 0) {
        for ($i = 1; $i <= $j; $i++) {
            $row = mysqli_fetch_assoc($query_result);

        if ($row['model_fullname'] != '') {$RUPRODUCTS .= '"' . $row['model_fullname'] . '",';}
            else { $RUPRODUCTS .= '"' . $row['model'] . '",';}
        };
    };

    $query = "SELECT `model` FROM `controllers` WHERE `brand`='IECON';";
    $query_result = mysqli_query($mysqli_db, $query) or die("ошибка запроса05");
    $j = mysqli_num_rows($query_result);
    if ($j > 0) {
        for ($i = 1; $i <= $j; $i++) {
            $row = mysqli_fetch_assoc($query_result);

            $RUPRODUCTS .= '"' . $row['model'] . '",';
        };
    };

    $SEARCHFILD = substr($SEARCHFILD, 0, -1);
    $PRICES = substr($PRICES, 0, -1);
    $SMALL = substr($SMALL, 0, -1);
    $EURPRODUCTS = substr($EURPRODUCTS, 0, -1);
    $RUPRODUCTS = substr($RUPRODUCTS, 0, -1);
    ?>
    <script type="text/javascript">

        var prices = [<? echo $PRICES; ?>];
        var models = [
    <? echo $SEARCHFILD; ?>
        ];
        var smodels = [
    <? echo $SMALL; ?>
        ];
        var eurproducts = [
    <? echo $EURPRODUCTS ?>
        ];

        var ruproducts = [
    <? echo $RUPRODUCTS ?>
        ];

    </script>



    <? //include $_SERVER['DOCUMENT_ROOT'] . "/sc/QRCode/lib_QRCode.php"; ?> <?/* с попапом  */?>
    <? include $_SERVER['DOCUMENT_ROOT'] . "/sc/QRCode/lib_QRCode_for_agroprodmash2019.php"; ?>

    <? include $_SERVER['DOCUMENT_ROOT'] . "/sc/lib_new_includes/functions_statistics.php";
    //catchingHTTP_REFERER(); 
    youWatchedPanel::printItself();
    ?>
    <? echo $insert_scripts;?>
        <!-- <?= "PHP_MAJOR_VERSION ".PHP_MAJOR_VERSION?> -->
    </body>

    </html>


    <?
}

function temp2() {
    ?>
    </td><!-- MAIN TABLE     end td left content -->
    <td valign="top"> <!-- MAIN TABLE     td right content -->

    <?
}

function temp1() {
    echo "
<table class='MAIN_TABLE' style='margin:auto' width=100% cellpadding=0 cellspacing=0><tr><td valign=top width=250px>"; // <!-- MAIN TABLE     td left menu -->
}

function temp1_no_menu() {
    echo "
<table class='MAIN_TABLE' style='margin:auto' width=100% cellpadding=0 cellspacing=0><tr><td valign=top width=0px>"; // <!-- MAIN TABLE     td left menu -->
}
