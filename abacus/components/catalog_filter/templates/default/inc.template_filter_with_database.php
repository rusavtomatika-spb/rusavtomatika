<?php
?>
<div class="filter_field_block borderless pb-1 pt-1">
    <div class="columns is-gapless is-multiline">
        <div class="column is-12-widescreen is-12-desktop is-12-tablet">
            <input type="checkbox" 
                   id="checkbox_with_database" 
                   value="with_database"
                   @change="filterChanged" 
                   v-model="filterSelectedInterfaces"
                   class="with_database"/>&nbsp;
            <label for="checkbox_with_database">Панель с базой данных на SQL-сервере</label>
        </div>
    </div>
</div>