<?php
$pdo = require_once './Database/Database.php';
require_once './Database/security.php';
include './Database/models/ArticleDB.php';

$articleDB = new ArticleDB($pdo);
$currentUser = isLoggedIn();

$_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$id = $_GET['id'] ?? '';

if (!$id) {
  header('Location: /');
  exit;
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
      <div class="article-container">
        <a class="article-back" href="/">Retour à la liste des articles</a>
        <div class="article-cover-img" style="background-image:url(<?= $article['image'] ?>)"></div>
        <h1 class="article-title"><?= $article['title'] ?></h1>
        <div class="separator"></div>
        <p class="article-content"><?= $article['content'] ?></p>
        <p class="article-author"><?= $article['firstname'] . ' ' . $article['lastname'] ?></p>
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