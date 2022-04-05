<?php
require_once 'MesExtensions.php';

require_once './database.php';
$currentUser = isLoggedIn();

$sessionId = $_COOKIE['session'] ?? '';
if ($sessionId) {
  $sessionUserStatement = $pdo->prepare('SELECT * FROM session JOIN user on user.id=session.userid WHERE session.id=?');
  $sessionUserStatement->execute([$sessionId]);
  $user = $sessionUserStatement->fetch();
}

if (!$currentUser) {
  header('Location: /login.php');
}
?>


<head>
  <?php require_once 'includes/head.php' ?>
      <title>Mon profil</title>
</head>

<body>
  <div class="container">
    <?php require_once 'includes/header.php' ?>
      <div class="content">

      </div>
    <?php require_once 'includes/footer.php' ?>
  </div>
</body>


