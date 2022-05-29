<?php

use Database\DatabaseConnection;
use Database\AuthDB;
use Database\models\ArticleDB;

$articleDB = new ArticleDB($pdo);
$currentUser = $userDB->isLoggedIn();
$headTitle = 'Suppression Article';

if (!$currentUser) {
  header('Location: /index.php?page=/');
  exit();
} else{
    $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $id = $_GET['id'] ?? '';
    if ($id) {
      $article = $articleDB->fetchOne($id);
      if ($article['author'] === $currentUser['id']) {
        $articleDB->deleteOne($id);
        $_SESSION['message'] = "l'article a bien été supprimé";
       
      }
  }  
 
    header('Location: /index.php?page=message');
    exit();
}


