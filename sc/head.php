<?

if ($_SERVER['DOCUMENT_ROOT'] == '/home/weblec/public_html/rusavtomatika.com') {
    $base = "http://www.rusavtomatika.com";
} else {
    $base = "http://moisait.net/rusavto/";
};
$template_file = 'head.html';

$head = file_get_contents("../sc/" . $template_file);
$head = str_replace('[>TITLE<]', $title, $head);
$head = str_replace('[>DESCRIPTION<]', $description, $head);
$head = str_replace('[>KEYWORDS<]', $keywords, $head);
$head = str_replace('[>BASE<]', $base, $head);
?>