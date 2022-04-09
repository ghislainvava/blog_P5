<?php

$pdo = require_once './Database/Database.php';
require_once './Database/security.php';
require_once './Database/models/ArticleDB.php';
$authDB = new AuthDB($pdo);
$articleDB = new ArticleDB($pdo);

$currentUser = $auth->isLoggedIn();


if (!$currentUser) {
  
    
    $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $id = $_GET['id'] ?? '';
    if ($id) {
      $article = $articleDB->fetchOne($id);
      if ($article['author'] === $currentUser['id']) {
        $articleDB->deleteOne($id);
      }
  }
}
  header('Location: /articles');
  exit;