<?php
if ($arguments["section"]["filter_oss"] != "") {
    $list_of_items = explode(",", $arguments["section"]["filter_oss"]);
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
        $items = CoreApplication::get_rows_from_table("`catalog_oss`", "*", $condition, "code");
        ?>


        <div class="filter_field_block">
            <div class="filter_field_block__title">ня <span v-if="filterSelectedOss.length"
                                                                    @click="clicked_button_clear_filter_field_block('filterSelectedOss')"
                                                                    class="button_clear_filter_field_block">x</span>
            </div>
            <div class="columns is-gapless is-multiline">
                <?php
                foreach ($items as $item) {
                    ?>
                    <div class="column is-6-widescreen is-12-desktop is-12-tablet">
                        <input class="<?= $item["code"] ?>" @change="filterChanged" v-model="filterSelectedOss" type="checkbox"
                               id="checkbox_os_<?= $item["code"] ?>"
                               value="<?= $item["code"] ?>"/>&nbsp;
                        <label for="checkbox_os_<?= $item["code"] ?>"><?= $item["name"] ?></label>
                    </div>
                    <?
                }
                ?>
            </div>
        </div>
        <?php
    }
}