 <div class="container">
    <div class="d-flex row justify-content-start">
      <h1>mon espace</h1>
      <h2>Mes informations</h2>
      <div>
        <ul>
          <li class="d-flex">
            <strong>Prénom :</strong>
            <p><?= $currentUser['firstname']?></p>
          </li>
          <li class="d-flex">
            <strong>Nom :</strong>
            <p><?= $currentUser['lastname']?></p>
          </li>
          <li class="d-flex">
            <strong>Email :</strong>
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
      <h2>Commentaires à valider</h2>
      
      <div>
          <ul>
            <?php foreach ($comments as $comment) : ?>
              <li>
                
                <?php if($comment['checked'] < 1 and $currentUser['admin'] > 0) :?>
                <p><?=$comment['commentaire']?></p>
                <p><?=$comment['checked']?></p>
                
                <a href="/index.php?page=checked&id=<?= $comment['id_comment'] ?>" class="btn btn-primary">Valider</a>
                <a class="btn btn-secondary" href="index.php?page=delete-comment&id=<?=$comment['id_comment']?>">Supprimer</a> 
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

  


