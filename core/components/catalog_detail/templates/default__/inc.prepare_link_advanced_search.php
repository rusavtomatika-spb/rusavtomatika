<?php

if (isset($product["diagonal"]) and $product["diagonal"] != "") {
    $search_diagonal = intval($product["diagonal"]) - 1;
    if ($search_diagonal == 4)
        $search_diagonal = 3;

    if ($search_diagonal == 10)
        $search_diagonal = 9;
    $search_diagonal2 = intval($product["diagonal"]) + 1;;
    $nominal_diagonal = $product["diagonal"];
    switch ($product["type"]) {
        case "hmi":
            $link_advanced_search = '<a class="link_advanced_search"  href="/advanced_search.php?' .
                'diagonal=' . $nominal_diagonal .
                '&min_diagonal=' . $search_diagonal .
                '&max_diagonal=' . $search_diagonal2 .
                '&types=0"><span class="link_advanced_search_icon"></span>Подобрать похожие панели с диагональю ' . $nominal_diagonal . '&Prime;</a>';
            break;
        case "open_hmi":
            $link_advanced_search = '<a class="link_advanced_search"  href="/advanced_search.php?' .
                'diagonal=' . $nominal_diagonal .
                'min_diagonal=' .
                $search_diagonal .
                '&max_diagonal=' .
                $search_diagonal2 .
                '&types=0"><span class="link_advanced_search_icon"></span>Подобрать похожие панели с диагональю ' . $nominal_diagonal . '&Prime;</a>';
            break;
        case "panel_pc":
            $link_advanced_search = '<a class="link_advanced_search"  href="/advanced_search.php?'
                . 'diagonal=' . $nominal_diagonal .
                '&min_diagonal=' .
                $search_diagonal .
                '&max_diagonal=' .
                $search_diagonal2 .
                '&types=1"><span class="link_advanced_search_icon"></span>Подобрать панельные компьютеры с диагональю ' . $nominal_diagonal . '&Prime;</a>';
            break;
        case "cloud_hmi":
        case "Gateway":
        case "machine-tv-interface":
            $podbor_text = "Подобрать еще устройства Weintek без дисплея";
            $link_advanced_search = '<a class="link_advanced_search"  href="/advanced_search.php?diagonals=1&brand=Weintek&types=456"><span class="link_advanced_search_icon"></span>' . $podbor_text . '</a>';
            break;

        default:
            $podbor_text = "";
            $link_advanced_search = '';
            break;
    }

}else{
    $podbor_text = "";
    $link_advanced_search = '';
}