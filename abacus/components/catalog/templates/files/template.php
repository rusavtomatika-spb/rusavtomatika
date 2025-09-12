<?php
CoreApplication::add_style( str_replace( $_SERVER[ "DOCUMENT_ROOT" ], "", __DIR__ ) . "/style.css" );
$rows = CoreApplication::get_rows_from_table( "`catalog_sections`", "", "active='1' AND code!='power_supplies' AND code!='discounted_items'", "position ASC" );
global $H1, $TITLE, $DESCRIPTION;
$TITLE = "Каталог оборудования";
$DESCRIPTION = "Каталог оборудования - панели оператора, промышленные компьютеры: панельные и встраиваемые, промышленные мониторы, контроллеры (PLC), модули ввода-вывода, блоки питания";
$H1 = "Поставка оборудования для автоматизации";
$section = "";
$types = "";
$goods = "";
$files = $some = "";
$good_docs = array();
$files = array();
$filename = $_SERVER[ 'DOCUMENT_ROOT' ] . '/documents/availableTags.txt';
$docs_result = $_SERVER[ 'DOCUMENT_ROOT' ] . '/documents/docs_result.txt';
$wt_files_result = $_SERVER[ 'DOCUMENT_ROOT' ] . '/documents/wt_files_result.txt';
$nice_docs = $_SERVER[ 'DOCUMENT_ROOT' ] . '/catalog/nice_docs.txt';
$ebpro_files_block = $_SERVER[ 'DOCUMENT_ROOT' ] . '/download/ebpro_files_block.txt';
$alltags = $_SERVER[ 'DOCUMENT_ROOT' ] . '/documents/docs_wt_result.txt';
$bad_words = "/(Chinese|japanese|HMI Pin Assignment|RoHS|Connection Guide)/i"; //стоп-слова в названии
$good_cat = "/(Document|2D CAD|3D Model)/i"; //гуд-слова в URL
$bad_cat = "/(Certificate)/i"; //гуд-слова в URL
$files = json_decode( file_get_contents( $wt_files_result ), true ); // JSON с документами weintek


function isValidTimeStamp( $strTimestamp ) {
  return ( ( string )( int )$strTimestamp === $strTimestamp ) &&
    ( $strTimestamp <= PHP_INT_MAX ) &&
    ( $strTimestamp >= ~PHP_INT_MAX );
}
function UR_exists( $url ) {
  $headers = get_headers( $url );
  return stripos( $headers[ 0 ], "200 OK" ) ? true : false;
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

///////////////////////////////////////
$arrr = array();
$dtype="";
$pattern = '/cmt[\d]{4},/i';
//$some = json_decode( $wt_files_result, true ); // JSON с документами weintek
if ( count( $files ) > 0 ) {
  foreach ( $files as $doc ) {
    //if (preg_match($pattern, $doc[ 'label' ])) {
	$param =  $doc[ 'ftype' ];
    array_push( $arrr, $param );
	//}
}
  echo "<pre>";
  print_r(array_unique( $arrr ) );
  echo "</pre>";
}
//exit();
//////////////////////

?>
<div>
<?php
if ( count( $rows ) > 0 ) {
  ?>
<?php
foreach ( $rows as $row ) {
  $section = "";
  $types = "";
  $goods = "";
  $section = $row[ "code" ];
  $types = "'" . $row[ "product_types" ] . "'";
  $types = str_replace( ",", "','", $types );
  $goods = CoreApplication::get_rows_from_table( "`products_all`", "", "(status='1') AND (discontinued='0') AND (`section`='$section' OR `type` IN ($types))", "model ASC" );
  $dbfiles = CoreApplication::get_rows_from_table( "`products_files`", "", "", "name ASC" );
//    	  echo "<pre>";
//    	  var_dump($dbfiles);
//    	  echo "</pre>";

  ?>
<h2>
  <?= $row["name"]; ?>
</h2>
<table class"table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
<thead>
<th class='is-size-7'>НАЗВАНИЕ</th>
  <th class='is-size-7'>ПУТЬ</th>
  <th class='is-size-7'>ДАТА</th>
  <th class='is-size-7'>РАЗМЕР</th>
  </thead>
  <?
  foreach ( $goods as $good ) {
    $model = $good[ 'model' ];
    $dbfiles = CoreApplication::get_rows_from_table( "`products_files`", "", "product_name='$model'", "name ASC" );
    $regex = '/[,]*(' . $model . ')[,](.*)(Datasheet|Installation|usermanual|Brochure|2D CAD|3D Model|Software|demo|project)/i';
    $docs = array_filter( $files, function ( $var )use( $regex ) {
      return preg_match( $regex, $var[ 'label' ] );
    } );
    if ( count( $dbfiles ) > 0 )echo "<tr><td><b>" . $model . "</b></td></tr>";
    foreach ( $dbfiles as $file ) {
      $link = $file[ 'path' ];
		$link2="https://www.rusavtomatika.com/upload_files".$link;
      echo "<tr>";
      echo "<td class='is-size-7'>" . ( $file[ 'name' ] ) . "</td>";
      echo "<td class='is-size-7";
		if (UR_exists($link2)) {
			echo "  has-text-success";
		} else {
			echo " has-background-warning";
		}
	  echo "'><a target='new' href='" . $link . "'>link</a></td>";
      echo "<td class='is-size-7'>" . ( $file[ 'date' ] ) . "</td>";
      echo "<td class='is-size-7'>" . ( $file[ 'size' ] ) . "</td>";
      echo "</tr>";
    }
    if ( count( $docs ) > 0 ) {
		$docs = array_map("unserialize", array_unique(array_map("serialize", $docs)));
      foreach ( $docs as $doc ) {
        $ddata = $doc[ 'data' ];
        $title = $doc[ 'title' ];
		  if ($doc[ 'size' ] !="") {
        $dsize = formatSizeUnits($doc[ 'size' ]);
		  } else {
        $dsize = '';
		  }
        $dlink = ( $doc[ 'path' ] ) . "/" . ( $doc[ 'fname' ] );
		  $dlink2 = "https://www.rusavtomatika.com/upload_files/documents/weintek/".$dlink;
        echo "<tr>";
        echo "<td class='is-size-7 has-text-success'>". ( $title ) . "</td>";
        echo "<td class='is-size-7";
		if (UR_exists($dlink2)) {
			echo "  has-text-success";
		} else {
			echo " has-background-warning";
		}
        echo "'><a target='new' href='https://www.rusavtomatika.com/upload_files/documents/weintek/" . $dlink . "'>link</a></td>";
        //echo "<td class='is-size-7 has-text-success'>" . date('d.m.Y', $ddata) . "</td>";
        echo "<td style='min-width:70px;' class='is-size-7 has-text-success'>";
        if ( is_numeric( $ddata ) ) {
          echo date( 'd.m.Y', $ddata );
        }
        echo "</td>";
        echo "<td class='is-size-7 has-text-success'>". ( $dsize ) . "</td>";
        echo "</tr>";
      }
    }
    ///////////////////
    $cats = array();
    if ( count( $files ) > 10000000000 ) {
      //echo "<tr>";
      //echo "<td class='is-size-7'>";
      foreach ( $files as $doc ) {
        //echo $label . "</br>";
        $cat = $doc[ 'ftype' ];
        array_push( $cats, $cat );
        //        $item = array( 'title' => $title, 'brand' => '', 'mod_data' => $file_data, 'url' => $catalog[ url ], 'put' => $put, 'fname' => $fname, 'category' => $catalog[ category ], 'section' => $section, 'label' => $label );
        //        array_push( $docs_json, $item );

        //echo "<td class='is-size-7 has-text-success'><a target='new' href='https://www.rusavtomatika.com/upload_files/documents/weintek/" . $dlink . "'>" . $dlink . "</a></td>";
        //echo "<td class='is-size-7 has-text-success'>" . date('d.m.Y', $ddata) . "</td>";
        //echo "<td style='min-width:70px;' class='is-size-7 has-text-success'>";
        //        if ( is_numeric( $ddata ) ) {
        //          echo date( 'd.m.Y', $ddata );
        //        }
      }
      echo "<pre>";
      var_dump( array_unique( $cats ) );
      echo "</pre>";
      //echo "</td>";

      //echo "</tr>";
    }

    /////////////////////////	  
	if ($good[ 'brand' ] == "Weintek") {
		echo "<tr><td class='is-size-7 has-text-warning' colspan='4'>";
		$ebpro = file_get_contents($ebpro_files_block);
		echo $ebpro;
		echo "</td></tr>";
	}

  }
  echo "</table>";
  }

  ?>
</div>
<?php
}
