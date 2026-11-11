<?php
?>
<div class="filter_field_block borderless">
    <div class="filter_field_block__title">
        ПЛК с управлением движением
        <span v-if="filterSelectedProcessors.length" @click="clicked_button_clear_filter_field_block('filterSelectedProcessors')" class="button_clear_filter_field_block">x</span>
    </div>
    <div class="columns is-gapless is-multiline">
        <div class="column is-12-widescreen is-12-desktop is-12-tablet">
            <input type="checkbox" 
                   id="checkbox_motion" 
                   value="motion"
                   @change="filterChanged" 
                   v-model="filterSelectedMotion"
                   class="motion"/>&nbsp;
            <label for="checkbox_motion">Да</label>
        </div>
    </div>
</div>