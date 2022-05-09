<?php
session_start();

if ($_SESSION['message'] !== ''){
   
    $message = $_SESSION['message'];
    if (isset($_SESSION['delete'])){
                $message ="l'article a bien été supprimé";
    }?>
    <div class="alert alert-success d-flex justify-content-around"
         role="alert">
        <?= $message ?>
        <a class="btn btn-secondary" href="/articles.php">
            Articles</a>
    </div>
    <?php 
        $_SESSION['message'] = '';    
}  


header('Location: /form-article.php');
exit();



