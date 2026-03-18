<? require_once $_SERVER[ 'DOCUMENT_ROOT' ] . "/abacus/prolog.php";
//database_connect();
ini_set("display_errors", 0);
ini_set("display_startup_errors", 0);
ini_set("error_reporting", E_ALL & ~E_WARNING );
$query = "SELECT * FROM `subscription`";
$res = mysql_query( $query )or die( mysql_error() );
//$res = mysql_fetch_assoc( $res );
$recs = '';
while ($row = mysql_fetch_assoc($res)) {
    //$recs[] = $row;
	$recs .= $row['email'].PHP_EOL;
}
file_put_contents('subs.txt',$recs);
	//var_dump($recs);
	//echo '<hr>';
	?>
	<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/epilog.php"; ?>