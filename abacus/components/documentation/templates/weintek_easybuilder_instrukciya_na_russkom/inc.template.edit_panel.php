<div id="admin_panel" v-cloak>
    <?php
    if ($edit_mode) {
        ?>
        <div class="switch_edit_mode__wrapper">
            <div>
                <span>Режим редактирования включен</span>
                <button class="switch_edit_mode__button active" @click="switch_edit_mode__button_clicked">
                    Выключить
                </button>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <button class="button_edit_item active" @click="edit_sections_button__clicked()">
                    &equiv; Редактировать разделы
                </button>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <button class="button_edit_item active" @click="edit_element_button__clicked()">
                    &#9998; Редактировать статью
                </button>
            </div>
        </div>
        <div v-if="edit_panel_show" class="edit_panel">
            <button class="close_button" @click="edit_close_element_button__clicked">X</button>
            <input type="hidden" :value="current_edit_item.id">
            <div class="edit_panel_item buttons">
                <span>Редактирование статьи</span>

                <button @click="edit_save_and_close_element_button__clicked()">
                    Сохранить и закрыть
                </button>

            </div>
            <div class="edit_panel_item name_wrap"><span>Наименование (H1)</span>
                <input type="text" v-model="current_edit_item.name">
            </div>
            <div class="edit_panel_item sys_name_wrap"><span>Код (для url)</span>
                <input type="text" v-model="current_edit_item.url">
            </div>

            <div class="edit_panel_item title_cat_wrap"><span>Title</span>
                <input type="text" v-model="current_edit_item.title">
            </div>
            <div class="edit_panel_item description_wrap"><span>Description</span>
                <input type="text"
                       v-model="current_edit_item.description">
            </div>
            <div class="edit_panel_item btext_wrap"><span>Текст</span>
                <textarea
                    v-model="current_edit_item.text" name="" id="mytextarea" cols="30"
                    rows="10"></textarea>

            </div>


            <div class="edit_panel_item">
                <span>Доп. Изображения</span>
                <div style="width: 100%;box-shadow: 0 0 5px rgba(0,0,0,0.5) inset;">
                            <span class="edit_panel_item__more_images"
                                  v-for="(image_item, image_index) in current_edit_item.images">
                            <img style="height:40px" :src="image_item">
                                <span>{{image_item}}</span>
                                <button class="button_delete red" @click="show_popup_delete_confirm_file(image_item)">Удалить</button>
                            </span>

                </div>
                <div style="padding: 10px;">
                    <div>
                        <span>[*.jpg, *.png]</span>
                        <input type="file" accept="image/jpeg,image/png" id="image_file2" ref="file2"
                               v-on:change="handleFileUpload()"/>
                    </div>
                </div>
                <div style="padding: 10px;">
                    <button v-on:click="submitFile(current_edit_item.id,'details')">Загрузить</button>
                </div>
            </div>


            <div class="edit_panel_item buttons">
                <span>Редактирование статьи</span>
                <button @click="edit_save_and_close_element_button__clicked(current_edit_item.id)">
                    Сохранить и закрыть
                </button>
            </div>
            <div v-if="showing_popup_message" class="popup_message">{{text_popup_message}}</div>


        </div>
        <div v-if="showing_delete_confirm_message" class="popup_confirm_message">
            <div v-html="text_delete_confirm"></div>
            <button class="button_yes" @click="delete_element">Удалить</button>
            <button class="button_no" @click="showing_delete_confirm_message = false">Отменить</button>
        </div>
        <div v-if="showing_confirm_message_delete_file" class="popup_confirm_message">
            <div v-html="text_delete_confirm"></div>
            <button class="button_yes" @click="delete_image_file">Удалить</button>
            <button class="button_no" @click="showing_confirm_message_delete_file = false">Отменить</button>
        </div>
        <?php
    } else {
        ?>
        <div class="switch_edit_mode__wrapper">
            <div>
                <span>Режим редактирования выключен</span>
                <button class="switch_edit_mode__button" @click="switch_edit_mode__button_clicked">
                    Включить
                </button>
            </div>
            <div></div>
        </div>
    <?php } ?>
</div>