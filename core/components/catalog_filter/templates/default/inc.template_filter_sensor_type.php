<div class="filter_field_block">
    <div class="filter_field_block__title">��� ������� <span v-if="filterSelectedSensorType !=''"
                                                         @click="clicked_button_clear_filter_field_block('filterSelectedSensorType')"
                                                         class="button_clear_filter_field_block">x</span>
    </div>
    <div class="columns is-gapless is-multiline">
        <div class="column is-12">
            <div>
                <input @change="filterChanged" type="radio" id="sensor_type_one" value="" v-model="filterSelectedSensorType">
                <label for="sensor_type_one">�������</label>
            </div>
            <div>
                <input @change="filterChanged" type="radio" id="sensor_type_two" value="resistive" v-model="filterSelectedSensorType">
                <label for="sensor_type_two">�����������</label>
            </div>
            <div>
                <input @change="filterChanged" type="radio" id="sensor_type_three" value="capacitive" v-model="filterSelectedSensorType">
                <label for="sensor_type_three">���������</label>
            </div>
        </div>
    </div>
</div>
<?php
