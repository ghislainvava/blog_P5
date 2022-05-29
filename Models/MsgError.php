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
        if (isset($_SESSION['PRG']['lastname'])){
            $msgError['errors']['name']['lastname'] = $_SESSION['PRG']['lastname'];
        }
        if (isset($_SESSION['PRG']['firstname'])){
            $msgError['errors']['name']['firstname'] = $_SESSION['PRG']['firstname'];
        }
        if (isset($_SESSION['PRG']['title'])){    //on rapelle les erreurs enregistré sur les cookies sessions
            $msgError['errors']['attribut']['title'] = $_SESSION['PRG']['title'];
        }
        if (isset($_SESSION['PRG']['image'])){
            $msgError['errors']['attribut']['image'] = $_SESSION['PRG']['image'];  
        }
        if (isset($_SESSION['PRG']['content'])){
            $msgError['errors']['attribut']['content'] = $_SESSION['PRG']['content'] ;   
        }
        if (isset($_SESSION['PRG']['post_title'])) {  //on rapelle les saisies 
            $title = $_SESSION['PRG']['post_title'];      
        }
        if (isset($_SESSION['PRG']['input_email'])) {
            $email = $_SESSION['PRG']['input_email'];
        }
        if (isset($_SESSION['PRG']['post_email'])) {
            $password = $_SESSION['PRG']['post_email'];
        }
        if (isset($_SESSION['post_image'])) {
            $image = $_SESSION['PRG']['post_image'];
        }
        if (isset($_SESSION['PRG']['post_content'])) {
            $content = $_SESSION['PRG']['post_content'];
        }
        unset($_SESSION['PRG']);
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
        }
        if ($email === '') {
            $msgError['errors']['login']['email'] = $msgError['ERROR_REQUIRED'];
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $msgError['errors']['login']['email'] = $msgError['ERROR_EMAIL_INVALID'];
        }
        if ($password === '') {
            $msgError['errors']['login']['password'] = $msgError['ERROR_REQUIRED'];
        } elseif (mb_strlen($password) < 6) {
            $msgError['errors']['login']['password'] = $msgError['ERROR_PASSWORD_TOO_SHORT'];
        }
        return $msgError;
    }
    function pushInput(){
        if (isset($_SESSION['PRG']['firstname'])) {
            $email = $_SESSION['PRG']['firstname'];
        }
        return $firstname;
    }
    function pushErrorsArticles($msgError, $content, $title ){
        $content = $_POST['content'] ?? '';
        $title = $_POST['title'] ?? '';
        if ($title === '') {
            $msgError['errors']['attribut']['title'] = $msgError['ERROR_REQUIRED'];   
        } elseif (mb_strlen($title) < 5) {
            $msgError['errors']['attribut']['title'] = $msgError['ERROR_TITLE_TOO_SHORT'];
            } 
        if ($content ==='') {    
            $msgError['errors']['attribut']['content'] = $msgError['ERROR_REQUIRED'];
        } elseif (mb_strlen($content) < 20) {
            $msgError['errors']['attribut']['content'] = $msgError['ERROR_CONTENT_TOO_SHORT'];
        } 
        return $msgError;
    }
    function fillPRG($msgError, $email, $password, $lastname, $firstname ){
            if (!empty($msgError['errors']['login']['email'])){ //on rempli $_SESSION avant PRG
                $_SESSION['PRG']['email'] = $msgError['errors']['login']['email'];
            }
            if (!empty($msgError['errors']['login']['password'])){
                $_SESSION['PRG']['password'] = $msgError['errors']['login']['password'];
            }
            if (!empty($msgError['errors']['name']['lastname'])){
                $_SESSION['PRG']['lastname'] = $msgError['errors']['name']['lastname'];
            }
            if (!empty($msgError['errors']['name']['firstname'])){
                $_SESSION['PRG']['firstname'] = $msgError['errors']['name']['firstname'];
            }
            if ($email !== ''){
                $_SESSION['PRG']['input_email'] = $email; 
            }
            if ($password !== ''){
                $_SESSION['PRG']['post_password'] = $password;
            }
        }
    function fillPRGArticle($msgError, $title, $image, $content){
        if (!empty($msgError['errors']['attribut']['title'])){
            $_SESSION['PRG']['title'] = $msgError['errors']['attribut']['title'];
        }
        if (!empty($msgError['errors']['attribut']['image'])){
            $_SESSION['PRG']['image'] = $msgError['errors']['attribut']['image'];
        }
        if (!empty($msgError['errors']['attribut']['content'])){
            $_SESSION['PRG']['content'] = $msgError['errors']['attribut']['content'];
        }
        if ($title !== ''){
            $_SESSION['PRG']['post_title'] = $title;
        }
        if ($image !== ''){
            $_SESSION['post_image'] = $image;
        }
        if ($content !== ''){
            $_SESSION['PRG']['post_content'] = $content;
        } 
    }

}