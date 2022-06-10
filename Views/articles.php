<div class="container"> 
    <div class="content">
        <h1 class=" sugu text-center mt-5 mb-5">Voici les posts de mon blog</h1>
        <?php foreach($articles as $article) : ?>  
        <div class="line">
            <div class="img-container" style="background-image:url("></div>
                <h2> <a href="index.php?page=show-article&id=<?= $article['id'] ?>"> <?= $article['title'] ?></a></h2>
                <p> Date de mise à jour : <?= $article['date'] ?> </p>
                <h3 class="mb-5"><?=$article['chapo']?></h3> 
                <p class="text-center" >*****</p>    
        </div>
        <?php endforeach; ?>
    </div>
</div>


