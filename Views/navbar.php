<?php
$currentUser  = $currentUser ?? false;
// if($headTitle == "Presentation"){
//     $redirection = "Views/";
// }else {
//         $redirection = "";
//     }
   
?>

<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark py-lg-4" id="mainNav">
    <div class="container">
        <a class="navbar-brand text-uppercase fw-bold d-lg-none" href="index.html">Ghislain Vachet</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto">
                <?php if ($currentUser) : ?>
                    <li class="nav-item px-lg-4" <?= $_SERVER['REQUEST_URI'] === '/.php' ? 'active' : '' ?>>
                        
                        <a class="nav-link text-uppercase" href="<?= $router->generate('home') ?>">Home</a>
                    </li>
                    <li class="nav-item px-lg-4" <?= $_SERVER['REQUEST_URI'] === '/logout.php' ? 'active' : '' ?>>
                        <a class="nav-link text-uppercase" href="/Controllers/logout.php"?>Déconnection</a>
                    </li>           
                    <li class="nav-item px-lg-4" <?= $_SERVER['REQUEST_URI'] === '/articles.php' ? 'active' : '' ?>>
                       
                        <a class="nav-link text-uppercase" href="<?= $router->generate('articles') ?>">Articles</a>
                    </li>
                    <li class="nav-item px-lg-4" <?= $_SERVER['REQUEST_URI'] === '/form-article.php' ? 'active' : '' ?>>
                        
                        <a class="nav-link text-uppercase" href="<?= $router->generate('form-article') ?>">form-article</a>
                    </li>
                    <li class="nav-item px-lg-4 " id="header-profil" <?= $_SERVER['REQUEST_URI'] === '/profil.php' ? 'active' : '' ?>>
                        <a class="nav-link text-uppercase" href=<?=$redirection."profil.php"?>><?= $currentUser['firstname'][0].$currentUser['lastname'][0]?></a>
                    </li>
                <?php else : ?>
                    <li class="nav-item px-lg-4" <?= $_SERVER['REQUEST_URI'] === '/register.php' ? 'active' : '' ?>>
                        <a class="nav-link text-uppercase" href=<?=$redirection."register.php"?>>Inscription</a>
                    </li>
                    <li class="nav-item px-lg-4" <?= $_SERVER['REQUEST_URI'] === '/login.php' ? 'active' : '' ?>>
                        <a class="nav-link text-uppercase" href=<?=$redirection."login.php"?>>Connection</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>