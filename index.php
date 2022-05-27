<?php
session_start();
require_once './Database/security.php';
require_once 'Database/models/ArticleDB.php';
//$pdo = require_once './Database/Database.php';
require './Controllers/UsersController.php';
require_once './Controllers/ArticlesController.php';
require_once './Database/Database.php';

$db = new DatabaseConnection();
$pdo = $db->getConnection();

    if(isset($_GET['page']) ){
        
        $userDB = new AuthDB($pdo);
        $articleDB = new ArticleDB($pdo);
        if ($_GET['page'] !== 'register' and $_GET['page'] !== 'login'){
            $currentUser = $userDB->isLoggedIn();
            if (!$currentUser) {
                header('Location: /index.php?page=home');
                exit();
            }
        }
        switch ($_GET['page']) {
            case 'home';
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




