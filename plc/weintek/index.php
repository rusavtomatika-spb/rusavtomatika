<?php

$start = microtime(true);

session_start();

define("bullshit", 1);

$extra_openGraph = array(

    "openGraph_image" => "https://www.rusavtomatika.com/upload_files/images/openGraph_images/plc_weintek.png",

    "openGraph_title" => "Модули ввода-вывода (модульные системы) серии iR от Weintek",

    "openGraph_siteName" => "Русавтоматика"

);

include_once $_SERVER['DOCUMENT_ROOT'] . "/sc/dbcon.php";

include_once($_SERVER['DOCUMENT_ROOT'] . "/sc/lib_new.php");

include_once($_SERVER['DOCUMENT_ROOT'] . "/sc/lib_controllers.php");





$expansionParam = "";



global $mysqli_db;

mysqli_query($mysqli_db, "SET NAMES 'cp1251'");



$vta = (explode('?', $_SERVER['REQUEST_URI']));

$var_to_array = str_replace("/index.php", "/", $vta[0]);

$var_to_array = str_replace("index.php", "", $var_to_array);

$CANONICAL = $var_to_array;

$var_to_array = str_replace(".php", "", $var_to_array);

if (preg_match('/\/$/i', $var_to_array)) {

    $var_to_array = substr($var_to_array, 0, -1);

};

$var_array = explode("/", $var_to_array);

$levels = count($var_array);

$levels = $levels - 1;



if ($levels == 2) {

    $out = '<nav><a href="/">Главная</a>&nbsp;/&nbsp;<span>Модульные системы Weintek</span></nav><h1>Модули ввода-вывода (модульные системы) серии iR от Weintek</h1><hr>';

    $DESCRIPTION = 'Модульная система ввода вывода Weintek со склада по отличной цене. Большой выбор, в наличии на складе, доставка по России.';

    $KEYWORDS = 'Коммуникационные модули, coupler, модули ввода-вывода, digital i/o, Weintek, официальный представитель';

    $TITLE = 'Модули ввода-вывода серии iR (модульные системы) от Weintek';





    ob_start();

    ?>

    <style>

        #body_cont nav {

            margin: 3px auto 15px 0px;

        }



        .plc_weintek_ul_style1 {



            line-height: 1.2;

            margin: 0 14px;

        }



        .plc_weintek_ul_style1 li {

            margin: 10px 0;

        }



        .plc_weintek_ul_style2 {

            font-size: 13px;

            line-height: 1.3;

            margin: 0 20px;



        }



        .plc_weintek_ul_style2 li {

            margin: 5px 0;

        }



        .plc_product_link {

            text-decoration: none;

            color: #333;

            display: block;

            padding: 20px 20px 40px 20px;

            box-sizing: border-box;

            box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);

            transition: 0.2s;

            min-height: 400px;

            position: relative;

        }



        .plc_product_link:hover {

            text-decoration: none;

            color: #333;

            box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);



        }



        .table_plc_weintek th {

            height: 50px;

        }



        .table_plc_weintek td a.product_button {

            background: #34ab5e;

            color: #fff;

            display: inline-block;

            padding: 1px 5px 2px 5px;

            text-decoration: none;

            opacity: 0.6;

            transition: 0.2s;

        }



        .table_plc_weintek td a.product_button:hover {

            opacity: 1;

        }





        .plc_product_link h2 {

            font-size: 15px;

            line-height: 1.1;

        }



        .plc_product_link img {

            max-width: 100px;

            overflow: hidden;

            display: block;

            margin: 10px auto 20px

        }



        .plc_product_link .read_more {

            position: absolute;

            width: 80px;

            background: #34ab5e;

            color: #fff;

            right: 0;

            bottom: 0;

            text-align: center;

            padding: 3px;

            opacity: 0.5;

        }



        .plc_product_link:hover .read_more {

            opacity: 1;

            right: 0;

            bottom: 0px;

        }



        .table_style3 a {

            color: #0040be;

        }



        .table_style3 a:hover {

            color: #008e00;

        }





    </style>





    <ul class="plc_weintek_ul_style1">

        <li>Прямое подключение коммуникационного модуля к панели оператора может осуществляться по протоколам

            <b>CANopen</b> или <b>MODBUS TCP/IP</b>.

        </li>

        <li>Удобное <b>соединение модулей</b> ввода вывода с помощью <b>стяжки</b>.</li>

        <li>

            Вместо последовательного соединения, Weintek применяет <b>параллельное соединение</b> по шине IBUS. Это

            значительно <b>ускоряет передачу информации.</b>



        </li>



    </ul>





    <div class="blockofcols_container">

        <div class="blockofcols_row">

            <div class="col-12">

                <img style="display: inline-block;width:100%" src="/plc/weintek/images/iRschem-rus.png"/>

            </div>

        </div>

    </div>

    <div class="blockofcols_container">

        <div class="blockofcols_row">

            <div class="col-12">

                <h2>Контроллер(ПЛК) и коммуникационные модули Weintek</h2>



            </div>

        </div>

    </div>

    <div class="blockofcols_container">

        <div class="blockofcols_row">

            <div class="col-4">

                <a class="plc_product_link" href="/weintek/cMT-CTRL01.php">

                    <div class="read_more">Подробнее</div>

                    <img src="/images/weintek/controllers/cMT-CTRL01/cMT-CTRL01.png" alt="iR-COP Weintek"/>

                    <h2>Программируемый логический контроллер cMT-CTRL01</h2>

                    <div style="overflow: hidden;">

                        <ul class="plc_weintek_ul_style2">

                            <li>CODESYS (IEC61131)</li>

                            <li>MQTT, OPC UA Server/Client</li>

                            <li>Ethernet, COM2/COM3 RS-485 2W, Modbus TCP/IP Gateway</li>

                            <li>Удаленный доступ по EasyAccess</li>

                        </ul>

                    </div>



                </a>

            </div>

            <div class="col-4">

                <a class="plc_product_link" href="/plc/weintek/iR-COP.php">

                    <div class="read_more">Подробнее</div>

                    <img src="/images/controllers/weintek/iR-COP/md/iR-COP_1.png" alt="iR-COP Weintek"/>

                    <h2>Коммуникационный модуль iR-COP (протокол CANopen)</h2>

                    <div style="overflow: hidden;">

                        <ul class="plc_weintek_ul_style2">

                            <li>Поддерживает скорость передачи данных от 50kbps до 1Mbps</li>

                            <li>Быстрое переключение номера устройства и скорости передачи данных</li>

                            <li>Предустановленный драйвер в Easybuilder Pro</li>

                        </ul>

                    </div>



                </a>

            </div>

            <div class="col-4">

                <a class="plc_product_link" href="/plc/weintek/iR-ETN.php">

                    <div class="read_more">Подробнее</div>

                    <img src="/images/controllers/weintek/iR-ETN/md/iR-ETN_1.png" alt="iR-ETN Weintek"/>

                    <h2>Коммуникационный модуль iR-ETN (протокол Modbus TCP/IP)</h2>

                    <div style="overflow: hidden;">

                        <ul class="plc_weintek_ul_style2">

                            <li>Скорость передачи данных 10/100 Mbps</li>

                            <li>Два разъема Ethernet для каскадного соединения</li>

                            <li>Предустановленный драйвер в Easybuilder Pro</li>

                        </ul>

                    </div>

                </a>

            </div>

        </div>

        <br>

        <div class="blockofcols_row">

            <div class="col-4">

                <a class="plc_product_link" href="/plc/weintek/iR-ETN40R.php">

                    <div class="read_more">Подробнее</div>

                    <img src="/images/weintek/coupler/iR-ETN40R/md/iR-ETN40R_1_2.png" alt="iR-ETN40R Weintek"/>

                    <h2>Расширяемый модуль iR-ETN40R</h2>

                    <div style="overflow: hidden;">

                        <ul class="plc_weintek_ul_style2">

                            <li>Поддержка протоколов MODBUS TCP/IP Server and EtherNet/IP Adapter</li>

                            <li>Входы/выходы: 24 цифровых входа (4 высокоскоростных) и 16 релейных выхода.</li>

                            <li>Возможность расширять конструкцию дополнительными модулями.</li>

                        </ul>

                    </div>

                </a>

            </div>

            <div class="col-4">

                <a class="plc_product_link" href="/plc/weintek/iR-ECAT.php">

                    <div class="read_more">Подробнее</div>

                    <img src="/images/controllers/weintek/iR-ECAT/lg/iR-ECAT_1.png" alt="iR-ECAT Weintek"/>

                    <h2>Коммуникационный модуль iR-ECAT (протокол EtherCAT)</h2>

                    <div style="overflow: hidden;">

                        <ul class="plc_weintek_ul_style2">

                            <li>Скорость передачи данных 100 Mbps</li>

                            <li>Два разъема Ethernet для каскадного соединения</li>

                            <li>Предустановленный драйвер в Easybuilder Pro</li>

                        </ul>

                    </div>

                </a>

            </div>

        </div>

    </div>

    <br>

    <?php

    include("inc_io_modules_table.php");

    ?>



    <p></p>

    <p></p>

    <p></p>

    <p></p>

    <p></p>

    <?

    $out .= ob_get_contents();

    ob_end_clean();





    //$out .= show_controllers_yotta_a52_1();

} else {

    $file = $_SERVER['DOCUMENT_ROOT'] . '/plc/weintek/products_new.php';

    if (file_exists($file)) {

        include_once($file);

    };

};



$out .= '</div>';



//-----------------end content

//echo microtime(true) - $start;

$template_file = 'head_canonical.html';



//$head = head($template_file, $TITLE, $DESCRIPTION, $KEYWORDS, $expansionParam);

$head = setHeaderExpansionParam($template_file, $TITLE, $DESCRIPTION, $KEYWORDS, $expansionParam);

$head = str_replace('[>CANONICAL<]', 'https://' . $_SERVER["HTTP_HOST"] . $CANONICAL, $head);





/* * *************************************************************************** */

/* вывод ********************************************************************* */

/* * *************************************************************************** */



echo $head;

?>

<div id="mes_backgr"></div>

<div id="body_cont">

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

    top_menu();

    //usd_rate();

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

    echo "<article>";

    ?>

    <div class="block_content">

        <div class="blockofcols_container">

            <div class="blockofcols_row">

                <div class="col-12">



                    <? echo $out; ?>

                </div>

            </div>

        </div>

    </div>

    <?

    echo "</article>";

    temp3();

    ?>

