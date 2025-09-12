<?php


CoreApplication::add_style( str_replace( $_SERVER[ "DOCUMENT_ROOT" ], "", __DIR__ ) . "/style.css" );


$current_brand = trim( ( $arguments[ "component_route_params" ][ "brand" ] ), "_" );

//var_dump_pre($current_brand);


$arr_brands = CoreApplication::get_rows_from_table( "`catalog_brands`", "", "active='1' and code='$current_brand' ", "position ASC" );

$arr_sections = CoreApplication::get_rows_from_table( "`catalog_sections`", "", "`is_main_item` = '1' and active='1' and FIND_IN_SET('$current_brand', filter_brands)>0 ", "position ASC" );


if ( isset( $arr_brands[ 0 ] ) ) {

  $arResult = $arr_brands[ 0 ];


  CoreApplication::add_breadcrumbs_chain( $arResult[ 'name' ] );

  CoreApplication::include_component( array( "component" => "breadcrumbs" ) );


  global $TITLE, $DESCRIPTION, $CANONICAL;

  if ( isset( $arResult[ 'title' ] )and $arResult[ 'title' ] != "" ) {

    $TITLE = $arResult[ 'title' ];

  } else {

    $TITLE = $arResult[ 'name' ] . " - www.rusavtomatika.com";

  }

  if ( isset( $arResult[ 'preview_text' ] )and $arResult[ 'preview_text' ] != "" ) {

    $DESCRIPTION = $arResult[ 'preview_text' ];

  } else {

    $DESCRIPTION = $arResult[ 'name' ] . " - www.rusavtomatika.com";

  }
$CANONICAL = "https://www.rusavtomatika.com".$arResult[ 'brand_page_link' ];
  ?>
<div class="component_catalog_brand__body">
  <div class="component_catalog_brand">
    <div class="columns is-multiline">
      <div class="column">
        <div class="columns is-multiline">
          <div class="column  <? // if (isset($arResult['certificate_preview_picture']) and $arResult['certificate_preview_picture'] != '') { echo "is-8"; } ?> ">
            <div class="component_catalog_brand__head">
              <?php

              if ( isset( $arResult[ 'h1' ] )and $arResult[ 'h1' ] != "" ) {

                $H1 = $arResult[ 'h1' ];

              } else {

                $H1 = $arResult[ 'name' ];

              }

              ?>
              <h1 class="title">
                <?= $H1 ?>
              </h1>
              <div class="component_catalog_brand__logo"> <img src="<?= $arResult['preview_picture'] ?>" alt="<?= $arResult['name'] ?>"> </div>
            </div>
            <?

            if ( $arResult[ 'name' ] == "EWON" ) {

              include $_SERVER[ "DOCUMENT_ROOT" ] . "/include_utf_8/widgets/inc_no_ewon.php";

            }

            ?>
            <div class="component_catalog_brand__description">
              <?= $arResult['detail_text'] ?>
            </div>
          </div>
          <div class="column is-12">
            <div class="component_catalog_brand__sections">
              <div class="columns is-multiline is-gapless">
                <?php

                foreach ( $arr_sections as $row ) {

                  if ( isset( $row[ 'category_link_brand' ] )and $row[ 'category_link_brand' ] != '' ) {

                    if ( $row[ 'is_direct_link_brand' ] == '1' ) {

                      $link = $row[ 'category_link_brand' ];

                    } else {

                      $link = $row[ 'category_link_brand' ] . $arResult[ 'code' ];

                    }

                  } else {

                    $link = "/catalog/{$row['code']}/?&brand=" . $arResult[ 'code' ];

                  }

                  ?>
                <div class="column is-6-desktop is-6-tablet"> <a href="<?= $link ?>" class="section_link">
                  <div class="preview_image"

                                                     style="background-image: url('<?= $row["preview_picture"] ?>')"></div>
                  <div class="component_catalog__title">
                    <?= $row["name"] ?>
                    ---</div>
                  </a> </div>
                <?

                }

                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="column is-2 is-justify-content-right">
        <div class="is-flex is-justify-content-right">
          <ul class="brand_menu  has-background-light">
            <? if ($_SERVER['REQUEST_URI'] == '/weintek/'): ?>
            <li><span>Weintek</span></li>
            <? else: ?>
            <li><a href="/weintek/">Weintek</a></li>
            <? endif; ?>
            <? if ($_SERVER['REQUEST_URI'] == '/ifc/'): ?>
            <li><span>IFC</span></li>
            <? else: ?>
            <li><a href="/ifc/">IFC</a></li>
            <? endif; ?>
            <? if ($_SERVER['REQUEST_URI'] == '/aplex/'): ?>
            <li><span>Aplex</span></li>
            <? else: ?>
            <li><a href="/aplex/">Aplex</a></li>
            <? endif; ?>
            <? if ($_SERVER['REQUEST_URI'] == '/samkoon/'): ?>
            <li><span>Samkoon</span></li>
            <? else: ?>
            <li><a href="/samkoon/">Samkoon</a></li>
            <? endif; ?>
            <? if ($_SERVER['REQUEST_URI'] == '/ewon/'): ?>
            <li><span>eWON</span></li>
            <? else: ?>
            <li><a href="/ewon/">eWON</a></li>
            <? endif; ?>
            <? if ($_SERVER['REQUEST_URI'] == '/faraday/'): ?>
            <li><span>Faraday</span></li>
            <? else: ?>
            <li><a href="/faraday/">Faraday</a></li>
            <? endif; ?>
            <li><a href="/certificates/" title="Все сертификаты">Сертификаты</a></li>
          </ul>
        </div>
      </div>
      <?

      if ( isset( $arResult[ 'certificate_preview_picture' ] )and $arResult[ 'certificate_preview_picture' ] != '' ) {

        ?>
      <div class="column is-12">
        <h2 class="block_sertificates__item_title">Сертификат</h2>
        <a class="block_sertificates__img_sertificate_link"

                           href="<?= $arResult['certificate_detail_picture'] ?>" target="_blank"> <img src="<?= $arResult['certificate_detail_picture'] ?>" alt=""> </a> </div>
      <?

      }

      ?>
    </div>
  </div>
</div>
<?php


}
