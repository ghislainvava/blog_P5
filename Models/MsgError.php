<?php
namespace BlogOC\Models;

class MsgError {
    public $msgError = array(     
        "ERROR_REQUIRED" => "Veuillez renseigner ce champ",
        "ERROR_EMAIL_INVALID" => "L'email n'est pas valide",
        "ERROR_EMAIL_NO_RECORD" => "l'email n'est pas enregistré",
        "ERROR_PASSWORD_MISMATCH" => "erreur sur mot de passe",
        "ERROR_TOO_SHORT" => 'Ce champ est trop court',
        "ERROR_PASSWORD_TOO_SHORT" => 'Le mot de passe doit faire au moins 6 caractéres',
        "ERROR_TITLE_TOO_SHORT" => 'Le titre est trop court',
        "ERROR_CHAPO_TOO_SHORT" => 'Le chapô est trop court',
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
            ),
        'placeholder' => array(
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
        // $_SESSION['PRG'] = array();

        // array_push($_SESSION['PRG'], $msgError['errors']['login']['email'] );
        // array_push($_SESSION['PRG'], $msgError['errors']['login']['password']);
        // array_push($_SESSION['PRG'], $msgError['errors']['name']['lastname'] );
        // array_push($_SESSION['PRG'], $msgError['errors']['name']['firstname'] );
        // array_push($_SESSION['PRG'], $msgError['errors']['attribut']['title'] );
        // array_push($_SESSION['PRG'], $$msgError['errors']['attribut']['chapo'] );
        // array_push($_SESSION['PRG'], $msgError['errors']['attribut']['image'] );
        // array_push($_SESSION['PRG'], $msgError['errors']['attribut']['content'] );
        // array_push($_SESSION['PRG'], $msgError['placeholder']['attribut']['title'] );
        // array_push($_SESSION['PRG'], $msgError['placeholder']['attribut']['chapo']);
        // array_push($_SESSION['PRG'], $msgError['placeholder']['attribut']['image'] );
        // array_push($_SESSION['PRG'], $msgError['placeholder']['attribut']['content'] );
        // array_push($_SESSION['PRG'], $msgError['placeholder']['login']['email'] );
        // array_push($_SESSION['PRG'], $msgError['placeholder']['name']['lastname'] );
        // array_push($_SESSION['PRG'], $msgError['placeholder']['name']['firstname'] );

       
        $msgError['errors']['login']['email'] = $_SESSION['PRG']['error']['email'] ?? '';
        $msgError['errors']['login']['password'] = $_SESSION['PRG']['error']['password'] ?? '';
        $msgError['errors']['name']['lastname'] = $_SESSION['PRG']['error']['lastname'] ?? '';
        $msgError['errors']['name']['firstname'] = $_SESSION['PRG']['error']['firstname'] ?? '';
        $msgError['errors']['attribut']['title'] = $_SESSION['PRG']['error']['title'] ?? '';
        $msgError['errors']['attribut']['chapo'] = $_SESSION['PRG']['error']['chapo'] ?? '';
        $msgError['errors']['attribut']['image'] = $_SESSION['PRG']['image'] ?? '';  
        $msgError['errors']['attribut']['content'] = $_SESSION['PRG']['error']['content'] ?? '';
        $msgError['placeholder']['attribut']['title'] = $_SESSION['PRG']['title'] ?? '';
        $msgError['placeholder']['attribut']['chapo'] = $_SESSION['PRG']['chapo'] ?? '';
        $msgError['placeholder']['attribut']['image'] = $_SESSION['PRG']['image'] ?? '';
        $msgError['placeholder']['attribut']['content'] = $_SESSION['PRG']['content'] ?? '';
        $msgError['placeholder']['login']['email'] = $_SESSION['PRG']['email'] ?? '';
        $msgError['placeholder']['name']['lastname'] = $_SESSION['PRG']['lastname'] ?? '';
        $msgError['placeholder']['name']['firstname'] = $_SESSION['PRG']['firstname'] ?? '';
        unset($_SESSION['PRG']); //on vide le PRG aprés récupération
        return $msgError;
    }
    function pushErrors($msgError, $email, $password, $lastname, $firstname ){
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $firstname = $_POST['firstname'] ?? '';
        $lastname = $_POST['lastname'] ?? '';
        if ($firstname === '') {
            $msgError['errors']['name']['firstname'] = $msgError['ERROR_REQUIRED'];  //$erors est variable dans le form
        } elseif (mb_strlen($firstname) < 2) {
            $msgError['errors']['name']['firstname'] = $msgError['ERROR_TOO_SHORT'];
           $_SESSION['PRG']['firstname'] = $firstname; 
        }
        if ($lastname === '') {
            $msgError['errors']['name']['lastname'] = $msgError['ERROR_REQUIRED'];
        } elseif (mb_strlen($lastname) < 2) {
            $msgError['errors']['name']['lastname'] = $msgError['ERROR_TOO_SHORT'];
            $_SESSION['PRG']['lastname'] = $lastname;
        }
        if ($email === '') {
            $msgError['errors']['login']['email'] = $msgError['ERROR_REQUIRED'];
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $msgError['errors']['login']['email'] = $msgError['ERROR_EMAIL_INVALID'];
            $_SESSION['PRG']['email'] = $email;
        }
        if ($password === '') {
            $msgError['errors']['login']['password'] = $msgError['ERROR_REQUIRED'];
        } elseif (mb_strlen($password) < 6) {
            $msgError['errors']['login']['password'] = $msgError['ERROR_PASSWORD_TOO_SHORT'];
            $_SESSION['PRG']['password'] = $password;
        }
        return $msgError;
    }

    function pushErrorsArticles($msgError, $content, $title, $chapo ){
        $content = $_POST['content'] ?? '';
        $title = $_POST['title'] ?? '';
        if ($title === '') {
            $msgError['errors']['attribut']['title'] = $msgError['ERROR_REQUIRED'];   
        } elseif (mb_strlen($title) < 5) {
            $msgError['errors']['attribut']['title'] = $msgError['ERROR_TITLE_TOO_SHORT'];
            } 
        if ($title === '') {
            $msgError['errors']['attribut']['chapo'] = $msgError['ERROR_REQUIRED'];   
        } elseif (mb_strlen($chapo) < 5) {
            $msgError['errors']['attribut']['chapo'] = $msgError['ERROR_CHAPO_TOO_SHORT'];
            } 
        if ($content ==='') {    
            $msgError['errors']['attribut']['content'] = $msgError['ERROR_REQUIRED'];
        } elseif (mb_strlen($content) < 20) {
            $msgError['errors']['attribut']['content'] = $msgError['ERROR_CONTENT_TOO_SHORT'];
        } 
        return $msgError;
    }
    function fillPRG($msgError){
            $_SESSION['PRG']['error']['email'] = $msgError['errors']['login']['email']; //on rempli $_SESSION avant PRG
            $_SESSION['PRG']['error']['password'] = $msgError['errors']['login']['password'];
            $_SESSION['PRG']['error']['lastname'] = $msgError['errors']['name']['lastname'];
            $_SESSION['PRG']['error']['firstname'] = $msgError['errors']['name']['firstname'];
            $_SESSION['PRG']['email'] = $_POST['email']; 
            $_SESSION['PRG']['password'] = $_POST['password'];
            $_SESSION['PRG']['lastname'] = $_POST['lastname']; 
            $_SESSION['PRG']['firstname'] = $_POST['firstname'];    
        }
    function fillPRGArticle($msgError){
        $_SESSION['PRG']['error']['title'] = $msgError['errors']['attribut']['title'];
        $_SESSION['PRG']['error']['image'] = $msgError['errors']['attribut']['image'];
        $_SESSION['PRG']['error']['chapo'] = $msgError['errors']['attribut']['chapo'];
        $_SESSION['PRG']['error']['content'] = $msgError['errors']['attribut']['content'];
        $_SESSION['PRG']['title'] = $_POST['title'];
        $_SESSION['PRG']['image'] = $_POST['image'];
        $_SESSION['PRG']['content'] = $_POST['content'];
        $_SESSION['PRG']['chapo'] = $_POST['chapo']; 
   
    }

}