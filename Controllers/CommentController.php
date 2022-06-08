<?php
namespace BlogOC\Controllers;

 use BlogOC\Models\MsgError;


class CommentController
{
  
   private $currentUser ; 
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
             $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
             $id = $_GET['id'] ?? '';
             if ($id) {
                $comment = $this->commentDB->delete($id);
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
            $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $id = $_GET['id'] ?? '';
            $comment = $this->commentDB->checked($id);
            $_SESSION['message'] = "le commentaire a bien été supprimé";   
            header('Location: /index.php?page=message');
            exit();
        }
   }
   


}