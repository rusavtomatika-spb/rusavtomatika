<?php
global $ar_main_static_links, $ar_dynamic_links, $ar_catalog_links;
$ar_xml_links = [];

$ar_main_static_links = [
    [
        "title" => "Компания",
        "items" => [
            ["link" => "/about/", "anchor" => "О компании"],
//            ["link" => "/sertificates/", "anchor" => "Сертификаты дистрибьютора"],
            ["link" => "/support/", "anchor" => "Техподдержка"],
            ["link" => "/payment-shipping/", "anchor" => "Оплата и доставка"],
            ["link" => "/forum/", "anchor" => "Форум"],
            ["link" => "/contacts/", "anchor" => "Контакты"],
        ],
    ],
    [
        "title" => "Бренды",
        "items" => [
            ["link" => "/weintek" . EX . "/", "anchor" => "Weintek"],
            ["link" => "/samkoon" . EX . "/", "anchor" => "Samkoon"],
            ["link" => "/ifc" . EX . "/", "anchor" => "IFC"],
            ["link" => "/aplex" . EX . "/", "anchor" => "Aplex"],
            ["link" => "/ewon" . EX . "/", "anchor" => "Ewon"],
            ["link" => "/faraday" . EX . "/", "anchor" => "Faraday"],
        ],
    ],
    [
        "title" => "Библиотека",
        "items" => [
            ["link" => "/programmiruemyy_logicheskiy_kontroller_plk/", "anchor" => "Программируемые логические  контроллеры (ПЛК,PLC ) | ПЛК  на Codesys"],
            ["link" => "/download/", "anchor" => "Приложения и драйверы"],
            ["link" => "/documents" . EX . "/", "anchor" => "Документы"],
            ["link" => "/weintek_projects" . EX . "/", "anchor" => "Демо-проекты Weintek"],
            ["link" => "/weintek_projects" . EX . "/?find_projects=Macro Sample/", "anchor" => "Демо-макросы Weintek"],
            ["link" => "/weintek_libraries" . EX . "/", "anchor" => "Библиотеки для Easy Builder"],
            ["link" => "/weintek_drivers" . EX . "/", "anchor" => "Weintek драйверы контроллеров ПЛК"],
            ["link" => "/new-products" . EX . "/", "anchor" => "Новинки продукции"],
        ],
    ],
    ["title" => "Контакты",
        "items" => [
            ["link" => "/contacts/", "anchor" => "Карта проезда"],
            ["link" => "tel:+78126480347", "anchor" => "+7 (812) 648-03-47"],
            ["link" => "tel:+74951081275", "anchor" => "+7 (495) 108-12-75"],
            ["link" => "mailto:sales@rusavtomatika.com", "anchor" => "sales@rusavtomatika.com"],
            ["link" => "https://t.me/rusavtomatika", "anchor" => "Телеграм-канал Русавтоматика"],
            ["link" => "https://vk.com/weintek_official", "anchor" => "Группа Русавтоматика в VK"],
            ["link" => "https://www.youtube.com/c/rusavtomatikacom", "anchor" => "Youtube канал Русавтоматика"],
            ["link" => "skype:artemfam?chat", "anchor" => "Скайп - аккаунт artemfam"],
        ],
    ],
];


$ar_dynamic_links = [];

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$rows = CoreApplication::get_rows_from_table("articles", "name,sys_name", "`show`='1'", "date desc");
$ar_dynamic_links_items = [];
foreach ($rows as $row) {
    $ar_dynamic_links_items[] = ["link" => "/articles" . EX . "/" . $row["sys_name"] . "/", "anchor" => $row["name"],];
}
$ar_dynamic_links[1] = [
    "link" => "/articles" . EX . "/",
    "anchor" => "Статьи",
    "items" => $ar_dynamic_links_items,
];

?>