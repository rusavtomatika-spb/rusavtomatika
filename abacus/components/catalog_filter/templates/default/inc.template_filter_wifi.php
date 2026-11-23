<?php
?>
<div class="filter_field_block borderless">
    <div class="columns is-gapless is-multiline p-1">
        <div class="column is-12-widescreen is-12-desktop is-12-tablet">
            <input type="checkbox" 
                   id="checkbox_wifi" 
                   value="wifi"
                   @change="filterChanged" 
                   v-model="filterSelectedInterfaces"
                   class="wifi"/>
            <label for="checkbox_wifi">Поддержка Wi-Fi</label>
        </div>
    </div>
</div>