<?php
$current_folder_url = str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__);
CoreApplication::add_style($current_folder_url . "/style.css");
CoreApplication::add_script($current_folder_url . "/scripts.js");

include "inc.functions.php";
include "inc.result_modifier.php";

global $TITLE;
global $DESCRIPTION;
global $H1;
$TITLE = "EasyBuilder �� ������� ����������� ������������ | Weintek EasyBuilderPro V6.01.02";
$DESCRIPTION ="������� � ����������� ����� ����������� ������������ EasyBuilderPro. ����� ������������ ����� ����� ���������� ����������� � ���� �������.";
$H1 ="����������� ������������ EasyBuilderPro V6.01.02 �� ������� �����";
CoreApplication::add_breadcrumbs_chain("����������� ������������ EasyBuilderPro", "/weintek-easybuilder-instrukciya-na-russkom/");
?>

<div id="component_ebpro_instruction_rus">
    <div class="component_ebpro_instruction_rus_wrapper">
        <div class="component_ebpro_instruction_rus_menu">
            <? include "inc.template.menu.php";?>
        </div>
        <div class="component_ebpro_instruction_rus_text">
        </div>
    </div>
</div>


<style>
    [v-cloak] {
        display: none;
    }
</style>
