<?php
?>
<div class="filter_field_block borderless pb-1 pt-1">
    <div class="columns is-gapless is-multiline">
        <div class="column is-12-widescreen is-12-desktop is-12-tablet">
            <input type="checkbox" 
                   id="checkbox_ai" 
                   value="ai"
                   @change="filterChanged" 
                   v-model="filterSelectedAi"
                   class="ai"/>&nbsp;
            <label for="checkbox_ai">С ИИ-ускорителем</label>
        </div>
    </div>
</div>