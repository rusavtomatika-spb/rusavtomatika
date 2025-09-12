<?


if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
{
	
define("bullshit",1);

$aj = 1;	
if ((empty($_POST['EMAIL'])) OR ($_POST['EMAIL'] == 'undefined')) {
$auu = $_SERVER['DOCUMENT_ROOT']."/sc/au.php";
} else {
$auu = $_SERVER['DOCUMENT_ROOT']."/sc/rg.php";	
};
if (file_exists($auu)) {

include_once($auu);
	};

} else {
	
echo '450';	
};