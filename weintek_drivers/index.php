<?
global $CONTENT_ON_WIDE_SCREEN;
$CONTENT_ON_WIDE_SCREEN = false;
require_once $_SERVER[ 'DOCUMENT_ROOT' ] . "/abacus/prolog.php";
CoreApplication::add_style( str_replace( $_SERVER[ "DOCUMENT_ROOT" ], "", __DIR__ ) . "/weintek_drivers_styles.css?" . rand() );
CoreApplication::add_script( str_replace( $_SERVER[ "DOCUMENT_ROOT" ], "", __DIR__ ) . "/scripts.js" );
global $extra_openGraph;
$extra_openGraph = array(
  "openGraph_image" => "http://www.rusavtomatika.com/upload_files/images/openGraph_images/weintek_drivers.png",
  "openGraph_title" => "Weintek, драйверы контроллеров ПЛК PLC совместимых с Weintek",
  "openGraph_siteName" => "Русавтоматика"
);

global $TITLE, $DESCRIPTION, $KEYWORDS, $extra_openGraph, $CANONICAL;
$TITLE = 'Weintek, драйверы контроллеров ПЛК PLC совместимых с Weintek';
$DESCRIPTION = 'Программное обеспечение Weintek HMI и EasyBuilder поддерживает большинство устройств ПЛК (PLC), представленных на рынке. Всегда самый новые драйверы. В списке указаны все устройства, поддерживаемые Weintek.';
$CANONICAL = "https://www.rusavtomatika.com/weintek_drivers/";

global $GLOBAL_ARR_SCRIPTS_TO_FOOTER;
$GLOBAL_ARR_SCRIPTS_TO_FOOTER[] = "/documents/documents.js";
$drv_result = $_SERVER[ 'DOCUMENT_ROOT' ] . '/weintek_drivers/drv_ftp_result.txt';
$com_fn = $_SERVER[ 'DOCUMENT_ROOT' ] . '/weintek_drivers/companies.txt';
$down_path = '/drivers/';
$items = json_decode( file_get_contents( $drv_result ), true ); // JSON с драйверами weintek
$coms = json_decode( file_get_contents( $com_fn ), true ); // JSON с брендами
$drivers = array();
if ( isset( $_GET[ "com" ] ) ) {
  $com = $_GET[ "com" ];
  //$com_name = $drivers[ $docsec ];
  $drivers = array_filter( $items, function ( $var )use( $com ) {
    return ( $var[ 'onewordbrand' ] == $com );
  } );
  $brand_ind = array_search( $com, array_column( $coms, 'onewordbrand' ) );
  $brand = $coms[ $brand_ind ][ 'brand' ];
  $CANONICAL = "https://www.rusavtomatika.com/weintek_drivers/?com=" . $com;
	$DESCRIPTION = 'Актуальные драйверы для оборудования '.$brand.', поддерживаемые Weintek.';
$TITLE = 'Драйверы для продукции '.$brand.' совместимой с Weintek';
} else {
  $drivers = $items;
  $brand = '';
}
clearstatcache();
$stat = stat( $drv_result );
?>
<article>
  <div id="app">
    <div id="rendering_content_source">
      <h1>Драйверы оборудования
        <? if ($brand != '') {echo(" ".$brand);} ?>
        , совместимого с панелями и ПЛК Weintek</h1>
      <p style="color:#B8B8B8; font-size: 0.8em;">Раздел обновлен <? echo date ("d.m.Y H:i:s", $stat['mtime'])." (МСК). В каталоге ".count($items)." драйверов по ".count($coms)." брендам."; ?></p>
      <div>
        <div style="min-width: 368px;">
          <input class="filterInput input" type="text" placeholder="Фильтр по тексту..." id="search" style="margin-right: 50px;">
        </div>
        <div style="min-width: 368px;">
          <details>
            <summary class="filtr">Фильтр по бренду</summary>
            <ul class="buttns">
              <li style="background: #00ad61; color: white;"><a href="/weintek_drivers/">Все</a></li>
              <?
              foreach ( $coms as $item ) {
                ?>
              <li><a href="/weintek_drivers/?com=<? echo $item['onewordbrand']; ?>"> <? echo $item['brand']; ?> </a></li>
              <? } ?>
            </ul>
          </details>
        </div>
        <div id="docs" class="sectionBlockFullSubSection">
          <div class="columns" style="margin: 0;">
            <div class="theader column is-5">Драйвер</div>
            <div class="theader column is-2">Модель</div>
            <div class="theader column is-2">Бренд</div>
            <div class="theader column is-1">Дата</div>
            <div class="theader column is-1">Размер</div>
            <div class="theader column is-1"></div>
          </div>
          <?
          $num = 1;
          foreach ( $drivers as $item ) {
            ?>
          <section>
            <div class="document">
              <div class="documentTableStringInfo">
                <div class="documentWrapperInfo<? if ( $item[ 'brand' ] != '') { echo(" columns");}?>">
                  <div class="documentTitle<? if ( $item[ 'brand' ] != '') { echo(" column is-5");}?>" style="word-wrap: break-word;word-break: break-all;
"><a target="_blank" href="<? echo( $down_path.$item[ 'fn' ] );?>"><? echo( $item[ 'Driver' ] );?></a></div>
                  <? if ( $item[ 'Model' ] != '') { ?>
                  <div class="documentTitle column is-2" style="word-wrap: break-word;word-break: break-all;"><? echo( $item[ 'Model' ] );?></div>
                  <? } ?>
                  <? if ( $item[ 'brand' ] != '') { ?>
                  <div class="documentTitle column is-2"><? echo( $item[ 'brand' ] );?></div>
                  <? } ?>
                  <div class="documentTitle column is-1"><? echo( $item[ 'fdata' ] );?></div>
                  <div class="documentTitle column is-1"><? echo( $item[ 'size' ] );?> Кб </div>
                  <div class="documentTitle column is-1" style="text-align: right;"><a href="<? echo( $down_path.$item[ 'fn' ] );?>" target="_blank">
                    <button>Скачать</button>
                    </a></div>
                </div>
              </div>
            </div>
          </section>
          <? $num++; } ?>
        </div>
      </div>
    </div>
  </div>
  <style type="text/css">
      .theader{
          background: #F5F5F5;
            color: #BFBFBF;
          padding: 7px 14px !important;
 		  text-transform: uppercase;
          font-size: 0.7rem;
          margin: 1px;
               }
	  .filtr {
		  display: block;
		  background: #00ad61;
		  color: white;
		  min-width: 328px;
		  padding: 8px 20px;
		  margin-bottom: 20px;
		  text-align: center;
		  text-transform: uppercase;
		  border-radius: 4px;
          cursor: pointer;
	  }
	  summary {
  &::-webkit-details-marker { display: none; }
  &::-moz-list-bullet { list-style-type: none; }
  // display: block; - не всегда уместно
}
// Иконка маркера в base64
$img-marker: 'data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjM0IiB2aWV3Qm94PSIwIDAgMjQgMjQiIHdpZHRoPSIzNCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cGF0aCBkPSJNOC41OSAxNi4zNGw0LjU4LTQuNTktNC41OC00LjU5TDEwIDUuNzVsNiA2LTYgNnoiLz48L3N2Zz4=';

details {

  // Косметические улучшения
  position: relative;
  margin-bottom: .5rem;
  min-height: 1rem;
  max-height: 3rem;
  transition: min-height .15s linear, max-height .5s linear;
  -webkit-transition: min-height .15s linear, max-height .15s linear;
  overflow: hidden;

  // Заголовок
  summary {

    // Удаление стандартного маркера
    &::-webkit-details-marker { display: none; }
    &::-moz-list-bullet { list-style-type: none; }

    // Ограничение кликабельной области заголовка
    display: inline-block;

    // Пространство для маркера
    padding-left: 1.5em;

    // Косметические улучшения
    cursor: pointer;
    outline: 0;
    transition: color .12s;
    -webkit-transition: color .12s;
    span { border-bottom: 1px currentColor dotted; }
    &:hover { color: #d06c6c; }

    // Добавление маркера
    &::before {
      content: "";
      left: 0;
      top: .4em;
      position: absolute;
      background: url($img-marker) no-repeat 50% 50% / 1em 1em;
      width: 1em;
      height: 1em;
      transition: transform .1s linear;
      -webkit-transition: transform .1s linear;
    }

    // Контент, стоящий после заголовка
    & ~ * {
      padding-left: 1.5em;
      opacity: 0;
      transition: opacity .15s linear;
      -webkit-transition: opacity .15s linear;
    }

  }

  // Открытый спойлер
  &[open] {
    min-height: 2em;
    max-height: 20em;
    summary {
      color: #d06c6c;
      & ~ * { 
        opacity: 1;
      }
      &:before { 
        transform: rotate(90deg);
        -webkit-transform: rotate(90deg);
        -moz-transform: rotate(90deg);
      }

    }

  }

}
// Фикс для IE 10-11 & Edge
@mixin ie_fix() {
  details {
    max-height: none;
    summary {

      & ~ * {
        max-height: 0;
        overflow: hidden;
        position: absolute; // IE испытывает проблемы с обычным max-height: 0;
      }

      &:focus {
        color: #d06c6c;

        &::before { 
          transform: rotate(90deg);
          -ms-transform: rotate(90deg);
         }

        & ~ * {
          max-height: 20em;
          position: static;
          opacity: 1;
        }

      }

    }
  }
}

// IE 10-11
@media screen and (-ms-high-contrast: active), (-ms-high-contrast: none) {
  @include ie_fix();
}

// Edge
@supports (-ms-ime-align:auto) {
  @include ie_fix();
}
	  .buttns li {
	display: flex;
	padding: 0;
	margin: 0 5px 5px 0;
	background: #EEEEEE;
	border: solid #ccc 1px;
}

.buttns {
	display: flex;
	width: 100%;
	list-style: none;
	flex-wrap: wrap;
	background: white;
	  }
.buttns a {
	display: flex;
	justify-content: center;
	align-items: center;
	padding: .3em .5em;
	font-weight: 300;
	font-size: 0.8rem;
	text-decoration: none;
	color: #4A4A4A;
}
	  
  #rendering_content_dest{
    display:block!important;
  }
  .filterInput{
    /*padding: 5px 4px;
    border: 1px solid #757171;
    font-size: 14px;
	width: 95% !important;*/
    margin-bottom: 5px;
  }
  #app{
    font-family: 'Roboto', sans-serif;
  }
  .sectionBlockFullSubSection{
    margin-bottom: 15px;
  }
  .documentTableStringLinks{
    width: 86px;
    vertical-align: middle!important;
  }
  .documentTableStringInfo{
    -webkit-flex: auto;
    	flex: auto;
    position:relative;
  }
  .documentTableStringInfo_date{
     margin: 0 15px;
  }
  .documentTableStringInfo_brand{
    width: 230px;
    margin: 0 15px;
  }
  .documentTranslateString{
    width: 100%;
  }
  .documentWrapperInfo{
    margin-left: 29px;

  }
  .documentFormatIcon{
    position: relative;
        float: left;
        display: block;
        padding: 0px;
        margin: 0px;
        height: 17px;
        min-height: auto;
        width: 17px;
        background-size: contain;
  }
  .slide-fade-enter-active {
    transition: all .25s ease;
  }
  .slide-fade-leave-active {
    transition: all .25s ease;
  }
  .slide-fade-enter,.slide-fade-leave-to{

    font-size: 0;
    margin: 0;
    opacity: 0;
    padding: 0;
  }



  .documents__contentTable tr > td {
    border: none;
    border-bottom: 1px dotted #ddd;
    padding: 0 15px 0 15px;
  }

  .documentTableStringLinks {
    text-align: right;
  }
  .documents__contentTable{
    border: none;
    width: 100%;
  }


  .sectionItem-arrow{
    display: inline-block;
    border-top: solid 4px rgb(0,0,0);
    border-left: solid 3px #000000;
    border-right: solid 3px #000000;
    position: absolute;
    right: 10px;
    top: 9px;
    height: 2px;

  }
  .sectionItem-arrow.active{
    border-left: solid 5px #00000000;
    border-right: solid 5px #00000000;
          border-top: solid 7px rgb(0,0,0);
  }
  .documentUrlOuter{
    display: inline-block;
  }
  .documentUrlLink{
    background: #44bb6e;
    color: white;
    text-decoration: none;
    padding: 2px 8px;
    user-select: none;
  }
  .documentUrlLink:hover{
    color: white;
    background: #34ab5e;

  }
  .documentTitle, .documentTableStringInfo_date{
	  /*font-size: 0.8em;*/
  }
  .documentTitle a{
	  text-decoration:none;
  }
  .documentTitle button{
	  color: white;
      padding: 5px 15px;
      border: 0;
      border-radius: 4px;
      background: #34ab5e;
      font-size: 0.7rem;
      text-transform: uppercase;
      text-align: center;
  }
  .subSection-item{

  }
  .section-item.active {
    background: #cce9cc;;
  }

  .subSection.active {
    background: #cce9cc;;
  }

  .subSection:hover  {
    background: #cce9cc;
  }
  .subSection-item-ancore{
    display: inline-block;
  }

  .sectionBlockFullSubSection-title{
    font-weight: 600;
    font-size: 16px;
    margin-left: 15px;
  }
  .section-item .section-item-ancore{
    <?/*?>text-decoration: underline;<?*/?>
    font-weight: 600;
    font-size: 16px;
  }


  .sideMenuDocument_sections .section{
    margin-bottom: 15px;
  }
  .sideMenuDocument_sections a{
    background: #f0f0f0;
    text-decoration: none;
    position: relative;
    color:#212121;
    display: block;
    margin-bottom: 3px;
    padding: 3px 10px;
  }
  .subSection{
    display:block;
  }


  .documents-enter {
    transform: scale(0.5) translatey(-80px);
    opacity:0;
  }

  .documents-leave-to{
    transform: translatey(30px);
    opacity:0;
  }

  .documents-leave-active {
    position: absolute;
    z-index:-1;
  }

  .document {
  display: -webkit-flex;
	display: flex;
	-webkit-flex-direction: row;
	flex-direction: row;
  flex-wrap:wrap;
  padding: 5px 0px 5px 15px;
  border-bottom: 1px dotted #b5b5b5;
}
.document:hover{
  background: #ececec;

}
	  #clear {
		  background-color: white;
    border-radius: 4px;
    color: #dbdbdb;
	-webkit-appearance: none;
    align-items: center;
    border: 1px solid #dbdbdb;
    box-shadow: none;
    display: inline-flex;
    font-size: 1rem;
    height: 2.5em;
    justify-content: flex-start;
    line-height: 1.5;
    padding-bottom: calc(0.5em - 1px);
    padding-left: calc(0.75em - 1px);
    padding-right: calc(0.75em - 1px);
    padding-top: calc(0.5em - 1px);
    position: relative;
    vertical-align: top;
	  }
</style>
</article>
<?

//include $_SERVER['DOCUMENT_ROOT'] . "/cms/core/epilog.php";
require_once $_SERVER[ 'DOCUMENT_ROOT' ] . "/abacus/epilog.php";

?>
<script> 
            $(document).ready(function() { 
                $("#search").on("keyup", function() { 
                    var value = $(this).val().toLowerCase(); 
                    $("#docs section").filter(function() { 
                        $(this).toggle($(this).text() 
                        .toLowerCase().indexOf(value) > -1) 
                    }); 
                }); 
            }); 
	  function clearSearch() {
    document.getElementById('search').value = '';
  }
        </script>