<?php
session_start();
$pdo = require_once './Database/Database.php';
require_once './Database/security.php';
$userDB = new AuthDB($pdo);
$page = $_GET['page'];
require './Controllers/UsersController.php';
require_once 'Database/models/ArticleDB.php';


$contentView = '';

switch ($page) {
    case '/';
        require_once 'home.php'; 
        break;
    case 'login':
        $headTitle = "Connection";
        $usersController = new UsersController($userDB);
        $contentView = $usersController->login();
     
        break;
    case 'articles':
        $headTitle = "Articles";
        require_once 'articles.php';
        break;

    case 'register':
        $headTitle = "Register";
        $usersController = new UsersController($userDB);
        $contentView = $usersController->register();
      
        
        break;
    case 'show-article':
        $headTitle = "Show-article";
        require_once 'show-article.php';
        break;
    case 'form-article':
        $headTitle = "form-article";
        require_once 'form-article.php';
        break;
    case 'logout':
        $headTitle = "Logout";
        require_once 'Controllers/logout.php';
        break;
    case 'profil':
        $headTitle = "Profil";
        require_once 'profil.php';
        break;
    case 'delete-article':
        $headTitle = "delete-article";
        
        require_once 'Controllers/delete-article.php';
        break;
    default :
       
        require_once 'message.php';
        break;
}
include('template.php');