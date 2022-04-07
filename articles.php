<?php
$articleDB = include './Database/models/ArticleDB.php';

$currentUser = isLoggedIn();


$articles = $articleDB->fetchAll();

$_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

?>

<head>
    <title>articles</title>
</head>
<body>
<?php include 'includes/header.php'; ?>
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