<div class="filter_field_block">
    <div class="filter_field_block__title">Тип сенсора <span v-if="filterSelectedSensorType !=''"
                                                         @click="clicked_button_clear_filter_field_block('filterSelectedSensorType')"
                                                         class="button_clear_filter_field_block">x</span>
    </div>
    <div class="columns is-gapless is-multiline">
            <div class="column is-6-widescreen is-12-desktop is-12-tablet is-hidden">
                <input @change="filterChanged" type="radio" id="sensor_type_one" value="" v-model="filterSelectedSensorType">
                <label for="sensor_type_one">Неважно</label>
            </div>
            <div class="column is-6-widescreen is-12-desktop is-12-tablet">
                <input @change="filterChanged" type="radio" id="sensor_type_three" value="capacitive" v-model="filterSelectedSensorType">
                <label for="sensor_type_three">Ёмкостный</label>
            </div>
            <div class="column is-6-widescreen is-12-desktop is-12-tablet">
                <input @change="filterChanged" type="radio" id="sensor_type_two" value="resistive" v-model="filterSelectedSensorType">
                <label for="sensor_type_two">Резистивный</label>
            </div>
    </div>
</div>