<?php
session_start();
$pdo = require_once './Database/Database.php';
require_once './Database/security.php';
$authDB = new AuthDB($pdo);
$sessionId = $_COOKIE['session'] ?? '';
if ($sessionId) {
    $authDB->logout($sessionId);
    header('Location: /login.php');
    exit;
}

