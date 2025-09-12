<?php

class C_DB_WORK_CATALOG
{
    private $current_section_code;
    private $catalog_field_descriptions;

    function __construct($arguments = array())
    {
        if (is_array($arguments)) {
            if (isset($arguments["current_section_code"])) $this->current_section_code = $arguments["current_section_code"];
        }
        $this->catalog_field_descriptions = $this->get_all_field_descriptions();
    }
    function get_all_field_descriptions()
    {
        global $mysqli_db;
        $query = "SELECT * FROM `catalog_field_descriptions` ORDER BY `id`";
        $result = mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($mysqli_db));
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $rows[$row['code']] = $row;
        }
        return $rows;
    }

    function get_all_brands()
    {
        global $mysqli_db;
        $query = "SELECT * FROM `catalog_brands` ORDER BY `id`";
        $result = mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($mysqli_db));
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $rows[] = $row;
        }
        return $rows;
    }
    function get_all_catalog_interfaces()
    {
        global $mysqli_db;
        $query = "SELECT * FROM `catalog_interfaces` ORDER BY `id`";
        $result = mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($mysqli_db));
        $elements = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $elements[$row["code"]] = $row;
        }
        return $elements;
    }
    function get_all_catalog_resolutions()
    {
        $res = self::get_all_values_from_column_type_set('catalog_sections', 'filter_resolutions');
        return $res;
    }

    function get_all_values_from_column_type_set($table,$column)
    {
        global $mysqli_db;
        $query = "SHOW COLUMNS FROM $table LIKE '$column'";
        $result = mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($mysqli_db));
        $line = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $set  = $line['Type'];
        // Remove "set(" at start and ");" at end.
        $set  = substr($set,5,strlen($set)-7);
        // Split into an array.
        return preg_split("/','/",$set);
    }


    function get_field_describtion_by_code($code)
    {
        global $mysqli_db;
        $query = "SELECT * FROM `catalog_field_descriptions` WHERE `code` = '$code' ";
        $result = mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($mysqli_db));
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $row;
    }

    function get_section_id_by_name($name)
    {
        global $mysqli_db;
        $query = "SELECT `id` FROM `catalog_sections` WHERE `code` = '$name' ";
        $result = mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($mysqli_db));
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $row["id"];
    }

    function get_series_by_section_id_grouped_by_brand($section_id, $product_filter = "")
    {
        global $mysqli_db;
        $rows = [];
        $brands = $this->get_all_brands();
        foreach ($brands as $brand) {
            $query = "SELECT * FROM `menu_brand_series` WHERE `menu_category_item_code` = '$section_id' and `brand_id` = '{$brand['id']}'  and `active`= '1' order by position, id;";
            $result = mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($mysqli_db));
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $row['brand'] = $brand;
                $row['products'] = $this->get_products_by_series($row, $product_filter);
                $rows[$brand['code']][] = $row;
            }
        }
        return $rows;
    }

    function get_series_by_section_code_grouped_by_brand($section_code, $product_filter = "")
    {
        global $mysqli_db;
        $rows = [];
        $brands = $this->get_all_brands();
        foreach ($brands as $brand) {
            $query = "SELECT * FROM `menu_brand_series` WHERE `menu_category_item_code` = '$section_code' and `brand` = '{$brand['name']}' and `active`= '1' order by position, id;";
            //echo "<br>";
            $result = mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($mysqli_db));
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

                $row['brand'] = $brand;

                if(isset($row['preview_fields']) and $row['preview_fields'] != ""){
                    $row['preview_fields'] = trim($row['preview_fields'],", ");
                    $row['arr_preview_fields'] = explode(",", $row['preview_fields']);
                }



                $row['products'] = $this->get_products_by_series($row, $product_filter);
                $rows[$brand['code']][] = $row;
            }
        }
        return $rows;
    }


    private function get_products_by_series($arr_series, $product_filter)
    {
        $series = $arr_series["name"];
        $type = $arr_series["type"];
        $out = [];
        global $mysqli_db;
        //echo "<br>";
        $query = "SELECT * FROM `products_all`  WHERE `series` = '$series' and `type` = '$type' and `parent` = '' and `discontinued` != '1' and `show_in_cat` != '0' {$product_filter} order by `diagonal` ASC; ";
        //echo "<br>";

        $result = mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($mysqli_db));
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

            $row["link_detail_page"] = "/catalog/" . $this->current_section_code . "/" . $row["brand"] . "/" . $row["series"] . "/" . $row["model"] . "/";

            if(isset($arr_series['arr_preview_fields']) and count($arr_series['arr_preview_fields'])>0){
                $preview_text = "";
                foreach ($arr_series['arr_preview_fields'] as $preview_field){

                    $field_name_short = $this->catalog_field_descriptions[$preview_field]["name_short"];
                    $field_units = $this->catalog_field_descriptions[$preview_field]["units"];


                    $preview_text .= $field_name_short.": ".$row[$preview_field].$field_units."; ";
                    //var_dump_pre($preview_text);
                }
                $row['preview_text'] = trim($preview_text, "; ");
            }

            $out[] = $row;
        }
        return $out;
    }

}
