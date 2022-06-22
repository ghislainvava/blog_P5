<?php
namespace BlogOC\Controllers;

 use BlogOC\Database\MsgError;

 use BlogOC\Database\Models\CommentDB;
  use BlogOC\Controllers\CommentController;

class ArticlesController
{
    private $articleDB;
    public function __construct($articleDB)
    {
        $this->articleDB = $articleDB;
    }
    public function getProfil($currentUser, $commentDB)
    {
        $get = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $articles = $this->articleDB->fetchUserArticle($currentUser['id']);
        $comments = $commentDB->fetchAllComments();
        if (isset($articles) and isset($comments)) {
            require_once 'Views/profil.php';
            return ob_get_clean();
        }
    }
    public function getAllArticle($currentUser)
    {
        function escape($string)
        {
            return htmlspecialchars($string, ENT_QUOTES, 'UTF_8');
        }
        $get = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $articles = $this->articleDB->fetchAll();
        require_once 'Views/articles.php';
        return ob_get_clean();
    }
    public function getArticle($currentUser, $commentDB)
    {
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
            header('Location: /index.php?page=message');
        }
        $contentView =  require_once 'Views/show-article.php';
        return ob_get_clean();
    }
    public function deleteArticle($currentUser)
    {
        if ($currentUser['admin'] == false) {
            header('Location: /index.php?page=home');
            exit();
        }
        $get = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $_id = $get['id'] ?? '';
       
        if ($_id) {
            $article = $this->articleDB->fetchOne($_id);
        
        
            $this->articleDB->deleteOne($_id);
            header('Location: /index.php?page=message');
            exit();
        }
        header('Location: /index.php?page=message');
        exit();
    }
    public function img($msgError, $image)
    {
        $extension ='';
        if ($_FILES['image']['name'] !== '') {
            $tmpName = $_FILES['image']['tmp_name'];
            $name = $_FILES['image']['name'];
            $size = $_FILES['image']['size'];
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
                    exit();
                }
            }
            $title = $article->title;
            $chapo = $article->chapo;
            $image = $article->image;
            $content = utf8_decode($article->content);
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
            $image = $this->img($msgError, $image);
            $title = $post['title'] ?? '';
            $chapo = $post['chapo'] ?? '';
            $content = $post['content'] ?? '';
            $msgError = $objet->pushErrorsArticles($msgError, $content, $title, $chapo);
            $error1 = $msgError['errors']['attribut'];
            if (empty(array_filter($error1, fn ($err) => $err !== ''))) {
                if ($_id) {
                    $article->title = $title;
                    $article->chapo = $chapo;
                    $article->image = $image;
                    $article->content = $content;
                    $article->author = $currentUser['id'];
                    $this->articleDB->updateOne($article);
                    header('Location: /index.php?page=message');
                    exit();
                }
                $this->articleDB->createOne([
                    'title' => $title,
                    'chapo' => $chapo,
                    'image' => $image,
                    'content' => $content,
                    'author' => $currentUser['id']
                ]);
                header('Location: /index.php?page=message');
                exit();
            }
            if (isset($_id)) {
                header('Location: /index.php?page=form-article&id='.$_id);
                exit;
            }
            header('Location: /index.php?page=form-article');
            exit();
        }//fin du post
        $contentView = require_once 'Views/form-article.php';
        return ob_get_clean();
    }
}
