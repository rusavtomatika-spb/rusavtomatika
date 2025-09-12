<div class="filter_field_block">
    <div class="filter_field_block__title">COM-порты<span
                v-if="filterSelectedRangeCOM_min > filterSelectedRangeCOM_min_start || filterSelectedRangeCOM_max < filterSelectedRangeCOM_max_start"
                @click="clicked_button_clear_filter_field_block('filterSelectedRangeCOMs')"
                class="button_clear_filter_field_block">x</span></div>
    <div class="columns is-gapless is-multiline">
        <div class="column is-12">
            <div class="filter_field_block__input_range_wrapper">
                <input class="filter_field_block__input_range"
                       v-model="filterSelectedRangeCOM_min" type="text" id="COM_min">
                <input class="filter_field_block__input_range right"
                       v-model="filterSelectedRangeCOM_max" type="text" id="COM_max">
                <div style="clear: both;height: 1px"></div>
                <div class="range-slider" id="COM-slider"
                     data-min="0"
                     :data-max="filterSelectedRangeCOM_max_start">
                </div>
            </div>
        </div>
    </div>
</div>

