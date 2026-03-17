<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'admin_auth.php';

$current_admin = check_admin_auth();

if (!$current_admin) {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Вход в админ-панель</title>
        <meta charset="utf-8">
        <style>
            body {
                font-family: Arial, sans-serif;
                background: #f0f0f0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }
            .login-form {
                background: white;
                padding: 30px;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                width: 300px;
            }
            .login-form h2 {
                margin: 0 0 20px 0;
                color: #333;
                text-align: center;
            }
            .login-form input {
                width: 100%;
                padding: 10px;
                margin: 10px 0;
                border: 1px solid #ddd;
                border-radius: 4px;
                box-sizing: border-box;
            }
            .login-form button {
                width: 100%;
                padding: 10px;
                background: #4CAF50;
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-size: 16px;
            }
            .login-form button:hover {
                background: #45a049;
            }
            .error {
                color: red;
                text-align: center;
                margin: 10px 0;
            }
        </style>
    </head>
    <body>
        <div class="login-form">
            <h2>Вход в админ-панель</h2>
            <?php if (isset($error)): ?>
                <div class="error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <form method="POST">
                <input type="text" name="login" placeholder="Логин" required>
                <input type="password" name="password" placeholder="Пароль" required>
                <button type="submit">Войти</button>
            </form>
        </div>
    </body>
    </html>
    <?php
    exit;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Админ-панель</title>
    <meta charset="utf-8">
</head>
<body>
    <div style="padding: 20px;">
        <div style="background: #f5f5f5; padding: 10px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
            <div>
                ✅ Вы авторизованы как: <strong><?= htmlspecialchars($current_admin['username']) ?></strong>
                <br>
                <small>ID: <?= $current_admin['id'] ?> | Последний вход: <?= $current_admin['last_login'] ?: 'никогда' ?></small>
            </div>
        </div>
        <a href="/admin">Перейти к редактированию</a>
    </div>
</body>
</html>