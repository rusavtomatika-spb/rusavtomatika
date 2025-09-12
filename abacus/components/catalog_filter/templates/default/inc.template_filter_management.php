<div class="filter_field_block">
    <div class="filter_field_block__title">Управление <span v-if="filterSelectedmanagement > 0"
                                                         @click="clicked_button_clear_filter_field_block('filterSelectedmanagement')"
                                                         class="button_clear_filter_field_block">x</span>
    </div>
    <div class="columns is-gapless is-multiline">
        <div class="column is-12">
            <div>
                <input @change="filterChanged" type="radio" id="man" value="2" v-model="filterSelectedmanagement">
                <label for="man">Управляемый</label>
            </div>
            <div>
                <input @change="filterChanged" type="radio" id="noman" value="1" v-model="filterSelectedmanagement">
                <label for="noman">Неуправляемый</label>
            </div>
            <div>
                <input @change="filterChanged" type="radio" id="noimp" value="0" v-model="filterSelectedmanagement">
                <label for="noimp">Неважно</label>
            </div>
        </div>
    </div>
</div>
<?php
