<div class="filter_field_block borderless pb-1 pt-1">
    <div class="columns is-gapless is-multiline">
            <div class="column is-12-widescreen is-12-desktop is-12-tablet">
                <input class="codesys" @change="filterChanged" v-model="filterSelectedCmtviewer" type="checkbox"
                       id="checkbox_cmtviewer"
                       />&nbsp;
                <label for="checkbox_cmtviewer">Поддержка CMT Viewer</label>
            </div>
    </div>
</div>
