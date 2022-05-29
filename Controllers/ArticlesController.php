<?php
namespace Controllers;
//require './Models/MsgError.php';

 use Models\MsgError;

class ArticlesController
{
   private $articleDB;
   private $currentUser ; 
   public function __construct($articleDB, $currentUser){
    $this->articleDB = $articleDB;
    $this->currentUser = $currentUser;
   }


   function getProfil($articleDB, $currentUser)
   {
       ob_start();
       $articles = $articleDB->fetchUserArticle($currentUser['id']);
       $headTitle = "Mon profil";
       require_once 'profil.php';
       return ob_get_clean();
   }

   function getAllArticle($articleDB, $currentUser)
   {
        ob_start();
        $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $articles = $articleDB->fetchAll();
        $headTitle ='Articles';
        require_once 'articles.php';
        return ob_get_clean();
   }
   function getArticle($articleDB, $currentUser)
   {
       ob_start();
       $headTitle = "Show-article";
       $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $id = $_GET['id'] ?? '';
       if ($id) {  //si id de l'article on envoye les données
           $article = $articleDB->fetchOne($id);
           if($article['author'] !== $currentUser['id']){
               header('Location: /index.php?page=home');
               exit();
           }
       }
       require_once 'show-article.php';
       return ob_get_clean();
   }

    function moveArticle($articleDB, $currentUser)
    {
        ob_start();
    
        $objet= new MsgError();
        $msgError = $objet->msgError;
        $msgError = $objet->prgPush($msgError);
        $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $id = $_GET['id'] ?? '';
        if ($id) {  //si id de l'article on envoye les données
            $article = $articleDB->fetchOne($id);
            if($article['author'] !== $currentUser['id']){
                header('Location: /index.php?page=home');
                exit();
            }
            $title = $article['title'];
            $image = $article['image'];
            $content = $article['content'];  
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST = filter_input_array(INPUT_POST, [
                'title' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                'content' => [
                    'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                    'flags' => FILTER_FLAG_NO_ENCODE_QUOTES
                ]
            ]);
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
            $title = $_POST['title'] ?? '';
            $content = $_POST['content'] ?? '';
            $msgError = $objet->pushErrorsArticles( $msgError, $content, $title);
            //if (empty(array_filter($msgError['errors'], fn ($e) => $e !== ''))) {
            if($msgError['errors']['attribut']['title'] === '' and $msgError['errors']['attribut']['content'] === ''){    
                if ($id) {   
                    var_dump($msgError);
                    exit; 
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
            $objet->fillPRGArticle($msgError, $content, $image, $title);
                if (isset($_GET['id'])){
                    header('Location: /index.php?=form-article&id='.$_GET['id']);
                    return $msgError['errors'];
                    } 
                header('Location: /index.php?page=form-article');
                return $msgError['errors'];
            }
        }
        if (isset($id)){
            $headTitle ="Modifier un article";
        }else{
            $headitle ="Créer un article";
        }
        require_once 'form-article.php';
        return ob_get_clean();
    }
}
