<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/prolog.php";

global $TITLE, $DESCRIPTION, $H1;

$TITLE = "Распродажа | Акции и скидки | Русавтоматика";
$DESCRIPTION = "Акционные товары, распродажа, уцененные позиции со скидкой";
$H1 = "Распродажа";

?>

<div class="sale-categories">
    <h1><?= $H1 ?></h1>
    
    <div class="sale-category">
    </div>

</div>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/epilog.php";
?>