<div class="filter_field_block">
    <div class="filter_field_block__title">Материал корпуса <span v-if="filterSelectedСase_material !=''"
                                                         @click="clicked_button_clear_filter_field_block('filterSelectedСase_material')"
                                                         class="button_clear_filter_field_block">x</span>
    </div>
    <div class="columns is-gapless is-multiline">
            <div class="is-hidden">
                <input @change="filterChanged" type="radio" id="Сase_material_one" value="" v-model="filterSelectedСase_material">
                <label for="Сase_material_one">Неважно</label>
            </div>
            <div class="column is-6">
                <input @change="filterChanged" type="radio" id="Сase_material_two" value="plastic" v-model="filterSelectedСase_material">
                <label for="Сase_material_two">Пластик</label>
            </div>
            <div class="column is-6">
                <input @change="filterChanged" type="radio" id="Сase_material_three" value="aluminium" v-model="filterSelectedСase_material">
                <label for="Сase_material_three">Алюминий</label>
            </div>
            <div class="column is-12">
                <input @change="filterChanged" type="radio" id="Сase_material_four" value="plasticmetal" v-model="filterSelectedСase_material">
                <label for="Сase_material_four">Пластик+Металл</label>
            </div>

    </div>
</div>