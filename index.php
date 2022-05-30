<?php
session_start();
require 'vendor/autoload.php';

use BlogOC\Database\DatabaseConnection;
use BlogOC\Database\AuthDB;
use BlogOC\Database\models\ArticleDB;
use BlogOC\Controllers\UsersController;
use BlogOC\Controllers\ArticlesController;


$db = new DatabaseConnection();
$pdo = $db->getConnection();

    if(isset($_GET['page']) ){
        $userDB = new AuthDB($pdo);
        $articleDB = new ArticleDB($pdo);
        if ($_GET['page'] !== 'register' and $_GET['page'] !== 'login'){
            $currentUser = $userDB->isLoggedIn();
            var_dump($currentUser);
            if (!$currentUser) {
                header('Location: /index.php?page=login');
                exit();
            }
        }
        switch ($_GET['page']) {
            case 'home';
                $headTitle ='Presentation';
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
            case 'logout':
                $headTitle = "Déconnection";
                $usersController = new UsersController($userDB);
                $contentView = $usersController->logout($userDB);
                break;
            case 'profil':
                $headTitle = "Profile";
                $currentUser = $userDB->isLoggedIn();
                $articlesController = new ArticlesController($articleDB, $currentUser);
                $contentView = $articlesController->getProfil($articleDB, $currentUser); 
                break;
            case 'articles':
                $headTitle = "Articles";
                $currentUser = $userDB->isLoggedIn();
                $articlesController = new ArticlesController($articleDB, $currentUser);
                $contentView = $articlesController->getAllArticle($articleDB, $currentUser); 
                break;
            case 'show-article':
                $headTitle = "Article";
                $currentUser = $userDB->isLoggedIn(); //authentification
                $articlesController = new ArticlesController($articleDB, $currentUser);
                $contentView = $articlesController->getArticle($articleDB, $currentUser);
                break;
            case 'form-article':
                $currentUser = $userDB->isLoggedIn(); //authentification   
                $articlesController = new ArticlesController($articleDB, $currentUser);
                $contentView = $articlesController->moveArticle($articleDB, $currentUser); 
                break;
            case 'delete-article':
                $headTitle = "Suppression-article";
                $articlesController = new ArticlesController($articleDB, $currentUser);
                $contentView = $articlesController->deleteArticle($articleDB, $currentUser); 
                break;
            case 'message';
                require_once 'message.php';
                include('head.php');
                break;
            default :
                require_once 'message.php';
                include('head.php');
            break;
                
        }
        if ($_GET['page'] !== 'message') {
            include('template.php');//sert à structure la page
        }

            }else{
                header('Location: /index.php?page=message');
            }




