
  <form action="/index.php?page=register" method="POST">
    <div>
      <input type="text" name="lastname" placeholder="Veuillez saisir votre nom" value="<?= $lastname ?? '' ?>">
      <?php if ($errors['lastname']) : ?>
        <p class="text-danger"><?= $errors['lastname'] ?></p>
      <?php endif; ?>
      <br>
      <br>
      <input type="text" name="firstname" placeholder="Veuillez saisir votre prénom" value="<?= $firstname ?? '' ?>">
      <?php if ($errors['firstname']) : ?>
        <p class="text-danger"><?= $errors['firstname'] ?></p>
      <?php endif; ?>
    </div>
    <br>
    <br>
    <input type="email" placeholder="Email" name="email" value="<?= $email ?? '' ?>">
    <?php if ($errors['email']) : ?>
      <p class="text-danger"><?= $errors['email'] ?></p>
    <?php endif; ?>
    <br>
    <br>
    <input type="text" placeholder="Mot de passe" name="password">
    <?php if ($errors['password']) : ?>
      <p class="text-danger"><?= $errors['password'] ?></p>
    <?php endif; ?>
    <br>
    <br>
    <button type="submit">Valider</button>
  </form>

