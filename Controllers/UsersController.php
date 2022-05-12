<?php

class UsersController
{
    const ERROR_REQUIRED = "Veuillez renseigner ce champ";
    const ERROR_EMAIL_INVALID = "L'email n'est pas valide";
    const ERROR_EMAIL_NO_RECORD = "l'email n'est pas enregistré";
    const ERROR_PASSWORD_MISMATCH = "erreur sur mot de passe";
    const ERROR_TOO_SHORT = 'Ce champ est trop court';
    const ERROR_PASSWORD_TOO_SHORT = 'Le mot de passe doit faire au moins 6 caractéres';
    

    private $userDB;

    public function __construct($userDB)
    {
        $this->userDB = $userDB;
    }

    public function login()
    {
        $errors = [
            'email' => '',
            'password' => ''
        ];
        if (isset($_SESSION['email'])){
            $errors = $_SESSION['email'];
        }
        if (isset($_SESSION['password'])) {
            $errors = $_SESSION['password'];
        }
        if (isset($_SESSION['input_email'])) {
            $email = $_SESSION['input_email'];
        }
        if (isset($_SESSION['post_email'])) {
            $password = $_SESSION['post_email'];
        }
        unset($_SESSION['email'], $_SESSION['password'], $_SESSION['input_email'], $_SESSION['post_email'] );
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $input = filter_input_array(INPUT_POST, [
                'email' => FILTER_SANITIZE_EMAIL,
            ]);
            $email = $input['email'] ?? '';
            $password = $_POST['password'] ?? '';
            if (!$email) {
                $errors['email'] = ERROR_REQUIRED;
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = ERROR_EMAIL_INVALID;
            }
            if (!$password) {
                $errors['password'] = ERROR_REQUIRED;
            }
            if (empty(array_filter($errors, fn ($e) => $e !== ''))) {
                $user = $this->userDB->getUserFromEmail($email);
                if (!$user) {
                    $errors['email'] = ERROR_EMAIL_NO_RECORD;
                } else {
                    if (!password_verify($password, $user['password'])) {
                        $errors['password'] = ERROR_PASSWORD_MISMATCH;
                    } else {
                        $this->userDB->login($user['id']);
                        header('Location: index.php?page=articles');
                        exit();
                    }
                }
            } else {
                if (!empty($errors['email'])){
                    $_SESSION['email'] = $errors['email'];
                }
                if (!empty($errors['password'])){
                    $_SESSION['password'] = $errors['password'];
                }
                if ($email !== ''){
                    $_SESSION['input_email'] = $email;
                }
                if ($password !== ''){
                    $_SESSION['post_password'] = $password;
                }
                header( "Location: /index.php?page=login");
                exit();
            }
        }

    
        // $formData
        // $errors

        ob_start();

        ///// AU DESSUS : CONTROLLER
        ///
        ///
        ///
        /// AU DESSOUS : VUE

        require './login.php';

        return ob_get_clean();
    }

   
    function affichage_erreur(){
    $errors = [
        'firstname' => '',
        'lastname' => '',
        'email' => '',
        'password' => ''
    ];
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $input = filter_input_array(INPUT_POST, [
                'firstname' => FILTER_SANITIZE_SPECIAL_CHARS,
                'lastname' => FILTER_SANITIZE_SPECIAL_CHARS,
                'email' => FILTER_SANITIZE_EMAIL,
            ]);
            $email = $input['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $firstname = $input['firstname'] ?? '';
            $lastname = $input['lastname'] ?? '';

            if (!$firstname) {
                $errors['firstname'] = ERROR_REQUIRED;
            } elseif (mb_strlen($firstname) < 2) {
                $errors['firstname'] = ERROR_TOO_SHORT;
            }
            if (!$lastname) {
                $errors['lastname'] = ERROR_REQUIRED;
            } elseif (mb_strlen($lastname) < 2) {
                $errors['lastname'] = ERROR_TOO_SHORT;
            }
            if (!$email) {
                $errors['email'] = ERROR_REQUIRED;
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = ERROR_EMAIL_INVALID;
            }
            if (!$email) {
                $errors['password'] = ERROR_REQUIRED;
            } elseif (mb_strlen($password) < 6) {
                $errors['password'] = ERROR_PASSWORD_TOO_SHORT;
            }
            if (empty(array_filter($errors, fn ($e) => $e !== ''))) {
                $this->userDB->register([
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $email,
                'password' => $password
                ]);
                header('Location: /index.php?page=/');
            
            }
        }

        return $errors;
        
   }

   function enregistrement($errors){ 
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        //recuperer le tableau errors car besoin pour fonctionner
    if (empty(array_filter($errors, fn ($e) => $e !== ''))) {
        $this->userDB->register([
        'firstname' => $firstname,
        'lastname' => $lastname,
        'email' => $email,
        'password' => $password
        ]);
        header('Location: /index.php?page=/');
    
    }
   }
}
    public function register()
    {
        ob_start();
        $errors = $this->affichage_erreur();
        $this->enregistrement($errors);
        require_once 'register.php';
        return ob_get_clean();
    }              
}
