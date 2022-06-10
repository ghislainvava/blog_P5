<?php
namespace BlogOC\Controllers;

 use BlogOC\Models\MsgError;
 use BlogOC\Database\models\CommentDB;
 use BlogOC\Controllers\CommentController;

class ArticlesController
{
   private $articleDB;
   private $currentUser ; 
   private $commentDB;
   public function __construct($articleDB){
    $this->articleDB = $articleDB;
   
   }
   function getProfil( $currentUser, $commentDB)
   {
       ob_start();
       $articles = $this->articleDB->fetchUserArticle($currentUser['id']);
       $comments = $commentDB->fetchAllComments($commentDB);
       require_once 'Views/profil.php';
       return ob_get_clean();
   }
   function getAllArticle( $currentUser)
   {
        ob_start();
        $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $articles = $this->articleDB->fetchAll();
        require_once 'Views/articles.php';
        return ob_get_clean();
   }
   function getArticle($currentUser, $commentDB )
   {
       ob_start();
       $msg = '';
       $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $id = $_GET['id'] ?? '';
       if ($id) {  //si id de l'article on envoye les données
           $article = $this->articleDB->fetchOne($id);  
           $comments = $commentDB->fetchComments($id);
       } 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST = filter_input_array(INPUT_POST, [
                'comment' => [
                    'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                    'flags' => FILTER_FLAG_NO_ENCODE_QUOTES
                ]
            ]);
            $comment['id_article'] = $id; 
            $comment['commentaire'] = $_POST['comment'];
            $comment['author'] = $currentUser['id'];
            $commentDB->createOne([
                    'id_article' => $comment['id_article'],
                    'commentaire' => $comment['commentaire'],
                    'author' => $comment['author']         
            ]);
            $_SESSION['message'] = "Votre commentaire a bien été ajouté";
            header('Location: /index.php?page=message');
            exit;
        }
      $contentView =  require_once 'Views/show-article.php';
       return ob_get_clean();
    }
   
   function deleteArticle( $currentUser)
   {
    if (!$currentUser) {
        header('Location: /index.php?page=home');
        exit();
      } else{
          $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
          $id = $_GET['id'] ?? '';
          if ($id) {
            $article = $this->articleDB->fetchOne($id);
            if ($article['author'] === $currentUser['id']) {
                $this->articleDB->deleteOne($id);
              $_SESSION['message'] = "l'article a bien été supprimé";
            }
        }  
          header('Location: /index.php?page=message');
          exit();
      }
   }
    public function moveArticle($articleDB, $currentUser)
    {
        ob_start();
        $objet= new MsgError(); 
        $msgError = $objet->msgError;
        $msgError = $objet->prgPush($msgError); //on rempli les erreurs du PRG et Placeholder
        unset($_SESSION['PRG']);
        
        $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $id = $_GET['id'] ?? '';
        if ($id) {  //si id de l'article on envoye les données
            $article = $articleDB->fetchOne($id);
            if($article['author'] !== $currentUser['id'] ){
                if($currentUser['admin'] < 1){
                    header('Location: /index.php?page=home');
                    exit();
                }
            }
            $title = $article['title'];
            $chapo = $article['chapo'];
            $image = $article['image'];
            $content = $article['content'];  
        }else{
            $title = $msgError['placeholder']['attribut']['title']; //on rempli s'il y a un placeholder enregistré
            $chapo = $msgError['placeholder']['attribut']['chapo'];
            $image = $msgError['placeholder']['attribut']['image'];
            $content = $msgError['placeholder']['attribut']['content'];
        }  
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       
            $_POST = filter_input_array(INPUT_POST, [
                'title' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                'chapo' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
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
                $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png', 'webp'];
                
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
            $chapo = $_POST['chapo'] ?? '';
            $content = $_POST['content'] ?? '';

            $msgError = $objet->pushErrorsArticles( $msgError, $content, $title, $chapo);

            if($msgError['errors']['attribut']['title'] === '' and $msgError['errors']['attribut']['chapo'] === '' and $msgError['errors']['attribut']['content'] === ''){    
                if ($id) {   
                    $article['title'] = $title;
                    $article['chapo'] = $chapo;
                    $article['image'] = $image;
                    $article['content'] = $content;
                    $article['author'] = $currentUser['id'];
                    $articleDB->updateOne($article);
                    $_SESSION['message'] = "l'article a bien été modifié";
                    } else { 
                        $articleDB->createOne([         
                                'title' => $title,
                                'chapo' => $chapo,
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
                $objet->fillPRGArticle($msgError);
             
                    if (isset($id)){
                        header('Location: /index.php?page=form-article&id='.$id);
                        exit;
                        } 
                    header('Location: /index.php?page=form-article');
                }
            }
        $contentView = require_once 'Views/form-article.php';
        return ob_get_clean();
    }
}
