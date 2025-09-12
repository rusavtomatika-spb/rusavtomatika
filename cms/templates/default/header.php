<?
/*
  ini_set('error_reporting', E_ALL);
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1); */


if (!defined('bullshit')) define("bullshit", 1);
if (!defined('cms'))
    exit;

include_once $_SERVER['DOCUMENT_ROOT'] . "/sc/dbcon.php";
include_once($_SERVER['DOCUMENT_ROOT'] . "/sc/lib_new.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/sc/lib_controllers.php");
database_connect();
//<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv=Content-Type content=text/html; charset=windows-1251>

    <meta name="viewport" content="width=1110"/>
    <? ob_start(); ?>
    <? /* ?><title><?= (3.5mm jack ?></title>
          <meta name="description" content="<?= $DESCRIPTION ?>">
          <meta name="keywords" content="<?= $KEYWORDS ?>"><? */ ?>

    <link href="/lightbox/css/lightbox.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="/css/ra.css?31012020"/>
    <link rel="stylesheet" type="text/css" href="/css/menu4.css"/>
    <link rel="stylesheet" type="text/css" href="/css/tabs.css"/>
    <link rel="stylesheet" type="text/css" href="/css/button.css"/>
    <link rel="stylesheet" type="text/css" href="/css/tango/skin.css"/>


    <link rel="stylesheet" href="//code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"/>
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
    <script type="text/javascript" src="/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="/js/jquery.jcarousel.js"></script>
    <script src="/lightbox/js/lightbox.js"></script>
    <script type="text/javascript" src="/js/ra_scripts.js"></script>
    <script type="text/javascript" src="/js/s.js"></script>
    <script type="text/javascript" src="/js/jquery.maskedinput.js"></script>
    <script type="text/javascript" src="/js/sha512.js"></script>


    <script src="/js/search.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/fancybox.css" />



    <link rel="stylesheet" type="text/css" href="<?= $cms_template_url ?>template_styles.css?<?= rand() ?>"/>
    <script type="text/javascript" src="<?= $cms_template_url ?>scripts.js"></script>
    <?
    if ($_SERVER['HTTP_HOST'] == "www.rusavto.moisait.net") {
        echo '
                    <script type="text/javascript" src="/sc/mistakes-4.1/mistakes.js"></script>
                    <link href="/sc/mistakes-4.1/mistakes.css" rel="stylesheet" type="text/css" />
';
    }
    ?>

    <?
    global $extra_openGraph;

    if (isset($extra_openGraph) and $extra_openGraph != '') {
        foreach ($extra_openGraph as $paramName => $paramValue) {
            switch ($paramName) {
                case "openGraph_image":
                    echo "<meta property='og:image' content='" . $paramValue . "'/>";
                    echo '
                        ';
                    echo "<link rel='image_src' href='" . $paramValue . "'>";
                    echo '
                        ';
                    break;
                case "openGraph_title":
                    echo "<meta property='og:title' content='" . $paramValue . "'/>";
                    echo '
                        ';
                    break;
                case "openGraph_siteName":
                    echo "<meta property='og:site_name' content='" . $paramValue . "'/>";
                    echo '
                        ';
                    break;
            }
        }
    }
    ?>

    <link rel="stylesheet" type="text/css" href="/css/styles_of_george_martin.css"/>
    <link rel="stylesheet" type="text/css" href="/css/styles_of_victor_pelevin.css"/>
</head>


<body style="opacity: 0;transition: opacity 0.2s">

<? include $_SERVER["DOCUMENT_ROOT"] . "/include/template/top-banner.php"; ?>
<?
if ($_SERVER['HTTP_HOST'] == "www.rusavto.moisait.net") {
    echo '
<a class="mistakes_link" href="javascript:void(0)" onclick="PressLink()">Отправить сообщение об ошибке</a>
';
}
?>
<? /* ?>
          <!-- Yandex.Metrika counter -->
          <script type="text/javascript">
          (function (d, w, c) {
          (w[c] = w[c] || []).push(function () {
          try {
          w.yaCounter114217 = new Ya.Metrika({
          id: 114217,
          clickmap: true,
          trackLinks: true,
          accurateTrackBounce: true,
          webvisor: true,
          trackHash: true
          });
          } catch (e) {
          }
          });

          var n = d.getElementsByTagName("script")[0],
          s = d.createElement("script"),
          f = function () {
          n.parentNode.insertBefore(s, n);
          };
          s.type = "text/javascript";
          s.async = true;
          s.src = "https://mc.yandex.ru/metrika/watch.js";

          if (w.opera == "[object Opera]") {
          d.addEventListener("DOMContentLoaded", f, false);
          } else {
          f();
          }
          })(document, window, "yandex_metrika_callbacks");
          </script>
          <noscript><div><img src="https://mc.yandex.ru/watch/114217" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
          <!-- /Yandex.Metrika counter --><? */ ?>


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


<div id=mes_backgr></div>
<div id=body_cont>
    
    <? include $_SERVER["DOCUMENT_ROOT"] . "/include/header_menu.php"; ?>
    <table width="100%" bgcolor="white">
        <tr height="93">
            <td width="300px">
                <a href="/"><img src="/images/logo2017.png"/></a>
            </td>
            <td></td>
        </tr>
    </table>


    <?
    /*
      $template_file = 'head_canonical.html';
      $head = head($template_file, $TITLE, $DESCRIPTION, $KEYWORDS);
      if (isset($CANONICAL)) {
      $head = str_replace('[>CANONICAL<]', 'https://' . $_SERVER["HTTP_HOST"] . $CANONICAL, $head);
      } else {
      $head = str_replace('[>CANONICAL<]', '', $head);
      }
      echo $head; */
    top_menu();

    search();
    compare();
    backup_call();
    top_buttons();
    basket();
    temp1_no_menu();
    show_price_val();
    //temp1();
    //left_menu();
    add_to_basket();
    popup_messages();
    temp2();
    ?>
    <!-- maincontent -->
    <main>

        <div class="block_content">
