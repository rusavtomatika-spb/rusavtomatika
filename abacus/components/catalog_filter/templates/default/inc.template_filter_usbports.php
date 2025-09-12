<div class="filter_field_block">
    <div class="filter_field_block__title">USB<span
                v-if="filterSelectedRangeUSB_min > filterSelectedRangeUSB_min_start || filterSelectedRangeUSB_max < filterSelectedRangeUSB_max_start"
                @click="clicked_button_clear_filter_field_block('filterSelectedRangeUSB')"
                class="button_clear_filter_field_block">x</span></div>
        <div class="columns is-gapless is-multiline">
            <div class="column is-12">
            <div class="filter_field_block__input_range_wrapper">
                <input class="filter_field_block__input_range"
                       v-model="filterSelectedRangeUSB_min" type="text" id="USB_min">
                <input class="filter_field_block__input_range right"
                       v-model="filterSelectedRangeUSB_max" type="text" id="USB_max">
                <div style="clear: both;height: 1px"></div>
                <div class="range-slider" id="USB-slider"
                     data-min="0"
                     :data-max="filterSelectedRangeUSB_max_start">
                </div>
            </div>
        </div>
    </div>
</div>

