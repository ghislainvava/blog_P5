<?php
$headTitle = "Message";
if (isset($_SESSION['message'])){
    $message = $_SESSION['message'];
    if (isset($_SESSION['delete'])) :
        $message ="l'article a bien été supprimé"; 
        ?>
        <div class="alert alert-danger d-flex justify-content-around"
         role="alert">
         <?= $message ?>
        </div>
        <?php   else :
             ?>
        <div class="alert alert-success d-flex justify-content-around"
         role="alert">
         <?= $message ?>
        </div>  

        <a class="btn btn-secondary" href="/index.php?page=articles">
            Articles</a>
            
            <?php endif; 
    unset($_SESSION['message']);
        }
    
    
//     if (!isset($_SESSION['message'])){
//         header('Location: /index.php?page=form-article'
//         exit;
//     }
// }
?>