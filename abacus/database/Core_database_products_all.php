<?php

class Core_database_products_all
{
    private static $table = 'products_all';

    function __construct()
    {

    }

    public static function get_element($model)
    {
        if (isset($model) and $model != "") {
            global $mysqli_db;
            $query = "SELECT * FROM `" . self::$table . "` WHERE `model` = '" . $model . "'";
            $result = mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($mysqli_db));
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

            $section_code = self::get_element_section_code_by_brand_type($row["brand"], $row["type"]);

//            $row["link_detail_page"] = "/catalog/" . $section_code . "/" . $row["brand"] . "/" . $row["series"] . "/" . $row["model"] . "/";
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
            $query = "SELECT * FROM `catalog_series` WHERE `brand` = '" . $brand . "' and `type` = '" . $type . "'";
            $result = mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($mysqli_db));
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if (isset($row['menu_category_item_code'])) {
                return $row['menu_category_item_code'];
            }
        } else return '';
    }


}
