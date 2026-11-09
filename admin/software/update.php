<?php
define('admin', true);
define('PRODUCTS_ALL', true);

if (session_status() === PHP_SESSION_NONE) session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/admin_auth.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/classes/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/classes/databases.php';
require_once __DIR__ . '/auth.php';

$isAllowed = false;
$allowedDomains = array('www.rusavto.moisait.net', 'rusavtomatika.local');
if (in_array($_SERVER['SERVER_NAME'], $allowedDomains)) $isAllowed = true;
if (preg_match('/\.local$/i', $_SERVER['SERVER_NAME']))  $isAllowed = true;
if (!$isAllowed && !empty($_COOKIE['m']))                $isAllowed = true;
if (!$isAllowed) { header('HTTP/1.0 403 Forbidden'); exit('forbidden'); }

$current_admin = check_admin_auth();
if (!$current_admin) { header('Location: /admin/_right.php'); exit; }

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['run_sync'])) {
    header('Location: /admin'); exit;
}

define('TMP_DIR', __DIR__ . '/tmp');
define('FTP_URL_PUBLIC', 'https://www.rusavtomatika.com');

$type = isset($_POST['type']) ? $_POST['type'] : '';
if (!in_array($type, array('x', 'pro'), true)) {
    $_SESSION['sync_toast'] = array('type' => 'error', 'text' => 'Не указан тип (x/pro)');
    header('Location: /admin'); exit;
}

$jar = isset($_SESSION['weintek_cookies']) ? $_SESSION['weintek_cookies'] : array();

if (empty($jar)) {
    if (function_exists('w_login')) {
        $login_result = w_login();
        if (empty($login_result['success'])) {
            $_SESSION['sync_toast'] = array('type' => 'error', 'text' => 'Не удалось авторизоваться: ' . $login_result['message']);
            header('Location: /admin'); exit;
        }
        $jar = isset($login_result['jar']) ? $login_result['jar'] : $_SESSION['weintek_cookies'];
    } else {
        $_SESSION['sync_toast'] = array('type' => 'error', 'text' => 'Нет кук Weintek и нет w_login()');
        header('Location: /admin'); exit;
    }
}

$downloadPageUrl = W_BASE . '/Download/Software';
$r = w_request($downloadPageUrl, 'GET', null, $jar, true);
if (!$r['ok'] || $r['code'] !== 200) {
    $_SESSION['sync_toast'] = array('type' => 'error', 'text' => 'Ошибка загрузки /Download/Software (HTTP ' . $r['code'] . ')');
    header('Location: /admin'); exit;
}
w_parse_set_cookies($r['headers'], $jar);
$_SESSION['weintek_cookies'] = $jar;

$html = $r['body'];

if (stripos($html, 'You are not logged in') !== false || stripos($html, '/Account/Login') !== false) {
    if (function_exists('w_login')) {
        $login_result = w_login();
        if (!empty($login_result['success'])) {
            $jar = isset($login_result['jar']) ? $login_result['jar'] : $_SESSION['weintek_cookies'];
            $r = w_request($downloadPageUrl, 'GET', null, $jar, true);
            if ($r['ok'] && $r['code'] === 200) {
                $html = $r['body'];
                w_parse_set_cookies($r['headers'], $jar);
                $_SESSION['weintek_cookies'] = $jar;
            }
        }
    }
    if (stripos($html, 'You are not logged in') !== false || stripos($html, '/Account/Login') !== false) {
        $_SESSION['sync_toast'] = array('type' => 'error', 'text' => 'Не удалось получить доступ к /Download/Software (страница логина)');
        header('Location: /admin'); exit;
    }
}

$isX = ($type === 'x');

$zipUrl = null;
$pdfUrl = null;
$fileNameFromPage = null;
$pdfNameFromPage = null;

$needle = $isX ? 'EasyBuilder X' : 'EasyBuilder Pro';
$posH3 = stripos($html, 'text-dark-blue');

$pos = false;
if ($posH3 !== false) {
    $pos = stripos($html, $needle, $posH3);
}

if ($pos === false) {
    $pos = stripos($html, $needle);
}

if ($pos !== false) {
    $chunk = substr($html, $pos, 5000);

    if (preg_match('/>\s*([^<>\s]+\.zip)\s*</i', $chunk, $mFile)) {
        $fileNameFromPage = $mFile[1];
    }

    if (preg_match('/<a[^>]+href="(\/Download\/FileLink\?[^"]+)"[^>]*>/i', $chunk, $mLink)) {
        $zipUrl = html_entity_decode($mLink[1], ENT_QUOTES, 'UTF-8');
    }

    if (preg_match('/<a[^>]+href="(https:\/\/dl\.weintek\.com\/[^"]+\.pdf[^"]*)"[^>]*>/i', $chunk, $mPdf)) {
        $pdfUrl = html_entity_decode($mPdf[1], ENT_QUOTES, 'UTF-8');
        $qpos = strpos($pdfUrl, '?');
        if ($qpos !== false) {
            $pdfUrl = substr($pdfUrl, 0, $qpos);
        }
        $pdfPath = parse_url($pdfUrl, PHP_URL_PATH);
        if ($pdfPath) {
            $pdfNameFromPage = basename($pdfPath);
        }
    }
}

if ($zipUrl === null) {
    $_SESSION['sync_toast'] = array(
        'type' => 'error',
        'text' => 'Не найдена ссылка FileLink для ' . ($isX ? 'EasyBuilder X' : 'EasyBuilder Pro') . ' на /Download/Software'
    );
    header('Location: /admin'); exit;
}

if (strpos($zipUrl, 'http') !== 0) {
    $zipUrl = rtrim(W_BASE, '/') . '/' . ltrim($zipUrl, '/');
}

if (!is_dir(TMP_DIR)) @mkdir(TMP_DIR, 0775, true);

$fileName = $fileNameFromPage;
if ($fileName === null || $fileName === '') {
    $fileName = 'weintek_' . $type . '_' . date('Ymd_His') . '.zip';
}
$fileName = basename($fileName);

$filePath = TMP_DIR . '/' . $fileName;

$fp = fopen($filePath, 'wb');
if ($fp === false) {
    $_SESSION['sync_toast'] = array('type' => 'error', 'text' => 'Не удалось открыть файл для записи: ' . $filePath);
    header('Location: /admin'); exit;
}

$ch = curl_init($zipUrl);
curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
curl_setopt($ch, CURLOPT_TIMEOUT, 600);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_USERAGENT, W_UA);
curl_setopt($ch, CURLOPT_REFERER, $downloadPageUrl);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Accept: */*',
));
if (!empty($jar)) {
    curl_setopt($ch, CURLOPT_COOKIE, w_cookie_header($jar));
}

$ok = curl_exec($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
$finalUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
$err = curl_error($ch);
curl_close($ch);
fclose($fp);

if (!$ok || $code !== 200 || filesize($filePath) < 1024) {
    $size = @filesize($filePath);
    @unlink($filePath);
    $_SESSION['sync_toast'] = array(
        'type' => 'error',
        'text' => 'Ошибка скачивания ZIP (HTTP ' . $code . ', size=' . (int)$size . ', ' . $err . ')'
    );
    header('Location: /admin'); exit;
}

if (stripos((string)$contentType, 'html') !== false) {
    @unlink($filePath);
    $_SESSION['sync_toast'] = array(
        'type' => 'error',
        'text' => 'Вместо ZIP пришёл HTML (Content-Type: ' . $contentType . ')'
    );
    header('Location: /admin'); exit;
}

$size = filesize($filePath);

$pdfLocalPath = null;
$pdfFileName = null;
$pdfErr = '';

if ($pdfUrl !== null) {
    $pdfFileName = $pdfNameFromPage ? $pdfNameFromPage : basename(parse_url($pdfUrl, PHP_URL_PATH));
    $pdfLocalPath = TMP_DIR . '/' . $pdfFileName;

    $fpPdf = @fopen($pdfLocalPath, 'wb');
    if ($fpPdf !== false) {
        $chPdf = curl_init($pdfUrl);
        curl_setopt($chPdf, CURLOPT_FILE, $fpPdf);
        curl_setopt($chPdf, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($chPdf, CURLOPT_MAXREDIRS, 5);
        curl_setopt($chPdf, CURLOPT_TIMEOUT, 120);
        curl_setopt($chPdf, CURLOPT_CONNECTTIMEOUT, 15);
        curl_setopt($chPdf, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($chPdf, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($chPdf, CURLOPT_USERAGENT, W_UA);
        curl_setopt($chPdf, CURLOPT_REFERER, $downloadPageUrl);

        $okPdf = curl_exec($chPdf);
        $codePdf = curl_getinfo($chPdf, CURLINFO_HTTP_CODE);
        $errPdf = curl_error($chPdf);
        curl_close($chPdf);
        fclose($fpPdf);

        if (!$okPdf || $codePdf !== 200 || filesize($pdfLocalPath) < 1024) {
            $pdfErr = 'HTTP ' . $codePdf . ' ' . $errPdf;
            @unlink($pdfLocalPath);
            $pdfLocalPath = null;
        }
    } else {
        $pdfErr = 'не удалось открыть ' . $pdfLocalPath;
        $pdfLocalPath = null;
    }
}

define('FTP_HOST', '82.202.162.16');
define('FTP_PORT', 21);
define('FTP_USER', 'upload_olga@weblector.ru');
define('FTP_PASS', 'olgaglr');
define('FTP_DIR_X',   '/soft/EBProX');
define('FTP_DIR_PRO', '/soft/EBPro');

$ftpDir = $isX ? FTP_DIR_X : FTP_DIR_PRO;

$ftp = @ftp_connect(FTP_HOST, FTP_PORT, 15);
if (!$ftp) {
    @unlink($filePath);
    if ($pdfLocalPath) @unlink($pdfLocalPath);
    $_SESSION['sync_toast'] = array(
        'type' => 'error',
        'text' => 'FTP: не удалось подключиться к ' . FTP_HOST . ':' . FTP_PORT
    );
    header('Location: /admin'); exit;
}

if (!@ftp_login($ftp, FTP_USER, FTP_PASS)) {
    ftp_close($ftp);
    @unlink($filePath);
    if ($pdfLocalPath) @unlink($pdfLocalPath);
    $_SESSION['sync_toast'] = array(
        'type' => 'error',
        'text' => 'FTP: не удалось авторизоваться (' . FTP_USER . ')'
    );
    header('Location: /admin'); exit;
}

ftp_pasv($ftp, true);

if (!@ftp_chdir($ftp, $ftpDir)) {
    $parts = explode('/', trim($ftpDir, '/'));
    $cur = '';
    $okDir = true;
    foreach ($parts as $part) {
        $cur .= '/' . $part;
        if (!@ftp_chdir($ftp, $cur)) {
            if (!@ftp_mkdir($ftp, $cur)) {
                $okDir = false;
                break;
            }
        }
    }
    if (!$okDir) {
        ftp_close($ftp);
        @unlink($filePath);
        if ($pdfLocalPath) @unlink($pdfLocalPath);
        $_SESSION['sync_toast'] = array(
            'type' => 'error',
            'text' => 'FTP: не удалось перейти/создать ' . $ftpDir
        );
        header('Location: /admin'); exit;
    }
}

$remoteName = $fileName;
$uploaded = @ftp_put($ftp, $remoteName, $filePath, FTP_BINARY);
$ftpErr = '';
if (!$uploaded) {
    $ftpErr = 'ftp_put failed';
}

$setupName = $isX ? 'EBProX_setup.zip' : 'EBpro_setup.zip';
$uploadedSetup = false;
$setupErr = '';
if ($uploaded) {
    $uploadedSetup = @ftp_put($ftp, $setupName, $filePath, FTP_BINARY);
    if (!$uploadedSetup) {
        $setupErr = 'ftp_put setup failed';
    }
}

$pdfRemoteDir = $ftpDir . '/ReleaseNotes';
$pdfUploaded = false;
$pdfUploadErr = '';

if ($pdfLocalPath !== null && $uploaded) {
    if (!@ftp_chdir($ftp, $pdfRemoteDir)) {
        $parts = explode('/', trim($pdfRemoteDir, '/'));
        $cur = '';
        $okPdfDir = true;
        foreach ($parts as $part) {
            $cur .= '/' . $part;
            if (!@ftp_chdir($ftp, $cur)) {
                if (!@ftp_mkdir($ftp, $cur)) {
                    $okPdfDir = false;
                    break;
                }
            }
        }
        if (!$okPdfDir) {
            $pdfUploadErr = 'не удалось перейти/создать ' . $pdfRemoteDir;
        }
    }
    if (empty($pdfUploadErr)) {
        $pdfUploaded = @ftp_put($ftp, $pdfFileName, $pdfLocalPath, FTP_BINARY);
        if (!$pdfUploaded) {
            $pdfUploadErr = 'ftp_put pdf failed';
        }
    }
}

ftp_close($ftp);

if (!$uploaded) {
    @unlink($filePath);
    if ($pdfLocalPath) @unlink($pdfLocalPath);
    $_SESSION['sync_toast'] = array(
        'type' => 'error',
        'text' => 'FTP: ошибка загрузки ' . $fileName . ' в ' . $ftpDir . ' (' . $ftpErr . ')'
    );
    header('Location: /admin'); exit;
}

if (!$uploadedSetup) {
    if ($pdfLocalPath) @unlink($pdfLocalPath);
    $_SESSION['sync_toast'] = array(
        'type' => 'error',
        'text' => 'FTP: основной файл загружен, но копия ' . $setupName . ' не создана (' . $setupErr . '). Локально сохранён: ' . $fileName
    );
    header('Location: /admin'); exit;
}

$softResultPath = $_SERVER['DOCUMENT_ROOT'] . '/download/soft_result.json';
if (!is_file($softResultPath)) {
    $softResultPath = $_SERVER['DOCUMENT_ROOT'] . '/download/soft_result.txt';
}

if (is_file($softResultPath)) {
    $softData = json_decode( file_get_contents( $softResultPath ), true );
    if (!is_array($softData)) $softData = array();

    $sectionKey = $isX ? 'ebx' : 'ebpro';
    $putFolder  = $isX ? 'EBProX' : 'EBPro';

    $title = $isX
        ? 'EasyBuilder X V' . preg_replace('/^EBX-|\.zip$/i', '', $fileName)
        : 'EasyBuilder Pro V' . preg_replace('/^EBPro-|\.zip$/i', '', $fileName);

    $description = $isX
        ? 'EasyBuilder X — ПО нового поколения с объектно-ориентированным дизайном, переменными вместо прямых адресов ПЛК и обновлённым рабочим пространством.'
        : 'Программное обеспечение EasyBuilderPro применяется для создания пользовательских проектов для операторских панелей Weintek всех серий.<br>\nИспользование ПО EasyBuilderPro полностью бесплатно, вы можете скачивать ПО и пользоваться им без каких-либо ограничений.<br>\nUSB драйвера для подключения панели к ПК устанавливаются автоматически при установке EasyBuilderPro';

    $newEntry = array(
        'title'       => $title,
        'mod_data'    => time(),
        'url'         => rtrim(FTP_URL_PUBLIC, '/') . '/soft/' . $putFolder . '/' . $remoteName,
        'put'         => $putFolder,
        'fname'       => $remoteName,
        'fsize'       => $size,
        'category'    => 'Software',
        'ftype'       => 'zip',
        'section'     => $sectionKey,
        'label'       => '',
        'sort'        => '1450',
        'description' => $description,
    );

    $found = false;
    foreach ($softData as $i => $row) {
        if (isset($row['section']) && $row['section'] === $sectionKey) {
            $softData[$i] = $newEntry;
            $found = true;
            break;
        }
    }
    if (!$found) $softData[] = $newEntry;

    file_put_contents(
        $softResultPath,
        json_encode($softData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
    );
}

if ($pdfLocalPath !== null) {
    $softUpdatesPath = $_SERVER['DOCUMENT_ROOT'] . '/download/soft_updates.json';
    if (!is_file($softUpdatesPath)) {
        $softUpdatesPath = $_SERVER['DOCUMENT_ROOT'] . '/download/soft_updates.txt';
    }

    $updData = array();
    if (is_file($softUpdatesPath)) {
        $tmp = json_decode(file_get_contents($softUpdatesPath), true);
        if (is_array($tmp)) $updData = $tmp;
    }

    $sectionKey = $isX ? 'ebx' : 'ebpro';
    $putFolder  = $isX ? 'EBProX/ReleaseNotes' : 'EBPro/ReleaseNotes';

    $newUpdEntry = array(
        'title'       => $isX
                            ? 'Примечания к выпуску EasyBuilder X (Eng)'
                            : 'Примечания к выпуску EasyBuilder Pro (Eng)',
        'mod_data'    => time(),
        'url'         => rtrim(FTP_URL_PUBLIC, '/') . '/soft/' . $putFolder . '/' . $pdfFileName,
        'put'         => $putFolder,
        'fname'       => $pdfFileName,
        'fsize'       => filesize($pdfLocalPath),
        'category'    => 'Software',
        'ftype'       => 'pdf',
        'section'     => $sectionKey,
        'label'       => '',
        'sort'        => '1450',
        'description' => '',
    );

    $found = false;
    foreach ($updData as $i => $row) {
        if (isset($row['section']) && $row['section'] === $sectionKey) {
            $updData[$i] = $newUpdEntry;
            $found = true;
            break;
        }
    }
    if (!$found) $updData[] = $newUpdEntry;

    file_put_contents(
        $softUpdatesPath,
        json_encode($updData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
    );
}

@unlink($filePath);
if ($pdfLocalPath) @unlink($pdfLocalPath);

$pdfInfo = '';
if ($pdfUrl === null) {
    $pdfInfo = ' [release notes не найдены на странице]';
} elseif (!$pdfUploaded) {
    $pdfInfo = ' [PDF не загружен: ' . $pdfUploadErr . ']';
} else {
    $pdfInfo = ' + ' . $pdfFileName . ' (ReleaseNotes)';
}

$_SESSION['sync_toast'] = array(
    'type' => 'success',
    'text' => 'Загружено на FTP: ' . $remoteName . ' + ' . $setupName . $pdfInfo . ' → ' . $ftpDir . ' (' . formatSizeUnits($size) . ')'
);
header('Location: /admin'); exit;

function formatSizeUnits($bytes) {
    if ($bytes >= 1073741824) return number_format($bytes / 1073741824, 2) . ' GB';
    if ($bytes >= 1048576)    return number_format($bytes / 1048576, 2) . ' MB';
    if ($bytes >= 1024)       return number_format($bytes / 1024, 2) . ' KB';
    return $bytes . ' B';
}