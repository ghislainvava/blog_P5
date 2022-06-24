<footer class=" d-flex justify-content-center align-items-end py-lg-4 mt-5 footer" >
    
    <a class="container text-center " href="index.php?page=profil">
    <?php if ($currentUser['admin'] == 1) : ?>
        ADMINISTRATION</a>
    <?php else: ?>PROFIL
    <?php endif; ?>

</footer>     
