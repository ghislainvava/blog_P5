<div class="container"> 
    <div class="content">
        <h1 class="text-center mt-5 mb-5">Voici les posts de mon blog</h1>
        <?php foreach($articles as $article) : ?>  
        <div class="article">
            <div class="img-container" style="background-image:url("></div>
                <h2> <a href="index.php?page=show-article&id=<?= $article['id'] ?>"> <?= $article['title'] ?></a></h2>
                <p> Date dernière modification : <?= $article['date'] ?> </p>
                <h3 class="mb-5"><strong><?=substr($article['content'], 0,45).'...'?></strong></h3>     
        </div>
        <?php endforeach; ?>
    </div>
</div>


