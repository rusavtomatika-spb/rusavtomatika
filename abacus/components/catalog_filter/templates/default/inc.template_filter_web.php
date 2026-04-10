<?php
?>
<div class="filter_field_block borderless pb-1 pt-1">
    <div class="columns is-gapless is-multiline">
        <div class="column is-12-widescreen is-12-desktop is-12-tablet">
            <input type="checkbox" 
                   id="checkbox_web" 
                   value="web"
                   @change="filterChanged" 
                   v-model="filterSelectedWeb"
                   class="web"/>&nbsp;
            <label for="checkbox_web">Web (W)</label>
        </div>
    </div>
</div>