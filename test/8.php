<?php
include $_SERVER["DOCUMENT_ROOT"]."/config.php";
if(EX != "_"){
    header($_SERVER['SERVER_PROTOCOL'] . " 301 Moved Permanently");
    header('Location: https://' . $_SERVER['HTTP_HOST'] ."/weintek-stavnenie-seriy/");
    exit();
}
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weintek, сравнение функций серии cMT</title>
    <meta name="description" content="Таблица сравнения функциональных возможностей панелей серии cMT (cMT1106X, cMT1058XH, cMT2000X, cMT3000X).">
    <meta name="keywords" content="Weintek, cMT, cMT1106X, cMT1058XH, cMT2000X, cMT3000X, сравнение, HMI">
    
    <style>
        /* Сброс базовых стилей */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: Verdana, "Lucida Grande", Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.4;
        }
        a {
            color: #0066cc;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }

        /* Основной контейнер */
        .compare-page {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px 30px;
        }
        
        /* Заголовок страницы */
        h1 {
            font-size: 22px;
            color: #ffffff;
            text-shadow: 1px 1px 1px rgba(0,0,0,0.5);
            text-align: center;
            background: #0260e9;
            padding: 15px 0;
            margin-bottom: 25px;
            border-radius: 5px;
        }
        
        /* Обертка для таблицы с горизонтальным скроллом */
        .table-wrapper {
            width: 100%;
            overflow-x: auto;
            border: 1px solid #ccc;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        /* Основная таблица */
        .sravnenie {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            min-width: 900px;
            table-layout: fixed;
        }
        
        /* ФИКСАЦИЯ ШАПКИ */
        thead th {
            position: sticky;
            top: 0;
            background: #dfe0e2;
            z-index: 20;
            border-bottom: 2px solid #999;
            padding: 12px 8px;
        }
        
        /* Ширина колонок */
        .sravnenie th:first-child, .sravnenie td:first-child {
            width: 380px;
            text-align: left;
        }
        .sravnenie th:nth-child(2), .sravnenie td:nth-child(2) { width: 120px; }
        .sravnenie th:nth-child(3), .sravnenie td:nth-child(3) { width: 160px; }
        .sravnenie th:nth-child(4), .sravnenie td:nth-child(4) { width: 120px; }
        .sravnenie th:nth-child(5), .sravnenie td:nth-child(5) { width: 120px; }

        .sravnenie th, .sravnenie td {
            border: 1px dashed silver;
            text-align: center;
            vertical-align: middle;
            padding: 10px 5px;
            word-wrap: break-word;
        }
        
        /* ОФОРМЛЕНИЕ НАЗВАНИЙ СТРОК (Английский + Русский под ним) */
        .func-cell {
            text-align: left !important;
            padding-left: 15px !important;
        }
        .func-name {
            font-weight: bold;
            font-size: 14px;
            color: #062c4c;
            line-height: 1.3;
        }
        .func-desc {
            font-weight: normal;
            font-size: 11px;
            color: #666666;
            line-height: 1.3;
        }
        
        /* Оформление ячеек с галочками и данными */
        .sravnenie td:not(:first-child) p {
            font-size: 18px;
            margin: 0;
            font-weight: bold;
        }
        .sravnenie td:not(:first-child) {
            padding: 8px 5px;
        }

        /* Всплывающие подсказки (ваши question-s) */
        .question-s {
            display: inline-block;
            height: 18px;
            width: 19px;
            font-weight: bold;
            cursor: pointer;
            color: gray;
            margin-left: -2px;
            position: relative;
            font-size: 14px;
            text-align: center;
            line-height: 18px;
        }
        .question-s:hover {
            z-index: 400;
            color: #000;
        }
        .question-s .note-s {
            position: absolute;
            display: none;
            z-index: 500;
            left: 50%;
            transform: translateX(-50%);
            bottom: 25px;
        }
        .question-s:hover .note-s {
            display: block;
            color: #505050;
            background-color: rgb(247, 247, 247);
            max-width: 320px;
            padding: 12px;
            font-size: 12px;
            text-align: center;
            border: 3px solid #d8d8d8;
            border-radius: 4px;
        }
        .question-s:hover .note-s::before {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            border-left: 10px solid transparent;
            border-right: 10px solid transparent;
            border-top: 10px solid #d8d8d8;
        }
        
        /* Зебра для тела таблицы */
        tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }
        tbody tr:nth-child(even) {
            background-color: #ffffff;
        }
        
        /* Выделение первой колонки */
        .sravnenie tr td:first-child {
            background-color: #f0f8ff;
            font-weight: bold;
            color: #062c4c;
        }
    </style>
</head>
<body>

<?php 
/* Подключение шапки вашего сайта */
include $_SERVER["DOCUMENT_ROOT"] . "/include/header_menu.php"; 
?>

<article>
<div class="compare-page">
    <h1>Сравнение функций панелей серии cMT</h1>
    
    <div class="table-wrapper">
        <table class="sravnenie">
            <thead>
                <tr>
                    <th>Функция</th>
                    <th>cMT1106X</th>
                    <th>cMT1058XH / cMT1078X</th>
                    <th>cMT2000X</th>
                    <th>cMT3000X</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">Project size limit</div>
                        <div class="func-desc">Лимит размера проекта</div>
                    </td>
                    <td><p>64MB</p></td>
                    <td><p>48MB</p></td>
                    <td><p>64MB</p></td>
                    <td><p>64MB</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">USB Disk Download</div>
                        <div class="func-desc">Загрузка проекта с USB-диска</div>
                    </td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">64-bit Data Type</div>
                        <div class="func-desc">64-битный тип данных</div>
                    </td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">3G/4G Dongle</div>
                        <div class="func-desc">Поддержка 3G/4G модема</div>
                    </td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">Control Token</div>
                        <div class="func-desc">Токен управления</div>
                    </td>
                    <td></td>
                    <td></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">Dual USB</div>
                        <div class="func-desc">Два порта USB</div>
                    </td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">e-Mail</div>
                        <div class="func-desc">Отправка E-mail</div>
                    </td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">Enhanced Security Mode</div>
                        <div class="func-desc">Режим повышенной безопасности</div>
                    </td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">Ethernet Printer</div>
                        <div class="func-desc">Ethernet-принтер</div>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><p>&#10003;</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">USB Tethering</div>
                        <div class="func-desc">USB-модем (раздача интернета)</div>
                    </td>
                    <td></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">Off-line simulation on HMI</div>
                        <div class="func-desc">Off-line симуляция на панели</div>
                    </td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">User boot screen</div>
                        <div class="func-desc">Пользовательский экран загрузки</div>
                    </td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">VNC Server</div>
                        <div class="func-desc">VNC-сервер</div>
                    </td>
                    <td></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                </tr>


                <tr>
                    <td class="func-cell">
                        <div class="func-name">"Through" pass for Siemens PLC</div>
                        <div class="func-desc">"Сквозной проход" ПЛК для Siemens</div>
                    </td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">Audio Output</div>
                        <div class="func-desc">Аудиовыход</div>
                    </td>
                    <td></td>
                    <td></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">CAN Bus</div>
                        <div class="func-desc">Интерфейс CAN Bus</div>
                    </td>
                    <td></td>
                    <td></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">Wi-Fi</div>
                        <div class="func-desc">Wi-Fi</div>
                    </td>
                    <td></td>
                    <td><p>&#10003;</p></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">Barcode Scanner (Android camera)</div>
                        <div class="func-desc">Сканер штрихкодов (Android-камера)</div>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">Pie Chart</div>
                        <div class="func-desc">Круговая диаграмма</div>
                    </td>
                    <td></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">Combo Button</div>
                        <div class="func-desc">Комбо-кнопка</div>
                    </td>
                    <td></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">Database Server (MySQL)</div>
                        <div class="func-desc">Сервер баз данных (MySQL)</div>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">Date / Time</div>
                        <div class="func-desc">Дата / Время</div>
                    </td>
                    <td></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">Dynamic Drawing</div>
                        <div class="func-desc">Динамическое рисование</div>
                    </td>
                    <td></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">Dynamic Scale</div>
                        <div class="func-desc">Динамическая шкала</div>
                    </td>
                    <td></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">Energy consumption setting</div>
                        <div class="func-desc">Настройка потребностей в электроэнергии</div>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">Energy monitoring screen</div>
                        <div class="func-desc">Экран мониторинга энергопотребления</div>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">Explorer</div>
                        <div class="func-desc">Проводник</div>
                    </td>
                    <td></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">Float Window</div>
                        <div class="func-desc">Плавающий блок</div>
                    </td>
                    <td></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">IP Camera</div>
                        <div class="func-desc">IP-камера</div>
                    </td>
                    <td></td>
                    <td></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">Media Player</div>
                        <div class="func-desc">Медиаплеер</div>
                    </td>
                    <td></td>
                    <td></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">MQTT Server (Publish)</div>
                        <div class="func-desc">MQTT-сервер (публикация)</div>
                    </td>
                    <td></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">MQTT Client (Subscribe)</div>
                        <div class="func-desc">MQTT-клиент (подписка)</div>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">Operation Log, Print</div>
                        <div class="func-desc">Журнал операций, печать</div>
                    </td>
                    <td></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">Operation Log, Settings</div>
                        <div class="func-desc">Журнал операций, настройки</div>
                    </td>
                    <td></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">Operation Log, View</div>
                        <div class="func-desc">Журнал операций, просмотр</div>
                    </td>
                    <td></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">OPC UA Server</div>
                        <div class="func-desc">OPC UA-сервер</div>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">PDF Reader</div>
                        <div class="func-desc">PDF Reader</div>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">Picture Viewer</div>
                        <div class="func-desc">Просмотрщик изображений</div>
                    </td>
                    <td></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">Pie Chart (Proportional)</div>
                        <div class="func-desc">Круговая диаграмма (доли)</div>
                    </td>
                    <td></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">Recipe Database</div>
                        <div class="func-desc">База данных рецептов</div>
                    </td>
                    <td></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">Recipe Import / Export</div>
                        <div class="func-desc">Импорт / экспорт рецептов</div>
                    </td>
                    <td></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">Recipe View</div>
                        <div class="func-desc">Просмотр базы данных рецептов</div>
                    </td>
                    <td></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">String Table</div>
                        <div class="func-desc">Таблица строк</div>
                    </td>
                    <td></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">Tables</div>
                        <div class="func-desc">Таблицы</div>
                    </td>
                    <td></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">Time Synchronization</div>
                        <div class="func-desc">Синхронизация времени</div>
                    </td>
                    <td></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">USB Camera</div>
                        <div class="func-desc">USB-камера</div>
                    </td>
                    <td></td>
                    <td></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">Video Input</div>
                        <div class="func-desc">Видеовход</div>
                    </td>
                    <td></td>
                    <td></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">Video Streaming (USB Camera)</div>
                        <div class="func-desc">Потоковое видео (USB-камера)</div>
                    </td>
                    <td></td>
                    <td></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">VNC Viewer</div>
                        <div class="func-desc">VNC Viewer</div>
                    </td>
                    <td></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">CODESYS</div>
                        <div class="func-desc">CODESYS</div>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><p>&#10003;</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">EasyAccess 2.0</div>
                        <div class="func-desc">EasyAccess 2.0</div>
                    </td>
                    <td></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">EasyDiagnoser</div>
                        <div class="func-desc">EasyDiagnoser (утилита)</div>
                    </td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">EasyLaucher</div>
                        <div class="func-desc">EasyLaucher (утилита)</div>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">EasyPrinter</div>
                        <div class="func-desc">EasyPrinter (утилита)</div>
                    </td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">EasySimulator</div>
                        <div class="func-desc">EasySimulator (утилита)</div>
                    </td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">EasySystemSetting</div>
                        <div class="func-desc">EasySystemSetting (утилита)</div>
                    </td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">EasyWatch</div>
                        <div class="func-desc">EasyWatch (утилита)</div>
                    </td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">Utility Manager</div>
                        <div class="func-desc">Utility Manager (менеджер утилит)</div>
                    </td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">Macro: Open / Cycle / Close window</div>
                        <div class="func-desc">Макросы: открыть / цикл / закрыть окно</div>
                    </td>
                    <td></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                    <td><p>&#10003;</p></td>
                </tr>
                <tr>
                    <td class="func-cell">
                        <div class="func-name">Smart Indicator / Indicator Screen</div>
                        <div class="func-desc">Интеллектуальный индикатор / Экран индикатора</div>
                    </td>
                    <td></td>
                    <td></td>
                    <td></