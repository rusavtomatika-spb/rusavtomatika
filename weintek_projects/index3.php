<?
global $CONTENT_ON_WIDE_SCREEN;
$CONTENT_ON_WIDE_SCREEN = false;
require_once $_SERVER[ 'DOCUMENT_ROOT' ] . "/abacus/prolog.php";
//CoreApplication::add_style(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/weintek_drivers_styles.css?" . rand());
//CoreApplication::add_script( str_replace( $_SERVER[ "DOCUMENT_ROOT" ], "", __DIR__ ) . "/documents.js" );


global $extra_openGraph;
$extra_openGraph = array(
  "openGraph_image" => "https://www.rusavtomatika.com/upload_files/images/openGraph_images/weintek_projects.png",
  "openGraph_title" => "Weintek проекты и макросы | демо для скачивания",
  "openGraph_siteName" => "Русавтоматика"
);

global $TITLE, $DESCRIPTION, $KEYWORDS, $extra_openGraph, $CANONICAL;
$TITLE = 'Weintek проекты и макросы | демо для скачивания';
$DESCRIPTION = 'Weintek предоставляет множество различных функциональных демонстрационных проектов для вашего ознакомления. Они помогут Вам внедрить новые функции в свой проект.';
$KEYWORDS = '';
$CANONICAL = "https://www.rusavtomatika.com/weintek_projects/";


include $_SERVER[ 'DOCUMENT_ROOT' ] . "/cms/core/check_catalog_404.php";

global $db;
$SERVER_PROTOCOL = $_SERVER[ 'SERVER_PROTOCOL' ] == "HTTP/1.1" ? "http://" : "https://";
//include $_SERVER['DOCUMENT_ROOT'] . "/cms/core/prolog.php";
//include $_SERVER['DOCUMENT_ROOT'] . "/core/application/CoreApplication.php";


require '../sc/lib_new.php';
if ( isset( $_GET[ "section" ] ) ) {
  $ask_d = ( trim( strip_tags( $_GET[ "section" ] ) ) );
  //$ask_d = iconv('UTF-8', 'windows-1251', $ask_d);
  $PROJECTS_FILTER_STRING = " `category` LIKE '%{$ask_d}%' AND ";
  $PROJECTS_ASK_STRING = " (" . $ask_d . ")";
} else {
  $ask_d = array( "Part_Sample", "PLC_Sample", "Macro_Sample", "System_Sample", "Application_sample", "CODESYS_Sample" );
}
$TITLE = 'Weintek проекты и макросы | демо для скачивания';
$H1 = 'Демо проекты и макросы Weintek для скачивания';
if ( $ask_d ) {
  switch ( $ask_d ) {
    case "Part_Sample":
      $TITLE = "Демо ПРОЕКТЫ Weintek | скачать";
      $H1 = 'Объекты EBPro - демо проекты Weintek для скачивания';
      break;
    case "PLC_Sample":
      $TITLE = "ПЛК(PLC) - демо проекты Weintek | скачать, контроллер, подключение к контроллерам, connection guide";
      $H1 = 'Демо проекты Weintek для скачивания - ПЛК(PLC)';
      break;
    case "Macro_Sample":
      $TITLE = "Макросы Weintek секундомер, открытия окна, время, инструкция, биты 0x03, закрытия окна, язык, калькулятор";
      $H1 = "Макросы Weintek - для скачивания";
      break;
    case "System_Sample":
      $TITLE = "Проекты Weintek | Функции, примеры решения задач | скачать";
      $H1 = "Функции, примеры решения задач - демо проекты Weintek для скачивания";
      break;
    case "Application_sample":
      $TITLE = "Демо проекты Weintek | Комплексные примеры проектов | Скачать";
      $H1 = "Комплексные примеры проектов - демо проекты Weintek для скачивания";
      break;
    case "CODESYS_Sample":
      $TITLE = "Демо проекты Weintek | CODESYS и модули ввода-вывода | Скачать";
      $H1 = "CODESYS и модули ввода-вывода - демо проекты Weintek для скачивания";
      break;
    default:
      $TITLE = 'Weintek проекты - демо для скачивания';
      $H1 = 'Weintek проекты - демо для скачивания';
      break;
  }
}

global $GLOBAL_ARR_SCRIPTS_TO_FOOTER;
$GLOBAL_ARR_SCRIPTS_TO_FOOTER[] = "../documents/documents.js";
$proj_folder = $_SERVER[ 'DOCUMENT_ROOT' ] . '/weintek_projects/';
$docs_result = $proj_folder . 'pr.txt';
$down_path = '/upload_files/projects/';
$items = json_decode( file_get_contents( $docs_result ), true ); // JSON с документами weintek
$total_docs = count( $items );
if ( isset( $_GET[ "section" ] ) ) {
  $docsec = $_GET[ "section" ];
} else {
  $docsec = "";
}
//$docsec_name = $sections[ $docsec ];
if ( $docsec != "" ) {
  $docs = array_filter( $items, function ( $var )use( $docsec ) { /////////////// на разработку отключил фильтрацию
    return ( $var[ 'section_get' ] == $docsec );
  } );
} else {
  $docs = $items;
}

function formatSizeUnits( $bytes ) {
  if ( $bytes >= 1073741824 ) {
    $bytes = number_format( $bytes / 1073741824, 2 ) . ' GB';
  } elseif ( $bytes >= 1048576 ) {
    $bytes = number_format( $bytes / 1048576, 2 ) . ' MB';
  }
  elseif ( $bytes >= 1024 ) {
    $bytes = number_format( $bytes / 1024, 2 ) . ' KB';
  }
  elseif ( $bytes > 1 ) {
    $bytes = $bytes . ' bytes';
  }
  elseif ( $bytes == 1 ) {
    $bytes = $bytes . ' byte';
  }
  else {
    $bytes = '0 bytes';
  }
  return $bytes;
}
clearstatcache();
$stat = stat( $docs_result );
?>
<article>
  <div id="app">
    <div id="rendering_content_source">
      <h1><? echo($H1); ?></h1>
      <p style="color:#B8B8B8; font-size: 0.8em;">Раздел обновлен <? echo date ("d.m.Y H:i:s", $stat['mtime'])." (МСК). Общее количество документов: ".$total_docs; ?></p>
      <div>
        <ul class="projects_tabs">
          <li><a href="/weintek_projects<?=EX?>/" data-rel="" <? if ($ask_d == "") echo ' class="active" '; ?>>ВСЕ</a></li>
          <li><a href="/weintek_projects<?=EX?>/?section=HMI_Sample" data-rel="HMI Sample" <? if ($ask_d == "HMI_Sample") echo ' class="active" '; ?>>Демо-проекты</a>
          <li><a href="/weintek_projects<?=EX?>/?section=Part_Sample" data-rel="Part Sample" <? if ($ask_d == "Part_Sample") echo ' class="active" '; ?>>Объекты EBPro</a>
          <li><a href="/weintek_projects<?=EX?>/?section=PLC_Sample" data-rel="PLC Sample" <? if ($ask_d == "PLC_Sample") echo ' class="active" '; ?>>ПЛК</a>
          <li><a href="/weintek_projects<?=EX?>/?section=Macro_Sample" data-rel="Macro Sample" <? if ($ask_d == "Macro_Sample'") echo ' class="active" '; ?>>Макросы</a>
          <li><a href="/weintek_projects<?=EX?>/?section=System_Sample" data-rel="System Sample" <? if ($ask_d == "System_Sample") echo ' class="active" '; ?>>Функции, примеры решения задач</a>
          <li><a href="/weintek_projects<?=EX?>/?section=Application_sample" data-rel="Application sample" <? if ($ask_d == "Application_sample") echo ' class="active" '; ?>>Комплексные примеры проектов</a>
          <li><a href="/weintek_projects<?=EX?>/?section=CODESYS_Sample" data-rel="CODESYS Sample" <? if ($ask_d == "CODESYS_Sample") echo ' class="active" '; ?>>CODESYS и модули ввода-вывода</a>
          <li>
        </ul>
        <input class="filterInput input" type="text" placeholder="Фильтр по тексту..." id="search"/>
        <div style="padding-left:5px">
          <div class="fixed-grid has-3-cols-desktop has-3-cols-widescreen	has-2-cols-tablet has-1-cols-mobile mt-5"> 
            <!--button
                title = "Очистить поле поиска"
                type = "reset"
                class = "is-active"
				style="float: right" 
				id="clear"
				 onclick="clearSearch()"
              >
                X
              </button--> 
            <!--input class="filterInput input" type="text" placeholder="Фильтр по названию или дате..." id="search"/-->
            <div id="docs" class="grid">
              <?
              $num = 1;
              foreach ( $docs as $item ) {
                ?>
              <section>
                <div class="cell">
                  <div class="card">
                    <header class="card-header">
                      <h4 class="card-header-title"><? echo( $item[ 'title' ] )?></h4>
                    </header>
                    <div class="card-image" style="background: #ECE9D8;">
                      <figure class="image is-fullwidth has-ratio"><a href="<? print 'https://rusavtomatika.com/upload_files/projects/images/'.$item[ 'image' ]; ?>" data-fancybox><img src="<? print 'https://rusavtomatika.com/upload_files/projects/images/'.$item[ 'image' ]; ?>" alt="<? echo( $item[ 'title' ] );?> image" loading="lazy"  /></a></figure>
                    </div>
					  <? if ( $item[ 'stext' ] != '' ) { ?>
                    <div class="card-content">
                      <div class="content"><? echo( $item[ 'stext' ] )?></div>
                    </div>
					  <? } ?>
                  <footer class="card-footer">
					  <span class="card-footer-item">[ <? echo( date("m.d.Y",$item[ 'mod_data' ]) )?> ]</span> 
					  <span class="card-footer-item">[ <? echo( formatSizeUnits($item[ 'size' ]) )?> ]</span> 
					  <a class="card-footer-item downl" href="<? echo $down_path.$item[ 'put' ]."/".$item[ 'fname' ] ;?>">СКАЧАТЬ</a> 
					</footer>

                  </div>
                </div>
              </section>
              <? $num++; } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
  <style>
          <style style="">
	  .item_title {
		  margin: 0; padding:0; width:300px;
			width: 303px; 
		  background: #fff;
		  padding: 0;
          color: #535353;
		  margin-bottom: 0;
		  position: absolute;
		  top:0;
	  }
	  .flex {
		  display: flex; 
		  flex-direction: row; 
		  flex-wrap: wrap; 
		  justify-content: flex-start; 
		  align-items: flex-start; 
		  align-content: flex-start;
	  }
	  .items {
		  width: 100%; 
		  display: flex; 
		  flex-direction: row; 
		  flex-wrap: wrap; 
		  justify-content: flex-start; 
		  align-items: flex-start; 
		  align-content: flex-start;
	  }
	  .item_gr {
		  min-width: 150px; 
		  text-align: center; 
		  width: 48%; 
		  margin: 0 25px 25px 0; 
		  height:350px; 
		  border: 1px solid #EEE;
		  position: relative;
		  background: #EEE;
	  }
	  .info {
		  text-align: center; 
		  width: 100%; 
		  background: #fff;
		  padding: 0;
          color: #535353;
		  font-size: 0.7em;
		  margin-bottom: 0;
		  border-right: 1px solid #EEE;
	  }
	  .downl {
		  text-align: center; 
		  background: #00ad61;
		  width: 100%; 
		  margin-bottom: 0;
		  padding: 0;
  		  border-left: 1px solid #00ad61;
		  color: white !important;
	  }
	  .downl a, .downl a:hover  {
		  color: white !important;
		  text-decoration: none;
	  }
        .descr {
            font-size: 0.8rem;
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
word-wrap: normal ;
      word-break: all;
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
.projects_tabs {
    display: block;
}
.projects_tabs li {
    display: inline-block;
    padding: 0;
    margin: 0 1px;
}
.projects_tabs li a {
    display: inline-block;
    text-decoration: none;
    font-size: 0.8rem;
    padding: 7px 10px;
    text-align: center;
    background: #fff;
    cursor: pointer;
    transition: 0.2s;
    border: 1px solid #e0e0e0;
    border-radius: 4px;
}
.projects_tabs li a.active {
    background: #00ad61;
    color: #fff;
    border: 1px solid #00ad61;
}
.projects_tabs li a:hover {
    background: #00ad61;
    color: #fff;
    border: 1px solid #00ad61;
}
.projects_tabs li a.active:hover {
    cursor: pointer;
}
footer.card-footer {
    background-color: transparent !important;
    border-top: 1px solid #ededed !important;
    align-items: stretch !important;
    display: flex !important;
	font-size: 0.8rem;
    padding: 0;
    margin: 0;
    background: #eee;
	  }

</style>
  <script>


</script>
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