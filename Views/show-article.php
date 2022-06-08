  <div class="container">
    <div class="content">
        <a  href="index.php?page=articles">Retour à la liste des articles</a>
        <div  style="background-image:url(<?= $article['image'] ?>)"></div>
        <h1 ><?= $article['title'] ?></h1>
        <?php if ($article['image'] !== '') :?>
                    <img  style="width: 300px;" src="images/<?= $article['image'] ?>" />
        <?php endif; ?>
        <p ><?= $article['content'] ?></p>
        <p >Post émis part : <?= $article['firstname'] . ' ' . $article['lastname'] ?></p>
        <?php if($currentUser['id'] === $article['author'] || $currentUser['admin']) : ?>
        <div class="action">
          <a class="btn btn-secondary" href="index.php?page=delete-article&id=<?= $article['id'] ?>">Supprimer</a> 
          <a class="btn btn-primary" href="index.php?page=form-article&id=<?= $article['id'] ?>">Editer l'article</a>
        </div>
        <?php endif; ?>
    </div>

    <div >
      <h2>Commentaire sur cet Article</h2>
        <?php foreach($comments as $comment) :  ?>
        
        <div class="container comment border border-dark rounded mb-5">
        <?php if($comment['checked'] > 0 || $currentUser['admin']) : ?> 
                  <p><?=$comment['commentaire']?></p> 
                  <p>Ecrit le : <?=$comment['date_commentaire']?></p>   
                  <p>par : <?=$comment['author']?></p> 
                  <p><?= $comment['checked']?></p>
                  <p><?= $comment['id_comment']?></p>

                  <?php //endif;
                  if($currentUser['id'] === $comment['author'] || $currentUser['admin']) : ?>
          <div class="action">
            <a class="btn btn-secondary" href="index.php?page=delete-comment&id=<?=$comment['id_comment']?>">Supprimer</a> 
          
          </div>
          <?php endif; ?>
          <?php endif; ?>
          <?php endforeach; ?>
        </div>
    </div>
    <form action = "index.php?page=show-article&id=<?=$id?>"   method="POST" >
                    
                    <div class="form-control">
                        <label for="comment">Ajouter un commentaire</label>
                        <textarea class='w-100' name="comment" id="comment"></textarea>   
                            <p class="text-danger"><?= $msg ?></p> 
                    </div>
                    <div class="form-actions">
                        <a href="index.php?page=form-article" class="btn btn-secondary" type="button">Annuler</a>
                        <button class="btn btn-primary" type="submit">sauvegarder</button>
                    </div>
                </form>

  </div>