<?php
CoreApplication::add_script(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/script.js");
CoreApplication::add_style(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/style.css");
?>
<div class="component_form_require_price" style="display: none">
    <div class="component_form_require_price__form_wrapper">
        <div class="close_button">X</div>
        <div class="title">Запрос цены</div>
        <div class="text">
            <p><span class="text_target">Для уточнения цены</span> <b>&laquo;</b><b class="text_model"></b><b>&raquo;</b>, пожалуйста, введите Ваш мобильный номер, начиная с кода страны (например, для России — 7). Мы перезвоним Вам в течение 10 минут.</p>
            <p>Или напишите в чат в правом нижнем углу экрана.</p>
        </div>
        <form action="">
            <div class="form_elements">
               <span><span class="phone_symbol_plus">+</span><input class="input_phone" type="text" name="tel" placeholder="79998887766"></span>
                <input class="button is-success" type="submit" name="submit" value="позвоните мне">
            </div>

        </form>

    </div>
</div>
<script>

</script>


