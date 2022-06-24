<!DOCTYPE html>
<html lang="fr">
    <?php include 'Views/head.php';?>
    <body>
        <?php include('Views/navbar.php');?>
        <?= $contentView ?>
        <?php if ($currentUser) :
        include('Views/footer.php');
        endif; ?>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
