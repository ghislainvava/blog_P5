<div class="container ">
    <div class="content">
        <div class="block p-20 form-container mt-5">
            <h1><?= $id ? 'Modifier' : 'Écrire' ?> un article</h1>
            <form action = "index.php?page=form-article<?= $id ? "&id=$id" : '' ?>"  method="POST" enctype='multipart/form-data'>
                <div class="container group-form row w-75 mt-3 ">
                    <label for="title">Titre :</label>
                    <input type="text" name="title" id="title" value="<?= $title ?? '' ?>">
                    <p class="text-danger"><?= $msgError['errors']['attribut']['title'] ?></p>
                </div>
                <div class="container group-form row w-75 ml-2">
                    <label for="chapo">Chapô : </label>
                    <input type="text" name="chapo" id="chapo" value="<?= $chapo ?? '' ?>">
                    <p class="text-danger"><?= $msgError['errors']['attribut']['chapo'] ?></p>
                </div>
                <div class="container group-form row w-75 ml-2">
                    <label for="image">Image :</label>
                    <?php if(!empty($image)) : ?>
                        <img src="images/<?=$image?>" alt="image choisi"/> 
                    <!-- condition image -->
                    <?php else : ?>                
                        <input type="file" name="image" id="image" value="<?=$image ?? '' ?>">
                        <?php endif; ?>   
                        <p class="text-danger"><?= $msgError['errors']['attribut']['image'] ?></p>
                </div>
                <div class="container group-form row w-75 ml-2">
                    <label for="content">Contenu :</label>
                    <textarea name="content" id="content"><?= $content ?? '' ?></textarea>
                        <p class="text-danger"><?= $msgError['errors']['attribut']['content'] ?></p>
                </div>
                <div class="container form-actions">
                    <a href="index.php?page=form-article" class="btn btn-secondary" type="button">Annuler</a>
                    <button class="btn btn-primary" type="submit"><?= $id ? 'Modifier' : 'Sauvegarder' ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
 


