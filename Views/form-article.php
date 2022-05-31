<!-- <head>  
    <link rel="stylesheet" href="/public/css/form-article.css">
</head> -->
    <div class="container">
    
        <div class="content">
            <div class="block p-20 form-container">
                <h1><?= $id ? 'Modifier' : 'Écrire' ?> un article</h1>
                <form action = "index.php?page=form-article<?= $id ? "?id=$id" : '' ?>"  method="POST" enctype='multipart/form-data'>
                    <div class="form-control">
                        <label for="title">Titre</label>
                        <input type="text" name="title" id="title" value="<?= $title ?? '' ?>">
                        <?php if ($msgError['errors']['attribut']['title']) : ?>['attribut']
                            <p class="text-danger"><?= $msgError['errors']['attribut']['title'] ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="form-control">
                        <label for="image">Image</label>
                        <?php if(isset($image )) : ?>
                            <img src="images/<?=$image?>"/> 
                        
                        <!-- condition image -->
                        <?php else : ?>                
                            <input type="file" name="image" id="image" value="<?=$image ?? '' ?>">
                            <?php endif; ?>   
                        <?php if ($msgError['errors']['attribut']['image']) : ?>
                            <p class="text-danger"><?= $msgError['errors']['attribut']['image'] ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="form-control">
                        <label for="content">Content</label>
                        <textarea name="content" id="content"><?= $content ?? '' ?></textarea>
                        <?php if ($msgError['errors']['attribut']['content']) : ?>
                            <p class="text-danger"><?= $msgError['errors']['attribut']['content'] ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="form-actions">
                        <a href="/index.php?page=form-article" class="btn btn-secondary" type="button">Annuler</a>
                        <button class="btn btn-primary" type="submit"><?= $id ? 'Modifier' : 'Sauvegarder' ?></button>
                    </div>
                </form>
            </div>
        </div>
       
    </div>
 


