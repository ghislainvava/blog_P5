<?php
// $pdo = require_once '.././Database/Database.php';
// require_once '.././Database/security.php';
// $authDB = new AuthDB($pdo);
$sessionId = $_COOKIE['session'] ?? '';
if ($sessionId) {
    $userDB->logout($sessionId);
    session_destroy();
    header('Location: /index.php?page=login');
    exit;
}

