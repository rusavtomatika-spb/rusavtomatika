<?php

$current_folder_url = str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__);
CoreApplication::add_style($current_folder_url . "/style.css");
CoreApplication::add_script($current_folder_url . "/scripts.js");
include "inc.functions.php";
include "inc.result_modifier.php";
//var_dump_pre($arguments);
global $TITLE;
global $DESCRIPTION;
global $H1;
$TITLE = "EasyBuilder �� ������� ����������� ������������ | Weintek EasyBuilderPro V6.01.02";
$DESCRIPTION = "������� � ����������� ����� ����������� ������������ EasyBuilderPro. ����� ������������ ����� ����� ���������� ����������� � ���� �������.";
$H1 = "����������� ������������ EasyBuilderPro V6.01.02 �� ������� �����";
CoreApplication::add_breadcrumbs_chain("����������� ������������ EasyBuilderPro", "/weintek-easybuilder-instrukciya-na-russkom/");
if (isset($_COOKIE["edit_mode"]) && $_COOKIE["edit_mode"] == '1') $edit_mode = true; else $edit_mode = false;

$current_article = get_content($arguments["route_string"]);


if($current_article["title"] != ""){
    $TITLE = $current_article["title"]." EasyBuilder �� ������� ����������� ������������ | Weintek EasyBuilderPro V6.01.02";
}
if($current_article["description"] != ""){
    $DESCRIPTION = $current_article["description"];
}
if($current_article["name"] != ""){
    $H1 = $current_article["name"];
}

?>
<style>
    [v-cloak] {
        display: none;
    }
</style>
<script src="/js/tinymce/tinymce.min.js"></script>
<div class="component_ebpro_instruction_rus_title">����������� ������������ EasyBuilderPro V6.01.02
    �� ������� �����</div>

<div id="vue_app_articles" v-cloak>
    <?
    if ($_SERVER["HTTP_HOST"] == "www.rusavto.moisait.net"){
        include "inc.template.edit_panel.php";
        include "inc.template.edit_sections_panel.php";
    }
    ?>
    <div id="component_ebpro_instruction_rus">
        <p style="background: #f0f0f0;padding: 20px;">
            ������������ ��� <b>��������� ������� � ����������� �����</b> "����������� ������������ EasyBuilderPro". ����� ������������ ����� ����� ���������� ����������� � ���� �������.
            ������������ �������� �� ���������� ����� �� ������ ����� ��� : <a href="/weintek-easybuilderpro-user-manual-en/">Manual EasyBuilderPro (En)</a>
        </p>
        <div class="component_ebpro_instruction_rus_wrapper">
            <div class="component_ebpro_instruction_rus_menu">
                <div class="block_floating">
                    <? include "inc.template.menu.php"; ?>
                </div>
            </div>
            <div class="component_ebpro_instruction_rus_text">
                <h1><?=$H1?></h1>
                <article>
                    <?
                    echo $current_article["text"];
                    ?>
                </article>
                <div class="data-for-vue">
                    <div field-name="id" field-value="<?= $current_article["id"] ?>"></div>
                    <div field-name="name" field-value="<?= $current_article["name"] ?>"></div>
                    <div field-name="title" field-value="<?= $current_article["title"] ?>"></div>
                    <div field-name="description" field-value="<?= $current_article["description"] ?>"></div>
                    <div field-name="url" field-value="<?= $current_article["url"] ?>"></div>
                    <div field-name="active" field-value="<?= $current_article["active"] ?>"></div>
                    <div field-name="section_id" field-value="<?= $current_article["section_id"] ?>"></div>
                    <?if(count($current_article["images"])>0){?>
                    <div field-name="images" field-value="<?= implode(",",$current_article["images"]) ?>"></div>
                    <?
                    }else{
                        ?><div field-name="images" field-value=""></div><?
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>



























