<?php

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


$url = "http://www.geoplugin.net/json.gp?ip=" . $ip;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec($ch);
curl_close($ch);

$ip_data = json_decode($data);
if ($ip_data && $ip_data->geoplugin_countryName != null) {
    $geo_country = $ip_data->geoplugin_countryName;
    $geo_city = $ip_data->geoplugin_city;
}

//$date = date("Y-m-d  H:i:s", $_SERVER["REQUEST_TIME"]);
$date = $_SERVER["REQUEST_TIME"];