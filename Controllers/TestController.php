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
    public function affichage_erreur()
    {
        $objet= new MsgError();
        $msgError = $objet->msgError;
        $msgError = $objet->prgPush($msgError); //sert a remplir msgError avec le PRG
  
            if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
                $email = $input['email'] ?? '';
                $password = $_POST['password'] ?? '';
                $firstname = $input['firstname'] ?? '';
                $lastname = $input['lastname'] ?? '';
                $msgError = $objet->pushErrors($msgError, $email, $password,$lastname, $firstname );   
        }
       return $msgError;    
   }
   public function enregistrement($msgError, $page, $objet)
   { 
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
                if($page === 'login'){ 
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
                if ($page ==='login'){
                header( "Location: /index.php?page=login");
                return $msgError['errors'];
            }else{
                header( "Location: /index.php?page=register");
                return $msgError['errors'];
                exit();   
            }
      }
    }
    public function register()
    {
        ob_start(); 
        $msgError = $this->affichage_erreur();
        $this->enregistrement($msgError,'register',new MsgError());
        require_once 'Views/register.php';
        return ob_get_clean();
    } 
     public function login()
    {
        ob_start();
        $msgError = $this->affichage_erreur();
        $this->enregistrement($msgError,'login',new MsgError());
        require_once 'Views/login.php';
        return ob_get_clean();
    }
    
    public function log()
    { 
        ob_start();
        $objet= new MsgError();
        $msgError = $objet->msgError;
        $msgError = $objet->prgPush($msgError);
        unset($_SESSION['PRG']);
        $email = $msgError['placeholder']['login']['email']; //on rempli s'il y a un placeholder enregistré
        $password = $msgError['placeholder']['login']['password'];
        $lastname = $msgError['placeholder']['name']['lastname'];
        $firstname = $msgError['placeholder']['name']['firstname'];
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
             $msgError = $objet->pushErrors( $msgError, $email, $password, $lastname, $firstname);
             //recuperer le tableau errors car besoin pour fonctionner
             if ($msgError['errors']['login']['email'] === '' and $msgError['errors']['login']['password'] === ''){
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
                   if(  $msgError['errors']['name']['lastname'] === '' and $msgError['errors']['name']['firstname'] === ''){
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
            }elseif ($_GET['page'] ==='login'){
             // il y a des messages d'erreurs 
             $objet->fillPRG($msgError);
             header( "Location: /index.php?page=login");
             exit();
            }else{
             $objet->fillPRG($msgError);
             header( "Location: /index.php?page=register");
             exit();   
            }

        }
        if ($_GET['page'] ==='login'){
            require_once 'Views/login.php';
            return ob_get_clean();
        }else{
            require_once 'Views/register.php';
            return ob_get_clean();
        }
            
       }
       
}



