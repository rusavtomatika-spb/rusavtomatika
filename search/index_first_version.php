<?php
header('Content-Type: text/html; charset=windows-1251');
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
define("MAIN_FILE_EXECUTED", TRUE);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>Поиск по сайту rusavtomatika.com</title>
        <meta http-equiv="Content-Type" content="text/html;charset=windows-1251" />   
        <link rel="stylesheet" type="text/css" href="/search/css/styles_search.css" />
    </head>
    <body>
        <div class="wrap_all">
            <h1>Поиск по сайту <a target="_blank" href="https://rusavtomatika.com/"> www.rusavtomatika.com</a></h1>
    <?
//    $start = microtime(true);    

require_once('model/inc_dbconnect.php');    
require_once('controller/inc_functions.php'); 
require_once('controller/inc_search_functions.php'); 
require_once('view/inc_search_form_for_header.php'); 
require_once('view/inc_search_form.php'); 


//echo '<br><hr>Время выполнения скрипта: '.(microtime(true) - $start).' сек.';
?>
</div>
    
<script src="/js/jquery-1.10.2.js"></script>    
<script src="/search/scripts/scripts_search.js"></script>    
    
</body>

</html>


