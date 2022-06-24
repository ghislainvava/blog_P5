<?php
namespace BlogOC\Views;

class Message
{
    public function message()
    {
        $message ='';
        if (isset($_SESSION['message'])) {
            $message = $_SESSION['message'];
        }
        $message = " retourner sur la page d'accueil !"; ?>
                <div class="alert alert-success d-flex justify-content-around mt-5" role="alert">
                    <?= $message ?>
                    <a class="btn btn-secondary" href="/index.php?page=home">
                        home</a>
                </div>  
               
        <?php
        unset($_SESSION['message']);
    }

    public function erreur()
    {
        $message ='';
        if (isset($_SESSION['message'])) {
            $message = $_SESSION['message'];
        }
        $message = " Erreur 404 retourner sur la page d'accueil !"; ?>
                <div class="alert alert-danger d-flex justify-content-around mt-5" role="alert">
                    <?= $message ?>
                    <a class="btn btn-secondary" href="/index.php?page=home">
                        home</a>
                </div>  
               
        <?php
        unset($_SESSION['message']);
    }
}
