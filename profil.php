<?php
require 'includes/header.php';


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
      <title>Mon profil</title>
</head>

<body>
  <div class="container">
   
      <div class="content">

      </div>
    <?php require_once 'includes/footer.php' ?>
  </div>
</body>


