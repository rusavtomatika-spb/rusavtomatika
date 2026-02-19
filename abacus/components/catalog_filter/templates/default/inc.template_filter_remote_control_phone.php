<?php
?>
<div class="filter_field_block borderless pb-1 pt-1">
    <div class="columns is-gapless is-multiline">
        <div class="column is-12-widescreen is-12-desktop is-12-tablet">
            <input type="checkbox" 
                   id="checkbox_remote_control_phone" 
                   value="remote_control_phone"
                   @change="filterChanged" 
                   v-model="filterSelectedInterfaces"
                   class="remote_control_phone"/>&nbsp;
            <label for="checkbox_remote_control_phone">Удаленное управление с телефона</label>
        </div>
    </div>
</div>