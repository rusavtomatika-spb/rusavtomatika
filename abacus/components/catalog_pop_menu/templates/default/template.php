<?php
CoreApplication::add_style( str_replace( $_SERVER[ "DOCUMENT_ROOT" ], "", __DIR__ ) . "/style_catalog_pop_menu.css" );
CoreApplication::add_script( str_replace( $_SERVER[ "DOCUMENT_ROOT" ], "", __DIR__ ) . "/script.js" );

$arrSections = CoreApplication::get_rows_from_table( "catalog_sections", '', "active='1'", "position ASC" );
$arrBrands = CoreApplication::get_rows_from_table( "catalog_brands", '', "active='1'", "position ASC" );
$arrSeries = CoreApplication::get_rows_from_table( "catalog_series", '', "active='1'", "position ASC" );

for ( $x = 0; $x < count( $arrBrands ); $x++ ) {
  $arrBrands[ $x ][ 'sections' ] = array();
  foreach ( $arrSections as $section ) {
    $pos = strpos( $section[ 'filter_brands' ], $arrBrands[ $x ][ 'name' ] );
    if ( $pos !== false ) {
      $arrBrands[ $x ][ 'sections' ][] = array( "id" => $section[ 'id' ], "code" => $section[ 'code' ], 'name' => $section[ 'name' ], 'category_link' => $section[ 'category_link' ], 'is_direct_link' => $section[ 'is_direct_link' ], 'sub_sections_d' => $section[ 'subsection_diagonals' ], 'sub_sections_p' => $section[ 'subsection_processors' ] );
    }
  }
}

foreach ( $arrSections as $section ) {
  if ( ( $section[ 'subsection_diagonals' ] != '' ) || ( $section[ 'subsection_processors' ] != '' ) ) {
    $arrSub[ 'sections' ][] = array( "id" => $section[ 'id' ], "code" => $section[ 'code' ], 'product_types' => $section[ 'product_types' ], 'name' => $section[ 'name' ], 'category_link' => $section[ 'category_link' ], 'is_direct_link' => $section[ 'is_direct_link' ], 'sub_sections_d' => $section[ 'subsection_diagonals' ], 'sub_sections_p' => $section[ 'subsection_processors' ] );
  }
}

  foreach ( $arrSeries as $serie ) {
      $arrSer[] = array( "id" => $serie[ 'id' ], "name_russian" => $serie[ 'name_russian' ], 'name' => $serie[ 'name' ], 'series_link' => $serie[ 'series_link' ], 'brand' => $serie[ 'brand' ], 'type' => $serie[ 'type' ], 'position' => $serie[ 'position' ] , 'menu_category_item_code' => $serie[ 'menu_category_item_code' ] );
    }
?>
<script>

$(document).ready(function() {
  new jBox('Modal', {
  attach: '#operator_panels',
  maxWidth: '400px',
	  overlay: true,
	  closeButton: 'title',
  title: '<b>Безэкранные панели оператора</b>',
  content: 'Не имеют экрана и позволяют работать с ними через специальное приложение cMT Viewer с персонального компьютера, планшета или мобильного устройства. <br>При этом можно подключаться одновременно к нескольким панелям оператора и делать это в многопользовательском режиме.'
  });
	
  new jBox('Modal', {
  attach: '#gateways',
  maxWidth: '400px',
	  overlay: true,
	  closeButton: 'title',
  title: '<b>Шлюзы данных</b>',
  content: 'Помогают большому количеству пользователей подключать различные устройства к IIot (интернету вещей).'
  });
	
  new jBox('Modal', {
  attach: '#industrial_computers',
  maxWidth: '400px',
	  overlay: true,
	  closeButton: 'title',
  title: '<b>Промышленный компьютер</b>',
  content: 'Компьютер адаптированый к использованию в промышленности. Имеет защиту от неблагоприятных условий эксплуатации.'
  });
	
	
  new jBox('Modal', {
  attach: '#industrial_computers_full_ip65',
  maxWidth: '400px',
	  overlay: true,
	  closeButton: 'title',
  title: '<b>Промышленный компьютер FULL IP65</b>',
  content: 'Компьютер адаптированый к использованию в промышленности. Имеет защиту от неблагоприятных условий эксплуатации. Промышленные компьютеры full IP65 имеют усиленную пылевлагозащиту всего корпуса, а не только фронтальной панели.'
  });
	
});
</script>
<div id="vue_catalog_pop_menu" v-cloak="" style="display: none">
  <div class="catalog_pop_menu">
    <div class="catalog_pop_menu_wrap_inn">
      <div class="hidden-menu ">
        <div class=" container_ ">
          <div class="box cataloge">
            <!--div class="cataloge-left-side"-->
              <ul class="cataloge-list">
                <?
                foreach ( $arrSections as $section ) {
                  if ( isset( $section[ 'category_link' ] )and $section[ 'category_link' ] != '' ) {
                    $link = $section[ 'category_link' ];
                  } else {
                    $link = "";
                  }

                  if ( isset( $section[ 'subsection_brands' ] )and $section[ 'subsection_brands' ] != '' ) {
                    $sub0 = $section[ 'subsection_brands' ];
                  } else {
                    $sub0 = "";
                  }

                  if ( isset( $section[ 'subsection_diagonals' ] )and $section[ 'subsection_diagonals' ] != '' ) {
                    $sub1 = $section[ 'subsection_diagonals' ];
                  } else {
                    $sub1 = "";
                  }

                  if ( isset( $section[ 'subsection_processors' ] )and $section[ 'subsection_processors' ] != '' ) {
                    $sub2 = $section[ 'subsection_processors' ];
                  } else {
                    $sub2 = "";
                  }
				  
				  if ($section["code"] != 'industrial-computers') {

                  ?>
                <li class="cataloge_list_item_icon">
                  <div class="cataloge_list_item__picture">
                    <?
                    if ( isset( $section[ 'preview_picture_small' ] )and $section[ 'preview_picture_small' ] != '' )$preview_picture = $section[ 'preview_picture_small' ];
                    else $preview_picture = $section[ 'preview_picture' ];
                    ?>
                    <img class="is-hidden-mobile" src="<?= $preview_picture ?>"
                                                 alt=""> </div>
                  <ul>
                    <li>
                      <?
                      if ( $section[ 'is_direct_link' ] == "1" ) {
                        ?>
                      <span class="cataloge_list-title button_show_items"><a  href="<?= $section["category_link"] ?>" class="cataloge_list-title button_show_items">
                      <?= $section['name'] ?>
                      </a></span>
                      <?
                      } else {
                        ?>
                      <a  href="<?= $section["category_link"] ?>" class="cataloge_list-title button_show_items"><span @click="handle_button_show_items"
                                                          data-section-id="<?= $section['id'] ?>"
                                                          data-section-code="<?= $section['code'] ?>"
                                                          data-action="show_section_by_categories"
                                                          data-brand="all"
                                                          class="cataloge_list-title button_show_items">
                      <?= $section['name'] ?>
						  </span></a>
                      <?
                      }
							//if ($section['category_link']=='screenless'||$section['code']=='gateways'){
							if (preg_match('/(gateways|screenless|industrial_computers)/',$section['category_link'])){
								echo '<span style="cursor: pointer; z-index: 9999;" id="'.$section['code'].'"> <i class="fa-regular fa-circle-question" style="color:#d6d6d6;"></i></span>';							}
                      ?>
                      <?
                      if ( isset( $sub0 )and $sub0 != '' ) {
                        $arr_section_sub = explode( ",", $sub0 );
                        if ( count( $arr_section_sub ) > 1 ) {
                          ?>
                      <ul class="subsection">
                        <?
                        foreach ( $arr_section_sub as $section_sub ) {
                          ?>
                      <ul class="subsection">
                        <li class="cataloge_list_item_subitem"> <a title="Производитель <?= $section_sub ?>" href="<?= $section["category_link"].'?&brand='.$section_sub ?>"> <span @click="handle_button_show_items"
                                                                      class="section_list_tag_button"
                                                                      data-action="show_section_by_categories_one_brand_only"
                                                                      data-link="<?= $section["category_link"].'&brand='.$section_sub ?>"
                                                                      data-section-code="<?= $section['code'] ?>"
                                                                      data-section-id="<?= $section['id'] ?>"
                                                                      data-section-sub="<?= $section_sub ?>"
                                                                      data-brand="<?= $section_sub ?>">
                          <?= $section_sub ?>
                          </span></a> </li> : 
                        <?
                        foreach ( $arrSer as $i=>$serie ) {
							$pattern = '/'.$serie['type'].'/i';
							if ($serie['brand']==$section_sub && preg_match($pattern,$section['product_types'])) {
                          ?>
                        <li class="cataloge_list_item_subitem"> <a title="<?= $serie["name_russian"] ?>" href="/catalog/<?=$serie['menu_category_item_code']?>/?&series=<?=$serie['name']?>"> <span @click="handle_button_show_items"
                                                                      class="section_list_tag_button ser"
                                                                      data-action="show_section_by_categories_one_brand_only"
                                                                     >
                          <?= $serie["name"] ?>
                          </span></a> </li>
                        <?
							  $i++;
                        }
                        }?>
						  </ul>
                        <?}
                        ?>
                      </ul>
                      <?
                      };
                      }
                      ?>
                      <?
                      if ( isset( $sub1 )and $sub1 != '' ) {
                        $arr_section_sub = explode( ",", $sub1 );
                        $cur = 1;
                        if ( count( $arr_section_sub ) > 1 ) {

                          ?>
                      <ul class="subsection">
                        <?
                        foreach ( $arr_section_sub as $section_sub ) {
							$arr_diag_sub = explode( "#", $section_sub );
							$diag_label = $arr_diag_sub[0];
							$diag_range = explode( "-", $arr_diag_sub[1] );
							if ($diag_range[0] =='0') {
								$diag_min = '';
							} else {
								$diag_min = '&range_diagonal_min='.$diag_range[0];
							}
							if ($diag_range[1] =='0') {
								$diag_max = '';
							} else {
								$diag_max = '&range_diagonal_max='.$diag_range[1];
							}
							
                          ?>
                        <li class="cataloge_list_item_subitem"> <a title="Диагональ" href="<?
															echo $section["category_link"].$diag_min;
																if ($cur < count($arr_section_sub)) { 
																	echo $diag_max;
																}
															echo '&sort=diagonal_small'; ?>"> <span @click="handle_button_show_items"
                                                                      class="section_list_tag_button"
                                                                      data-action="show_section_by_categories_one_brand_only"
                                                                      data-section-code="<?= $section['code'] ?>"
                                                                      data-section-id="<?= $section['id'] ?>"
                                                                      >
                          <?= $diag_label ?>
                          "</span></a> </li>
                        <?
                        $cur++;
                        }
                        ?>
                      </ul>
                      <?
                      };
                      }
                      ?>
                      <?
                      if ( isset( $sub2 )and $sub2 != '' ) {
                        $arr_section_sub = explode( ",", $sub2 );
                        if ( count( $arr_section_sub ) > 1 ) {

                          ?>
                      <ul class="subsection">
                        <?
                        foreach ( $arr_section_sub as $section_sub ) {
                          ?>
                        <li class="cataloge_list_item_subitem"> <a title="Процессор" href="<?= $section["category_link"].'&processors='.$section_sub ?>"> <span @click="handle_button_show_items"
                                                                      class="section_list_tag_button"
                                                                      data-action="show_section_by_categories_one_brand_only"
                                                                      data-link="<?= $section["category_link"].'&processors='.$section_sub ?>"
                                                                      data-section-code="<?= $section['code'] ?>"
                                                                      data-section-id="<?= $section['id'] ?>"
                                                                      data-section-sub="<?= $section_sub ?>"
                                                                      data-brand="<?= $section_sub ?>">
                          <?= $section_sub ?>
                          </span></a> </li>
                        <?
                        }
                        ?>
                      </ul>
                      <?
                      };
                      }
                      ?>
                    </li>
                  </ul>
                </li>
                <?
                }
				  }
                ?>
              </ul>
            <!--/div>
            <div :class="[{loading: loading_status}, 'cataloge-right-side']"> </div-->
<!--div style="cursor: pointer; z-index: 9999;" id="gateways">???</div-->
          </div>
        </div>
      </div>
    </div>
  </div>
</div><?
//echo '<pre>';
//print_r($arrSer);
//echo '</pre>';
?>
