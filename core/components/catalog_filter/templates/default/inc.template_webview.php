<div class="filter_field_block">
    <div class="filter_field_block__title">Управление панелью через веб-браузер <span v-if="filterSelectedWebView.length"
                                                    @click="clicked_button_clear_filter_field_block('filterSelectedWebView')"
                                                    class="button_clear_filter_field_block">x</span>
    </div>
    <div class="columns is-gapless is-multiline">
            <div class="column is-12-widescreen is-12-desktop is-12-tablet">
                <input class="webview" @change="filterChanged" v-model="filterSelectedWebView" type="checkbox"
                       id="checkbox_webview"
                       />&nbsp;
                <label for="checkbox_webview">Есть Webview</label>
            </div>
    </div>
</div>
