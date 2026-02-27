<?php

global $arr_cloud_tags_popup;

$arr_cloud_tags_popup = [

    [
        'category' => 'Панели оператора',
        'filters' => [
            [
                'name' => 'Панель оператора с ethernet',
                'url' => '/catalog/operator_panels/?&interfaces=ethernet',
                'add_to_sitemap' => 0,
                'category' => 'hmi',
            ],
            [
                'name' => 'Панель оператора с Codesys',
                'url' => '/catalog/operator_panels/?&codesys=yes',
                'add_to_sitemap' => 0,
                'category' => 'hmi',
            ],
            [
                'name' => "Панель оператора со встроенным ПЛК",
                'url' => '/catalog/operator_panels/?&codesys=yes',
                'add_to_sitemap' => 0,
                'category' => 'hmi',
            ],
            [
                'name' => 'Панель оператора с WiFi',
                'url' => '/catalog/operator_panels/?&interfaces=wifi',
                'add_to_sitemap' => 0,
                'category' => 'hmi',
            ],
            [
                'name' => 'Панель оператора с EasyAccess',
                'url' => '/catalog/operator_panels/?&brand=weintek',
                'add_to_sitemap' => 0,
                'category' => 'hmi',
            ],
            [
                'name' => 'Панель оператора с емкостным сенсором',
                'url' => '/catalog/operator_panels/?&sensor_type=capacitive',
                'add_to_sitemap' => 0,
                'category' => 'hmi',
            ],
            [
                'name' => 'Панель оператора с резистивным сенсором',
                'url' => '/catalog/operator_panels/?&sensor_type=resistive',
                'add_to_sitemap' => 0,
                'category' => 'hmi',
            ],
            [
                'name' => 'Панель оператора с sd-картой',
                'url' => '/catalog/operator_panels/?&sdcard=yes',
                'add_to_sitemap' => 0,
                'category' => 'hmi',
            ],
            [
                'name' => 'Панель оператора с просмотром изображения с ПК',
                'url' => '/catalog/operator_panels/?&cmtviewer=yes',
                'add_to_sitemap' => 0,
                'category' => 'hmi',
            ],
            [
                'name' => 'Панель оператора с JavaScript',
                'url' => '/catalog/operator_panels/?&series=cMT-X',
                'add_to_sitemap' => 0,
                'category' => 'hmi',
            ],
            [
                'name' => 'Панель оператора с подключением IP камеры',
                'url' => '/catalog/operator_panels/?&camera_ip=yes',
                'add_to_sitemap' => 0,
                'category' => 'hmi',
            ],
            [
                'name' => 'Панель оператора с подключением USB камеры',
                'url' => '/catalog/operator_panels/?&camera_usb=yes',
                'add_to_sitemap' => 0,
                'category' => 'hmi',
            ],
            [
                'name' => 'Удаленное управление панелью оператора через веб-браузер',
                'url' => '/catalog/operator_panels/?&webview=yes',
                'add_to_sitemap' => 0,
                'category' => 'hmi',
            ],
            [
                'name' => 'Панель со встроенным веб-сервером',
                'url' => '/catalog/operator_panels/?&plc_web_browser=yes',
                'add_to_sitemap' => 0,
                'category' => 'hmi',
            ],
            [
                'name' => 'Удаленное управление с телефона',
                'url' => '/catalog/operator_panels/?&remote_control_phone=yes',
                'add_to_sitemap' => 1,
                'category' => 'hmi',
            ],
            [
                'name' => 'Контроль доступа для персонала',
                'url' => '/catalog/operator_panels/?&personnel_access_control=yes',
                'add_to_sitemap' => 1,
                'category' => 'hmi',
            ],
            [
                'name' => 'Отправка сообщений на почту',
                'url' => '/catalog/operator_panels/?&sending_by_email=yes',
                'add_to_sitemap' => 1,
                'category' => 'hmi',
            ],
            [
                'name' => 'Панель с базой данных на SQL-сервере',
                'url' => '/catalog/operator_panels/?&with_database=yes',
                'add_to_sitemap' => 1,
                'category' => 'hmi',
            ],
        ]
    ],
    [
        'category' => 'Панельные компьютеры',
        'filters' => [
            [
                'name' => 'С резистивным экраном',
                'url' => '/catalog/panel_computers/?&sensor_type=resistive',
                'add_to_sitemap' => 1,
                'category' => 'panel_computers',
            ],
            [
                'name' => 'С ёмкостным экраном',
                'url' => '/catalog/panel_computers/?&sensor_type=capacitive',
                'add_to_sitemap' => 1,
                'category' => 'panel_computers',
            ],
            [
                'name' => 'С Full HD экраном',
                'url' => '/catalog/panel_computers/?&resolutions=1920x1080',
                'add_to_sitemap' => 1,
                'category' => 'panel_computers',
            ],
        ]
    ]
];