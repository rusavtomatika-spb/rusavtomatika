<?
global $CONTENT_ON_WIDE_SCREEN;
$CONTENT_ON_WIDE_SCREEN = false;
require_once $_SERVER[ 'DOCUMENT_ROOT' ] . "/abacus/prolog.php";
//CoreApplication::add_style(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/weintek_drivers_styles.css?" . rand());
//CoreApplication::add_script( str_replace( $_SERVER[ "DOCUMENT_ROOT" ], "", __DIR__ ) . "/documents.js" );
global $extra_openGraph;
$extra_openGraph = Array(
  "openGraph_image" => "http://www.rusavtomatika.com/upload_files/images/openGraph_images/weintek_libraries.png",
  "openGraph_title" => "Графические библиотеки Weintek",
  "openGraph_siteName" => "Русавтоматика"
);

global $TITLE, $DESCRIPTION, $KEYWORDS, $extra_openGraph;
$TITLE = 'Графические библиотеки Weintek';
$DESCRIPTION = '';
$KEYWORDS = '';


include $_SERVER[ 'DOCUMENT_ROOT' ] . "/cms/core/check_catalog_404.php";
global $TITLE, $KEYWORDS, $DESCRIPTION, $CANONICAL;
global $db;
$DESCRIPTION = 'Графические библиотеки Weintek';
$TITLE = 'Графические библиотеки Weintek';
$SERVER_PROTOCOL = $_SERVER[ 'SERVER_PROTOCOL' ] == "HTTP/1.1" ? "http://" : "https://";
$CANONICAL = $SERVER_PROTOCOL . "www.rusavtomatika.com/weintek_libraries/";
//include $_SERVER['DOCUMENT_ROOT'] . "/cms/core/prolog.php";
//include $_SERVER['DOCUMENT_ROOT'] . "/core/application/CoreApplication.php";


require '../sc/lib_new.php';

global $GLOBAL_ARR_SCRIPTS_TO_FOOTER;
$GLOBAL_ARR_SCRIPTS_TO_FOOTER[] = "/documents/documents.js";
$docs_filename = $_SERVER[ 'DOCUMENT_ROOT' ] . '/weintek_libraries__/libs.txt';
$down_path = '/upload_files/libraries_ra/';
$items = json_decode( file_get_contents( $docs_filename ), true ); // JSON с документами weintek
?>

<article>
  <div id="app">
    <div id="rendering_content_source">
      <h1>Графические библиотеки Weintek</h1>
      <div style="width:100%; text-align:right; "><p style="color:#B8B8B8; font-size: 0.8em;">Раздел обновлен <? echo date ("d.m.Y H:i:s", filemtime($docs_filename))." (МСК)"; ?></p></div>
      <div style="padding-left:5px;">
        <input class="filterInput input" type="text" placeholder="Фильтр по названию..." id="search"/>
        <div id="docs" class="items" style="margin-top: 25px;">
          <?
			$i = 0;
          foreach ( $items as $item ) {
			  $i++;
			  $img_name = 'https://rusavtomatika.com/upload_files/libraries_ra/images/'.$item[ 'image' ];
            ?>
          <section>
            <div class="item_gr">
				<div class="item_title"><p>
                <?
                $title = $item[ 'title' ];
                $title = preg_replace( '"(\(English\))"', ' (English)', $title );
                $title = preg_replace( '"(Auido \/ Video Samll 01)"', 'Audio/Video Small 01', $title );
                echo( $title );
                ?></p>
                </div><a href="<? 
                                echo $img_name ?>" data-fancybox>
				<img style="min-width: 140px; width: 305px; top:40px;left:0; position:absolute;" src="<? 
									echo( $img_name );?>" alt="<? echo( $title );?>" loading="lazy" /></a>
              <div class="columns" style="margin: 0; padding:0; width:305px; bottom: 0;position: absolute;">
                <div class="column is-4 info"><span>[ <? echo( $item[ 'mod_data' ] )?> ]</span></div>
                <div class="column is-4 info"><span>[ <? echo( $item[ 'size' ] )?> ]</span></div>
                <div class="column is-4 downl"><a href="<? echo $down_path.$item[ 'put' ]."/".$item[ 'fname' ] ;?>">СКАЧАТЬ</a></div>
              </div>
			  </div>
          </section>
			          <?  } ?>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
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
		  width: 305px; 
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
		  border: 1px solid #EEE;
	  }
	  .downl {
		  text-align: center; 
		  background: #00ad61;
		  width: 100%; 
		  margin-bottom: 0;
		  padding: 0;
		  font-size: 0.7em;
  		  border: 1px solid #00ad61;

	  }
	  .downl a, .downl a:hover  {
		  color: white;
		  text-decoration: none;
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
	  font-size: 0.8em;
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