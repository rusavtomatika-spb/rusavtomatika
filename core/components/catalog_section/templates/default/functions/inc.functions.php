<?php

function sort_array_by(&$array, $extra_params)
{
    usort($array,
        function ($a, $b) use ($extra_params) {
            $field_name = $extra_params["field_name"];
            $sort_direction = $extra_params["sort_direction"];
            if ($field_name == "retail_price") {
                if (isset($a["retail_price_usd"])) $a1 = $a["retail_price_usd"];
                else $a1 = $a["retail_price"];
                if (isset($b["retail_price_usd"])) $b1 = $b["retail_price_usd"];
                else $b1 = $b["retail_price"];
            } else {
                $a1 = $a[$field_name];
                $b1 = $b[$field_name];
            }
            if ($a1 === $b1) return 0;
            if ($sort_direction == "DESC") return $a1 < $b1 ? 1 : -1;
            else  return $a1 > $b1 ? 1 : -1;
        }
    );
}

function print_product_list($products, $view_mode)
{
    global $arSettings;
    $series["products"] = $products;
    ?>
    <div class="view-mode-<?= $view_mode ?>"><?
    switch ($view_mode) {
        case 'table':
            include "templates/inc.template_list_of_products_table.php";
            break;
        case 'list':
            include "templates/inc.template_list_of_products_list.php";
            break;
    }
    ?></div><?
}
