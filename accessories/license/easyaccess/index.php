<?
include $_SERVER["DOCUMENT_ROOT"] . "/config.php";
if(EX != "_"){
    header($_SERVER['SERVER_PROTOCOL'] . " 301 Moved Permanently");
    header('Location: https://' . $_SERVER['HTTP_HOST'] ."/accessories/easyaccess/");
    exit();
}
global $current_component;
global $TITLE, $KEYWORDS, $DESCRIPTION, $CANONICAL;
global $db;
global $mysqli_db;

$DESCRIPTION = 'EasyAccess 2.0';
$KEYWORDS = '';
$TITLE = 'EasyAccess 2.0 � ��������� ���������� ������������ ������� ��� ����������� IP-������';
$SERVER_PROTOCOL = $_SERVER['SERVER_PROTOCOL'] == "HTTP/1.1" ? "http://" : "https://";

global $extra_openGraph;
$extra_openGraph = Array(
    "openGraph_image" => "https://www.rusavtomatika.com/upload_files/images/weintek/accessories/easyaccess/md/easyaccess_1.png",
    "openGraph_title" => "EasyAccess 2.0 � ��������� ���������� ������������ ������� ��� ����������� IP-������",
    "openGraph_siteName" => "�������������"
);

include $_SERVER['DOCUMENT_ROOT'] . "/abacus/prolog.php";

require_once $_SERVER['DOCUMENT_ROOT'] . '/sc/lib_new.php';

$num = "easyaccess";
$sql = "SELECT * FROM products_all WHERE `model` = '$num' ";
$res = mysqli_query($mysqli_db, $sql) or die(mysqli_error($mysqli_db));
$r = mysqli_fetch_object($res);

$nav = '<nav style="margin-left: 0px"><a href="/">�������</a>&nbsp;/&nbsp;<a href="/accessories/">����������</a>&nbsp;/&nbsp;' . $TITLE . '</nav>';

?>
<script>


    (function($) {
        $(function() {
            var widthlist = $('.tabs__guide__caption').width() - 2;
            let tab_hight = $('.tabs__guide__caption').height();
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
                    /*
if($('.tabs__guide__content').height() < tab_hight){
    $('.tabs__guide__content').height(tab_hight) ;
}*/
console.log($('.tabs__guide__content').height());

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

</style>
<article>
    <div class="blockofcols_container">
        <?=$nav?>
        <h1>EasyAccess 2.0 (��������/���������) � ��������� ���������� ������������ ������� ��� ����������� IP-������</h1>
        <div class="blockofcols_row" style="margin: 25px 0">
            <div class="col-4">
                <a class="catalog_element_monitors_aplex__main_picture number_of_picture_1" data-fancybox="group" data-caption="�������� EasyAccess" href="//www.rusavtomatika.com/upload_files/images/weintek/accessories/easyaccess/md/easyaccess_1.png">
                    <div class="catalog_element_monitors_aplex_picture_detail_wrap">
                        <div class="catalog_element_monitors_aplex_picture_detail" style="background-image: url(https://www.rusavtomatika.com/upload_files/images/weintek/accessories/easyaccess/md/easyaccess_1.png);"></div>
                    </div>                </a>
                <div class="catalog_element_monitors_aplex__thumbnails">
                    <span class="catalog_element_monitors_aplex__thumb active" data-rel-large="//www.rusavtomatika.com/upload_files/images/weintek/accessories/easyaccess/md/easyaccess_1.webp" data-rel-middle="//www.rusavtomatika.com/upload_files/images/weintek/accessories/easyaccess/md/easyaccess_1.png" style="background-image: url('https://www.rusavtomatika.com/upload_files/images/weintek/accessories/easyaccess/md/easyaccess_1.png')"></span></div>
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
                                <span style="overflow: hidden;max-height: 48px;" class="field_value">��������� EasyAccess 2.0</span>
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
                            <div class="but_wr"><div class="zakazbut addToCart" idm="�������� EasyAccess"><span>� �������</span></div></div>
                        </div>
                    </div>
                </div>


                <div class="catalog_element_monitors_aplex_property catalog_element_monitors_aplex_buttons">
                    <div class="blockofcols_container">
                        <div class="blockofcols_row">
                            <div style="display:none;width: 33%" class="col-5-5"><div class="but_wr"> <div class="zakazbut" idm="�������� EasyAccess" onclick="show_compare(this)"><span>�&nbsp;���������</span></div></div></div>
                            <div class="col-5-5" style="width: 50%"><div class="but_wr"><div class="zakazbut" idm="�������� EasyAccess" onclick="show_backup_call(2, '�������� EasyAccess')"><span>�����&nbsp;�&nbsp;1&nbsp;����</span></div></div></div>
                            <div class="col-5-5" style="width: 50%"><div class="but_wr"><div class="zakazbut" idm="�������� EasyAccess" onclick="show_backup_call(1, '�������� EasyAccess')"><span>��������&nbsp;������</span></div> </div></div>
                        </div>
                    </div>
                </div>

                <div class="catalog_element_monitors_aplex_property catalog_element_monitors_aplex_text_detail">
                    <div class="blockofcols_container">
                        <div class="blockofcols_row">
                            <p>�������� �������� ���������������� �� ���� ������ �� ���� ������ � �������������.</p>
                            <p>��������� �������� 55$ ��� ������� �������������� ������������ ������ ��������� ��� ��������� ���������� Weintek. </p>
                            <p><b>��������� �������� �������� - 80$ � ���</b></p>
                        </div>
                    </div>
                </div>



            </div>

        </div>

        <?/*?>
        <section>



            <h2>��� �������� EasyAccess 2.0?</h2>
            <p>���������� ������� EasyAccess 2.0 ������ ���������� �� ������������� ������� ���������� �������. ��� ��������� �������������� ��������:</p>





            <div class="blockofcols_row" style="margin: 25px 0">
                <div class="col-6" style="padding: 15px">
                    <div style="background-color: rgba(91, 155, 213, 0.1);padding: 25px;border-bottom: 4px solid #5b9bd5;height: 181px;">
                    <p><b>������������ ��������� ���������� (����� �����)</b></p>

            <ul class="spisok">
                <li>������ ����� ��������� ����� ��������� ���������� �������, �� ����� ��������� ������� ���������.</li>
                <li>��� ������ �������� IP ����� ���������� ������ ���� ����������.</li>
                <li>���� ������ ��������� ���������� ����� ��� (��� ���������) �������, ����������� ����� ���� ����������.</li>
            </ul>

    </div>

                </div>
                <div class="col-6" style="padding: 15px">
                    <div style="background-color: rgba(142, 206, 99, 0.23);padding: 25px;border-bottom: 4px solid #466531;height: 181px;">
                    <p><b>���������� � ������� EasyAccess 2.0 (�������� �����)</b></p>

                        <ul class="spisok">
                            <li>�� � ������ ��������� ������������ � ����������� VPN-�������, ����� ������� �������������� ����� �������</li>
                            <li>������� �������������� �������� ���� �� ���������.</li>
                            <li>� ������ �������� IP ����� ���������� ��������� ���������.</li>
                            <li>���������� �� ����������� ���������������� ����� �� ������ �� ���������� EasyAccess 2.0.</li>
                        </ul>


                    </div>
                </div>

            </div>
<img style="width: 100%" alt="����� 1" src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/mceclip0.webp">

        </section>
 <?*/?>

        <section>


            <div id="topper"></div>
            <?/*?>
            <h2>��� ������ �������� � EasyAccess 2.0</h2>

            <?*/?>
            <div class="tabs__guide  vertical">

                <ul class="tabs__guide__caption">
                    <li class="active">1. ����� � �����������</li>
                    <li>2. ��������� ���������� � ���������</li>
                    <li>3. ������ ������</li>
                    <li>4. ���������� ������� (���������)</li>
                    <li>5. ���������� ������ � �����<br>(Trial 30 ����)</li>
                    <li>6. ���������� ������ � �����<br></li>
                    <li>7. EasyAccess 2.0 �� ��</li>
                    <li>8. �����������</li>
                </ul>
                <div class="tabs__guide__content  active">
                    <h2>��� ����� EasyAccess 2.0?</h2>
                    <p>EasyAccess 2.0 ��� ������, � ������� �������� �� ������ �������� ������ � ����� ������� ��������� � ��� �� ����� ����� ����.
                        ��� ���������� ������������ ������ ��������� � �������� �� � ������ �������� EasyAccess 2.0 (�� ����� weincloud.net), � ���������, ��� ������ ����� ����� � ��������.
                        ����� ���������, �� ������� �������� � ���������� �������� � ��� � ����� ��������� ����. ������ ���������� ������ ���� ���� ����� ����� ���������� IP.
                        ������, ������������ ����� ������ ���� �������� ���������� SSL 128 ���. ������ �������� ������������ ������������ � ���������� �������� ������.</p>
                    <div class="blockofcols_row" style="margin: 25px 0">
                        <div class="col-1"></div>
                        <div class="col-2">
                            <div class="image_bg_cover" style="background-image: url('https://www.rusavtomatika.com/upload_files/images/icon-security.png')"></div>
                            <div class="under_text">������������ ����������� SSL</div>
                        </div>
                        <div class="col-2">
                            <div class="image_bg_cover" style="background-image: url('https://www.rusavtomatika.com/upload_files/images/icon-users.png')"></div>
                            <div class="under_text">���������� �������� �������������</div>
                        </div>
                        <div class="col-2">
                            <div class="image_bg_cover" style="background-image: url('https://www.rusavtomatika.com/upload_files/images/icon-circle2.png')"></div>
                            <div class="under_text">��� ����������� IP ������ ���������</div>
                        </div>
                        <div class="col-2">
                            <div class="image_bg_cover" style="background-image: url('https://www.rusavtomatika.com/upload_files/images/icon-passphrough.png')"></div>
                            <div class="under_text">PassThrough � ���������� PLC ����� HMI</div>
                        </div>
                        <div class="col-2">
                            <div class="image_bg_cover" style="background-image: url('https://www.rusavtomatika.com/upload_files/images/icon-ipad2.png')"></div>
                            <div class="under_text">���������� HMI � ��������� ���������</div>
                        </div>
                        <div class="col-1"></div>
                    </div>
                    <h2>
                        ��� ���� ����� EasyAccess 2.0?
                    </h2>
                    <p>
                        � ��������� ����� ��� ������ ����� ���������� ������� �� ��������� ���������� �������� ���������.
                        ���� � ��� ������ �������� ����������� � ������ ���������, ������� ����������� �� ����� ������������, �� ��� ����� ������ IP ����� ����� ������, ����� � ��� ������������. ��� ������ ���� �� �� ������ ����� IP � ������? ���� ��������� �������� ��� ��� �������.
                    </p>
                    <p>������ ������ � ��� ������������ ������������ � ������ �� �� ������ IP ������. ������ ������ ����� ��� �����������:</p>
                    <ul class="spisok">
                        <li>���������� ������� � ��������� �����, ����� �� ����� ��� ����� IP (������ ������, ����� ��� ����������)</li>
                        <li>���������� ����������� ������� ������������</li>
                        <li>��� ������ ������ ����� ���� ���������� ����� IP</li>
                    </ul>
                    <p>������ ������ � ������������ EasyAccess 2.0.</p>
                    <p>� EasyAccess 2.0 �� ������������ �� �������, ��������� � ������ �������.
                        ������ ������ ������� ���������� ���� ����� ������ ������������, ������� ������� ���������� ���������� IP.
                        ��������� ������ IP �����, �� ������ �������� ������������ � ������� ��������� � ��������� ����������� � ����.
                    </p>
                    <h2>��� ��������� ������ EasyAccess 2.0?</h2>
                    <ol class="spisok">
                        <li>��������� ������� ����� VNC-������, CMT Viewer (�������� ������ ��� ����� ������� ��������� CMT).
                            �� ������ ������, ��� ���������� �� ������ ����� ������, �������� ������.
                        </li>
                        <li>������������ ������</li>
                        <li>������������� ������ �������</li>
                        <li>��������� ����� ����� FTP. (���� ������ ������������ ftp)</li>
                        <li>����������� �����������</li>
                    </ol>

                </div>
                <div class="tabs__guide__content">
                    <h2>��������� ����������</h2>
                    <ul class="spisok">
                        <li>������������ �������: Windows XP, Windows 7, Windows 8 (32 / 64���), Windows 10 (32 / 64���) (���������� ����� ��������������)</li>
                        <li>������ ��������� Weintek � �������������� EasyAccess 2.0 </li>
                        <li>��������-����������</li>
                        <li>EasyBuilder Pro v4.10.05 ��� �����</li>
                        <li>IOS: 7.0 ��� ������</li>
                        <li>Android: v4.1.2 ��� ������</li>
                    </ul>



                </div>
                <div class="tabs__guide__content">

                    <h2>������� ���������</h2>
                    <p>����� ������ ������������ EasyAccess 2.0, ����� ��������� ��������� ����. �������� ��������������� �������, �������� ����������� ����.</p>
                    <ol class="spisok">
                        <li>������ ��������� ������ ���� ������������ (���� ���� ������ �� ����� ��� �������������� EasyAccess2.0, �� ���������� � ����� ���������� � ������-����.)</li>
                        <li>���������� ������� (���������) (����� 4)<br> ������ ���� ������ ������� (�����) �� ����� <a href="https://www.weincloud.net/">weincloud.net/</a></li>
                        <li>���������� ������ � ����� (����� 6)<br>���� �� ������ ����������� 30 ������� ������, �� ���������� � (����� 5)<br>������ ��������� ������ ���� ��������� � �����</li>
                        <li>���������� ������������ � �������� ��� ������� � ������<br>������ ���� ������� ������� ������ ������������, � ������� ����� ��������� ������ ���������</li>
                        <li>EasyAccess 2.0 ������ ���� ���������� �� ��</li>
                    </ol>
                    <p>����� ����, ��� ��� ���� ���������, ������������ ������ �������� ������������ � ������ ���������</p>


                    <h2>��������� ������</h2>
                    <p>����� ������������ ������ ���������, ����� ������ ������������ EasyAccess 2.0.
                        � ��������� ������� ������� ��� �������������� ������ ���������, �������� <a href="/weintek/cMT3072.php">cMT3072</a>.
                        � ����� ������� � ��� �� ����� �������� ��������� EasyAccess 2.0 ������ � ����������.
                        � ���� ������ ��� ���������� �������� � ���, ����� ������������ ���� ������.
                        ����� ���������, ��� ���� ������ ������������ EasyAccess 2.0.
                        ������, ������� ������������ ������ ���������� ����� ������� ���������� ������ �� EasyAccess�.</p>

                    <h2>������������</h2>

                    <ul class="spisok">
                        <li><b>����� � �������������� ������</b>
                            <p>������� ���������� �������, � �������� ������������� ������ ���������.
                                <b>������ ��������� ����� ���� ��������� ������ � ������ ������.</b>
                                �������������� ������, ��� ������������, ������� ����� ��������� �������� ���������
                                � �������������� ����� ��� ��������� �� ����� (<a href="https://www.weincloud.net/">weincloud.net/</a>).
                                ������� �������������� ������ �� ������������ ��� ����� � ���������� ��������� EasyAccess 2.0.</p></li>
                        <li> <b>������ ������� ���������</b>
                            <p>������ ��������� ����� ���������� � ������. ����� ������ ����� ��������� �������������.
                                ������������ ������� ����������� ��������� ����� �������� �� ������, ������� �� ���������.
                                ������ ��������� ����� ���� ��������� � ������ ������. ������ ��������� � ��������� ������������� ������.</p></li>
                        <li>
                            <b>������������</b>
                            <p>������������ � ��� �������, ������� ����� �������������� � ���������� ���������
                                EasyAccess 2.0 � �������� ��������� �������� ���������, � ����� �������� �������,
                                ������� ����� ��� �������� ������������� ������.</p></li>
                    </ul>


                    <h2>������ ������������� ����</h2>
                    <p>���������� ��������� ������� ��� ��������������� ������� ������.</p>
                    <ol class="spisok">
                        <li>� ���� ������� ����� � ������ ���� ������ ����� ���� �������������, ����� � ����.</li>
                        <li>� ���� ������� ������ ��������� ������������� � ������: ������ 1, ������ 2, ������ 3 � �.�. ������ ��������� A ����������� � ���� �������</li>
                        <li>������������ ����� ������������ �� ������ �������. � ��� �� ����� ������ � ������� ���������, ������� �� ����� ������. (������������ ���� � ������ 1)</li>
                        <li>������������ ����� ���� �������� ������� � �������� ��������� � ����� � ��� ������. (������������ ���� � ������ ��������� J).
                            ��������� ������������� ����� �������� ������ � ����� � ��� �� ������ ���������,
                            ���������� �� ����, ��������� �� ��� ������� (������� ��������� �) ��� ����� ������ ����� (������ ��������� H).</li>
                    </ol>
                    <p>������� ������������� ��������������� ������. </p>

                    <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/mceclip1.webp" data-fancybox="gallery0"><img loading="lazy" src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/mceclip1.webp"></a></p>


                </div>

                <div class="tabs__guide__content">
                    <h2>�������� �������� (������)</h2>
                    <ol>
                        <li><p>������� ���������� �������� ��������� �� ������: <a href="https://www.weincloud.net/">weincloud.net</a></p>
                            <p>������� �� ����, ������� ������ [Create Domain account] � ���������� � ���������� ����� ������ �������</p>
                            <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/1.webp" data-fancybox="gallery1"><img loading="lazy" src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/1.webp"></a></p>
                            <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/2.webp" data-fancybox="gallery1"><img loading="lazy" src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/2.webp"></a></p>
                        </li>
                        <li>
                            <p>���� �� ��� ��������� �����, �� ��� �� ����� ������ ������ �� ������� �� �������������. ������� ��� ������ � ����������� ����������� ��������� �� ������.</p>
                            <p>������ ����� �������������� � ������� ���������� �������. ��� ����� �� ������� ��������
                                <a href="https://www.weincloud.net/">weincloud.net</a> ������� ������ [Domain]</p>
                            <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/3.webp" data-fancybox="gallery1"><img loading="lazy" src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/3.webp"></a></p>
                            <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/4.webp" data-fancybox="gallery1"><img loading="lazy" src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/4.webp"></a></p>
                        </li>
                    </ol>


                    <h2>���������� ������������ � �������� ��� �������</h2>

                    <ol>
                        <li>
                            <p>������� ������� [User] (������������). �� ����� �������� � ������ ��� ���� ���� ������������.
                                ��� ������ ���������� ����� ������. ������� ������ [+Add User] ��� ���������� ������������. </p>
                            <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/13.webp" data-fancybox="gallery3"><img loading="lazy" src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/13.webp"></a></p>
                        </li>
                        <li>
                            <p>��� ������ ������������ ������� ����� � ��� �����, �� ������� ������ ��������������� ������������� ������. </p>
                            <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/14.webp" data-fancybox="gallery3"><img loading="lazy" src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/14.webp"></a></p>
                        </li>
                        <li>
                            <p> ������� ������ � ������. �������� �� � ������� ������ �������������� ��� ������ [Edit HMI]. �������� �������� ������� ������������ � ������� [Save].</p>
                            <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/15.webp" data-fancybox="gallery3"><img loading="lazy" src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/15.webp"></a></p>
                            <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/16.webp" data-fancybox="gallery3"><img loading="lazy" src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/16.webp"></a></p>
                            <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/17.webp" data-fancybox="gallery3"><img loading="lazy" src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/17.webp"></a></p>
                        </li>
                    </ol>
                </div>

                <div class="tabs__guide__content">
                    <h2>���������� ������ � ����� (Trial 30 ����)</h2>
                    <ol>
                        <li>
                            <p>� ����� ������ �� ����� <a href="https://www.weincloud.net/">weincloud.net</a>, �� ������� "Devices" - "HMI List"  ������� ������ [+ Add HMI]</p>
                            <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/5.webp" data-fancybox="gallery2"><img loading="lazy" src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/5.webp"></a></p>
                        </li>
                        <li>
                            <p>�������� ��� ���������:  30 days Free Trial</p>
                            <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/6.webp" data-fancybox="gallery2"><img loading="lazy" src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/6.webp"></a></p>

                            <p>������� Hardware key (���������� ����)  � ����������� �� ������� [Free Trial].</p>

                            <p>HWkey (Hardware key - ���������� ����) �� ������ ������, ����� � ����� ������ �� �������� ��������� �������� [System Settings] �� ������� [EasyAccess 2]</p>
                            <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/7.webp" data-fancybox="gallery2"><img loading="lazy" src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/7.webp"></a></p>
                        </li>
                    </ol>
                </div>

                <div class="tabs__guide__content">
                    <h2>���������� ������ � �����</h2>
                    <ol>
                        <li>
                            <p>��������� � ������ ����������� � �������� �� HW-key (Hardware key  - ���������� ����). ��� ������ ���� �������� � ���������� ����.
                                �� ���������� ���, ��� ��������� ���������.</p>
                        </li>
                        <li>
                            <p>� ������� ��������� EasyBuilderPro ����� ������� � ��������� � ������ ������, ����������� ��������� �� ������ �������� � ����������� EasyAccess 2.0.
                                �������� � EasyBuilderPro ����� ������. </p>
                            <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/8.webp" data-fancybox="gallery3"><img loading="lazy" src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/8.webp"></a></p>
                        </li>
                        <li>
                            <p>� ��������� ���������� ��������� ������������ ������� EasyAccess2.0. ������ ���� ������ "����������"</p>
                            <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/9.webp" data-fancybox="gallery3"><img loading="lazy" src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/9.webp"></a></p>
                        </li>
                        <li>
                            <p>�������� �������������� ������, ������� ��������� ���� �76 EasyAccess 2.0 Settings. ��������� ������ � ������.</p>
                            <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/10.webp" data-fancybox="gallery3"><img loading="lazy" src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/10.webp"></a></p>
                        </li>
                        <li>
                            <p>������ � ����� ������� ����� ������ ���� ������, ��� ������� �������, ��������� ���� � ����������� EasyAccess 2.0.
                                ���������� ���� ������ � ��������� � �������� ���� EasyAccess 2.0. ����� ������� ������ [Start] � ����� [Session ID] � [Password] �������� ��������,
                                ������� ��� ����� ����� � ��������� ����.</p>
                            <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/11.webp" data-fancybox="gallery3"><img loading="lazy" src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/11.webp"></a></p>
                        </li>
                        <li>
                            <p>� ����� ������ �� ����� <a href="https://www.weincloud.net/">weincloud.net</a>, �� ������� "Devices" - "HMI List"  ������� ������ [+ Add HMI]</p>
                            <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/5.webp" data-fancybox="gallery2"><img loading="lazy" src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/5.webp"></a></p>
                        </li>
                        <li>
                            <p> �������� ��� ���������:  [Add by session Id/password]. ������� Session ID � [Password], ���������� �� ���������� ����. ����������� ������� [Assign]. �� �������� ������ ��������� � �����. ������ ����� ������� ������������ � ������� ��� ������ � ������.</p>
                            <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/12.webp" data-fancybox="gallery3"><img loading="lazy" src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/12.webp"></a></p>
                        </li>
                    </ol>
                </div>

                <div class="tabs__guide__content">
                    <h2>EasyAccess 2.0 �� ��</h2>
                    <p>EasyAccess 2.0 ��������������� ��� ��������� ���������, ������� ����� ���������� �� ��. �� ����� �������������� ���������� �� ������������ ������ EasyBuilder.</p>
                    <p><a href="/soft/EasyAccess/EasyAccess20_setup.zip">
                            <div class="download__inner" style="width: 250px;">
                                <div class="download__img" style="background-image: url(/images/zip.svg)"></div>
                                <div class="download__text"><div class="download__text__title">����������� ver 2.3.0 ��� PC</div><div class="download__text__p">[23-11-2016 65.12 ��]</div></div>
                                <div class="clearfix"></div>
                            </div>
                        </a></p>
                    <h3>�����������</h3>
                    <p>��������� ��� ������, ��� ������������ ������, ������.</p>
                    <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea1.webp" data-fancybox="gallery3"><img loading="lazy" src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea1.webp"></a></p>
                    <h3>������� �����</h3>
                    <p>����� ����, ��� �� ������� � �������, �� ��������� �� ������� ������.
                        ��� ������������ ��� ������ ��������� ��������� ������������.
                        ����� ������������ ������� �������. �� ������ ������������ � ��������������� ���������� �������.
                        ������ ����� ����, ��� �� ������������ � ������, �� ��� ������ �������� ������ �������.
                        � ����� ������ ������ ����� �� ������ ������������, �� ��� ���, ���� �� �� ����� ��������� ������� ����������.</p>
                    <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea2.webp" data-fancybox="gallery3"><img loading="lazy" src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea2.webp"></a></p>
                    <p><b>������� ������ �� ������� ������:</b></p>
                    <table class="eatable">
                        <tbody>
                        <tr>
                            <td>������</td>
                            <td>�������</td>
                        </tr>
                        <tr>
                            <td style="width: 260px;"><p style="text-align: left"><img loading="lazy" src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea3.webp"></p></td>
                            <td>������ ������</td>
                        </tr>
                        <tr>
                            <td style="width: 260px;"><p style="text-align: left"><img loading="lazy" src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea4.webp"></p></td>
                            <td>����� ������ ���������</td>
                        </tr>
                        <tr>
                            <td style="width: 260px;"><p style="text-align: left"><img loading="lazy" src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea5.webp"></p></td>
                            <td>
                                ���: ������/������</td>
                        </tr>
                        <tr>
                            <td style="width: 260px;"><p style="text-align: left"><img loading="lazy" src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea6.webp"></p></td>
                            <td>���������</td>
                        </tr>
                        <tr>
                            <td style="width: 260px;"><p style="text-align: left"><img loading="lazy" src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea7.webp"></p></td>
                            <td>����� �� �������� ������������</td>
                        </tr>
                        <tr>
                            <td style="width: 260px;"><p style="text-align: left"><img loading="lazy" src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea8.webp"></p></td>
                            <td>������� �����������</td>
                        </tr>
                        </tbody>
                    </table>

                    <h3>��������� ������ ��������� � ��������� �������</h3>
                    <p>������ ��������� ����� ���������� � ����� �� ���������: ������, ������, ���������, ������.</p>
                    <table class="eatable">
                        <tbody>
                        <tr style="border-bottom: none;">
                            <td><p style="text-align: left"><img loading="lazy" src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea9.webp"></p></td>
                            <td><p style="text-align: left"><img loading="lazy" src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea10.webp"></p></td>
                        </tr>
                        <tr>
                            <td>������</td>
                            <td>������</td>
                        </tr>
                        <tr style="border-bottom: none;">
                            <td><p style="text-align: left"><img loading="lazy" src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea11.webp"></p></td>
                            <td><p style="text-align: left"><img loading="lazy" src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea12.webp"></p></td>
                        </tr>
                        <tr>
                            <td>�������</td>
                            <td>������</td>
                        </tr>
                        </tbody>
                    </table>

                </div>

                <div class="tabs__guide__content">

<h2>����������� EasyAccess 2.0</h2>

<ul style="margin-left:25px;">
  <li>���������� �����������</li>
  <li>���������� ������� � ������� ����� ���������������� ������ ���������</li>
    <li>������������ ���������� ������������� ������� ����� ������������ � ������ ��������� � ���� �����</li>
      <li>����</li>
        <li>Ethernet-Ethernet Pass-through</li>
</ul>

                </div>





            </div>

        </section>
<??>
        <!--section style="margin-top: 50px;">
            <h2>�����</h2>
            <div class="blockofcols_row">
                <div class="col-6">
<iframe width="720" height="405" src="https://rutube.ru/play/embed/5b1be0c1b3c24e57fffa4f92d16fba7e/" frameBorder="0" allow="clipboard-write; autoplay" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                    <p style="font-size: 17px;">EasyAccess 2.0 - ����������� � ��������� ������ ��� ����������� IP ������</p>
                </div>
                <div class="col-6">
<iframe width="720" height="405" src="https://rutube.ru/play/embed/f826c1eea58b62b8672a02ad4ceac21b/" frameBorder="0" allow="clipboard-write; autoplay" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                    <p style="font-size: 17px;">��������� ����������� � ������ ��������� Weintek ����� EasyAccess 2.0</p>
                </div>
            </div>

        </section-->

<?/*?>
        <section class="all_panel_with_ea20">
            <h2>������ ��������� � ���������� EasyAccess 2.0</h2>

            <div id="tabs">
                <ul>

                    <li class="urlup" data="functions">
                        <a href="#tabs-1">
                            �����: <strong>MT8000iE</strong>
                        </a>
                    </li>
                    <li class="urlup" data="dimensions">
                        <a href="#tabs-2">
                            �����: <strong>MT8000XE</strong>
                        </a>
                    </li>
                    <li class="urlup" data="scheme">
                        <a href="#tabs-3">
                            �����: <strong>cMT</strong>
                        </a>
                    </li>
                    <li class="urlup" data="scheme">
                        <a href="#tabs-4">
                            �����: <strong>mTV</strong>
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
                            "series" => "MT8000iE",
                            "background" => "#f0f0f0;",
                            "title_link" => "/weintek/"
                        )),array(
                            "table" => "products_all",
                            "order" => "diagonal",
                            "series" => "MT8000iE",
                            "custom_sql_query" => "and ((`easy_access` like 'optional') or (`easy_access` like 'build_in'))"
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
                            "series" => "MT8000XE",
                            "title_link" => "/weintek/"
                        )),array(
                            "table" => "products_all",
                            "order" => "diagonal",
                            "series" => "MT8000XE",
                            "custom_sql_query" => "and ((`easy_access` like 'optional') or (`easy_access` like 'build_in'))"
                        )
                    );
                    ?>
                </div>
                <div id="tabs-3">

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
                            "custom_sql_query" => "and ((`easy_access` like 'optional') or (`easy_access` like 'build_in'))"
                        )
                    );
                    ?>


                </div>
                <div id="tabs-4">

                    <?
                    $component->show(array(
                        "component_name" => "news.list",
                        "component_template" => "easyaccess_list",
                        "template_arguments" => array(
                            "title" => "Weintek",
                            "series" => "mTV",
                            "title_link" => "/weintek/"
                        )),array(
                            "table" => "products_all",
                            "order" => "diagonal",
                            "series" => "mTV",
                            "custom_sql_query" => "and ((`easy_access` like 'optional') or (`easy_access` like 'build_in'))"
                        )
                    );
                    ?>


                </div>
            </div>


        </section>
<?*/?>


        <section>
            <h2>�������</h2>
            <div class="blockofcols_row">
                <div class="col-4">
                    <a href="/soft/EasyAccess/EasyAccess20_manual.pdf">
                        <div class="download__inner">
                            <div class="download__img" style="background-image: url(/images/pdf.svg)"></div>
                            <div class="download__text"><div class="download__text__title">����������� (eng)</div><div class="download__text__p">[3.6 ��]</div></div>
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
                            <div class="download__text"><div class="download__text__title">����������� ��� PC</div><div class="download__text__p">[69 ��]</div></div>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </section>

    </div>






</article>

<?

include $_SERVER['DOCUMENT_ROOT'] . "/abacus/epilog.php";
?>
