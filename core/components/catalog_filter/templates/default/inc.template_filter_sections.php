<?php

//$arr_series = CoreApplication::get_rows_from_table("`menu_brand_series`", "", "`active` = '1' and `menu_category_item_code` = '{$arguments['section']['code']}'", "position");
$arr_sections = CoreApplication::get_rows_from_table("`catalog_sections`", "", "active='1'", "position ASC");
/*foreach ($arr_series as $series) {
    echo($series ["name_russian"]);
    echo "<br><br>";
}*/


if (is_array($arr_sections) and count($arr_sections) > 0) {
    ?>
    <div class="filter_field_block filter_sections">
        <div class="filter_field_block__title">Разделы</div>
        <div class="filter_field_block__content">
            <div class="row server-rendered">

                <?php
                //var_dump_pre($arr_sections);
                foreach ($arr_sections as $section) {
                    if(isset($section['category_link']) and $section['category_link'] != ''){
                        $link = $section['category_link'];
                    }elseif(isset($section['category_link_brand']) and $section['category_link_brand'] != ''){
                        $link = $section['category_link_brand'];
                    }else{
                        $link = "/catalog/{$section['code']}/";
                    }
                    ?>
                    <div class="col-md-12">
                        <a href="<?= $link ?>" class="section_link">
                            <?= $section["name"] ?>
                        </a>
                    </div>
                    <?
                }
                ?>
            </div>
        </div>
    </div>
    <?php
}
