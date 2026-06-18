<?php

function check_admin_auth() {
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
  
  if (isset($_SESSION['admin_user'])) {
    return $_SESSION['admin_user'];
  }
  
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login']) && isset($_POST['password'])) {
    $mysqli = new mysqli('localhost', 'moisait_olga', 'olgaglr', 'moisait_weintek');
    if ($mysqli->connect_error) {
      return null;
    }
    $mysqli->set_charset('utf8');
    
    $login = $_POST['login'];
    $password = $_POST['password'];
    
    $stmt = $mysqli->prepare("SELECT id, username, password_hash, last_login FROM admins WHERE username = ? LIMIT 1");
    $stmt->bind_param('s', $login);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
      if (password_verify($password, $row['password_hash'])) {
        $update = $mysqli->prepare("UPDATE admins SET last_login = NOW() WHERE id = ?");
        $update->bind_param('i', $row['id']);
        $update->execute();
        $update->close();
        
        $admin = array(
            'id' => $row['id'],
            'username' => $row['username'],
            'last_login' => $row['last_login']
        );
        
        $_SESSION['admin_user'] = $admin;
        $_SESSION['login_time'] = time();
        
        $stmt->close();
        $mysqli->close();
        
        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit;
      }
    }
    
    $stmt->close();
    $mysqli->close();
    
    $GLOBALS['auth_error'] = 'Неверный логин или пароль';
    return null;
  }
  
  return null;
}