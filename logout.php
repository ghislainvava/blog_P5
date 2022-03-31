<?php
include "header.php";
require_once "MesExtensions.php";
require_once "Database.php";

$sessionId = $_COOKIE['session'] ?? '';
if ($sessionId) {
    $statement = $pdo->prepare('DELETE FROM session where id=?');
    $statement->execute([$sessionId]);
    setcookie('session','', time() -1);
}

header('Location: /login.php');