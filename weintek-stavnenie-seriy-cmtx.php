<?php
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

    <!-- Стили и библиотеки из вашего файла index.php -->
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
        .scroll-left {
            left: 10px;
        }
        .scroll-right {
            right: 10px;
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
        .srav {
            width: 100%;
            margin-left: -10px;
            margin-right: -10px;
            max-height:1080px;
            overflow-x: auto;
            overflow-y: auto;
        }
        h3 {
            color: #00AD61;
        }
        
        /* Кастомные стили для вашей таблицы */
        .compare-page {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px 30px;
        }
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
        .func-cell {
            text-align: left !important;
            padding-left: 15px !important;
            vertical-align: middle !important;
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
    </style>
</head>
<body class="m-5">

<div class="compare-page">
    <h1>Сравнение функций панелей серии cMT</h1>
    
    <div class="wrapper">
        <button class="scroll-left scroll-btn is-hidden"><i class="arrow left"></i></button>
        <div id="srav" class="srav">
            <table id="ptable" class="table table-hover is-bordered is-fullwidth">
                <thead class="header1 table-light" id="myHeader">
                    <tr>
                        <th scope="col" class="text-end align-middle theader has-background-white" style="border:0px;"></th>
                        <th class="text-center theader" colspan="4">Серия <strong>cMT</strong></th>
                    </tr>
                    <tr>
                        <th class="text-end align-middle has-background-white" scope="col" style="border:0px;"></th>
                        <th scope="col" class="table-other text-center theader align-top">cMT1106X</th>
                        <th scope="col" class="table-other text-center theader align-top">cMT1058XH / cMT1078X</th>
                        <th scope="col" class="table-other text-center theader align-top">cMT2000X</th>
                        <th scope="col" class="table-other text-center theader align-top">cMT3000X</th>
                    </tr>
                    <tr>
                        <th class="text-end align-middle theader has-background-white divider" scope="col" style="border:0px;">&nbsp;</th>
                        <th scope="col" class="table-other text-center theader align-top divider"></th>
                        <th scope="col" class="table-other text-center theader align-top divider"></th>
                        <th scope="col" class="table-other text-center theader align-top divider"></th>
                        <th scope="col" class="table-other text-center theader align-top divider"></th>
                    </tr>
                </thead>
                <tbody>
					                    <!-- СТРОКА 1 -->
                    <tr>
                        <td class="table-light tcol rus"><strong>Project size limit</strong><br>Лимит размера проекта</td>
                        <td class="text-center tdata align-middle"><div class='tdata'>64MB</div></td>
                        <td class="text-center tdata align-middle"><div class='tdata'>48MB</div></td>
                        <td class="text-center tdata align-middle"><div class='tdata'>64MB</div></td>
                        <td class="text-center tdata align-middle"><div class='tdata'>64MB</div></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>USB Disk Download</strong><br>Загрузка проекта с USB-диска</td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>64-bit Data Type</strong><br>64-битный тип данных</td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>3G/4G Dongle</strong><br>Поддержка 3G/4G модема</td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>Control Token</strong><br>Токен управления</td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>Dual USB</strong><br>Два порта USB</td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>e-Mail</strong><br>Отправка E-mail</td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>Enhanced Security Mode</strong><br>Режим повышенной безопасности</td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>Ethernet Printer</strong><br>Ethernet-принтер</td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>USB Tethering</strong><br>USB-модем (раздача интернета)</td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>Off-line simulation on HMI</strong><br>Off-line симуляция на панели</td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>User boot screen</strong><br>Пользовательский экран загрузки</td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>VNC Server</strong><br>VNC-сервер</td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>"Through" pass for Siemens PLC</strong><br>"Сквозной проход" ПЛК для Siemens</td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>Audio Output</strong><br>Аудиовыход</td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>CAN Bus</strong><br>Интерфейс CAN Bus</td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>Wi-Fi</strong><br>Wi-Fi</td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>Barcode Scanner (Android camera)</strong><br>Сканер штрихкодов (Android-камера)</td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>Pie Chart</strong><br>Круговая диаграмма</td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>Combo Button</strong><br>Комбо-кнопка</td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>Database Server (MySQL)</strong><br>Сервер баз данных (MySQL)</td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>Date / Time</strong><br>Дата / Время</td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>Dynamic Drawing</strong><br>Динамическое рисование</td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>Dynamic Scale</strong><br>Динамическая шкала</td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>Energy consumption setting</strong><br>Настройка потребностей в электроэнергии</td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>Energy monitoring screen</strong><br>Экран мониторинга энергопотребления</td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>Explorer</strong><br>Проводник</td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>Float Window</strong><br>Плавающий блок</td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>IP Camera</strong><br>IP-камера</td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>Media Player</strong><br>Медиаплеер</td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>MQTT Server (Publish)</strong><br>MQTT-сервер (публикация)</td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>MQTT Client (Subscribe)</strong><br>MQTT-клиент (подписка)</td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>Operation Log, Print</strong><br>Журнал операций, печать</td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>Operation Log, Settings</strong><br>Журнал операций, настройки</td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>Operation Log, View</strong><br>Журнал операций, просмотр</td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>OPC UA Server</strong><br>OPC UA-сервер</td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>PDF Reader</strong><br>PDF Reader</td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>Picture Viewer</strong><br>Просмотрщик изображений</td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>Pie Chart (Proportional)</strong><br>Круговая диаграмма (доли)</td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>Recipe Database</strong><br>База данных рецептов</td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>Recipe Import / Export</strong><br>Импорт / экспорт рецептов</td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>Recipe View</strong><br>Просмотр базы данных рецептов</td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>String Table</strong><br>Таблица строк</td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>Tables</strong><br>Таблицы</td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>Time Synchronization</strong><br>Синхронизация времени</td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>USB Camera</strong><br>USB-камера</td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>Video Input</strong><br>Видеовход</td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>Video Streaming (USB Camera)</strong><br>Потоковое видео (USB-камера)</td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>VNC Viewer</strong><br>VNC Viewer</td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>CODESYS</strong><br>CODESYS</td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>EasyAccess 2.0</strong><br>EasyAccess 2.0</td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>EasyDiagnoser</strong><br>EasyDiagnoser (утилита)</td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>EasyLaucher</strong><br>EasyLaucher (утилита)</td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>EasyPrinter</strong><br>EasyPrinter (утилита)</td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>EasySimulator</strong><br>EasySimulator (утилита)</td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>EasySystemSetting</strong><br>EasySystemSetting (утилита)</td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>EasyWatch</strong><br>EasyWatch (утилита)</td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>Utility Manager</strong><br>Utility Manager (менеджер утилит)</td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>Macro: Open / Cycle / Close window</strong><br>Макросы: открыть / цикл / закрыть окно</td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>Smart Indicator / Indicator Screen</strong><br>Интеллектуальный индикатор / Экран индикатора</td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>QR-code</strong><br>QR-код</td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-danger bi bi-x-square h3"></i></td>
                        <td class="text-center tdata align-middle"><i class="text-success bi bi-check-square-fill h3"></i></td>
                    </tr>
                    <tr>
                        <td class="table-light tcol rus"><strong>Number of Data Sampling objects</strong><br>Кол-во объектов выборки данных</td>
                        <td class="text-center tdata align-middle"><div class='tdata'>256</div></td>
                        <td class="text-center tdata align-middle">
                            <div class="note-link">
                                <a href="#note-1">40</a>
                            </div>
                        </td>
                        <td class="text-center tdata align-middle"><div class='tdata'>256</div></td>
                        <td class="text-center tdata align-middle"><div class='tdata'>256</div></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <button class="scroll-right scroll-btn is-hidden"><i class="arrow right"></i></button>
    </div>

    <!-- Блок сносок (если они есть в вашей базе данных, здесь можно вывести вручную) -->
    <div class="notes" id="snoski">
        <span id="note-1"><strong>40</strong> - В модели cMT1058XH / cMT1078X лимит составляет 40 объектов.</span><br>
    </div>
</div>

<!-- Подключаем JavaScript-файлы Bootstrap и скрипты фиксации колонок из вашего файла -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function () {
    // Удаляем хэш из URL
    history.replaceState(null, null, location.href.split('#')[0]);
});

document.addEventListener('DOMContentLoaded', function() {
    var myDiv = document.getElementById('srav');
    var mySbuttons = document.querySelectorAll('.scroll-btn');
    var myTable = document.getElementById('ptable');

    checkOverflow();
    window.addEventListener('resize', checkOverflow);

    function checkOverflow() {
        if(myTable.offsetWidth > myDiv.clientWidth){
            myDiv.classList.add('sr_wrap111');
            mySbuttons.forEach(function(el) { el.classList.remove('is-hidden'); });
        } else {
            myDiv.classList.remove('sr_wrap111');
            mySbuttons.forEach(function(el) { el.classList.add('is-hidden'); });
        }
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const container = document.querySelector('.srav');
    const btnLeft = document.querySelector('.scroll-left');
    const btnRight = document.querySelector('.scroll-right');

    btnLeft.addEventListener('click', function() {
        container.scrollLeft -= 50;
    });
    btnRight.addEventListener('click', function() {
        container.scrollLeft += 50;
    });
});

document.getElementById("srav").addEventListener("scroll", function(){
    var translatey = "translate(" + this.scrollLeft + "px,0)";
    var tcols = this.querySelectorAll(".tcol");
    tcols.forEach(function(tcol) {
        tcol.style.transform = translatey;
        tcol.style.zIndex = '1000';
    });

    var translate = "translate(0,"+this.scrollTop+"px)";
    var theads = this.querySelectorAll(".theader");
    theads.forEach(function(thead) {
        thead.style.transform = translate;
        thead.style.zIndex = '2000';
    });
});
</script>

<?php
require_once $_SERVER[ 'DOCUMENT_ROOT' ] . "/abacus/epilog.php";
?>
</body>
</html>