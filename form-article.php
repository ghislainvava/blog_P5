<?php
// $pdo = require './Database/Database.php'; //appel du PDO
// require_once './Database/security.php'; //sert à l'authentification
require_once './Database/models/ArticleDB.php'; //Crud pour article
//$userDB = new AuthDB($pdo);     //initialisation utilisateur
$articleDB = new ArticleDB($pdo); //initialisation article
$currentUser = $userDB->isLoggedIn(); //authentification 
if (!$currentUser) {  //vérifaction si l'utilisateur est connecté
    header('Location: /index.php?page=/');
    exit();
} 
const ERROR_REQUIRED = 'Veuillez renseigner ce champ';  //divers message d'erreurs
const ERROR_TITLE_TOO_SHORT = 'Le titre est trop court';
const ERROR_CONTENT_TOO_SHORT = "L'article est trop court";
const ERROR_SIZE_IMAGE = "L'image doit faire moins de 6 MO";
const ERROR_EXTENSIONS = "Veuillez sélectionner un format de fichier valide";

    $errors = [             //tableau d'erreur
        'title' => '',
        'image' => '',
        'content' => ''
    ];
if (isset($_SESSION['title'])){    //on rapelle les erreurs enregistré sur les cookies sessions
    $errors['title'] = $_SESSION['title'];
    unset($_SESSION['title']);
}
if (isset($_SESSION['image'])){
    $errors['image'] = $_SESSION['image'];
    unset($_SESSION['image']);
}
if (isset($_SESSION['content'])){
    $errors['content'] = $_SESSION['content'] ;
    unset($_SESSION['content']);
}
if (isset($_SESSION['post_title'])) {  //on rapelle les saisies 
    $title = $_SESSION['post_title'];
    unset($_SESSION['post_title']);
}
if (isset($_SESSION['post_image'])) {
    $image = $_SESSION['post_image'];
  
}
if (isset($_SESSION['post_content'])) {
    $content = $_SESSION['post_content'];
    unset($_SESSION['post_content']);
}


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
                $errors['image'] = ERROR_EXTENSIONS;
            }
        } else{
            $errors['image'] = ERROR_SIZE_IMAGE;
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
        $errors['title'] = ERROR_REQUIRED;   
    } elseif (mb_strlen($title) < 5) {
        $errors['title'] = ERROR_TITLE_TOO_SHORT;
          } else{
        $errors['title'] ='';
    }

    if (!$content) {
        $errors['content'] = ERROR_REQUIRED;
    } elseif (mb_strlen($content) < 20) {
        $errors['content'] = ERROR_CONTENT_TOO_SHORT;
    } else{
        $errors['content'] ='';
    }
    if (empty(array_filter($errors, fn ($e) => $e !== ''))) {
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
            if (!empty($errors['title'])){
                $_SESSION['title'] = $errors['title'];
            }
            if (!empty($errors['image'])){
                $_SESSION['image'] = $errors['image'];
            }
            if (!empty($errors['content'])){
                $_SESSION['content'] = $errors['content'];
            }
            // Session pour garder les post envoyé
            
            if (isset($_GET['id'])){
                header('Location: /index.php?=form-article&id='.$_GET['id']);
                exit();
            } else {
                if ($title !== ''){
                    $_SESSION['post_title'] = $title;
                }
                if ($image !== ''){
                    $_SESSION['post_image'] = $image;
                }
                if ($content !== ''){
                    $_SESSION['post_content'] = $content;
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
ob_start();
?>
<head>  
    <link rel="stylesheet" href="/public/css/form-article.css">
</head>
    <div class="container">
    
        <div class="content">
            <div class="block p-20 form-container">
                <h1><?= $id ? 'Modifier' : 'Écrire' ?> un article</h1>
                <form action = "index.php?page=form-article<?= $id ? "?id=$id" : '' ?>"  method="POST" enctype='multipart/form-data'>
                    <div class="form-control">
                        <label for="title">Titre</label>
                        <input type="text" name="title" id="title" value="<?= $title ?? '' ?>">
                        <?php if ($errors['title']) : ?>
                            <p class="text-danger"><?= $errors['title'] ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="form-control">
                        <label for="image">Image</label>
                        <?php if(isset($image )) : ?>
                            <img src="images/<?=$image?>"/> 
                        
                        <!-- condition image -->
                        <?php else : ?>                
                            <input type="file" name="image" id="image" value="<?=$image ?? '' ?>">
                            <?php endif; ?>   
                        <?php if ($errors['image']) : ?>
                            <p class="text-danger"><?= $errors['image'] ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="form-control">
                        <label for="content">Content</label>
                        <textarea name="content" id="content"><?= $content ?? '' ?></textarea>
                        <?php if ($errors['content']) : ?>
                            <p class="text-danger"><?= $errors['content'] ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="form-actions">
                        <a href="/index.php?page=form-article" class="btn btn-secondary" type="button">Annuler</a>
                        <button class="btn btn-primary" type="submit"><?= $id ? 'Modifier' : 'Sauvegarder' ?></button>
                    </div>
                </form>
            </div>
        </div>
       
    </div>
    <?php 
        $contentView = ob_get_clean();
        require_once('template.php');


