<?php
session_start();
$pdo = require_once './Database/Database.php';
require_once './Database/security.php';
$userDB = new AuthDB($pdo);

const ERROR_REQUIRED = "Veuillez renseigner ce champ";
const ERROR_EMAIL_INVALID = "L'email n'est pas valide";
const ERROR_EMAIL_NO_RECORD = "l'email n'est pas enregistré";
const ERROR_PASSWORD_MISMATCH = "erreur sur mot de passe";

$errors = [
  'email' => '',
  'password' => ''
];
if (isset($_SESSION['email'])){
  $errors = $_SESSION['email'];
}
if (isset($_SESSION['password'])) {
  $errors = $_SESSION['password'];
}
if (isset($_SESSION['input_email'])) {
  $email = $_SESSION['input_email'];
}
if (isset($_SESSION['post_email'])) {
  $password = $_SESSION['post_email'];
}
unset($_SESSION['email'], $_SESSION['password'], $_SESSION['input_email'], $_SESSION['post_email'] );
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $input = filter_input_array(INPUT_POST, [
      'email' => FILTER_SANITIZE_EMAIL,
    ]);
    $email = $input['email'] ?? '';
    $password = $_POST['password'] ?? '';
    if (!$email) {
      $errors['email'] = ERROR_REQUIRED;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = ERROR_EMAIL_INVALID;
    }s
    if (!$password) {
      $errors['password'] = ERROR_REQUIRED;
    }
    if (empty(array_filter($errors, fn ($e) => $e !== ''))) {
      $user = $userDB->getUserFromEmail($email);
      if (!$user) {
        $errors['email'] = ERROR_EMAIL_NO_RECORD;
      } else {
        if (!password_verify($password, $user['password'])) {
              $errors['password'] = ERROR_PASSWORD_MISMATCH;
            } else {
              $userDB->login($user['id']);
              header('Location: /articles.php');
              exit();
            }
          }
    } else {
      if (!empty($errors['email'])){
        $_SESSION['email'] = $errors['email'];
      }
      if (!empty($errors['password'])){
          $_SESSION['password'] = $errors['password'];
      }
      if ($email !== ''){
        $_SESSION['input_email'] = $email;
      }
      if ($password !== ''){
        $_SESSION['post_password'] = $password;
      }
      header( "Location: /login.php");
      exit();
      }
}
?>
<body>
  <header>
    <?php include 'includes/header.php'; ?>
    <title>Connection</title>
  </header>
  <h1>Connection</h1>
  <form action="/login.php" method="POST">
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