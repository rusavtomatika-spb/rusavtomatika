<?
if (!defined('PROLOG_INCLUDED')) exit;
/* NO CASH  NO CASH  NO CASH  NO CASH  NO CASH  NO CASH  NO CASH  NO CASH  NO CASH  NO CASH  NO CASH  NO CASH  NO CASH */
$arrPagesWithNoCash = ["/catalog/favorites/", "/catalog/cart/", "/catalog/viewed/", "/catalog/compare/", "/catalog/search/",];
$url = $_SERVER['REQUEST_URI'];
$url = explode('?', $url);
$url = $url[0];
if (in_array($url, $arrPagesWithNoCash)) {
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Expires: " . date("r"));
}
/* NO CASH  NO CASH  NO CASH  NO CASH  NO CASH  NO CASH  NO CASH  NO CASH  NO CASH  NO CASH  NO CASH  NO CASH  NO CASH */
global $CONTENT_ON_WIDE_SCREEN;
$cms_template_url = "/abacus/templates/rusavtomatika_bulma/";
$current_page = str_replace("index.php", "", $_SERVER['REQUEST_URI']);
$current_page = str_replace("index2.php", "", $current_page);
$current_page = trim($current_page, "/ ");
$current_page = str_replace("/", "_", $current_page);

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <!-- titles -->
    <meta http-equiv=Content-Type content=text/html; charset=utf-8>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script-->    <?

    /* ?><title><?= (3.5mm jack ?></title>
      <meta name="description" content="<?= $DESCRIPTION ?>">
      <meta name="keywords" content="<?= $KEYWORDS ?>"><? */ ?>
    <!--link rel="stylesheet" type="text/css" href="<?= $cms_template_url ?>bootstrap-grid.css" /-->
    <link href="/lightbox/css/lightbox.css" rel="stylesheet"/>
    <link href="/abacus/templates/rusavtomatika_bulma/assets/all.min.css" rel="stylesheet">
    <!--link rel="stylesheet" type="text/css" href="/css/ra.css" /-->
    <!--link rel="stylesheet" type="text/css" href="/css/menu4.css" /-->
    <!--link rel="stylesheet" type="text/css" href="/css/tabs.css" /-->
    <!--link rel="stylesheet" type="text/css" href="/css/button.css" /-->
    <!--link rel="stylesheet" type="text/css" href="/css/tango/skin.css" /-->
    <link rel="stylesheet" href="/js/jquery-ui.css">
    <link rel="stylesheet" href="/sc/jBox.all.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"/>
                            <!--script src="/js/jquery-1.10.2.js?310120201008"></script-->
                            <script src="/js/jquery-3.6.0.js?310120201008"></script>
                            <script src="/sc/jBox.all.min.js?310120201008"></script>
    <?
    if ($current_page != ''):
        ?>
        <!--script src="//code.jquery.com/ui/1.9.2/jquery-ui.js"></script-->
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <?
    endif;
	//echo $_SERVER['SCRIPT_FILENAME'];
    ?>
    <?
    if ($_SERVER['SERVER_NAME'] == 'www.rusavto.moisait.net'):
        ?>
<script src="https://cdn.jsdelivr.net/npm/html2canvas@latest/dist/html2canvas.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jspdf@latest/dist/jspdf.min.js"></script>
	<?
    endif;
    ?>

    <!--script type="text/javascript" src="/js/jquery.jcarousel.js"></script-->
    <!--script src="/lightbox/js/lightbox.js"></script-->
    <!--script type="text/javascript" src="/js/ra_scripts.js"></script-->
    <!--script type="text/javascript" src="/js/s.js"></script-->
    <script type="text/javascript" src="/js/jquery.maskedinput.js"></script>
    <script type="text/javascript" src="/js/clipboard.min.js"></script>
    <!--script type="text/javascript" src="/js/sha512.js"></script-->

    <!--script src="/js/search.js"></script-->
    <link rel="stylesheet" type="text/css" href="<?= $cms_template_url ?>fancybox3/jquery.fancybox.min.css"/>
    <!--script type="text/javascript" src="<?= $cms_template_url ?>fancybox3/jquery.fancybox.min.js"></script-->
    <link rel="stylesheet" type="text/css" href="/css/fancybox.css"/>
    <?
    include "include/inc_extra_open_graph.php";
    ?>
    <!--link rel="stylesheet" type="text/css" href="<?= $cms_template_url ?>bulma/css/bulma.css"/-->
    <!--link rel="stylesheet" type="text/css" href="<?= $cms_template_url ?>css/template_styles_bulma_overriding.css"/-->
    <!--script src="//cdn.jsdelivr.net/gh/jquery-form/form@4.3.0/dist/jquery.form.min.js"></script-->
<link rel="stylesheet" type="text/css" href="<?= $cms_template_url ?>css/template_styles.css"/>
    <!--    <link rel="stylesheet" type="text/css" href="<? /*= $cms_template_url */ ?>template_styles_colors_and_sizes.css?<? /*= rand() */ ?>"/>
    <link rel="stylesheet" type="text/css" href="<? /*= $cms_template_url */ ?>template_styles_links_and_buttons.css?<? /*= rand() */ ?>"/>
    <link rel="stylesheet" type="text/css" href="<? /*= $cms_template_url */ ?>template_styles_common.css?<? /*= rand() */ ?>"/>
    <link rel="stylesheet" type="text/css" href="<? /*= $cms_template_url */ ?>template_styles_header.css?<? /*= rand() */ ?>"/>
    <link rel="stylesheet" type="text/css" href="<? /*= $cms_template_url */ ?>template_styles_footer.css?<? /*= rand() */ ?>"/>
    <link rel="stylesheet" type="text/css" href="<? /*= $cms_template_url */ ?>template_styles_responsive.css?<? /*= rand() */ ?>"/>
-->
    <style>
        [v-cloak] {
            display: none;
        }
    </style>
    <?
    global $SEO_URL;
    if (isset($SEO_URL) and $SEO_URL != "") {
        ?>
        <meta name="component_seo" content="<?= $SEO_URL ?>"/>
        <?
    }
    ?>
<link rel="icon" type="image/png" href="/images/favicon-96x96.png" sizes="96x96" />
<link rel="icon" type="image/svg+xml" href="/images/favicon.svg" />
<link rel="shortcut icon" href="/images/favicon.ico" />
<link rel="apple-touch-icon" sizes="180x180" href="/images/apple-touch-icon.png" />
<meta name="apple-mobile-web-app-title" content="Rusavtomatika" />
<link rel="manifest" href="/images/site.webmanifest" />
</head>
<body class="template_rusavtomatika_bulma current_page_<?= $current_page ?>" style="opacity: 0;">
<div class="popup_background"></div>
<noscript>
    This page needs JavaScript activated to work.<br>
    Пожалуйста, включите Javascript чтобы просмотреть эту страницу
    <style>div {
            display: none;
        }</style>
</noscript>
<!--[if IE 7]>
Вы используете устаревший браузер Internet explorer 7<br>
Пожалуйста, обновите браузер, чтобы просмотреть эту страницу
<style> div {
    display: none;
}</style>
<![endif]-->

<!--[if IE 6]>
Вы используете устаревший браузер Internet explorer 6<br>
Пожалуйста, обновите браузер, чтобы просмотреть эту страницу
<style> div {
    display: none;
}</style>
<![endif]-->
<div class="padding_wrapper">
    <header>
        <div class="container is-widescreen">
            <div class="header_top">
                <div class="header_top__item">
                    <div class="header_top__logo">
                        <a href="/"><img width="249" height="50" alt="Русавтоматика"
                                         src="/abacus/templates/rusavtomatika_bulma/images/logo.svg"/></a>
                    </div>
                </div>
                <div class="header_top__item">
                    <? include "include/inc_short_contacts.php"; ?>
                    <div class="header_top__contacts is-hidden-touch">
                        <button class="button is-success button_open_panel_contacts">Контакты</button>
                    </div>
                    <div class="header_top__contacts is-hidden-desktop">
                        <a href="#" class="header-link-contacts">
                            <button class="button_open_panel_contacts button is-success"><span
                                        class="icon_hamburger no_text"></span></button>
                        </a>
                    </div>
                    <div class="pop_panel_contacts is-hidden-touch">
                        <? include "include/inc_pop_panel_contacts.php"; ?>
                    </div>
                    <div class="panel_background"></div>
                    <div class="pop_panel_contacts mobile is-hidden-desktop">
                        <? include "include/inc_pop_panel_contacts_mobile.php"; ?>
                    </div>
                    <div class="panel_background"></div>

                </div>
            </div>
            <div class="header_top__separator is-hidden-touch"></div>
            <div class="header_top is-hidden-touch">
                <div class="header_top__item">
                    <div class="header_top__menu">
                        <div class="top_menu">
                            <? include "include/inc_main_menu.php" ?>
                        </div>
                    </div>
                </div>
                <div class="header_top__item">
                    <div class="header_top__soc_buttons">
                        <? include "include/inc_social_nets.php"; ?>
                    </div>
                </div>
            </div>
        </div>
    </header>
</div>


<?

$arguments = array(
    "component" => "catalog_toolbar",
    "template" => "default",
    "template_section_detail" => "default",
);
CoreApplication::include_component($arguments);

?>
<?
if ($current_page == '') {
    //include "./include_utf_8/main_page/content/block_big_banner3.php";
    include "./include_utf_8/main_page/content/block_big_banner_apm25.php";
}
?>

<div class="padding_wrapper">
    <main>
        <?
        if (!$CONTENT_ON_WIDE_SCREEN):
        ?>
        <div class="container is-widescreen">
            <div class="columns">
                <div class="column is-12">
<?
endif;
?>