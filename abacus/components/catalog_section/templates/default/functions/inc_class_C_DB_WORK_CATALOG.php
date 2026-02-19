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
        $result = mysqli_query($mysqli_db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($mysqli_db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $rows[$row['code']] = $row;
        }
        return $rows;
    }
	
	function get_series_with_views_by_section_code_grouped_by_brand($section_code, $product_filter = '', $products_order_by = 'ORDER BY diagonal ASC') {
        $series_data = $this->get_series_by_section_code_grouped_by_brand($section_code, $product_filter, $products_order_by);
        
        $final_result = [];

        foreach ($series_data as $brand_code => $series_list) {
            foreach ($series_list as &$series_row) {
                foreach ($series_row['products'] as &$product) {
                    $query = "
                        SELECT views 
                        FROM views 
                        WHERE item_id = {$product['index']} AND razdel = 'products' 
                        LIMIT 1";
                    
                    $result = mysqli_query($GLOBALS['mysqli_db'], $query) or die("Ошибка при получении просмотров");
                    
                    if ($view_data = mysqli_fetch_assoc($result)) {
                        $product['views'] = intval($view_data['views']);
                    } else {
                        $product['views'] = 0;
                    }
                }
            }
            
            $final_result[$brand_code] = $series_list;
        }

        return $final_result;
    }

    function get_all_brands()
    {
        global $mysqli_db;
        $query = "SELECT * FROM `catalog_brands` ORDER BY `id`";
        $result = mysqli_query($mysqli_db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($mysqli_db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $rows[] = $row;
        }
        return $rows;
    }
    function get_all_catalog_interfaces()
    {
        global $mysqli_db;
        $query = "SELECT * FROM `catalog_interfaces` ORDER BY `id`";
        $result = mysqli_query($mysqli_db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($mysqli_db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);
        $elements = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $elements[$row["code"]] = $row;
        }
        return $elements;
    }
    function get_all_catalog_oss()
    {
        global $mysqli_db;
        $query = "SELECT * FROM `catalog_oss` ORDER BY `id`";
        $result = mysqli_query($mysqli_db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($mysqli_db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);
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
        $result = mysqli_query($mysqli_db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($mysqli_db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);
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
        $result = mysqli_query($mysqli_db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($mysqli_db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $row;
    }

    function get_section_by_code($code)
    {
        $code = trim(strip_tags($code));
        global $mysqli_db;
        $query = "SELECT * FROM `catalog_sections` WHERE `code` = '$code' ";
        $result = mysqli_query($mysqli_db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($mysqli_db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);
	//echo $query;
        return mysqli_fetch_array($result, MYSQLI_ASSOC);
    }
    function get_section_id_by_name($name)
    {
        global $mysqli_db;
        $query = "SELECT `id` FROM `catalog_sections` WHERE `code` = '$name' ";
        $result = mysqli_query($mysqli_db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($mysqli_db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $row["id"];
    }

    function get_series_by_section_id_grouped_by_brand($section_id, $product_filter = "", $products_order_by = 'order by `diagonal` ASC')
    {
        global $mysqli_db;
        $rows = [];
        $brands = $this->get_all_brands();
		//echo $section_id;
        foreach ($brands as $brand) {
            $query = "SELECT * FROM `catalog_series` WHERE FIND_IN_SET('$section_id',`menu_category_item_code`) and `brand_id` = '{$brand['id']}'  and `active`= '1' order by position, id;";
            $result = mysqli_query($mysqli_db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($mysqli_db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $row['brand'] = $brand;
                $row['products'] = $this->get_products_by_series($row, $product_filter, $products_order_by);
                $rows[$brand['code']][] = $row;
            }
        }
        return $rows;
    }

    function get_series_by_section_code_grouped_by_brand($section_code, $product_filter = "", $products_order_by = 'order by `diagonal` ASC')
    {

        global $mysqli_db;
        $rows = [];
        $brands = $this->get_all_brands();

        foreach ($brands as $brand) {
             $query = "SELECT * FROM `catalog_series` WHERE FIND_IN_SET('$section_code',`menu_category_item_code`) and `brand` = '{$brand['name']}' and `active`= '1' order by position, id;";

            $result = mysqli_query($mysqli_db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($mysqli_db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $row['brand'] = $brand;
                if(isset($row['preview_fields']) and $row['preview_fields'] != ""){
                    $row['preview_fields'] = trim($row['preview_fields'],", ");
                    $row['arr_preview_fields'] = explode(",", $row['preview_fields']);
                }

                $row['products'] = $this->get_products_by_series($row, $product_filter, $products_order_by);
                $rows[$brand['code']][] = $row;
            }
        }
        return $rows;
    }

     function get_products_by_query($query){
         global $mysql_product_filter;

         if($mysql_product_filter != ""){
			 //$mysql_product_filter .= " and `discontinued` != '1' and `show_in_cat` != '0' and `status` != '0'";
             $pos = strpos($query,"ORDER");
             if($pos !== false){
                 $query = substr($query,0,$pos).$mysql_product_filter.substr($query,$pos);
             }

         }
        $out = [];
        global $mysqli_db;

        $result = mysqli_query($mysqli_db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($mysqli_db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);
	//echo $query;
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

//            $row["link_detail_page"] = "/catalog/" . $this->current_section_code . "/" . $row["brand"] . "/" . $row["series"] . "/" . $row["model"] . "/";
            if(isset($row["link_detail2"]) and $row["link_detail2"] != ""){
                $row["link_detail_page"] = $row["link_detail2"];
                if(EX != '_'){
                    $row["link_detail_page"] = str_replace("_/","/", $row["link_detail_page"]);
                }
            }else{
                $row["link_detail_page"] = "/" . strtolower($row["brand"]) . EX."/" . $row["model"] . "/";
            }



            if(isset($arr_series['arr_preview_fields']) and count($arr_series['arr_preview_fields'])>0){
                $preview_text = "";
                foreach ($arr_series['arr_preview_fields'] as $preview_field){

                    $field_name_short = $this->catalog_field_descriptions[$preview_field]["name_short"];
                    $field_units = $this->catalog_field_descriptions[$preview_field]["units"];


                    $preview_text .= $field_name_short.": ".$row[$preview_field].$field_units."; ";

                }
                $row['preview_text'] = trim($preview_text, "; ");
            }

            $out[] = $row;
        }
        return $out;
    }

    private function get_products_by_series($arr_series, $product_filter, $products_order_by = 'order by `diagonal` ASC')
    {

        $series = $arr_series["name"];
        $type = $arr_series["type"];
        $out = [];
        global $mysqli_db;
        
        $product_filter = trim($product_filter);
        
        if (empty($product_filter) || $product_filter == "and" || $product_filter == "and ()") {
            $product_filter = "";
        } else {
            if (substr($product_filter, 0, 4) == 'and ') {
                $product_filter = substr($product_filter, 4);
            }
            if (substr($product_filter, 0, 5) == 'AND ') {
                $product_filter = substr($product_filter, 5);
            }
        }
        
        $query = "SELECT * FROM `products_all`  
                WHERE FIND_IN_SET('$series',`series`) 
                AND FIND_IN_SET(`type`,'$type') 
                AND `parent` = '' 
                AND `discontinued` != '1' 
                AND `show_in_cat` != '0'";
        
        if (!empty($product_filter)) {
            $query .= " " . $product_filter;
        }
        
        $query .= " " . $products_order_by . ";";
    
        $result = mysqli_query($mysqli_db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($mysqli_db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

            if(isset($row["link_detail2"]) and $row["link_detail2"] != ""){
                $row["link_detail_page"] = $row["link_detail2"];
                if(EX != '_'){
                    $row["link_detail_page"] = str_replace("_/","/", $row["link_detail_page"]);
                }

            }else{
                $row["link_detail_page"] = "/" . strtolower($row["brand"]) . EX."/" . $row["model"] . "/";
            }



            if(isset($arr_series['arr_preview_fields']) and count($arr_series['arr_preview_fields'])>0){
                $preview_text = "";
                foreach ($arr_series['arr_preview_fields'] as $preview_field){

                    $field_name_short = $this->catalog_field_descriptions[$preview_field]["name_short"];
                    $field_units = $this->catalog_field_descriptions[$preview_field]["units"];


                    $preview_text .= $field_name_short.": ".$row[$preview_field].$field_units."; ";

                }
                $row['preview_text'] = trim($preview_text, "; ");
            }

            $out[] = $row;
        }
        return $out;
    }

    public function get_rows_from_table($table_name, $selected_fields = "", $condition = "", $order = "", $limit = "")
    {

        global $mysqli_db;
        $out = array();
        $query = "SELECT ";
        if ($selected_fields != '') $query .= " " . $selected_fields . " ";
        else $query .= " * ";
        $query .= " FROM " . $table_name . " ";
        if ($condition != '') $query .= " WHERE " . $condition . " ";
        if ($order != '') $query .= " ORDER BY  " . $order . " ";
        if ($limit != '') $query .= " LIMIT  " . $limit . " ";

        /*        var_dump($query);
                echo "<br>";*/

        $result = mysqli_query($mysqli_db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($mysqli_db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);
        while ($row = mysqli_fetch_assoc($result)) {
            $out[] = $row;
        }

        return $out;
    }

}
