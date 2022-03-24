<?php
include "header.php";
$pdo = require_once "Database.php";
include "db_config.php";

try {
    $pdo = new PDO('mysql:host=' .$db_infos['db']['db_host'] .';dbname=' .$db_infos['db']['db_name'], $db_infos['db']['db_username'], $db_infos['db']['db_password']);
   //$pdo = new PDO('mysql:host=localhost;dbname=blogOC;charset=UTF8', 'root', '');
   if ($pdo) { 
       echo "Vous êtes inscrit";
   }
 } catch(PDOException $e) {
     echo $e->getMessage();
 };
 

$error = '';
if($_SERVER['REQUEST_METHOD'] === "POST") {
    $_input = filter_input_array(INPUT_POST, [
        'username' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'email' => FILTER_SANITIZE_EMAIL,
    ]);
    $username = $_input['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $email = $_input['email'] ?? '';

    if (!$username ||!$password || !$email) {
        $error = 'ERROR';
    } else {
        $statement = $pdo->prepare('INSERT INTO user VALUES (
            DEFAULT,
            :email,
            :username,
            :password
        )');

        $statement->bindValue(':email', $email);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $password);

        $statement->execute();

        header('location: /login.php');
    }
}

?>

<?php
include "header.php";
?>
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
    <?php if($error) : ?>
            <h1><?= $error ?></h1>
    <?php endif; ?>
    <button>submit</button>

</form>  