 <div class="container">
    <div class="mt-5">
        <h1 class="text-center mb-5">mon espace</h1>
        <h2>Mes informations</h2>
        <div>
            <ul>
                <li class="d-flex mt-5">
                    <strong>Prénom :</strong>  &nbsp &nbsp 
                    <p><?= htmlentities($currentUser['firstname'])?></p>
                </li>
                <li class="d-flex">
                    <strong>Nom :</strong> &nbsp &nbsp 
                    <p><?=htmlentities($currentUser['lastname'])?></p>
                </li>
                <li class="d-flex">
                    <strong>Email :</strong> &nbsp &nbsp 
                    <p><?=htmlentities($currentUser['email'])?></p>
                </li>
            </ul>
         </div>
        <h2>Mes arcticles</h2>
        <div>
            <ul>
                <?php //var_dump($articles);
                foreach ($articles as $article) : ?>
                <li>
                    <span><?=utf8_decode($article['title'])?></span>
                    <div>
                        <a href="/index.php?page=form-article&id=<?=htmlentities($article['id']) ?>" class="btn btn-primary">Modifier</a>
                        <a class="btn btn-secondary" href="/index.php?page=delete-article&id=<?=$article['id']?>">Supprimer</a>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
      </div>
      <?php if ($currentUser['admin'] > 0) : ?>
      <h2 class="mt-5">Commentaires à valider</h2>  
      <div>
          <ul>
            <?php  foreach ($comments as $comment) : ?>
                <li>
                    <?php if ($comment->checked < 1) :?>
                    <p><?=utf8_decode($comment->commentaire)?></p>
                    <a href="/index.php?page=checked&id=<?=htmlentities($comment->id_comment)?>" class="btn btn-primary ">Valider</a>
                    <a class="btn btn-secondary " href="index.php?page=delete-comment&id=<?=htmlentities($comment->id_comment)?>">Supprimer</a> 
                </li>
                <?php
                endif;
                endforeach;
                endif;?>
          </ul>
      </div>
    </div>
</div>

  


