<?php

class Core_database_products_all
{
    private static $table = 'products_all';

    function __construct() {}

    public static function get_element($model)
    {
        if (isset($model) and $model != "") {
            global $mysqli_db;

            $model_esc = mysqli_real_escape_string($mysqli_db, $model);
            $query = "SELECT p.*, 
                            COALESCE(s.`onstock_spb`, 0) AS `onstock_spb`,
                            COALESCE(s.`onstock_msk`, 0) AS `onstock_msk`,
                            COALESCE(s.`onstock_kiv`, 0) AS `onstock_kiv`,
                            COALESCE(s.`onstock_ptg`, 0) AS `onstock_ptg`
                    FROM `" . self::$table . "` p
                    LEFT JOIN `product_stock` s ON s.`product_index` = p.`index`
                    WHERE p.`model` = '" . $model_esc . "'";

            $result = mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($mysqli_db));
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $section_code = self::get_element_section_code_by_brand_type($row["brand"], $row["type"]);

            if($row["section"] == 'accessories'){
                $row["link_detail_page"] = "/accessories/" . $row["model"] . "/";
            }else{
                $row["link_detail_page"] = "/".strtolower($row["brand"]). "/" . $row["model"] . "/";
            }

            return $row;
        }
    }

    public static function get_element_section_code_by_brand_type($brand, $type)
    {
        if ($type != "" and $brand != "") {
            global $mysqli_db;

            $brand_esc = mysqli_real_escape_string($mysqli_db, $brand);
            $type_esc  = mysqli_real_escape_string($mysqli_db, $type);
            $query = "SELECT * FROM `catalog_series` WHERE `brand` = '" . $brand_esc . "' and `type` = '" . $type_esc . "'";
            $result = mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($mysqli_db));
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

            if (isset($row['menu_category_item_code'])) {
                return $row['menu_category_item_code'];
            }
        } else return '';
    }
}