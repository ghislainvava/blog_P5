<?php
namespace BlogOC\Controllers;
use BlogOC\Models\MsgError;

class TestController 
{

    private $userDB;
  
    public function __construct($userDB)
    {
        $this->userDB = $userDB;
    }
    private $currentUser ;
    
    public function log()
    { 
        ob_start();
        $objet= new MsgError();
        $msgError = $objet->msgError;
        $msgError = $objet->prgPush($msgError);
         if ($_SERVER['REQUEST_METHOD'] === 'POST'){
             $input = filter_input_array(INPUT_POST, [
                 'firstname' => FILTER_SANITIZE_SPECIAL_CHARS,
                 'lastname' => FILTER_SANITIZE_SPECIAL_CHARS,
                 'email' => FILTER_SANITIZE_EMAIL,
             ]);
             $email = $input['email'] ?? '';
             $password = $_POST['password'] ?? '';
             $firstname = $input['firstname'] ?? '';
             $lastname = $input['lastname'] ?? '';
             //recuperer le tableau errors car besoin pour fonctionner
             if ($msgError['errors']['login']['email'] === '' and $msgError['errors']['login']['password'] === ''  ){
                 if($_GET['page'] === 'login'){ 
                     $user = $this->userDB->getUserFromEmail($email);
                     if (!$user) {
                         $msgError['errors']['login']['email'] = $msgError['ERROR_EMAIL_NO_RECORD'];
                     } else {
                         if (!password_verify($password, $user['password'])) {
                             $msgError['errors']['login']['password'] = $msgError['ERROR_PASSWORD_MISMATCH'];
                         } else {
                             $this->userDB->login($user['id']);
                             header('Location: index.php?page=articles');                      
                             return $msgError;
                         }
                     }
                 } else {
                     if ($msgError['errors']['name']['lastname'] === '' and $msgError['errors']['name']['firstname'] === ''){
                         $this->userDB->register([
                             'firstname' => $firstname,
                             'lastname' => $lastname,
                             'email' => $email,
                             'password' => $password
                             ]);
                             header('Location: /index.php?page=login');
                             exit();
                         } 
                 }
           }  // ils y a des messages d'erreurs 
             $objet->fillPRG($msgError, $email, $password, $lastname, $firstname);
                 if ($_GET['page'] ==='login'){
                 header( "Location: /index.php?page=login");
                 return $msgError['errors'];
             }else{
                 header( "Location: /index.php?page=register");
                 return $msgError['errors'];
                 exit();   
             }
       }
       require_once 'Views/login.php';
      return ob_get_clean();
     }
}


