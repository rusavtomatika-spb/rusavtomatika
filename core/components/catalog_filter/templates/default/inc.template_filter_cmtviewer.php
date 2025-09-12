<div class="filter_field_block">
    <div class="filter_field_block__title">Отображение на ПК и моб. устройствах <span v-if="filterSelectedCmtviewer.length"
                                                    @click="clicked_button_clear_filter_field_block('filterSelectedCmtviewer')"
                                                    class="button_clear_filter_field_block">x</span>
    </div>
    <div class="columns is-gapless is-multiline">
            <div class="column is-12-widescreen is-12-desktop is-12-tablet">
                <input class="codesys" @change="filterChanged" v-model="filterSelectedCmtviewer" type="checkbox"
                       id="checkbox_cmtviewer"
                       />&nbsp;
                <label for="checkbox_cmtviewer">Поддержка CMT Viewer</label>
            </div>
    </div>
</div>
