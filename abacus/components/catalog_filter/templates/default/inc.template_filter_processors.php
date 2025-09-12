<?php
//$brands = CoreApplication::get_rows_from_table("`catalog_brands`", "", "", "name ");

/*
 *
 section
menu_brand_series ->
 *
 *
 * */



if (isset($arguments["section"]["filter_processors"]) && $arguments["section"]["filter_processors"] != "") {
    $list_of_items = explode(",", $arguments["section"]["filter_processors"]);
    if (is_array($list_of_items) and count($list_of_items) > 1) {
        $condition = "";
        foreach ($list_of_items as $item) {
            if ($item != "") {
                $condition .= " `code`= '$item' ";
                if (end($list_of_items))
                    if ($item == end($list_of_items)) {
                        $condition .= ") ";
                    } else {
                        $condition .= " or ";
                    }
            }
        }
        if ($condition != "") $condition = " (" . $condition;

        //$items = CoreApplication::get_rows_from_table("`catalog_resolutions`", "*", $condition, "code");
        ?>


        <div class="filter_field_block">
            <div class="filter_field_block__title">Процессор <span v-if="filterSelectedProcessors.length"
                                                               @click="clicked_button_clear_filter_field_block('filterSelectedProcessors')"
                                                               class="button_clear_filter_field_block">x</span>
            </div>
            <div class="columns is-gapless is-multiline">
                <?php
                foreach ($list_of_items as $item) {
                    ?>
                    <div class="column is-6-fullhd is-12-widescreen is-12-desktop is-12-tablet">
                        <input class="<?= $item ?>" @change="filterChanged" v-model="filterSelectedProcessors" type="checkbox"
                               id="checkbox_processor_<?= $item ?>"
                               value="<?= $item ?>"/>&nbsp;
                        <label for="checkbox_processor_<?= $item ?>"><?= $item ?></label>
                    </div>
                    <?
                }
                ?>
            </div>
        </div>
        <?php
    }
}else{
    echo_current_file_line_error(__FILE__,__LINE__, "Что-то пошло не так!");
}