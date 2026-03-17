<?php
ob_start();

function get_admin_db() {
    $db_host = 'localhost';
    $db_user = 'moisait_ilval';
    $db_pass = 'ilval2398';
    $db_name = 'moisait_weintek';
    
    $connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    
    if (!$connection) {
        error_log("Admin DB connection failed: " . mysqli_connect_error());
        return false;
    }
    
    mysqli_set_charset($connection, "utf8");
    return $connection;
}

function generate_token() {
    return bin2hex(openssl_random_pseudo_bytes(32));
}

function check_admin_auth() {
    if (!isset($_COOKIE['admin_token'])) {
        return false;
    }
    
    $mysqli_db = get_admin_db();
    if (!$mysqli_db) {
        return false;
    }
    
    $token = mysqli_real_escape_string($mysqli_db, $_COOKIE['admin_token']);
    
    $query = "SELECT * FROM admins WHERE auth_token = '$token' LIMIT 1";
    $result = mysqli_query($mysqli_db, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $admin = mysqli_fetch_assoc($result);
        mysqli_close($mysqli_db);
        return $admin;
    }
    
    mysqli_close($mysqli_db);
    return false;
}

function login_admin($username, $password) {
    $mysqli_db = get_admin_db();
    if (!$mysqli_db) {
        return false;
    }
    
    $username = mysqli_real_escape_string($mysqli_db, $username);
    
    $query = "SELECT * FROM admins WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($mysqli_db, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $admin = mysqli_fetch_assoc($result);
        
        if (crypt($password, $admin['password_hash']) === $admin['password_hash']) {
            $token = generate_token();
            $token_escaped = mysqli_real_escape_string($mysqli_db, $token);
            
            $update = "UPDATE admins SET auth_token = '$token_escaped', last_login = NOW() WHERE id = " . $admin['id'];
            mysqli_query($mysqli_db, $update);
            
            setcookie("admin_token", $token, time() + 60 * 60 * 24 * 365, "/", $_SERVER['SERVER_NAME'], 0);
            error_log("ADMIN AUTH: Кука установлена. Token: $token, Path: /, Domain: " . $_SERVER['SERVER_NAME']);
            
            mysqli_close($mysqli_db);
            return $admin;
        }
    }
    
    mysqli_close($mysqli_db);
    return false;
}

function logout_admin() {
    $mysqli_db = get_admin_db();
    if ($mysqli_db && isset($_COOKIE['admin_token'])) {
        $token = mysqli_real_escape_string($mysqli_db, $_COOKIE['admin_token']);
        mysqli_query($mysqli_db, "UPDATE admins SET auth_token = NULL WHERE auth_token = '$token'");
        mysqli_close($mysqli_db);
    }
    
    setcookie("admin_token", "", time() - 3600, "/", $_SERVER['SERVER_NAME'], 0);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login']) && isset($_POST['password'])) {
    $admin = login_admin($_POST['login'], $_POST['password']);
    if ($admin) {
        header('Location: /admin/');
        exit;
    } else {
        $error = "Неверный логин или пароль";
    }
}
?>