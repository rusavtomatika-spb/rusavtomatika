<div class="filter_field_block">
    <div class="filter_field_block__title">������� <span v-if="filterSelectedAvailablity > 0"
                                                         @click="clicked_button_clear_filter_field_block('filterSelectedAvailablity')"
                                                         class="button_clear_filter_field_block">x</span>
    </div>
    <div class="columns is-gapless is-multiline">
        <div class="column is-12">
            <div>
                <input @change="filterChanged" type="radio" id="one" value="0" v-model="filterSelectedAvailablity">
                <label for="one">�������</label>
            </div>
            <div>
                <input @change="filterChanged" type="radio" id="two" value="1" v-model="filterSelectedAvailablity">
                <label for="two">� ������� �� ������</label>
            </div>
            <div>
                <input @change="filterChanged" type="radio" id="three" value="2" v-model="filterSelectedAvailablity">
                <label for="three">��� �����</label>
            </div>
        </div>
    </div>
</div>
<?php
