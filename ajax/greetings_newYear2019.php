<?
$qr_code = $_POST['qr'];
if (isset($qr_code)) {

    $gifts = ['1' => 'Тубус', '2' => 'Календарь'];
    $gift = $gifts[$qr_code];

    if (array_key_exists($qr_code, $gifts)) {

        include $_SERVER['DOCUMENT_ROOT'] . '/sc/QRCode/lib_browser.php';
        include $_SERVER['DOCUMENT_ROOT'] . '/sc/slack/send_slack_message.php';
        include $_SERVER['DOCUMENT_ROOT'] . '/sc/QRCode/lib_detectLocation.php';

        $httpUserAgent = $_SERVER['HTTP_USER_AGENT'];
        $browser = new Browser();

        $attach = '[{"color": "#36a64f", "title": "Был просканирован QR код","fields": [
            {
          "title": "Источник",
          "value": "' . $gift . '",
          "short": false
          },
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
          },') . '{
          "title": "Время отправки",
          "value": "' . $date . '",
          "short": true
          },
          {
          "title": "HTTP_USER_AGENT",
          "value": "' . $httpUserAgent . '",
          "short": false
          }],
         


}]';

        slack($text, '#qr_codes_scan', $attach);
        //echo slack("hello", '#qr_codes_scan', "");
        ?>


<div class="popGreetings_wrapper-close"></div>
<div class="qr_innter">
    <?/*?>
    <div style="background-image: url(/sc/QRCode/head.png);
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    height: 118px;
    width: 100%;
    position: absolute;
    top: 0px;  "></div>
     <div style="    background-image: url(/sc/QRCode/left.png);
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    height: 100%;
    width: 106px;
    position: absolute;
    left: 0px;"></div>
    <div style="    background-image: url(/sc/QRCode/right.png);
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    height: 100%;
    width: 106px;
    position: absolute;
    right: 0px;"></div>
    <div style="    background-image: url(/sc/QRCode/bottom.png);
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    height: 81px;
    width: 100%;
    position: absolute;
    bottom: 0px;"></div>
    
    <?*/?>
    <div class="qr_cancel"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 475.2 475.2" style="enable-background:new 0 0 475.2 475.2;" xml:space="preserve">
<g>
	<g>
		<path d="M405.6,69.6C360.7,24.7,301.1,0,237.6,0s-123.1,24.7-168,69.6S0,174.1,0,237.6s24.7,123.1,69.6,168s104.5,69.6,168,69.6
			s123.1-24.7,168-69.6s69.6-104.5,69.6-168S450.5,114.5,405.6,69.6z M386.5,386.5c-39.8,39.8-92.7,61.7-148.9,61.7
			s-109.1-21.9-148.9-61.7c-82.1-82.1-82.1-215.7,0-297.8C128.5,48.9,181.4,27,237.6,27s109.1,21.9,148.9,61.7
			C468.6,170.8,468.6,304.4,386.5,386.5z"/>
		<path d="M342.3,132.9c-5.3-5.3-13.8-5.3-19.1,0l-85.6,85.6L152,132.9c-5.3-5.3-13.8-5.3-19.1,0c-5.3,5.3-5.3,13.8,0,19.1
			l85.6,85.6l-85.6,85.6c-5.3,5.3-5.3,13.8,0,19.1c2.6,2.6,6.1,4,9.5,4s6.9-1.3,9.5-4l85.6-85.6l85.6,85.6c2.6,2.6,6.1,4,9.5,4
			c3.5,0,6.9-1.3,9.5-4c5.3-5.3,5.3-13.8,0-19.1l-85.4-85.6l85.6-85.6C347.6,146.7,347.6,138.2,342.3,132.9z"/>
	</g>
</g>
</svg></div>
   
    <div class="" style="  background-image: url(/sc/QRCode/new2.jpg);width: 100%;
             background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
    font-size: 20px;
    padding: 60px;
    box-sizing: border-box;
    height: 100%;border-radius: 20px;">
<?/*?>
    <div style="background-image: url(/sc/QRCode/title.png);background-repeat: no-repeat;
    background-position: center;
    background-size: contain;
    height: 200px;
    width: 100%;  margin-top: 32px;"></div>
    <div style="    background-image: url(/sc/QRCode/text.png);
    background-repeat: no-repeat;
    background-position: center;
    background-size: contain;
    height: 229px;
    width: 100%;
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    max-width: 325px;"></div>
        <?*/?>
    </div>
    
    
    
</div>
            
            
            
            
            <?
    }
}
?>
