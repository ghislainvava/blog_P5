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
    public function logout($userDB)
    {
        $cookie = filter_input_array(INPUT_COOKIE);
        $sessionId = $cookie['session'] ?? '';
        if ($sessionId) {
            $userDB->logout($sessionId);
            $sessiondestroy = filter_input_array(session_destroy());
            header('Location: /index.php?page=login');
            exit;
        }   
    }  
    public function home(){
        ob_start();
        $post = filter_input_array(INPUT_POST);
        //$sessionStart = filter_input_array(session_start());
        $mj = new \Mailjet\Client('d9e8b3ed3950793fc15812123a486784','56142a2c9ff8ac4a98abf948ef204d8f',true,['version' => 'v3.1']);
        if(!empty($post['name']) && !empty($post['email']) && !empty($post["message"])) {
            $email = htmlspecialchars($post['email']);
            $message = htmlspecialchars(($post['message']));
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
   
    public function log()
    { 
        ob_start();
        $objet= new MsgError();
        $msgError = $objet->msgError;
        $msgError = $objet->prgPush($msgError); //on recupere les messages d'erreurs sotcoker par PRG
        $email = $msgError['placeholder']['login']['email']; //on rempli s'il y a un placeholder enregistré
        $password = $msgError['placeholder']['login']['password'];
        $lastname = $msgError['placeholder']['name']['lastname'];
        $firstname = $msgError['placeholder']['name']['firstname'];
        $get = filter_input_array(INPUT_GET);
        $post = filter_input_array(INPUT_POST);
        $method = filter_input_array(INPUT_SERVER);
        $page = $get['page'];
         if ($method['REQUEST_METHOD'] === 'POST'){
           
             $input = filter_input_array(INPUT_POST, [
                 'firstname' => FILTER_SANITIZE_SPECIAL_CHARS,
                 'lastname' => FILTER_SANITIZE_SPECIAL_CHARS,
                 'email' => FILTER_SANITIZE_EMAIL,
             ]);

             $email = $post['email'] ?? '';
             $password = $post['password'] ?? '';
             $firstname = $post['firstname'] ?? '';
             $lastname = $post['lastname'] ?? '';
             $msgError = $objet->pushErrors( $msgError, $email, $password, $lastname, $firstname);
             $error1 = $msgError['errors']['login'];
             $error2 = $msgError['errors']['name'];
             //recuperer le tableau errors car besoin pour fonctionner
            
                if (empty(array_filter($error1, fn ($e) => $e !== ''))){ 
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
                             exit();
                         }
                     }
                 } else {
                    if (empty(array_filter($error2, fn ($e) => $e !== ''))){ 
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
            }elseif ($page ==='login'){
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
        if ($page ==='login'){
            require_once 'Views/login.php';
            return ob_get_clean();
        }else{
            require_once 'Views/register.php';
            return ob_get_clean();
        }
            
       }
    
}

