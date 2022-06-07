<?php
session_start();
require 'vendor/autoload.php';

use BlogOC\Database\DatabaseConnection;
use BlogOC\Database\AuthDB;
use BlogOC\Database\models\ArticleDB;
use BlogOC\Controllers\UsersController;
use BlogOC\Controllers\ArticlesController;
use BlogOC\Views\Message;
use BlogOC\Controllers\TestController;
use BlogOC\Database\models\CommentDB;

$db = new DatabaseConnection();
$pdo = $db->getConnection();

if(!isset($_GET['page']))  $_GET['page'] = 'home'; //on attribut home pour démarrer
$userDB = new AuthDB($pdo);
$articleDB = new ArticleDB($pdo);
$commentDB = new CommentDB($pdo);
if ($_GET['page'] !== 'register' and $_GET['page'] !== 'login'){
    $currentUser = $userDB->isLoggedIn();
} else{
    $currentUser  = $currentUser ?? false;
}
switch ($_GET['page']) {
    case 'home';
        $headTitle ='Presentation';
        $usersController = new UsersController($userDB);
        $contentView = $usersController->home();     
        break;
    case 'login':
        $headTitle = "Connection";
        //$usersController = new UsersController($userDB);

        //$contentView = $usersController->login();
        $usersController = new TestController($userDB);
        $contentView = $usersController->log();
        break; 
    case 'register':
        $headTitle = "Enregistrement";
        $usersController = new UsersController($userDB);
        $contentView = $usersController->register();
        break;
    case 'logout':
        $usersController = new UsersController($userDB);
        $contentView = $usersController->logout($userDB);
        break;
    case 'profil':
        $headTitle = "Mon profil";
        $articlesController = new ArticlesController($articleDB);
        $contentView = $articlesController->getProfil( $currentUser); 
        break;
    case 'articles':
        $headTitle = "Articles";
        $articlesController = new ArticlesController($articleDB);
        $contentView = $articlesController->getAllArticle( $currentUser); 
        break;
    case 'show-article':
        $headTitle = "Article";
        $articlesController = new ArticlesController($articleDB);
        $contentView = $articlesController->getArticle($currentUser, $commentDB);
        break;
    case 'form-article':
        $headTitle ="Form-Article";
        $articlesController = new ArticlesController($articleDB);
        $contentView = $articlesController->moveArticle($articleDB, $currentUser); 
        break;
    case 'delete-article':
        $articlesController = new ArticlesController($articleDB);
        $contentView = $articlesController->deleteArticle( $currentUser); 
        break;
    case 'message';
        $headTitle = "message";
        include('Views/head.php');
        $message = new Message();
        $contentView = $message->message();
        break;
    default :
        header:('Location: index.php?=message');
        break;        
}
    include('Views/template.php');//sert à structure la page
    