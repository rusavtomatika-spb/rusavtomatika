<div class="filter_field_block">
    <div class="filter_field_block__title">Подключение камеры <span
                v-if="filterSelectedCameraIP.length || filterSelectedCameraUSB.length"
                @click="clicked_button_clear_filter_field_block('filterSelectedCamera')"
                class="button_clear_filter_field_block">x</span>
    </div>
    <div class="columns is-gapless is-multiline">
        <div class="column is-gapless is-multiline is-full">
            <input class="CameraIP" @change="filterChanged" v-model="filterSelectedCameraIP" type="checkbox"
                   id="checkbox_CameraIP"
                   value="yes"/>&nbsp;
            <label for="checkbox_CameraIP">IP камера</label>
        </div>
        <div class="column is-gapless is-multiline is-full">
            <input class="CameraUSB" @change="filterChanged" v-model="filterSelectedCameraUSB" type="checkbox"
                   id="checkbox_CameraUSB"
                   value="yes"/>&nbsp;
            <label for="checkbox_CameraUSB">USB камера</label>
        </div>
    </div>
</div>
