<div class="container">
    <div class="container">
        <div class="mt-5" style="background-image:url(<?=htmlentities($article->image)?>)"></div>
        <h1 class="mb-5"><?=utf8_decode($article->title)?></h1>
        <?php if (htmlentities($article->image !== '')) :?>
            <img  style="width: 350px;" src="images/<?=htmlentities($article->image)?>" />
        <?php endif; ?>
        <h2 class="mt-5 mb-3"><?=utf8_decode($article->chapo)?></h2>
        <p ><?= utf8_decode($article->content) ?></p>
        <p class="fst-italic mb-5">Post émis part : <?=htmlentities($article->firstname). ' ' .htmlentities($article->lastname)?>
            <br>Mis à jour le : <?= htmlentities($article->date)?>
        </p>
        <?php if ($currentUser['admin'] == true) : ?>
           <div class="action">
                <a class="btn btn-secondary" href="index.php?page=delete-article&id=<?=htmlentities($article->id)?>">Supprimer</a> 
                <a class="btn btn-primary" href="index.php?page=form-article&id=<?=htmlentities($article->id)?>">Editer l'article</a>
            </div> 
            <?php endif;?>
    </div>
    <div class="container ">
    <h2 class="mb-5 mt-5">Commentaires sur cet Article</h2>
        <?php foreach ($comments as $comment) :  ?>
            <div class="straits"></div>
            <?php if ($comment->checked > 0) : ?> 
            <div class=" mb-5">
                    <p><?=$comment->commentaire?></p>
                    <p class="fst-italic">Ecrit le : <?=htmlentities($comment->date_commentaire)?>&nbsp &nbsp par : <?=htmlentities($comment->author)?></p>   
                    <p class="text-center">*****</p>
                    <?php if ($currentUser['admin'] == 1) : ?>
                    <div class="action">
                        <a class="btn btn-secondary" href="index.php?page=delete-comment&id=<?=htmlentities($comment->id_comment)?>">Supprimer</a>   
                    </div>
            </div>
        <?php endif; endif; endforeach;?>  
    </div>
    <form class="container" action = "index.php?page=show-article&id=<?=htmlentities($_id)?>"   method="POST" >    
        <div class="group-form row w75">
            <label for="comment">Ajouter un commentaire</label>
            <textarea class="mt-2 mb-2" name="comment" id="comment"></textarea>   
            <p class="text-danger"><?=htmlentities($msg)?></p> 
        </div>
        <div class="form-actions">
            <button class="btn btn-primary" type="submit">sauvegarder</button>
        </div>
    </form>
  </div>