<?php
include $_SERVER["DOCUMENT_ROOT"]."/config.php";
if(EX != "_"){
    include $_SERVER["DOCUMENT_ROOT"]."/ewon_/index.php";
    exit();
}


session_start();
define("bullshit", 1);
include "../sc/dbcon.php";

include ("../sc/lib_new.php");

//echo str_replace(".php", "", basename($_SERVER['PHP_SELF']));
$section_setup = '.section.php';
if (file_exists($section_setup)) {
    include $section_setup;
}

global $mysqli_db;
database_connect();
mysqli_query($mysqli_db, "SET NAMES 'cp1251'");

include ("ewon_functions.php");

$template_file = 'head.html';

$title = 'EWON промышленные VPN-роутеры VPN-серверы Шлюзы IIoT — удаленный доступ к оборудованию';
$keywords = 'промышленный, шлюзы IIoT, VPN-роутер, VPN, роутер, eWON, Flexy, COSY, vpn-роутер, облачный, защищенный, удаленный, доступ, оборудование, COSY-141';
$description = 'Промышленные VPN-роутеры, VPN-серверы, шлюзы IIoT eWON — защищенное подключение к оборудованию через Интернет. COSY-141, Flexy, модули-расширения для подключения посредством 3G, 4G, HSUPA, Wi-Fi, Ethernet WAN, RS232/485/422 - простота, гибкость и функциональность';


$head = head($template_file, $title, $description, $keywords, '<link rel="stylesheet" type="text/css" href="/ewon/ewon_styles.css" />', '<script type="text/javascript" src="/ewon/ewon_scripts.js"></script>');

echo $head;
?>
<div id="mes_backgr"> </div>
<div id="body_cont">
    <? include $_SERVER["DOCUMENT_ROOT"] . "/include/header_menu.php"; ?>
    <table width="100%" bgcolor="white">
        <tr height="93">
            <td width="300px">
                <a href="/"><img src="/images/logo2017.png" /></a>
            </td>
            <td> </td>
        </tr>
    </table>
    <?
    top_menu();
    search();
    compare();
    backup_call();
    top_buttons();
    basket();
    temp1_no_menu();
    show_price_val("euro");

    add_to_basket();
    popup_messages();
    temp2();
    ?>
    <br><br><article><center><h1>EWON VPN-роутеры, VPN-серверы и Шлюз IIoT со склада в России</h1></center>
    <div class="table_of_contents_wrapper">
        <ul class="table_of_contents">
            <li><a class="go_to" href="#FLEXY205">Шлюз IIoT и VPN-роутер <span>FLEXY 205 &#8681</span></a></li>
            <li><a class="go_to" href="#COSY-131">VPN-роутер <span>COSY-131 &#8681;</span></a></li>
            <li><a class="go_to" href="#COSY-141">VPN-роутер  <span>COSY-141 &#8681;</span></a></li>
            <li><a class="go_to" href="#FLEXY">Модульный VPN-роутер <span>FLEXY 201 &#8681;</span></a></li>
            <li><a class="go_to" href="#eFive">VPN-серверы  <span>eFive &#8681;</span></a></li>
        </ul>
    </div>
    <script>
        $(document).ready(function () {
            $('.go_to').click(function () { // ловим клик по ссылке с классом go_to
                var scroll_el = $(this).attr('href'); // возьмем содержимое атрибута href, должен быть селектором, т.е. например начинаться с # или .
                if ($(scroll_el).length != 0) { // проверим существование элемента чтобы избежать ошибки
                    $('html, body').animate({scrollTop: $(scroll_el).offset().top}, 500); // анимируем скроолинг к элементу scroll_el
                }
                return false; // выключаем стандартное действие
            });
        });
    </script>
    <div class=rou_desc style='  margin: auto;'><br>Промышленные <strong>VPN-роутеры</strong> eWON созданы для простого подключения удаленных
        объектов автоматизации к Интернет посредством защищенного VPN канала. При этом нет необходимости в запуске собственного VPN-сервера, так как eWON предлагает свой облачный сервис Talk2M.
        Таким образом, промышленные <strong>VPN-роутеры</strong> eWON - это готовое решение для тех, кому необходимо
        удаленно поддерживать, отлаживать, обновлять прошивки, мониторить оборудование.
        <br>
    </div>
    <center>

        <div class=rou_desc>



        </div>
        <div id="FLEXY205">
            <? echo flexy205(); ?>
        </div>
        <div id="COSY-131">
            <? echo cosy131(); ?>
        </div>
        <div id="COSY-141">
            <? echo cosy141(); ?>
        </div>
        <div id="FLEXY">
            <? echo flexy(); ?>
        </div>
        <div id="eFive">
            <? echo efive(); ?>
        </div>
        <br><br>
        <div style='width:1040px; text-align:justify;'>
            <div class=rou_desc>Компания eWON ( Бельгия ) - разработчик и производитель промышленных VPN-роутеров. Также компания eWON стала первой компанией в мире, разработавшей
                облачный VPN-сервис Talk2M, который позволяет удаленно управлять оборудованием подключенным к Интернету через локальную сеть без выделенного устройству внешнего IP.<br><br>
                С помощью <strong>eWON Cosy</strong> производители оборудования и системные интеграторы могут удаленно проводить наладку
                и техническое обслуживание оборудования, отлаживать программы контроллеров  ( подключенных как по Ethernet, так и по COM, либо MPI ),  операторских панелей
                загружать в них проекты, просматривать изображения с IP-камер. <br><br>
                <strong style='color:blue;'>Полноценная работа с оборудованием без выезда на объект существенно снижает затраты на обслуживания объекта и повышает производительность</strong>.<br><br>

                <strong>eWON Cosy</strong> полностью совместим с <strong>Talk2M</strong>, облачным сервисом eWON ( бесплатным ). <strong>Talk2M</strong> обеспечивает безопасное VPN соединение между пользователем
                и удаленным роутером. При этом роутеру не нужен выделенный IP. eWON Cosy и Talk2M обеспечивают простой доступ роутеру и оборудованию, подключенному к нему, так, что
                пользователю не нужно обладать знаниями в области IT.

                <strong>VPN-роутер</strong> просто подключается к локальной сети на объекте, при этом не требуется значительного вмешательства администратора сети.
                Роутер использует стандартные порты 443 (HTTPS) и 1194 (UDP).<br><br>

                <strong>VPN-роутер</strong> eWON устанавливается на удаленном объекте, к которому необходим удаленный доступ.<br><br>
                Оборудование, которое необходимо контролировать, подключается по Ethernet к разъемам \"MACHINE LAN\" (1-4), либо
                к разъему COM порта, либо MPI.<br><br>
                Разъем \"INTERNET\" <strong>VPN-роутера</strong> подключается к локальной сети объекта.<br><br>
                При этом нет необходимости конфигурировать что-либо в локальной сети объекта ( пробрасывать порты, выделять IP и т.д. ).
            </div>
            <br><br>
            <img src="/images/ewon/ewon1.png">
            <br><br>

            <div class=rou_desc>
                Также <strong>VPN-роутер</strong> eWON может быть подключен к любому роутеру с 3G, либо 4G модемом, при этом не требуется договариваться с сотовым
                оператороам о статическом IP. <strong>VPN-роутер</strong> eWON отлично справляется с установкой VPN соединения поверх мобильного трафика.
            </div>
            <br><br>
            <img src="/images/ewon/ewon_3g.png">
            <br><br>

            <div class=rou_desc>
                <strong>VPN-роутер</strong> eWON при включении устанавливает защищенное VPN соединение с сервисом Talk2M. При этом не важен способ подключения
                <strong>VPN-роутера</strong>, это может быть локальная сеть предприятия, либо роутер с 3G, либо 4G модемом. Не нужно также выделять статический IP-адрес.<br><br>
                Сервис Talk2M - это
                бесплатный сервис, предлагаемый компанией eWON. В состав сервиса Talk2M входят несколько специализированных серверов, расположенных по всему миру,
                позволяющих одновременно обслуживать тысячи VPN-роутеров eWON. <br><br>
                Как только <strong>VPN-роутер</strong> eWON подключился с сервису Talk2M, он становится доступным для подключения к нему с любого ПК, на
                котором установлено приложение eCatcher. В приложении eCatcher видны все роутеры, привязанные к аккаунту пользователя, при подключении к любому из роутеров, между ПК и
                удаленным VPN-роутером устанавливается защищенное VPN соединение, и все устройства, подключенные к этому роутеру,
                становятся доступны, как будто они находятся в одной локальной сети с ПК, на котором  запущен eCatcher.

            </div>
            <img src="/images/ewon/ewon2.png">
            <br><br>
            <div class=rou_desc>
                При установке на ПК приложение eCatcher создает виртуальный сетевой адаптер. При подключении с помощью eCatcher через Talk2M к удаленному VPN-роутеру, роутер и все удаленные
                устройства, подключенные к нему, оказываются в виртуальной локальной сети, их IP-адреса известны и имеют всегда одинаковые значения ( заданные при настройке )
                независимо от реального IP-адреса удаленного VPN-роутера ( он может быть динамическим ).<br><br>
                Например, Ваш PLC может иметь IP-адрес 192.168.12.5, операторская панель 192.168.12.2, а IP камера
                192.168.12.3, Вы всегда сможете получить доступ к Вашими устройствам по этим адресам. <br><br>
                Приложение eVCOM создает виртуальный COM порт на ПК, связанный через VPN соединение с COM портом удаленного VPN-роутера.
                Вы можете использовать любые приложения для работы с COM портом, они буду связываться с COM портом удаленного устройства и
                работать также, как если бы они были подключены непосредственно к COM порту Вашего ПК.  <br><br>

                Таким образом, к удаленным устройствам может получить доступ любое ПО, необходимое для обслуживания устройств. Например, вы запускаете GX IEC Developer, STEP7,
                CX-Programmer, EasyBuilder, либо любое другое ПО для отладки и загрузки проектов для PLC, либо панелей оператора, и работаете с удаленным устройством так,
                как будто оно находится на Вашем рабочем столе. Не важно, как ПО подключается к устройству - по Ethernet, либо по COM порту, либо по MPI, вы не почувствуете
                расстояния.
            </div>
            <br><br>

            <img src="/images/ewon/ewon3.png">
            <br><br>
        </div>
    </center></article>

    <?
    temp3();
    ?>