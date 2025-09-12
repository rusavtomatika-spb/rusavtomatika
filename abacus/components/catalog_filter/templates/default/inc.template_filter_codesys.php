<div class="filter_field_block borderless pb-1 pt-1">
    <div class="columns is-gapless is-multiline">
            <div class="column is-12-widescreen is-12-desktop is-12-tablet">
                <input class="codesys" @change="filterChanged" v-model="filterSelectedCodesys" type="checkbox"
                       id="checkbox_codesys"
                       />&nbsp;
                <label for="checkbox_codesys">Поддержка Codesys</label>
            </div>
    </div>
</div>
