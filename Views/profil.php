 <div class="container">
    <div class="mt-5">
        <h1 class="text-center mb-5">mon espace</h1>
        <h2>Mes informations</h2>
        <div>
            <ul>
                <li class="d-flex mt-5">
                    <strong>Prénom :</strong>  &nbsp &nbsp 
                    <p><?= htmlspecialchars($currentUser['firstname'])?></p>
                </li>
                <li class="d-flex">
                    <strong>Nom :</strong> &nbsp &nbsp 
                    <p><?=htmlentities($currentUser['lastname'])?></p>
                </li>
                <li class="d-flex">
                    <strong>Email :</strong> &nbsp &nbsp 
                    <p><?=htmlspecialchars($currentUser['email'])?></p>
                </li>
            </ul>
         </div>
        <h2>Arcticles</h2>
        <div>
            <ul>
                <?php
                foreach ($articles as $article) : ?>
                <li>
                    <span><?=utf8_decode($article['title'])?></span>
                    <div>
                        <a href="/index.php?page=form-article&id=<?=htmlspecialchars($article['id']) ?>" class="btn btn-primary">Modifier</a>
                        <a class="btn btn-secondary" href="/index.php?page=delete-article&id=<?=htmlspecialchars($article['id'])?>">Supprimer</a>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
      </div>
      <h2 class="mt-5">Commentaires en attente de validation :</h2>  
      <div>
          <ul>
                <?php  foreach ($comments as $comment) : ?>
                    <li>
                        <?php if ($comment->checked < 1) :
                        if ($currentUser['id'] == $comment->author) : ?>
                            <p><?=utf8_decode($comment->commentaire)?></p>
                            <?php endif;
                            if ($currentUser['admin'] == 1) : ?>
                        <p><?=utf8_decode($comment->commentaire)?></p>
                        <a href="/index.php?page=checked&id=<?=htmlspecialchars($comment->id_comment)?>" class="btn btn-primary ">Valider</a>
                        <a class="btn btn-secondary " href="index.php?page=delete-comment&id=<?=htmlspecialchars($comment->id_comment)?>">Supprimer</a> 
                    </li>
                        <?php endif; endif;
                endforeach;
            ?>
          </ul>
      </div>
     
    </div>
</div>

  


