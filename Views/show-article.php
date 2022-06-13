<div class="container">
    <div class="container">
      <div class="mt-5" style="background-image:url(<?= $article['image'] ?>)"></div>
      <h1 class="mb-5"><?= $article['title'] ?></h1>
      <?php if ($article['image'] !== '') :?>
        <img  style="width: 350px;" src="images/<?= $article['image'] ?>" />
      <?php endif; ?>
      <h2 class="mt-5 mb-3"><?= $article['chapo']?></h2>
      <p ><?= $article['content'] ?></p>
      <p class="fst-italic mb-5">Post émis part : <?= $article['firstname'] . ' ' . $article['lastname'] ?>
        <br>Mis à jour le : <?= $article['date']?>≈
      </p>
      <?php if($currentUser['id'] === $article['author'] || $currentUser['admin']) : ?>
        <div class="action">
          <a class="btn btn-secondary" href="index.php?page=delete-article&id=<?= $article['id'] ?>">Supprimer</a> 
          <a class="btn btn-primary" href="index.php?page=form-article&id=<?= $article['id'] ?>">Editer l'article</a>
        </div>
      <?php endif; ?>
    </div>
    <div class="container ">
    <h2 class="mb-5 mt-5">Commentaires sur cet Article</h2>
      <?php foreach($comments as $comment) :  ?>
        <div class="straits"></div>
        <?php if($comment['checked'] > 0 || $currentUser['admin']) : ?> 
          <div class=" mb-5">
              <p><?=$comment['commentaire']?></p>
              <p class="fst-italic">Ecrit le : <?=$comment['date_commentaire']?>&nbsp &nbsp par : <?=$comment['author']?></p>   
              <p class="text-center">*****</p>
              <?php if($currentUser['id'] === $comment['author'] || $currentUser['admin']) : ?>
              <div class="action">
                <a class="btn btn-secondary" href="index.php?page=delete-comment&id=<?=$comment['id_comment']?>">Supprimer</a>   
              </div>
          </div>
      <?php endif; endif; endforeach;?>  
    </div>
    <form class="container" action = "index.php?page=show-article&id=<?=$_id?>"   method="POST" >    
      <div class="group-form row w75">
        <label for="comment">Ajouter un commentaire</label>
        <textarea class="mt-2 mb-2" name="comment" id="comment"></textarea>   
        <p class="text-danger"><?= $msg?></p> 
      </div>
      <div class="form-actions">
          <button class="btn btn-primary" type="submit">sauvegarder</button>
      </div>
    </form>
  </div>