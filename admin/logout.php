<?php
require_once 'admin_auth.php';
logout_admin();
header('Location: /admin/_right.php');
exit;