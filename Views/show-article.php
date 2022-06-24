<div class="container">
    <div class="container">
        <div class="mt-5" style="background-image:url(<?=htmlspecialchars($article->image)?>)"></div>
        <h1 class="mb-5"><?=htmlspecialchars_decode($article->title)?></h1>
        <?php if (htmlspecialchars_decode($article->image !== '')) :?>
            <img  style="width: 350px;" src="images/<?=htmlspecialchars_decode($article->image)?>" />
        <?php endif; ?>
        <h2 class="mt-5 mb-3"><?=htmlspecialchars_decode($article->chapo)?></h2>
        <p ><?= utf8_decode($article->content) ?></p>
        <p class="fst-italic mb-5">Post émis part : <?=htmlspecialchars_decode($article->firstname). ' ' .htmlspecialchars_decode($article->lastname)?>
            <br>Mis à jour le : <?= htmlspecialchars_decode($article->date)?>
        </p>
        <?php if ($currentUser['admin'] == 1) : ?>
           <div class="action">
                <a class="btn btn-secondary" href="index.php?page=delete-article&id=<?=htmlspecialchars($article->id)?>">Supprimer</a> 
                <a class="btn btn-primary" href="index.php?page=form-article&id=<?=htmlspecialchars($article->id)?>">Editer l'article</a>
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
                    <p class="fst-italic">Ecrit le : <?=htmlspecialchars($comment->date_commentaire)?>&nbsp &nbsp par : <?=htmlspecialchars($comment->firstname).'   '.htmlspecialchars($comment->lastname)?></p>   
                    <p class="text-center">*****</p>
                    <?php if ($currentUser['admin'] == 1) : ?>
                    <div class="action">
                        <a class="btn btn-secondary" href="index.php?page=delete-comment&id=<?=htmlspecialchars_decode($comment->id_comment)?>">Supprimer</a>   
                    </div>
            </div>
        <?php endif; endif; endforeach;?>  
    </div>
    <form class="container" action = "index.php?page=show-article&id=<?=htmlspecialchars_decode($_id)?>"   method="POST" >    
        <div class="group-form row w75">
            <label for="comment">Ajouter un commentaire</label>
            <textarea class="mt-2 mb-2" name="comment" id="comment"></textarea>   
        </div>
        <div class="form-actions">
            <button class="btn btn-primary" type="submit">sauvegarder</button>
        </div>
    </form>
  </div>

