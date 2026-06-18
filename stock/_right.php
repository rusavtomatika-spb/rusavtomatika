<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/auth.php';

$current_admin = check_admin_auth();
$error = isset($GLOBALS['auth_error']) ? $GLOBALS['auth_error'] : null;

if (!$current_admin) {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Вход на склад</title>
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
            .login-form button:hover { background: #45a049; }
            .error { color: red; text-align: center; margin: 10px 0; }
        </style>
    </head>
    <body>
        <div class="login-form">
            <h2>Вход на склад</h2>
            <?php if ($error): ?>
                <div class="error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <form method="POST">
                <input type="text" name="login" placeholder="Логин" required autofocus>
                <input type="password" name="password" placeholder="Пароль" required>
                <button type="submit">Войти</button>
            </form>
        </div>
    </body>
    </html>
    <?php
    exit;
}