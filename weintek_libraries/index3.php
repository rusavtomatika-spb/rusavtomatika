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

global $TITLE, $DESCRIPTION, $KEYWORDS, $extra_openGraph, $CANONICAL;
$TITLE = 'Графические библиотеки Weintek';
$DESCRIPTION = 'Ваши проекты достойны качественного дизайна. Используйте библиотеки графики Weintek при разработке проектов.';
$CANONICAL = "https://www.rusavtomatika.com/weintek_libraries/";


include $_SERVER[ 'DOCUMENT_ROOT' ] . "/cms/core/check_catalog_404.php";
global $db;
//include $_SERVER['DOCUMENT_ROOT'] . "/cms/core/prolog.php";
//include $_SERVER['DOCUMENT_ROOT'] . "/core/application/CoreApplication.php";

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

require '../sc/lib_new.php';

global $GLOBAL_ARR_SCRIPTS_TO_FOOTER;
$GLOBAL_ARR_SCRIPTS_TO_FOOTER[] = "/documents/documents.js";
$docs_filename = $_SERVER[ 'DOCUMENT_ROOT' ] . '/weintek_libraries/libs.txt';
$items = json_decode( file_get_contents( $docs_filename ), true ); // JSON с документами weintek
clearstatcache();
$stat = stat( $docs_filename );
?>
<article>
  <div id="app">
    <div id="rendering_content_source">
      <h1>Графические библиотеки Weintek</h1>
      <div style="width:100%; text-align:right; ">
        <p style="color:#B8B8B8; font-size: 0.8em;">Раздел обновлен <? echo date ("d.m.Y H:i:s", $stat['mtime'])." (МСК)"; ?> | <a href="https://www.rusavtomatika.com/upload_files/libraries/libs-by-rusavtomatika.com.zip">Все графические библиотеки Weintek</a> одним архивом</p>
      </div>
      <div style="padding-left:5px;">
        <input class="filterInput input" type="text" placeholder="Фильтр по названию..." id="search"/>
        <div class="fixed-grid has-3-cols-desktop has-4-cols-widescreen	 has-2-cols-tablet has-1-cols-mobile mt-5">
          <div class="grid" id="docs">
            <?
            $i = 0;
            foreach ( $items as $item ) {
              $i++;
              ?>
              <section>
            <div class="cell">
                <div class="card">
                  <header class="card-header">
                      <p class="card-header-title">
                        <?
                        $title = $item[ 'title' ];
                        $title = preg_replace( '"(\(English\))"', ' (English)', $title );
                        $title = preg_replace( '"(Auido \/ Video Samll 01)"', 'Audio/Video Small 01', $title );
                        echo( $title );
                        $img_url = 'https://www.rusavtomatika.com/upload_files/libraries/images/' . $item[ 'fname' ];
                        $img_name = preg_replace( '"\.zip$"', '.gif', $img_url );
                        $img_name = preg_replace( '"(\(sqr_y\))"', '(sqr_yl)', $img_name );
                        $img_name = preg_replace( '"(Containers\.)"', 'Container_1.', $img_name );
                        $img_name = preg_replace( '"(Containers_2\.)"', 'Container_2.', $img_name );
                        $img_name = preg_replace( '"(Mixers\.)"', 'Mixer.', $img_name );
                        $img_name = preg_replace( '"(Pipes\.)"', 'pipes.', $img_name );
                        $img_name = preg_replace( '"(Pipes_12p\.)"', 'pipes_12p.', $img_name );
                        $img_name = preg_replace( '"(Process_Heating\.)"', 'Process_heating.', $img_name );
                        $img_name = preg_replace( '"(Process_Heating_2\.)"', 'Process_heating_2.', $img_name );
                        $img_name = preg_replace( '"(motor_01\.)"', 'Motor_01.', $img_name );
                        $img_name = preg_replace( '"(Pipes_03\.)"', 'pipes_03.', $img_name );
                        $img_name = preg_replace( '"(Pipes_04\.)"', 'pipes_04.', $img_name );
                        $img_name = preg_replace( '"(Pipes_05\.)"', 'pipes_05.', $img_name );
                        $img_name = preg_replace( '"(Pipes_small_01\.)"', 'pipes_small_01.', $img_name );
                        $img_name = preg_replace( '"(Building_01\.)"', 'building_01.', $img_name );
                        $img_name = preg_replace( '"(Boiler_01\.)"', 'boiler_01.', $img_name );
                        $img_name = preg_replace( '"(Fan_01\.)"', 'fan_01.', $img_name );
                        $img_name = preg_replace( '"(Cooling_01\.)"', 'cooling_01.', $img_name );
                        $img_name = preg_replace( '"(Icon_01\.)"', 'icon_01.', $img_name );
                        $img_name = preg_replace( '"(Arrow_01\.)"', 'arrow_01.', $img_name );
                        $img_name = preg_replace( '"(Arrow_02\.)"', 'arrow_02.', $img_name );
                        $img_name = preg_replace( '"(Audo_Video_Small_01\.)"', 'audio_video_small_01.', $img_name );
                        $img_name = preg_replace( '"(Arrow_Small_01\.)"', 'arrow_small_01.', $img_name );
                        $img_name = preg_replace( '"(Arrow_Small_02\.)"', 'arrow_small_02.', $img_name );
                        $img_name = preg_replace( '"(Button_05\.)"', 'button_05.', $img_name );
                        $img_name = preg_replace( '"(Button_06\.)"', 'button_06.', $img_name );
                        $img_name = preg_replace( '"(Fire_Ice_01\.)"', 'fire_ice_01.', $img_name );
                        $img_name = preg_replace( '"(Hoppers_01\.)"', 'hoppers_01.', $img_name );
                        ?>
                      </p>
                  </header>
                  <div class="card-image" style="background: #ECE9D8;">
                    <figure class="image is-4by3"><a href="<? echo( $img_name );?>" data-fancybox><img src="<? echo( $img_name );?>" alt="<? echo( $title );?> image" alt="<? echo( $img_name );?>" loading="lazy"  /></a></figure>
                  </div>
                  <footer class="card-footer">
					  <span class="card-footer-item">[ <? echo( $item[ 'mod_data' ] )?> ]</span> 
					  <span class="card-footer-item">[ <? echo( formatSizeUnits($item[ 'size' ]) )?> ]</span> 
					  <a class="card-footer-item downl" href="https://www.rusavtomatika.com/upload_files/libraries/<? echo( $item[ 'fname' ] )?>">СКАЧАТЬ</a> 
					</footer>
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
  		  border: 1px solid #00ad61;
		  color: white !important;
	  }
	  .downl a, .downl a:hover  {
		  color: white !important;
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
footer.card-footer {
    background-color: transparent !important;
    border-top: 1px solid #ededed !important;
    align-items: stretch !important;
    display: flex !important;
	font-size: 0.7rem;
    padding: 0;
    margin: 0;
    background: #eee;
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