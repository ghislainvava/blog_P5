 <div class="container">
    <div class="mt-5">
      <h1 class="text-center mb-5">mon espace</h1>
      <h2>Mes informations</h2>
      <div>
        <ul>
          <li class="d-flex mt-5">
            <strong>Prénom :</strong>  &nbsp &nbsp 
            <p><?= $currentUser['firstname']?></p>
          </li>
          <li class="d-flex">
            <strong>Nom :</strong> &nbsp &nbsp 
            <p><?= $currentUser['lastname']?></p>
          </li>
          <li class="d-flex">
            <strong>Email :</strong> &nbsp &nbsp 
            <p><?= $currentUser['email']?></p>
          </li>
        </ul>
      </div>
      <h2>Mes arcticles</h2>
      <div>
        <ul>
          <?php foreach ($articles as $article) : ?>
          <li>
              <span><?= $article['title']?></span>
              <div>
                <a href="/index.php?page=form-article&id=<?= $article['id'] ?>" class="btn btn-primary">Modifier</a>
                <a class="btn btn-secondary" href="/index.php?page=delete-article&id=<?= $article['id'] ?>">Supprimer</a>
              </div>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
      <?php if($currentUser['admin'] > 0) : ?>
      <h2 class="mt-5">Commentaires à valider</h2>  
      <div>
          <ul>
            <?php foreach ($comments as $comment) : ?>
              <li>
                <?php if($comment['checked'] < 1 and $currentUser['admin'] > 0) :?>
                <p><?=$comment['commentaire']?></p>
                <a href="/index.php?page=checked&id=<?= $comment['id_comment'] ?>" class="btn btn-primary ">Valider</a>
                <a class="btn btn-secondary " href="index.php?page=delete-comment&id=<?=$comment['id_comment']?>">Supprimer</a> 
              </li>
              <?php 
              endif;
              endforeach;
            endif;
            ?>
          </ul>
      </div>
    </div>
</div>

  


