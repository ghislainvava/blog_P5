<?php 

require_once 'vendor/autoload.php';


$page = 'home';

if (isset($_GET['p'])) {
    $page = $_GET['p'];
}

// Rendu du template
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader, [
    'cache' => __DIR__, '/tmp'
]);


if ($page === 'home') {
    echo $twig->render('home.twig');
}


// require 'header.php';