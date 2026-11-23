<?php
$arr_sections = CoreApplication::get_rows_from_table("`catalog_sections`", "", "active='1'", "position ASC");

if (is_array($arr_sections) and count($arr_sections) > 0) {
    ?>
    <div class="filter_field_block filter_sections">
        <div class="filter_field_block__title">Разделы</div>
        <noindex>
        <div class="filter_field_block__content">
            <div class="row server-rendered">
                <?php

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
        </noindex>
    </div>
    <?php
}