<?php
if (empty($_COOKIE['a']))  exit;
header('Content-Type: text/html; charset=windows-1251');
ini_set('error_reporting', E_ALL  & ~E_DEPRECATED);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
define("MAIN_FILE_EXECUTED", TRUE);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>Карта весов rusavtomatika.com</title>
        <meta http-equiv="Content-Type" content="text/html;charset=windows-1251" />   
        <link rel="stylesheet" type="text/css" href="/search/css/styles.css" />
    </head>
    <body><div class="bg_all"></div>
        <div class="wrap_all">
            <? require_once('view/menu.php'); ?>
            <h1>Карта весов <a target="_blank" href="https://rusavtomatika.com/"> www.rusavtomatika.com</a></h1>
            
            <?
            $start = microtime(true);

require_once('model/inc_dbconnect.php');
database_connect();
require_once('controller/inc_functions.php');
require_once 'controller/inc_weight_map_functions.php';
WeightMap::getInstance();
echo "<div class='panel_weight_map_list_table'><button id='add_new_row'>Добавить</button>";
$arrResult = WeightMap::get_list();
if (is_array($arrResult)){
    include 'view/index_weight_map_list_template.php';
}
echo "</div>";

            


          //  echo '<br><hr>Время выполнения скрипта: ' . (microtime(true) - $start) . ' сек.';
            ?>
        </div>

        <script src="/js/jquery-1.10.2.js"></script>    
        <script src="/search/scripts/scripts_weight_map.js"></script>    

    </body>

</html>


