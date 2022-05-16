
  <form action="/index.php?page=login" method="POST">
   
    <br>
    <input type="email" placeholder="Email" name="email" value="<?= $email ?? '' ?>">
    <?php if ($erors['login']['email']) : ?>
      <p class="text-danger"><?= $erors['login']['email'] ?></p>
    <?php endif; ?>
    <br>
    <br>
    <input type="text" placeholder="Mot de passe" name="password" >
    <?php if ($erors['login']['password']) : ?>
      <p class="text-danger"><?= $erors['login']['password'] ?></p>
    <?php endif; ?>
    <br>
    <br>
    <button type="submit">Valider</button>
  </form>

