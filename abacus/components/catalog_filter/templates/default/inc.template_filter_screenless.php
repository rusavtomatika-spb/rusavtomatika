<div class="filter_field_block borderless pb-1 pt-1">
    <div class="columns is-gapless is-multiline">
        <div class="column is-12-widescreen is-12-desktop is-12-tablet">
            <input class="screenless" @change="filterChanged" v-model="filterSelectedScreenless" type="checkbox"
                   id="checkbox_screenless"
            />&nbsp;
            <label for="checkbox_screenless">Безэкранные</label>
        </div>
    </div>
</div>
