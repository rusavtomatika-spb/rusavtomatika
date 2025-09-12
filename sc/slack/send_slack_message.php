<?php
// отправка сообщений в Slack
function slack($message, $channel, $attach) {
    $botIcon = "http://" . $_SERVER['SERVER_NAME'] . "/sc/slack/ico.png";
    $message = iconv("Windows-1251", "UTF-8", $message);
    $attach = iconv("Windows-1251", "UTF-8", $attach);
    $ch = curl_init("https://slack.com/api/chat.postMessage");
    $data = http_build_query([
        "token" => "xoxp-459440375587-459363242628-469829035637-84a5cb669554b87bd4e1f238f9b07f62",
        "channel" => $channel, //"#mychannel",
        "text" => $message, //"Hello, Foo-Bar channel message.",
        "attachments" => $attach,
        "username" => "FAM BOT",
        "icon_url" => $botIcon
    ]);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
}
