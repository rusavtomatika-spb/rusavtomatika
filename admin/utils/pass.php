<?php
$admin_password = 'z2qyXQCrzk';

if (!CRYPT_SHA512) {
    die("SHA512 не доступен! Используйте другой алгоритм.\n");
}

$salt = rand(100000, 999999) . rand(100000, 999999);

$hash = crypt($admin_password, '$6$' . $salt . '$');

echo "INSERT INTO admins (username, password_hash) VALUES ('Denis', '$hash');\n";
?>