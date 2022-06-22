<?php
namespace BlogOC\Views;

class Message
{
    public function message()
    {
        ?>
                <div class="alert alert-success d-flex justify-content-around"
                role="alert">
                
                <p>Votre opération c'est éffectuée avec succés !</p>
                <a class="btn btn-secondary" href="/index.php?page=home">
                    home</a>
                </div>  
               
        <?php
    }
}
