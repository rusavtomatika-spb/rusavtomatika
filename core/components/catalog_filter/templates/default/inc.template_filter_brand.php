<?php
//$brands = CoreApplication::get_rows_from_table("`catalog_brands`", "", "", "name ");
//var_dump_pre($arguments["section"]["brands"]);

$arguments["section"]["filter_brands"] = trim($arguments["section"]["filter_brands"],", ");

if ($arguments["section"]["filter_brands"] != "") {
    $list_of_brands_items = explode(",", $arguments["section"]["filter_brands"]);
    if (is_array($list_of_brands_items) and count($list_of_brands_items) > 1) {
        $condition = "";
        foreach ($list_of_brands_items as $item) {
            if ($item != "") {
                $condition .= " `code`= '$item' ";
                if (end($list_of_brands_items))
                    if ($item == end($list_of_brands_items)) {
                        $condition .= ") ";
                    } else {
                        $condition .= " or ";
                    }
            }
        }
        if ($condition != "") $condition = " (" . $condition;



        $brands = CoreApplication::get_rows_from_table("`catalog_brands`", "*", $condition, "code");
        ?>


        <div class="filter_field_block">
            <div class="filter_field_block__title">Απενδ <span v-if="filterSelectedBrands.length"
                                                               @click="clicked_button_clear_filter_field_block('filterSelectedBrands')"
                                                               class="button_clear_filter_field_block">x</span>
            </div>
            <div class="columns is-gapless is-multiline">
                <?php
                foreach ($brands as $brand) {
                    ?>
                    <div class="column is-6-widescreen is-12-desktop is-12-tablet">
                        <input @change="filterChanged" v-model="filterSelectedBrands" type="checkbox"
                               id="checkbox_brand_<?= $brand["code"] ?>"
                               value="<?= $brand["name"] ?>"/>&nbsp;
                        <label for="checkbox_brand_<?= $brand["code"] ?>"><?= $brand["name"] ?></label>
                    </div>
                    <?
                }
                ?>
            </div>
        </div>
        <?php
    }
}