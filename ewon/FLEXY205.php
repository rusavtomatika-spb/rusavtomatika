<?php
session_start();
define("bullshit", 1);
include "../sc/dbcon.php";
include("../sc/lib_new.php");
include("../sc/vars.php");
//echo str_replace(".php", "", basename($_SERVER['PHP_SELF']));
global $mysqli_db;

database_connect();


$vta = (explode('?', $_SERVER['REQUEST_URI']));

$var_to_array = str_replace("/index.php", "/", $vta[0]);
$var_to_array = str_replace("index.php", "", $var_to_array);
//echo $_SERVER['QUERY_STRING'];
$CANONICAL = $var_to_array;

//---------------content ---------------------


$blockI = $blockM = $blockX = $blockB = $blockA  = 0;


$num = "FLEXY205";
$sql = "SELECT * FROM products_all WHERE `model` = '$num' ";
$res = mysqli_query($mysqli_db, $sql) or die(mysqli_error($mysqli_db));
$r = mysqli_fetch_object($res);


$title = 'EWON Flexy 205, шлюз промышленного интернета вещей (IIoT) и VPN-роутер';
$keywords = ', шлюз IIoT, промышленный, VPN, роутер, eWON, Flexy, vpn-роутер, облачный, защищенный, удаленный, доступ, оборудование';
$description = 'eWON Flexy 205 - это универсальный шлюз промышленного «Интернета вещей» (IIoT) и маршрутизатор с поддержкой удаленного доступа для машиностроительных предприятий.';
$vars = show_pc_variants($num);

$nav = '<br /><nav><a href="/">Главная</a>&nbsp;/&nbsp;<a href="/ewon/">eWON VPN-роутеры и VPN-серверы</a>&nbsp;/&nbsp;EWON FLEXY 205, шлюз IIoT и VPN-роутер</nav>';
/*
  if($r->onstock==0) $onst="<div class=onstock> <img src='../images/red_sq.gif' >&nbsp;&nbsp;&nbsp;под заказ 4 нед.</div>";
  else $onst= "<div class=onstock><img src='../images/green_sq.gif' >&nbsp;&nbsp;&nbsp;есть на складах: СПБ, МСК, КИЕВ</div>";
 */

$onst = show_stock($r, 1);

//$min_table = miniatures($num, 5, 10, 350); // mins_in_row, mins_max, table_width
//$im1 = get_big_pic($num);
$alt = get_kw("alt");


//echo "!!!!!!!!!!!!!!!!!" . $num;
//-----------------end content


$template_file = 'head_canonical.html';
//$head = head($template_file, $title, $description, $keywords, '<link rel="stylesheet" type="text/css" href="/ewon/ewon_styles.css" />', '<script type="text/javascript" src="/ewon/ewon_scripts.js"></script>');
$imgRemoteDir = "/images/" . mb_strtolower($r->brand) . "/" . mb_strtolower($r->type) . "/" . $r->model . "/";
ob_start();?>


<meta property='og:title' content='<?=$title?>' />
<meta property="og:image" content="<?echo 'http://www.rusavtomatika.com' . $imgRemoteDir . 'md/' . $r->model . '_1.png'?>" />
<meta property='og:site_name' content='Русавтоматика' />
<link rel='image_src' href="<?echo 'http://www.rusavtomatika.com' . $imgRemoteDir . 'md/' . $r->model . '_1.png'?>">

<?$expansionParam = ob_get_clean();

//$head = head($template_file, $title, $description, $keywords);
$head = setHeaderExpansionParam($template_file, $title, $description, $keywords, '<link rel="stylesheet" type="text/css" href="/ewon/ewon_styles.css" />', '<script type="text/javascript" src="/ewon/ewon_scripts.js"></script>', $expansionParam);

$head = str_replace('[>CANONICAL<]', 'https://' . $_SERVER["HTTP_HOST"] . $CANONICAL, $head);

echo $head;
?>
    <link rel="stylesheet" type="text/css" href="/ewon/template_style.css"/>
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


$name = 'EWON FLEXY 205';
$type = 'шлюз IIoT и VPN-роутер';
ob_start();
include dirname(__FILE__) . '/templates/price_block.php';
echo ob_get_clean();
?>


    <div id=cont_rp>

        <br>
        <table width=100%>

            <tbody>
            <tr>
                <td class="td_tick"></td>
                <td class="hl_text"><b>Варианты применения:</b> Удаленный сбор данных на платформе IIot, удаленный
                    мониторинг,
                    удаленный доступ
                </td>
            </tr>
            <tr>
                <td class="td_tick"></td>
                <td class="hl_text">Шлюз IIoT поддерживает большинство протоколов ПЛК</td>
            </tr>
            <tr>
                <td class="td_tick"></td>
                <td class="hl_text">Варианты подключения к сети: Ethernet, 4G, 3G, WiFi</td>
            </tr>
            <tr>
                <td class="td_tick"></td>
                <td class="hl_text">Высокая производительность обработки данных</td>
            </tr>
            <tr>
                <td class="td_tick"></td>
                <td class="hl_text">Сервер OPC UA и Modbus</td>
            </tr>
            <tr>
                <td class="td_tick"></td>
                <td class="hl_text">
                    Установка на DIN рейку и питание 24VDC<br>
                    Компактный и прочный корпус идеально подходит для установки в электротехнический шкаф
                </td>
            </tr>
            <tr>
                <td class="td_tick"></td>
                <td class="hl_text">Удобная настройка через встроенный веб-интерфейс</td>
            </tr>
            <tr>
                <td class="td_tick"></td>
                <td class="hl_text">Поддержка <a target="_blank" href="/mqtt/">MQTT</a></td>
            </tr>
            <tr>
                <td class="td_tick"></td>
                <td class="hl_text">SD карта, подготовленная для простого ввода в эксплуатацию</td>
            </tr>
            </tbody>
        </table>
        <a style="text-decoration:none;font-size:17px;display:block;width:350px;overflow:hidden;padding:15px;background: rgba(0,255,0,0.1); font-weight: bold"
           href="/video/ewon-cosy-131-vpn-router-bystryy-start-nachalnaya-nastroyka/">
            <img src="/images/video/ewon131video.jpg" style="float:right;width: 100px;"/>
            Видео по быстрой настройке роутера eWON
        </a>
    </div>
    </td></tr></table>
    <style>
        #rou_desc {
            text-align: justify;
            width: 100%;
            font-family: Verdana, 'Lucida Grande';
            font-size: 14px;

        }

        #dd {
            text-align: center;
        }

        #dd img {
            max-height: 300px;
            max-width: 400px;
        }

        h2 {
            font-size: 14px;
            color: gray;
            margin: 17px 10px 12px 10px;
        }

        .com_about {
            width: 200px;
            float: left;
        }

        .scheme {
            width: 600px;
            float: right;
        }

        .com {
            color: gray;
            margin-bottom: 50px;
        }

        .scheme table tr td {
            border: 1px solid gray;
            padding: 3px 15px;
            font-size: 11px;
        }

        .gray {
            background-color: rgb(245, 245, 245);
        }

        .image-right {
            float: right;
            margin: 0 0 20px 20px;
            transition: 0.3s;
        }

        a .image-right {
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            transform: scale(0.98);
        }

        a:hover .image-right {
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
            transform: scale(1);
        }

        .open_big {
            transition: 0.3s;
        }

        a .open_big {
            transform: scale(0.98);
        }

        a:hover .open_big {
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
            transform: scale(1);
        }

    </style>
    <br><br>
    <div id=rou_desc>
        <p>
            <a href="/images/ewon/FLEXY205/article-ewon-flexy205.png" rel="lightbox">
                <img class="image-right" src="/images/ewon/FLEXY205/article-ewon-flexy205_sm.png"/>
            </a>
            eWON Flexy 205 - это универсальный <b>шлюз промышленного «Интернета вещей»
                (IIoT)</b> и <b>маршрутизатор</b> с поддержкой удаленного доступа для машиностроительных предприятий.
            Он обеспечивает <b>удаленный доступ</b> через <b>VPN</b> с сервисом для дистанционного подключения eWON
            Talk2M, а также позволяет получать
            уведомления о неисправностях, считывать данные машин и просматривать журналы хронологической регистрации
            событий для контроля и сбора важнейших ключевых показателей производительности (КПП), необходимых для
            анализа и профилактического технического обслуживания.</p>
        <p>Наряду с этими функциями он может быть адаптирован согласно конкретной возможности подключения
            пользователя за счет установки дополнительных карт расширения при покупке или в дальнейшем по мере
            необходимости. Вы можете сделать его настолько простым или многофункциональным, насколько это необходимо.
            Кроме того, существует возможность интеграции данных в собственные системы или облачные платформы с помощью
            интерфейса прикладного программирования Talk2M (API), создания скриптов HTTPs или <b>MQTT</b> и множества
            других
            поддерживаемых протоколов.</p>
        <p>Сегодня машиностроители стремятся предоставить дополнительные услуги, повышающие ценность основных,
            например, не только удаленный доступ, но и <b>сбор данных</b>. В то же время предлагаемое конструктивное
            решение
            должно иметь компактное исполнение, чтобы помещаться в электротехнический шкаф. Благодаря <b>широкому
                ассортименту карт расширения</b>
            и <b>совместимости с ПЛК</b> ведущих брендов это устройство является идеальным шлюзом IIoT для
            машиностроительных предприятий.</p>
        <p>Кроме того, HMS и eWON тесно сотрудничают с партнерами в части программного обеспечения для IIoT, чтобы
            предлагать полностью готовые,
            защищенные и функциональные решения для контроля производительности, подготовки отчетов, анализа информации
            и технического обслуживания и эффективно использовать данные, собираемые на промышленном оборудовании. Все
            партнерское программное обеспечение для IIoT тестируется и проверяется для использования в
            eWON Flexy 205.</p>
    </div>

<?
if ($r->ethernet != "" && $r->software != "") {
    $dop = "<tr><td class=par_name1 >Удаленный доступ к устройству</td><td class=par_val1 >FTP(архивы, рецепты, журнал событий), VNC (удаленная работа),<br>
   EasyAccess (удаленная работа, загрузка проекта )</td></tr>
   <tr><td class=par_name1 >Ftp доступ к памяти устройства</td><td class=par_val1 >" . ($r->ftp_access_hmi_mem ? "Есть" : "-") . "</td></tr>
   <tr><td class=par_name1 >Ftp доступ к SD карте и флешке</td><td class=par_val1 >" . ($r->ftp_access_sd_usb ? "Есть" : "-") . "</td></tr>
   ";
} else
    $dop = "";

$arch = "память устройства";
if ($r->usb_host != "")
    $arch .= ", флешка";
if ($r->sdcard != "")
    $arch .= ", SD карта";

$modbus = "RTU, ASCII, Master, Slave";
if ($r->ethernet != "")
    $modbus .= ", TCP/IP";

$modbus = "<tr><td class=par_name1 >Поддержка Modbus</td><td class=par_val1 >$modbus</td></tr>";
if ($r->os != "")
    $modbus = "";

$mpi = "<tr><td class=par_name1 >Поддержка MPI</td><td class=par_val1 >187,5 K</td></tr>";
if ($r->os != "")
    $mpi = "";

$mount = "";
if ($r->wall_mount != "")
    $mount .= "в стену";
if ($r->vesa75 != "")
    $mount .= ", VESA 75x75";
if ($r->vesa100 != "")
    $mount .= ", VESA 100x100";

$sp_data1 = "
 ";
?>
    <br><span class=big_pan_name><b>Возможные модификации:</b></span> <br><br>
<?
echo $vars;

//---------------------end tab1 -------------------------
//-------------spec ---------------------------
?><br><br>
    <div class="tabs_wrapper" style='width:100%; min-height: 500px; overflow: auto; '>
    <div id='tabs'>
        <ul>
            <li class='urlup' data='functions'><a href='#tabs-1'>ХАРАКТЕРИСТИКИ</a></li>
            <li class='urlup' data='dimensions'><a href='#tabs-2'>ГАБАРИТЫ</a></li>

            <li class='urlup' data='software'><a href='#tabs-4'>СКАЧАТЬ</a></li>
            <li class='urlup' data='accessories'><a href='#tabs-5'>МОДУЛИ</a></li>
        </ul>
        <div id='tabs-1'>
            <h2>Технические характеристики <?= $r->model ?></h2>


            <div style='width:90%;'>

                <br/>
                <span class=hpar>Параметры</span><br>
                <table width=100% class=mytab2 cellpadding=0 cellspacing=0 border=1 bordercolor=#dddddd>
                    <tr>
                        <td class=par_name1>Интерфейсы</td>
                        <td class=par_val1>4 x RJ45 Ethernet 10/100 Mb . Настраиваемые LAN/WAN порты, порт 1 всегда
                            LAN
                        </td>
                    </tr>
                    <tr>
                        <td class=par_name1>Маршрутизация</td>
                        <td class=par_val1>Между LAN и WAN Ethernet и шлюз между Ethernet и COM</td>
                    </tr>
                    <tr>
                        <td class=par_name1>Маршрутизация между Ethernet и COM</td>
                        <td class=par_val1>
                            MODBUS TCP -> MODBUS RTU;<br> XIP -> UNITELWAY;<br> EtherNet/IP™ -> DF1;<br>
                            FINS TCP -> FINS Hostlink;<br>ISO TCP -> PPI, MPI (S7) или PROFIBUS (S7);<br>
                            VCOM -> ASCII
                        </td>
                    </tr>
                    <tr>
                        <td class=par_name1>Протоколы обмена данными</td>
                        <td class=par_val1>OPC UA, Modbus, MQTT, SNMP</td>
                    </tr>
                    <tr>
                        <td class=par_name1>События</td>
                        <td class=par_val1>
                            Уведомления по email, SMS, FTP, SNMP. 4 порога: low, lowlow, high, highhigh + deadband and
                            activation delay. Журанал событий по http и через FTP, Цикл событий: ALM, RTN, ACK and END
                        </td>
                    </tr>
                    <tr>
                        <td class=par_name1>Записей журнала</td>
                        <td class=par_val1>Внутренняя база для записи данных, 1 млн. временнЫх точек. Экспорт журнала
                            через FTP или E-mail.
                        </td>
                    </tr>
                    <tr>
                        <td class=par_name1>Устройство для чтение карт памяти</td>
                        <td class=par_val1>SD card (простой ввод в эксплуатацию,
                            прошивка, архивация, регистрация Talk2M)
                        </td>
                    </tr>
                    <tr>
                        <td class=par_name1>Роутер</td>
                        <td class=par_val1>IP фильтрация, IP форвардинг, NAT, Прокси, Таблица маршрутизации, DHCP
                            клиент
                        </td>
                    </tr>
                    <tr>
                        <td class=par_name1>VPN туннель</td>
                        <td class=par_val1>Open VPN 2.0 через SSL UDP либо HTTPS</td>
                    </tr>
                    <tr>
                        <td class=par_name1>VPN безопасность</td>
                        <td class=par_val1>
                            Модель VPN защиты основана на использовании SSL/TLS для аутентификации сессии и IPSec ESP
                            протокол для безопасного транспортного туннеля по UDP. Она поддерживает
                            X509 PKI ( инфраструктура публичного ключа ) для аутентификации сессии, TLS протокл для
                            обмена ключами, шифро-независимый EVP (DES, 3DES, AES, BF ) интерфейс
                            для шифрования данных туннеля, и HMAC-SHA1 алгоритм для аутентификации данных туннеля.
                        </td>
                    </tr>
                    <tr>
                        <td class=par_name1>Синхронизация</td>
                        <td class=par_val1>встроенные часы реального времени, ручная настройка по http,
                            либо автоматическая по NTP
                        </td>
                    </tr>
                    <tr>
                        <td class="par_name1">Управление файлами</td>
                        <td class="par_val1">FTP клиент и сервер для конфигурации, обновления прошивки и переноса
                            данных
                        </td>
                    </tr>
                    <tr>
                        <td class=par_name1>Встроенный ВЕБ Интерфейс</td>
                        <td class=par_val1>встроенный веб интерфейс с Мастерами настроек для конфигурации и обслуживания
                            (не нужно дополнительное ПО ) Базовая аутентификация ( логин/пароль) и контроль сессии для
                            безопасности. Возможно создать пользовательскую страницу с
                            с интерфейсом.
                        </td>
                    </tr>
                    <tr>
                        <td class=par_name1>Обслуживание</td>
                        <td class=par_val1>SNMP V1 с MIB2, либо по FTP</td>
                    </tr>
                    <tr>
                        <td class=par_name1>Точки ввода вывода</td>
                        <td class=par_val1>2xDI (0-12/24VDC, изоляция 1.5kV), 1xDO (открытый коллектор MOSFET 200mA,
                            изоляция 1.5kV)
                        </td>
                    </tr>
                </table>

                <br><br>


                <span class=hpar>Конструкция</span><br>
                <table width=100% class=mytab2 cellpadding=0 cellspacing=0 border=1 bordercolor=#dddddd>
                    <tr>
                        <td class=par_name1>Материал корпуса</td>
                        <td class=par_val1>пластик</td>
                    </tr>
                    <tr>
                        <td class=par_name1>Способ охлаждения</td>
                        <td class=par_val1>безвентиляторное</td>
                    </tr>
                    <tr>
                        <td class=par_name1>Варианты установки</td>
                        <td class=par_val1>на ДИН рейку EN50022-совместимый</td>
                    </tr>
                    <tr>
                        <td class=par_name1>Разъем питания</td>
                        <td class=par_val1>клеммный</td>
                    </tr>
                    <tr>
                        <td class=par_name1>Напряжение питания</td>
                        <td class=par_val1>12-24 VDC +/-20%,</td>
                    </tr>
                    <tr>
                        <td class=par_name1>Потребляемая мощность</td>
                        <td class=par_val1>потребление зависит от установленных карт расширений</td>
                    </tr>
                    <tr>
                        <td class=par_name1>Габариты</td>
                        <td class=par_val1>133x122x55 мм(В x Г x Ш )</td>
                    </tr>
                    <tr>
                        <td class=par_name1>Вес</td>
                        <td class=par_val1>280гр (без карт расширений)</td>
                    </tr>
                    <tr>
                        <td class=par_name1>Рабочая температура</td>
                        <td class=par_val1>-25&deg ~ +70&deg</td>
                    </tr>
                    <tr>
                        <td class=par_name1>Температура хранения</td>
                        <td class=par_val1>-40&deg ~ +70&deg</td>
                    </tr>
                    <tr>
                        <td class=par_name1>Относительная влажность</td>
                        <td class=par_val1>от 10 до 95% (без конденсации)</td>
                    </tr>

                </table>
            </div>


        </div>
        <?
        if ($GLOBALS["net"] == 0) {
            $file = $path_to_real_files . '/images/ewon/dim/FLEXY205.png';
            if (file_exists($file)) {
                $yes = 1;
            }
        } else {
            $file = $root_php . '/images/ewon/dim/FLEXY205.png';
            $re = cu($file);
            if ($re[0] > 0) {
                $yes = 1;
            };
        };
        if ($yes == 1) {
            ?>
            <div id='tabs-2' style=''>
            <h2>Габариты <?= $r->model ?></h2>
            <img src='/images/ewon/dim/FLEXY205.png'>
            </div><? } else {
            ?>
            <div id='tabs-2'>
                Габариты 55х133х122 мм
            </div><?
        };


        //---------------------download section -------------------------------- ------------------------------
        $file = 'install/Flexy205.pdf';

        if ($GLOBALS["net"] == 0) {
            if (file_exists($root_php . $file)) {
                $fs = (sprintf("%u", filesize($root_php . $file)) + 0) / 1000;
                $t = date("d-m-Y", filemtime($root_php . $file));
            } else {
                $blockI = 1;
            };
        } else {

            $re = cu($root_php . '/' . $file);

            if ($re[0] > 0) {
                $t = date("d-m-Y", $re[1]);
                $fs = (sprintf("%u", $re[0]) + 0) / 1000;
            } else {
                $blockI = 1;
            };
        };


        if ($blockI != 1) {


            if ($fs > 1000) {
                $s = round($fs / 1000, 2) . '&nbsp;Мб';
            } else {
                $s = round($fs, 0) . '&nbsp;Кб';
            };
            $soft7 = "
 <tr><td><div class=down_item>Инструкция по установке базового модуля Flexy205</div></td>
   <td><div class=dt_item>$t<br>$s</div></td>
   <td><div class=down_item><a href='/install/Flexy205.pdf' > <img src=/images/manual.jpg></a></div></td></tr>
 ";
        } else {
            $soft7 = '';
        };

        $file = 'manuals/Flexy205.pdf';
        if ($GLOBALS["net"] == 0) {
            if (file_exists($root_php . $file)) {
                $fs = (sprintf("%u", filesize($root_php . $file)) + 0) / 1000;
//$s =  ceil($fs/1000);
            } else {
                $blockM = 1;
            };
        } else {
            $re = cu($root_php . '/' . $file);
            if ($re[0] > 0) {
                $t = date("d-m-Y", $re[1]);
                $fs = (sprintf("%u", $re[0]) + 0) / 1000;
            } else {
                $blockM = 1;
            };
        };


        if ($blockM != 1) {


            if ($fs > 1000) {
                $s = round($fs / 1000, 2) . '&nbsp;Мб';
            } else {
                $s = round($fs, 0) . '&nbsp;Кб';
            };
            $soft5 = "
 <tr><td><div class=down_item>Брошюра (datasheet) Flexy 205</div></td>
   <td><div class=dt_item>$t<br>$s</div></td>
   <td><div class=down_item><a href='/manuals/Flexy205.pdf' > <img src=/images/manual.jpg></a></div></td></tr>
 ";
        } else {
            $soft5 = '';
        };


        $file = 'install/FLX3101.pdf';
        if ($GLOBALS["net"] == 0) {
            if (file_exists($root_php . $file)) {
                $fs = (sprintf("%u", filesize($root_php . $file)) + 0) / 1000;
                $t = date("d-m-Y", filemtime($root_php . $file));
            } else {
                $blockX = 1;
            };
        } else {
            $re = cu($root_php . '/' . $file);
            if ($re[0] > 0) {
                $t = date("d-m-Y", $re[1]);
                $fs = (sprintf("%u", $re[0]) + 0) / 1000;
            } else {
                $blockX = 1;
            };
        };

        if ($blockX != 1) {

            if ($fs > 1000) {
                $s = round($fs / 1000, 2) . '&nbsp;Мб';
            } else {
                $s = round($fs, 0) . '&nbsp;Кб';
            };
            $soft1 = "
 <tr><td><div class=down_item>Инструкция по установке карты расширения Flexy FLX 3101  </div></td>
   <td><div class=dt_item>$t<br>$s</div></td>
   <td><div class=down_item><a href='/install/FLX3101.pdf' > <img src=/images/manual.jpg></a></div></td></tr>
 ";
        } else {
            $soft1 = '';
        };

        $file = 'install/FLB3202.pdf';
        if ($GLOBALS["net"] == 0) {
            if (file_exists($root_php . $file)) {
                $fs = (sprintf("%u", filesize($root_php . $file)) + 0) / 1000;
                $t = date("d-m-Y", filemtime($root_php . $file));
            } else {
                $blockB = 1;
            };
        } else {
            $re = cu($root_php . '/' . $file);
            if ($re[0] > 0) {
                $t = date("d-m-Y", $re[1]);
                $fs = (sprintf("%u", $re[0]) + 0) / 1000;
            } else {
                $blockB = 1;
            };
        };


        if ($blockB != 1) {


            if ($fs > 1000) {
                $s = round($fs / 1000, 2) . '&nbsp;Мб';
            } else {
                $s = round($fs, 0) . '&nbsp;Кб';
            };
            $soft2 = "
 <tr><td><div class=down_item>Инструкция по установке карты расширения Flexy FLB 3202  </div></td>
   <td><div class=dt_item>$t<br>$s</div></td>
   <td><div class=down_item><a href='/install/FLB3202.pdf' > <img src=/images/manual.jpg></a></div></td></tr>
 ";
        } else {
            $soft2 = '';
        };


        $file = 'install/FLA3301.pdf';
        if ($GLOBALS["net"] == 0) {
            if (file_exists($root_php . $file)) {
                $fs = (sprintf("%u", filesize($root_php . $file)) + 0) / 1000;
                $t = date("d-m-Y", filemtime($root_php . $file));
            } else {
                $blockA = 1;
            };
        } else {
            $re = cu($root_php . '/' . $file);
            if ($re[0] > 0) {
                $t = date("d-m-Y", $re[1]);
                $fs = (sprintf("%u", $re[0]) + 0) / 1000;
            } else {
                $blockA = 1;
            };
        };

        if ($blockA != 1) {


            if ($fs > 1000) {
                $s = round($fs / 1000, 2) . '&nbsp;Мб';
            } else {
                $s = round($fs, 0) . '&nbsp;Кб';
            };
            $soft3 = "
 <tr><td><div class=down_item>Инструкция по установке карты расширения Flexy FLA 3301  </div></td>
   <td><div class=dt_item>$t<br>$s</div></td>
   <td><div class=down_item><a href='/install/FLA3301.pdf' > <img src=/images/manual.jpg></a></div></td></tr>
 ";
        } else {
            $soft3 = '';
        };


        /**/
        $file = 'install/FLX3401.pdf';
        if ($GLOBALS["net"] == 0) {
            if (file_exists($root_php . $file)) {
                $fs = (sprintf("%u", filesize($root_php . $file)) + 0) / 1000;
                $t = date("d-m-Y", filemtime($root_php . $file));
            } else {
                $blockX = 1;
            };
        } else {
            $re = cu($root_php . '/' . $file);
            if ($re[0] > 0) {
                $t = date("d-m-Y", $re[1]);
                $fs = (sprintf("%u", $re[0]) + 0) / 1000;
            } else {
                $blockX = 1;
            };
        };

        if ($blockX != 1) {

            if ($fs > 1000) {
                $s = round($fs / 1000, 2) . '&nbsp;Мб';
            } else {
                $s = round($fs, 0) . '&nbsp;Кб';
            };
            $soft11 = "
 <tr><td><div class=down_item>Инструкция по установке карты расширения Flexy FLX3401  </div></td>
   <td><div class=dt_item>$t<br>$s</div></td>
   <td><div class=down_item><a href='/install/FLX3401.pdf' > <img src=/images/manual.jpg></a></div></td></tr>
 ";
        } else {
            $soft11 = '';
        };
        /**/

        /* FLB3271.pdf */
        $file = 'install/FLB3271.pdf';
        if ($GLOBALS["net"] == 0) {
            if (file_exists($root_php . $file)) {
                $fs = (sprintf("%u", filesize($root_php . $file)) + 0) / 1000;
                $t = date("d-m-Y", filemtime($root_php . $file));
            } else {
                $blockX = 1;
            };
        } else {
            $re = cu($root_php . '/' . $file);
            if ($re[0] > 0) {
                $t = date("d-m-Y", $re[1]);
                $fs = (sprintf("%u", $re[0]) + 0) / 1000;
            } else {
                $blockX = 1;
            };
        };

        if ($blockX != 1) {

            if ($fs > 1000) {
                $s = round($fs / 1000, 2) . '&nbsp;Мб';
            } else {
                $s = round($fs, 0) . '&nbsp;Кб';
            };
            $soft11 .= "
 <tr><td><div class=down_item>Инструкция по установке карты расширения Flexy FLB3271  </div></td>
   <td><div class=dt_item>$t<br>$s</div></td>
   <td><div class=down_item><a href='/install/FLB3271.pdf' > <img src=/images/manual.jpg></a></div></td></tr>
 ";
        }
        /**/
        /* FLB3204.pdf */
        $file = 'install/FLB3204.pdf';
        if ($GLOBALS["net"] == 0) {
            if (file_exists($root_php . $file)) {
                $fs = (sprintf("%u", filesize($root_php . $file)) + 0) / 1000;
                $t = date("d-m-Y", filemtime($root_php . $file));
            } else {
                $blockX = 1;
            };
        } else {
            $re = cu($root_php . '/' . $file);
            if ($re[0] > 0) {
                $t = date("d-m-Y", $re[1]);
                $fs = (sprintf("%u", $re[0]) + 0) / 1000;
            } else {
                $blockX = 1;
            };
        };

        if ($blockX != 1) {

            if ($fs > 1000) {
                $s = round($fs / 1000, 2) . '&nbsp;Мб';
            } else {
                $s = round($fs, 0) . '&nbsp;Кб';
            };
            $soft11 .= "
 <tr><td><div class=down_item>Инструкция по установке карты расширения Flexy FLB3204  </div></td>
   <td><div class=dt_item>$t<br>$s</div></td>
   <td><div class=down_item><a href='/install/FLB3204.pdf' > <img src=/images/manual.jpg></a></div></td></tr>
 ";
        }
        /**/
        /**/
        /* FLC3701.pdf */
        $file = 'install/FLC3701.pdf';
        if ($GLOBALS["net"] == 0) {
            if (file_exists($root_php . $file)) {
                $fs = (sprintf("%u", filesize($root_php . $file)) + 0) / 1000;
                $t = date("d-m-Y", filemtime($root_php . $file));
            } else {
                $blockX = 1;
            };
        } else {
            $re = cu($root_php . '/' . $file);
            if ($re[0] > 0) {
                $t = date("d-m-Y", $re[1]);
                $fs = (sprintf("%u", $re[0]) + 0) / 1000;
            } else {
                $blockX = 1;
            };
        };

        if ($blockX != 1) {

            if ($fs > 1000) {
                $s = round($fs / 1000, 2) . '&nbsp;Мб';
            } else {
                $s = round($fs, 0) . '&nbsp;Кб';
            };
            $soft11 .= "
 <tr><td><div class=down_item>Инструкция по установке карты расширения Flexy FLC3701</div></td>
   <td><div class=dt_item>$t<br>$s</div></td>
   <td><div class=down_item><a href='/install/FLC3701.pdf' > <img src=/images/manual.jpg></a></div></td></tr>
 ";
        }
        /**/
        /* FLB3204.pdf */
        $file = 'install/FLB3204.pdf';
        if ($GLOBALS["net"] == 0) {
            if (file_exists($root_php . $file)) {
                $fs = (sprintf("%u", filesize($root_php . $file)) + 0) / 1000;
                $t = date("d-m-Y", filemtime($root_php . $file));
            } else {
                $blockX = 1;
            };
        } else {
            $re = cu($root_php . '/' . $file);
            if ($re[0] > 0) {
                $t = date("d-m-Y", $re[1]);
                $fs = (sprintf("%u", $re[0]) + 0) / 1000;
            } else {
                $blockX = 1;
            };
        };

        if ($blockX != 1) {

            if ($fs > 1000) {
                $s = round($fs / 1000, 2) . '&nbsp;Мб';
            } else {
                $s = round($fs, 0) . '&nbsp;Кб';
            };
            $soft11 .= "
 <tr><td><div class=down_item>Инструкция по установке карты расширения Flexy FLB3204  </div></td>
   <td><div class=dt_item>$t<br>$s</div></td>
   <td><div class=down_item><a href='/install/FLB3204.pdf' > <img src=/images/manual.jpg></a></div></td></tr>
 ";
        }
        /**/


        $file = 'install/FLA3501.pdf';
        if ($GLOBALS["net"] == 0) {
            if (file_exists($root_php . $file)) {
                $fs = (sprintf("%u", filesize($root_php . $file)) + 0) / 1000;
                $t = date("d-m-Y", filemtime($root_php . $file));
            } else {
                $blockX = 1;
            };
        } else {
            $re = cu($root_php . '/' . $file);
            if ($re[0] > 0) {
                $t = date("d-m-Y", $re[1]);
                $fs = (sprintf("%u", $re[0]) + 0) / 1000;
            } else {
                $blockX = 1;
            };
        };

        if ($blockX != 1) {

            if ($fs > 1000) {
                $s = round($fs / 1000, 2) . '&nbsp;Мб';
            } else {
                $s = round($fs, 0) . '&nbsp;Кб';
            };
            $soft12 = "
 <tr><td><div class=down_item>Инструкция по установке карты расширения Flexy FLA 3501  </div></td>
   <td><div class=dt_item>$t<br>$s</div></td>
   <td><div class=down_item><a href='/install/FLA3501.pdf' > <img src=/images/manual.jpg></a></div></td></tr>
 ";
        } else {
            $soft12 = '';
        };


        if (file_exists('software/eCatcherSetup.exe')) {


            if ($s > 1) {
                $s .= '&nbsp;Мб';
            } else {
                $s = $s * 1000;
                $s .= '&nbsp;Кб';
            };
            $ver = @file_get_contents("software/eCatcher.txt");
            if (!empty($ver)) {
                $ver = '(' . $ver . ')';
            };
            $soft8 = "
 <tr><td><div class=down_item> eCatcher, программное обеспечение eWON <span style=\"font-weight:normal\">Talk2M connector,
Services Free + and Pro</span> для vpn-роутера Flexy $ver</div></td>
   <td><div class=dt_item>$t<br>$s</div></td>
   <td><div class=down_item><a href='/software/eCatcherSetup.exe' > <img src=/vpn-routers/software/eCatcher.png style=\"width: 33px;\"></a></div></td></tr>
 ";
        } else {
            $soft8 = '';
        };

        if (file_exists('software/eCatcherSetup.exe')) {


            if ($s > 1) {
                $s .= '&nbsp;Мб';
            } else {
                $s = $s * 1000;
                $s .= '&nbsp;Кб';
            };

            if (!empty($ver)) {
                $ver = '(' . $ver . ')';
            };
            $soft9 = "
 <tr><td><div class=down_item> eBuddy, программное обеспечение eWON <span style=\"font-weight:normal\">поможет найти, назначить IP-адресс, обновить прошивку, осуществить резервное копирование и восстановление параметров </span> для vpn-роутера Flexy</div></td>
   <td><div class=dt_item>$t<br>$s</div></td>
   <td><div class=down_item><a href='/software/eBuddySetup.exe' > <img src=/vpn-routers/software/eBuddy.png style=\"width: 33px;\"></a></div></td></tr>
 ";
        } else {
            $soft9 = '';
        };


        if (file_exists($GLOBALS["EBPro_version"])) {
            $ver = file_get_contents($GLOBALS["EBPro_version"]);
        } else {
            $ver = '';
        };
        ?>
        <div id='tabs-4'>
            <div class=connectors>
                <h2>Файлы для работы с <?= $r->model ?></h2><br/><br/>
            </div>

            <table cellpadding=0 cellspacing=0 border=1 bordercolor=#cccccc width=900>
                <tr>
                    <td>
                        <div class=down_h> Наименование</div>
                    </td>
                    <td>
                        <div class=down_h> Дата, размер</div>
                    </td>
                    <td>
                        <div class=down_h> Ссылка</div>
                    </td>
                </tr>


                <?
                echo $soft8;
                echo $soft9;
                echo $soft7;
                echo $soft5;
                echo $soft1;
                echo $soft2;
                echo $soft3;
                echo $soft11;
                echo $soft12;
                ?>

            </table>

        </div>

        <div id="tabs-5">
            <br/><br/>
            <h3>Карты-расширения</h3>


            <table class="mytab2">
                <tr>
                    <td style="width: 10%;text-align: center;"><img style="max-height:100px;"
                                                                    src="/images/ewon/Extention/flexy-extention-card-2.png"/>
                    </td>
                    <td width="10%"><b>FLX 3101</b></td>
                    <td>Плата расширения Ethernet для eWON Flexy Доступ WAN Ethernet для подключения промышленного
                        оборудования к Интернету.

                    </td>
                    <td><a href="/install/FLX3101.pdf">Инструкция по установке в PDF</a></td>
                </tr>
                <tr>
                    <td style="width: 10%;text-align: center;"><img style="max-height:100px;"
                                                                    src="/images/ewon/Extention/flexy-extention-card-3.png"/>
                    </td>
                    <td><b>FLB 3202</b></td>
                    <td>Плата расширения 3G для eWON Flexy Pentaband модем для связи с использованием 2G, 3G или 3G +
                        сети сотовой связи до 7,3 Мб/сек для скачивания и 2 Мб/сек загрузки.
                    </td>
                    <td><a href="/install/FLB3202.pdf">Инструкция по установке в PDF</a></td>
                </tr>
                <tr>
                    <td style="width: 10%;text-align: center;"><img style="max-height:100px;"
                                                                    src="/images/ewon/Extention/flexy-extention-card-1.png"/>
                    </td>
                    <td><b>FLA 3301</b></td>
                    <td>Плата расширения 1*RS232/422/485+1*RS232 для eWON Flexy Двойной последовательный порт для
                        подключения любых RS232/485/422 устройств, обеспечения удаленного доступа или сбора данных с
                        использованием сервисной библиотеки eWON Flexy I/O.
                    </td>
                    <td><a href="/install/FLA3301.pdf">Инструкция по установке в PDF</a></td>
                </tr>
                <tr>
                    <td style="width: 10%;text-align: center;"><img style="max-height:100px;"
                                                                    src="/images/ewon/Extention/flexy-extention-card-7.png"/>
                    </td>
                    <td><b>FLX 3401</b></td>
                    <td> I/O-карта 8 x DI (0~10 VDC - 16 bits) изол. 4 x AI (0~12/24 VDC) изол. 2 x DO (3A/34V VAC/VDC)
                        изол.
                    </td>
                    <td><a href="/install/FLX3401.pdf">Инструкция по установке в PDF</a></td>
                </tr>
                <tr>
                    <td style="width: 10%;text-align: center;"><img style="max-height:100px;"
                                                                    src="/images/ewon/Extention/flexy-extention-card-FLB-3271.png"/>
                    </td>
                    <td><b>FLB 3271</b></td>
                    <td>Плата расширения WiFi 802.11 b,g,n WiFi/WLAN</td>
                    <td><a href="/install/FLB3271.pdf">Инструкция по установке в PDF</a></td>
                </tr>
                <tr>
                    <td style="width: 10%;text-align: center;"><img style="max-height:100px;"
                                                                    src="/images/ewon/Extention/flexy-extention-card-FLB-3204.png"/>
                    </td>
                    <td><b>FLB 3204</b></td>
                    <td>Плата расширения 4G LTE подключение к WWW через сотового оператора. Частоты: 4G: B7(2600),
                        B1(2100), B3(1800), B8(900), B20(800)MHz 3G: B1(2100), B8(900) MHz 2G: B3(1800), B8(900) MHz
                    </td>
                    <td><a href="/install/FLB3204.pdf">Инструкция по установке в PDF</a></td>
                </tr>
                <tr>
                    <td style="width: 10%;text-align: center;"><img style="max-height:100px;"
                                                                    src="/images/ewon/Extention/flexy-extention-card-FLB-3601.png"/>
                    </td>
                    <td><b>FLB 3601</b></td>
                    <td>Плата расширения 3 USB порта тип A (мама)</td>
                    <td><a href="/install/FLB3601.pdf">Инструкция по установке в PDF</a></td>
                </tr>
                <tr>
                    <td style="width: 10%;text-align: center;"><img style="max-height:100px;"
                                                                    src="/images/ewon/Extention/flexy-extention-card-FLC-3701.png"/>
                    </td>
                    <td><b>FLC 3701</b></td>
                    <td>Плата расширения MPI разъем SUBD9 (мама). Для обмена сообщениями по протоколу MPI.</td>
                    <td><a href="/install/FLC3701.pdf">Инструкция по установке в PDF</a></td>
                </tr>

            </table>
        </div>
        <br/><br/></div><br/><br/>
<?
//echo $outs;

if (!empty($_GET['tab'])) {
    if ($_GET[tab] == 'accessories') {
        $uuu = '$(\'a[href="#tabs-5"]\').click();';
    } else if ($_GET[tab] == 'functions') {
        $uuu = '$(\'a[href="#tabs-1"]\').click();';
    } else if ($_GET[tab] == 'software') {
        $uuu = '$(\'a[href="#tabs-4"]\').click();';
    } else if ($_GET[tab] == 'dimensions') {
        $uuu = '$(\'a[href="#tabs-2"]\').click();';
    } else if ($_GET[tab] == 'scheme') {
        $uuu = '$(\'a[href="#tabs-3"]\').click();';
    };
}
;
?>

<?
/**/
echo "</article></div>";
temp3();
?>