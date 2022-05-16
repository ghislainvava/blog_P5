<?php
//require './Models/MsgError.php';


class ArticlesController
{
    private $articleDB;

   public function __construct($articleDB){
    $this->articleDB = $articleDB;
   }


 function moveArticle(){
    
    $objet= new MsgError();
    $msgError = $objet->msgError;

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

    $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $id = $_GET['id'] ?? '';
    if ($id) {  //si id de l'article on envoye les données
        $article = $articleDB->fetchOne($id);
        if($article['author'] !== $currentUser['id']){
            header('Location: /index.php?page=/');
            exit();
        }
        $title = $article['title'];
        $image = $article['image'];
        $content = $article['content'];
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $image = '';
        $extension ='';
        
        if($_FILES['image']['name'] !== ''){
        
            $tmpName = $_FILES['image']['tmp_name'];
            $name = $_FILES['image']['name'];
            $size = $_FILES['image']['size'];
            $error = $_FILES['image']['error'];
            $fileInfo = pathinfo($name);
            $extension = $fileInfo['extension'];
            $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png'];
            if ($size < 6000000) {
                if (in_array($extension, $allowedExtensions)){
                    move_uploaded_file($tmpName, './images/'.$size.$name );
                    $image = $size.$name ;        
                }elseif ($_name !== '' ){          
                    $errors['image'] = $msgError['ERROR_EXTENSIONS'];
                }
            } else{
                $errors['image'] = $msgError['ERROR_SIZE_IMAGE'];
            }
        
        }
        $_POST = filter_input_array(INPUT_POST, [
            'title' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'content' => [
                'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                'flags' => FILTER_FLAG_NO_ENCODE_QUOTES
            ]
        ]);
        $title = $_POST['title'] ?? '';
        $content = $_POST['content'] ?? '';
        if (!$title) {
            $msgError["errors"]['attribut']['title'] = $msgError['ERROR_REQUIRED'];   
        } elseif (mb_strlen($title) < 5) {
            $msgError["errors"]['attribut']['title'] = $msgError['ERROR_TITLE_TOO_SHORT'];
            } else{
            $msgError["errors"]['attribut']['title'] ='';
        }
        if (!$content) {
            $msgError["errors"]['attribut']['content'] = $msgError['ERROR_REQUIRED'];
        } elseif (mb_strlen($content) < 20) {
            $msgError["errors"]['attribut']['content'] = $msgError['ERROR_CONTENT_TOO_SHORT'];
        } else{
            $msgError["errors"]['attribut']['content'] ='';
        }
        if (empty(array_filter($msgError['errors'], fn ($e) => $e !== ''))) {
            if ($id) {
            $article['title'] = $title;
            $article['image'] = $image;
            $article['content'] = $content;
            $article['author'] = $currentUser['id'];
            $articleDB->updateOne($article);
            $_SESSION['message'] = "l'article a bien été modifié";
            } else {
                $articleDB->createOne([         
                    'title' => $title,
                    'image' => $image,
                    'content' => $content,
                    'author' => $currentUser['id']
                ]);
                $_SESSION['message'] = "l'article a bien été ajouté";
            }
            unset($_SESSION['post_image']);
            
            header('Location: /index.php?page=message');
            exit();    
        } else {
         //si erreur je crée des Session pour garder en mémoire les erreurs avant le PRG
            if (!empty($msgError['errors']['attribut']['title'])){
                $_SESSION['PRG']['title'] = $msgError['errors']['attribut']['title'];
            }
            if (!empty($msgError['errors']['attribut']['image'])){
                $_SESSION['PRG']['image'] = $msgError['errors']['attribut']['image'];
            }
            if (!empty($msgError['errors']['attribut']['content'])){
                $_SESSION['PRG']['content'] = $msgError['errors']['attribut']['content'];
            }
            // Session pour garder les post envoyé
            
            if (isset($_GET['id'])){
                header('Location: /index.php?=form-article&id='.$_GET['id']);
                exit();
            } else {
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
            header('Location: /index.php?page=form-article');
            exit();
        }

        }
        if (isset($id)){
            $headTitle ="Modifier un article";
        }else{
            $headitle ="Créer un article";
        }
        echo 'totor';

        ob_start();
        require_once 'form-article.php';
       
        return ob_get_clean();
 }
}