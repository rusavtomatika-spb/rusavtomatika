<?php

$arr_types = CoreApplication::get_rows_from_table("`catalog_types`", "", "`active` = '1' and `show_filter_in_section` = '{$arguments['section']['code']}'", "position");

/*foreach ($arr_types as $types) {
    echo($types ["short_name"]);
    echo "<br><br>";
}*/


if (is_array($arr_types) and count($arr_types) > 0) {
    ?>
    <div class="filter_field_block filter_types"  v-cloak>
        <div class="filter_field_block__title">Тип устройства <span v-if="filterSelectedTypes != ''"
                                                           @click="clicked_button_clear_filter_field_block('filterSelectedTypes')"
                                                           class="button_clear_filter_field_block">x</span>
        </div>

        <div class="filter_field_block__content">
            <div class="row server-rendered">
                <?php
                foreach ($arr_types as $types) {
                    ?>
                    <div class="col-md-12">
                        <a data-position="<?= $types["position"] ?>" data-name="<?= $types["code"] ?>"
                           data-name_russian="<?= $types["short_name"] ?>"
                           :class="{ 'active': (filterSelectTypes == '<?= $types["code"] ?>')}"
                           @click="clicked_button_select_Types('<?= $types["code"] ?>')"><?= $types["short_name"] ?></a>
                    </div>
                    <?
                }
                ?>
            </div>
            <div class="row vue-rendered">
                <div class="col-md-12" v-for="(Types_item, index)  in filterSelectTypes" :key="index">
                    <a :class="{ 'active': (filterSelectedTypes == Types_item.name)}"
                       @click="clicked_button_select_Types(Types_item.name)">{{Types_item.name_russian}}</a>
                </div>
            </div>
        </div>

    </div>
    <?php
}
