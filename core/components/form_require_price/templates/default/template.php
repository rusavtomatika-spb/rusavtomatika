<?php
CoreApplication::add_script(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/script.js");
CoreApplication::add_style(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/style.css");
?>
<div class="component_form_require_price" style="display: none">
    <div class="component_form_require_price__form_wrapper">
        <div class="close_button">X</div>
        <div class="title">������ ����</div>
        <div class="text">
            <p><span class="text_target">��� ��������� ����</span> <b>&laquo;</b><b class="text_model"></b><b>&raquo;</b>, ����������, ������� ��� ��������� �����, ������� � ���� ������ (��������, ��� ������ � 7). �� ���������� ��� � ������� 10 �����.</p>
            <p>��� �������� � ��� � ������ ������ ���� ������.</p>
        </div>
        <form action="">
            <div class="form_elements">
               <span><span class="phone_symbol_plus">+</span><input class="input_phone" type="text" name="tel" placeholder="79998887766"></span>
                <input class="button is-success" type="submit" name="submit" value="��������� ���">
            </div>

        </form>

    </div>
</div>
<script>

</script>


