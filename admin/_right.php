<?

if (empty($_COOKIE['a'])) {
    setcookie("a", "r", time() + 60 * 60 * 24 * 365, "/", $_SERVER['SERVER_NAME'], 0);
//header('Location: /_right.php');
};
if ($_COOKIE['a'] == 'r') {
    echo 'ok';
} else {
    echo 'wow,sorry!';
};
?>