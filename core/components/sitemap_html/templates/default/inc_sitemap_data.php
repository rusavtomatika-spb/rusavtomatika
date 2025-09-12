<?php
global $ar_main_static_links, $ar_dynamic_links, $ar_catalog_links;
$ar_xml_links = [];

$ar_main_static_links = [
    [
        "title" => "��������",
        "items" => [
            ["link" => "/about/", "anchor" => "� ��������"],
            ["link" => "/sertificates/", "anchor" => "����������� �������������"],
            ["link" => "/support/", "anchor" => "������������"],
            ["link" => "/payment-shipping/", "anchor" => "������ � ��������"],
            ["link" => "/forum/", "anchor" => "�����"],
            ["link" => "/contacts/", "anchor" => "��������"],
        ],
    ],
    [
        "title" => "������",
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
        "title" => "����������",
        "items" => [
            ["link" => "/download/", "anchor" => "���������� � ��������"],
            ["link" => "/documents" . EX . "/", "anchor" => "���������"],
            ["link" => "/weintek_projects" . EX . "/", "anchor" => "����-������� Weintek"],
            ["link" => "/weintek_projects" . EX . "/?find_projects=Macro Sample/", "anchor" => "����-������� Weintek"],
            ["link" => "/weintek_libraries" . EX . "/", "anchor" => "���������� ��� Easy Builder"],
            ["link" => "/weintek_drivers" . EX . "/", "anchor" => "Weintek �������� ������������ ���"],
            ["link" => "/new-products" . EX . "/", "anchor" => "������� ���������"],
        ],
    ],
    ["title" => "��������",
        "items" => [
            ["link" => "/contacts/", "anchor" => "����� �������"],
            ["link" => "tel:+78126480347", "anchor" => "+7 (812) 648-03-47"],
            ["link" => "tel:+74951081275", "anchor" => "+7 (495) 108-12-75"],
            ["link" => "mailto:sales@rusavtomatika.com", "anchor" => "sales@rusavtomatika.com"],
            ["link" => "https://t.me/rusavtomatika", "anchor" => "��������-����� �������������"],
            ["link" => "https://vk.com/weintek_official", "anchor" => "������ ������������� � VK"],
            ["link" => "https://www.youtube.com/c/rusavtomatikacom", "anchor" => "Youtube ����� �������������"],
            ["link" => "skype:artemfam?chat", "anchor" => "����� - ������� artemfam"],
        ],
    ],
];


$ar_dynamic_links = [];

// �������
$rows = CoreApplication::get_rows_from_table("news", "name,sys_name", "active='1'", "date desc");
$ar_dynamic_links_items = [];
foreach ($rows as $row) {
    $ar_dynamic_links_items[] = ["link" => "/news" . EX . "/" . $row["sys_name"] . "/", "anchor" => $row["name"],];
}

$ar_dynamic_links[0] = [
    "link" => "/news" . EX . "/",
    "anchor" => "�������",
    "items" => $ar_dynamic_links_items,
];
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$rows = CoreApplication::get_rows_from_table("articles", "name,sys_name", "`show`='1'", "date desc");
$ar_dynamic_links_items = [];
foreach ($rows as $row) {
    $ar_dynamic_links_items[] = ["link" => "/articles" . EX . "/" . $row["sys_name"] . "/", "anchor" => $row["name"],];
}
$ar_dynamic_links[1] = [
    "link" => "/articles" . EX . "/",
    "anchor" => "������",
    "items" => $ar_dynamic_links_items,
];
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$rows = CoreApplication::get_rows_from_table("videos", "name,code", "`show`='1'", "id desc");
$ar_dynamic_links_items = [];
foreach ($rows as $row) {
    $ar_dynamic_links_items[] = ["link" => "/video" . EX . "/" . $row["code"] . "/", "anchor" => $row["name"],];
}
$ar_dynamic_links[2] = [
    "link" => "/video" . EX . "/",
    "anchor" => "���������� rusavtomatika.com",
    "items" => $ar_dynamic_links_items,
];
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// �������

$ar_brands = CoreApplication::get_rows_from_table("catalog_brands", "name", "`active`='1'", "position asc");
$ar_sections = CoreApplication::get_rows_from_table("catalog_sections", "name,code,category_link,products_selected_by_query", "`active`='1'", "position asc");
$ar_section_links = [];
foreach ($ar_sections as $ar_section) {

    $extra_condition = '';
    if ($ar_section["products_selected_by_query"] != "") {
        $ar_products = CoreApplication::direct_sql_query($ar_section["products_selected_by_query"]);
        $items = [];
        foreach ($ar_products as $item) {
            $items[] = ["model" => $item["model"], "brand" => $item["brand"], "section" => $item["section"],];
        }
        $ar_series_links[] = [
            'brand' => "",
            'series_name' => "",
            'items' => $items,
        ];
        $items = [];
        $ar_section_links[$ar_section["name"]] = ["link" => $link, "anchor" => $ar_section["name"], "series" => $ar_series_links];
        $ar_series_links = [];

    } else {
        $ar_products = [];
        if ($ar_section["category_link"] != '') {
            $link = $ar_section["category_link"];
            $tmp = explode("?&", $link);
            if (isset($tmp[1])) {
                $tmp2 = explode("=", $tmp[1]);
                if (isset($tmp2[1]) and $tmp2[1] != '') {
                    if ($tmp2[0] == 'os') {
                        $tmp2[0] = 'os_codes';
                        $extra_condition = " and `{$tmp2[0]}` like '%{$tmp2[1]}%' ";
                    } else {
                        $extra_condition = " and `{$tmp2[0]}` = '{$tmp2[1]}' ";
                    }
                } else {
                    $extra_condition = '';
                }
            }

        } else {
            $link = "/catalog/" . $ar_section["code"] . "/";
        }
        // �����
        $ar_series = [];
        foreach ($ar_brands as $brand) {

            $ar_series = CoreApplication::get_rows_from_table("catalog_series", "name,type", " `menu_category_item_code`='{$ar_section["code"]}' and `brand`='{$brand["name"]}' and `active`='1'", "position asc");

            foreach ($ar_series as $series) {


                $items = CoreApplication::get_rows_from_table("products_all", "model,brand,s_name", " `type`='{$series["type"]}' and `series`='{$series["name"]}' and `brand`='{$brand["name"]}' and `show_in_cat`!='0' and `discontinued` != '1'" . $extra_condition, " `index` desc");

                if (count($items) > 0) {
                    $ar_series_links[] = [
                        'brand' => $brand["name"],
                        'series_name' => $series["name"],
                        'items' => $items,
                    ];
                } else {
                    //echo " `type`='{$series["type"]}' and `series`='{$series["name"]}' and `brand`='{$brand["name"]}' and `show_in_cat`!='0' and `discontinued` != '1'".$extra_condition."<br><br>";
                }


            }

        }
        //
        $ar_section_links[$ar_section["name"]] = ["link" => $link, "anchor" => $ar_section["name"], "series" => $ar_series_links];
        $ar_series_links = [];
    }
}

$ar_catalog_links = [
    "link" => "/catalog/",
    "anchor" => "������� ���������",
    "items" => $ar_section_links,
];


?>