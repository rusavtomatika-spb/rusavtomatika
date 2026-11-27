(function () {
    var root = document.querySelector('#app_vue_updater');
    if (!root) { return; }
    if (typeof Vue === 'undefined') {
        root.innerHTML = '<div style="padding:20px;color:#c00">Не загружен Vue.js (/updater/js/vue.js)</div>';
        return;
    }

    function parseReply(raw) {
        if (raw && typeof raw === 'object') { return raw; }
        var text = String(raw == null ? '' : raw).trim();
        if (!text) { return {}; }
        try { return JSON.parse(text); } catch (e) {}
        var s = text.indexOf('{'), e2 = text.lastIndexOf('}');
        if (s !== -1 && e2 > s) {
            try { return JSON.parse(text.slice(s, e2 + 1)); } catch (e) {}
        }
        return { reply: '__bad_response__', raw: text };
    }

    function xhrPost(url, payload) {
        return new Promise(function (resolve, reject) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', url, true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState !== 4) { return; }
                if (xhr.status < 200 || xhr.status >= 300) {
                    reject(new Error('HTTP ' + xhr.status + ' ' + xhr.statusText + '\n' + xhr.responseText));
                    return;
                }
                resolve(parseReply(xhr.responseText));
            };
            xhr.onerror = function () { reject(new Error('Network error')); };
            xhr.send(JSON.stringify(payload));
        });
    }

    window.app_updater = new Vue({
        el: '#app_vue_updater',
        data: {
            self_ajax_url: '/updater/ajax_updater.php',
            source_ajax_url: 'https://www.rusavto.moisait.net/updater_source/ajax_updater_source.php?indexindex',
            destination_ajax_url: '/updater/ajax/ajax_updater_destination.php',

            loading_status: false,
            panel_loading: false,
            panel_settings: false,

            start_updating_all: 0,
            current_step_files: 0,
            current_step_database: 0,

            self_list_of_files: {},
            ajax_reply: {},
            ajax_reply_message: '',

            mess_strings: {
                dest_list_of_files_is_created: 'Список файлов сайта создан',
                dest_list_of_files_is_saved_on_source: 'Список файлов сайта сохранён на источнике',
                source_list_of_files_is_created_on_source: 'Список файлов источника создан',
                difference_list_of_files_is_created_on_source: 'Список отличий файлов создан',
                zip_file_is_created_on_source: 'Zip-архив отличий создан на источнике',
                zip_file_is_downloaded: 'Zip-архив скачан',
                zip_file_is_extracted: 'Zip-архив распакован',
                sql_backup_is_created: 'SQL-бэкап базы создан на источнике',
                sql_backup_is_downloaded: 'SQL-бэкап скачан',
                database_is_updated: 'База данных обновлена',
                settings_is_saved: 'Настройки сохранены',
                take_settings: ''
            },

            database_host: '',
            database_name: '',
            database_user: '',
            database_password: '',
            updater_password1: '',
            updater_password2: '',
            updater_password_new: '',
            updater_password: '',

            disable_edit_settings_button: false,
            disable_settings_editing: true,
            disable_save_settings_button: true,
            disable_cancel_settings_button: true,

            progress_bar_max_value: 70,
            progress_bar_value: 0
        },

        watch: {
            start_updating_all: function (val) {
                if (val === 2) {
                    this.start_updating_all = 0;
                    this.send(this.source_ajax_url, 'update_database_create_sql_dump', {});
                }
            },

            ajax_reply: function (val) {
                if (!val || typeof val.reply === 'undefined') { return; }

                var reply = val.reply;
                var label = this.mess_strings[reply];

                if (reply === '__bad_response__') {
                    this.append('<b>Сервер вернул не JSON:</b><pre style="white-space:pre-wrap;font-size:11px">'
                        + this.escape(val.raw) + '</pre><hr>');
                    this.enable_buttons_submit();
                    return;
                }

                if (reply === 'take_settings') {
                    this.applySettings(val);
                    return;
                }

                if (typeof label === 'undefined') {
                    this.append('<b>Неизвестный ответ сервера:</b> ' + this.escape(reply) + '<hr>');
                    this.enable_buttons_submit();
                    return;
                }

                switch (reply) {
                    case 'dest_list_of_files_is_created':
                        this.step(10, label);
                        this.send(this.source_ajax_url, 'take_dest_list_of_files', val.files);
                        break;

                    case 'dest_list_of_files_is_saved_on_source':
                        this.step(10, label);
                        this.send(this.source_ajax_url, 'create_source_list_of_files', {});
                        break;

                    case 'source_list_of_files_is_created_on_source':
                        this.step(10, label);
                        this.send(this.source_ajax_url, 'create_difference_list_of_files', {});
                        break;

                    case 'difference_list_of_files_is_created_on_source':
                        this.progress_bar_value += 10;
                        this.append(label + ' ' + this.escape(val.data) + '<br>');
                        if (Number(val.counter) > 0) {
                            this.send(this.source_ajax_url, 'create_zip_list_of_files', {});
                        } else {
                            this.append('<b>Обновлений файлов нет — всё актуально.</b><hr>');
                            if (this.start_updating_all === 1) {
                                this.progress_bar_value += 30;
                                this.start_updating_all = 2;
                            } else {
                                this.progress_bar_value += 40;
                                this.enable_buttons_submit();
                            }
                        }
                        break;

                    case 'zip_file_is_created_on_source':
                        this.progress_bar_value += 10;
                        this.append(label + ' ' + this.escape(this.dig(val, ['data', 'link'])) + '<br>');
                        this.send(this.destination_ajax_url, 'download_zip_from_source', {
                            link: this.dig(val, ['data', 'link'])
                        });
                        break;

                    case 'zip_file_is_downloaded':
                        this.progress_bar_value += 10;
                        this.append(label + ' ' + this.escape(val.buffer) + '<br>');
                        this.send(this.destination_ajax_url, 'extract_zip_list_of_files', {});
                        break;

                    case 'zip_file_is_extracted':
                        this.progress_bar_value += 10;
                        this.append(label + '<br>' + this.escape(val.buffer) + '<br>');
                        if (this.start_updating_all === 1) {
                            this.start_updating_all = 2;
                        } else {
                            this.progress_bar_value = this.progress_bar_max_value;
                            this.enable_buttons_submit();
                        }
                        break;

                    case 'sql_backup_is_created':
                        this.progress_bar_value += 10;
                        this.append(label + '<br>' + this.escape(this.dig(val, ['data', 'link'])) + '<br>');
                        this.send(this.destination_ajax_url, 'download_sql_backup', {
                            link: this.dig(val, ['data', 'link'])
                        });
                        break;

                    case 'sql_backup_is_downloaded':
                        this.progress_bar_value += 10;
                        this.append(label + '<br>' + this.escape(val.buffer) + '<br>');
                        this.send(this.destination_ajax_url, 'update_database', {});
                        break;

                    case 'database_is_updated':
                        this.progress_bar_value = this.progress_bar_max_value;
                        this.append(label + '<hr>' + this.escape(val.buffer) + '<br>');
                        this.enable_buttons_submit();
                        break;

                    case 'settings_is_saved':
                        this.append(label + '<hr>');
                        this.send(this.destination_ajax_url, 'read_settings', {});
                        break;

                    default:
                        this.append(label + '<hr>');
                        this.enable_buttons_submit();
                        break;
                }
            }
        },

        mounted: function () {
            var self = this;
            this.$nextTick(function () { self.init(); });
        },

        methods: {
            init: function () {
                this.enable_buttons_submit();
            },

            append: function (html) {
                this.ajax_reply_message += html;
            },

            step: function (delta, label) {
                this.progress_bar_value += delta;
                this.append(label + '<br>');
            },

            escape: function (v) {
                if (v == null) { return ''; }
                return String(v)
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;');
            },

            dig: function (obj, path) {
                var cur = obj;
                for (var i = 0; i < path.length; i++) {
                    if (cur == null || typeof cur !== 'object') { return ''; }
                    cur = cur[path[i]];
                }
                return cur == null ? '' : cur;
            },

            applySettings: function (val) {
                var s = val.settings || {};
                var db = s.database_server || {};
                this.updater_password1 = '';
                this.updater_password2 = '';
                this.database_host = db.database_host || '';
                this.database_name = db.database_name || '';
                this.database_user = db.database_user || '';
                this.database_password = db.database_password || '';
                this.updater_password = s.updater_password || '';
            },

            button_settings_clicked: function () {
                this.panel_settings = !this.panel_settings;
                if (this.panel_settings) {
                    this.send(this.destination_ajax_url, 'read_settings', {});
                }
            },

            button_edit_settings_clicked: function () {
                this.disable_edit_settings_button = true;
                this.disable_settings_editing = false;
                this.disable_save_settings_button = false;
                this.disable_cancel_settings_button = false;
            },

            button_save_settings_clicked: function () {
                this.lockSettings();
                this.updater_password_new =
                    (this.updater_password1 !== '' && this.updater_password1 === this.updater_password2)
                        ? this.updater_password1
                        : '';

                this.send(this.destination_ajax_url, 'save_settings', {
                    settings: {
                        database_server: {
                            database_host: this.database_host,
                            database_name: this.database_name,
                            database_user: this.database_user,
                            database_password: this.database_password
                        },
                        updater_password_new: this.updater_password_new
                    }
                });
            },

            button_cancel_settings_clicked: function () {
                this.lockSettings();
                this.send(this.destination_ajax_url, 'read_settings', {});
            },

            lockSettings: function () {
                this.disable_edit_settings_button = false;
                this.disable_settings_editing = true;
                this.disable_save_settings_button = true;
                this.disable_cancel_settings_button = true;
            },

            enable_buttons_submit: function () {
                this.setButtonsDisabled(false);
            },

            disable_buttons_submit: function () {
                this.setButtonsDisabled(true);
            },

            setButtonsDisabled: function (flag) {
                var list = document.querySelectorAll('#app_vue_updater .button_submit');
                for (var i = 0; i < list.length; i++) { list[i].disabled = flag; }
            },

            startRun: function (maxValue, updatingAll, action) {
                this.progress_bar_value = 0;
                this.progress_bar_max_value = maxValue;
                this.start_updating_all = updatingAll;
                this.disable_buttons_submit();
                this.ajax_reply_message = '';
                this.send(this.destination_ajax_url, action, {});
            },

            button_update_all_clicked: function () {
                this.startRun(100, 1, 'create_self_list_of_files');
            },

            button_update_files_clicked: function () {
                this.startRun(80, 0, 'create_self_list_of_files');
            },

            button_update_hta_clicked: function () {
                this.startRun(80, 0, 'create_self_list_of_files_hta');
            },

            button_update_down_clicked: function () {
                this.startRun(80, 0, 'create_self_list_of_files_down');
            },

            button_update_database_clicked: function () {
                this.progress_bar_value = 0;
                this.progress_bar_max_value = 30;
                this.start_updating_all = 0;
                this.disable_buttons_submit();
                this.ajax_reply_message = '';
                this.send(this.source_ajax_url, 'update_database_create_sql_dump', {});
            },

            get_list_of_local_files: function () {
                this.send(this.destination_ajax_url, 'create_self_list_of_files', {});
            },

            send: function (url, action, data) {
                var self = this;
                this.panel_loading = true;
                this.loading_status = true;

                return xhrPost(url, { action: action, data: data || {} })
                    .then(function (reply) {
                        self.panel_loading = false;
                        self.loading_status = false;
                        self.ajax_reply = {};
                        self.$nextTick(function () { self.ajax_reply = reply; });
                    })
                    .catch(function (err) {
                        self.panel_loading = false;
                        self.loading_status = false;
                        self.append('<b>Ошибка запроса:</b> ' + self.escape(url)
                            + '<pre style="white-space:pre-wrap;font-size:11px">'
                            + self.escape(err.message) + '</pre><hr>');
                        self.enable_buttons_submit();
                        console.error('updater error:', err);
                    });
            },

            getCookie: function (name) {
                var matches = document.cookie.match(new RegExp(
                    '(?:^|; )' + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + '=([^;]*)'
                ));
                return matches ? decodeURIComponent(matches[1]) : undefined;
            },

            setCookie: function (name, value, options) {
                options = options || {};
                options.path = options.path || '/';
                options.samesite = options.samesite || 'lax';
                if (options.expires instanceof Date) {
                    options.expires = options.expires.toUTCString();
                }
                var cookie = encodeURIComponent(name) + '=' + encodeURIComponent(value);
                for (var key in options) {
                    if (!Object.prototype.hasOwnProperty.call(options, key)) { continue; }
                    cookie += '; ' + key;
                    if (options[key] !== true) { cookie += '=' + options[key]; }
                }
                document.cookie = cookie;
            },

            deleteCookie: function (name) {
                this.setCookie(name, '', { 'max-age': -1 });
            }
        }
    });
})();