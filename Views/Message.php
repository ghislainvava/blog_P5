<?php
namespace BlogOC\Views;

class Message
{
    public function message()
    {
        $message ='';
        if (!isset($_SESSION['message'])) {
            $_SESSION['message'] = " retourner sur la page d'accueil !";
        }
        $message = $_SESSION['message']; ?>
                <div class="alert alert-success d-flex justify-content-around"
                role="alert">
                <?= $message ?>
                <a class="btn btn-secondary" href="/index.php?page=home">
                    home</a>
                </div>  
               
        <?php
        unset($_SESSION['message']);
    }
}
