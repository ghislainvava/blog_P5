<?php
session_start();
$pdo = require_once './Database/Database.php';
require_once './Database/security.php';
require_once './Database/models/ArticleDB.php';
$articleDB = new ArticleDB($pdo);
$userDB = new AuthDB($pdo);
$currentUser = $userDB->isLoggedIn();
$articles = $articleDB->fetchAll();
$_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
?>
<head>
    <?php include 'includes/header.php'; ?>
    <title>articles</title>
</head>
<body>
    <div class="container"> 
        <div class="content">
            <?php foreach($articles as $article) : ?>  
            <div class="article">
                <div class="img-container" style="background-image:url(<?= $article['image'] ?>"></div>
                    <h2> <a href="/show-article.php?id=<?= $article['id'] ?>"> <?= $article['title'] ?></a></h2>
                    <p><?=$article['content']?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>