<?php include 'view/header.php'; ?>
<div class="wrap_all">
    <div id="app_vue_updater">
        <h1>Обновление сайта <a target="_blank"
                                href="<?= $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER['HTTP_HOST'] . "/" ?>"><?= $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER['HTTP_HOST'] . "/" ?></a>
        </h1>
        <input class="button_submit button_settings" @click="button_settings_clicked" type="submit" value="Настройки">
        <div class="panel">
            <div class="setting_item">
                <label>Источник обновлений:</label>
                <input type="text" v-model="source_ajax_url" placeholder="Введите адрес скрипта источника обновлений">
            </div>
            <progress class="progress_bar" :max="progress_bar_max_value" :value="progress_bar_value" v-show="progress_bar_value"></progress>
            <div class="setting_item">
                <input class="button_submit" @click="button_update_all_clicked" type="submit" value="Обновить все">
                <input class="button_submit button_update_database" @click="button_update_database_clicked" type="submit" value="Обновить базу">
                <input class="button_submit button_update_files" @click="button_update_files_clicked" type="submit" value="Обновить файлы">
            </div>
            <div class="panel_ajax_reply" v-html="ajax_reply_message"></div>
        </div>
        <div v-show="panel_loading" class="panel_loading"></div>
        <div v-show="panel_settings" class="panel_settings">
            <span @click="button_settings_clicked" class="panel_settings__close">X</span>
            <div class="panel_settings__wrap_inn">
                <div>
                    <b>Настройки соединения с БАЗОЙ ДАННЫХ</b>
                    <hr>
                    <div class="panel_settings__item"><label>Сервер:</label>
                        <input type="text" v-model="database_host" :disabled="disable_settings_editing">
                    </div>
                    <div class="panel_settings__item"><label>Имя DB:</label>
                        <input type="text" v-model="database_name" :disabled="disable_settings_editing">
                    </div>
                    <div class="panel_settings__item"><label>Пользователь:</label>
                        <input type="text" v-model="database_user" :disabled="disable_settings_editing">
                    </div>
                    <div class="panel_settings__item"><label>Пароль:</label>
                        <input type="text" v-model="database_password" :disabled="disable_settings_editing">
                    </div>
                </div>
            <div>
                    <b>Пароль на вход в Updater (сохранится MD5-шифрованием)</b>
                    <hr>
                    <div class="panel_settings__item"><label>Новый пароль:</label>
                        <input type="text" v-model="updater_password1" :disabled="disable_settings_editing" autocomplete="off">
                    </div>
                    <div class="panel_settings__item"><label>Повторите пароль:</label>
                        <input type="text" v-model="updater_password2" :disabled="disable_settings_editing" autocomplete="off">
                    </div>
                    <div class="panel_settings__item"><label>Сохраненный MD5 пароля:</label>
                        <input type="text" v-model="updater_password"  autocomplete="off">
                    </div>
            </div>
                    <div class="panel_settings__item">
                        <input class="button_submit button_update_files" @click="button_edit_settings_clicked" type="submit" value="Изменить" :disable="disable_edit_settings_button">
                        <input class="button_submit button_update_files" @click="button_save_settings_clicked" type="submit" value="Сохранить" :disable="disable_save_settings_button">
                        <input class="button_submit button_update_files" @click="button_cancel_settings_clicked" type="submit" value="Отмена" :disable="disable_cancel_settings_button">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'view/footer.php'; ?>
