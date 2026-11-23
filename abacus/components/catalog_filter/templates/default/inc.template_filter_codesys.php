<div class="filter_field_block borderless">
    <div class="columns is-gapless is-multiline p-1">
            <div class="column is-12-widescreen is-12-desktop is-12-tablet">
                <input class="codesys" @change="filterChanged" v-model="filterSelectedCodesys" type="checkbox"
                       id="checkbox_codesys"
                       />
                <label for="checkbox_codesys">Поддержка Codesys</label>
            </div>
    </div>
</div>