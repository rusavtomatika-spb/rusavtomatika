<div class="filter_field_block borderless">
    <div class="columns is-gapless is-multiline p-1">
            <div class="column is-12-widescreen is-12-desktop is-12-tablet">
                <input class="codesys" @change="filterChanged" v-model="filterSelectedVesa" type="checkbox"
                       id="checkbox_vesa"
                       />
                <label for="checkbox_vesa">Крепление VESA</label>
            </div>
    </div>
</div>