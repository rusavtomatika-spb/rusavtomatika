<div class="filter_field_block">
    <div class="filter_field_block__title">�������� ������� <span v-if="filterSelected�ase_material !=''"
                                                         @click="clicked_button_clear_filter_field_block('filterSelected�ase_material')"
                                                         class="button_clear_filter_field_block">x</span>
    </div>
    <div class="columns is-gapless is-multiline">
        <div class="column is-12">
            <div>
                <input @change="filterChanged" type="radio" id="�ase_material_one" value="" v-model="filterSelected�ase_material">
                <label for="�ase_material_one">�������</label>
            </div>
            <div>
                <input @change="filterChanged" type="radio" id="�ase_material_two" value="plastic" v-model="filterSelected�ase_material">
                <label for="�ase_material_two">�������</label>
            </div>
            <div>
                <input @change="filterChanged" type="radio" id="�ase_material_three" value="aluminium" v-model="filterSelected�ase_material">
                <label for="�ase_material_three">��������</label>
            </div>
            <div>
                <input @change="filterChanged" type="radio" id="�ase_material_four" value="plastic+aluminium" v-model="filterSelected�ase_material">
                <label for="�ase_material_four">�������+��������</label>
            </div>

        </div>
    </div>
</div>
<?php
