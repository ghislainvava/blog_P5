<?php
$sessionStart = filter_input_array(session_start());
require 'vendor/autoload.php';

use BlogOC\Database\DatabaseConnection;
use BlogOC\Database\AuthDB;
use BlogOC\Database\models\ArticleDB;
use BlogOC\Controllers\UsersController;
use BlogOC\Controllers\ArticlesController;
use BlogOC\Controllers\CommentController;
use BlogOC\Views\Message;
use BlogOC\Database\models\CommentDB;

ob_start();
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$db = new DatabaseConnection();
$pdo = $db->getConnection();
$get = filter_input_array(INPUT_GET);

if (!isset($get['page'])) {
    $get['page'] = 'home';
} //on attribut home pour démarrer
$userDB = new AuthDB($pdo);
$articleDB = new ArticleDB($pdo);
$commentDB = new CommentDB($pdo);
$currentUser  = $currentUser ?? false;
if ($get['page'] !== 'register' && $get['page'] !== 'login') {
    $currentUser = $userDB->isLoggedIn();
}

switch ($get['page']) {
    case 'home':
        $headTitle ='Presentation';
        $usersController = new UsersController($userDB);
            $contentView = $usersController->home();
        break;
    case 'login':
        $headTitle = "Connection";
        $usersController = new UsersController($userDB);
        $contentView = $usersController->log();
        break;
    case 'register':
        $headTitle = "Enregistrement";
        $usersController = new UsersController($userDB);
        $contentView = $usersController->log();
        break;
    case 'logout':
        $usersController = new UsersController($userDB);
        $contentView = $usersController->logout($userDB);
        break;
    case 'profil':
        $headTitle = "Mon profil";
        $articlesController = new ArticlesController($articleDB);
        $contentView = $articlesController->getProfil($currentUser, $commentDB);
        break;
    case 'articles':
        $headTitle = "Articles";
        $articlesController = new ArticlesController($articleDB);
        $contentView = $articlesController->getAllArticle();
        break;
    case 'show-article':
        $headTitle = "Article";
        $articlesController = new ArticlesController($articleDB);
        $contentView = $articlesController->getArticle($currentUser, $commentDB);
        break;
    case 'form-article':
        $headTitle ="Form-Article";
        $articlesController = new ArticlesController($articleDB);
        $contentView = $articlesController->moveArticle($currentUser);
        break;
    case 'delete-article':
        $articlesController = new ArticlesController($articleDB);
        $contentView = $articlesController->deleteArticle($currentUser);
        break;
    case 'delete-comment':
        $commentController = new CommentController($commentDB);
        $contentView = $commentController->deleteComment($currentUser);
        break;
    case 'checked':
        $commentController = new CommentController($commentDB);
        $contentView = $commentController->checkedComment($currentUser);
        break;
    case 'message':
        $headTitle = "Message";
        include('Views/head.php');
        $message = new Message();
        $contentView = $message->message();
        break;
    case 'erreur':
        $headTitle = "Erreur";
        include('Views/head.php');
        $message = new Message();
        $contentView = $message->erreur();
        break;
    default:
        header:('Location: index.php?=erreur');
        break;
}
if ($get['page'] !== 'message') {
    if ($get['page'] !== 'erreur') {
        include('Views/template.php');//sert à structure la page
    }
}
