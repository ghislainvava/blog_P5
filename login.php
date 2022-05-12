<body>
  <h1>Connection</h1>
  <form action="index.php?page=login" method="POST">
    <input type="email" placeholder="Email" name="email" value="<?= $email ?? '' ?>">
    <?php if ($errors['email']) : ?>
      <p class="text-danger"><?= $errors['email'] ?></p>
    <?php endif; ?>
    <br>
    <br>
    <input type="text" placeholder="Mot de passe" name="password" value="<?= $password ?? '' ?>">
    <?php if ($errors['password']) : ?>
      <p class="text-danger"><?= $errors['password'] ?></p>
    <?php endif; ?>
    <br>
    <br>
    <button type="submit">Valider</button>
  </form>
</body>
