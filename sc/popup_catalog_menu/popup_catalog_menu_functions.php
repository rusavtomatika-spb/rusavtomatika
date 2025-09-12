<?php
/** start  class CDropDownMenu ***************************************************************************************/

class CDropDownMenu
{
    public $arrBrands;
    public $arrMenu_category_item_codes;
    public $strMenu_category_item_codes;

    public $current_filter_type;


    function print_list_of_categories_by_brand()
    {
//        $category_info = $this->get_category_info($this->strCategory);
//
        echo "<div id='start_of_brand'></div>";

        $brand_info = $this->get_brand_info($this->arrBrands[0]);
        echo "<div>";
        echo "<a  id='brand_{$brand_info['name']}'  name='brand_{$brand_info['name']}' class='brand_{$brand_info["name"]} brand_link_logo_image' href='{$brand_info["brand_link"]}'><img src='{$brand_info["logo_image"]}' /></a>";
        echo "</div>";
        $brand_info["text"] = iconv('CP1251', 'UTF-8', $brand_info["text"]);
        echo $brand_info['text'];

        foreach ($this->arrMenu_category_item_codes as $category_item_code) {

            if ($category_item_code != '') {
                $category_info = $this->get_category_info($category_item_code);

                echo "<div>";
                echo "<a  id='category_{$category_info['menu_category_item_code']}'  name='category_{$category_info['menu_category_item_code']}'" .
                    " class='menu_white_panel__menu_category_item' " .
                    "href='{$category_info["category_link"]}'>{$category_info['name']}</a>";
                echo "</div>";
                $arr_series = $this->get_brand_series_by_category($this->arrBrands[0], $category_item_code);
                foreach ($arr_series as $series) {
                    if ($series["image"] == "") {
                        $class_no_image = " no_image ";
                    } else {
                        $class_no_image = "";
                    }

                    $series_name = str_replace("/", "_", $series['name']);
                    echo "<div class='category_block {$series_name}_{$series['type']}'>";

                    if ($series["image"] != "") {
                        echo '<span class="series_image_span" style="background-image: url('."'".$series["image"]."'".')"></span>';
                    }


                    echo "<a class='menu_series_item' href='{$series["series_link"]}'>";
//                    if ($series["image"] != "") {
//                        echo "<img src='{$series["image"]}' />";
//                    }
                    //$series["name_russian"] = iconv('CP1251', 'UTF-8', $series["name_russian"]);

                    echo $series["name_russian"];
                    echo "</a>";
                    $arr_products = $this->get_products_by_brand_series($this->arrBrands[0], $series["name"], $series["type"], $series["fields_for_name_addition"]);

                    switch ($series["type"]) {
                        case "text":
                            echo "<div class='products_block text $class_no_image'>";
                            $series["text_html"] = iconv('CP1251', 'UTF-8', $series["text_html"]);
                            echo $series["text_html"];
                            echo "</div>";
                            break;
                        default:
                            echo "<div class='products_block'>";
                            foreach ($arr_products as $product) {
                                //$product["model"] = str_replace("/", "-", $product["model"]);
                                $product_model_url = str_replace("/", "-", $product["model"]);
                                $product_link = str_replace("#model#", $product_model_url, $series["product_base_link"]);
                                echo "<a class='product_link' href='{$product_link}'> ";
                                $diagonal = intval($product['diagonal']);
                                $diagonal_hide = 0;

                                if(!empty($product['diagonal_hide'])){
                                  $diagonal_hide = intval($product['diagonal_hide']);
                                }


                                if ($diagonal > 0 and $diagonal_hide !== 1) {
                                    echo "<b>" . $product['diagonal'] . "&Prime;</b> ";
                                    echo $product['model'];
                                } else {
                                    echo "<b>" . $product['model'] . "</b> ";
                                }

                                if ($series["fields_for_name_addition"] != "") {
                                    $arr_extra_fields = explode(",", $series["fields_for_name_addition"]);
                                    foreach ($arr_extra_fields as $field) {
                                        $product[$field] = iconv('CP1251', 'UTF-8', $product[$field]);
                                        echo " (" . trim($product[$field]) . ") ";
                                    }
                                }



                                echo " </a> ";
                            }
                    }
                    echo "</div><hr>";

                    echo "</div>";
                }

            }
        }
    }

    function print_list_of_brands_by_category()
    {
        echo "<div id='start_of_catergory'></div>";
        foreach ($this->arrBrands as $brand) {

            $brand_info = $this->get_brand_info($brand);

            echo "<div>";
            echo "<a  id='brand_{$brand_info['name']}'  name='brand_{$brand_info['name']}' class='brand_{$brand_info["name"]} brand_link_logo_image' href='{$brand_info["brand_link"]}'><img src='{$brand_info["logo_image"]}' /></a>";
            echo "</div>";

            $arr_series = $this->get_brand_series_by_categories($brand, $this->arrMenu_category_item_codes);

            foreach ($arr_series as $series) {

                if ($series["image"] == "") {
                    $class_no_image = " no_image ";
                } else {
                    $class_no_image = "";
                }


                $series["text_html"] = iconv('CP1251', 'UTF-8', $series["text_html"]);

                $series_name = str_replace("/", "_", $series['name']);
                echo "<div class='category_block {$series_name}_{$series['type']}'>";
                if ($series["image"] != "") {
                    echo '<span class="series_image_span" style="background-image: url('."'".$series["image"]."'".')"></span>';
                }
                if ($series["series_link"] != "") {
                    echo "<a class='menu_series_item  $class_no_image' href='{$series["series_link"]}'>";
                } else {
                    echo "<span  class='menu_series_item $class_no_image'>";
                }
                echo '<span class="series_name_russian">'.$series["name_russian"].'</span>';
                if ($series["series_link"] != "") {
                    echo " </a> ";
                } else  echo " </span> ";


                switch ($series["type"]) {
                    case "text":
                        echo "<div class='products_block text $class_no_image'>";
                        echo $series["text_html"];
                        echo "</div>";
                        break;
                    default:
                        $arr_products = $this->get_products_by_brand_series($brand, $series["name"], $series["type"], $series["fields_for_name_addition"]);

                        echo "<div class='products_block $class_no_image'>";

                        foreach ($arr_products as $product) {
                            $product_model_url = str_replace("/", "-", $product["model"]);
                            $product_link = str_replace("#model#", $product_model_url, $series["product_base_link"]);
                            echo "<a class='product_link' href='{$product_link}'> ";
                            $diagonal = intval($product['diagonal']);

                            if(!empty($product['diagonal_hide'])){
                                $diagonal_hide = intval($product['diagonal_hide']);
                            }else{
                                $diagonal_hide = 0;
                            }

                            if ($diagonal > 0 and $diagonal_hide !== 1) {
                                echo "<b>" . $product['diagonal'] . "&Prime;</b> ";
                                echo $product['model'];
                            } else {
                                echo "<b>" . $product['model'] . "</b> ";
                            }
                            if ($series["fields_for_name_addition"] != "") {
                                $arr_extra_fields = explode(",", $series["fields_for_name_addition"]);
                                foreach ($arr_extra_fields as $field) {
                                    $product[$field] = iconv('CP1251', 'UTF-8', $product[$field]);
                                    echo " (" . trim($product[$field]) . ") ";
                                }
                            }
                            echo " </a> ";
                        }
                        echo "</div>";
                }
                echo "</div><hr>";
            }

        }

    }


    private function get_category_info($menu_category_item_code)
    {
        global $mysqli_db;
        //mysqli_query($mysqli_db, "SET NAMES 'cp1251'");
        $query = "SELECT `name`,`types`,`image`,`category_link`,`text`,`menu_category_item_code` FROM `menu_categories` WHERE `menu_category_item_code` = '$menu_category_item_code' order by position;";
        $result = mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($mysqli_db));
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $row['name'] = iconv('CP1251', 'UTF-8', $row['name']);
        return $row;
    }

    private function get_brand_info($brand)
    {

        global $mysqli_db;
        mysqli_query($mysqli_db, "SET NAMES 'UTF-8'");
        $query = "SELECT `name`,`logo_image`,`brand_link`,`text` FROM `menu_brands` WHERE `name` = '$brand' and `active` != '0';";
        $result = mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($mysqli_db));
        return mysqli_fetch_assoc($result);
    }

    private function get_brands_in_categories($category_code)
    {
        global $mysqli_db;
        mysqli_query($mysqli_db, "SET NAMES 'UTF-8'");
        $query = "SELECT `brands` FROM `menu_categories` WHERE `menu_category_item_code` = '$category_code';";
        $result = mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($mysqli_db));
        $row = mysqli_fetch_assoc($result);
        return $row["brands"];
    }

    private function get_products_by_brand_series($brand, $series, $type, $fields_for_name_addition = "")
    {
        switch ($type) {
            case "text":
                $out[] = "fsdgfdgfgfd";
                break;
            default:
                $out = [];
                global $mysqli_db;
                mysqli_query($mysqli_db, "SET NAMES 'UTF-8'");
                $str_extra_fields = "";
                if ($fields_for_name_addition != "") {
                    $arr_extra_fields = explode(",", $fields_for_name_addition);

                    foreach ($arr_extra_fields as $field) {
                        if ($field != "") $str_extra_fields .= " , `" . trim($field, ", ") . "` ";
                    }
                }
                 $query = "SELECT `model`,`diagonal`,`diagonal_hide` $str_extra_fields FROM `products_all`  WHERE `brand` = '$brand' and " .
                    " `series`='$series' and `type`='$type' and `parent` = '' and `discontinued` != '1' and `show_in_cat` != '0' order by `diagonal`,`position_in_menu` ASC; "; //
                $result = mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($mysqli_db));
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $out[] = $row;
                }
        }
        return $out;
    }

    private function get_brand_series_by_category($brand, $type)
    {
        $out = [];
        global $mysqli_db;
        $type = trim($type, ", ");
        $query = "SELECT `name`, `name_russian`, `image`, `series_link`, `product_base_link`, `type`, `fields_for_name_addition`, `text_html` " .
            "FROM `menu_brand_series` WHERE `brand` = '$brand' and `menu_category_item_code` = '$type'and `dont_show_in_brand` != 'hide' and `active` != '0' order by `position`, `id`;"; //


        $result = mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($mysqli_db));
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $row['name_russian'] = iconv('CP1251', 'UTF-8', $row['name_russian']);
            $out[] = $row;
        }
        return $out;
    }


    private function get_brand_series_by_categories($brand, $arr_types)
    {


        $out = [];
        global $mysqli_db;
        foreach ($arr_types as $type) {

            $type = trim($type, ", ");
            $query = "SELECT `name`, `name_russian`, `image`, `series_link`, `product_base_link`, `type`, `fields_for_name_addition`,`text_html` " .
                "FROM `menu_brand_series` WHERE `brand` = '$brand' and `menu_category_item_code` = '$type' and `active` != '0' ORDER BY `position`; ";


            $result = mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($mysqli_db));
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $row['name_russian'] = iconv('CP1251', 'UTF-8', $row['name_russian']);
//                $row['name_russian'] = "";
                $out[] = $row;
            }
        }

        return $out;
    }

    function __construct()
    {
        $this->current_filter_type = $_POST["current_filter_type"];
        switch ($this->current_filter_type) {
            case "category":
                $menu_category_item_code = trim($_POST["menu_category_item_codes"], ", ");
                $this->arrMenu_category_item_codes[] = $menu_category_item_code;
                $str_brands = $this->get_brands_in_categories($menu_category_item_code);
                $arr_brands = explode(",", $str_brands);
                if (is_array($arr_brands)) {
                    foreach ($arr_brands as $key => $brand) {
                        $brand = trim($brand, ", ");
                        if ($brand != "") $this->arrBrands[] = $brand;
                    }
                }
                break;
            default:
                $arr_brands = explode(",", $_POST["brands"]);
                if (is_array($arr_brands)) {
                    foreach ($arr_brands as $key => $brand) {
                        $brand = trim($brand, ", ");
                        if ($brand != "") $this->arrBrands[] = $brand;
                    }
                }
                $this->strMenu_category_item_codes = trim($_POST["menu_category_item_codes"], ", ");
                $arr_category_item_codes = explode(",", $_POST["menu_category_item_codes"]);
                if (is_array($arr_category_item_codes)) {
                    foreach ($arr_category_item_codes as $key => $category_item_code) {
                        $category_item_code = trim($category_item_code, ", ");
                        if ($category_item_code != "") $this->arrMenu_category_item_codes[] = $category_item_code;
                    }
                }
        }

        $this->current_filter_type = $_POST["current_filter_type"];

    }

}

/** end  class CDropDownMenu *****************************************************************************************/


if (!function_exists('var_dump_pre')) {
    function var_dump_pre($value)
    {
        echo "<pre style='font-size: 11px;color: red;max-width: 1000px;overflow: scroll;padding: 10px;'>";
        var_dump($value);
        echo "</pre>";
    }
}




/*

cMT 		cloud_hmi
cMT-X 		hmi
eMT3000 	hmi
iP 		    hmi
MT6000i 	hmi
MT8000 		hmi
MT8000iE 	hmi
MT8000XE 	hmi
mTV 		machine-tv-interface
Open HMI 	open_hmi
WT 		    hmi




 */
