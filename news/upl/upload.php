<?php
// Параметры FTP
$ftp_server = '82.202.162.16';
$ftp_user_name = 'ilval@weblector.ru';
$ftp_user_pass = 'ilval2398';
$ftp_folder = '/images';

$subdir = trim($_POST['subdir']);
$subdir = preg_replace('#[^a-zA-Z0-9/_-]#', '', $subdir);

$ftp_path = $ftp_folder . '/' . $subdir;

$conn_id = ftp_connect($ftp_server);
if (!$conn_id) die(json_encode(['success' => false, 'error' => 'Ошибка подключения к FTP']));

$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
if (!$login_result) die(json_encode(['success' => false, 'error' => 'Ошибка авторизации']));

// Создаем подкаталог, если его нет
if (!@ftp_chdir($conn_id, $ftp_path)) {
    $dirs = explode('/', $ftp_path);
    $current = '';
    foreach ($dirs as $dir) {
        if ($dir === '') continue;
        $current .= '/' . $dir;
        if (!@ftp_chdir($conn_id, $current)) {
            ftp_mkdir($conn_id, $dir);
            ftp_chdir($conn_id, $dir);
        }
    }
}

$results = [];
foreach ($_FILES['files']['tmp_name'] as $key => $tmp_name) {
    $name = basename($_FILES['files']['name'][$key]);
    if (move_uploaded_file($tmp_name, $name)) {
        if (ftp_put($conn_id, $name, $name, FTP_BINARY)) {
            unlink($name);
            $results[] = [
                'name' => $name,
                'path' => 'https://www.rusavtomatika.com/upload_files/images/' . $subdir . '/' . $name
            ];
        }
    }
}

ftp_close($conn_id);
echo json_encode(['success' => true, 'files' => $results]);
?>