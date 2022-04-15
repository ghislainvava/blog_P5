<?php
session_start();

   if(!empty($_POST)) {
    
      if($_POST['prg'] === 'toto'){
        echo 'tata';
        exit;
      }else{
      
          $_SESSION['erreur_pour_le_champs_prg'] = true ;
          header('Location: /PRG.php');
          exit;
      }

   }
   if(empty($_SESSION)){
       echo 'le champ est vide';
   }

   var_dump($_SESSION);
?>

<form action="PRG.php" method="post">
    <input type="text" name="prg">

</form>


$_SESSION['has_error'] = true;
$_SESSION['errors']['champ_title'] = CONSTANT_ERROR_TITRE_TROP_COURT;
$_SESSION['form_data']['champ_title'] = $_POST['champ_title'];// + eventuel filter_



              