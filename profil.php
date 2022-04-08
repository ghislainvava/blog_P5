<?php

$pdo = require './Database/Database.php';
require './Database/security.php';
include './Database/models/ArticleDB.php';
$articleDB = new ArticleDB($pdo);

$currentUser = isLoggedIn();
if (!$currentUser) {
  header('Location: /');
  exit;
}
$articles = $articlesDB->fetchUserArticle($currentUser['id']);

$sessionId = $_COOKIE['session'] ?? '';
if ($sessionId) {
  $sessionUserStatement = $pdo->prepare('SELECT * FROM session JOIN user on user.id=session.userid WHERE session.id=?');
  $sessionUserStatement->execute([$sessionId]);
  $user = $sessionUserStatement->fetch();
}

if (!$currentUser) {
  header('Location: /login.php');
  exit;
}
?>


<head>
      <title>Mon profil</title>
</head>

<body>
 <?= include 'includes/header.php';?>
  <div class="container">
   
      <div class="d-flex row justify-content-start">
        <h1>mon espace</h1>
        <h2>Mes iformations</h2>
        <div>
          <ul>
            <li class="d-flex">
              <strong>Prénom :</strong>
              <p><?= $currentUser['firstname']?></p>
            </li>
            <li class="d-flex">
              <strong>Nom :</strong>
              <p><?= $currentUser['lastname']?></p>
            </li>
            <li class="d-flex">
              <strong>Email :</strong>
              <p><?= $currentUser['email']?></p>
            </li>
          </ul>
          
        </div>
        <h2>Mes arcticles</h2>
        <div>
          <ul>
            <?php foreach ($articles as $article) : ?>
            <li>
                <span><?= $article['title']?></span>
                <div>
                  <button class="btn btn-primary">Modifier</button>
                  <button class="btn btn-secondary">Supprimer</button>
                </div>

            </li>
            <?php endforeach; ?>
          </ul>
        </div>


      </div>
    <?php require_once 'includes/footer.php' ?>
  </div>
</body>


