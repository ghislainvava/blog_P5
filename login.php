<?php


require './Database/Database.php';

  const ERROR_REQUIRED = "Veuillez renseigner ce champ";
  const ERROR_EMAIL_INVALID ="L'email n'est pas valide";
  const ERROR_EMAIL_NO_RECORD ="l'email n'est pas enregistré";
  const ERROR_PASSWORD_MISMATCH="erreur sur mot de passe";


  $errors = [
      'email' => '',
      'password' => ''
  ];

  
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $input = filter_input_array(INPUT_POST, [
      'email' => FILTER_SANITIZE_EMAIL,
    ]);
    $error = '';
    $email = $input['email'] ?? '';
    $password = $_POST['password'] ?? '';
 

    if(!$email){
      $errors['email'] = ERROR_REQUIRED;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
      $errors['email'] = ERROR_EMAIL_INVALID;
    }

    if(!$password){
      $errors['password'] = ERROR_REQUIRED;
    } 
    
    if(empty(array_filter($errors, fn ($e) => $e !== ''))) {
     
      $statementUser = $pdo->prepare('SELECT * FROM user  WHERE email= :email');
      $statementUser ->bindValue(':email', $email);
      $statementUser->execute();
      $user = $statementUser->fetch();

      $hashedPassword = password_hash($password, PASSWORD_ARGON2I);  //argon2i pour hasher le mot de passe

      if(!$user) {
        $errors['email'] = ERROR_EMAIL_NO_RECORD;
      } else {
          if (password_verify($hashedPassword, $user['password'])){
    
            $errors['password'] = ERROR_PASSWORD_MISMATCH;
          } else {
            $StatementSession = $pdo->prepare('INSERT INTO session VALUES(
                DEFAULT,
                :userid

              )');
              $StatementSession->bindValue(':userid', $user['id']);
              echo  $StatementSession->bindValue;
              $StatementSession->execute();
              $sessionId = $pdo->lastInsertId();
              setcookie('session', $sessionId, time() + 60 * 60 *24 *14, '', '', false , true);
              header('Location: /');
          }
      }

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
        
       
        <input type="text" placeholder="Mot de passe" name="password" >
        <?php if ($errors['password']) : ?>
            <p class="text-danger"><?= $errors['password'] ?></p>
        <?php endif; ?>
        <br>
        <br>
    
        <button type="submit">Valider</button>

    </form>
</body>













