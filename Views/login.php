 <form class="container mt-5 ml-5" action="/index.php?page=login" method="POST">
    <br>
    <input type="email" placeholder="Email" name="email" value="<?= $email ?? '' ?>">
    <?php if ($msgError['errors']['login']['email']) : ?>
      <p class="text-danger"><?= $msgError['errors']['login']['email'] ?></p>
    <?php endif; ?>
    <br>
    <br>
    <input type="text" placeholder="Mot de passe" name="password">
    <?php if ($msgError['errors']['login']['password']) : ?>
      <p class="text-danger"><?= $msgError['errors']['login']['password'] ?></p>
    <?php endif; ?>
    <br>
    <br>
    <button type="submit">Valider</button>
  </form>

