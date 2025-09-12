<div class="filter_field_block">
    <div class="filter_field_block__title">Подключение камеры <span
                v-if="filterSelectedCameraIP.length || filterSelectedCameraUSB.length"
                @click="clicked_button_clear_filter_field_block('filterSelectedCamera')"
                class="button_clear_filter_field_block">x</span>
    </div>
    <div class="columns is-gapless is-multiline">
                    <div class="column is-6-widescreen is-12-desktop is-12-tablet">
            <input class="CameraIP" @change="filterChanged" v-model="filterSelectedCameraIP" type="checkbox"
                   id="checkbox_CameraIP"
                   value="yes"/>&nbsp;
            <label for="checkbox_CameraIP">IP</label>
        </div>
                    <div class="column is-6-widescreen is-12-desktop is-12-tablet">
            <input class="CameraUSB" @change="filterChanged" v-model="filterSelectedCameraUSB" type="checkbox"
                   id="checkbox_CameraUSB"
                   value="yes"/>&nbsp;
            <label for="checkbox_CameraUSB">USB</label>
        </div>
    </div>
</div>
