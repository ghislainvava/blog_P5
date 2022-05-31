<div class="container"> 
    <div class="content">
        <?php foreach($articles as $article) : ?>  
        <div class="article">
            <div class="img-container" style="background-image:url("></div>
                <h2> <a href="index.php?page=show-article&id=<?= $article['id'] ?>"> <?= $article['title'] ?></a></h2>
                <?php if ($article['image'] !== '') :?>
                <img  style="width: 300px;" src="images/<?= $article['image'] ?>" />
                <?php endif; ?>
                <p><?=$article['content']?></p>     
        </div>
        <?php endforeach; ?>
    </div>
</div>


