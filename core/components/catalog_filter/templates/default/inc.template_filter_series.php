<?php

$arr_series = CoreApplication::get_rows_from_table("`catalog_series`", "", "`active` = '1' and `menu_category_item_code` = '{$arguments['section']['code']}'", "position");

/*foreach ($arr_series as $series) {
    echo($series ["name_russian"]);
    echo "<br><br>";
}*/


if (is_array($arr_series) and count($arr_series) > 0) {
    ?>
    <div class="filter_field_block filter_series"  v-cloak>
        <div class="filter_field_block__title">Серии <span v-if="filterSelectedSeries != ''"
                                                           @click="clicked_button_clear_filter_field_block('filterSelectedSeries')"
                                                           class="button_clear_filter_field_block">x</span>
        </div>

        <div class="filter_field_block__content">
            <div class="row server-rendered">
                <?php
                foreach ($arr_series as $series) {
                    ?>
                    <div class="col-md-12">
                        <a data-position="<?= $series["position"] ?>" data-name="<?= $series["name"] ?>"
                           data-name_russian="<?= $series["name_russian"] ?>"
                           :class="{ 'active': (filterSelectedSeries == '<?= $series["name"] ?>')}"
                           @click="clicked_button_select_series('<?= $series["name"] ?>')"><?= $series["name_russian"] ?></a>
                    </div>
                    <?
                }
                ?>
            </div>
            <div class="row vue-rendered">
                <div class="col-md-12" v-for="(series_item, index)  in filterSelectSeries" :key="index">
                    <a :class="{ 'active': (filterSelectedSeries == series_item.name)}"
                       @click="clicked_button_select_series(series_item.name)">{{series_item.name_russian}}</a>
                </div>
            </div>
        </div>

    </div>
    <?php
}
