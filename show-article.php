  <div class="container">
    <div class="content">
        <a  href="/index.php?page=articles">Retour à la liste des articles</a>
        <div  style="background-image:url(<?= $article['image'] ?>)"></div>
        <h1 ><?= $article['title'] ?></h1>
        <?php if ($article['image'] !== '') :?>
                    <img  style="width: 300px;" src="images/<?= $article['image'] ?>" />
        <?php endif; ?>
        <p ><?= $article['content'] ?></p>
        <p >Post émis part : <?= $article['firstname'] . ' ' . $article['lastname'] ?></p>
        <?php if($currentUser && $currentUser['id'] === $article['author']) : ?>
        <div class="action">
          <a class="btn btn-secondary" href="index.php?page=delete-article&id=<?= $article['id'] ?>">Supprimer</a> 
          <a class="btn btn-primary" href="index.php?page=form-article&id=<?= $article['id'] ?>">Editer l'article</a>
        </div>
        <?php endif; ?>
    </div>
  </div>