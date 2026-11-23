<div class="filter_field_block">
    <div class="columns is-gapless is-multiline solo p-1">
            <div class="column is-12-widescreen is-12-desktop is-12-tablet">
                <input class="SFP" @change="filterChanged" v-model="filterSelectedSFP" type="checkbox"
                       id="checkbox_sfp"
                       />
                <label for="checkbox_sfp">SFP</label>
            </div>
    </div>
</div>