

<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark py-lg-4" id="mainNav">
    <div class="container">
        <a class="navbar-brand text-uppercase fw-bold d-lg-none" href="index.html">Start Bootstrap</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item px-lg-4" <?= $_SERVER['REQUEST_URI'] === '/.php' ? 'active' : '' ?>>
                    <a class="nav-link text-uppercase" href="/">Home</a>
                </li>
                <li class="nav-item px-lg-4" <?= $_SERVER['REQUEST_URI'] === '/register.php' ? 'active' : '' ?>>
                    <a class="nav-link text-uppercase" href="register.php">Inscription</a>
                </li>
                <li class="nav-item px-lg-4" <?= $_SERVER['REQUEST_URI'] === '/login.php' ? 'active' : '' ?>>
                    <a class="nav-link text-uppercase" href="login.php">Connection</a>
                </li>
                <li class="nav-item px-lg-4" <?= $_SERVER['REQUEST_URI'] === '/logout.php' ? 'active' : '' ?>>
                    <a class="nav-link text-uppercase" href="logout.php">Déconnection</a>
                </li>
                <li class="nav-item px-lg-4" <?= $_SERVER['REQUEST_URI'] === '/profile.php' ? 'active' : '' ?>>
                    <a class="nav-link text-uppercase" href="profil.php">Ma page</a>
                </li>
                <li class="nav-item px-lg-4" <?= $_SERVER['REQUEST_URI'] === '/form-article.php' ? 'active' : '' ?>>
                    <a class="nav-link text-uppercase" href="form-article.php">Mes articles</a>
                </li>
            </ul>
        </div>
    </div>
</nav>