<?php
if($_COOKIE["edit_mode"] == '1'){
    ?>
    <div class="switch_edit_mode__wrapper">
    <button class="switch_edit_mode__button active" @click="switch_edit_mode__button_clicked">Выключить режим редактирования</button>
    </div>
    <?php
}else{
    ?>
    <div class="switch_edit_mode__wrapper">
    <button class="switch_edit_mode__button" @click="switch_edit_mode__button_clicked">Включить режим редактирования</button>
    </div>
    <?php
}
