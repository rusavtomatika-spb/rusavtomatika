<?php
global $TITLE, $DESCRIPTION, $KEYWORDS;
$TITLE = 'Скачать EasyBuilder Pro, EasyBuilder 8000, EBPro, EB8000, SKWorkshop, драйвера Aplex, драйвера IFC, документация, гайд, руководство, инструкция, мануал';
$DESCRIPTION = 'Документация и программное обеспечение для работы с оборудованием Weintek, Samkoon, IFC, Aplex — описания, мануалы и брошюры, инструкции по установке и эксплуатации, руководства по работе с программым обеспечением и примеры проектов для операторских панелей';
$KEYWORDS = 'Скачать, бесплатно, без регистрации, инструкции по эксплуатации, бесплатное по, программное обеспечение, операторские панели, панели оператора, Weintek, Samkoon, IFC, Aplex, инструкции по установке, брошюры, мануалы, даташит';
$CANONICAL = "https://www.rusavtomatika.com/download/";

global $CONTENT_ON_WIDE_SCREEN,$recs;
$CONTENT_ON_WIDE_SCREEN = false;
require_once $_SERVER[ 'DOCUMENT_ROOT' ] . "/abacus/prolog.php";
$docs_folder = $_SERVER[ 'DOCUMENT_ROOT' ] . '/download/';
file_put_contents( $docs_folder . "error_log", "" );
$docs_result = $_SERVER[ 'DOCUMENT_ROOT' ] . '/documents/docs_result.txt';
$soft_result = $_SERVER[ 'DOCUMENT_ROOT' ] . '/download/soft_result.txt';
$soft_updates = $_SERVER[ 'DOCUMENT_ROOT' ] . '/download/soft_updates.txt';
$ebpro_files_block = $_SERVER[ 'DOCUMENT_ROOT' ] . '/download/ebpro_files_block.txt';
$ebpro_files_block_4wein = $_SERVER[ 'DOCUMENT_ROOT' ] . '/download/ebpro_files_block_4wein.txt';
$ebpro_files = '';
$um_arc = $_SERVER[ 'DOCUMENT_ROOT' ] . '/documents/um_arc.txt';
$items = array_values( json_decode( file_get_contents( $docs_result ), true ) ); // JSON с документами weintek
$progs = array_values( json_decode( file_get_contents( $soft_result ), true ) ); // JSON с документами weintek
if (file_get_contents( $soft_updates ) != '') {
$updates = array_values( json_decode( file_get_contents( $soft_updates ), true ) ); // JSON с документами weintek
} else {
	$updates = '';
}
CoreApplication::add_style( str_replace( $_SERVER[ "DOCUMENT_ROOT" ], "", __DIR__ ) . "/download_styles.css?" . rand() );

include_once $_SERVER[ 'DOCUMENT_ROOT' ] . "/sc/dbcon.php";
database_connect();
$query = "SELECT * FROM `downloads`";
$res = mysql_query( $query )or die( mysql_error() );
//$res = mysql_fetch_assoc( $res );
$recs = array();
while ($row = mysql_fetch_assoc($res)) {
    $recs[] = $row;
}
//var_dump($res);
//exit();
function findRecordBySoftware($records, $soft, $fld) {
    foreach ($records as $record) {
        if ($record['software'] === $soft) {
            return $record[$fld];
        }
    }
    return null;
}


function fetchTxtFileContents($url) {
    // Проверяем наличие URL
    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        return 'Ошибка: неверный URL.';
    }

    // Инициализация cURL сессии
    $ch = curl_init();

    // Настройка параметров
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,                // Адрес страницы
        CURLOPT_RETURNTRANSFER => true,     // Возвращать данные в переменную
        CURLOPT_FAILONERROR => true,        // Ошибка при статусе >= 400
        CURLOPT_TIMEOUT => 10,              // Таймаут ожидания
        CURLOPT_CONNECTTIMEOUT => 5,        // Таймаут подключения
        CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36',
        CURLOPT_HEADER => false             // Не включать заголовки в ответ
    ]);

    // Выполняем запрос
    $data = curl_exec($ch);

    // Проверяем успешность выполнения
    if ($data === false) {
        return 'Ошибка загрузки файла: ' . curl_error($ch);
    }

    // Закрываем сессию
    curl_close($ch);

    return $data;
}
function filter_arr( $array, $key, $value, $out = 'download', $exclude1 = 'qqqqqqqq', $exclude2 = 'qqqqqqqq', $exclude3 = 'qqqqqqqq', $exclude4 = 'qqqqqqqq', $exclude5 = 'qqqqqqqq' ) {
  if ( is_array( $array ) ) {
    foreach ( $array as $element ) {
      //      if ( $element[ $key ] == $value ) {
      if ( strpos( $element[ $key ], $value ) !== false ) {
        $info = pathinfo( $element[ 'url' ] );
        if ( ( array_key_exists( 'fsize', $element ) )and( $element[ 'fsize' ] > 0 ) ) {
          //				if ($fsize) {
          $fsize = '['.formatSizeUnits( $element[ 'fsize' ] ).']';
        } else $fsize = '';
        if ( $element[ 'mod_data' ] != 'N/A' ) {
          $mod_data = '['.date( "d.m.Y", $element[ 'mod_data' ] ).']';
        } else $mod_data = '';
        if (
          ( strpos( $element[ 'put' ], $exclude1 ) !== false )OR( strpos( $element[ 'put' ], $exclude2 ) !== false )OR( strpos( $element[ 'put' ], $exclude3 ) !== false )OR( strpos( $element[ 'put' ], $exclude4 ) !== false )OR( strpos( $element[ 'put' ], $exclude5 ) !== false )
        ) {
          continue;
        }
        if ( $element[ 'category' ] == 'Document' ) {
          $folder = '/upload_files/documents/weintek';
          $fput = $element[ 'put' ] . '/';
        } else {
			$folder = '/soft';
          $fput = $element[ 'put' ] . '/';
		}

        if ( preg_match( '/\.package$/', $element[ 'fname' ] ) ) {
          $folder = 'https://'.$_SERVER['HTTP_HOST'].'/soft/cMT/CODESYS/Weintek_CODESYS_and_RemoteIO_package';
          $fput = '';
        }
		  $days_difference = floor(abs(time() - $element[ 'mod_data' ]) / 86400);
		  if ($days_difference < 11) {
		  $new = ' <span class="new-label">NEW</span>';
		  } else {
		  $new = '';
		  }
        if ( preg_match( '/Дистрибутив для PC/', $element[ 'title' ] ) ) {
          preg_match( '/(\d+\.\d+\.\d+)/', $element[ 'fname' ], $matches );
          $version = '[' . $matches[ 1 ] . '] ';
		} else {
          $version = '';
		}
		  
if ($out=='download') {
        echo '<p><a class="download_' . strtolower( $element[ 'ftype' ] ) . '" href="' . $folder . '/' . $fput . $element[ 'fname' ] . '" download="' . $element[ 'fname' ] . '">' . $element[ 'title' ] . '</a> <span class="small_gray_text">' . $version . $mod_data . ' ' . $fsize . '</span> ' . $new . '</p>';
} else {
echo '<tr><td><div><a download="" title="Скачать" target="_blank" href="' . $folder . '/' . $fput . $element[ 'fname' ] . '">' . $element[ 'title' ] . '</a></div><div class="down_item_descr">' . $element[ 'description' ] . '</div></td><td style="font-size: 0.8em; white-space: nowrap;text-transform: uppercase;">' . $element[ 'ftype' ] . '</td> <td style="font-size: 0.8em; white-space: nowrap;"><span class="date">' . $mod_data . '</span></td> <td style="font-size: 0.8em;"><span class="size">' . $fsize . '</span></td> <td style="font-size: 0.8em; text-transform: uppercase;"><span class="language">Еng</span></td><td style="display: none;">' . $element[ 'sort' ] . '</td></tr>';	
}
      } else continue;
    }
  }
  return false;
}

function arr_out( $array, $out = 'download' ) {
	global $recs;
  if ( is_array( $array ) ) {
    foreach ( $array as $element ) {
      $info = pathinfo( $element[ 'url' ] );
      if ( array_key_exists( 'fsize', $element ) ) {
        //				if ($fsize) {
        $fsize = ' [' . formatSizeUnits( $element[ 'fsize' ] ) . ']';
      } else $fsize = '';
      $el_title = $element[ 'title' ];
      if ( $el_title = 'EasyBuilder Pro User Manual (All chapters)(English)' ) {
		  		//$ebp_ver = fetchTxtFileContents('https://www.rusavtomatika.com/upload_files/soft/EBPro/Installer/version.txt');
		  		$ebp_ver = findRecordBySoftware($recs, 'EBPro', 'version');
        $el_title = 'Руководство по EasyBuilderPro ' . $ebp_ver;
      }
		  $days_difference = floor(abs(time() - $element[ 'mod_data' ]) / 86400);
		  if ($days_difference < 11) {
		  $new = ' <span class="new-label">NEW</span>';
		  } else {
		  $new = '';
		  }
		
if ($out=='download') {
      echo '<p><a class="download_' . $info[ 'extension' ] . '" href="https://www.rusavtomatika.com/upload_files/documents/weintek/' . $element[ 'put' ] . '/' . $element[ 'fname' ] . '" download="' . $element[ 'fname' ] . '">' . $el_title . '</a> <span class="small_gray_text">[' . date( "d.m.Y", $element[ 'mod_data' ] ) . '] ' . $fsize . '</span>' . $new . '</p>';
} else {
echo '<tr><td><div><a title="Скачать" target="_blank" href="https://www.rusavtomatika.com/upload_files/documents/weintek/' . $element[ 'put' ] . '/' . $element[ 'fname' ] . '">' . $el_title . '</a></div><div class="down_item_descr">' . $element[ 'description' ] . '</div></td><td style="font-size: 0.8em; white-space: nowrap;text-transform: uppercase;">' . $element[ 'ftype' ] . '</td> <td style="font-size: 0.8em; white-space: nowrap;"><span class="date">' . date( "d.m.Y", $element[ 'mod_data' ] ) . '</span></td> <td style="font-size: 0.8em;"><span class="size">' . $fsize . '</span></td> <td style="font-size: 0.8em; text-transform: uppercase;"><span class="language">Eng</span></td><td style="display: none;">' . $element[ 'sort' ] . '</td></tr>';	
}
    }
  }
  return false;
}

function files_out( $array, $folder ) {
  if ( is_array( $array ) ) {
    foreach ( $array as $element ) {
      $info = pathinfo( $element[ 'url' ] );
      echo '<p><a class="download_' . $info[ 'extension' ] . '" href="' . $element[ 'url' ] . '">Руководство по EasyBuilderPro ' . $element[ 'version' ] . '</a></p>';
      //				echo $element[ 'title' ].'<br>';
      //                return $element;
    }
  }
  return false;
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
//////////////////// мануалы к старым версиям EBPro
$arc = [
  [
    "url" => "/upload_files/documents/weintek/EBPro/UserManual/eng/arc/60801.pdf",
    "fname" => "60801",
    "version" => "6.08.01"
  ],
  [
    "url" => "/upload_files/documents/weintek/EBPro/UserManual/eng/arc/60702.pdf",
    "fname" => "60702",
    "version" => "6.07.02"
  ],
  [
    "url" => "/upload_files/documents/weintek/EBPro/UserManual/eng/arc/60701.pdf",
    "fname" => "60701",
    "version" => "6.07.01"
  ],
  [
    "url" => "/upload_files/documents/weintek/EBPro/UserManual/eng/arc/60602.pdf",
    "fname" => "60602",
    "version" => "6.06.02"
  ],
  [
    "url" => "/upload_files/documents/weintek/EBPro/UserManual/eng/arc/60401.pdf",
    "fname" => "60401",
    "version" => "6.04.01"
  ],
  [
    "url" => "/upload_files/documents/weintek/EBPro/UserManual/eng/arc/60302.pdf",
    "fname" => "60302",
    "version" => "6.03.02"
  ],
  [
    "url" => "/upload_files/documents/weintek/EBPro/UserManual/eng/arc/50701.pdf",
    "fname" => "50701",
    "version" => "5.07.01"
  ]
];


?>
<!--p><a class="download_zip" href="/soft/EBPro/EBproV60901322.zip">Дистрибутив 6.09.01.322</a> <span class="small_gray_text">[13-11-2023 850&nbsp;Мб]</span></p-->
<article>
  <div class="container page_downloads">
    <div class="columns  is-multiline">
      <div class="column is-12">
        <div class="columns is-multiline">
          <div class="column is-12">
            <h1>Программное обеспечение и документация по EasyBuilder Pro, EasyBuilder 8000, SK Workshop, AK Workshop, SKTOOL, EasyAccess, cMT Viewer, EasyLauncher, EasyRemote I/O, драйвера.</h1>
          </div>
          <div class="column is-2">
            <div class="table_of_contents_menu_title">Программное обеспечение для:</div>
          </div>
          <div class="column is-10">
            <ul id="table_of_contents">
              <li><a href="#Aplex">промышленных компьютеров <span>Aplex</span> &#8681;</a></li>
              <li><a href="#IFC">промышленных компьютеров и мониторов <span>IFC</span> &#8681;</a></li>
              <li><a href="#Samkoon">панелей оператора <span>Samkoon</span> &#8681;</a></li>
              <li><a href="#Weintek">панелей оператора <span>Weintek</span> &#8681;</a></li>
              <li><a href="#EasyRemote">модулей ввода/вывода <span>Weintek</span> &#8681;</a></li>
            </ul>
          </div>
          <div class="column is-2">
            <div class="table_of_contents_menu_title2">Доп. для Weintek:</div>
          </div>
          <div class="column is-10">
            <ul id="table_of_contents">
              <li><a href="/weintek_projects/">Демо проекты <span>Weintek</span></a></li>
              <li><a href="/weintek_libraries/">Графические библиотеки <span>Weintek</span> (для EasyBuilder Pro)</a></li>
              <li><a href="/weintek_drivers/">Драйверы ПЛК совместимых с <span>Weintek</span></a></li>
            </ul>
          </div>
        </div>
        <a id="easybuilderpro"></a>
        <div class="columns  is-multiline">
          <div class="column is-12">
            <h2 id="Weintek" style="margin-top: 10px;">Программное обеспечение для операторских панелей Weintek</h2>
          </div>
          <div class="column is-12 background-gray">
            <div class="block_padding"> <span class="page_downloads_title3"><a href="#easybuilderpro">EasyBuilder Pro</a></span> &nbsp;&nbsp;&nbsp; серии <a href="/catalog/operator_panels/?&series=MT8000iE">MT8000iE</a>, <a href="/catalog/operator_panels/?&series=eMT3000">eMT3000</a>, <a href="/catalog/operator_panels/?&series=MT8000XE">MT8000XE</a>, <a href="/weintek/mTV-100/">mTV</a>, <a href="/catalog/operator_panels/?&series=cMT">cMT</a>, <a href="/catalog/operator_panels/?&series=cMT-X">cMT X</a> </div>
          </div>
          <div class="column is-7">
            <div class="block_padding">
              <p> EasyBuilder Pro применяется для создания пользовательских проектов для операторских панелей Weintek следующих серий: <a href="/catalog/operator_panels/?&series=MT8000iE">MT8000iE</a>, <a href="/catalog/operator_panels/?&series=eMT3000">eMT3000</a>, <a href="/catalog/operator_panels/?&series=MT8000XE">MT8000XE</a>, <a href="/weintek/mTV-100/">mTV</a>, <a href="/catalog/operator_panels/?&series=cMT">cMT</a>, <a href="/catalog/operator_panels/?&series=cMT-X">cMT X</a> </p>
              <p>Использование ПО EasyBuilder Pro полностью бесплатно, вы можете скачивать ПО и пользоваться им без каких-либо ограничений.</p>
              <p>Драйвера USB для подключения панелей к ПК устанавливаются автоматически при установке EasyBuilder Pro.</p>
              <p><b>В состав пакета EasyBuilder Pro входят утилиты:</b> Administrator Tools, cMT Viewer, EasyAccess, EasyConverter, EasyDiagnoser,
                EasyPrinter, EasySimulator, EasySystemSetting, EasyWatch, RecipeEditor, Utility Manager.</p>
            </div>
          </div>
          <div class="column is-5">
            <div class="block_padding">
              <?
              filter_arr( $progs, 'section', 'ebpro' );
				ob_start(); //Start output buffer
              filter_arr( $progs, 'section', 'ebpro', 'ebb' );
				$output = ob_get_contents(); //Grab output
				ob_end_clean(); //Discard output buffer
  if ( is_array( $updates ) ) {
              filter_arr( $updates, 'section', 'ebpro' );
  }
				$ebpro_files = $output;
              ?>
              <p><a class="download_pdf" href="/soft/EBPro/release_notes/EBPro_ReleaseNotes_en.pdf" target="_blank">Примечания к выпуску версии <?
				  //$ebp_ver = fetchTxtFileContents('https://www.rusavtomatika.com/upload_files/soft/EBPro/Installer/version.txt');
				  //$ebp_date = fetchTxtFileContents('https://www.rusavtomatika.com/upload_files/soft/EBPro/Installer/date.txt');
				  echo findRecordBySoftware($recs, 'EBPro', 'version');
				  ?> (Eng)</a> <span class="small_gray_text">[<? echo findRecordBySoftware($recs, 'EBPro', 'date'); ?>]</span></p>
              <?//$searchword = 'All chapters';
              $searchword = 'EasyBuilder Pro User Manual (All chapters)';
              //$searchword = 'DocumentEB';
              $ebpro_docs = $items;
              foreach ( $ebpro_docs as $index => $data ) {
                $keys = array_keys( $data );
                $find = 0;
                foreach ( $keys as $key ) {
                  //                  if ( in_array( $searchword, $item[ $key ] ) ) {
                  if ( strpos( $data[ $key ], $searchword ) !== false ) {
                    $find = 1;
                  }
                }
                if ( $find == 0 ) {
                  unset( $ebpro_docs[ $index ] );
                }
              }
              //              echo "<pre>";
              //              var_dump( $ebpro_docs );
              //              echo "</pre>";
              arr_out( $ebpro_docs );
				ob_start(); //Start output buffer
				$ebpro_files .= arr_out( $ebpro_docs, 'ebb' );
				$output = ob_get_contents(); //Grab output
				ob_end_clean(); //Discard output buffer
				$ebpro_files .= $output;
				  $ebp_date = fetchTxtFileContents('https://www.rusavtomatika.com/upload_files/manuals/weintek/UserManual_separate_chapter/update_date.txt');

				//$ebpro_files .= '<tr><td class="is-size-7 has-text-danger">On-line руководство пользователя Weintek EasyBuilder Pro (Eng) </td><td class="is-size-7 has-text-danger"><a href="/weintek-easybuilderpro-user-manual-en/">link</a></td><td class="is-size-7 has-text-danger">'. date("d.m.Y",$ebp_date).'</td><td></td></tr>';
file_put_contents($ebpro_files_block_4wein, $ebpro_files );
  				$ebpro_files .= '<tr><td><div><a title="Скачать" target="_blank" href="/weintek-easybuilderpro-user-manual-en/">On-line руководство пользователя Weintek EasyBuilder Pro (Eng)</a></div><div class="down_item_descr">Приложение EasyBuilderPro применяется для создания пользовательских проектов для операторских панелей Weintek</div></td> <td style="font-size: 0.8em; white-space: nowrap;text-transform: uppercase;">WEB</td> <td style="font-size: 0.8em; white-space: nowrap;"><!--span class="date">[]</span--></td> <td style="font-size: 0.8em;"></td> <td style="font-size: 0.8em; text-transform: uppercase;"><span class="language">Eng</span></td><td style="display: none;">1550</td></tr>';	
file_put_contents($ebpro_files_block, $ebpro_files );
              ?>
              <p><a class="download_linkext_online" href="/weintek-easybuilderpro-user-manual-en/">On-line руководство пользователя<br>
                Weintek EasyBuilder Pro (Eng) </a> <span style="margin-left:3px;" class="small_gray_text">[<? echo findRecordBySoftware($recs, 'EBPro', 'version'); ?>]</span></p>
              <?
              files_out( $arc, '/documents/weintek/EBPro/UserManual/eng/arc/' );
              ?>
              <p><a class="download_zip" href="/easybuilder-pro/"><b>Архив предыдущих версий Easybuilder Pro</b></a></p>
              <p><a class="download_pdf" href="/manuals/weintek/cMT_X_Series_Easyweb_2.0_UserManual_eng.pdf">Руководство по настройке параметров серии cMT X через <b>Easyweb 2.0</b> и по использованию <b>Webview</b> (удаленное управление через веб-браузер) (Eng)</a></p>
              <p><a class="download_zip" href="/soft/EBPro/EasyConverter.zip">EasyConverter V 2.1.5.5</a> <span class="small_gray_text">[11-08-2022 26 Мб]</span></p>
            </div>
          </div>
        </div>
        <a id="easybuilder8000"></a>
        <div class="columns  is-multiline">
          <div class="column is-12 background-gray">
            <div class="block_padding"> <span class="page_downloads_title3"><a href="#easybuilder8000">EasyBuilder 8000</a></span> &nbsp;&nbsp;&nbsp; серии MT6000i, MT8000i </div>
          </div>
          <div class="column is-7">
            <div class="block_padding">
              <p> EasyBuilder 8000 4.66.02.016 (рус)
                применяется для создания пользовательских проектов для операторских панелей Weintek следующих серий:
                MT6000i, MT8000i, кроме панелей MT8104XH, MT8150X, MT8121X, для которых последний совместимый дистрибутив — 4.65.12. </p>
              <p>Использование ПО EasyBuilder 8000 полностью бесплатно, вы можете скачивать ПО и пользоваться им без каких-либо ограничений.</p>
              <p>Драйвера USB для подключения панелей к ПК устанавливаются автоматически при установке EasyBuilder 8000.</p>
            </div>
          </div>
          <div class="column is-5">
            <div class="block_padding">
              <p><a class="download_zip" href="/soft/EB8000/EB8000_setup.zip">Дистрибутив 4.66.02.016 (рус) </a> <span class="small_gray_text">[21-12-2016] [122.02&nbsp;Мб]</span></p>
              <p><a class="download_zip" href="/soft/EB8000/EB8000V46512.zip">Дистрибутив 4.65.12 (рус)</a> <span class="small_gray_text">[03-04-2015] [101.04&nbsp;Мб]</span><span class="question">?<span class="note" style="width: 95px;">Для операторских панелей Weintek MT8104XH, MT8150X, MT8121X</span></span></p>
              <p><a class="download_pdf" href="/manuals/UserManualEB8000.pdf">Руководство (eng)</a> <span class="small_gray_text">[08-02-2016] [18.02&nbsp;Мб]</span></p>
            </div>
          </div>
        </div>
        <a id="plc_manual"></a>
        <div class="columns  is-multiline">
          <div class="column is-12 background-gray">
            <div class="block_padding"><span class="page_downloads_title3"><a href="#plc_manual">Руководство по подключению контроллеров (PLC) к  панелям оператора</a></span></div>
          </div>
          <div class="column is-7">
            <div class="block_padding">
              <p>В руководстве описано подключение к более, чем 100 PLC различных производителей,
                даны схемы распайки кабелей для подключения панели оператора к этим PLC, описаны регистры, к которым дают доступ
                драйвера данных PLC.</p>
              <p>Все драйверы для всех PLC, упомянутых в данном руководстве, уже установлены в <a href="/weintek/">операторских панелях Weintek</a>.</p>
              <p>При подключении панели  оператора к конкретному PLC настоятельно рекомендуется ознакомиться с соответсвующим разделом данного руководства.</p>
            </div>
          </div>
          <div class="column is-5">
            <div class="block_padding">
              <p> <a class="download_pdf" href="/manuals/PLC_connection_guide.pdf">Руководство (eng)</a> <span class="small_gray_text">[07-02-2018] [31.07&nbsp;Мб]</span> </p>
            </div>
          </div>
        </div>
        <a id="EasyAccess20"></a>
        <div class="columns  is-multiline">
          <div class="column is-12 background-gray">
            <div class="block_padding"><span class="page_downloads_title3"><a href="#EasyAccess20">EasyAccess 2.0</a></span> &nbsp;&nbsp;&nbsp; серии <a href="/catalog/operator_panels/?&series=MT8000iE">MT8000iE</a>, <a href="/catalog/operator_panels/?&series=eMT3000">eMT3000</a>, <a href="/catalog/operator_panels/?&series=MT8000XE">MT8000XE</a>, <a href="/weintek/mTV-100/">mTV</a>, <a href="/catalog/operator_panels/?&series=cMT">cMT</a>, <a href="/catalog/operator_panels/?&series=cMT-X">cMT X</a></div>
          </div>
          <div class="column is-7">
            <div class="block_padding">
              <p> <a href="/accessories/license/easyaccess/">EasyAccess 2.0</a> служит для установки защищенного соединения
                через бесплатный облачный сервис Weintek с операторскими панелями серий: <a href="/catalog/operator_panels/?&series=MT8000iE">MT8000iE</a>, <a href="/catalog/operator_panels/?&series=eMT3000">eMT3000</a>, <a href="/catalog/operator_panels/?&series=MT8000XE">MT8000XE</a>, <a href="/weintek/mTV-100/">mTV</a>, <a href="/catalog/operator_panels/?&series=cMT">cMT</a>, <a href="/catalog/operator_panels/?&series=cMT-X">cMT X</a> без выделенного IP с персонального компьютера, iPad или Android-планшета. </p>
              <p> Использование ПО <a href="/accessories/license/easyaccess/">EasyAccess 2.0</a> полностью бесплатно,
                вы можете скачивать ПО и пользоваться им без каких-либо ограничений. </p>
              <p> <span style="color: #ea0000;">Для включения функции удаленного доступа в операторской панели необходимо получить ключ активации у менеджера.</span> </p>
            </div>
          </div>
          <div class="column is-5">
            <div class="block_padding">
			<p><strong>EasyAccess 2.0</strong></p>
			<p>Версия для региона Россия:</p>
              <p><a class="download_android" target="_blank" href="/soft/EasyAccess20/Installer/EasyAccess2-2.21.4-dl.apk">Дистрибутив для Android</a> <span class="small_gray_text">[2.21.4]</span></p>
              <p><a class="download_linkext" target="_blank" href="/soft/EasyAccess20/Installer/setup-2.21.4.exe">Дистрибутив для PC</a> <span class="small_gray_text">[2.21.4]</span></p>
              <?
              filter_arr( $items, 'section', 'ea20' );
              ?>
              <p><a class="download_linkext" href="/accessories/license/easyaccess/" style="font-weight: 700;">Подробнее об EasyAccess 2.0</a></p>
				<hr>
              <p><a class="download_android" target="_blank" href="https://play.google.com/store/apps/details?id=com.weintek.easyaccess">Дистрибутив для Android</a> <span class="small_gray_text">[последняя версия]</span></p>
              <p><a class="download_ipad" href="https://apps.apple.com/ru/app/easyaccess-2-0/id977888884">Дистрибутив для iOS</a> <span class="small_gray_text">[App Store]</span></p>
              <?
              filter_arr( $progs, 'section', 'ea20' );
              ?>
            </div>
          </div>
        </div>
        <a id="cMTViewer"></a>
        <div class="columns  is-multiline">
          <div class="column is-12 background-gray">
            <div class="block_padding" id="cMTViewer"> <span class="page_downloads_title3"><a href="#cMTViewer">cMT Viewer</a></span> &nbsp;&nbsp;&nbsp; серии: <a href="/catalog/operator_panels/?&series=cMT">cMT</a>, <a href="/catalog/operator_panels/?&series=cMT-X">cMT-X</a></div>
          </div>
          <div class="column is-7">
            <div class="block_padding">
              <p> cMT Viewer служит для управления серверами <a href="/weintek/cMT-SVR-100/">cMT-SVR</a> при удаленном подключении через с планшета или PC.
                Одно приложение может быть настроено для управления до 253 cMT-SVR и переключения между 3-я в «горячем» режиме.</p>
              <p>Для подключения через Интернет соединение устанавливается с помощью EasyAccess 2.0. </p>
              <p> Использование ПО cMT Viewer полностью бесплатно, вы можете скачивать ПО и пользоваться им без каких-либо ограничений.</p>
            </div>
          </div>
          <div class="column is-5">
            <div class="block_padding">
              <?
              filter_arr( $progs, 'put', 'cMTViewer' );
              //filter_arr( $progs, 'section', 'cmt' );
              //filter_arr( $items, 'section', 'cmt', 'Datasheet', 'Installation', 'Certificate' );
              ?>
              <p><a class="download_android" target="_blank" href="https://play.google.com/store/apps/details?id=com.weintek">Дистрибутив для Android</a> <span class="small_gray_text">[Google Play]</span></p>
              <p><a class="download_ipad" href="https://apps.apple.com/ru/app/cmt-viewer/id553431850">Дистрибутив для iPad</a> <span class="small_gray_text">[App Store]</span></p>
              <p><a class="download_linkext" href="#Weintek">Дистрибутив для PC входит в комплект EasyBuilder&nbsp;Pro</a></p>
            </div>
          </div>
        </div>
        <a id="EasyLauncher"></a>
        <div class="columns  is-multiline">
          <div class="column is-12 background-gray">
            <div class="block_padding"> <a href="#EasyLauncher"><span class="page_downloads_title3">EasyLauncher</span></a> &nbsp;&nbsp;&nbsp; модель <a href="/weintek/cMT-iPC15/">cMT-iPC15</a></div>
          </div>
          <div class="column is-7">
            <div class="block_padding">
              <p>Программное обеспечение для создания <strong>Smart HMI</strong> на панельных компьютерах.</p>
              <p>С помощью <strong>EasyLauncher</strong> легко получить доступ к сторонним приложениям, таким как MS Office, PDF Reader, Media player и другим,
                совместно с <strong>cMT Viewer</strong> можно наблюдать и управлять HMI в одно и тоже время. </p>
              <p>EasyLauncher является средой для запуска приложений на панельных компьютерах,
                например <a href="/weintek/cMT-iPC15/">cMT-iPC15</a>, и позволяет быстро получить доступ к нужным приложениям. </p>
            </div>
          </div>
          <div class="column is-5">
            <div class="block_padding">
              <?
              filter_arr( $progs, 'put', 'EasyLauncher' );
              filter_arr( $items, 'section', 'easylauncher' );
              ?>
            </div>
          </div>
        </div>
        <a id="EasyRemote"></a>
        <div class="columns  is-multiline"><a name="EasyRemote"></a>
          <div class="column is-12 background-gray">
            <div class="block_padding"> <span class="page_downloads_title3"><a href="#EasyRemote">EasyRemote I/O</a></span> для <a href="/plc/weintek/iR-ETN/">Weintek iR-ETN</a></div>
          </div>
          <div class="column is-7">
            <div class="block_padding">
              <p>Приложение EasyRemote I/O - это инструмент для настройки коммутационного модуля Weintek iR-ETN.
                С его помощью можно устанавливать IP адрес, настраивать параметры модуля, просматривать и редактировать значения переменных.</p>
            </div>
          </div>
          <div class="column is-5">
            <div class="block_padding">
              <?
              filter_arr( $progs, 'put', 'EasyRemote' );
              filter_arr( $items, 'title', 'EasyRemoteIO' );
              filter_arr( $progs, 'title', 'cMT+CODESYS' );
              ?>
               <p><a class="download_pdf" href="https://dl.weintek.com/public/cMT/CODESYS/Firmware/CODESYS-ReleaseNotes-eng.pdf" target="_blank">CODESYS Firmware ReleaseNotes</a> </p>
           </div>
          </div>
        </div>
        <div class="columns  is-multiline">
          <div class="column is-7">
            <div class="block_padding">
              <p>Среда разработки CODESYS</p>
            </div>
          </div>
          <div class="column is-5">
            <div class="block_padding">
              <?
              filter_arr( $progs, 'title', 'CODESYS IDE' );
              //	echo '<hr>';
              ?>
            </div>
          </div>
        </div>

	      <div class="columns  is-multiline">
          <div class="column is-7">
            <div class="block_padding">
              <p>Datasheet карты активации CODESYS</p>
            </div>
          </div>
          <div class="column is-5">
            <div class="block_padding">
              <?
              filter_arr( $items, 'title', 'cMT+CODESYS Datasheet' );
              ?>
           </div>
        </div>

        <div class="columns  is-multiline">
          <div class="column is-7">
            <div class="block_padding">
              <p>CODESYS версия 18 (в ней работает ФБ ModbusServer)</p>
            </div>
          </div>
          <div class="column is-5">
            <div class="block_padding">
              <p><a class="download_zip" href="https://drive.google.com/file/d/1H8OnhdGYTa7DZBxzcaobYuHs8gPrfZlA/view?usp=sharing">CODESYS 64 3.5.18.20.zip</a> <span class="small_gray_text">[1.5ГБ]</span></p>
            </div>
          </div>
        </div>
        <div class="columns  is-multiline">
          <div class="column is-7">
            <div class="block_padding">
              <p>Codesys от Weintek . Быстрый старт</p>
            </div>
          </div>
          <div class="column is-5">
            <div class="block_padding">
              <p><a class="download_linkext" href="/articles/codesys-ot-weintek-bystryy-start/">Статья</a></p>
            </div>
          </div>
        </div>
        <div class="columns  is-multiline">
          <div class="column is-7">
            <div class="block_padding">
              <p>Инструкция по использованию панели cMT3090 с программным обеспечением CODESYS совместно с модулем Remote I/O.</p>
            </div>
          </div>
          <div class="column is-5">
            <div class="block_padding">
              <?
              filter_arr( $items, 'title', 'Quick Start Guide' );
              ?>
            </div>
          </div>
        </div>
        <div class="columns  is-multiline">
          <div class="column is-7">
            <div class="block_padding">
              <p>Приложение для обновления прошивок каплеров и модулей</p>
            </div>
          </div>
          <div class="column is-5">
            <div class="block_padding">
              <p><a class="download_zip" href="/soft/EBPro/IO_Runtime_Updata_V1.7.0.0.zip">IO_Runtime_Updata_V1.7.0.0.zip</a> <span class="small_gray_text">[20 МБ]</span></p>
            </div>
          </div>
        </div>
        <a id="SKWorkshop"></a>
        <div class="columns  is-multiline">
          <div class="column is-12">
            <h2 id="Samkoon">Программное обеспечение для операторских панелей Samkoon</h2>
          </div>
          <div class="column is-12 background-gray">
            <div class="block_padding"> <span class="page_downloads_title3">SK Workshop</span> </div>
          </div>
          <div class="column is-7">
            <div class="block_padding">
              <p> ПО SK Workshop  - программное обеспечение для создания проектов для <a href="/samkoon/">операторских панелей Samkoon серии SK</a>.
                ПО полностью бесплатно, его можно скачивать и пользоваться без каких-либо ограничений.
                После установки ПО необходимо установиь драйвера USB для загрузки проекта в операторскую панель по USB. </p>
            </div>
          </div>
          <div class="column is-5">
            <div class="block_padding">
              <p><a class="download_zip" href="/soft/SKWorkshop/setup_SKWorkshopv5_0_2.rar">Дистрибутив 5.0.2.63</a> <span class="small_gray_text">[18-10-2016] [73.18&nbsp;Мб]</span></p>
              <p><a class="download_pdf" href="/manuals/SK-User%20manual_RUS.pdf">Руководство (eng)</a> <span class="small_gray_text">[20-08-2013] [29.45&nbsp;Мб]</span></p>
            </div>
          </div>
          <div class="column is-12 background-gray">
            <div class="block_padding"> <span class="page_downloads_title3">AK Workshop</span> </div>
          </div>
          <div class="column is-7">
            <div class="block_padding">
              <p> ПО AK Workshop - программное обеспечение для создания проектов для <a target="_blank" href="/samkoon/#series-AK">операторских панелей Samkoon серии AK</a>.
                ПО полностью бесплатно, его можно скачивать и пользоваться без каких-либо ограничений.
                После установки ПО необходимо установиь драйвера USB для загрузки проекта в операторскую панель по USB. </p>
            </div>
          </div>
          <div class="column is-5">
            <div class="block_padding">
              <p><a class="download_zip" href="/soft/AKTOOL/AK1.1.3.528.rar">Дистрибутив AK1.1.3.528</a> <span class="small_gray_text">[386 МБ]</span></p>
              <p><a class="download_zip" href='/soft/AKTOOL/AKWorkShop-user-manual.zip'>Руководство по AKWorkshop</a> <span class="small_gray_text">[EN, 14 МБ]</span></p>
            </div>
          </div>
        </div>
        <a id="SKTOOL"></a>
        <div class="columns  is-multiline">
          <div class="column is-12 background-gray">
            <div class="block_padding"> <span class="page_downloads_title3">SKTOOL</span> </div>
          </div>
          <div class="column is-7">
            <div class="block_padding">
              <p> ПО SKTOOL - программное обеспечение для создания проектов для операторских панелей Samkoon: SK-035F, SK-043F, SK-043H, SK-050H, SK-070F, SK-070H,SK-070F, SK-102H, SK-121F.
                ПО полностью бесплатно, его можно скачивать и пользоваться без каких-либо ограничений. </p>
            </div>
          </div>
          <div class="column is-5">
            <div class="block_padding">
              <p><a class="download_zip" href="/soft/SKTOOL/setup_SKTOOL.rar">Дистрибутив 7.1.0.53</a> <span class="small_gray_text">[08-08-2024] [473&nbsp;Мб]</span></p>
              <p><a class="download_pdf" href="/soft/SKTOOL/SKTOOL_Help.pdf">Руководство (eng)</a> <span class="small_gray_text">[23-06-2017] [18.4&nbsp;Мб]</span></p>
            </div>
          </div>
        </div>
        <div class="columns  is-multiline">
          <div class="column is-12 background-gray">
            <div class="block_padding"> <span class="page_downloads_title3">USB-драйвера</span> </div>
          </div>
          <div class="column is-7">
            <div class="block_padding">
              <p>Драйвера USB для загрузки проекта с ПК в <a href="/samkoon/">операторские панели Samkoon</a></p>
            </div>
          </div>
          <div class="column is-5">
            <div class="block_padding">
              <p><a class="download_zip" href="/soft/SKWorkshop/usb_drivers_sk_series.rar">Дистрибутив 5.0.2.63 от 16.10.16 </a> <span class="small_gray_text">[20-12-2016] [6.8&nbsp;Мб]</span></p>
            </div>
          </div>
        </div>
        <a id="rf_series_drivers"></a>
        <div class="columns  is-multiline">
          <div class="column is-12">
            <h2 id="IFC">Программное обеспечение для промышленных компьютеров и мониторов IFC</h2>
          </div>
          <div class="column is-12 background-gray">
            <div class="block_padding"> <span class="page_downloads_title3">Драйвера для панельных компьютеров серии&nbsp;RF</span> </div>
          </div>
          <div class="column is-7">
            <div class="block_padding">
              <p> Драйвера для <a href="/catalog/panel_computers/?&series=RF">панельных компьютеров IFC серии&nbsp;RF</a> предназначены для операционных систем Windows®&nbsp;7, Windows®&nbsp;XP. </p>
            </div>
          </div>
          <div class="column is-5">
            <div class="block_padding">
              <p><a class="download_zip" href="/soft/IFC_drivers/rf_series_drivers.rar">Дистрибутив (рус)</a> <span class="small_gray_text">[09-12-2015] [171.68&nbsp;Мб]</span></p>
            </div>
          </div>
        </div>
        <a id="WIFI_Driver"></a>
        <div class="columns  is-multiline">
          <div class="column is-12 background-gray">
            <div class="block_padding"> <span class="page_downloads_title3">Драйвера для модуля Wi-Fi</span> </div>
          </div>
          <div class="column is-7">
            <div class="block_padding">
              <p> Драйвера для модуля Wi-Fi подходят для всех компьютеров IFC с miniPCIe ( <a href="/catalog/embedded_computers/?&brand=IFC">IFC серия BOX</a> ). </p>
            </div>
          </div>
          <div class="column is-5">
            <div class="block_padding">
              <p><a class="download_zip" href="/soft/IFC_drivers/Intel_2230_WIFI_Driver.rar">Дистрибутив (рус)</a> <span class="small_gray_text">[03-04-2015] [131.05&nbsp;Мб]</span></p>
            </div>
          </div>
        </div>
        <a id="Huawei_WinDriver"></a>
        <div class="columns  is-multiline">
          <div class="column is-12 background-gray">
            <div class="block_padding"> <span class="page_downloads_title3">Драйвера для модуля 3G</span> </div>
          </div>
          <div class="column is-7">
            <div class="block_padding">
              <p> Драйвера для модуля 3G предназначены для компьютеров <a href="/ifc/IFC-BOX2600/">IFC-BOX2600</a>, <a href="/ifc/IFC-BOX2800/">IFC-BOX2800</a>, <a href="/ifc/IFC-BOX4000/">IFC-BOX4000</a> и <a href="/ifc/IFC-BOX2800/">IFC-MBOX2800</a>. </p>
            </div>
          </div>
          <div class="column is-5">
            <div class="block_padding">
              <p><a class="download_zip" href="/soft/IFC_drivers/Huawei_WinDriver.zip">Дистрибутив (рус)</a> <span class="small_gray_text">[03-04-2015] [30.71&nbsp;Мб]</span></p>
            </div>
          </div>
        </div>
        <div class="columns  is-multiline">
          <div class="column is-12 background-gray">
            <div class="block_padding"> <span class="page_downloads_title3">Пример работы с входами и выходами встраиваемых компьютеров IFC</span> </div>
          </div>
          <div class="column is-7">
            <div class="block_padding">
              <p> Пример работы с входами и выходами встраиваемых компьютеров IFC будет полезен при начале работы с <a href="/ifc/IFC-BOX2600/">IFC-BOX2600</a> и <a href="/ifc/IFC-BOX2800/">IFC-BOX2800</a>. </p>
            </div>
          </div>
          <div class="column is-5">
            <div class="block_padding">
              <p><a class="download_zip" href="/soft/IFC_drivers/IFC_BOX2600_GPIO_Routine.zip">Дистрибутив (рус)</a> <span class="small_gray_text">[03-04-2015] [53&nbsp;Кб]</span></p>
            </div>
          </div>
        </div>
        <a id="IFC"></a>
        <div class="columns  is-multiline">
          <div class="column is-12 background-gray">
            <div class="block_padding"> <span class="page_downloads_title3">Драйвер для мониторов IFC</span> </div>
          </div>
          <div class="column is-7">
            <div class="block_padding">
              <p> Драйвер для мониторов IFC  обеспечивает работу touch-screen в Windows®&nbsp;7, Windows®&nbsp;8, Windows®&nbsp;8.1 </p>
            </div>
          </div>
          <div class="column is-5">
            <div class="block_padding">
              <p><a class="download_zip" href="/soft/IFC_drivers/eGalaxTouch.zip">Дистрибутив (рус)</a> <span class="small_gray_text">[03-04-2015] [10.33&nbsp;Мб]</span></p>
              <p><span id="eeti"><a class="download_linkext" rel="nofollow" href="https://www.eeti.com/drivers.html">Драйвера для других операционных систем</a></span></p>
            </div>
          </div>
        </div>
        <a id="Aplex"></a>
        <div class="columns  is-multiline">
          <div class="column is-12">
            <h2 id="Aplex">Программное обеспечение для панельных компьютеров Aplex</h2>
          </div>
          <div class="column is-12 background-gray">
            <div class="block_padding"> <span class="page_downloads_title3">Драйвера для панельных компьютеров Aplex </span> </div>
          </div>
          <div class="column is-7">
            <div class="block_padding">
              <p> Драйвера для <a href="/panelnie-computery/aplex/">панельных компьютеров Aplex</a> предназначены для операционных систем Windows®&nbsp;7, Windows®&nbsp;XP. </p>
            </div>
          </div>
          <div class="column is-5">
            <div class="block_padding">
              <p><a class="download_zip" href="/soft/aplex/aplex_drivers.rar">Дистрибутив (рус)</a> <span class="small_gray_text">[08-06-2015] [196&nbsp;Мб]</span></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</article>
<?php
require_once $_SERVER[ 'DOCUMENT_ROOT' ] . "/abacus/epilog.php";
