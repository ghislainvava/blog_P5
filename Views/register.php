 <form class="container mt-5 " action="/index.php?page=register" method="POST">
    <div class="container mb-5">
        <input class="w-50 mb-5" type="text" name="lastname" placeholder="Veuillez saisir votre nom" value="<?= htmlspecialchars_decode($lastname) ?? '' ?>">
          <?php if ($msgError['errors']['name']['lastname']) : ?>
        <p class="text-danger"><?= htmlspecialchars_decode($msgError['errors']['name']['lastname']) ?></p>
          <?php endif; ?>
        
        <input class="w-50 mb-5" type="text" name="firstname" placeholder="Veuillez saisir votre prénom" value="<?= htmlspecialchars_decode($firstname) ?? '' ?>">
            <?php if ($msgError['errors']['name']['firstname']) : ?>
        <p class="text-danger"><?= htmlspecialchars_decode($msgError['errors']['name']['firstname']) ?></p>
            <?php endif; ?>
    

        <input class="w-50 mb-5"type="email" placeholder="Email" name="email" value="<?= htmlspecialchars_decode($email) ?? '' ?>">
            <?php if ($msgError['errors']['login']['email']) : ?>
        <p class="text-danger m-5"><?= htmlspecialchars_decode($msgError['errors']['login']['email']) ?></p>
            <?php endif; ?>
    
        <input  class="w-50 mb-5" type="text" placeholder="Mot de passe" name="password" value="<?= htmlspecialchars_decode($password) ?? '' ?>" >
        <?php if ($msgError['errors']['login']['password']) : ?>
        <p class="text-danger"><?= htmlspecialchars_decode($msgError['errors']['login']['password']) ?></p>
        <?php endif; ?>

        <button class="w-50" type="submit">Valider</button>

    </div>  
  </form>

