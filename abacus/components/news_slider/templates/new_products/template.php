<?php
CoreApplication::add_style( str_replace( $_SERVER[ "DOCUMENT_ROOT" ], "", __DIR__ ) . "/style.css" );
$arResult[ "items" ] = CoreApplication::get_rows_from_table( "`new_products`", "date,name,url_page_detail2,text_preview,picture_preview", "`onmainpage` = '1'", "date DESC", 15 );
$arResultPrall = CoreApplication::get_rows_from_table( "`products_all`", "model", "`status` != '0'" );
$models = array();
function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);
    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
foreach ($arResultPrall as $k) {
	array_push($models, $k["model"]);
}

//$arResulAll["items"] = array_intersect($arResult["items"],$arResultPrall["items"]);
$count = count( $arResult[ "items" ] );
if ( $count > 0 ):
//print_r($models);
  ?>
<div class="glide" id="glide_new_products">
  <div class="glide__track" data-glide-el="track" style="padding-bottom: 2.5rem !important;">
    <ul class="glide__slides">
      <?

      for ( $x = 0; $x < $count; $x++ ) {
        if ( isset( $arResult[ "items" ][ $x ] ) ) {
            $item = $arResult[ "items" ][ $x ];
			$iturl = $item[ "url_page_detail2" ];
			$iturl = explode('/',$iturl);
			$model = $iturl[2];
			debug_to_console($model);
          if (in_array($model, $models )) {
            $d = new DateTime( $item[ "date" ] );
            $item[ "date" ] = $d->format( 'd.m.Y' );

            $item[ "stext" ] = $item[ "text_preview" ];
            $item[ "img" ] = $item[ "picture_preview" ];


            $text = strip_tags( $item[ "stext" ] );
            $text = substr( $text, 0, 150 );
            $text = rtrim( $text, "!,.-" );
            $text = substr( $text, 0, strrpos( $text, ' ' ) );
            $text = $text . "… ";
            include __DIR__ . "/template_common_item1.php";
          }
        }
      }
      $item[ "name" ] = "Смотреть все новинки";
      $item[ "url_page_detail" ] = "/new-products/";
      include __DIR__ . "/template_common_item_link_to_all.php";
      ?>
    </ul>
  </div>
  <div class="glide__arrows" data-glide-el="controls">
    <button class="glide__arrow glide__arrow--left" data-glide-dir="<"></button>
    <button class="glide__arrow glide__arrow--right" data-glide-dir=">"></button>
  </div>
</div>
<?php
endif;
?>
