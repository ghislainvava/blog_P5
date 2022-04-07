<?php
require './Database/security.php';

$currentUser = isLoggedIn();


const ERROR_REQUIRED = "Veuillez renseigner ce champs";
const ERROR_TITLE_TOO_SHORT = "Le titre est trop court";
const ERROR_CONTENT_TOO_SHORT = "l'article est trop court";
const ERROR_IMAGE_URL = "l'image n'est pas une URL valide";
$errors = [
    'title' => "",
    'image' => "",
    'content' => [
        'filter' => FILTER_SANITIZE_URL,
        'flags' => FILTER_FLAG_NO_ENCODE_QUOTES
    ]
];

$title = $_POST['title'] ?? '';
$image = $_POST['image'] ?? '';
$content = $_POST['content'] ?? '';

if (!$title) {
    $errors['title'] = ERROR_REQUIRED;
} elseif (mb_strlen($title) < 5) {
    $errors['title'] = ERROR_TITLE_TOO_SHORT;
}
if (!$image) {
    $errors['image'] = ERROR_REQUIRED;
} elseif (!filter_var($image, FILTER_VALIDATE_URL)) {
    $errors['image'] = ERROR_IMAGE_URL;
}
if (!$content) {
    $errors['content'] = ERROR_REQUIRED;
} elseif (mb_strlen($title) < 20) {
    $errors['content'] = ERROR_TITLE_TOO_SHORT;
}

if (empty(array_filter($errors, fn ($e) => $e !== ''))) {
    echo "c'est ok";
    'Location: /articles.php';
} else {
    print_r($errors);
}

?>

<head>
    <?php require __DIR__ . '/includes/header.php'; ?>
    <title>Création d'article</title>
    <link rel="stylesheet" href="css/add_article.css">
</head>

<body class="container w-100">
    <h1 class="d-flex center">Écrire un article</h1>
    <div class="  bg-brown mt-5 ml-5  d-flex justify-content-end">
        <button type="button" class="btn btn-dark m-3">ajouter un article</button>
    </div>
    <div class="">
        <form action="/add-article.php" method="POST">
            <div class="form-control">
                <label for="title">Titre</label>
                <input type="text" name="title" id="title">
            </div>
            <div class="form-control">
                <label for="image">image</label>
                <input type="text" name="image" id="image" placeholder="ajouter un lien">

            </div>

            <div class="form-control">
                <label for="content">Texte</label>
                <textarea type="text" name="content" id="content"></textarea>
            </div>
            <div class="form-action">
                <a href="/articles.php" class="btn btn-secondary" type="button">Annuler</a>
                <button class="btn btn-primary" type="submit">Sauvegarder</button>
            </div>

        </form>
    </div>
</body>