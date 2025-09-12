<?php
global $CONTENT_ON_WIDE_SCREEN;
$CONTENT_ON_WIDE_SCREEN = false;
require_once $_SERVER[ 'DOCUMENT_ROOT' ] . "/abacus/prolog.php";
global $TITLE, $CANONICAL;
$TITLE = "Weintek, таблица сравнения серий по функционалу iP, cMT, cMT X, iE, iER, XE, mTV, cMT Gateway, eMT";
$CANONICAL = "https://www.rusavtomatika.com/weintek-stavnenie-seriy/";
$DESCRIPTION = 'В сводной таблице Вы сможете произвести сравнение различных параметров продукции Weintek по сериям. Параметры распределены по группам: Ограничения памяти, Загрузка проекта, ,Функциональные возможност Дополнительные интерфейсы, Доступные объекты в EasyBuilder, Объекты IIoT и контроль энергопотребления, Объекты работы с данными, Утилиты';

//---------------content ---------------------

?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
<style>
	.divider {
		max-height: 1px !important;
		background-color:#A3A3A3 !important;
		padding: 0 !important;
		line-height: 1px;
	}
.note-link {
	position: absolute;
	font-size: 8pt;       /* размер текста сноски */
	line-height: 1em;     /* высота строки равна высоте текста */
	display: inline-block;
	top: 5px; /* Выравниваем сверху */
    right: 5px; /* Выравниваем справа */
	padding: 0 2px;      /* небольшой отступ вокруг текста */
	text-decoration: none;/* убираем подчёркивание ссылки */
}
.tcol {
	z-index: 1000;
	min-width: 300px;
	position: relative;
}
.rus {
	font-size: 0.75rem;       /* размер текста сноски */
}
.rus strong {
	font-size: 0.9rem;       /* размер текста сноски */
	font-weight: bold;
}
.theader {
	z-index: 1200;
}
.tdata {
	z-index: 900;
}
.scroll-buttons {
	display: flex;
	justify-content: space-between;
	position: relative;
	user-select: none;
}
.scroll-btn {
	position: fixed;
	display: flex;
	align-items: center;
	justify-content: center;
	width: 70px;
	height: 70px;
	border-radius: 50%;
	background-color: rgba(0, 0, 0, 0.03);
	color: #fff;
	font-weight: bold;
	outline: none;
	border: none;
	cursor: pointer;
	transition: background-color 0.03s ease;
	z-index: 10;
}
.scroll-btn:hover, .scroll-btn:focus {
	background-color: rgba(0, 173, 97, 1);
	color: #fff; /* Акцентный цвет */
}
.scroll-left {
	left: 10px;
}
.scroll-right {
	right: 10px;
}
.arrow {
	border: solid #333;
	border-width: 0 3px 3px 0;
	display: inline-block;
	padding: 3px;
	transition: transform 0.3s ease;
}
.left {
	transform: rotate(135deg) scale(2);
}
.right {
	transform: rotate(-45deg) scale(2);
}
.scroll-btn:hover .arrow, .scroll-btn:focus .arrow {
	border-color: #fff; /* Акцентный цвет */
}
.wrapper {
	position: relative;
	display: flex;
	align-items: center;
	justify-content: center;
	gap: 1rem;
}
.scroll-left {
	position: fixed;
	left: 10px;
	top: 50%;
	font-size: 20px;
}
.scroll-right {
	position: fixed;
	right: 10px;
	top: 50%;
	font-size: 20px;
}
th {
	font-weight: normal;
}
.table-other {
	font-size: 0.8rem;
	line-height: 0.8rem;
	min-width: 100px;
}
.notes {
	margin-top: 20px;
	font-size: 0.8rem;
	line-height: 1.1rem;
}
.top4ik {
	top: 40px;
}
.srav {
	width: 100%;
	margin-left: -10px;
	margin-right: -10px;
	max-height:1080px;
	overflow-x: auto;       /* Добавляем горизонтальную прокрутку */
	overflow-y: auto;       /* Добавляем горизонтальную прокрутку */
}
h3 {
	color: #00AD61;
}
</style>
<?


?>
<?php
// Данные подключения к базе данных

$host = "localhost"; // Имя хоста
$port = "3306"; // Номер порта, 3306 - по умолчанию
if ( $_SERVER[ 'DOCUMENT_ROOT' ] == '/home/weblec/public_html/rusavtomatika.com' ) {
  $user = "root"; // Имя пользователя
  $pass = '123456'; // Пароль
  $dbnm = "rusavtomatika_db";
} elseif ( preg_match( "/www.test.rusavtomatika.com/i", $_SERVER[ 'HTTP_HOST' ] ) ) {
  $user = "root"; // Имя пользователя
  $pass = '123456'; // Пароль
  $dbnm = "rusavtomatika_db";
} elseif ( preg_match( "/moisait/i", $_SERVER[ 'DOCUMENT_ROOT' ] ) ) {
  $user = "root"; // Имя пользователя
  $pass = '123456'; // Пароль
  $dbnm = "rusavtomatika_db";
} elseif ( preg_match( "/olgaglr/i", $_SERVER[ 'DOCUMENT_ROOT' ] ) ) {
  $port = "3306"; // Номер порта, 3306 - по умолчанию
  $user = "root"; // Имя пользователя
  $pass = '123456'; // Пароль
  $dbnm = "rusavtomatika_db";
} else {
  $user = "root"; // Имя пользователя
  $pass = '123456'; // Пароль
  $dbnm = "rusavtomatika_db";
}


// Создаем подключение к базе данных
$pdo = new PDO( "mysql:host=$host;dbname=$dbnm", $user, $pass );
$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
?>

<body class="m-5">
<!--div class="container mt-5"-->
<h1 class="mb-4">Weintek, таблица сравнения серий: iP, cMT, cMT X, iE, iER, XE, mTV, cMT Gateway, eMT</h1>
<p>Выберите серии для сравнения:</p>
<form method="GET" action="">
  <div class="btn-group1" role="group" aria-label="Фильтр по сериям">
    <?php
    // Получаем список серий
    $stmt = $pdo->prepare( 'SELECT * FROM sravnenie_serie ORDER by sort' );
    $stmt->execute();
    $series = $stmt->fetchAll( PDO::FETCH_ASSOC );
    //file_put_contents('get.txt',json_encode($_GET[ 'serie' ]));

    foreach ( $series as $serie ) {
      // Проверка на наличие параметров в $_GET
      if ( empty( $_GET ) ) {
        $checked = ( $serie[ 'id' ] == 3 || $serie[ 'id' ] == 9 ) ? 'checked' : '';
      } else {
        $checked = in_array( $serie[ 'id' ], $_GET[ 'serie' ] ) ? 'checked' : '';
      }
      echo '<input type="checkbox" class="btn-check" id="serie-' . $serie[ 'id' ] . '" name="serie[]" value="' . $serie[ 'id' ] . '" ' . $checked . ' autocomplete="off">
                      <label class="btn" for="serie-' . $serie[ 'id' ] . '">' . $serie[ 'serie_name' ] . '</label>';
    }
    ?>
    <button type="submit" class="btn" style="margin-left: 25px; background-color: #00ad61; color: white;">Применить</button>
  </div>
</form>
<br>
<?php
//var_dump($_GET);
try {
  // Создаем подключение к базе данных
  $pdo = new PDO( "mysql:host=$host;dbname=$dbnm", $user, $pass );
  $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

  // Получаем список всех функций и их групп
  $stmt = $pdo->prepare( 'SELECT f.*, fg.rus AS group_rus FROM sravnenie_function f JOIN sravnenie_function_grupp fg ON f.grupp_id = fg.id ORDER BY fg.id' );
  $stmt->execute();
  $functions = $stmt->fetchAll( PDO::FETCH_ASSOC );

  // Получаем список моделей без фильтров
  $stmt = $pdo->prepare( 'SELECT m.*, s.serie_name FROM sravnenie_models m JOIN sravnenie_serie s ON m.serie_id = s.id ORDER BY s.sort' );
  $stmt->execute();
  $models = $stmt->fetchAll( PDO::FETCH_ASSOC );

  // Фильтруем модели по выбранным сериям
  if ( isset( $_GET[ 'serie' ] ) ) {
    $selected_series = $_GET[ 'serie' ];
    //file_put_contents('get.txt',json_encode($_GET[ 'serie' ]));
    $models = array_filter( $models, function ( $model )use( $selected_series ) {
      return in_array( $model[ 'serie_id' ], $selected_series );
    } );
  } else {
    $selected_series = array( '3', '9' );
    $models = array_filter( $models, function ( $model )use( $selected_series ) {
      return in_array( $model[ 'serie_id' ], $selected_series );
    } );
  }

  // Формируем массив для хранения параметров каждой модели
  foreach ( $models as & $model ) {
    $model[ 'parameters' ] = [];
  }

  // Получаем параметры для каждой функции и модели
  $stmt = $pdo->prepare( 'SELECT models_id, function_id, param, note_id FROM sravnenie_parameters' );
  $stmt->execute();
  while ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ) {
    // Назначаем параметры соответствующей модели
    foreach ( $models as & $model ) {
      if ( $model[ 'id' ] == $row[ 'models_id' ] ) {
        $model[ 'parameters' ][ $row[ 'function_id' ] ] = [
          'param' => $row[ 'param' ],
          'note_id' => $row[ 'note_id' ]
        ];
        break;
      }
    }
  }

  // Получаем список всех сносок
  $stmt = $pdo->prepare( 'SELECT * FROM sravnenie_notes' );
  $stmt->execute();
  $notes = $stmt->fetchAll( PDO::FETCH_ASSOC );
	

  // Начало построения таблицы
  echo '<div class="wrapper">    <button class="scroll-left scroll-btn is-hidden"><i class="arrow left"></i></button>';
  echo '<div id="srav" class="srav">';
  echo '<table id="ptable" class="table table-hover is-bordered is-fullwidth">';

  // Шапка таблицы
  echo '<thead class="header1 table-light" id="myHeader">';
  echo '<tr>';
  echo '<th scope="col" class="text-end align-middle theader has-background-white" style="border:0px;"></th>';
  $current_serie = '';
  foreach ( $models as $mod ) {
    if ( $current_serie !== $mod[ 'serie_name' ] ) {
      if ( $current_serie !== '' ) {
        echo '</th>';
      }
      echo '<th class="text-center theader" colspan="' . count( array_filter( $models, function ( $m )use( $mod ) {
        return $m[ 'serie_name' ] === $mod[ 'serie_name' ];
      } ) ) . '">Серия <strong>' . $mod[ 'serie_name' ] . '</strong></th>';
      $current_serie = $mod[ 'serie_name' ];
    }
  }
  echo '</tr>';
  echo '<tr>';
  echo '<th class="text-end align-middle has-background-white" scope="col" style="border:0px;"></th>';
  foreach ( $models as $mod ) {
    echo "<th scope='col' class='table-other text-center theader align-top'>" . str_replace( ', ', '<br>', $mod[ 'model' ] ) . "</th>";
  }
  echo '</tr>';
  echo '<tr>';
  echo '<th class="text-end align-middle theader has-background-white divider" scope="col" style="border:0px;">&nbsp;</th>';
  foreach ( $models as $mod ) {
    echo "<th scope='col' class='table-other text-center theader align-top divider'></th>";
  }
  echo '</tr>';
  echo '</thead>';
  echo '<tbody>';

  // Тело таблицы
  $current_group = '';
  foreach ( $functions as $func ) {
    if ( $current_group !== $func[ 'group_rus' ] ) {
      if ( !empty( $current_group ) ) {}
      echo '<tr><td class="tcol1" colspan="' . ( count( $models ) + 1 ) . '" style="font-weight: bold;"><h3>' . $func[ 'group_rus' ] . '</h3></td></tr>';
      $current_group = $func[ 'group_rus' ];
    }
	  $current_func = $func[ 'id' ];
    echo '<tr>';
// Выполнение подготовленного запроса
$stmt = $pdo->prepare("SELECT note_id AS note FROM sravnenie_parameters WHERE note_id IS NOT NULL AND function_id = $current_func");
$stmt->execute();

// Получение результата
$notess = $stmt->fetch(PDO::FETCH_ASSOC);
if ($notess['note']) {
    //echo "Заметки для функции №{$functionId}: ";
//		  ob_start();
//		  echo '<pre>';
//		  var_dump($notes);
//		  echo '</pre>';
//$snoska = ob_get_clean(); // получаем весь накопившийся вывод и очищаем буфер
$snoska = '<div class="note-link"><a href="#note-1">'.$notess['note'].'</a></div>'; // получаем весь накопившийся вывод и очищаем буфер
} else {
        $snoska = '';
}
    echo "<td class='table-light tcol rus'><strong>{$func['eng']}</strong><br>{$func['rus']} {$snoska}</td>";
    foreach ( $models as $mod ) {
      $param_value = isset( $mod[ 'parameters' ][ $func[ 'id' ] ] ) ? $mod[ 'parameters' ][ $func[ 'id' ] ][ 'param' ] : 'N/A';
      $note_id = isset( $mod[ 'parameters' ][ $func[ 'id' ] ] ) ? $mod[ 'parameters' ][ $func[ 'id' ] ][ 'note_id' ] : null;
      if ( $param_value === 'N/A' ) {
        $class = 'text-danger';
        $cell_content = '<td class="text-center tdata align-middle"><i class="' . $class . ' bi bi-x-square h3"></i>';
      } elseif ( $param_value === 'Y' ) {
        $class = 'text-success';
        $cell_content = '<td class="text-center tdata align-middle"><i class="' . $class . ' bi bi-check-square-fill h3"></i>';
      } else {
        $class = 'table-other';
        $cell_content = "<td class='$class text-center tdata align-middle'><div class='tdata'>$param_value</div>";
      }
    
      $cell_content .= '</td>';
      echo $cell_content;
    }
    echo '</tr>';
  }
  echo '</tbody>';
  echo '</table>';
  echo '</div>';
  echo '<button class="scroll-right scroll-btn is-hidden"><i class="arrow right"></i></button>';

  echo '</div>';

  // Вывод списка сносок
  echo '<div class="notes" id="snoski">';
  foreach ( $notes as $note ) {
    $ndescr = preg_replace_callback( '/\b\d{8}\b/', function ( $matches ) {
      // Конвертируем дату из YYYYMMDD в объект DateTime
      $dt = new DateTime( $matches[ 0 ] );
      // Форматируем дату в нужный формат (dd.mm.yyyy)
      return 'c ' . $dt->format( 'd.m.Y' );
    }, $note[ 'note_description' ] );
    echo '<span id="note-' . $note[ 'id' ] . '"><strong>' . $note[ 'id' ] . '</strong> - ' . $ndescr . '</span><br>';
  }
  echo '</div>';
} catch ( PDOException $e ) {
  die( "Ошибка подключения к базе данных: " . $e->getMessage() );
}
?>
<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function () {
    // Удаляем хэш (#note-14)
    history.replaceState(null, null, location.href.split('#')[0]);
});


	document.addEventListener('DOMContentLoaded', function() {
    var myDiv = document.getElementById('srav');
    var mySbuttons = document.querySelectorAll('.scroll-btn');
    //var myHeader = document.getElementById('myHeader');
    var myTable = document.getElementById('ptable');

    checkOverflow(); // Первичная проверка

    // Перепроверка при изменении размера окна
    window.addEventListener('resize', checkOverflow);

    function checkOverflow() {
        if(myTable.offsetWidth > myDiv.clientWidth){
            myDiv.classList.add('sr_wrap111'); // Добавляем класс
        } else {
            myDiv.classList.remove('sr_wrap111'); // Убираем класс
        }
        if(myTable.offsetWidth > myDiv.clientWidth){
            //myHeader.classList.remove('top4ik'); // Убираем класс
			mySbuttons.forEach(function(el) {
    el.classList.remove('is-hidden');
});
        } else {
            //myHeader.classList.add('top4ik'); // Добавляем класс
			mySbuttons.forEach(function(el) {
    el.classList.add('is-hidden');
});
        }
		
		
    }
});
	
	
document.addEventListener('DOMContentLoaded', function() {
    const container = document.querySelector('.srav');
    const btnLeft = document.querySelector('.scroll-left');
    const btnRight = document.querySelector('.scroll-right');

    // Простые функции прокрутки
    btnLeft.addEventListener('click', function() {
        container.scrollLeft -= 50; // Перемещаемся назад на 50 пикселей
    });

    btnRight.addEventListener('click', function() {
        container.scrollLeft += 50; // Перемещаемся вперед на 50 пикселей
    });
});
	
    document.getElementById("srav").addEventListener("scroll", function(){
		
    var translatey = "translate(" + this.scrollLeft + "px,0)";
    var tcols = this.querySelectorAll(".tcol");
    tcols.forEach(function(tcol) {
    tcol.style.transform = translatey;
    tcol.style.zIndex = '1000';
    });
		
    var translate = "translate(0,"+this.scrollTop+"px)";
    var theads = this.querySelectorAll(".theader");
    theads.forEach(function(thead) {
    thead.style.transform = translate;
    thead.style.zIndex = '2000';
    });
});

    </script>
<?
?>

<!-- Подключаем JavaScript-файлы Bootstrap --> 
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<?php
require_once $_SERVER[ 'DOCUMENT_ROOT' ] . "/abacus/epilog.php";
