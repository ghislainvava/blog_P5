<?php 

require_once 'vendor/autoload.php';
require 'MesExtensions.php';

//$currentUser = isLoggedIn();


$page = 'home';

if (isset($_GET['p'])) {
    $page = $_GET['p'];
}

// if($page === 'home')  {
//     require 'cookie.php';  //solution pour afficher une page php a la place du twig avec le switch
// }

// Rendu du template
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader, [
    'cache' => false, //__DIR__, '/tmp'
]);




// if ($page === 'home') {  condition a utiliser sans le switch case 
//     echo $twig->render('layout.twig');  
// }

// $twig->addExtension(new MesExtensions());

switch ($page) {              //switch pour afficher la bonne page

    case 'contact':
    
        echo $twig->render('contact.twig');
        break;
    
    case 'home':
        echo $twig->render('home.twig');
        break;

    default:
        header('HTTP/1.0 404 Not Found');
        echo $twig->render('404.twig');
        break;
}

// require 'header.php';


