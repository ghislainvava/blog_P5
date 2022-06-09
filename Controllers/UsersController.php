<?php
namespace BlogOC\Controllers;

use BlogOC\Models\MsgError;
use Mailjet\Resources;

class UsersController
{
    private $userDB;
  
    public function __construct($userDB)
    {
        $this->userDB = $userDB;
    }
    private $currentUser;

    public function logout($userDB)
    {
        $sessionId = $_COOKIE['session'] ?? '';
        if ($sessionId) {
            $userDB->logout($sessionId);
            session_destroy();
            header('Location: /index.php?page=login');
            exit;
        }   
    }  
    public function home(){
        ob_start();
        $mj = new \Mailjet\Client('d9e8b3ed3950793fc15812123a486784','56142a2c9ff8ac4a98abf948ef204d8f',true,['version' => 'v3.1']);
        if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST["message"])) {
            $name = htmlspecialchars($_POST['name']);
            $email = htmlspecialchars($_POST['email']);
            $message = htmlspecialchars(($_POST['message']));
    
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                
                $body = [
                    'Messages' => [
                    [
                        'From' => [
                        'Email' => "carcassonneweb@icloud.com",
                        'Name' => "ghislain"
                        ],
                        'To' => [
                        [
                            'Email' => "carcassonneweb@icloud.com",
                            'Name' => "ghislain"
                        ]
                        ],
                        'Subject' => "Greetings from Mailjet.",
                        'TextPart' => "$email, $message",
                    ]
                    ]
                ];
                $response = $mj->post(Resources::$Email, ['body' => $body]);
                //$response->success() && var_dump($response->getData());
            $_SESSION['message'] = 'Votre email a bien été envoyé, nous vous répondrons rapidement';
                header('Location: /index.php?page=message');
                exit; 
            }else{
                $_SESSION['message'] = "Votre email n'a pas pu être envoyé, retenté ultérieurement";
                header('Location: /index.php?page=message');
            exit;
            }
    
        }
        require_once 'Views/home.php';
        return ob_get_clean();

    }
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
    
}

