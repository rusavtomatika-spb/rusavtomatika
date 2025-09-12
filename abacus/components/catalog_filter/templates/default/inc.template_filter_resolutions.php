<?php
//$brands = CoreApplication::get_rows_from_table("`catalog_brands`", "", "", "name ");
//var_dump_pre($arguments["section"]["filter_resolutions"]);

if (isset($arguments["section"]["filter_resolutions"]) && $arguments["section"]["filter_resolutions"] != "") {
    $list_of_items = explode(",", $arguments["section"]["filter_resolutions"]);
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
            <div class="filter_field_block__title">Разрешение экрана <span v-if="filterSelectedResolutions.length"
                                                               @click="clicked_button_clear_filter_field_block('filterSelectedResolutions')"
                                                               class="button_clear_filter_field_block">x</span>
            </div>
            <div class="columns is-gapless is-multiline">
                <?php
                foreach ($list_of_items as $item) {
                    ?>
                    <div class="column is-6-widescreen is-12-desktop is-12-tablet">
                        <input class="<?= $item ?>" @change="filterChanged" v-model="filterSelectedResolutions" type="checkbox"
                               id="checkbox_resolution_<?= $item ?>"
                               value="<?= $item ?>"/>&nbsp;
                        <label for="checkbox_resolution_<?= $item ?>"><?= $item ?></label>
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