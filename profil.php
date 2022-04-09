<?php

$pdo = require_once './Database/Database.php';
require_once './Database/security.php';



$articleDB = new ArticleDB($pdo);
$authDB = new AuthDB($pdo);

$currentUser = $authDB->isLoggedIn();
if (!$currentUser) {
  header('Location: /');
  exit;
}
echo $currentUser['id'];

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
                  <a href="/form-article.php?=<?= $article['id'] ?>" class="btn btn-primary">Modifier</a>
                  <a href="/delete-article.php?id=<? $article['id'] ?>" class="btn btn-secondary">Supprimer</a>
                </div>

            </li>
            <?php endforeach; ?>
          </ul>
        </div>


      </div>
    <?php require_once 'includes/footer.php' ?>
  </div>
</body>


