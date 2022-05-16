<?php
require './Models/MsgError.php';

class UsersController
{
    private $userDB;

    public function __construct($userDB)
    {
        $this->userDB = $userDB;
    }

    function affichage_erreur() {
       
        $objet= new MsgError();
        $msgError = $objet->msgError;
        $msgError = $objet->prgPush($msgError);
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $input['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $firstname = $input['firstname'] ?? '';
            $lastname = $input['lastname'] ?? '';
                if (!$firstname) {
                    $msgError['errors']['name']['firstname'] = $msgError['ERROR_REQUIRED'];  //$erors est variable dans le form
                } elseif (mb_strlen($firstname) < 2) {
                    $msgError['errors']['name']['firstname'] = $msgError['ERROR_TOO_SHORT'];
                }
                if (!$lastname) {
                    $msgError['errors']['name']['lastname'] = $msgError['ERROR_REQUIRED'];
                } elseif (mb_strlen($lastname) < 2) {
                    $msgError['errors']['name']['lastname'] = $msgError['ERROR_TOO_SHORT'];
                }
            $msgError = $this->loginEror($email, $password, $msgError); //remplir erreur identifiants 
        }
        return $erors = $msgError['errors'];   
   }
   function loginEror($email, $password, $msgError){
    if (!$email) {
        $msgError['errors']['login']['email'] = $msgError['ERROR_REQUIRED'];
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msgError['errors']['login']['email'] = $msgError['ERROR_EMAIL_INVALID'];
    }
    if (!$password) {
        $msgError['errors']['login']['password'] = $msgError['ERROR_REQUIRED'];
    } elseif (mb_strlen($password) < 6) {
        $msgError['errors']['login']['password'] = $msgError['ERROR_PASSWORD_TOO_SHORT'];
    }
    return $msgError;
   }
   function enregistrement($erors,$cas,$objet){
       if($cas === 'register'){ 
        $erorsRegister = array_merge( $errors['login'], $errors['name']);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $input = filter_input_array(INPUT_POST, [
                'firstname' => FILTER_SANITIZE_SPECIAL_CHARS,
                'lastname' => FILTER_SANITIZE_SPECIAL_CHARS,
                'email' => FILTER_SANITIZE_EMAIL,
            ]);
            //recuperer le tableau errors car besoin pour fonctionner
        if (empty(array_filter($erorsRegister, fn ($e) => $e !== ''))) {
            $this->userDB->register([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'password' => $password
            ]);
            header('Location: /index.php?page=/');
            exit();
            }
            header('Location: /index.php.page=register');
            exit();
          } 
        } else {
            if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $input = filter_input_array(INPUT_POST, [
                'email' => FILTER_SANITIZE_EMAIL,
            ]);
            $email = $input['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $erorLogin = $erors['login'];
           
            if (empty(array_filter($erorLogin, fn ($e) => $e !== ''))) {  
                
                $user = $this->userDB->getUserFromEmail($email);
                if (!$user) {
                    $erorLogin['email'] = $msgError['ERROR_EMAIL_NO_RECORD'];
                } else {
                    if (!password_verify($password, $user['password'])) {
                        $erorLogin['password'] = $msgError['ERROR_PASSWORD_MISMATCH'];
                    } else {
                        $this->userDB->login($user['id']);
                        header('Location: index.php?page=articles');
                        $erors = $erorLogin;
                        return $erors;
                    }
                }
            } else { 
                
           $objet->fillPRG($erorLogin, $email, $password);
            header( "Location: /index.php?page=login");
            return $msgError['errors'];
                }
            }
        }
    }
    
    public function register()
    {
        ob_start();
        $erors['password'] = '';
        $erors['email'] = '';
        $erors = $this->affichage_erreur();
        $this->enregistrement($erors,'register',null);
        require_once 'register.php';
        return ob_get_clean();
    } 

     public function login()
    {
        ob_start();
        $erors = $this->affichage_erreur();
        $this->enregistrement($erors,'login',new MsgError());
        

        require_once 'login.php';
        return ob_get_clean();
    }
    
}

