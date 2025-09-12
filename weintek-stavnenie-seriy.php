<?php

include $_SERVER["DOCUMENT_ROOT"]."/config.php";

if(EX != "_"){

    header($_SERVER['SERVER_PROTOCOL'] . " 301 Moved Permanently");

    header('Location: https://' . $_SERVER['HTTP_HOST'] ."/weintek-stavnenie-seriy/");

    exit();

}

session_start();

define("bullshit", 1);

include ("sc/dbcon.php");

include ("sc/lib_new.php");





global $mysqli_db;

mysqli_query($mysqli_db, "SET NAMES 'cp1251'");



/*global $APATH;

global $WPATH;

global $net;

global $ftp_server;

global $ftp_user_name;

global $ftp_user_pass;



if (preg_match("/weblec/i", $_SERVER['DOCUMENT_ROOT'])) {

    $APATH = '/home/weblec/public_html/rusavtomatika.com';

    $WTPATH = '/home/weblec/public_html/rusavtomatika.com/upload_files';

    $net = 0;

} elseif (preg_match("/olgaglr/i", $_SERVER['DOCUMENT_ROOT'])) {

    $APATH = '/home/o/olgaglr/rusavto.olgaglr.tmweb.ru/public_html';

    $WTPATH = '/home/o/olgaglr/rusavto.olgaglr.tmweb.ru/public_html/upload_files';

    $net = 0;

} else {



    $APATH = 'http://www.rusavtomatika.com';

    $WTPATH = '';

    $net = 1;

    $conn_id = ftp_connect($ftp_server);

    $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

    ftp_pasv($conn_id, true);

    ftp_set_option($conn_id, FTP_TIMEOUT_SEC, 3600);

};*/





//---------------content ---------------------



$d_image = '<img title="Скачать" src="/images/manual.png">';



$out = '  ';







ob_start();

?>

<style>



    h1 {

        font-size: 20px;

    }









    #models a[target="_blanck"] {display: block;

                                 float: left;

                                 width: 120px;

                                 height: 134px;

                                 text-align: center;

                                 padding: 0px 30px 20px 30px;

                                 text-decoration: none;

                                 color: gray;

    }







    h3 {  color: rgb(3, 110, 182);



          margin-bottom: 7px;

    }



    #models h3 {

        text-align: center;

        margin-top: 20px;

    }

    #models h3 a {  color: rgb(238, 112, 11);  text-decoration: none;}



    #models > div {

        width: 100%;

        display: inline-block;

        background: rgb(255, 250, 247);

        border-bottom: 1px dashed rgb(238, 112, 11);

        border-top: none;

    }







    #models > div:first-child {



        border-top: 1px dashed rgb(238, 112, 11);



        border-bottom: 1px dashed rgb(238, 112, 11);



    }

    #models > div:nth-child(2) > a[target="_blanck"] { width: 187px;}

    #models > div > a[target="_blanck"] {  width: 138px;}



    #models > div:nth-child(2n) {

        background: rgb(250, 250, 250);



    }



    .number {

        float: left;

        font-weight: bold;

        font-size: 16px;

        margin-right: 10px;

        color: white;

        text-shadow: 0px 0px 1px black;

        border: 0px solid gray;

        width: 17px;

        text-align: center;

        padding-left: 1px;

        background: rgb(238, 112, 11);

        margin-top: 3px;

    }



    .st {  margin-bottom: 20px;}



    .note {  padding-top: 10px;

             color: rgb(90, 127, 199);

             display: block;

             font-size: 15px;}







    .pluses {

        width: 198px;

        float: left;

        text-align: center;

        display: table-cell;

        color: rgb(0, 33, 98);

        font-family: sans-serif;

        font-size: 17px;

    }



    #cloud, #lock, #mobile, #through, #users  {



        height: 100px;

        width: 198px;





        margin: 0px;

        display: table-cell;



    }



    #downbook:before {

        content: "?";

        color: rgb(255, 255, 255);

        padding-top: 17px;

        display: block;

        position: absolute;

        margin-left: 32px;

        text-shadow: 4px 6px 10px rgb(238, 112, 11);

        font-size: 73px;

        font-family: arial;

        font-style: normal;

        font-weight: bold;

    }





    #svr {

        position: absolute;

        left: 778px;

        top: 120px;



    }



    #tabs h2.line {

        font-size: 23px;

        color: rgb(245, 245, 245);

        text-shadow: 1px 1px 1px black;

        text-transform: uppercase;

        text-align: center;

        margin: 40px 0px;

        background: rgb(238, 112, 11);

        padding: 10px 0px;



    }



    .sravnenie {

        margin: auto;

        color: #0c8fff;

        font-family: Verdana, "Lucida Grande";

        font-size: 14px;

    }



    .sravnenie a {

        color: inherit;

        text-decoration: inherit;

    }



    .sravnenie p {

        font-weight: bold;

    }



    .sravnenie tr {

        width: 100%;

    }





    .sravnenie tr td:first-child {

        width: 438px;

    }



    .sravnenie tr td:nth-child(2) {

        width: 46px;

    }

    .sravnenie tr td:nth-child(3) {

        width: 46px;

    }

    .sravnenie tr td:nth-child(4) {

        width: 81px;

    }

    .sravnenie tr td:nth-child(5) {

        width: 46px;

    }

    .sravnenie tr td:nth-child(6) {

        width: 59px;

    }

    .sravnenie tr td:nth-child(7) {

        width: 47px;

    }



    .sravnenie td {

        padding: 10px 15px;

        border: 1px dashed silver;

        text-align: center;

        border-left: none;

        border-right: none;

    }



    .sravnenie tr:first-child td {

        font-weight: bold;

    }



    .sravnenie tr td:first-child {

        font-weight: bold;

        text-align: left;



        color: #062c4c;

    }



    .sravnenie tr:not(:first-child) td:not(:first-child) p {

        font-size: 18px;

    }



    .sravnenie tr:first-child {

        background-color: #dfe0e2;

    }



    .sravnenie tr:first-child td {

        background-color: #dfe0e2;

        border-bottom: none;

        border-top: none;

    }



    .question-s {

        display: inline-block;

        height: 18px;

        width: 19px;

        font-weight: bold;

        cursor: pointer;

        color: gray;

        margin-left: -2px;

        position:relative;

    }



    .question-s:hover {

        z-index: 400;

    }



    .question-s .note-s {

        position: absolute;

        display: none;

        z-index: 500;

    }



    .question-s:hover .note-s {

        display: block;

        color: #505050;

        background-color: rgb(247, 247, 247);

        max-width: 320px;

        padding: 10px;

        margin-left: -159px;

        font-size: 12px;

        margin-top: 16px;

        z-index: 500;

        -webkit-transition: display .30s ease-out;

        transition: display .30s ease-out;

        text-align: center;

        border: 3px solid #d8d8d8;

    }



    .question-s:hover .note-s::before {

        display: block;

        float: left;

        height: 0px;

        width: 0px;

        margin-top: -25px;

        background: none;

        list-style: none;

        z-index: 500;

        font-size: 1px;

        border-left: 15px solid transparent;

        border-bottom: 15px solid #d8d8d8;

        content: "";

        margin-left: 143px;

        border-right: 15px solid transparent;

    }



</style>



<?

$soft .= ob_get_contents();

ob_end_clean();

ob_start();

?>

<br><br>

<div style="width:1100px; min-height: 500px; overflow: auto;   margin: auto;  margin-bottom: 40px;">

    <h1 style="  margin: auto;  width: 90%;  text-align: center;  font-size: 22px;    color: rgb(245, 245, 245);    text-shadow: 1px 1px 1px black;    text-align: center;    background: rgb(2, 96, 233);    padding: 7px 0px;  margin-top: 18px;">

        *Weintek, таблица сравнения серий iP, iE/iER, eMT, mTV, XE, cMT, cMT3151</h1>



    <div id="tabs" style="  margin: auto;border:none;overflow:hidden;">

        <div style="  font-size: 20px;">



            <div style="position: relative;z-index: 4;  text-align: justify;">



                <table class="sravnenie" style="position:absolute;z-index:600;">

                    <tbody>

                        <tr>

                            <td><p>Серия</p></td>

                            <td><p><a href="/weintek/series_MT8000iP.php">iP</a></p></td>

                            <td><p><a href="/weintek/series_MT8000iE.php">iE/iER</a></p></td>

                            <td><p><a href="/weintek/series_eMT3000.php">eMT</a></p></td>

                            <td><p><a href="/weintek/mTV-100.php">mTV</a></p></td>

                            <td><p><a href="/weintek/series_MT8000XE.php">XE</a></p></td>

                            <td><p><a href="/weintek/CloudHMI.php">cMT</a></p></td>

                            <td><p><a href="/weintek/cMT3151.php">cMT3151</a></p></td>

                        </tr>

                        <tr>

                </table>

                <div style="width:100%;display: block;overflow-y:scroll;height: 600px;margin-top: 60px;margin-bottom:40px;">

                    <table class="sravnenie">

                        <tbody>

                            <tr>

                                <td><p>Серия</p></td>

                                <td>&nbsp;</td>

                                <td>&nbsp;</td>

                                <td>&nbsp;</td>

                                <td>&nbsp;</td>

                                <td>&nbsp;</td>

                                <td>&nbsp;</td>

                                <td>&nbsp;</td>

                            </tr>

                            <tr>

                                <td><p>Размер проекта</p></td>

                                <td>16Mb</td>

                                <td>16Mb</td>

                                <td>64Mb</td>

                                <td>64Mb</td>

                                <td>64Mb</td>

                                <td>32Mb</td>

                                <td>32Mb</td>

                            </tr>

                            <tr>

                                <td><p>Размер логов</p></td>

                                <td>16Mb</td>

                                <td>16Mb</td>

                                <td>64Mb</td>

                                <td>64Mb</td>

                                <td>

                                    <div class="question-s">*

                                        <div class="note-s">Размер логов MT8090/8091/8092XE &mdash; 120 MB; MT8121/8150XE &mdash; 64MB.</div>

                                    </div>

                                </td>

                                <td>

                                    <div class="question-s">*

                                        <div class="note-s">Максимум: 40 выборок данных, 10000 записей в каждой. Кроме cMT-iV5.</div>

                                    </div>

                                </td>

                                <td>

                                    <div class="question-s">*

                                        <div class="note-s">Максимум: 40 выборок данных, 10000 записей в каждой.</div>

                                    </div>

                                </td>

                            </tr>

                            <tr>

                                <td><p>Построение данных загруженных с USB-диска или SD-карты</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td></td>

                                <td></td>

                            </tr>

                            <tr>

                                <td><p>Защита проекта</p></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td>

                                    <div class="question-s">*

                                        <div class="note-s">cMT-iV5 не поддерживает защиту проектов.</div>

                                    </div>

                                </td>

                                <td><p>&#10003;</p></td>

                            </tr>

                            <tr>

                                <td><p>Загрузка проекта с USB-диска</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                            </tr>

                            <tr>

                                <td><p>Прямая загрузка проекта с USB-диска</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                            </tr>

                            <tr>

                                <td><p>Загрузка проекта через Ethernet</p></td>

                                <td>н/д</td>

                                <td>

                                    <div class="question-s">*

                                        <div class="note-s">MT6070/6071iE не поддерживают загрузку проектов через Ethernet.</div>

                                    </div>

                                </td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                            </tr>

                            <tr>

                                <td><p>Библиотеки изображений/фигур в файле проекта</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                            </tr>

                            <tr>

                                <td><p>Информация о метках ПЛК в файле проекта</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                            </tr>

                            <tr>

                                <td><p>3G/4G Dongle (переключение)</p></td>

                                <td></td>

                                <td></td>

                                <td></td>

                                <td></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td></td>

                            </tr>

                            <tr>

                                <td><p>e-Mail</p></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                            </tr>

                            <tr>

                                <td><p>Расширенная безопасность</p></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                            </tr>

                            <tr>

                                <td><p>Ethernet-принтер</p></td>

                                <td></td>

                                <td></td>

                                <td></td>

                                <td></td>

                                <td></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                            </tr>

                            <tr>

                                <td><p>Off-line симуляция на панели</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                            </tr>

                            <tr>

                                <td><p>Пользовательский экран загрузки</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                            </tr>

                            <tr>

                                <td><p>USB-модем</p></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                            </tr>

                            <tr>

                                <td><p>VNC-сервер</p></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                            </tr>

                            <tr>

                                <td>"Сквозной проход" ПЛК для Siemens</td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                            </tr>

                            <tr>

                                <td><p>Аудиовыход</p></td>

                                <td></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td></td>

                                <td></td>

                                <td>

                                    <div class="question-s">*

                                        <div class="note-s">cMT-iV5 имеет встроенный моно-динамик.</div>

                                    </div>

                                </td>

                                <td><p>&#10003;</p></td>

                            </tr>

                            <tr>

                                <td><p>CAN Bus</p></td>

                                <td></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td></td>

                                <td>

                                    <div class="question-s">*

                                        <div class="note-s">MT8091/8092XE поддерживают CAN Bus.</div>

                                    </div>

                                </td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                            </tr>

                            <tr>

                                <td><p>Wi-Fi</p></td>

                                <td></td>

                                <td>

                                    <div class="question-s">*

                                        <div class="note-s">MT8103iE поддерживает Wi-Fi.</div>

                                    </div>

                                </td>

                                <td></td>

                                <td></td>

                                <td></td>

                                <td></td>

                                <td></td>

                            </tr>

                            <tr>

                                <td><p>Сканер штрихкодов (Android-камера)</p></td>

                                <td></td>

                                <td></td>

                                <td></td>

                                <td></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                            </tr>

                            <tr>

                                <td><p>Круговая диаграмма</p></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td></td>

                                <td></td>

                            </tr>

                            <tr>

                                <td><p>Комбо-кнопка</p></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                            </tr>

                            <tr>

                                <td><p>Сервер баз данных (Mysql)</p></td>

                                <td></td>

                                <td></td>

                                <td></td>

                                <td></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                            </tr>

                            <tr>

                                <td><p>Дата / Время</p></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                            </tr>

                            <tr>

                                <td><p>Динамическое рисование</p></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td></td>

                                <td></td>

                            </tr>

                            <tr>

                                <td><p>Динамическая шкала</p></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                            </tr>

                            <tr>

                                <td><p>Настройка потребностей в электроэнергии </p></td>

                                <td></td>

                                <td></td>

                                <td></td>

                                <td></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                            </tr>

                            <tr>

                                <td><p>Экран мониторинга энергопотребления</p></td>

                                <td></td>

                                <td></td>

                                <td></td>

                                <td></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                            </tr>

                            <tr>

                                <td><p>Проводник</p></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                            </tr>

                            <tr>

                                <td><p>Плавающий блок</p></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                            </tr>

                            <tr>

                                <td><p>IP-камера</p></td>

                                <td></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td></td>

                                <td></td>

                            </tr>

                            <tr>

                                <td><p>Медиаплеер</p></td>

                                <td></td>

                                <td></td>

                                <td>

                                    <div class="question-s">*

                                        <div class="note-s">eMT3105P/eMT3120A/eMT3150A поддерживают медиаплеер.</div>

                                    </div>

                                </td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                            </tr>

                            <tr>

                                <td><p>MQTT-сервер (публикация)</p></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                            </tr>

                            <tr>

                                <td><p>MQTT-клиент (подписка)</p></td>

                                <td></td>

                                <td></td>

                                <td></td>

                                <td></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                            </tr>

                            <tr>

                                <td><p>Журнал операций, печать</p></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                            </tr>

                            <tr>

                                <td><p>Журнал операций, настройки</p></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                            </tr>

                            <tr>

                                <td><p>Журнал операций, просмотр</p></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                            </tr>

                            <tr>

                                <td><p>OPC UA-сервер</p></td>

                                <td></td>

                                <td></td>

                                <td></td>

                                <td></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                            </tr>

                            <tr>

                                <td><p>PDF Reader</p></td>

                                <td></td>

                                <td></td>

                                <td></td>

                                <td></td>

                                <td></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                            </tr>

                            <tr>

                                <td><p>Просмотрщик изображений</p></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                            </tr>

                            <tr>

                                <td><p>Круговая диаграмма (доли)</p></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                            </tr>

                            <tr>

                                <td><p>База данных рецептов</p></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                            </tr>

                            <tr>

                                <td><p>Импорт / экспорт рецептов</p></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                            </tr>

                            <tr>

                                <td><p>Просмотр базы данных рецептов</p></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                            </tr>

                            <tr>

                                <td><p>Таблица строк</p></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td></td>

                                <td></td>

                            </tr>

                            <tr>

                                <td><p>Таблицы</p></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                            </tr>

                            <tr>

                                <td><p>Синхронизация времени</p></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                            </tr>

                            <tr>

                                <td><p>USB-камера</p></td>

                                <td></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                            </tr>

                            <tr>

                                <td><p>Видеовход</p></td>

                                <td></td>

                                <td></td>

                                <td>

                                    <div class="question-s">*

                                        <div class="note-s">eMT3120A/eMT3150A поддерживают NTSC и PAL аналоговые видеосистемы.</div>

                                    </div>

                                </td>

                                <td></td>

                                <td></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                            </tr>

                            <tr>

                                <td><p>Потоковое видео (USB-камера)</p></td>

                                <td></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td></td>

                            </tr>

                            <tr>

                                <td><p>VNC Viewer</p></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td></td>

                                <td></td>

                            </tr>

                            <tr>

                                <td><p>CODESYS</p></td>

                                <td></td>

                                <td></td>

                                <td></td>

                                <td></td>

                                <td></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                            </tr>

                            <tr>

                                <td><p>EasyAccess 2.0</p></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                            </tr>

                            <tr>

                                <td><p>EasyDiagnoser (утилита)</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td></td>

                                <td></td>

                            </tr>

                            <tr>

                                <td><p>EasyLaucher (утилита)</p></td>

                                <td></td>

                                <td></td>

                                <td></td>

                                <td></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                            </tr>

                            <tr>

                                <td><p>EasyPrinter (утилита)</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td></td>

                                <td></td>

                            </tr>

                            <tr>

                                <td><p>EasySimulator (утилита)</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td></td>

                                <td></td>

                            </tr>

                            <tr>

                                <td><p>EasySystemSetting (утилита)</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td></td>

                                <td></td>

                            </tr>

                            <tr>

                                <td><p>EasyWatch (утилита)</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td></td>

                                <td></td>

                            </tr>

                            <tr>

                                <td><p>Utility Manager (менеджер утилит)</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                            </tr>

                            <tr>

                                <td><p>Макросы открыть / цикл / закрыть окно</p></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                            </tr>

                            <tr>

                                <td><p>Интеллектуальный индикатор&nbsp;/&nbsp;Экран индикатора</p></td>

                                <td>н/д</td>

                                <td></td>

                                <td></td>

                                <td></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                            </tr>

                            <tr>

                                <td><p>QR-код</p></td>

                                <td></td>

                                <td></td>

                                <td></td>

                                <td></td>

                                <td></td>

                                <td><p>&#10003;</p></td>

                                <td><p>&#10003;</p></td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>







        </div>

        <?= $soft ?>



    </div></div><style>

    #table_of_contents {

        list-style: none;

        font-size: 13px;

        width: 969px;

        margin: auto;

        margin-top: 15px;

        height: 20px;

    }

    #table_of_contents li {float: left;

                           margin-right: 15px;}

    #table_of_contents li a {color: rgb(22, 22, 124); text-decoration:none;}

    #table_of_contents li a:hover {text-decoration:underline;}

    #table_of_contents {font-family: Verdana, "Lucida Grande";}

</style>



<?

$out = ob_get_contents();

ob_end_clean();



$title = 'Weintek, таблица сравнения серий eMT, cMT, cMT3151, mTV, iE/iER, XE';

$keywords = 'Weintek, таблица сравнения серий eMT, cMT, cMT3151, mTV, iE/iER, XE';

$description = 'Размер проекта, логов, использования медиа, безопасность, удаленный доступ, подключение, протоколы, графические возможности, экспорт, импорт, использование баз данных, MQTT.';



global $extra_openGraph;

$extra_openGraph = Array(

    "openGraph_image" => "http://www.rusavtomatika.com/upload_files/images/openGraph_images/weintek-stavnenie-seriy.png",

    "openGraph_title" => "Weintek, таблица сравнения серий",

    "openGraph_siteName" => "Русавтоматика"

);



$template_file = 'head.html';





$head = head($template_file, $title, $description, $keywords);



echo $head;

?>

<div id='mes_backgr'> </div>

<div id='body_cont' >

    <? include $_SERVER["DOCUMENT_ROOT"] . "/include/header_menu.php"; ?>

    <table width='100%' bgcolor='white'><tr height='93'><td width='300px'>

                <a href="/"><img src="/images/logo2017.png" /></a>

            </td>

            <td> </td>

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

    add_to_basket();

    popup_messages();

    temp2();

    echo "<article>";

    ?><div class="compare_weintek_table_wrapp">

        <?

        include 'include/compare_weintek_table_substitutions.php';

        include 'include/compare_weintek_table.php';

        echo compare_weintek_table_substitutions($compare_weintek_table);

        ?></div>

    <script>

        var div = $('#kepka');

        var start = $(div).offset().top;



        $.event.add(window, "scroll", function () {

            var p = $(window).scrollTop();

            $(div).css('position', ((p) > start) ? 'fixed' : 'static');

            $(div).css('width', '1300px');

            $(div).css('box-shadow', '0px 7px 10px rgba(0,0,0,0.3)');

            $(div).css('top', ((p) > start) ? '0px' : '');

        });

    </script>

    <?

//    echo $out;



echo "</article>";



    temp3();

    ?>