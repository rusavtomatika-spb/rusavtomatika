<div class="filter_field_block borderless">
    <div class="columns is-gapless is-multiline p-1">
        <div class="column is-12-widescreen is-12-desktop is-12-tablet">
            <input class="screenless" @change="filterChanged" v-model="filterSelectedScreenless" type="checkbox"
                   id="checkbox_screenless"
            />
            <label for="checkbox_screenless">Безэкранные</label>
        </div>
    </div>
</div>
