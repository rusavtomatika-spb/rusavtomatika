<?php
if (empty($_COOKIE['a']))  exit;
header('Content-Type: text/html; charset=windows-1251');
/*ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);*/

define("ERRORS", 0);
if (ERRORS) {
    ini_set('error_reporting', E_ALL & ~E_DEPRECATED);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
}


define("MAIN_FILE_EXECUTED", TRUE);
define("bullshit", TRUE);

require_once($_SERVER["DOCUMENT_ROOT"].'/sc/dbcon.php');
database_connect();
//require_once($_SERVER["DOCUMENT_ROOT"].'/sc/lib_new_includes/inc_dbconnect.php');
require_once('controller/inc_functions.php');

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>Индексация сайта rusavtomatika.com</title>
        <meta http-equiv="Content-Type" content="text/html;charset=windows-1251" />   
        <link rel="stylesheet" type="text/css" href="css/my_bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="css/styles.css" />
    </head>
    <body class="index_index">        
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <? require_once('view/menu.php'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h1>Индексация сайта <a target="_blank" href="https://rusavtomatika.com/"> www.rusavtomatika.com</a></h1>
                </div>
            </div>

            <?
            $start = microtime(true);

            ?>
            <div class="row ">
                <div class="col-md-12 col-xs-12 ">
                    <? require_once 'view/inc_form_add_page.php'; ?>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-12 col-xs-12 ">
                    <? require_once 'view/inc_form_add_pages_from_xml.php'; ?>
                </div>
            </div>
            <div class="row"><div class="col-md-12"><div id="result_of_form_add_pages_from_xml"></div></div></div>            
            <div class="row">
                <div class="col-md-12">
                    <? require_once 'view/inc_form_add_pages_from_xml_do_process.php'; ?>
                </div>
            </div>

            <?
            /*
              var_dump(lemmatize("ПОЙДЁТ"));
              echo '<br>';
              var_dump(lemmatize("WENT"));
             */
            /*


              $rootFolder = "/home/moisait/public_html/phpmorphy";

              global $phpmorphy;
              global $regexp_word;
              global $regexp_entity;

              $phpmorphy = null;
              $regexp_word = '/([a-zа-я0-9]+)/';
              $regexp_entity = '/&([a-zA-Z0-9]+);/';

              require_once( $rootFolder . '/src/common.php');
              $content = getRemoteContentByURL("https://www.rusavtomatika.com/articles/");

              ?><pre><?
              $words = get_words($content);
              //$words = array_unique($words);
              $counter = 0;
              foreach ($words as $word) {
              if ($word and $word != " ") {
              $rez = lemmatize($word);
              $counter++;
              if (isset($rez[0]))
              $lemma = $rez[0];
              else {
              $lemma = $word;
              }
              echo $counter . " *" . $rez[1] . "* - " . $lemma;
              echo "<br>";
              }
              }
              ?></pre><?

              function get_words($content, $filter = true) {
              global $regexp_word;
              global $regexp_entity;


              // Фильтрация HTML-тегов и HTML-сущностей //
              if ($filter) {
              $content = strip_tags($content);
              $content = preg_replace($regexp_entity, ' ', $content);
              }
              // Перевод в верхний регистр //
              $content = mb_strtoupper($content, 'windows-1251');
              // Замена ё на е //
              //echo $content = str_ireplace('Ё', 'Е', $content);
              // Выделение слов из контекста //
              $content = preg_replace("/[^a-zA-ZА-Яа-я0-9\s]/", " ", $content);
              $content = preg_replace('/[\s]{2,}/', ' ', $content);
              return explode(" ", $content);
              }





             */

           // echo '<br><hr>Время выполнения скрипта: ' . (microtime(true) - $start) . ' сек.';
            ?>
        </div>
        </div>            

        <script src="/js/jquery-1.10.2.js"></script>    
        <script src="/search/scripts/scripts.js"></script>    

    </body>

</html>


