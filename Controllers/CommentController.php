<?php
namespace BlogOC\Controllers;

 use BlogOC\Models\MsgError;


class CommentController
{
  
   //private $currentUser ; 
   private $commentDB;
   public function __construct($commentDB){
    $this->commentDB = $commentDB;
   }

   public function deleteComment($currentUser)
   {
       if ($currentUser['admin'] < 1) {
           $_SESSION['message'] = "Vous n'êtes pas administrateur le commentaire ne peux pas être supprimé";
           header('Location: /index.php?page=message');
           exit();
         } else{
            $get = filter_input_array(INPUT_GET);
             $get = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
             $_id = $get['id'] ?? '';
             if ($_id) {
                $comment = $this->commentDB->delete($_id);
                $_SESSION['message'] = "le commentaire a bien été supprimé";   
           }  
             header('Location: /index.php?page=message');
             exit();
         }
   }
   public function checkedComment($currentUser)
    {
        if ($currentUser['admin'] < 1) { //acces seulement aux administrateur
            $_SESSION['message'] = "Vous n'êtes pas administrateur, vous ne pouvez pas validé le commentaire!";
            header('Location: /index.php?page=message');
            exit();
        } else {
            $get = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $_id = $get['id'] ?? '';
            $comment = $this->commentDB->checked($_id);
            $_SESSION['message'] = "le commentaire a bien été supprimé";   
            header('Location: /index.php?page=message');
            exit();
        }
   }
   


}