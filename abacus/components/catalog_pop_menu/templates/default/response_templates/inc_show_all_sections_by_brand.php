<?

if (isset($_POST['brand']) and $_POST['brand'] != '') {

    $brand = strip_tags($_POST['brand']);



    $arrBrand = CoreApplication::get_rows_from_table("catalog_brands", "" , "name='$brand' and active='1'", "position ASC")[0];

    //var_dump_pre($arrBrand);



    $extra_condition_for_product = '';



    if (isset($_POST["link"]) and $_POST["link"] != '') {



        $_POST["link"] = strip_tags($_POST["link"]);

        $arr_all_params = explode('?', $_POST["link"]);

        if (count($arr_all_params) > 1) {

            $str_params = $arr_all_params[1];

            $str_params = trim($str_params, "& ");

            $arr_params = explode("&", $str_params);

            if (count($arr_params) > 0) {

                $arr_one_param = explode("=", $arr_params[0]);

                $param1_code = $arr_one_param[0];

                $param1_value = $arr_one_param[1];

                if ($param1_code == 'os') {

                    $extra_condition_for_product = " and FIND_IN_SET('{$param1_value}', os_codes)>0  ";

                }

            }

        }

    }





    if ($_POST["category"] != '' and $_POST["category"] != 'all') {

        $section = strip_tags($_POST["category"]);

        $section_condition = " and code='$section' ";

    } else $section_condition = "";



    if (isset($section) and $section != "") {

        if (isset($_POST["category_id"]) and $_POST["category_id"] != '') {

            $category_id = strip_tags($_POST["category_id"]);

            $arr_category = CoreApplication::get_rows_from_table('catalog_sections', "name, hide_name_in_menu", "id='$category_id'", "", "1");

            if (is_array($arr_category)) $category_name = $arr_category[0]["name"];

            else $category_name = "-";





            if ($_POST["link"] != "") $link = $_POST["link"];

            else $link = "/catalog/" . $section . "/?&brand=" . ($brand);



            $category_name = str_replace($brand, " ", $category_name);

            if (isset($arr_category[0]["hide_name_in_menu"]) and $arr_category[0]["hide_name_in_menu"] != '1') {

                ?>

                <div class="catalog_pop_menu_brand_title xxx1"><a href="<?= $link ?>"><?= $category_name ?>

                        - <?= $brand ?></a>

                </div>

                <?php

                if($brand == "Weintek" and $category_name == "Панели оператора"){

                    include "../../default - Копия/response_templates/inc_weintek_info.php";

                }







            }

        }

    } else {//var_dump_pre($arrBrand["brand_page_link"]);

        if(isset($arrBrand["brand_page_link"]) and $arrBrand["brand_page_link"] != ''){

            ?>

            <div class="catalog_pop_menu_brand_title xxx2"><a href="<?=$arrBrand["brand_page_link"]?>" ><?= $brand ?></a></div>

            <?php

            if($brand == "Weintek"){

                include "../../default - Копия/response_templates/inc_weintek_info.php";

            }





        }else{

            ?>

            <div class="catalog_pop_menu_brand_title xxx3"><?= $brand ?></div>

            <?php



        }

    }



    $arrSections = CoreApplication::get_rows_from_table('catalog_sections', "", "FIND_IN_SET('$brand',	filter_brands)>0 $section_condition", "position ASC", "");



    $arr_ALL_series = array();



    foreach ($arrSections as $section) {

        $arr_catalog_series_test = CoreApplication::get_rows_from_table('catalog_series', "", "menu_category_item_code='{$section['code']}' and brand='{$brand}'", "position ASC", "");

        foreach ($arr_catalog_series_test as $i) {

            $arr_ALL_series[$i["id"]] = $i;

        }

    }

    ?>



    <ul class="series-list">

        <?php

        foreach ($arr_ALL_series as $catalog_series) {

            {

                $section_series_link = CATALOG_SECTION_URL_TEMPATE;

                $section_series_link = str_replace("#section#", $_POST['category'], $section_series_link);

                $section_series_link = "?&series={$catalog_series['name']}&type={$catalog_series['type']}&brand=" . $brand;

                if (isset($catalog_series["type"]) and $catalog_series["type"] == 'text') {



                    echo $catalog_series["text_html"];

                } else {



                    ob_start();



                    ?>

                    <li class="series-list-item">

                    <span class="series-list-item-title"> <!-- href="<?= $section_series_link ?>" -->

                        <?= $catalog_series["name_russian"] ?>

                    </span>

                        <ul class="series-list-item-list">

                            <?





                            $arr_products = CoreApplication::get_rows_from_table('products_all', "model,s_name,diagonal_hide,diagonal", "show_in_cat!='0' and discontinued!='1' and parent = '' and type='{$catalog_series["type"]}' and brand='{$brand}' and series='{$catalog_series["name"]}' $extra_condition_for_product", "diagonal ASC, model ASC", "");



                            foreach ($arr_products as $product) {



                                $link = CATALOG_PRODUCT_URL_TEMPATE;



                                if($brand == 'Faraday'){

                                    $model = str_replace("/", "_", $product['s_name']);

                                    $model = str_replace(" ", "_", $model);

                                }else{

                                    $model = str_replace("/", "_", $product['model']);

                                    $model = str_replace(" ", "_", $model);

                                }







                                $link = str_replace("#brand#", strtolower($brand), $link);

                                $link = str_replace("#model#", $model, $link);



                                ?>

                                <li class="series-list-item-subitem" data-type="<?=$catalog_series["type"]?>" data-series="<?=$catalog_series["name"]?>"><a href="<?= $link ?>"><?

                                        if ($product['diagonal'] > 0 and $product['diagonal_hide'] != '1') {

                                            echo $product['diagonal'] . '&quot;';

                                        } ?>

                                        <?= $product['model'] ?>

                                    </a></li> <?

                            }

                            ?>

                        </ul>

                    </li>

                    <?

                    $buffer_section = ob_get_clean();

                    if (isset($arr_products) and is_array($arr_products) and count($arr_products) > 0) {

                        echo $buffer_section;

                    }

                }

            }



        }

        ?>

    </ul>



    <?/*

    foreach ($arrSections as $section) {

        ?>

        <ul class="series-list">

        <?php

        $arr_catalog_series = CoreApplication::get_rows_from_table('catalog_series', "", "menu_category_item_code='{$section['code']}' and brand='{$brand}'", "position ASC", "");









        foreach ($arr_catalog_series as $catalog_series) {

            $section_series_link = CATALOG_SECTION_URL_TEMPATE;

            $section_series_link = str_replace("#section#", $_POST['category'], $section_series_link);

            $section_series_link = "?&series={$catalog_series['name']}&type={$catalog_series['type']}&brand=" . strtolower($brand);

            if (isset($catalog_series["type"]) and $catalog_series["type"] == 'text') {

                echo $catalog_series["text_html"];

            } else {



                ob_start();



            ?>

            <li class="series-list-item">

                    <span class="series-list-item-title"> <!-- href="<?= $section_series_link ?>" -->

                        <?= $catalog_series["name_russian"] ?>

                    </span>

                <ul class="series-list-item-list">

                    <?







                    $arr_products = CoreApplication::get_rows_from_table('products_all', "model,diagonal_hide,diagonal", "discontinued!='1' and type='{$catalog_series["type"]}' and brand='{$brand}' and series='{$catalog_series["name"]}' $extra_condition_for_product", "", "");



                    foreach ($arr_products as $product) {



                        $link = CATALOG_PRODUCT_URL_TEMPATE;

                        $link = str_replace("#brand#", strtolower($brand), $link);

                        $link = str_replace("#model#", $product['model'], $link);



                        ?>

                        <li class="series-list-item-subitem"><a href="<?= $link ?>"><?

                                if ($product['diagonal'] > 0 and $product['diagonal_hide'] != '1') {

                                    echo $product['diagonal'] . '&quot;';

                                } ?>

                                <?= $product['model'] ?>

                            </a></li> <?

                    }

                    ?>

                </ul>

            </li>

            <?

                $buffer_section = ob_get_clean();

                if(isset($arr_products) and is_array($arr_products) and count($arr_products)>0){

                    echo $buffer_section;

                }

            }

        }



        ?>

        </ul>

        <?

    }

    */

}

?>