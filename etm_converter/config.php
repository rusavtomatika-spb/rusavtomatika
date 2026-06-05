<?php

return [
    'paths' => [
        'base' => '/rusavto',
        'incoming' => '/rusavto/to_etm',
        'archive' => '/rusavto/to_etm/recd',
        'output' => '/rusavto/etm_converter/converted',
        'log' => '/rusavto/etm_converter/edi_converter.log'
    ],
    
    'processing' => [
        'encoding' => 'Windows-1251',
        'delimiter' => ';',
        'output_format' => 'json',
        'validate_data' => true,
        'auto_archive' => true,
        'log_level' => 'INFO'
    ],
    
    'warehouses' => [
        'ЭТМ,СПб' => ['gln' => '4660011510200', 'name' => 'Санкт-Петербург'],
        'ЭТМ,Москва' => ['gln' => '4660011510149', 'name' => 'Москва'],
        'ЭТМ,Урал' => ['gln' => '4660011510125', 'name' => 'Екатеринбург'],
        'ЭТМ,Самара' => ['gln' => '4660011510132', 'name' => 'Самара'],
        'ЭТМ,Юг' => ['gln' => '4660011510156', 'name' => 'Ростов-на-Дону'],
        'ЭТМ,Сибирь' => ['gln' => '4660011510163', 'name' => 'Новосибирск'],
        'ЭТМ,Казань' => ['gln' => '4660011510170', 'name' => 'Казань'],
        'ЭТМ,МЯ' => ['gln' => '4660011510194', 'name' => 'Малоярославец'],
        'ЭТМ,ЦРС' => ['gln' => '4660011511184', 'name' => 'Центральный склад'],
        'ЭТМ,Шушары' => ['gln' => '4660011510200', 'name' => 'Шушары'],
    ]
];