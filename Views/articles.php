<div class="container"> 
    <?php  function escape($string)
{
    return htmlspecialchars($string, ENT_QUOTES, 'UTF_8');
}
        ?>
    <div class="content">
        <h1 class=" sugu text-center mt-5 mb-5">Voici les posts de mon blog</h1>
        <?php foreach ($articles as $article) : ?>  
        <div class="line">
                <h2> <a href="index.php?page=show-article&id=<?= escape($article->id)?>"> <?= escape($article->title) ?></a></h2>
                <p> Date de mise à jour : <?= escape($article->date) ?> </p>
                <h3 class="mb-5"><?=escape($article->chapo)?></h3> 
                <p class="text-center" >*****</p>    
        </div>
        <?php endforeach; ?>
    </div>
</div>