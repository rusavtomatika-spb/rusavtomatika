<?
header('Content-type: text/html; charset=windows-1251');
if (1) {
    ini_set('error_reporting', E_ALL & ~E_DEPRECATED);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
}
define('including', true);
require_once $_SERVER['DOCUMENT_ROOT'].'/orders/functions/prolog.php';
?>
<div id="page">
    
</div>
<?
require_once 'functions/epilog.php';
?>

