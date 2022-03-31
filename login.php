<?php
include "header.php";
require_once 'Database.php';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $input = filter_input_array(INPUT_POST, [
    'email' => FILTER_SANITIZE_EMAIL,
  ]);
  $password = $_POST['password'] ?? '';
  $email = $input['email'] ?? '';
  if (!$password || !$email) {
    $error = 'ERROR';
  } else {
    $statementUser = $pdo->prepare('SELECT * FROM user WHERE email = ?');
    $statementUser->execute([$email]);
    $user = $statementUser->fetch();
    if (password_verify($password, $user['password'])) {
      $statementSession = $pdo->prepare('INSERT INTO session VALUES(DEFAULT, :userid)');
      $statementSession->bindValue(':userid', $user['id']);
      $statementSession->execute();
      $sessionId = $pdo->lastInsertId();
      setcookie('session', $sessionId, time() + 60 * 60 * 24 * 14, "", "", false, true);
      header('Location: /profil.php');
    } else {
      $error = 'Identifiants invalides';
    }
  }
}

?>


<body>
  <nav>
    <a href="/">Accueil</a>
    <a href="/register.php">Inscription</a>
  </nav>

  <h1>Connexion</h1>

  <form action="/login.php" method="post">
    <input type="text" name="email" placeholder="email"><br><br>
    <input type="text" name="password" placeholder="password"><br><br>
    <?php if ($error) : ?>
      <h1 style="color:red;"><?= $error ?></h1>
    <?php endif; ?>
    <button type="submit">Connexion</button>
  </form>
</body>










