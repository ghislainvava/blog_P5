<?php
namespace BlogOC\Views;

class Message {
    public function message(){
        $headTitle = "Message";
        $message ='';
        if (!isset($_SESSION['message'])){
            $_SESSION['message'] = " retourner sur la page d'accueil !";
        }
            $message = $_SESSION['message'];
            if (isset($_SESSION['delete'])) :
                $message = "l'article a bien été supprimé"; 
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
                <a class="btn btn-secondary" href="/index.php?page=home">
                    home</a>
                </div>  
               
                    
                    <?php endif; 
            unset($_SESSION['message']);
        }
}

 
        
    
    

