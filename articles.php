<?php


require './Database/models/ArticleDB.php';
$pdo = require_once './Database/Database.php';
$articleDB = new ArticleDB($pdo);
require './Database/security.php';

$currentUser = isLoggedIn();


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
                <h2><?= $article['title'] ?></h2>
        </div>
        <?php endforeach; ?>
    </div>
</div>


</body>