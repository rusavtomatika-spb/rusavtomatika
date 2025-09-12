<div class="filter_field_block">
    <div class="filter_field_block__title">Крепление VESA <span v-if="filterSelectedVesa.length"
                                                    @click="clicked_button_clear_filter_field_block('filterSelectedVesa')"
                                                    class="button_clear_filter_field_block">x</span>
    </div>
    <div class="columns is-gapless is-multiline">
            <div class="column is-12-widescreen is-12-desktop is-12-tablet">
                <input class="codesys" @change="filterChanged" v-model="filterSelectedVesa" type="checkbox"
                       id="checkbox_vesa"
                       />&nbsp;
                <label for="checkbox_vesa">Есть крепление VESA</label>
            </div>
    </div>
</div>
