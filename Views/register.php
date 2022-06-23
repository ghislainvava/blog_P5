 <form class="container mt-5 " action="/index.php?page=register" method="POST">
    <div class="container mb-5">
        <div class="row mb-5">
            <label for="title">Nom :</label>
            <input class="w-50  mt-2" type="text" name="lastname" placeholder="Veuillez saisir votre nom" value="<?= htmlspecialchars($lastname) ?? '' ?>">
            <?php if ($msgError['errors']['name']['lastname']) : ?>
            <p class="text-danger"><?= htmlspecialchars($msgError['errors']['name']['lastname']) ?></p>
            <?php endif; ?>
        </div>
       <div class="row mb-5">
            <label for="title">Prénom :</label>
            <input class="w-50  mt-2" type="text" name="firstname" placeholder="Veuillez saisir votre prénom" value="<?= htmlspecialchars($firstname) ?? '' ?>">
            <?php if ($msgError['errors']['name']['firstname']) : ?>
            <p class="text-danger "><?= htmlspecialchars($msgError['errors']['name']['firstname']) ?></p>
            <?php endif; ?>
       </div>
            <div class="row mb-5">
            <label for="title">Email :</label>
            <input class="w-50 mt-2"type="email" placeholder="Email" name="email" value="<?= htmlspecialchars($email) ?? '' ?>">
            <?php if ($msgError['errors']['login']['email']) : ?>
            <p class="text-danger"><?= htmlentities($msgError['errors']['login']['email']) ?></p>
            <?php endif; ?>
         </div>
        <div class="row mb-5">
            <label for="title">mot de passe :</label>
            <input  class="w-50  mt-2" type="text" placeholder="Mot de passe" name="password" value="<?= htmlspecialchars($password) ?? '' ?>" >
            <?php if ($msgError['errors']['login']['password']) : ?>
            <p class="text-danger"><?= htmlspecialchars($msgError['errors']['login']['password']) ?></p>
            <?php endif; ?>
        </div>
        <div class="ml-5">
            <button class="w-25 " type="submit">Valider</button>
        </div>
        

    </div>  
  </form>

