<?php

if (isset($_GET['qr'])) {
    handleQRCode($_GET['qr']);
}

function handleQRCode($qr_code) {
    $gifts = ['Тубус' => '1',
        'Календарь' => '2'];

    $gift = array_search($qr_code, $gifts);

    include 'lib_browser.php';

    function slack($message, $channel, $attach) {
        $message = iconv("Windows-1251", "UTF-8", $message);
        $attach = iconv("Windows-1251", "UTF-8", $attach);
        $ch = curl_init("https://slack.com/api/chat.postMessage");
        $data = http_build_query([
            "token" => "xoxp-459440375587-459363242628-469829035637-84a5cb669554b87bd4e1f238f9b07f62",
            "channel" => $channel, //"#mychannel",
            "text" => $message, //"Hello, Foo-Bar channel message.",
            "attachments" => $attach,
            "username" => "FAM BOT",
            "icon_url" => "http://www.rusavto.moisait.net/ico.png"
        ]);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    $client = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote = @$_SERVER['REMOTE_ADDR'];
    $result = array('country' => '', 'city' => '');

    if (filter_var($client, FILTER_VALIDATE_IP))
        $ip = $client;
    elseif (filter_var($forward, FILTER_VALIDATE_IP))
        $ip = $forward;
    else
        $ip = $remote;

    $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
    if ($ip_data && $ip_data->geoplugin_countryName != null) {
        $geo_country = $ip_data->geoplugin_countryName;
        $geo_city = $ip_data->geoplugin_city;
    }

    echo $geo_country . "->" . $geo_city;

    $date = date("d/m/Y  H:i:s", $_SERVER["REQUEST_TIME"]);
    echo 'Время отправки' . $date;



    $browser = new Browser();
    $attach = '[{"color": "#36a64f", "text": "Подарок:' . $gift . '", "title": "Был просканирован QR код","fields": [
                {
                    "title": "Страна",
                    "value": "' . $geo_country . '",
                    "short": true
                },
                {
                    "title": "Город",
                    "value": "' . $geo_city . '",
                    "short": true
                },
                 {
                    "title": "IP-адрес",
                    "value": "' . $ip . '",
                    "short": true
                },
                 {
                    "title": "Время отправки",
                    "value": "' . $date . '",
                    "short": true
                },
                 {
                    "title": "Браузер",
                    "value": "' . $browser->getBrowser() . '",
                    "short": true
                }
                ,
                 {
                    "title": "Версия браузера",
                    "value": "' . $browser->getVersion() . '",
                    "short": true
                }
                ,
                 {
                    "title": "Операционная система",
                    "value": "' . $browser->getPlatform() . '",
                    "short": true
                }' . ($browser->isMobile() ? ',
                 {
                    "title": "Платформа",
                    "value": "Мобильный",
                    "short": true
                },' : ',
                 {
                    "title": "Платформа",
                    "value": "ПК",
                    "short": true
                }') . '
            ],}]';

    slack($tabs_block, '#qr_codes_scan', $attach);
}
