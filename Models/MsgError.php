<?php

class MsgError {


    public $msgError = array(
            
        "ERROR_REQUIRED" => "Veuillez renseigner ce champ",
        "ERROR_EMAIL_INVALID" => "L'email n'est pas valide",
        "ERROR_EMAIL_NO_RECORD" => "l'email n'est pas enregistré",
        "ERROR_PASSWORD_MISMATCH" => "erreur sur mot de passe",
        "ERROR_TOO_SHORT" => 'Ce champ est trop court',
        "ERROR_PASSWORD_TOO_SHORT" => 'Le mot de passe doit faire au moins 6 caractéres',
        "ERROR_TITLE_TOO_SHORT" => 'Le titre est trop court',
        'ERROR_CONTENT_TOO_SHORT' => "L'article est trop court",
        'ERROR_SIZE_IMAGE' => "L'image doit faire moins de 6 MO",
        'ERROR_EXTENSIONS' => "Veuillez sélectionner un format de fichier valide",
   
    'errors' => array(
            'login' => array(
                'email' => '',
                'password' => ''
            ),
            'name' => array(
                'firstname' => '',
                'lastname' => ''
            ),
            'attribut' => array(
                'title' => '',
                'image' => '',
                'content' => ''
            )
        )
    );

    function prgPush($msgError){
        
        if (isset($_SESSION['PRG']['email'])){
            $msgError['errors']['login']['email'] = $_SESSION['PRG']['email'];
        }
        if (isset($_SESSION['PRG']['password'])) {
            $msgError['errors']['login']['password'] = $_SESSION['PRG']['password'];
        }
        if (isset($_SESSION['PRG']['input_email'])) {
            $email = $_SESSION['PRG']['input_email'];['PRG'];
        }
        if (isset($_SESSION['PRG']['post_email'])) {
            $password = $_SESSION['PRG']['post_email'];
        }
        if (isset($_SESSION['PRG']['title'])){    //on rapelle les erreurs enregistré sur les cookies sessions
            $msgError['errors']['attribut']['title'] = $_SESSION['title'];
        }
        if (isset($_SESSION['PRG']['image'])){
            $msgError['errors']['attribut']['image'] = $_SESSION['image'];  
        }
        if (isset($_SESSION['PRG']['content'])){
            $msgError['errors']['attribut']['content'] = $_SESSION['content'] ;   
        }
        if (isset($_SESSION['PRG']['post_title'])) {  //on rapelle les saisies 
            $title = $_SESSION['post_title'];      
        }
        if (isset($_SESSION['post_image'])) {
            $image = $_SESSION['post_image'];
        }
        if (isset($_SESSION['PRG']['post_content'])) {
            $content = $_SESSION['post_content'];
        }
        unset($_SESSION['PRG']);
        return $msgError;
    }

    function identifiantError($msgError, $email, $password){
        
            
            if (!$email) {
                $msgError['errors']['login']['email'] = $msgError['ERROR_REQUIRED'];
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $msgError['errors']['login']['email'] = $msgError['ERROR_EMAIL_INVALID'];
            }
            if (!$password) {
                $msgError['errors']['login']['password'] = $msgError['ERROR_REQUIRED'];
            }
        return $msgError;
    }

    function fillPRG($erorLogin, $email, $password){
            if (!empty($ererorLogin['email'])){ //on rempli $_SESSION avant PRG
                $_SESSION['PRG']['email'] = $erorLogin['email'];
            }
            if (!empty($erorLogin['password'])){
                $_SESSION['PRG']['password'] = $erorLogin['password'];
            }
            if ($email !== ''){
                $_SESSION['PRG']['input_email'] = $email; 
            }
            if ($password !== ''){
                $_SESSION['PRG']['post_password'] = $password;
            }
        }

}