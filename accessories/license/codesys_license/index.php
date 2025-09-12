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

$DESCRIPTION = 'CODESYS программный комплекс для панелей Weintek';
$KEYWORDS = '';
$TITLE = 'CODESYS (карта активации/лицензия) - программный комплекс для панелей Weintek';
$SERVER_PROTOCOL = $_SERVER['SERVER_PROTOCOL'] == "HTTP/1.1" ? "http://" : "https://";

global $extra_openGraph;
$extra_openGraph = Array(
    "openGraph_image" => "http://www.rusavtomatika.com/upload_files/images/codesysguide/codesyscard.png",
    "openGraph_title" => "CODESYS (карта активации/лицензия) - программный комплекс для панелей Weintek",
    "openGraph_siteName" => "Русавтоматика"
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

        $priceb = "<td width=60 ><span class='prpr old'>$r->retail_price</span><span class='prpr action' title='Нажмите для пересчета в РУБ' style='  margin-top: -18px;  margin-left: -25px;'>$action_price</span></td><td class=val_name title='Нажмите для пересчета в РУБ'> USD </td>";
    } else {

        $priceb = "<td width=60 class=prpr title='Нажмите для пересчета в РУБ' >$r->retail_price</td><td class=val_name title='Нажмите для пересчета в РУБ'> USD </td>";
    };
} else {
    $priceb = "<td width=60 colspan='2' style='display: initial;
padding: 0px 20px;
border: none;
background: none;' class='zakazbut' idm='$r->model' onclick='show_backup_call(6, \"$r->model\")' >по&nbsp;запросу</td>";
};
*/

$nav = '<nav style="margin-left: 0px"><a href="/">Главная</a>&nbsp;/&nbsp;<a href="/accessories/">Аксессуары</a>&nbsp;/&nbsp;' . $TITLE . '</nav>';

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
                    if ($("#topper").length !== 0) { // проверим существование элемента чтобы избежать ошибки
                        $('html, body').animate({ scrollTop: $("#topper").offset().top }, 300); // анимируем скроолинг к элементу scroll_el
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
        <h1>CODESYS (карта активации/лицензия) - программный комплекс для панелей Weintek</h1>
        <div class="blockofcols_row" style="margin: 25px 0">
            <div class="col-4">
                <a class="catalog_element_monitors_aplex__main_picture number_of_picture_1" data-fancybox="group" data-caption="Карточка активации Codesys для Weintek" href="//www.rusavtomatika.com/upload_files/images/codesysguide/codesyscard.png">
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
                                <span style="overflow: hidden;max-height: 48px;" class="field_value">Карточка активации Codesys для Weintek</span>
                            </div>
                            <div class="col-3">
                                <span class="field_title">Цена с НДС:<br></span>
                                <span class="catalog_element_monitors_aplex_price">
                                                <span class="prpr" title="Нажмите для пересчета в РУБ"><?=$r->retail_price?></span>
                                                <span class="val_name" title="Нажмите для пересчета в РУБ">USD</span>
                                            </span>
                            </div>
                            <div class="col-3">
                                <div>
                                    <span class="field_title">Наличие:<br></span>
                                    <span class="field_value"><span class="val_in_stock">есть на складе</span></span>
                                </div>
                            </div>
                            <div class="but_wr"><div class="zakazbut addToCart" idm="Лицензия CODESYS"><span>В корзину</span></div></div>
                        </div>
                    </div>
                </div>


                <div class="catalog_element_monitors_aplex_property catalog_element_monitors_aplex_buttons">
                    <div class="blockofcols_container">
                        <div class="blockofcols_row">
                            <div style="display:none;width: 33%" class="col-5-5"><div class="but_wr"> <div class="zakazbut" idm="Лицензия CODESYS" onclick="show_compare(this)"><span>В&nbsp;сравнение</span></div></div></div>
                            <div class="col-5-5" style="width: 50%"><div class="but_wr"><div class="zakazbut" idm="Лицензия CODESYS" onclick="show_backup_call(2, 'Лицензия CODESYS')"><span>Заказ&nbsp;в&nbsp;1&nbsp;клик</span></div></div></div>
                            <div class="col-5-5" style="width: 50%"><div class="but_wr"><div class="zakazbut" idm="Лицензия CODESYS" onclick="show_backup_call(1, 'Лицензия CODESYS')"><span>Получить&nbsp;скидку</span></div> </div></div>
                        </div>
                    </div>
                </div>


                <div class="catalog_element_monitors_aplex_property catalog_element_monitors_aplex_text_detail">
                    <div class="blockofcols_container">
                        <div class="blockofcols_row">
                            <p>Для работы с CODESYS, необходимо приобрести карту активации.</p>
                            <p>Действие лицензии распространяется <b>на одну панель на весь период её использования</b>.</p>
                        </div>
                    </div>
                </div>



            </div>

        </div>



        <div id="topper"></div>
        <div class="tabs__guide  vertical">
            <ul class="tabs__guide__caption">
                <li class="active">1. Обзор</li>
                <li>2. Активация Codesys Runtime</li>
                <?/*?>   <li>3. Среда разработки Codesys</li><?*/?>
            </ul>

            <div class="tabs__guide__content  active">
                <h2>Для чего нужен CODESYS?</h2>
                <p>
                    Автоматизированные системы на промышленных объектах используют различные датчики, которые собирают информацию,
                    например о температуре, давлении, движении. Данные с датчиков собирают устройства ввода/вывода и
                    далее передают их в ПЛК (Программируемый Логический Контроллер) где контроллер решает, что с этими данными делать.
                </p>
                <p>CODESYS это интегрированная среда разработки (IDE) приложений для программируемых контроллеров. CoDeSys поддерживает все 5 языков программирования стандарта МЭК 61131-3 (LD, FBD, IL, ST, SFC) и включает дополнительный язык CFC (расширение FBD со свободным порядком выполнения блоков).</p>

                <p>В панели оператора Weintek серии cMT <a href="/weintek/cMT3071.php">cMT3071</a>, <a href="/weintek/cMT3072.php">cMT3072</a>, <a href="/weintek/cMT3090.php">cMT3090</a>, <a href="/weintek/cMT3151.php">cMT3151</a> интегрирован функционал ПЛК. Вы можете использовать панель оператора в роли ПЛК.</p>

                <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/codesysguide/codesys1.png" data-fancybox="gallery0"><img style="max-width: 800px;" src="//www.rusavtomatika.com/upload_files/images/codesysguide/codesys1.png"></a></p>

                <h2>Как это работает?</h2>
                <p>Панели оператора имеют встроенный контроллер, программируемый в соответствии со
                    стандартом IEC 61131-3 средой разработки CODESYS v3.5.</p>
                <p>В панелях установлен двухъядерный процессор, каждое ядро работает независимо друг от друга и без взаимного влияния.
                    Первое ядро отвечает за коммуникацию, визуализацию данных и интерфейс оператора, который вы разрабатываете в
                    программе EasyBuilder Pro. Второе ядро управляет логикой контроллера, которую вы разрабатываете уже в программе CODESYS.</p>

                <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/codesysguide/codesys3.png" data-fancybox="gallery0"><img style="max-width: 800px;" src="//www.rusavtomatika.com/upload_files/images/codesysguide/codesys3.png"></a></p>

            </div>
            <div class="tabs__guide__content">
                <h2>Активация Codesys Runtime</h2>

                <p>На панели оператора войдите в системные настройки. Кнопка входа находится в левом верхнем углу</p>
                <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/codesysguide/codesys4.png" data-fancybox="gallery1"><img src="//www.rusavtomatika.com/upload_files/images/codesysguide/codesys4.png"></a></p>
                <p>1. Введите пароль для системных настроек. Пароль по умолчанию: 111111<br>
                    2. Перейдите во вкладку Codesys <br>
                    3. Введите код с задней стороны карточки активации Codesys
                </p>

                <div class="blockofcols_row">
                    <div class="col-6">
                        <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/codesysguide/codesys5.png" data-fancybox="gallery1"><img src="//www.rusavtomatika.com/upload_files/images/codesysguide/codesys5.png"></a></p>
                    </div>
                    <div class="col-6">
                        <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/codesysguide/codesys6.png" data-fancybox="gallery1"><img src="//www.rusavtomatika.com/upload_files/images/codesysguide/codesys6.png"></a></p>
                    </div>
                </div>

                <p>После активации у вас появляется полноценный ПЛК, к которому вы можете подключить новые модули
                    ввода-вывода от компании Weintek, данные коммуникационные устройства поддерживают шины CAN bus или
                    Modbus TCP, а также любые другие устройства поддерживающие эти два протокола.</p>

            </div>



            <?/*?>
        <div class="tabs__guide__content">
            <h2>Среда разработки Codesys</h2>

            <p>Далее для работы понадобится среда разработки CODESYS (версия 3.5 и выше)</p>
            <ul class="spisok">
                <li>Актуальная версия среды разработки CODESYS: <a href=" https://store.codesys.com/codesys.html">ссылка</a></li>
                <li>Руководство пользователя CODESYS на русском языке <a href="https://drive.google.com/file/d/1ZrSg_PvOR9aBcZIouwgMUeZxFUOHJnkN/view">ссылка</a> </li>
            </ul>

            <p>
                Для того, чтобы в среде разработки CoDeSys мы могли работать с контроллером Weintek, нам понадобится Target-файл.
                В Target-файлах содержится информация о ресурсах программируемых контроллеров, с которыми работает CoDeSys.
                Target-файлы поставляются производителем контроллера.
            </p>

            <p>
                Скачиваем архив FilesForCODESYS.zip, в котором содержится target файл Weintek_CODESYS_and_RemoteIO_1.0.0.95.package
                и подключаем его в программу CODESYS.
                Также скачайте программу EasyRemoteIO_V12013.zip, она понадобится позже для настройки модулей ввода вывода.
            </p>

        </div>
<?*/?>

        </div>


        <section>

            <h2>Видеоинструкция</h2>
            <div style="text-align: center">
<iframe width="720" height="405" src="https://rutube.ru/play/embed/e70a391074697f794ca55f37aa3d654d/" frameBorder="0" allow="clipboard-write; autoplay" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
            </div>
            <p>Ссылки, которые упоминаются в видео:</p>
            <ul class="spisok">
                <li>Актуальная версия среды разработки CODESYS <a href="https://store.codesys.com/codesys.html">ссылка</a> </li>
                <li>Руководство пользователя CODESYS на русском языке <a href="https://drive.google.com/file/d/1ZrSg_PvOR9aBcZIouwgMUeZxFUOHJnkN/view">ссылка</a> </li>
                <li>Раздел для скачивания актуальных файлов FilesForCODESYS.zip и EasyRemoteIO_V12013.zip <a href="//www.rusavtomatika.com/download.php">ссылка</a> </li>
                <li>Таргет-файл для работы модулем Weintek в среде CODESYS <a href="//www.rusavtomatika.com/soft/EBPro/FilesForCODESYS.zip">ссылка</a> </li>
                <li>Приложение EasyRemoteIO для настройки IP-адреса каплера Weintek <a href="//www.rusavtomatika.com/soft/EBPro/EasyRemoteIO_V12013.zip">ссылка</a> </li>

            </ul>

        </section>

        <section class="all_panel_with_ea20">
            <h2>Панели оператора с поддержкой Codesys</h2>

            <div id="tabs">
                <ul>
                  <li class="urlup" data="functions">
                      <a href="#tabs-2">
                          Серия: <strong>cMT X</strong>
                      </a>
                  </li>
                    <li class="urlup" data="functions">
                        <a href="#tabs-1">
                            Серия: <strong>cMT</strong>
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
            <h2>Скачать</h2>
            <div class="blockofcols_row">
                <div class="col-4">
                    <a href="/soft/EasyAccess/EasyAccess20_manual.pdf">
                        <div class="download__inner">
                            <div class="download__img" style="background-image: url(/images/pdf.svg)"></div>
                            <div class="download__text"><div class="download__text__title">Руководство (eng)</div><div class="download__text__p">[25-03-2016 3.01 Мб]</div></div>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
                <div class="col-4">
                    <a href="https://play.google.com/store/apps/details?id=com.weintek.easyaccess">
                        <div class="download__inner">
                            <div class="download__img" style="background-image: url(/images/android.svg)"></div>
                            <div class="download__text"><div class="download__text__title">Дистрибутив для Android</div><div class="download__text__p">[Последняя версия]</div></div>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
                <div class="col-4">
                    <a href="/soft/EasyAccess/EasyAccess20_setup.zip">
                        <div class="download__inner">
                            <div class="download__img" style="background-image: url(/images/zip.svg)"></div>
                            <div class="download__text"><div class="download__text__title">Дистрибутив ver 2.3.0 для PC</div><div class="download__text__p">[23-11-2016 65.12 Мб]</div></div>
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
