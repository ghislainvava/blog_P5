<?php
session_start();
$pdo = require_once './Database/Database.php';
require_once './Database/security.php';
$userDB = new AuthDB($pdo);
$page = $_GET['page'];



$contentView = '';

switch ($page) {
    case '/';
        require_once 'home.php';
    
       
       
        break;
    case 'login':
        require_once 'login.php';
        break;
    case 'articles':
        
        
        require_once 'articles.php';
        break;
    case 'register':
        require_once 'register.php';
        break;
    case 'show-article':
        require_once 'show-article.php';
        break;
    case 'form-article':
        require_once 'form-article.php';
        break;
    case 'logout':
        require_once 'Controllers/logout.php';
        break;
    case 'profil':
        require_once 'profil.php';
        break;
    case 'delete-article':
        require_once 'Database/models/ArticleDB.php';
        require_once 'Controllers/delete-article.php';
        break;
    default :
        include('head.php');
        require_once 'message.php';
        break;
}

//require('template.php');