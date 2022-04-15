<?php
session_start();


$pdo = require './Database/Database.php';
require_once './Database/security.php';
require_once './Database/models/ArticleDB.php';
$authDB = new AuthDB($pdo);

const ERROR_REQUIRED = "Veuillez renseigner ce champ";
const ERROR_TOO_SHORT = 'Ce champ est trop court';
const ERROR_PASSWORD_TOO_SHORT = 'Le mot de passe doit faire au moins 6 caractéres';
const ERROR_EMAIL_INVALID = "L'email n'est pas valide";



$errors = [
  'firstname' => '',
  'lastname' => '',
  'email' => '',
  'password' => ''
];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $input = filter_input_array(INPUT_POST, [
    'firstname' => FILTER_SANITIZE_SPECIAL_CHARS,
    'lastname' => FILTER_SANITIZE_SPECIAL_CHARS,
    'email' => FILTER_SANITIZE_EMAIL,
  ]);

  $email = $input['email'] ?? '';
  $password = $_POST['password'] ?? '';
  $firstname = $input['firstname'] ?? '';
  $lastname = $input['lastname'] ?? '';



  if (!$firstname) {
    $errors['firstname'] = ERROR_REQUIRED;
  } elseif (mb_strlen($firstname) < 2) {
    $errors['firstname'] = ERROR_TOO_SHORT;
  }
  if (!$lastname) {
    $errors['lastname'] = ERROR_REQUIRED;
  } elseif (mb_strlen($lastname) < 2) {
    $errors['lastname'] = ERROR_TOO_SHORT;
  }

  if (!$email) {
    $errors['email'] = ERROR_REQUIRED;
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = ERROR_EMAIL_INVALID;
  }

  if (!$email) {
    $errors['password'] = ERROR_REQUIRED;
  } elseif (mb_strlen($password) < 6) {
    $errors['password'] = ERROR_PASSWORD_TOO_SHORT;
  }

  if (empty(array_filter($errors, fn ($e) => $e !== ''))) {
    $authDB->register([
      'firstname' => $firstname,
      'lastname' => $lastname,
      'email' => $email,
      'password' => $password
    ]);
    header('Location: /');
    exit;
  }
}


?>


<body>
  <header><?php include 'includes/header.php';?></header>

  <h1>Inscription</h1>

  <form action="/register.php" method="POST">
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
</body>