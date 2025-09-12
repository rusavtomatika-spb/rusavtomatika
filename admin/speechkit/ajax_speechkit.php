<?
@header("Content-Type: text/html; charset=utf-8");
const FORMAT_PCM = "lpcm";
const FORMAT_OPUS = "oggopus";

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

    global $path;
    $path = $_SERVER["DOCUMENT_ROOT"] . "/admin/speechkit/audio/";


    global $microtime1;
    global $microtime2;
    $microtime1 = microtime(true);
    $out = array();
    ob_start();

    if (isset($_POST["text"]) and $_POST["text"] != '') {

        do_speech($_POST["text"], trim($_POST["token"]));
        $out["status"] = 1;
    } else {
        $out = array("status" => 0);
    }

    $out["buffer"] = iconv("windows-1251", "utf-8", ob_get_clean());

    echo json_encode($out);

};


function do_speech($text, $token)
{
    global $microtime1;
    global $microtime2;
    global $path;


// в cmd набрать это
//yc iam create-token

//    $token = 'CggVAgAAABoBMxKABLRePVmN5wZvZZeeSFA_X3NLI9DyQPcpqEatk1DTF212m3GSyuSxfD5cZg0hN4UffmeB3FgqZdhthJuUl3_-P5rZv9csxjwr7GgXlzON8VkDoFpEz3an5HpYq37So-zprH78az5WL93Rrf1PsacHlXS2qSDii-Q86F-21SItlc_4fs5rVd5b-5UvJ0TOpgBJhwA-hTWpHIjR89M5VYm6KOewnWTl17PKbgJuel-fAKeIDKnQg-FrRylZRlyLLicQft96gy4QP2oei6ZG-Xr9xCmEdC7-6k6rWAq0tpC9xXqVjlh0-KqfNr-sQPW74mTXAaYDrJPPIaJyFXBpt9nmcEwfMFMnYO9_9jDlxHLG4HFMM6uO57D8ImqaYRBJGXFKjA_-DFNE1mqOyw3XJGfHRSKYQongUVx8EYwKY5ebsDtkezgO24ZgwZ4wXH6rH_N86gHcNoY5PHEs7WOhCD7etat_pAMB4oVwAosDQxIUCJ7XpSi-RD-jf1IPamNbdcH0h_I0bEJDMhQYNJmniYWG33CJmUIoYrYHoIXed1M2w8WmeQQGF2nSqhaj8GAmWV7DK1YCstzCvKUEGrDZ_O4bfIQy36659LwHLP1go_BcaPQbCSFjtlciv3Y6ANzdhNAeMacucTN3F-jTwEFlydBOEefzglm9LV5NN2AvOYjhdpCzGiQQwt3h9AUYgq_k9AUiFgoUYWplNjhkOWY0bXI2Z2sxMWptZmQ='; # IAM-токен
//    $token = 'CggVAgAAABoBMxKABEk5a4akhDypRf6VEz-0al8KSANwGtujjDLvyWr1VsJXNoECq9h7d225lAUmyb5SrmmFpM6e44qNU9x2-hbLbiVXyzCksozfw0Ba7kSXYclpEfCx9wzBz-4Z5ER_B5L9xw_1SQIjdUNKk5J5KuioAVT2DSvSdAYjYsnHugu6nhyqyqDpej-GNalrIF8yA-mKp9MSveNqQClFcDtuIaP9F2HqqMKeP2GQDajiFUsADcbvlGWeERnHudTIcKdkY8ISM7ym2spmw4CbP5fzm2RN2xcefPqp0E9ikm0Sw20bicAp54wg1Nh3rzjDTV87_Vxk3AaLlqtmCSzrRFrmsUC1B7Kz_NONIPlRCUWhUVXlv94NzivoVGUTpAsBoSpyUacoK3ycg4tGjuFRYR30r3WFepEp3E5LVokht0CXldmf1Eo91cFOnSTDcy9BjHw-AyXqqKm2HDWzx_pe-XT86VWCSSjCeg_nAJqsSw0qdV8sqBqmbccZfo4vqhmm5Ym3gboYXzkznsqS6aQorsg4RAb5K_RJvaQNYhPhiEZKFeBnFUxMfud_i9yQdv545uD2M8LaYjd8HGorwvTaaY8AsASybg9hBu1Kk7cQ3OJ28XgM-t-0nXn29CfHEqshc_puYIg8_4H6Zo9tx1rxbrxV5YQQzOjKDLKFz2WLKL4by2CahFYFGiQQ0-3r9AUYk7_u9AUiFgoUYWplNjhkOWY0bXI2Z2sxMWptZmQ='; # IAM-токен

    if (!isset($token) or $token == "") {


        $token = file_get_contents($path . "/token.txt");

        //$token = 'CggVAgAAABoBMxKABEJFDuT_5-BqJ9ekw-v21dsbxmz-pvKAkjQaBQFde1hOG64WW18i4yzKwSqOBhzqd7VN8mbJsFgjMlvuNeR3jf7h6xWoYbZhrQ0qbqFlx_5DmSQAAGgDBa9ZhjAKbjj-msLtVrLsnBl9oVEExOZxYmUsEDFHaMZuT4Uf78_eThm7kCPUfDYkQrvlcs-b9wLJY6dmYx7eFu0ICrUK6k_fcRNO99nb2EI_ZO0wsNvAiMHufh3l03XtAuO9k-I2bdQfxO-mZNOplJKLkPZu8XSyXyGdgYMyShEaxafMPtqsHovtYYDz6fALTzHIo9MfMvsgr-iNNUGgq7gGPTo4z81eJAGKST1thik7PBY7iJHKgCpQ44JfFq0PMFgsquamuZKMtd4ygxRwsMPrRfQiLMvpyib5d_gODjQq4E6AqZ0dgmvMGx_mVSlOwdIbxzNRlLaCykhVZmTRsT_xi2FUrWgkOAbmYWO2Rrkd-QPCynsfi2ckGMP6FcqL2YDtfg2L18f6wsg1Wwr4QT_lgw8jB-Hrkd_Z4VBQRBqh1Cs_6ZpQRnXhnH_us3eCrhr2jEHfvySJradMj0S_fQn4D58d2K8JpoaAzGo80kfO1EszmmjJ-64YIpbY5TMIlf4IAM4TOqMb-HBMxji3wOu60lMW3LFrwS6tIO5s7yTzAfPsabdTgfQbGiQQwOnL9QUYgLvO9QUiFgoUYWplNjhkOWY0bXI2Z2sxMWptZmQ='; # IAM-токен
    }

    $folderId = "b1grnmpiro56f675b2iq"; # Идентификатор каталога b1ghr3p72hfk5irig24f  b1grnmpiro56f675b2iq
    $url = "https://tts.api.cloud.yandex.net/speech/v1/tts:synthesize";

    $api_key = "AQVNzMdU8k04pdkykYGEH5QR0uMUCsBF6VzNu7ZH";

    $text = trim($text);
    $text2 = $text;
    $text = urlencode($text);


    $post = "text={$text}&lang=ru-RU&voice=filipp&speed=1.3&folderId=${folderId}";
//    $headers = ['Authorization: Bearer ' . $token];
    $headers = ['Authorization: Api-Key ' . $api_key];
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    if ($post !== false) {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    }
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);


    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        print "Error: " . curl_error($ch);
    }
    if (curl_getinfo($ch, CURLINFO_HTTP_CODE) != 200) {
        $decodedResponse = json_decode($response, true);
        echo "Error code: " . $decodedResponse["error_code"] . "\r\n";
        echo "Error message: " . $decodedResponse["error_message"] . "\r\n";
    } else {
        $path = $_SERVER["DOCUMENT_ROOT"] . "/admin/speechkit/audio/";
        $filename = "speech-" . date('d-m-Y-H-i-s') . ".ogg";
        $filename_text = "text-" . date('d-m-Y-H-i-s') . ".txt";
        $responce = file_put_contents($path . $filename, $response);
        $responce2 = file_put_contents($path . $filename_text, $text2);
        $responce3 = file_put_contents($path . "/token.txt", $token);

        ?>

        <table>
            <tr>
                <td>File: <?= $filename ?></td>
                <td><a target="_blank" href="//www.rusavto.moisait.net/admin/speechkit/audio/<?= $filename ?>">Open
                        in new page: <?= $filename ?></a></td>
            </tr>
            <tr>
                <td>Size: <?= ($responce) ?></td>
                <td><a style="font-size: 30px;" download target="_blank"
                       href="//www.rusavto.moisait.net/admin/speechkit/audio/<?= $filename ?>">Download <?= $filename ?></a>
                </td>
            </tr>

            <tr>
                <td>File text: <?= $filename_text ?> - Size: <?= ($responce2) ?></td>
                <td><a download target="_blank"
                       href="//www.rusavto.moisait.net/admin/speechkit/audio/<?= $filename_text ?>">Download <?= $filename_text ?></a>
                </td>
            </tr>


        </table>
        <br>
        <br>
        <audio class="player_audio" controls style="width: 100%">
            <source src="//www.rusavto.moisait.net/admin/speechkit/audio/<?= $filename ?>"
                    type="audio/ogg; codecs=vorbis" controls="controls">
        </audio>
        <br>
        <br>

        <?


    }
    curl_close($ch);
    ?>


    <?php
    $microtime2 = microtime(true);
    echo "<div class='microtime' style='font-size: 16px;color: #333;'>Generation time:  " . ($microtime2 - $microtime1) . "</div>";


}