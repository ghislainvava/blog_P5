<?php
namespace BlogOC\Controllers;

 use BlogOC\Database\MsgError;

class ArticlesController
{
    private $articleDB;
    public function __construct($articleDB)
    {
        $this->articleDB = $articleDB;
    }
    public function getProfil($currentUser, object $commentDB)
    {
        $articles = $this->articleDB->fetchUserArticle($currentUser['id']);
        $comments = $commentDB->fetchAllComments();
        if (isset($articles) && isset($comments)) {
            require_once 'Views/profil.php';
            return ob_get_clean();
        }
    }
    public function getAllArticle()
    {
        $articles = $this->articleDB->fetchAll();
        require_once 'Views/articles.php';
        return ob_get_clean();
    }
    public function getArticle($currentUser, $commentDB)
    {
        if ($currentUser === false) {
            $currentUser['admin'] = 0;
        }
        $server = filter_input_array(INPUT_SERVER);
        $get = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $_id = $get['id'] ?? '';
        if ($_id) {  //si id de l'article on envoye les données
            $article = $this->articleDB->fetchOne($_id);
            $comments = $commentDB->fetchComments($_id);
        }
        if ($server['REQUEST_METHOD'] === 'POST') {
            $post = filter_input_array(INPUT_POST, [
                'comment' => [
                    'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                    'flags' => FILTER_FLAG_NO_ENCODE_QUOTES
                ]
            ]);
            $comment['id_article'] = $_id;
            $comment['commentaire'] = $post['comment'];
            $comment['author'] = $currentUser['id'];
            $commentDB->createOne([
                    'id_article' => $comment['id_article'],
                    'commentaire' => $comment['commentaire'],
                    'author' => $comment['author']
            ]);
            $_SESSION['message'] = 'Votre commantaire est en attente de validation';
            header('Location: /index.php?page=message');
        }
        $contentView =  require_once 'Views/show-article.php';
        return ob_get_clean();
    }
    public function deleteArticle($currentUser)
    {
        if ($currentUser['admin'] === false) {
            $_SESSION['message'] = "Vous n'avez pas les droits pour supprimer cet article";
            header('Location: /index.php?page=erreur');
        }
        $get = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $_id = $get['id'] ?? '';
       
        if ($_id) {
            $article = $this->articleDB->fetchOne($_id);
            $this->articleDB->deleteOne($_id);
        }
        $_SESSION['message'] = 'Cet article a bien été supprimé';
        header('Location: /index.php?page=message');
    }
    public function img($msgError, $image)
    {
        $extension ='';
        $files = $_FILES['image'] ?? '';
        if ($files['name'] !== '') {
            $tmpName = $files['tmp_name'];
            $name = $files['name'];
            $size = $files['size'];
            $fileInfo = pathinfo($name);
            $extension = $fileInfo['extension'];
            $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png', 'webp'];
            if ($size > 6000000) {
                $errors['image'] = $msgError['ERROR_SIZE_IMAGE'];
            }
            if (in_array($extension, $allowedExtensions)) {
                move_uploaded_file($tmpName, './images/'.$size.$name);
                $image = $size.$name ;
            }
            if ($name !== '') {
                $errors['image'] = $msgError['ERROR_EXTENSIONS'];
            }
        }
        return $image;
    }
    public function moveArticle($currentUser)
    {
        if ($currentUser['admin'] != 1) {
            $_SESSION['message'] = "Vous n'avez pas l'autorisation d'accéder à cette page";
            header('Location: /index.php?page=erreur');
        }
        $objet= new MsgError();
        $msgError = $objet->msgError;
        $msgError = $objet->prgPush($msgError); //on rempli les erreurs du PRG et Placeholder
        $get = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $server = filter_input_array(INPUT_SERVER);
        $_id = $get['id'] ?? '';
        $title = $msgError['placeholder']['attribut']['title']; //on rempli s'il y a un placeholder enregistré
        $chapo = $msgError['placeholder']['attribut']['chapo'];
        $image = $msgError['placeholder']['attribut']['image'];
        $content = $msgError['placeholder']['attribut']['content'];
        if ($_id) {                 //si id de l'article on envoye les données
            $article = $this->articleDB->fetchOne($_id);
            if ($article->author !== $currentUser['id']) {
                if ($currentUser['admin'] < 1) {
                    header('Location: /index.php?page=home');
                }
            }
            $title = $article->title;
            $chapo = $article->chapo;
            $image = $article->image;
            $content = $article->content;
        }
        if ($server['REQUEST_METHOD'] === 'POST') {
            $post = filter_input_array(INPUT_POST, [
                'title' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                'chapo' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                'content' => [
                    'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                    'flags' => FILTER_FLAG_NO_ENCODE_QUOTES
                ]
            ]);
            if (empty($image)) {
                $image = $this->img($msgError, $image);
            }
            $title = $post['title'] ?? '';
            $chapo = $post['chapo'] ?? '';
            $content = $post['content'] ?? '';
            $msgError = $objet->pushErrorsArticles($msgError, $content, $title, $chapo);
            $error1 = $msgError['errors']['attribut'];
            if (empty(array_filter($error1, fn ($err) => $err !== ''))) {
                $this->articleDB->createOne([
                    'title' => $title,
                    'chapo' => $chapo,
                    'image' => $image,
                    'content' => $content,
                    'author' => $currentUser['id']
                ]);
                $_SESSION['message'] = "L'article a bien été créer !";
                if ($_id) {
                    $article->title = $title;
                    $article->chapo = $chapo;
                    $article->image = $image;
                    $article->content = $content;
                    $article->author = $currentUser['id'];
                    $this->articleDB->updateOne($article);
                    $_SESSION['message'] = "L'article a été modifié !";
                }
                header('Location: /index.php?page=message');
            }
            if (isset($_id)) {
                header('Location: /index.php?page=form-article&id='.$_id);
                ;
            }
            header('Location: /index.php?page=erreur');
        }//fin du post
        $contentView = require_once 'Views/form-article.php';
        return ob_get_clean();
    }
}
