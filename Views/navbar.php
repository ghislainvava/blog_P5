<nav class="navbar navbar-expand-lg navbar-dark py-lg-4 mt-5" id="mainNav"> <!-- Navigation-->
    <div class="container">
        <a class="navbar-brand text-uppercase fw-bold d-lg-none" href="index.html">Ghislain Vachet</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto">
                 
                <li class="nav-item px-lg-4">
                    <a class="nav-link text-uppercase" href="index.php?page=home">Home</a>
                </li>
                <li class="nav-item px-lg-4" >
                    <a class="nav-link text-uppercase" href="index.php?page=articles">Articles</a>
                </li>
                <?php if ($currentUser) : ?>
                <?php  if ($currentUser['admin'] == 1) : ?>
                    <li class="nav-item px-lg-4" >
                    <a class="nav-link text-uppercase" href="index.php?page=form-article">Ajouter un article</a>
                </li>
                <?php endif; ?>  
               
                <li class="nav-item px-lg-4" >
                    <a class="nav-link text-uppercase" href="index.php?page=logout"> Se Déconnecter</a>
                </li>  
                <?php endif ?>    
                <?php if (!$currentUser) : ?>
                <li class="nav-item px-lg-4" >
                    <a class="nav-link text-uppercase" href="index.php?page=register">Inscription</a>
                </li>
                <li class="nav-item px-lg-4" >
                    <a class="nav-link text-uppercase" href="index.php?page=login">Connection</a>
                </li>
                <?php endif; ?>     
             </ul>
        </div>
    </div>
</nav>

