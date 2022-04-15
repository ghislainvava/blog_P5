<?php

$pdo = require_once './Database/Database.php';
require_once './Database/security.php';
require_once './Database/models/ArticleDB.php';
$userDB = new AuthDB($pdo);
$articleDB = new ArticleDB($pdo);


$currentUser = $userDB->isLoggedIn();
if (!$currentUser) {
    header('Location: /');
    exit();
} else{
      $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $id = $_GET['id'] ?? '';
      if ($id) {
        $article = $articleDB->fetchOne($id);
        if ($article['author'] === $currentUser['id']) {
          $articleDB->deleteOne($id);
        }
    }
      header('Location: /form-article.php');
      exit();
      //if($_SERVER['HTTP_REFERER'] == "page1.php")
}


