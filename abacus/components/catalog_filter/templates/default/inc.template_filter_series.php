<?php
$arr_series = CoreApplication::get_rows_from_table("`catalog_series`", "", "`active` = '1' and `menu_category_item_code` = '{$arguments['section']['code']}'", "position");
    //echo $arguments['section']['product_types'];
/*foreach ($arr_series as $series) {
    echo($series ["name_russian"]);
    echo "<br><br>";
}*/
$ser_brand = isset($_GET['brand']) ? $_GET['brand'] : '';
if (is_array($arr_series) and count($arr_series) > 0) {
    ?>
    <div class="filter_field_block filter_series is-hidden"  v-cloak>
        <div class="filter_field_block__title">Серии <span v-if="filterSelectedSeries != ''"
                                                           @click="clicked_button_clear_filter_field_block('filterSelectedSeries')"
                                                           class="button_clear_filter_field_block">x</span>
        </div>
        <noindex>
        <div class="filter_field_block__content">
            <div class="row vue-rendered server-rendered11111111">
                <?php
                foreach ($arr_series as $series) {
                    ?>
                    <div class="col-md-12<? 
					if ($series["brand"] == 'Weintek') echo ' filser filser_weintek';
					if ($series["brand"] == 'IFC') echo ' filser filser_ifc';
					if ($series["brand"] == 'Samkoon') echo ' filser filser_samkoon';
					if ($series["brand"] == 'Aplex') echo ' filser filser_aplex';
					if ($ser_brand == '' || $ser_brand!=$series["brand"]) {
						echo ' is-hidden';
					}  ?>" brand="<? echo $series["brand"]; ?>">
                        <a data-position="<?= $series["position"] ?>" data-name="<?= $series["name"] ?>"
                           data-name_russian="<?= $series["name_russian"] ?>"
                           :class="{ 'active': (filterSelectedSeries == '<?= $series["name"] ?>')}"                           @click="clicked_button_select_series('<?= $series["name"] ?>')"><?= $series["name_russian"] ?></a>
                    </div>
                    <?
                }
                ?>
            </div>
            <div class="row vue-rendered1111111111">
                <div class="col-md-12" v-for="(series_item, brand, index)  in filterSelectSeries" :key="index" brand={{series_item.brand}}>
                    <a :class="{ 'active': (filterSelectedSeries == series_item.name)}"
                       @click="clicked_button_select_series(series_item.name)">{{series_item.name_russian}}</a>
                </div>
            </div>
        </div>
		</noindex>
    </div>
    <?php
}
