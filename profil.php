<?php
session_start();
$pdo = require_once './Database/Database.php';
require_once './Database/security.php';
require_once './Database/models/ArticleDB.php';
$userDB = new AuthDB($pdo);
$currentUser = $userDB->isLoggedIn();
if (!$currentUser) {
    header('Location: /');
    exit();
}
$articleDB = new ArticleDB($pdo);
$articles = $articleDB->fetchUserArticle($currentUser['id']);
?>

<head>
      <title>Mon profil</title>
</head>
<body>
 <?= include 'includes/header.php';?>
  <div class="container">
    <div class="d-flex row justify-content-start">
      <h1>mon espace</h1>
      <h2>Mes informations</h2>
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
                <a href="/form-article.php?id=<?= $article['id'] ?>" class="btn btn-primary">Modifier</a>
                <a class="btn btn-secondary" href="/delete-article.php?id=<?= $article['id'] ?>">Supprimer</a>
              </div>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
  <?php require_once 'includes/footer.php' ?>
</body>


