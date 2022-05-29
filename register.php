 <form action="/index.php?page=register" method="POST">
    <div>
        <input type="text" name="lastname" placeholder="Veuillez saisir votre nom" value="<?= $lastname ?? '' ?>">
        <?php if ($msgError['errors']['name']['lastname']) : ?>
        <p class="text-danger"><?= $msgError['errors']['name']['lastname'] ?></p>
        <?php endif; ?>
        <br>
        <br>
        <input type="text" name="firstname" placeholder="Veuillez saisir votre prénom" value="<?= $firstname ?? '' ?>">
        <?php if ($msgError['errors']['name']['firstname']) : ?>
          <p class="text-danger"><?= $msgError['errors']['name']['firstname'] ?></p>
        <?php endif; ?>
    </div>
    <br>
    <br>
    <input type="email" placeholder="Email" name="email" value="<?= $email ?? '' ?>">
    <?php if ($msgError['errors']['login']['email']) : ?>
      <p class="text-danger"><?= $msgError['errors']['login']['email'] ?></p>
    <?php endif; ?>
    <br>
    <br>
    <input type="text" placeholder="Mot de passe" name="password" >
    <?php if ($msgError['errors']['login']['password']) : ?>
      <p class="text-danger"><?= $msgError['errors']['login']['password'] ?></p>
    <?php endif; ?>
    <br>
    <br>
    <button type="submit">Valider</button>
  </form>

