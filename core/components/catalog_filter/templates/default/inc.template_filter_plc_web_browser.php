<div class="filter_field_block">
    <div class="filter_field_block__title">Подключение к веб-серверу ПЛК <span v-if="filterSelectedPlcWebBrowser.length"
                                                    @click="clicked_button_clear_filter_field_block('filterSelectedPlcWebBrowser')"
                                                    class="button_clear_filter_field_block">x</span>
    </div>
    <div class="columns is-gapless is-multiline">
            <div class="column is-12-widescreen is-12-desktop is-12-tablet">
                <input class="plc_web_browser" @change="filterChanged" v-model="filterSelectedPlcWebBrowser" type="checkbox"
                       id="checkbox_plc_web_browser"
                       />&nbsp;
                <label for="checkbox_plc_web_browser">Есть PLC Web-browser</label>
            </div>
    </div>
</div>
