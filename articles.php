<?php

// $pdo = require_once './Database/Database.php';
// require_once './Database/security.php';
require_once './Database/models/ArticleDB.php';
$articleDB = new ArticleDB($pdo);
//$userDB = new AuthDB($pdo);
$currentUser = $userDB->isLoggedIn();
$articles = $articleDB->fetchAll();
$_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$headTitle ='Articles';
ob_start();
?>

    <div class="container"> 
        <div class="content">
            <?php foreach($articles as $article) : ?>  
            <div class="article">
                <div class="img-container" style="background-image:url("></div>
                    <h2> <a href="index.php?page=show-article&id=<?= $article['id'] ?>"> <?= $article['title'] ?></a></h2>
                    <?php if ($article['image'] !== '') :?>
                    <img  style="width: 300px;" src="images/<?= $article['image'] ?>" />
                    <?php endif; ?>
                    <p><?=$article['content']?></p>     
            </div>
            <?php endforeach; ?>
        </div>
    </div>

<?php
  $contentView = ob_get_clean();
  require('template.php');
?>


