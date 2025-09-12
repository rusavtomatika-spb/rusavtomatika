<div class="filter_field_block">
    <div class="filter_field_block__title">Материал корпуса <span v-if="filterSelectedСase_material !=''"
                                                         @click="clicked_button_clear_filter_field_block('filterSelectedСase_material')"
                                                         class="button_clear_filter_field_block">x</span>
    </div>
    <div class="columns is-gapless is-multiline">
        <div class="column is-12">
            <div>
                <input @change="filterChanged" type="radio" id="Сase_material_one" value="" v-model="filterSelectedСase_material">
                <label for="Сase_material_one">Неважно</label>
            </div>
            <div>
                <input @change="filterChanged" type="radio" id="Сase_material_two" value="plastic" v-model="filterSelectedСase_material">
                <label for="Сase_material_two">Пластик</label>
            </div>
            <div>
                <input @change="filterChanged" type="radio" id="Сase_material_three" value="aluminium" v-model="filterSelectedСase_material">
                <label for="Сase_material_three">Алюминий</label>
            </div>
            <div>
                <input @change="filterChanged" type="radio" id="Сase_material_four" value="plastic+aluminium" v-model="filterSelectedСase_material">
                <label for="Сase_material_four">Пластик+Алюминий</label>
            </div>

        </div>
    </div>
</div>
<?php
