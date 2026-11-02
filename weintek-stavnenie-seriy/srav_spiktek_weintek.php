<?php
global $CONTENT_ON_WIDE_SCREEN;
$CONTENT_ON_WIDE_SCREEN = false;
require_once $_SERVER[ 'DOCUMENT_ROOT' ] . "/abacus/prolog.php";
global $TITLE, $CANONICAL;
global $db, $suffix;
$suffix = "_1";
$TITLE = "Weintek, таблица сравнения серий СПИКТЕК CTK и Weintek IP";
$CANONICAL = "https://www.rusavtomatika.com/weintek-stavnenie-seriy/srav_spiktek_weintek.php";
$DESCRIPTION = 'В сводной таблице Вы сможете произвести сравнение различных параметров продукции Weintek и СПИКТЕК. Параметры распределены по группам: Ограничения памяти, Загрузка проекта, ,Функциональные возможност Дополнительные интерфейсы, Доступные объекты в EasyBuilder, Объекты IIoT и контроль энергопотребления, Объекты работы с данными, Утилиты';
//ini_set( "error_reporting", E_ALL & ~E_NOTICE & ~E_WARNING );
ini_set( "error_reporting", E_ALL | E_WARNING | E_NOTICE );
ini_set( "display_errors", 1 );
ini_set( "display_startup_errors", 1 );

//---------------content ---------------------

?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        .divider {
            max-height: 1px !important;
            background-color:#A3A3A3 !important;
            padding: 0 !important;
            line-height: 1px;
        }
        .note-link {
            position: absolute;
            font-size: 8pt;       
            line-height: 1em;     
            display: inline-block;
            top: 5px; 
            right: 5px; 
            padding: 0 2px;      
            text-decoration: none;
        }
        .tcol {
            z-index: 1000;
            min-width: 300px;
            position: relative;
        }
        .rus {
            font-size: 0.75rem;    
        }
        .rus strong {
            font-size: 0.9rem;    
            font-weight: bold;
        }
        .theader {
            z-index: 1200;
        }
        .tdata {
            z-index: 900;
        }
        .scroll-buttons {
            display: flex;
            justify-content: space-between;
            position: relative;
            user-select: none;
        }
        .scroll-btn {
            position: fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background-color: rgba(0, 0, 0, 0.03);
            color: #fff;
            font-weight: bold;
            outline: none;
            border: none;
            cursor: pointer;
            transition: background-color 0.03s ease;
            z-index: 10;
        }
        .scroll-btn:hover, .scroll-btn:focus {
            background-color: rgba(0, 173, 97, 1);
            color: #fff; 
        }
        .arrow {
            border: solid #333;
            border-width: 0 3px 3px 0;
            display: inline-block;
            padding: 3px;
            transition: transform 0.3s ease;
        }
        .left {
            transform: rotate(135deg) scale(2);
        }
        .right {
            transform: rotate(-45deg) scale(2);
        }
        .scroll-btn:hover .arrow, .scroll-btn:focus .arrow {
            border-color: #fff; 
        }
        .wrapper {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
        }
        .scroll-left {
            position: fixed;
            left: 10px;
            top: 50%;
            font-size: 20px;
        }
        .scroll-right {
            position: fixed;
            right: 10px;
            top: 50%;
            font-size: 20px;
        }
        th {
            font-weight: normal;
        }
        .table-other {
            font-size: 0.8rem;
            line-height: 0.8rem;
            min-width: 100px;
        }
        .notes {
            margin-top: 20px;
            font-size: 0.8rem;
            line-height: 1.1rem;
        }
        .top4ik {
            top: 40px;
        }
        h3 {
            color: #00AD61;
        }
        .hidden-row, .hidden {
            display: none;
        }
        button.show-hidden {
            cursor: pointer;
            font-size: inherit;
        }
    </style>

<body class="m-5">
<!--div class="container mt-5"-->
<h1 class="mb-4">Weintek, таблица сравнения серий Weintek iP и СПИКТЕК СТК</h1>

    <table id="ptable" class="table table-hover is-bordered is-fullwidth">
        <thead class="header1 table-light" id="myHeader">
            <tr>
                <th scope="col" class="text-end align-middle theader has-background-white" style="border: 0px; transform: translate(0px, 0px); z-index: 2000;"></th>
                <th class="text-center theader" colspan="1" style="transform: translate(0px, 0px); z-index: 2000;">СПИКТЕК СТК серия</th>
                <th class="text-center theader" colspan="1" style="transform: translate(0px, 0px); z-index: 2000;">WEINTEK IP серия</th>
            </tr>

        </thead>
        <tbody>
            <tr>
                <td class="tcol1" colspan="3" style="font-weight: bold;"><h3>Доступные объекты в EasyBuilder (EasyBuilder)</h3></td>
            </tr>
            <tr>
                <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>Project size limit</strong><br>Предельный размер загружаемого проекта </td>
                <td class="table-other text-center tdata align-middle"><div class="tdata">22MB</div></td>
                <td class="table-other text-center tdata align-middle"><div class="tdata">22MB</div></td>
            </tr>
            <tr>
                <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>USB Disk Download</strong><br>Загрузка проекта с USB-диска </td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
            </tr>
            <tr>
                <td class="tcol1" colspan="3" style="font-weight: bold;"><h3>Функциональные возможности (Function)</h3></td>
            </tr>
            <tr>
                <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>3G/4G Dongle</strong><br>3G/4G USB модем </td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
            </tr>
            <tr>
                <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>Dual USB</strong><br> </td>
                <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
            </tr>
            <tr>
                <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>Enhanced Security Mode</strong><br>Расширенный режим безопасности </td>
                <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
            </tr>
            <tr>
                <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>USB Tethering</strong><br>Использование Android смартфона в качестве USB-модема </td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
            </tr>
            <tr>
                <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>User-defined Startup Screen</strong><br>Пользовательский экран загрузки (только через Utility Manager)</td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
            </tr>
            <tr>
                <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>VNC Server</strong><br>Система удалённого доступа к экрану панели </td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
            </tr>
            <tr>
                <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>MPI</strong><br> </td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
            </tr>
            <tr>
                <td class="tcol1" colspan="3" style="font-weight: bold;"><h3>Объекты работы с данными (Object)</h3></td>
            </tr>
            <tr>
                <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>Combo Button</strong><br>Комбинированная кнопка </td>
                <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
            </tr>
            <tr>
                <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>Date/Time</strong><br>Графический объект Дата/Время </td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
            </tr>
            <tr>
                <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>Dynamic Drawing</strong><br>Объект Динамический рисунок </td>
                <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
            </tr>
            <tr>
                <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>Dynamic Scale</strong><br>Объект Динамическая круговая шкала </td>
                <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
            </tr>
            <tr>
                <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>File Browser</strong><br>Файловый менеджер (Проводник) </td>
                <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
            </tr>
            <tr>
                <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>Flow Block</strong><br>Объект Обтекающий блок </td>
                <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
            </tr>
            <tr>
                <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>Picture View</strong><br>Объект Просмотра изображений </td>
                <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
            </tr>
            <tr>
                <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>Pie Chart</strong><br>Объект Круговая диаграмма </td>
                <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
            </tr>
            <tr>
                <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>Table</strong><br>Графическая сетка </td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
            </tr>
            <tr>
                <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>Template Window</strong><br> </td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
            </tr>
            <tr>
                <td class="tcol1" colspan="3" style="font-weight: bold;"><h3>Объекты IIoT и контроль энергопотребления (IIoT/Energy)</h3></td>
            </tr>
            <tr>
                <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>OPC UA Client</strong><br>OPC UA клиент </td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
            </tr>
            <tr>
                <td class="tcol1" colspan="3" style="font-weight: bold;"><h3>Данные / Журнал (Data/History)</h3></td>
            </tr>
            <tr>
                <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>Circular Trend Display</strong><br>Объект Круговой график </td>
                <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
            </tr>
            <tr>
                <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>Operation Log Settings</strong><br>Журнал операций </td>
                <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
            </tr>
            <tr>
                <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>Recipe Database</strong><br>База данных рецептов </td>
                <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
            </tr>
            <tr>
                <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>Recipe Import/Export</strong><br>Импорт/Экспорт рецептов </td>
                <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
            </tr>
            <tr>
                <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>Recipe View</strong><br>Просмотр базы данных рецептов </td>
                <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
            </tr>
            <tr>
                <td class="tcol1" colspan="3" style="font-weight: bold;"><h3>Утилиты (Utility)</h3></td>
            </tr>
            <tr>
                <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>EasyAccess 1.0</strong><br>Удалённый доступ к операторской панели </td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
            </tr>
            <tr>
                <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>EasyDiagnoser</strong><br>Инструмент для быстрого нахождения ошибок в операторских панелях Weintek </td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
            </tr>
            <tr>
                <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>EasyPrinter</strong><br>Утилита для управления печатью и резервным копированием </td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
            </tr>
            <tr>
                <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>EasySimulator</strong><br>Утилита для симуляции выполнения проекта, как с соединением с PLC, так и без соединения </td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
            </tr>
            <tr>
                <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>EasySystemSetting</strong><br>Утилита позволяет сконфигурировать системные настройки панели через персональный компьютер </td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
            </tr>
            <tr>
                <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>EasyWatch</strong><br>Утилита для мониторинга и настройки значений адресов панели или ПЛК для облегчения отладки, удалённого наблюдения и управления. </td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
            </tr>
            <tr>
                <td class="tcol1" colspan="3" style="font-weight: bold;"><h3>Облачный интерфейс Weincloud (Weincloud)</h3></td>
            </tr>
            <tr>
                <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>Dashboard</strong><br> </td>
                <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
            </tr>
            <tr>
                <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>EasyAccess 2.0</strong><br>Удалённый доступ к операторской панели 2.0 </td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
            </tr>
            <tr>
                <td class="tcol1" colspan="3" style="font-weight: bold;text-align: center;"><button type="button" onclick="toggleHiddenRows()" class="show-hidden btn btn-success ms-3">Показать скрытые функции</button></td>
            </tr>
<tr class="hidden">
    <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>64-bit Data Type</strong><br>64-битный тип данных </td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
</tr>
<tr class="hidden">
    <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>Control Token</strong><br>Передача прав другому пользователю </td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
</tr>
<tr class="hidden">
    <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>e-Mail</strong><br>Отправка почты </td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
</tr>
<tr class="hidden">
    <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>Ethernet Printer</strong><br>Принтеры через Ethernet </td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
</tr>
<tr class="hidden">
    <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>LDAP</strong><br>Интеграция с каталогами LDAP </td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
</tr>
<tr class="hidden">
    <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>String Table</strong><br>Таблицы строк </td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
</tr>
<tr class="hidden">
    <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>Time Synchronization (NTP)</strong><br>Синхронизация времени NTP </td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
</tr>
<tr class="hidden">
    <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>Web Streaming</strong><br>Потоковая передача веб-данных </td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
</tr>
<tr class="hidden">
    <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>Web Interface</strong><br>Встроенный веб-интерфейс </td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
</tr>
<tr class="hidden">
    <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>EasyWeb 2.0</strong><br>EasyWeb 2.0 </td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
</tr>
<tr class="hidden">
    <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>WebView</strong><br>Отображение веб-страниц </td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
</tr>
<tr class="hidden">
    <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>Audio (Speaker)</strong><br>Звуковые динамики </td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
</tr>
<tr class="hidden">
    <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>Audio (Other)</strong><br>Другие звуковые опции </td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
</tr>
<tr class="hidden">
    <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>CAN Bus</strong><br>Шина CAN </td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
</tr>
<tr class="hidden">
    <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>Wi-Fi</strong><br>Поддержка беспроводных сетей </td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
</tr>
<tr class="hidden">
    <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>Vibration Feedback</strong><br>Вибро-отклик </td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
</tr>
<tr class="hidden">
    <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>Action Trigger</strong><br>Активатор действий </td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
</tr>
<tr class="hidden">
    <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>BACnet Schedule</strong><br>Расписание BACnet </td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
</tr>
<tr class="hidden">
    <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>Barcode Scanner (Android Camera)</strong><br>Сканер штрих-кодов через Android </td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
</tr>
<tr class="hidden">
    <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>Condition</strong><br>Проверка условий </td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
</tr>
<tr class="hidden">
    <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>JS Object</strong><br>Javascript объект </td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
</tr>
<tr class="hidden">
    <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>Media Player</strong><br>Медиаплеер </td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
</tr>
<tr class="hidden">
    <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>PDF Reader</strong><br>Читалка PDF </td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
</tr>
<tr class="hidden">
    <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>PLC Web Browser</strong><br>Встроенный браузер PLCs </td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
</tr>
<tr class="hidden">
    <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>Touch Gesture</strong><br>Жесты касания </td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
</tr>
<tr class="hidden">
    <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>Video In - IP Camera</strong><br>Видео с IP камер </td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
</tr>
<tr class="hidden">
    <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>Video In - USB Camera</strong><br>Видео с USB камер </td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
</tr>
<tr class="hidden">
    <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>Video In - Video Input</strong><br>Видео-ввод </td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
</tr>
<tr class="hidden">
    <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>VNC Viewer</strong><br>Клиент для удалённого рабочего стола </td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
</tr>
<tr class="hidden">
    <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>Demand Display</strong><br>Отображение потребления ресурсов </td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
</tr>
<tr class="hidden">
    <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>Demand Setting</strong><br>Установка ограничений потребления </td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
</tr>
<tr class="hidden">
    <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>MQTT</strong><br>MQTT-публикация </td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
</tr>
<tr class="hidden">
    <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>MQTT - Advanced JSON</strong><br>Продвинутый формат JSON для MQTT </td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
</tr>
<tr class="hidden">
    <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>MQTT - AWS IoT, Sparkplug B, Azure IoT Hub</strong><br>MQTT интеграция с облаками </td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
</tr>
<tr class="hidden">
    <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>OPC UA Server</strong><br>OPC UA сервер </td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
</tr>
<tr class="hidden">
    <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>Database Server</strong><br>Подключение к базе данных </td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
</tr>
<tr class="hidden">
    <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>Event Bar Chart</strong><br>Гистограммы событий </td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
</tr>
<tr class="hidden">
    <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>FTP Server</strong><br>FTP сервер </td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
</tr>
<tr class="hidden">
    <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>SQL Query</strong><br>Запросы SQL </td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
</tr>
<tr class="hidden">
    <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>CODESYS</strong><br>CODESYS инструменты разработки </td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
</tr>
<tr class="hidden">
    <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>cMT Viewer App</strong><br>Приложение для управления панелью </td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
</tr>
<tr class="hidden">
    <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>cMT Diagnoser</strong><br>Диагностика панелей cMT </td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
</tr>
<tr class="hidden">
    <td class="table-light tcol rus" style="transform: translate(0px, 0px); z-index: 1000;"><strong>Dashboard</strong><br>Панель инструментов Weincloud </td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
    <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
</tr>
        </tbody>
    </table>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const button = document.querySelector('.show-hidden');
    const hiddenRows = document.querySelectorAll('.hidden');

    button.onclick = () => {
        hiddenRows.forEach((row) => {
            row.classList.toggle('hidden'); // Переключение отображения
        });

        // Изменение текста кнопки
        if(button.textContent.includes("Показать")) {
            button.textContent = "Скрыть скрытые функции";
        } else {
            button.textContent = "Показать скрытые функции";
        }
    };
});	</script>

<!-- Подключаем JavaScript-файлы Bootstrap --> 
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<?php
require_once $_SERVER[ 'DOCUMENT_ROOT' ] . "/abacus/epilog.php";
