<?
if (empty($_COOKIE['a'])) {
    setcookie("a", "r", time() + 60 * 60 * 24 * 365, "/", $_SERVER['SERVER_NAME'], 0);
//header('Location: /_right.php');
};
if ($_COOKIE['a'] == 'r') {
    echo '<h1>Permission is granted, my Lord!</h1>';
    ?>
    <div class="menu-bar">
        <ul>
            <li><a href="/search/">Поиск</a></li>
            <li><a href="/search/index_index.php">Индексация</a></li>
            <li><a href="/search/index_weight_map.php">Карта весов</a></li>
            <li><a href="/search/statistics.php">Статистика запросов</a></li>
        </ul>
    </div>        
    <?
} else {
    echo '<h1>Permission is granted, my Lord!</h1>';
    ?>
    <div class="menu-bar">
        <ul>
            <li><a href="/search/">Поиск</a></li>
            <li><a href="/search/index_index.php">Индексация</a></li>
            <li><a href="/search/index_weight_map.php">Карта весов</a></li>
        </ul>
    </div>        
    <?
};
?>
