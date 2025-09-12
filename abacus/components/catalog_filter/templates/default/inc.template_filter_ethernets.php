<div class="filter_field_block">
    <div class="filter_field_block__title">Ethernet<span
                v-if="filterSelectedRangeEthernets_min > filterSelectedRangeEthernets_min_start || filterSelectedRangeEthernets_max < filterSelectedRangeEthernets_max_start"
                @click="clicked_button_clear_filter_field_block('filterSelectedRangeEthernets')"
                class="button_clear_filter_field_block">x</span></div>
        <div class="columns is-gapless is-multiline">
            <div class="column is-12">
            <div class="filter_field_block__input_range_wrapper">
                <input class="filter_field_block__input_range"
                       v-model="filterSelectedRangeEthernets_min" type="text" id="Ethernets_min">
                <input class="filter_field_block__input_range right"
                       v-model="filterSelectedRangeEthernets_max" type="text" id="Ethernets_max">
                <div style="clear: both;height: 1px"></div>
                <div class="range-slider" id="Ethernets-slider"
                     data-min="0"
                     :data-max="filterSelectedRangeEthernets_max_start">
                </div>
            </div>
        </div>
    </div>
</div>

