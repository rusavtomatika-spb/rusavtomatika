<?
global $arrSection;
?>
<div class="filter_field_block">
    <div class="filter_field_block__title">Диагональ экрана<span
                v-if="filterSelectedRangeDiagonal_min > filterSelectedRangeDiagonal_min_start || filterSelectedRangeDiagonal_max < filterSelectedRangeDiagonal_max_start "
                @click="clicked_button_clear_filter_field_block('filterSelectedRangeDiagonals')"
                class="button_clear_filter_field_block">x</span></div>
    <div class="columns is-gapless is-multiline">
        <div class="column is-12">
            <div class="filter_field_block__input_range_wrapper">
                <input class="filter_field_block__input_range"
                       v-model="filterSelectedRangeDiagonal_min" type="text" id="filter_diagonal_min">
                <input class="filter_field_block__input_range right"
                       v-model="filterSelectedRangeDiagonal_max" type="text" id="filter_diagonal_max">
                <div style="clear: both;height: 1px"></div>
                <div class="range-slider" id="diagonal-slider"
                     data-min="<?=$arrSection["filter_diagonal_min"]?>"
                     data-max="<?=$arrSection["filter_diagonal_max"]?>"></div>
            </div>
        </div>
    </div>
</div>

