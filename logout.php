<?php


$sessionId = $_COOKIE['session'] ?? '';
if ($sessionId) {
    $statement = $pdo->prepare('DELETE FROM session where id=?');
    $statement->bindValue(':id', $sessionId);
    $statement->execute([$sessionId]);
    setcookie('session','', time() -1);

    header('Location: /login.php');
}

