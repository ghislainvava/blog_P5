
  <form action="/index.php?page=register" method="POST">
    <div>
      <input type="text" name="lastname" placeholder="Veuillez saisir votre nom" value="<?= $lastname ?? '' ?>">
      <?php if ($erors['lastname']) : ?>
        <p class="text-danger"><?= $erors['lastname'] ?></p>
      <?php endif; ?>
      <br>
      <br>
      <input type="text" name="firstname" placeholder="Veuillez saisir votre prénom" value="<?= $firstname ?? '' ?>">
      <?php if ($erors['firstname']) : ?>
        <p class="text-danger"><?= $erors['firstname'] ?></p>
      <?php endif; ?>
    </div>
    <br>
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

