<?php
namespace BlogOC\Database;

class MsgError
{
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
    public function prgPush($msgError)
    {
        $msgError['errors']['login']['email'] = $_SESSION['PRG']['errors']['email'] ?? '';
        $msgError['errors']['login']['password'] = $_SESSION['PRG']['errors']['password'] ?? '';
        $msgError['errors']['name']['lastname'] = $_SESSION['PRG']['errors']['lastname'] ?? '';
        $msgError['errors']['name']['firstname'] = $_SESSION['PRG']['errors']['firstname'] ?? '';
        $msgError['errors']['attribut']['title'] = $_SESSION['PRG']['errors']['title'] ?? '';
        $msgError['errors']['attribut']['chapo'] = $_SESSION['PRG']['errors']['chapo'] ?? '';
        $msgError['errors']['attribut']['image'] = $_SESSION['PRG']['image'] ?? '';
        $msgError['errors']['attribut']['content'] = $_SESSION['PRG']['errors']['content'] ?? '';
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
    public function pushErrors($msgError, $email, $password, $lastname, $firstname)
    {
        $post = filter_input_array(INPUT_POST);
        $email = $post['email'] ?? '';
        $password = $post['password'] ?? '';
        $firstname = $post['firstname'] ?? '';
        $lastname = $post['lastname'] ?? '';
        if ($firstname === '') {
            $msgError['errors']['name']['firstname'] = $msgError['ERROR_REQUIRED'];
            $_SESSION['PRG']['errors']['firstname'] = $msgError['ERROR_REQUIRED'];  //$erors est variable dans le form
        } elseif (mb_strlen($firstname) < 2) {
            $msgError['errors']['name']['firstname'] = $msgError['ERROR_TOO_SHORT'];
            $_SESSION['PRG']['errors']['firstname'] = $msgError['ERROR_TOO_SHORT'];
        }
       
        if ($lastname === '') {
            $msgError['errors']['name']['lastname'] = $msgError['ERROR_REQUIRED'];
            $_SESSION['PRG']['errors']['lastname'] = $msgError['ERROR_REQUIRED'];
        } elseif (mb_strlen($lastname) < 2) {
            $msgError['errors']['name']['lastname'] = $msgError['ERROR_TOO_SHORT'];
            $_SESSION['PRG']['errors']['lastname'] = $msgError['ERROR_TOO_SHORT'];
        }
        if ($email === '') {
            $msgError['errors']['login']['email'] = $msgError['ERROR_REQUIRED'];
            $_SESSION['PRG']['errors']['email'] = $msgError['ERROR_REQUIRED'];
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $msgError['errors']['login']['email'] = $msgError['ERROR_EMAIL_INVALID'];
            $_SESSION['PRG']['email'] = $email;
            $_SESSION['PRG']['errors']['email'] = $msgError['errors']['login']['email']; //on rempli $_SESSION avant PRG
        }
        if ($password === '') {
            $msgError['errors']['login']['password'] = $msgError['ERROR_REQUIRED'];
            $_SESSION['PRG']['errors']['password'] = $msgError['ERROR_REQUIRED'];
        } elseif (mb_strlen($password) < 6) {
            $msgError['errors']['login']['password'] = $msgError['ERROR_PASSWORD_TOO_SHORT'];
            $_SESSION['PRG']['errors']['password'] = $msgError['ERROR_PASSWORD_TOO_SHORT'];
        }
        if (!empty(array_filter($msgError['errors']['name'], fn ($err) => $err !== ''))) {
            $_SESSION['PRG']['firstname'] = $firstname;
            $_SESSION['PRG']['lastname'] = $lastname;
        }

        return $msgError;
    }

    public function pushErrorsArticles($msgError, $content, $title, $chapo)
    {
        $post = filter_input_array(INPUT_POST);
        $content = $post['content'] ?? '';
        $title = $post['title'] ?? '';
        if ($title === '') {
            $msgError['errors']['attribut']['title'] = $msgError['ERROR_REQUIRED'];
            $_SESSION['PRG']['error']['title'] = $msgError['errors']['attribut']['title'];
        } elseif (mb_strlen($title) < 5) {
            $msgError['errors']['attribut']['title'] = $msgError['ERROR_TITLE_TOO_SHORT'];
            $_SESSION['PRG']['error']['title'] = $msgError['errors']['attribut']['title'];
        }
        if ($chapo === '') {
            $msgError['errors']['attribut']['chapo'] = $msgError['ERROR_REQUIRED'];
            $_SESSION['PRG']['error']['chapo'] = $msgError['errors']['attribut']['chapo'];
        } elseif (mb_strlen($chapo) < 5) {
            $msgError['errors']['attribut']['chapo'] = $msgError['ERROR_CHAPO_TOO_SHORT'];
            $_SESSION['PRG']['error']['chapo'] = $msgError['errors']['attribut']['chapo'];
        }
        if ($content ==='') {
            $msgError['errors']['attribut']['content'] = $msgError['ERROR_REQUIRED'];
            $_SESSION['PRG']['error']['content'] = $msgError['errors']['attribut']['content'];
        } elseif (mb_strlen($content) < 20) {
            $msgError['errors']['attribut']['content'] = $msgError['ERROR_CONTENT_TOO_SHORT'];
            $_SESSION['PRG']['error']['content'] = $msgError['errors']['attribut']['content'];
        }
        if (!empty(array_filter($msgError['errors']['attribut'], fn ($err) => $err !== ''))) {
            $_SESSION['PRG']['title'] = $title;
            $_SESSION['PRG']['chapo'] = $chapo;
            $_SESSION['PRG']['content'] = $content;
        }
        return $msgError;
    }
}
