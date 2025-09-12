<?



if (isset($_POST['category_id']) and $_POST['category_id'] != '') {



    $_POST['category_id'] = strip_tags($_POST['category_id']);

    $_POST['category'] = strip_tags($_POST['category']);



    $extra_condition_for_product = '';



    $arr_category = CoreApplication::get_row_by_id('catalog_sections', $_POST['category_id']);





    if (isset($_POST["link"]) and $_POST["link"] != '') {

        $_POST["link"] = strip_tags($_POST["link"]);



        ?>

        <div class="category_link"><a href="<?= $_POST["link"] ?>">Категория: &nbsp; <?= $arr_category['name'] ?> &nbsp;

            <span class="arrow"></span></a></div><?php









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





    } else {

        if (isset($arr_category["category_link_brand"]) and $arr_category["category_link_brand"] != '') {

            ?>

            <div class="category_link"><a href="<?= $arr_category['category_link_brand'] ?>">Категория:

                &nbsp; <?= $arr_category['name'] ?> &nbsp; <span class="arrow"></span></a></div><?php

        } else {

            ?>

            <div class="category_link"><a href="/catalog/<?= $arr_category['code'] ?>/">Категория:

                &nbsp; <?= $arr_category['name'] ?> &nbsp; <span class="arrow"></span></a></div><?php

        }



        if ($arr_category['products_selected_by_query'] != "" and $arr_category["hide_name_in_menu"] != '1') {



            $arr_products = CoreApplication::direct_sql_query($arr_category['products_selected_by_query']);

            if (count($arr_products) > 0) {

                ?>



                <ul class="series-list-item-list products_selected_by_query">

                    <?

                    foreach ($arr_products as $product) {



                        if ($product["link_detail2"] != '') {

                            $link = $product["link_detail2"];

                            if(EX != "_"){

                                $link = str_replace("_/","/",$link);

                            }

                        } else {



                            $link = CATALOG_PRODUCT_URL_TEMPATE;

                            $link = str_replace("#brand#", strtolower($product['brand']), $link);

                            $link = str_replace("#model#", $product['model'], $link);

                        }

                        ?>

                        <li class="series-list-item-subitem width_full">

                            <a href="<?= $link ?>"><?

                                if ($product['model_fullname'] != '') {

                                    echo $product['model_fullname'];

                                } else {

                                    if ($product['diagonal'] > 0 and $product['diagonal_hide'] != '1') {

                                        echo $product['diagonal'] . '&quot;';

                                    }

                                    echo $product['model'];

                                }

                                ?>

                            </a>

                        </li>

                        <?

                    }

                    ?>

                </ul>

                <?php

            }

        }

    }





    if (isset($_POST['brand']) and $_POST['brand'] != '' and $_POST['brand'] != 'all') {

        $condition = "name='{$_POST['brand']}'";

    } else $condition = "";

    $arrBrands_arranged = CoreApplication::get_rows_from_table('catalog_brands', "name", $condition, "position ASC", "");



    $catalog_section = CoreApplication::get_rows_from_table('catalog_sections', "", "id='{$_POST['category_id']}' ", "", "1");

    $arrBrands = array();

    foreach ($arrBrands_arranged as $brand) {

        $pos = strpos($catalog_section[0]['filter_brands'], $brand['name']);

        if ($pos !== false) {

            $arrBrands[] = $brand['name'];

        }

    }

    if (is_array($arrBrands) and count($arrBrands) > 0) {

        foreach ($arrBrands as $brand) {

            $arr_catalog_series = CoreApplication::get_rows_from_table('catalog_series', "", "menu_category_item_code='{$_POST['category']}' and brand='{$brand}' and active='1'", "position ASC", "");

            $section_brand_link = CATALOG_SECTION_URL_TEMPATE;

            $section_brand_link = str_replace("#section#", $_POST['category'], $section_brand_link);

            $section_brand_link .= "&brand=" . $brand;



            if ($catalog_section[0]["hide_name_in_menu"] != 1) {

                if (isset($catalog_section[0]["category_link"]) and $catalog_section[0]["category_link"] != '') {

                    ?>

                    <div class="catalog_pop_menu_brand_title">

                    <a

                            href="<?= $catalog_section[0]["category_link"] . "&brand=" . $brand ?>"><?= $catalog_section[0]["name"] . " - " . $brand ?></a>

                    </div>

                    <?php
                    if($brand == "Weintek" and $catalog_section[0]["name"] == "Панели оператора" ){

                        include "inc_weintek_info.php";

                    }


                } else {
                    ?>

                    <div class="catalog_pop_menu_brand_title"><a

                            href="<?= $section_brand_link ?>"><?= $catalog_section[0]["name"] . " - " . $brand ?></a>

                    </div><?php

                    if($brand == "Weintek" and $catalog_section[0]["name"] == "Панели оператора" ){

                        include "inc_weintek_info.php";

                    }



                }

            }

            ?>

            <ul class="series-list">

            <?php

            foreach ($arr_catalog_series as $catalog_series) {

                $section_series_link = CATALOG_SECTION_URL_TEMPATE;

                $section_series_link = str_replace("#section#", $_POST['category'], $section_series_link);

                $section_series_link = "?&series={$catalog_series['name']}&type={$catalog_series['type']}&brand=" . ($brand);

                if (isset($catalog_series["type"]) and $catalog_series["type"] == 'text') {

                    if($catalog_series["name"] == "Weintek_iR" and EX != "_"){

                        $catalog_series["text_html"] = str_replace("/weintek_/","/weintek/",$catalog_series["text_html"]);

                    }

                    echo $catalog_series["text_html"];

                } else {

                    ob_start();

                    ?>

                    <li class="series-list-item">



                    <a class="series-list-item-title" href="<?= "/catalog/".$_POST['category']."/".$section_series_link ?>"> <!-- href="<?= $section_series_link ?>" -->

                        <?= $catalog_series["name_russian"] ?>

                    </a>



                        <ul class="series-list-item-list not_text">



                            <?

                            $arr_products = CoreApplication::get_rows_from_table('products_all', "model,s_name,diagonal_hide,diagonal", "show_in_cat!='0' and discontinued!='1' and parent = '' and type='{$catalog_series["type"]}' and brand='{$brand}' and series='{$catalog_series["name"]}' $extra_condition_for_product", " diagonal ASC, model ASC", "");

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



                                if(EX != "_"){

                                    $link = str_replace("_/","/",$link);

                                }

                                ?>

                                <li class="series-list-item-subitem xxxx" data-type="<?=$catalog_series["type"]?>" data-series="<?=$catalog_series["name"]?>">

                                    <a href="<?= $link ?>"><?

                                        if ($product['diagonal'] > 0 and $product['diagonal_hide'] != '1') {

                                            echo $product['diagonal'] . '&quot;';

                                        } ?>

                                        <?= $product['model'] ?>

                                    </a>

                                </li> <?

                            }

                            ?>

                        </ul>

                    </li>

                    <?

                    $one_series_buffer = ob_get_clean();

                    if (isset($arr_products) and is_array($arr_products) and count($arr_products) > 0) {

                        echo $one_series_buffer;

                    }

                }

                ?>

                <?php

            }

            ?></ul><?php

        }

    }

/*    elseif(isset($arr_category["products_selected_by_query"]) and $arr_category["products_selected_by_query"] != ''){

        echo "!!!!!!!!!!!";

    }*/

}

?>