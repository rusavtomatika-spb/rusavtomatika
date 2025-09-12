<div class="filter_field_block borderless pb-1 pt-1">
    <div class="columns is-gapless is-multiline">
            <div class="column is-12-widescreen is-12-desktop is-12-tablet">
                <input class="webview" @change="filterChanged" v-model="filterSelectedWebView" type="checkbox"
                       id="checkbox_webview"
                       />&nbsp;
                <label for="checkbox_webview">Управление через браузер</label>
            </div>
    </div>
</div>
