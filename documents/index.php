<?
global $CONTENT_ON_WIDE_SCREEN;
$CONTENT_ON_WIDE_SCREEN = false;
require_once $_SERVER[ 'DOCUMENT_ROOT' ] . "/abacus/prolog.php";
//CoreApplication::add_style(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/weintek_drivers_styles.css?" . rand());
//CoreApplication::add_script( str_replace( $_SERVER[ "DOCUMENT_ROOT" ], "", __DIR__ ) . "/documents.js" );
global $extra_openGraph;
$extra_openGraph = array(
  "openGraph_image" => "http://www.rusavtomatika.com/upload_files/images/openGraph_images/weintek_drivers.png",
  "openGraph_title" => "Weintek документы, руководство, мануалы, документация",
  "openGraph_siteName" => "Русавтоматика"
);

include $_SERVER[ 'DOCUMENT_ROOT' ] . "/cms/core/check_catalog_404.php";
global $TITLE, $KEYWORDS, $DESCRIPTION, $CANONICAL;
global $db;
$DESCRIPTION = 'Ежедневно обновляемые документы, руководства, мануалы, FAQ по продукции Weintek';
$TITLE = 'Weintek документы, руководство, мануалы, документация';
$SERVER_PROTOCOL = $_SERVER[ 'SERVER_PROTOCOL' ] == "HTTP/1.1" ? "http://" : "https://";
$CANONICAL = "https://www.rusavtomatika.com/documents/";
//include $_SERVER['DOCUMENT_ROOT'] . "/cms/core/prolog.php";
//include $_SERVER['DOCUMENT_ROOT'] . "/core/application/CoreApplication.php";


require $_SERVER[ 'DOCUMENT_ROOT' ] . '/sc/lib_new.php';

global $GLOBAL_ARR_SCRIPTS_TO_FOOTER;
$GLOBAL_ARR_SCRIPTS_TO_FOOTER[] = "/documents/documents.js";
$docs_result = $_SERVER[ 'DOCUMENT_ROOT' ] . '/documents/docs_result.txt';
$items = json_decode( file_get_contents( $docs_result ), true ); // JSON с документами weintek
$total_docs = count( $items );
$sections = array(
  "Среда разработки EasyBuilder Pro" => "ebpro",
  "Удаленный доступ EasyAccess 2.0" => "ea20",
  "Серия cMT" => "cmt",
  "Серия MT8000iP" => "mt8000ip",
  "Серия MT8000iE" => "mt8000ie",
  "Серия mTV" => "mtv",
  "Серия eMT3000" => "emt3000",
  "Модули ввода-вывода серии iR" => "moduli",
  "Руководства по подключению ПЛК" => "plc",
  "Разное" => "other",
  "Часто задаваемые вопросы (FAQ)" => "faq" );
$sections = array_flip( $sections );
if ( isset( $_GET[ "docsection" ] ) ) {
  $docsec = $_GET[ "docsection" ];
} else {
  $docsec = "ebpro";
}
$docsec_name = $sections[ $docsec ];
$docs = array_filter( $items, function ( $var )use( $docsec ) {
  return ( $var[ 'section' ] == $docsec );
} );
$weekago = time() - 600000;
$fresh = array_filter( $items, function ( $var )use( $weekago ) {
  return ( $var[ 'mod_data' ] >= $weekago );
} );
$titf = array_column( $fresh, 'mod_data' );
array_multisort( $titf, SORT_DESC, $fresh );
$tit = array_column( $docs, 'mod_data' );
array_multisort( $tit, SORT_DESC, $docs );
//file_put_contents( $docs_result, json_encode( $final_json ) );
?>
<article>
  <div id="app">
    <div id="rendering_content_source">
      <h1>Документы - Weintek - <? echo ( $docsec_name );
      setTitle( $docsec_name . ': документы, руководство, мануалы, документация', '', 'Ежедневно обновляемые документы, руководства, мануалы, FAQ - ' . $docsec_name );
      ?></h1>
      <p style="color:#B8B8B8; font-size: 0.8em;">Раздел обновлен
        <? clearstatcache(); echo date("d.m.Y H:i:s", file_get_contents($_SERVER[ 'DOCUMENT_ROOT' ] . '/documents/update.txt'));?>
        (МСК). Общее количество документов: <? echo $total_docs; ?></p>
      <div class="columns">
        <div class="column is-3 sideMenuDocument_sections">
          <div class="section2"><a class="section-item router-link-active active"><span class="section-item-ancore">Weintek</span>
            <div class="sectionItem-arrow active"></div>
            </a>
            <transition name="slide-fade">
              <div class="section_inner"><a href="?docsection=ebpro" class="subSection subSection-item router-link-active"><span class="subSection-item-ancore">Среда разработки EasyBuilder Pro</span></a> </div>
              <div class="section_inner"><a href="?docsection=ea20" class="subSection subSection-item router-link-active"><span class="subSection-item-ancore">Удаленный доступ EasyAccess 2.0</span></a> </div>
              <div class="section_inner"><a href="?docsection=cmt" class="subSection subSection-item router-link-active"><span class="subSection-item-ancore">Серия cMT</span></a> </div>
              <div class="section_inner"><a href="?docsection=mt8000ip" class="subSection subSection-item router-link-active"><span class="subSection-item-ancore">Серия MT8000iP</span></a> </div>
              <div class="section_inner"><a href="?docsection=mt8000ie" class="subSection subSection-item router-link-active"><span class="subSection-item-ancore">Серия MT8000iE</span></a> </div>
              <div class="section_inner"><a href="?docsection=mtv" class="subSection subSection-item router-link-active"><span class="subSection-item-ancore">Серия mTV</span></a> </div>
              <div class="section_inner"><a href="?docsection=emt3000" class="subSection subSection-item router-link-active"><span class="subSection-item-ancore">Серия eMT3000</span></a> </div>
              <div class="section_inner"><a href="?docsection=moduli" class="subSection subSection-item router-link-active"><span class="subSection-item-ancore">Модули ввода-вывода серии iR</span></a> </div>
              <div class="section_inner"><a href="?docsection=faq" class="subSection subSection-item router-link-active"><span class="subSection-item-ancore">Часто задаваемые вопросы (FAQ)</span></a> </div>
              <div class="section_inner"><a href="/weintek_drivers/" class="subSection subSection-item router-link-active"><span class="subSection-item-ancore">Руководства по подключению ПЛК</span></a> </div>
              <div class="section_inner"><a href="?docsection=other" class="subSection subSection-item router-link-active"><span class="subSection-item-ancore">Разное</span></a> </div>
            </transition>
          </div>
          <br>
          <br>
          <? if (count($fresh) > 0) {?>
          <div class="section2" style="font-size: 0.7rem;font-weight: 300;"><a class="section-item router-link-active active"><span class="section-item-ancore">Недавно обновлённые документы</span> </a>
            <?
            foreach ( $fresh as $item ) {

              ?>
            <div class="section_inner"><a id="doc_EBPro" target="_blank" href="<? echo( '/upload_files/documents/weintek/'.$item[ 'put' ]."/".$item[ 'fname' ] );?>">[
              <?
              if ( $item[ 'mod_data' ] != 'N/A' ) {
                echo( date( "d.m.Y", $item[ 'mod_data' ] ) );
              } else {
                echo 'N/A';
              }
              ?>
              ] <? echo( $item[ 'title' ] );?></a></div>
            <?  } ?>
          </div>
          <?  } ?>
        </div>
        <div class="column is-9" style="padding-left:5px">
          <div> 
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
            <input class="filterInput input" type="text" placeholder="Фильтр по названию или дате..." id="search"/>
            <p style="color:#B8B8B8; font-size: 0.8em; text-align: right;">Документы отсортированы по дате</p>
            <div id="docs" class="sectionBlockFullSubSection">
              <?
              $num = 1;
              foreach ( $docs as $item ) {
				$days_difference = floor( abs( time() - $item[ 'mod_data' ] ) / 86400 );
                if ( $days_difference < 6 ) {
                  $new = ' <span class="new-label">NEW</span>';
                } else {
                  $new = '';
                }

                ?>
              <section>
                <div class="document">
                  <div class="documentTableStringInfo"><span class="download_icon documentFormatIcon download_pdf"></span>
                    <div class="documentWrapperInfo columns">
                      <div class="documentTitle<? if ( $item[ 'brand' ] != '') { echo(" column is-6");}else{echo(" column is-10");}?>"><a id="doc_EBPro" target="_blank" href="<? echo( '/upload_files/documents/weintek/'.$item[ 'put' ]."/".$item[ 'fname' ] );?>"><? echo( $item[ 'title' ] );?></a><? echo( $new );?></div>
                      <? if ( $item[ 'brand' ] != '') { ?>
                      <div class="documentTitle column is-4"><? echo( $item[ 'brand' ] );?></div>
                      <? } ?>
                      <div class="documentTableStringInfo_date column is-2"><span>
                        <?
                        if ( $item[ 'mod_data' ] != 'N/A' ) {
                          echo( date( "d.m.Y", $item[ 'mod_data' ] ) );
                        } else {
                          echo 'N/A';
                        }
                        ?>
                        </span> </div>
                    </div>
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
</style>
  <script>


</script>
  <?/* asdasdasdasdasdasd
<script>
$( document ).ready(function() {

this.loading_status = true;
axios({
method: 'POST',
url: '/documents/documents_get_ajax.php',
data: {

},
headers: {
"Content-type": "application/x-www-form-urlencoded"
}
}).then((response) => {
this.loading_status = false;
$(".documents_list").html(response.data);

});

});
</script>
*/?>
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