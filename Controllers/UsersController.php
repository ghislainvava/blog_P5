<?php

session_start();

class UsersController
{
    const ERROR_REQUIRED = "Veuillez renseigner ce champ";
    const ERROR_EMAIL_INVALID = "L'email n'est pas valide";
    const ERROR_EMAIL_NO_RECORD = "l'email n'est pas enregistré";
    const ERROR_PASSWORD_MISMATCH = "erreur sur mot de passe";

    private $userDb;

    public function __construct($userDB)
    {
        $this->userDb = $userDB;
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
                $user = $this->userDb->getUserFromEmail($email);
                if (!$user) {
                    $errors['email'] = ERROR_EMAIL_NO_RECORD;
                } else {
                    if (!password_verify($password, $user['password'])) {
                        $errors['password'] = ERROR_PASSWORD_MISMATCH;
                    } else {
                        $this->userDb->login($user['id']);
                        header('Location: articles.php');
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

        $currentPage = "login";
        $headTitle = "Connection";
        // $formData
        // $errors

        ob_start();

        ///// AU DESSUS : CONTROLLER
        ///
        ///
        ///
        /// AU DESSOUS : VUE

        require '../tmp-login.php';

        return ob_get_clean();
    }

    public function register()
    {

    }
}
