 <div class="container">
    <div class="d-flex row justify-content-start">
      <h1>mon espace</h1>
      <h2>Mes informations</h2>
      <div>
        <ul>
          <li class="d-flex">
            <strong>Prénom :</strong>
            <p><?= $currentUser['firstname']?></p>
          </li>
          <li class="d-flex">
            <strong>Nom :</strong>
            <p><?= $currentUser['lastname']?></p>
          </li>
          <li class="d-flex">
            <strong>Email :</strong>
            <p><?= $currentUser['email']?></p>
          </li>
        </ul>
      </div>
      <h2>Mes arcticles</h2>
      <div>
        <ul>
          <?php foreach ($articles as $article) : ?>
          <li>
              <span><?= $article['title']?></span>
              <div>
                <a href="/index.php?page=form-article&id=<?= $article['id'] ?>" class="btn btn-primary">Modifier</a>
                <a class="btn btn-secondary" href="/index.php?page=delete-article&id=<?= $article['id'] ?>">Supprimer</a>
              </div>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
</div>

  


