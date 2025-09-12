
<?


if (isset($_GET['qr'])) {




$qr_code = $_GET['qr'];
if (isset($qr_code)) {

    $gifts = [
        '1' => 'EasyAccess2.0',
        '2' => 'Weintek',
        '3' => 'MQTT',
        '4' => 'Видео MySQL',
        '5' => 'Серия cMT',
        '6' => 'CODESYS',
        '7' => 'cMT-FHD',
        '8' => 'cMT-iM21',
        '9' => 'cMT3103',
        '10' => 'Серия iR',

    ];
    $gift = $gifts[$qr_code];

    if (array_key_exists($qr_code, $gifts)) {
        define('true_qr_scan', true);


        include $_SERVER['DOCUMENT_ROOT'] . '/sc/QRCode/lib_browser.php';
        include $_SERVER['DOCUMENT_ROOT'] . '/sc/slack/send_slack_message.php';
        include $_SERVER['DOCUMENT_ROOT'] . '/sc/QRCode/lib_detectLocation.php';
        include $_SERVER['DOCUMENT_ROOT'] . '/sc/QRCode/qr_to_base.php';

        $httpUserAgent = $_SERVER['HTTP_USER_AGENT'];
        $browser = new Browser();

        $array_qr["source"] = $gift;
        $array_qr["country"] = $geo_country;
        $array_qr["city"] = $geo_city;
        $array_qr["ip"] = $ip;
        $array_qr["browser"] = $browser->getBrowser();
        $array_qr["browser_ver"] = $browser->getVersion();
        $array_qr["os"] = $browser->getPlatform();
        $array_qr["device"] = ($browser->isMobile() ? "Мобильный" : "ПК");
        $array_qr["time"] = $date;
        $array_qr["http_user_agent"] = $httpUserAgent;


        require_once $_SERVER['DOCUMENT_ROOT'] . '/sc/lib_new_includes/inc_dbconnect.php';
        global $db;


        $query = "SELECT * FROM `qr_codes` WHERE (ip LIKE '{$array_qr["ip"]}' and http_user_agent LIKE '{$array_qr["http_user_agent"]}')
ORDER BY `qr_codes`.`time` DESC";
    $result = mysqli_query($db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($db));

        $last_qr = $result->fetch_object();

        $last_qr = $_SERVER["REQUEST_TIME"] - $last_qr->time;
        if($last_qr > 5){
            add_message($array_qr);
        }





        //slack($text, '#qr_codes_scan', $attach);
        //echo slack("hello", '#qr_codes_scan', "");
        ?>

        <?
    }
}
}
?>




