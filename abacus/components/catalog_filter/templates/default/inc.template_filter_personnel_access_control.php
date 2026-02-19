<?php
?>
<div class="filter_field_block borderless pb-1 pt-1">
    <div class="columns is-gapless is-multiline">
        <div class="column is-12-widescreen is-12-desktop is-12-tablet">
            <input type="checkbox" 
                   id="checkbox_personnel_access_control" 
                   value="personnel_access_control"
                   @change="filterChanged" 
                   v-model="filterSelectedInterfaces"
                   class="personnel_access_control"/>&nbsp;
            <label for="checkbox_personnel_access_control">Контроль доступа для персонала</label>
        </div>
    </div>
</div>