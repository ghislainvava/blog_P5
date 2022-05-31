<?php
session_start();
require 'vendor/autoload.php';

use BlogOC\Database\DatabaseConnection;
use BlogOC\Database\AuthDB;
use BlogOC\Database\models\ArticleDB;
use BlogOC\Controllers\UsersController;
use BlogOC\Controllers\ArticlesController;
use BlogOC\Views\Message;

$db = new DatabaseConnection();
$pdo = $db->getConnection();

    if(isset($_GET['page']) ){
        $userDB = new AuthDB($pdo);
        $articleDB = new ArticleDB($pdo);
        if ($_GET['page'] !== 'register' and $_GET['page'] !== 'login'){
            $currentUser = $userDB->isLoggedIn();
            if (!$currentUser) {
                header('Location: /index.php?page=login');
                exit();
            }
        }
        switch ($_GET['page']) {
            case 'home';
                $headTitle ='Presentation';
                $contentView = include('Views/home.php'); 
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
            case 'logout':
                $usersController = new UsersController($userDB);
                $contentView = $usersController->logout($userDB);
                break;
            case 'profil':
                $headTitle = "Mon profil";
                $articlesController = new ArticlesController($articleDB, $currentUser);
                $contentView = $articlesController->getProfil($articleDB, $currentUser); 
                break;
            case 'articles':
                $headTitle = "Articles";
                $articlesController = new ArticlesController($articleDB, $currentUser);
                $contentView = $articlesController->getAllArticle($articleDB, $currentUser); 
                break;
            case 'show-article':
                $headTitle = "Article";
                $articlesController = new ArticlesController($articleDB, $currentUser);
                $contentView = $articlesController->getArticle($articleDB, $currentUser);
                break;
            case 'form-article':
                $articlesController = new ArticlesController($articleDB, $currentUser);
                $contentView = $articlesController->moveArticle($articleDB, $currentUser); 
                break;
            case 'delete-article':
                $articlesController = new ArticlesController($articleDB, $currentUser);
                $contentView = $articlesController->deleteArticle($articleDB, $currentUser); 
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
    }