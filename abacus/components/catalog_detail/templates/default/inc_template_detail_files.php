<?php
if ( $_SERVER[ "HTTP_HOST" ] != "https://www.rusavtomatika.com" ) {
  $site = "https://www.rusavtomatika.com/upload_files";
} else $site = "";

function printDefiningLink( $link, $site ) {
  $pos = strripos( $link, 'http' );
  if ( $pos === false ) {
    $link = $site . $link;
  }
  return $link;
}
function UR_exists($url){
   $headers=get_headers($url);
	//var_dump($headers);
   return stripos($headers[0],"200 OK")?true:false;
}

if ( isset( $arResult[ 'product' ][ 'files' ] )and is_array( $arResult[ 'product' ][ 'files' ] )and count( $arResult[ 'product' ][ 'files' ] ) > 0 ) {
  ?>
<div class="table-container">
  <table id="table-download-files" class="table is-bordered is-striped filez">
    <thead>
      <tr class="is-selected111111111111" style="color:#ccc;font-weight: 300;">
        <th>Файл</th>
        <th>Тип</th>
        <th>Дата</th>
        <th>Размер</th>
        <th>Язык</th>
        <th style="display: none;">Сорт</th>
      </tr>
    </thead>
    <tbody>
      <?
      foreach ( $arResult[ 'product' ][ 'files' ] as $file ) {
        ?>
      <tr>
        <td><?
        if ( isset( $file[ "name" ] )and $file[ "name" ] != "" ): ?>
          <div class=""><a <?if($file["type"] != 'pdf' && $file["type"] != 'online'){?>download<?}?> title="Скачать" target="_blank"
                                             href="<?= printDefiningLink($file["path"], $site) ?>">
            <?= $file["name"] ?>
            </a> </div>
          <? endif; ?>
          <?
          if ( isset( $file[ "annotation" ] )and $file[ "annotation" ] != "" ): ?>
          <div class="down_item_descr">
            <?= $file["annotation"] ?>
          </div>
          <? endif; ?></td>
        <td style="font-size:0.8em; text-transform:uppercase;">
          <?
          if ( isset( $file[ "type" ] )and $file[ "type" ] != "" ) {
            echo "{$file['type']}";
          }
          ?>
		  </td>
        <!-------------------------------->
        <?
        $linkf = printDefiningLink( $file[ "path" ], "https://www.rusavtomatika.com/upload_files" ); ?>
        <!-------------------------------->
        <td style="font-size:0.8em;white-space: nowrap;"><span class='date'>
          <?
          $linkf = printDefiningLink( $file[ "path" ], $site );
          if ( isset( $file[ "date" ] )and $file[ "date" ] != "" ) {
            echo date("d.m.Y",strtotime($file['date']));
          }
          ?>
          </span></td>
        <td style="font-size:0.8em;"><span class='size'>
          <?
          if ( isset( $file[ "size" ] )and $file[ "size" ] != "" ) {
            echo "{$file['size']}";
          }
          ?>
          </span></td>
        <td style="font-size:0.8em; text-transform:uppercase;"><span class='language'>
          <?
          if ( isset( $file[ "language" ] )and $file[ "language" ] != "" ) {
            echo "{$file['language']}";
          }
          ?>
          </span></td>
        <td style="display: none;">          <?
          if ( isset( $file[ "position" ] )and $file[ "position" ] != "" ) {
            echo "{$file['position']}";
          }
          ?>
</td>
      </tr>
      <?
      }
      ?>
      <?
      foreach ( $files_product_json as $file ) {
        ?>
      <tr>
        <td><?
        if ( isset( $file[ "title" ] )and $file[ "title" ] != "" ): ?>
          <div class=""><a <?if($file["ftype"] != 'pdf' && $file["ftype"] != 'online'){?>download<?}?> title="Скачать" target="_blank"
                                             href="https://www.rusavtomatika.com/upload_files/documents/weintek/<?= $file["path"] . "/" . ( $file[ 'fname' ] ) ?>">
            <?= $file["title"] ?>
            </a> </div>
          <? endif; ?>
          <?
          if ( isset( $file[ "description" ] )and $file[ "description" ] != "" ): ?>
          <div class="down_item_descr">
            <?= $file["description"] ?>
          </div>
          <? endif; ?></td>
        <td style="font-size:0.8em; text-transform:uppercase;">
          <?
          if ( isset( $file[ "ftype" ] )and $file[ "ftype" ] != "" ) {
            echo "{$file['ftype']}";
          }
          ?>
		  </td>
        
        <!-------------------------------->
        <!-------------------------------->
        <td style="font-size:0.8em;white-space: nowrap;"><span class='date'>
          <?
          if ( isset( $file[ "data" ] )and $file[ "data" ] != "" ) {
            echo date('d.m.Y',$file['data']);
          }
          ?>
          </span></td>
        <td style="font-size:0.8em;"><span class='size'>
          <?
          if ( isset( $file[ "size" ] )and $file[ "size" ] != "" ) {
            echo formatSizeUnits($file['size']);
          }
          ?>
          </span></td>
        <td style="font-size:0.8em; text-transform:uppercase;"><span class='language'>
          <?
          if ( isset( $file[ "lang" ] )and $file[ "lang" ] != "" ) {
            echo "{$file['lang']}";
          }
          ?>
          </span></td>
        <td style="display: none;">
		            <?
          if ( isset( $file[ "sort" ] )and $file[ "sort" ] != "" ) {
            echo "{$file['sort']}";
          }
          ?>
</td>
      </tr>
      <?
      }
	$excludes_models = array(
		"MT6050i",
		"MT8050i",
		"MT6050iP",
		"MT8050iP",
		"MT6056i",
		"MT6070iH",
		"MT8070iH",
		"MT6070iP",
		"MT8070iP",
		"MT6100i",
		"MT8100i",
		"MT8104iH",
		"MT8104XH",
		"MT8150X",
		"cMT3162X(W)",
		"cMT3108XP(W)",
		"cMT3072XP(W)",
		"cMT3162X(iV)",
		"cMT-XMBS",
		"cMT-XMBC",
		"cMT-XM-ESP",
		"cMT3108XP(iV)"
	);
if ( isset( 
	$arResult[ 'product' ][ 'brand' ] )
	&&($arResult[ 'product' ][ 'brand' ] == "Weintek")
	&&(!in_array($arResult[ 'product' ][ 'model' ], $excludes_models))
	&&($arResult[ 'product' ][ 'series' ] != "iR")
   ) {
		$ebpro = file_get_contents($ebpro_files_block);
		echo $ebpro;
	}

      ?>
    </tbody>
  </table>
	     <? 
//	echo "<pre>";
//      var_dump( $files_product_json );
//      echo "</pre>"; 
	?>

</div>
<?

} else {
  echo '<p>Файлов пока нет...</p>';
}
