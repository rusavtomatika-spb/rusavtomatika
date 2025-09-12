<div class="filter_field_block">
    <div class="filter_field_block__title">SD-карта памяти <span v-if="filterSelectedSdcard.length"
                                                    @click="clicked_button_clear_filter_field_block('filterSelectedSdcard')"
                                                    class="button_clear_filter_field_block">x</span>
    </div>
    <div class="columns is-gapless is-multiline">
            <div class="column is-12-widescreen is-12-desktop is-12-tablet">
                <input class="codesys" @change="filterChanged" v-model="filterSelectedSdcard" type="checkbox"
                       id="checkbox_sdcard"
                       />&nbsp;
                <label for="checkbox_sdcard">Есть SD-карта</label>
            </div>
    </div>
</div>
