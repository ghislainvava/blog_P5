<?php

class AuthDB 
{
        
        private PDOStatement $statementRegister;
        private PDOStatement $statementReadSession;
        private PDOStatement $statementReadUser;
        private PDOStatement $statementReadUserFromEmail;
        private PDOStatement $statementCreateSession;
        private PDOStatement $statementDeleteSession;

        function __construct(private PDO $pdo)
        {
            
            $this->statementRegister = $pdo->prepare('INSERT INTO user VALUES (
                DEFAULT,
                :email,
                :password,
                :firstname,
                :lastname
                
              )');

              $this->statementReadSession = $pdo->prepare('SELECT * FROM session WHERE id=:id');
              $this->statementReadUser = $pdo->prepare('SELECT * FROM user WHERE id=:id');
              $this->statementReadUserFromEmail = $pdo->prepare('SELECT * FROM user WHERE email=:email');
              $this->statementCreateSession = $pdo->prepare('INSERT INTO session VALUES (
                -- :sessionid,
                DEFAULT,
                :userid
                )');
             $this->statementDeleteSession = $pdo->prepare('DELETE FROM session WHERE id=:id');
        }

        function login(string $userId): void
        {   
           
            $this->statementCreateSession->bindValue(':userid', $userId);
            $this->statementCreateSession->execute();
            $sessionId = $this->pdo->lastInsertId();
            setcookie('session', $sessionId, time() + 60 *60 *24 * 14 ,'','',false, true);
           


            // $sessionId = bin2hex(random_bytes(32));
            // $this->statementCreateSession->bindValue(':userid', $userId);
            // $this->statementCreateSession->bindValue(':sessionid', $sessionId);
            // $this->statementCreateSession->execute();
            // $signature = hash_hmac('sha256', $sessionId, 'il etait une fois');
            // setcookie('session', $sessionId, time() + 60 * 60 * 24 * 14, '', '', false, true);
            // setcookie('signature', $signature, time() + 60 * 60 * 24 * 14, "", "", false, true);
            return;
        }
        function register(array $user): void
        {

              $hashedPassword = password_hash($user['password'], PASSWORD_ARGON2I);  //argon2i pour hasher le mot de passe
              $this->statementRegister->bindValue(':email', $user['email']);
              $this->statementRegister->bindValue(':password', $hashedPassword);
              $this->statementRegister->bindValue(':firstname', $user['firstname']);
              $this->statementRegister->bindValue(':lastname', $user['lastname']);
              
              $this->statementRegister->execute();
              return;

        }
        function isLoggedIn(): array | false
        {
            $sessionId = $_COOKIE['session'] ?? '';
                if($sessionId) {
                    $this->statementReadSession->bindValue(':id', $sessionId);
                    $this->statementReadSession->execute();
                    $session =  $this->statementReadSession->fetch();
                    if($session) {
                        $this->statementReadUser->bindValue(':id', $session['userid']);
                        $this->statementReadUser->execute();
                        $user = $this->statementReadUser->fetch();
                    }
                }


                // $sessionId = $_COOKIE['session'] ?? '';
                // $signature = $_COOKIE['signature'] ?? '';
                // echo $sessionId;
                // echo '----';
                // echo $signature;
                // if ($sessionId  && $signature) {
                //     $hash = hash_hmac('sha256', $sessionId, 'il etait une fois');
                //     echo '---';
                //     echo $hash;
                //     if (hash_equals($hash, $signature)) {
                //         $this->statementReadSession->bindValue(':id', $sessionId);
                //         $this->statementReadSession->execute();
                //         $session =  $this->statementReadSession->fetch();
                //         echo 'je suis connecté2';
                //         if ($session) {
                //             $this->statementReadUser->bindValue(':id', $session['userid']);
                //             $this->statementReadUser->execute();
                //             $user = $this->statementReadUser->fetch();
                            
                //         }
                //     }
                // }
              
                return $user ?? false;
              
        }
        function logout(string $sessionId): void
        {
            $this->statementDeleteSession->bindValue(':id', $sessionId);
            $this->statementDeleteSession->execute();
            setcookie('session','', time() -1);
            //setcookie('signature','', time() -1);

            return;
            
        }

        function getUserFromEmail(string $email): array | false {
            $this->statementReadUserFromEmail->bindValue(':email', $email);
            $this->statementReadUserFromEmail->execute();
            return $this->statementReadUserFromEmail->fetch();

        }

    }

