<div class="filter_field_block">
    <div class="filter_field_block__title">Поддержка Codesys <span v-if="filterSelectedCodesys.length"
                                                    @click="clicked_button_clear_filter_field_block('filterSelectedCodesys')"
                                                    class="button_clear_filter_field_block">x</span>
    </div>
    <div class="columns is-gapless is-multiline">
            <div class="column is-12-widescreen is-12-desktop is-12-tablet">
                <input class="codesys" @change="filterChanged" v-model="filterSelectedCodesys" type="checkbox"
                       id="checkbox_codesys"
                       />&nbsp;
                <label for="checkbox_codesys">Есть (опционально)</label>
            </div>
    </div>
</div>
