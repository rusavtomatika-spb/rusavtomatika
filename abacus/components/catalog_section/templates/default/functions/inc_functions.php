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
    <div class=" <? if($_POST["is_ajax"]) {  echo "is_ajax";   } ?> view-mode-<?= $view_mode ?>"><?
    switch ($view_mode) {
        case 'table':
            include $_SERVER["DOCUMENT_ROOT"]."/abacus/components/catalog_section/templates/default/templates/inc.template_list_of_products_table.php";

            break;
        case 'tiles':
            include $_SERVER["DOCUMENT_ROOT"]."/abacus/components/catalog_section/templates/default/templates/inc.template_list_of_products_tile.php";
            break;
        case 'tile':
            include $_SERVER["DOCUMENT_ROOT"]."/abacus/components/catalog_section/templates/default/templates/inc.template_list_of_products_tile.php";
            break;
        case 'list':
            include $_SERVER["DOCUMENT_ROOT"]."/abacus/components/catalog_section/templates/default/templates/inc.template_list_of_products_list.php";
            break;
    }
    ?></div><?
}
    function get_series_by_product($product)
    {
        global $mysqli_db;
		$rows = array();
        $query = "SELECT * FROM `catalog_series`WHERE `name`='$product' and `active`= '1'";
        $result = mysqli_query($mysqli_db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($mysqli_db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $rows[] = $row;
        }
        return $rows;
    }
	
    function get_all_series()
    {
        global $mysqli_db;
		$rows = array();
        $query = "SELECT * FROM `catalog_series`WHERE `active`= '1' ORDER BY `position`";
        $result = mysqli_query($mysqli_db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($mysqli_db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $rows[] = $row;
        }
        return $rows;
    }
	
