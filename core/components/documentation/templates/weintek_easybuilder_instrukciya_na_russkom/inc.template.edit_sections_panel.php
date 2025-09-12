<div id="admin_panel" v-cloak>
    <?php
    if ($edit_mode) {
        ?>
        <div v-if="edit_sections_panel_show" class="edit_panel">
            <button class="close_button" @click="edit_close_sections_button__clicked">X</button>
            <div class="edit_panel_item buttons">
                <span>�������������� ��������</span>
                <button @click="add_section_button__clicked()">&nbsp; +++ �������� ������ +++ &nbsp;</button>
                <button @click="edit_save_and_close_sections_button__clicked(current_edit_item.id)">&nbsp;��������� � �������&nbsp;</button>
            </div>
            <div v-for="(item, index) in arr_menu_items" :key="index">
                <div class="edit_panel_item name_wrap">
                    <span style="width: 4%;flex: none;">{{item.id}} </span>
                    <input type="text" v-model="item.name">
                    <input type="text" v-model="item.url">
                    <input style="width: 5%;flex: none;" type="text" v-model="item.position" placeholder="�������">
                    <input style="width: 5%;flex: none;" type="text" v-model="item.parent_id" placeholder="id ������������� �������">


                    <select style="width: 6%;flex: none;" v-model="item.type">
                        <option>link</option>
                        <option>anchor</option>
                    </select>
                    <select style="width: 3%;flex: none;" v-model="item.active">
                        <option> 1 </option>
                        <option> 0 </option>
                    </select>
                    <span></span>
                    <button @click="delete_section_button__clicked(item.id, item.name, index)"> x </button>
                </div>
                <div v-for="(subitem, index) in item.subitems" :key="index">
                    <div class="edit_panel_item name_wrap">
                        <span style="width: 4%;flex: none;"> </span>
                        <span style="width: 4%;flex: none;">{{subitem.id}} </span>
                        <input type="text" v-model="subitem.name">
                        <input type="text" v-model="subitem.url">
                        <input style="width: 5%;flex: none;" type="text" v-model="subitem.position"  placeholder="�������">
                        <input style="width: 5%;flex: none;" type="text" v-model="subitem.parent_id"  placeholder="id ������������� �������">

                        <select style="width: 6%;flex: none;" v-model="subitem.type">
                            <option>link</option>
                            <option>anchor</option>
                        </select>
                        <select style="width: 3%;flex: none;" v-model="item.active">
                            <option> 1 </option>
                            <option> 0 </option>
                        </select>
                        <span></span>
                        <button @click="delete_section_button__clicked(subitem.id,subitem.name, index)"> x </button>
                    </div>
                </div>
            </div>
            <div class="edit_panel_item buttons">
                <span>�������������� ������</span>
                <button @click="edit_restore_sections_button__clicked(current_edit_item.id)">������������
                </button>

                <button @click="edit_save_and_close_sections_button__clicked(current_edit_item.id)">
                    ��������� � �������
                </button>
                <button @click="edit_close_sections_button__clicked">������� ��� ����������</button>
            </div>
            <div v-if="showing_popup_message" class="popup_message">{{text_popup_message}}</div>
        </div>
        <div v-if="showing_delete_section_confirm_message" class="popup_confirm_message">
            <div v-html="text_delete_confirm"></div>
            <button class="button_yes" @click="delete_section">�������!</button>
            <button class="button_no" @click="showing_delete_section_confirm_message = false">��������</button>
        </div>
        <div v-if="showing_confirm_message_delete_file" class="popup_confirm_message">
            <div v-html="text_delete_confirm"></div>
            <button class="button_yes" @click="delete_image_file">�������</button>
            <button class="button_no" @click="showing_confirm_message_delete_file = false">��������</button>
        </div>
        <?php
    }  ?>
</div>