<?php

session_start();
$currentUser ;
$contentView = '';
$pdo = require_once './Database/Database.php';
require_once 'Database/models/ArticleDB.php';
require_once './Database/security.php';
require './Controllers/UsersController.php';
require_once './Controllers/ArticlesController.php';
$userDB = new AuthDB($pdo);
$articleDB = new ArticleDB($pdo);
$page = $_GET['page'];
if ($page !== 'register' and $page !== 'login'){
    $currentUser = $userDB->isLoggedIn();
    if (!$currentUser) {
        header('Location: /');
        exit();
    }
}

switch ($page) {
    case '/';
        require_once 'home.php'; 
        break;
    case 'login':
        $headTitle = "Connection";
        $usersController = new UsersController($userDB);
        $contentView = $usersController->login();
        break; 
    case 'register':
        $headTitle = "Enregistrement";
        $usersController = new UsersController($userDB);
        $contentView = $usersController->register();
        break;
    case 'articles':
        $headTitle = "Articles";
        $currentUser = $userDB->isLoggedIn();
        $articlesController = new ArticlesController($articleDB, $currentUser);
        $contentView = $articlesController->getAllArticle($articleDB, $currentUser); 
        break;
    case 'profil':
        $headTitle = "Profile";
        $currentUser = $userDB->isLoggedIn();
        $articlesController = new ArticlesController($articleDB, $currentUser);
        $contentView = $articlesController->getProfil($articleDB, $currentUser); 
        break;
    case 'show-article':
        $headTitle = "Article";
        $currentUser = $userDB->isLoggedIn(); //authentification
        $articlesController = new ArticlesController($articleDB, $currentUser);
        $contentView = $articlesController->getArticle($articleDB, $currentUser);
        require_once 'show-article.php';
        break;
    case 'form-article':
        $currentUser = $userDB->isLoggedIn(); //authentification   
        $articlesController = new ArticlesController($articleDB, $currentUser);
        $contentView = $articlesController->moveArticle($articleDB, $currentUser); 
        break;
    case 'logout':
        $headTitle = "Déconnection";
        require_once 'Controllers/logout.php';
        break;
    case 'delete-article':
        $headTitle = "Suppression-article";
        require_once 'Controllers/delete-article.php';
        break;
    default :
        require_once 'message.php';
        break;
}
include('template.php');//sert à structure la page