<?php
?>
<div class="filter_field_block borderless">
    <div class="columns is-gapless is-multiline p-1">
        <div class="column is-12-widescreen is-12-desktop is-12-tablet">
            <input type="checkbox" 
                   id="checkbox_with_database" 
                   value="with_database"
                   @change="filterChanged" 
                   v-model="filterSelectedInterfaces"
                   class="with_database"/>
            <label for="checkbox_with_database">Панель с базой данных на SQL-сервере</label>
        </div>
    </div>
</div>