<?php
//$brands = CoreApplication::get_rows_from_table("`catalog_brands`", "", "", "name ");
//var_dump_pre($arguments["section"]["brands"]);

if ($arguments["section"]["filter_interfaces"] != "") {
    $list_of_items = explode(",", $arguments["section"]["filter_interfaces"]);

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

        $items = CoreApplication::get_rows_from_table("`catalog_interfaces`", "*", $condition, "position");
        ?>


        <div class="filter_field_block">
            <div class="filter_field_block__title">Интерфейсы <span v-if="filterSelectedInterfaces.length"
                                                               @click="clicked_button_clear_filter_field_block('filterSelectedInterfaces')"
                                                               class="button_clear_filter_field_block">x</span>
            </div>
            <div class="columns is-gapless is-multiline">
                <?php
                foreach ($items as $item) {
                    ?>
                    <div class="column is-6-widescreen is-12-desktop is-12-tablet">
                        <input class="<?= $item["code"] ?>" @change="filterChanged" v-model="filterSelectedInterfaces" type="checkbox"
                               id="checkbox_interface_<?= $item["code"] ?>"
                               value="<?= $item["code"] ?>"/>&nbsp;
                        <label class="<?= $item["code"] ?>" for="checkbox_interface_<?= $item["code"] ?>"><?= $item["name"] ?></label>
                    </div>
                    <?
                }
                ?>
            </div>
        </div>
        <?php
    }
}