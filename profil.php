<?php
include "header.php";
require_once 'MesExtensions.php';

require_once './database.php';
$currentUser = isLoggedIn();

$sessionId = $_COOKIE['session'] ?? '';
if ($sessionId) {
  $sessionUserStatement = $pdo->prepare('SELECT * FROM session JOIN user on user.id=session.userid WHERE session.id=?');
  $sessionUserStatement->execute([$sessionId]);
  $user = $sessionUserStatement->fetch();
}

if (!$currentUser) {
  header('Location: /login.php');
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <nav>
    <a href="/">Accueil</a>
    <a href="/login.php">Connexion</a>
    <a href="/logout.php">Déconnexion</a>
    <a href="/profile.php">Profil</a>
    <a href="/register.php">Inscription</a>
  </nav>

  <h1>Profil</h1>
  <h2>Hello <?= $currentUser['username'] ?></h2>
</body>


