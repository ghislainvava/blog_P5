<?php
include "header.php";
require_once "Database.php";
include "db_config.php";


  
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = filter_input_array(INPUT_POST, [
      'username' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
      'email' => FILTER_SANITIZE_EMAIL,
    ]);
    $error = '';
    $username = $input['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $email = $input['email'] ?? '';
    if (!$username || !$password || !$email) {
      $error = 'ERROR';
    } else {
        $hashedPassword = password_hash($password, PASSWORD_ARGON2I);  //argon2i pour hasher le mot de passe
        $statement = $pdo->prepare('INSERT INTO user VALUES (
        DEFAULT,
        :email,
        :username,
        :password
      )');
      $statement->bindValue(':email', $email);
      $statement->bindValue(':username', $username);
      $statement->bindValue(':password', $hashedPassword);
      $statement->execute();
  
      header('Location: /login.php');
    }
  }

?>

<?php
include "header.php";
?>
<body>
    <nav class="navbar ">
    <a href="/">Home</a>
    <a href="/login.php">Login</a>
    <a href="/logout.php">Logout</a>
    <a href="/profil.php">profil</a>
    <a href="/register.php">inscription</a>

    </nav>

    <h1>Inscription</h1>

    <form action="/register.php" method="POST">
        <input type="text" placeholder="Email" name="email">
        <br>
        <br>
        
        <input type="text" placeholder="Nom d'utilisateur" name="username">
        <br>
        <br>
        <input type="text" placeholder="Mot de passe" name="password">
        <br>
        <br>
    
        <button type="submit">Valider</button>

    </form>
</body>






















