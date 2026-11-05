<?php
?>
<div class="filter_field_block borderless">
    <div class="filter_field_block__title">
        ИИ-ускоритель
        <span v-if="filterSelectedProcessors.length" @click="clicked_button_clear_filter_field_block('filterSelectedProcessors')" class="button_clear_filter_field_block">x</span>
    </div>
    <div class="columns is-gapless is-multiline">
        <div class="column is-12-widescreen is-12-desktop is-12-tablet">
            <input type="checkbox" 
                   id="checkbox_ai" 
                   value="ai"
                   @change="filterChanged" 
                   v-model="filterSelectedAi"
                   class="ai"/>&nbsp;
            <label for="checkbox_ai">Да</label>
        </div>
    </div>
</div>