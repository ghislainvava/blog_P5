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


$_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$id = $_GET['id'] ?? '';

if (!$id) {
  header('Location: /');
  exit();
} else {
  $article = $articleDB->fetchOne($id);
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <?php require_once 'includes/head.php' ?>
  <title>Article seul</title>
</head>

<body>
  <div class="container">
    <?php require_once 'includes/header.php' ?>
    <div class="content">
      <div >
        <a  href="/articles.php">Retour à la liste des articles</a>
        <div  style="background-image:url(<?= $article['image'] ?>)"></div>
        <h1 ><?= $article['title'] ?></h1>
        
        <p ><?= $article['content'] ?></p>
        <p >Post émis part : <?= $article['firstname'] . ' ' . $article['lastname'] ?></p>
        <?php if($currentUser && $currentUser['id'] === $article['author']) : ?>
        <div class="action">
          <a class="btn btn-secondary" href="/delete-article.php?id=<?= $article['id'] ?>">Supprimer</a>
         
          <a class="btn btn-primary" href="/form-article.php?id=<?= $article['id'] ?>">Editer l'article</a>
        </div>
        <?php endif; ?>
      </div>
    </div>
    <?php require_once 'includes/footer.php' ?>
  </div>

</body>

</html>