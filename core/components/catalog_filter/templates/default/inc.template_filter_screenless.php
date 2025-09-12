<div class="filter_field_block">
    <div class="filter_field_block__title">Наличие экрана <span v-if="filterSelectedScreenless.length"
                                                                                      @click="clicked_button_clear_filter_field_block('filterSelectedScreenless')"
                                                                                      class="button_clear_filter_field_block">x</span>
    </div>
    <div class="columns is-gapless is-multiline">
        <div class="column is-12-widescreen is-12-desktop is-12-tablet">
            <input class="screenless" @change="filterChanged" v-model="filterSelectedScreenless" type="checkbox"
                   id="checkbox_screenless"
            />&nbsp;
            <label for="checkbox_screenless">Безэкранные</label>
        </div>
    </div>
</div>
