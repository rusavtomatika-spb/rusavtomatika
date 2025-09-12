<div class="filter_field_block">
    <div class="filter_field_block__title">Цена, $<span
                v-if="filterSelectedRangePrice_min > filterSelectedRangePrice_min_start || filterSelectedRangePrice_max < filterSelectedRangePrice_max_start"
                @click="clicked_button_clear_filter_field_block('filterSelectedRangePrices')"
                class="button_clear_filter_field_block">x</span></div>
    <div class="columns is-gapless is-multiline">
        <div class="column is-12">
            <div class="filter_field_block__input_range_wrapper">
                <input class="filter_field_block__input_range"
                       v-model="filterSelectedRangePrice_min" type="text" id="Price_min">
                <input class="filter_field_block__input_range right"
                       v-model="filterSelectedRangePrice_max" type="text" id="Price_max">
                <div style="clear: both;height: 1px"></div>
                <div class="range-slider" id="price-slider"
                     data-min="0"
                     data-max="10000">
                </div>
            </div>
        </div>
    </div>
</div>

