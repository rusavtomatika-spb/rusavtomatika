<?
include $_SERVER["DOCUMENT_ROOT"]."/config.php";
if(EX != "_"){
    header($_SERVER['SERVER_PROTOCOL'] . " 301 Moved Permanently");
    header('Location: https://' . $_SERVER['HTTP_HOST'] ."/accessories/codesys_license/");
    exit();
}
include $_SERVER['DOCUMENT_ROOT'] . "/cms/core/check_catalog_404.php";
global $current_component;
global $TITLE, $KEYWORDS, $DESCRIPTION, $CANONICAL;
global $db;
global $mysqli_db;

$DESCRIPTION = 'CODESYS ����������� �������� ��� ������� Weintek';
$KEYWORDS = '';
$TITLE = 'CODESYS (����� ���������/��������) - ����������� �������� ��� ������� Weintek';
$SERVER_PROTOCOL = $_SERVER['SERVER_PROTOCOL'] == "HTTP/1.1" ? "http://" : "https://";

global $extra_openGraph;
$extra_openGraph = Array(
    "openGraph_image" => "http://www.rusavtomatika.com/upload_files/images/codesysguide/codesyscard.png",
    "openGraph_title" => "CODESYS (����� ���������/��������) - ����������� �������� ��� ������� Weintek",
    "openGraph_siteName" => "�������������"
);
include $_SERVER['DOCUMENT_ROOT'] . "/cms/core/prolog.php";

require_once $_SERVER['DOCUMENT_ROOT'] . '/sc/lib_new.php';

// start DataBase
$var_array = explode("/", $_SERVER['SCRIPT_NAME']);
$levels = count($var_array);
$end_page = $levels - 2;
$num = str_replace(".php", "", $var_array[$end_page]);
$sql = "SELECT * FROM products_all WHERE `model` = '$num' ";
$res = mysqli_query($mysqli_db, $sql) or die(mysqli_error($mysqli_db));
$r = mysqli_fetch_object($res);
// end DataBase
/*
if (($r->retail_price != '0') AND ( $r->retail_price != '')) {
    $action_price = action_price($r->model);
    if (!empty($action_price)) {

        $priceb = "<td width=60 ><span class='prpr old'>$r->retail_price</span><span class='prpr action' title='������� ��� ��������� � ���' style='  margin-top: -18px;  margin-left: -25px;'>$action_price</span></td><td class=val_name title='������� ��� ��������� � ���'> USD </td>";
    } else {

        $priceb = "<td width=60 class=prpr title='������� ��� ��������� � ���' >$r->retail_price</td><td class=val_name title='������� ��� ��������� � ���'> USD </td>";
    };
} else {
    $priceb = "<td width=60 colspan='2' style='display: initial;
padding: 0px 20px;
border: none;
background: none;' class='zakazbut' idm='$r->model' onclick='show_backup_call(6, \"$r->model\")' >��&nbsp;�������</td>";
};
*/

$nav = '<nav style="margin-left: 0px"><a href="/">�������</a>&nbsp;/&nbsp;<a href="/accessories/">����������</a>&nbsp;/&nbsp;' . $TITLE . '</nav>';

?>
<script>


    (function($) {
        $(function() {
            heightulki = 0;
            $('ul.tabs__guide__caption li').each(function () {
                heightulki += $(this).outerHeight();
            });
            $('.tabs__guide__caption').height(heightulki);

            var widthlist = $('.tabs__guide__caption').width() - 2;
            $('.tabs__guide__content').css("marginLeft", widthlist);
            window.onload = function() {
                asd = $('.tabs__guide.vertical').height();

                var topblocktabs = $('.tabs__guide').offset().top;

                var dsa = $('.tabs__guide__caption').height();
                asd = $('.tabs__guide.vertical').height();
                topdowindownext = asd - dsa;
                slicktabs();


                function slicktabs() {
                    $('.tabs__guide__content').css("marginLeft", widthlist);
                    topblocktabs = $('.tabs__guide').offset().top;

                    var difer = $(window).scrollTop() - topblocktabs + 25;


                    if(difer > 0 && difer < topdowindownext){
                        $('.tabs__guide__caption').css({'position' : 'fixed', 'top' : '25px'});
                    }else if(difer < 0){
                        $('.tabs__guide__caption').css({'position' : 'absolute', 'top' : '0px'});
                    }
                    else if( difer > topdowindownext){
                        $('.tabs__guide__caption').css({'position' : 'absolute', 'top' : 'auto', 'bottom' : '0px'});
                    }


                    $(window).scroll(function() {

                        var difer = $(window).scrollTop() - topblocktabs + 25;


                        if(difer > 0 && difer < topdowindownext){
                            $('.tabs__guide__caption').css({'position' : 'fixed', 'top' : '25px'});
                        }else if(difer < 0){
                            $('.tabs__guide__caption').css({'position' : 'absolute', 'top' : '0px'});
                        }
                        else if( difer > topdowindownext){
                            $('.tabs__guide__caption').css({'position' : 'absolute', 'top' : 'auto', 'bottom' : '0px'});
                        }

                    });
                }
                $("ul.tabs__guide__caption").on("click", "li:not(.active)", function() {
                    $(this)
                        .addClass("active")
                        .siblings()
                        .removeClass("active")
                        .closest("div.tabs__guide")
                        .find("div.tabs__guide__content")
                        .removeClass("active")
                        .eq($(this).index())
                        .addClass("active");
                    if ($("#topper").length !== 0) { // �������� ������������� �������� ����� �������� ������
                        $('html, body').animate({ scrollTop: $("#topper").offset().top }, 300); // ��������� ��������� � �������� scroll_el
                    }
                    asd = $('.tabs__guide.vertical').height();
                    topdowindownext = asd - dsa;
                    slicktabs();
                });
            };
        });

    })(jQuery);








</script>

<style>
    table.eatable tr{border-bottom: 1px solid grey;}

    table.eatable td{
        padding: 4px 0;
    }
    h2{
        color: #000000;
    }
    .block_content h2{
        margin-left: 0px;
    }
    #tabs {
        min-height: auto;
        font-size: 16px;
    }
    #tabs div{
        min-height: auto;
        font-size: 16px;
    }
    #tabs small{
        font-size: 14px;
    }
    .images_easyacces_item{
        height: 195px;
    }

</style>
<article>
    <div class="blockofcols_container">
        <?=$nav?>
        <h1>CODESYS (����� ���������/��������) - ����������� �������� ��� ������� Weintek</h1>
        <div class="blockofcols_row" style="margin: 25px 0">
            <div class="col-4">
                <a class="catalog_element_monitors_aplex__main_picture number_of_picture_1" data-fancybox="group" data-caption="�������� ��������� Codesys ��� Weintek" href="//www.rusavtomatika.com/upload_files/images/codesysguide/codesyscard.png">
                    <div class="catalog_element_monitors_aplex_picture_detail_wrap">
                        <div class="catalog_element_monitors_aplex_picture_detail" style="background-image: url(http://www.rusavtomatika.com/upload_files/images/codesysguide/codesyscard.png);"></div>
                    </div>                </a>
                <div class="catalog_element_monitors_aplex__thumbnails">
                    <span class="catalog_element_monitors_aplex__thumb active" data-rel-large="//www.rusavtomatika.com/upload_files/images/codesysguide/codesyscard.png" data-rel-middle="//www.rusavtomatika.com/upload_files/images/codesysguide/codesyscard.png" style="background-image: url('http://www.rusavtomatika.com/upload_files/images/codesysguide/codesyscard.png')"></span></div>
                <script>
                    $(document).ready(function () {
                        $(".catalog_element_monitors_aplex__thumb").click(function () {
                            $(".catalog_element_monitors_aplex__thumb").removeClass("active");
                            $(this).addClass("active");
                            $(".catalog_element_monitors_aplex__main_picture.number_of_picture_1 .catalog_element_monitors_aplex_picture_detail").css("background-image",
                                "url('" + $(this).attr('data-rel-middle') + "')");
                            $("a.catalog_element_monitors_aplex__main_picture.number_of_picture_1").attr("href", $(this).attr('data-rel-large'));

                        });
                        /*$("a.catalog_element_monitors_aplex__main_picture").fancybox();*/
                        $(".catalog_element_monitors_aplex__thumb:first").click();
                    });
                </script>


            </div>

            <div class="col-8" style="position: initial;">
                <div class="catalog_element_monitors_aplex_property catalog_element_monitors_aplex_name  catalog_element_monitors_aplex_gray catalog_element_monitors_aplex_block_price">
                    <div class="blockofcols_container">
                        <div class="blockofcols_row">
                            <div class="col-4">
                                <span style="overflow: hidden;max-height: 48px;" class="field_value">�������� ��������� Codesys ��� Weintek</span>
                            </div>
                            <div class="col-3">
                                <span class="field_title">���� � ���:<br></span>
                                <span class="catalog_element_monitors_aplex_price">
                                                <span class="prpr" title="������� ��� ��������� � ���"><?=$r->retail_price?></span>
                                                <span class="val_name" title="������� ��� ��������� � ���">USD</span>
                                            </span>
                            </div>
                            <div class="col-3">
                                <div>
                                    <span class="field_title">�������:<br></span>
                                    <span class="field_value"><span class="val_in_stock">���� �� ������</span></span>
                                </div>
                            </div>
                            <div class="but_wr"><div class="zakazbut addToCart" idm="�������� CODESYS"><span>� �������</span></div></div>
                        </div>
                    </div>
                </div>


                <div class="catalog_element_monitors_aplex_property catalog_element_monitors_aplex_buttons">
                    <div class="blockofcols_container">
                        <div class="blockofcols_row">
                            <div style="display:none;width: 33%" class="col-5-5"><div class="but_wr"> <div class="zakazbut" idm="�������� CODESYS" onclick="show_compare(this)"><span>�&nbsp;���������</span></div></div></div>
                            <div class="col-5-5" style="width: 50%"><div class="but_wr"><div class="zakazbut" idm="�������� CODESYS" onclick="show_backup_call(2, '�������� CODESYS')"><span>�����&nbsp;�&nbsp;1&nbsp;����</span></div></div></div>
                            <div class="col-5-5" style="width: 50%"><div class="but_wr"><div class="zakazbut" idm="�������� CODESYS" onclick="show_backup_call(1, '�������� CODESYS')"><span>��������&nbsp;������</span></div> </div></div>
                        </div>
                    </div>
                </div>


                <div class="catalog_element_monitors_aplex_property catalog_element_monitors_aplex_text_detail">
                    <div class="blockofcols_container">
                        <div class="blockofcols_row">
                            <p>��� ������ � CODESYS, ���������� ���������� ����� ���������.</p>
                            <p>�������� �������� ���������������� <b>�� ���� ������ �� ���� ������ � �������������</b>.</p>
                        </div>
                    </div>
                </div>



            </div>

        </div>



        <div id="topper"></div>
        <div class="tabs__guide  vertical">
            <ul class="tabs__guide__caption">
                <li class="active">1. �����</li>
                <li>2. ��������� Codesys Runtime</li>
                <?/*?>   <li>3. ����� ���������� Codesys</li><?*/?>
            </ul>

            <div class="tabs__guide__content  active">
                <h2>��� ���� ����� CODESYS?</h2>
                <p>
                    ������������������ ������� �� ������������ �������� ���������� ��������� �������, ������� �������� ����������,
                    �������� � �����������, ��������, ��������. ������ � �������� �������� ���������� �����/������ �
                    ����� �������� �� � ��� (��������������� ���������� ����������) ��� ���������� ������, ��� � ����� ������� ������.
                </p>
                <p>CODESYS ��� ��������������� ����� ���������� (IDE) ���������� ��� ��������������� ������������. CoDeSys ������������ ��� 5 ������ ���������������� ��������� ��� 61131-3 (LD, FBD, IL, ST, SFC) � �������� �������������� ���� CFC (���������� FBD �� ��������� �������� ���������� ������).</p>

                <p>� ������ ��������� Weintek ����� cMT <a href="/weintek/cMT3071.php">cMT3071</a>, <a href="/weintek/cMT3072.php">cMT3072</a>, <a href="/weintek/cMT3090.php">cMT3090</a>, <a href="/weintek/cMT3151.php">cMT3151</a> ������������ ���������� ���. �� ������ ������������ ������ ��������� � ���� ���.</p>

                <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/codesysguide/codesys1.png" data-fancybox="gallery0"><img style="max-width: 800px;" src="//www.rusavtomatika.com/upload_files/images/codesysguide/codesys1.png"></a></p>

                <h2>��� ��� ��������?</h2>
                <p>������ ��������� ����� ���������� ����������, ��������������� � ������������ ��
                    ���������� IEC 61131-3 ������ ���������� CODESYS v3.5.</p>
                <p>� ������� ���������� ������������ ���������, ������ ���� �������� ���������� ���� �� ����� � ��� ��������� �������.
                    ������ ���� �������� �� ������������, ������������ ������ � ��������� ���������, ������� �� �������������� �
                    ��������� EasyBuilder Pro. ������ ���� ��������� ������� �����������, ������� �� �������������� ��� � ��������� CODESYS.</p>

                <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/codesysguide/codesys3.png" data-fancybox="gallery0"><img style="max-width: 800px;" src="//www.rusavtomatika.com/upload_files/images/codesysguide/codesys3.png"></a></p>

            </div>
            <div class="tabs__guide__content">
                <h2>��������� Codesys Runtime</h2>

                <p>�� ������ ��������� ������� � ��������� ���������. ������ ����� ��������� � ����� ������� ����</p>
                <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/codesysguide/codesys4.png" data-fancybox="gallery1"><img src="//www.rusavtomatika.com/upload_files/images/codesysguide/codesys4.png"></a></p>
                <p>1. ������� ������ ��� ��������� ��������. ������ �� ���������: 111111<br>
                    2. ��������� �� ������� Codesys <br>
                    3. ������� ��� � ������ ������� �������� ��������� Codesys
                </p>

                <div class="blockofcols_row">
                    <div class="col-6">
                        <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/codesysguide/codesys5.png" data-fancybox="gallery1"><img src="//www.rusavtomatika.com/upload_files/images/codesysguide/codesys5.png"></a></p>
                    </div>
                    <div class="col-6">
                        <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/codesysguide/codesys6.png" data-fancybox="gallery1"><img src="//www.rusavtomatika.com/upload_files/images/codesysguide/codesys6.png"></a></p>
                    </div>
                </div>

                <p>����� ��������� � ��� ���������� ����������� ���, � �������� �� ������ ���������� ����� ������
                    �����-������ �� �������� Weintek, ������ ���������������� ���������� ������������ ���� CAN bus ���
                    Modbus TCP, � ����� ����� ������ ���������� �������������� ��� ��� ���������.</p>

            </div>



            <?/*?>
        <div class="tabs__guide__content">
            <h2>����� ���������� Codesys</h2>

            <p>����� ��� ������ ����������� ����� ���������� CODESYS (������ 3.5 � ����)</p>
            <ul class="spisok">
                <li>���������� ������ ����� ���������� CODESYS: <a href=" https://store.codesys.com/codesys.html">������</a></li>
                <li>����������� ������������ CODESYS �� ������� ����� <a href="https://drive.google.com/file/d/1ZrSg_PvOR9aBcZIouwgMUeZxFUOHJnkN/view">������</a> </li>
            </ul>

            <p>
                ��� ����, ����� � ����� ���������� CoDeSys �� ����� �������� � ������������ Weintek, ��� ����������� Target-����.
                � Target-������ ���������� ���������� � �������� ��������������� ������������, � �������� �������� CoDeSys.
                Target-����� ������������ �������������� �����������.
            </p>

            <p>
                ��������� ����� FilesForCODESYS.zip, � ������� ���������� target ���� Weintek_CODESYS_and_RemoteIO_1.0.0.95.package
                � ���������� ��� � ��������� CODESYS.
                ����� �������� ��������� EasyRemoteIO_V12013.zip, ��� ����������� ����� ��� ��������� ������� ����� ������.
            </p>

        </div>
<?*/?>

        </div>


        <section>

            <h2>���������������</h2>
            <div style="text-align: center">
<iframe width="720" height="405" src="https://rutube.ru/play/embed/e70a391074697f794ca55f37aa3d654d/" frameBorder="0" allow="clipboard-write; autoplay" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
            </div>
            <p>������, ������� ����������� � �����:</p>
            <ul class="spisok">
                <li>���������� ������ ����� ���������� CODESYS <a href="https://store.codesys.com/codesys.html">������</a> </li>
                <li>����������� ������������ CODESYS �� ������� ����� <a href="https://drive.google.com/file/d/1ZrSg_PvOR9aBcZIouwgMUeZxFUOHJnkN/view">������</a> </li>
                <li>������ ��� ���������� ���������� ������ FilesForCODESYS.zip � EasyRemoteIO_V12013.zip <a href="//www.rusavtomatika.com/download.php">������</a> </li>
                <li>������-���� ��� ������ ������� Weintek � ����� CODESYS <a href="//www.rusavtomatika.com/soft/EBPro/FilesForCODESYS.zip">������</a> </li>
                <li>���������� EasyRemoteIO ��� ��������� IP-������ ������� Weintek <a href="//www.rusavtomatika.com/soft/EBPro/EasyRemoteIO_V12013.zip">������</a> </li>

            </ul>

        </section>

        <section class="all_panel_with_ea20">
            <h2>������ ��������� � ���������� Codesys</h2>

            <div id="tabs">
                <ul>
                  <li class="urlup" data="functions">
                      <a href="#tabs-2">
                          �����: <strong>cMT X</strong>
                      </a>
                  </li>
                    <li class="urlup" data="functions">
                        <a href="#tabs-1">
                            �����: <strong>cMT</strong>
                        </a>
                    </li>


                </ul>

                <div id="tabs-1">
                    <?
                    $component->show(array(
                        "component_name" => "news.list",
                        "component_template" => "easyaccess_list",
                        "template_arguments" => array(
                            "title" => "Weintek",
                            "series" => "cMT",
                            "background" => "#f0f0f0;",
                            "title_link" => "/weintek/"
                        )),array(
                            "table" => "products_all",
                            "order" => "diagonal",
                            "series" => "cMT",
                            "custom_sql_query" => "and ((`codesys` like 'build_in') or (`codesys` like 'optional'))"
                        )
                    );
                    ?>
                </div>
                <div id="tabs-2">
                    <?
                    $component->show(array(
                        "component_name" => "news.list",
                        "component_template" => "easyaccess_list",
                        "template_arguments" => array(
                            "title" => "Weintek",
                            "series" => "cMT-X",
                            "background" => "#f0f0f0;",
                            "title_link" => "/weintek/"
                        )),array(
                            "table" => "products_all",
                            "order" => "diagonal",
                            "series" => "cMT-X",
                            "custom_sql_query" => "and ((`codesys` like 'build_in') or (`codesys` like 'optional'))"
                        )
                    );
                    ?>
                </div>

            </div>


        </section>
        <?/*?>
        <section>
            <h2>�������</h2>
            <div class="blockofcols_row">
                <div class="col-4">
                    <a href="/soft/EasyAccess/EasyAccess20_manual.pdf">
                        <div class="download__inner">
                            <div class="download__img" style="background-image: url(/images/pdf.svg)"></div>
                            <div class="download__text"><div class="download__text__title">����������� (eng)</div><div class="download__text__p">[25-03-2016 3.01 ��]</div></div>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
                <div class="col-4">
                    <a href="https://play.google.com/store/apps/details?id=com.weintek.easyaccess">
                        <div class="download__inner">
                            <div class="download__img" style="background-image: url(/images/android.svg)"></div>
                            <div class="download__text"><div class="download__text__title">����������� ��� Android</div><div class="download__text__p">[��������� ������]</div></div>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
                <div class="col-4">
                    <a href="/soft/EasyAccess/EasyAccess20_setup.zip">
                        <div class="download__inner">
                            <div class="download__img" style="background-image: url(/images/zip.svg)"></div>
                            <div class="download__text"><div class="download__text__title">����������� ver 2.3.0 ��� PC</div><div class="download__text__p">[23-11-2016 65.12 ��]</div></div>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </section>
<?*/?>

    </div>
</article>

<?
include $_SERVER['DOCUMENT_ROOT'] . "/cms/core/epilog.php";
?>
