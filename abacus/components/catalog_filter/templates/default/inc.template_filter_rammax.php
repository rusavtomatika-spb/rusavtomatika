<div class="filter_field_block">
    <div class="filter_field_block__title">max Размер ОЗУ, Мб<span
                v-if="filterSelectedRangerammax_min > filterSelectedRangerammax_min_start || filterSelectedRangerammax_max < filterSelectedRangerammax_max_start"
                @click="clicked_button_clear_filter_field_block('filterSelectedRangerammax')"
                class="button_clear_filter_field_block">x</span></div>
        <div class="columns is-gapless is-multiline">
            <div class="column is-12">
            <div class="filter_field_block__input_range_wrapper">
                <input class="filter_field_block__input_range"
                       v-model="filterSelectedRangerammax_min" type="text" id="rammax_min">
                <input class="filter_field_block__input_range right"
                       v-model="filterSelectedRangerammax_max" type="text" id="rammax_max">
                <div style="clear: both;height: 1px"></div>
                <div class="range-slider" id="rammax-slider"
                     data-min="0"
                     :data-max="filterSelectedRangerammax_max_start">
                </div>
            </div>
        </div>
    </div>
</div>