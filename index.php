<?php
$pdo = require_once './Database/Database.php';
require_once './Database/security.php';
$userDB = new AuthDB($pdo);
$currentUser = $userDB->isLoggedIn()
?>
    <body>
        <header>
        <?php include 'includes/header.php'; ?>
            <h1 class="site-heading text-center text-faded d-none d-lg-block">
                <span class="site-heading-upper text-primary mb-3">GHISLAIN VACHET</span>
                <span class="site-heading-lower">Mon premier Blog</span>
            </h1>
        </header>
        <section class="page-section clearfix">
            <div class="container">
                <div class="intro">
                    <img class="intro-img img-fluid mb-3 mb-lg-0 rounded" src="assets/img/intro.jpg" alt="..." />
                        <div class="intro-text left-0 text-center bg-faded pr-5 pb-5 pl-5 mt-5 rounded m-3">
                            <img class="rounded-circle moi pt-5 mb-2"  src="assets/img/profilImage.png" alt="moi" />  
                          <h2 class="section-heading mb-4">
                                <span class="section-heading-upper">ghislain vachet</span>
                                <span class="section-heading-lower">Développeur PHP/JS</span>
                            </h2>
                            <p class="m-3">Développeur pationné, aprés le JavaScript je me suis mis au PHP, j'ai une préférence pour le back-end même si le front avec Bootstrap, Vue.js, Twig ne me pose pas de probléme. Vous avez votre base de donnée avec MySQL ou MongoDB, là aussi aucun soucis !</p>
                             <div >
                                <i class="fab fa-github m-2"></i>
                                <i class="fab fa-twitter m-2"></i>
                                <i class="fab fa-linkedin m-2 "></i>
                            </div>
                            <div class="intro-button mx-auto"><a class="btn btn-primary btn-xl" href="#!">Téléchargez mon CV!</a></div> 
                        </div>   
                </div>   
            </div>
        </section>
        <section class="page-section cta">
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 mx-auto">
                        <div class="cta-inner bg-faded text-center rounded">
                            <section id="contact">
                                <div class="section-content">
                                    <h1 class="section-header">Contactez-moi!</h1>
                                </div>
                                <div class="contact-section">
                                    <div class="container">
                                        <form action="contact.php" method="POST">
                                            <div class="col-md-6 form-line">
                                                <div class="form-group">
                                                    <label for="exampleInputUsername">Votre Nom</label>
                                                    <input type="text" name="name" class="form-control mb-2" id="" placeholder=" Entrez votre nom" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail">Adresse Email</label>
                                                    <input type="email" name="email" class="form-control mb-2" id="exampleInputEmail" placeholder=" Entrez votre adresse Email" required>
                                                </div>	
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for ="description"> Message</label>
                                                    <textarea  name="message" class="form-control mb-2" id="description" placeholder="Entrez votre message" required></textarea>
                                                </div>
                                                <div>
                                                    <button type="submit" class="btn btn-default submit"><i class="fa fa-paper-plane" ></i>  Envoyez</button>
                                                </div>
                                            </div>
                                        </form>
                                        <p class="mb-0 mt-3">N'hésitez pas à me contacter, je vous répondrais le plus rapidement possible !</p>
                                    </div>   
                                </div>
                            </section> 
                        </div>
                    </div>
                </div>
        </section>
        <footer class="footer text-faded text-center py-5">
            <div class="container"><p class="m-0 small">Copyright &copy; Your Website 2021</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
