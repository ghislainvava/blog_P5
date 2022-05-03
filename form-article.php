<?php
session_start();
$pdo = require './Database/Database.php'; //appel du PDO
require_once './Database/security.php'; //sert à l'authentification
require_once './Database/models/ArticleDB.php'; //Crud pour article
$userDB = new AuthDB($pdo);     //initialisation utilisateur
$articleDB = new ArticleDB($pdo); //initialisation article
$currentUser = $userDB->isLoggedIn(); //authentification 
if (!$currentUser) {  //vérifaction si l'utilisateur est connecté
    header('Location: /');
    exit();
} 
const ERROR_REQUIRED = 'Veuillez renseigner ce champ';  //divers message d'erreurs
const ERROR_TITLE_TOO_SHORT = 'Le titre est trop court';
const ERROR_CONTENT_TOO_SHORT = "L'article est trop court";
const ERROR_IMAGE_URL = "L'image doit être une url valide";
$errors = [             //tableau d'erreur
    'title' => '',
    'image' => '',
    'content' => ''
];
if (isset($_SESSION['title'])){    //on rapelle les erreurs enregistré sur les cookies sessions
    $errors['title'] = $_SESSION['title'];
}
if (isset($_SESSION['image'])){
    $errors['image'] = $_SESSION['image'];
}
if (isset($_SESSION['content'])){
    $errors['content'] = $_SESSION['content'] ;
}
if (isset($_SESSION['post_title'])) {  //on rapelle les saisies 
    $title = $_SESSION['post_title'];
}
if (isset($_SESSION['post_image'])) {
    $image = $_SESSION['post_image'];
}
if (isset($_SESSION['post_content'])) {
    $content = $_SESSION['post_content'];
}
unset($_SESSION['title'], $_SESSION['image'], $_SESSION['content'],$_SESSION['post_title'], $_SESSION['post_image'], $_SESSION['post_content'] ); //On reinitialise les var $_SESSION utilisés

$_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$id = $_GET['id'] ?? '';

if ($id) {  //si id de l'article on envoye les données
    $article = $articleDB->fetchOne($id);
    if($article['author'] !== $currentUser['id']){
        header('Location: /');
        exit();
    }
    $title = $article['title'];
    $image = $article['image'];
    $content = $article['content'];
    echo $image;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $image = '';

    if(isset($_FILES['image'])){
        $tmpName = $_FILES['image']['tmp_name'];
        $name = $_FILES['image']['name'];
        $size = $_FILES['image']['size'];
        $error = $_FILES['image']['error'];
        move_uploaded_file($tmpName, './images/'.$name);
        $image = $name;
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

    // if (!$image) {
    //     $errors['image'] = ERROR_REQUIRED;
    // } elseif (!filter_var($image, FILTER_VALIDATE_URL)) {
    //     $errors['image'] = ERROR_IMAGE_URL;
    // }

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
        header('Location: /message.php');
        exit();
        
    } else {  //si erreur je crée des Session pour garder en mémoire les erreurs avant le PRG
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
            if ($title !== ''){
                $_SESSION['post_title'] = $title;
            }
            if ($image !== ''){
                $_SESSION['post_image'] = $image;
            }
            if ($content !== ''){
                $_SESSION['post_content'] = $content;
            }
            header('Location: /form-article.php');
        }
    }
?>
<head>
    <?php require_once 'includes/head.php' ?>
    <link rel="stylesheet" href="/public/css/form-article.css">
    <title><?= $id ? 'Modifier' : 'Créer' ?> un article</title>
</head>

<body>
    <div class="container">
        <?php require_once 'includes/header.php' ?>
        <div class="content">
            <div class="block p-20 form-container">
                <h1><?= $id ? 'Modifier' : 'Écrire' ?> un article</h1>
                <form action="/form-article.php<?= $id ? "?id=$id" : '' ?>"  method="POST" enctype='multipart/form-data'>
                    <div class="form-control">
                        <label for="title">Titre</label>
                        <input type="text" name="title" id="title" value="<?= $title ?? '' ?>">
                        <?php if ($errors['title']) : ?>
                            <p class="text-danger"><?= $errors['title'] ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="form-control">
                        <label for="image">Image</label>
                        <?php if($image === '') : ?>
                        <input type="file" name="image" id="image" value="<?= $image ?? '' ?>">
                        <?php else : ?>
                            <img src="images/<?=$image?>"/> 
                            <button class="btn btn-primary" type="submit">Modifier</button>
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
                        <a href="/" class="btn btn-secondary" type="button">Annuler</a>
                        <button class="btn btn-primary" type="submit"><?= $id ? 'Modifier' : 'Sauvegarder' ?></button>
                    </div>
                </form>
            </div>
        </div>
        <?php require_once 'includes/footer.php' ?>
    </div>
</body>

