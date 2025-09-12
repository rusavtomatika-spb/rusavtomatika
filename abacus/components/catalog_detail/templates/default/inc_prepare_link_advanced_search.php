<?php
$product = $arResult['product'];

if (isset($product["diagonal"]) and $product["diagonal"] != "") {
    $search_diagonal1 = floatval($product["diagonal"]) - 1;
    $search_diagonal2 = floatval($product["diagonal"]) + 2;
    if ($search_diagonal1 < 0) $search_diagonal1 = 0;

    switch ($product["type"]) {
        case "hmi":
        case "open_hmi":
            $link_advanced_search = '<a class="button is-success is-outlined find_similars"  href="/catalog/'.$arResult['section']["code"].'/?' .
                '&range_diagonal_min=' . $search_diagonal1 .
                '&range_diagonal_max=' . $search_diagonal2 .
                '"><span class="link_advanced_search_icon"></span>Подобрать похожие панели с диагональю ' . $product["diagonal"] . '&Prime;</a>';
            break;
        case "panel_pc":
            $link_advanced_search = '<a class="button is-success is-outlined find_similars"  href="/catalog/'.$arResult['section']["code"].'/?' .
                '&range_diagonal_min=' . $search_diagonal1 .
                '&range_diagonal_max=' . $search_diagonal2 .
                '"><span class="link_advanced_search_icon"></span>Подобрать панельные компьютеры с диагональю ' . $product["diagonal"] . '&Prime;</a>';
            break;
/*        case "cloud_hmi":
        case "Gateway":
        case "machine-tv-interface":
            $podbor_text = "Подобрать еще устройства Weintek без дисплея";
            $link_advanced_search = '<a class="button is-success is-outlined find_similars"  href="/advanced_search.php?diagonals=1&brand=Weintek&types=456"><span class="link_advanced_search_icon"></span>' . $podbor_text . '</a>';
            break;*/

        default:
            $podbor_text = "";
            $link_advanced_search = '';
            break;
    }

}else{
    $podbor_text = "";
    $link_advanced_search = '';
}