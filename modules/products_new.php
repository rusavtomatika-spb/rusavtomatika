<?php
//session_start();
//define("bullshit", 1);
include_once $_SERVER['DOCUMENT_ROOT'] . "/sc/dbcon.php";
include_once ($_SERVER['DOCUMENT_ROOT'] . "/sc/lib_new.php");
include_once ($_SERVER['DOCUMENT_ROOT'] . "/sc/lib_controllers.php");

$num = str_replace(".php", "", $var_array[$levels]);
$sql = "SELECT * FROM `controllers` WHERE `model` = '$num' and `show_in_cat` = '1' and `show_on_stock` = '1'";
$res = mysql_query($sql) or die(mysql_error());
$r = mysql_fetch_object($res);
$q = mysql_num_rows($res);
if ($q > 0) {
    ob_start();
    if ($r->h1) {
        $title = $r->h1;
    } else {
        $title = 'Modbus ������ �����-������ IECON ' . $r->model . ', ���������, �� ������ � ������ � �����-����������, �������� �� ������';
    }
    $TITLE = $title;
    ?>

    <div class="block_modules_content_wrapper catalog_element_default">

        <div class="block_modules_content">


            <div class="blockofcols_container">
                <div class="blockofcols_row">
                    <div class="col-12">

                        <nav><a href="/">�������</a>&nbsp;/&nbsp;<a href="/modules/">������ IECON</a>&nbsp;/&nbsp;<?= $title ?></nav>
                        <h1><?= $title ?></h1>
                        <div style="padding: 2rem;margin: 0px -35px 1.5rem;text-align: center;font-size: 2rem;background:#de6060;color: white;position: relative;z-index: 1">
                            <p>��������, ��������� ����� IECON �� �������� �� ����������.</p>
                            <p style="font-size: 1.9rem">���������� ��� ����������� ������� <a style="color: white" href="/plc/weintek/">��������� ������� Weintek</a>.</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <a data-fancybox="" data-caption="������ �����-������ IECON <?= $r->model ?>" href="<?= $r->picture_detail ?>">
                            <div class="catalog_element_default_picture_detail_wrap">
                                <div class="catalog_element_default_picture_detail" style="background-image: url(<?= $r->picture_detail ?>);"></div>
                            </div>
                        </a>
                    </div>
                    <div class="col-8" style="position: initial;">

                        <div class="catalog_element_default_property catalog_element_default_name  catalog_element_default_gray catalog_element_default_block_price">
                            <div class="blockofcols_container">
                                <div class="blockofcols_row">
                                    <div class="col-3">
                                        <span class="field_title">������: </span>
                                        <span class="field_value">IECON <?= $r->model ?></span>
                                    </div>
                                    <div class="col-3">
                                        <span class="field_title">���� � ���: </span>
                                        <span class="field_value">
                                            <? if ($r->retail_price > 0): ?>
                                                <span class="val_no_price"><?= $r->retail_price ?></span> ���
                                            <? else: ?>
                                                <span class="val_no_price">���� �� �������</span>
                                            <? endif; ?>
                                        </span>
                                    </div>
                                    <div class="col-3">
                                        <div>
                                            <span class="field_title">�������: </span>
                                            <span class="field_value">
                                                <span class="val_no_in_stock absent">��� �����</span>
                                            </span>
                                        </div>
                                    </div>
                                    <? if ($r->retail_price > 0): ?>
                                        <div class="but_wr"><div class="zakazbut addToCart" idm="<?= $r->model ?>"><span>� �������</span></div></div>
                                    <? else: ?>
                                        <div class="but_wr"><div class="zakazbut blocked"><span>� �������</span></div></div>
                                    <? endif; ?>



                                </div>
                            </div>
                        </div>



                        <div class="catalog_element_default_property catalog_element_default_buttons">
                            <div class="blockofcols_container">
                                <div class="blockofcols_row">
                                    <div style="display:none;width: 33%" class="col-5-5"><div class="but_wr"> <div class="zakazbut" idm="<?= $r->model ?>" onclick="show_compare(this)"><span>�&nbsp;���������</span></div></div></div>
                                    <div class="col-5-5" style="width: 50%"><div class="but_wr"><div class="zakazbut" idm="<?= $r->model ?>" onclick="show_backup_call(2, '<?= $r->model ?>')"><span>�����&nbsp;�&nbsp;1&nbsp;����</span></div></div></div>
                                    <div class="col-5-5" style="width: 50%"><div class="but_wr"><div class="zakazbut" idm="<?= $r->model ?>" onclick="show_backup_call(1, '<?= $r->model ?>')"><span>��������&nbsp;������</span></div> </div></div>
                                </div>
                            </div>
                        </div>
                        <div class="text_detail_short">
                            <?= $r->text_detail_short ?>
                        </div>
                    </div>
                    <div class="col-12"><br></div>
                    <pre><? // var_dump($r);                                          ?></pre>
                </div>
            </div>
            <div class="blockofcols_container">
                <div class="blockofcols_row">
                    <div class="col-12">
                        <div id="tabs">
                            <ul>
                                <li class="urlup" data="presentation"><a href="#tabs-1">��������</a></li>
                                <li class="urlup" data="functions"><a href="#tabs-5">����� �����������</a></li>
                                <li class="urlup" data="dimension"><a href="#tabs-3">��������</a></li>
                                <li class="urlup" data="software"><a href="#tabs-4">�������</a></li>
                            </ul>
                            <div id="tabs-1">
                                <h2>�������� IECON <?= $r->model ?></h2>
                                <div class="text_detail_long">
                                    <?= $r->text_detail_long ?>
                                </div>
                            </div>
                            <div id="tabs-5">
                                <h2>����� ����������� <?= $r->model ?></h2>
                                <div class="catalog_element_default_diagrams">
                                    <?= $r->scheme ?>
                                </div>
                            </div>


                            <div id="tabs-3">
                                <div class="catalog_element_default_diagrams">
                                    <h2>��������</h2>
                                    <p><b><?= $r->dimentions ?> ��</b></p>
                                    <? if ($r->picture_dimensions): ?>
                                        <p>
                                            <a data-fancybox="" data-caption="������ �����-������ IECON <?= $r->model ?>" href="<?= $r->picture_dimensions ?>">
                                                <img src="<?= $r->picture_dimensions ?>" alt="�������� <?= $r->model ?>">
                                            </a>
                                        </p>
                                    <? endif; ?>

                                </div>
                            </div>

                            <div id="tabs-4">
                                <h2>����� ��� ������ � <?= $r->model ?></h2>
                                <table class="table_style2">
                                    <tbody>
                                        <tr>
                                            <th style="width: 60%;">��������</th>
                                            <th style="width: 15%;">������</th>
                                            <th style="width: 15%;">����</th>
                                        </tr>
                                        <tr>
                                            <td class="text_align_left">
                                                <b>����������� ������������ <?= $r->model ?></b>
                                            </td>
                                            <td>
                                                <?= $r->brochure_text ?>
                                            </td>
                                            <td>
                                                <a class="green_button" target="_blank" href="http://rusavtomatika.com/upload_files/manuals/<?= $r->brochure ?>">�������</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <script>
                function dich(num, link)
                {
                    if (link != "0") {
                        $("#dd").html('<a id="biglightbox" href=\'" + link + "\' rel="lightbox[1]"><span id="bigimage" title="���������"><img class="lupa" src="/images/zoom.png" /><img src=\'" + num + "\'"></span></a>');
                    } else {
                        $("#dd").html("<img src=\'" + num + "\'>");
                    }
                    ;
                }
                $(function () {
                    $("#tabs").tabs();
                });
                $(document).ready(function () {
                    $('.toclick').click(function () {
                        $('.lightbox').prop('rel', 'lightbox[1]');
                        $(this).children('.lightbox').prop('rel', 'box[1]');
                    });
                });

                </script>
                <?
                $out = ob_get_contents();
                ob_end_clean();
            } else {
                if ($_SERVER["REQUEST_URI"] != '/modules/') {
                    header("HTTP/1.1 301 Moved Permanently");
                    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/modules/');
                    exit();
//    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/404.php');
                } else {
                    ob_start();
                    include "index_page.php";
                    $out = ob_get_contents();
                    ob_end_clean();
                }
            };
            ?><?
