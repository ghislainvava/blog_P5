<?php
namespace BlogOC\Database;

 use PDOStatement;
 use PDO;

class AuthDB
{
    private PDOStatement $statementRegister;
    private PDOStatement $statementReadSession;
    private PDOStatement $statementReadUser;
    private PDOStatement $statementFromEmail;
    private PDOStatement $statementCreate;
    private PDOStatement $statementDelete;

    public function __construct(private PDO $pdo)
    {
        $this->statementRegister = $pdo->prepare('INSERT INTO user VALUES (
                DEFAULT,
                :email,
                :password,
                :firstname,
                :lastname,
                DEFAULT

              )');
        $this->statementReadSession = $pdo->prepare('SELECT id, userid FROM session WHERE id=:id');
        $this->statementReadUser = $pdo->prepare('SELECT id,email,password,firstname,lastname,admin FROM user WHERE id=:id');
        $this->statementFromEmail = $pdo->prepare('SELECT id,email,password,firstname,lastname,admin FROM user WHERE email=:email');
        $this->statementCreate = $pdo->prepare('INSERT INTO session VALUES (
                DEFAULT,
                :userid
                )');
        $this->statementDelete = $pdo->prepare('DELETE FROM session WHERE id=:id');
    }
    public function login(string $userId): void
    {
        $this->statementCreate->bindValue(':userid', $userId);
        $this->statementCreate->execute();
        $sessionId = $this->pdo->lastInsertId();
        setcookie('session', $sessionId, time() + 60 *60 *24 * 14, '', '', false, true);
        return;
    }
    public function register(array $user): void
    {
        $hashedPassword = password_hash($user['password'], PASSWORD_ARGON2I);  //argon2i pour hasher le mot de passe
        $this->statementRegister->bindValue(':email', $user['email']);
        $this->statementRegister->bindValue(':password', $hashedPassword);
        $this->statementRegister->bindValue(':firstname', $user['firstname']);
        $this->statementRegister->bindValue(':lastname', $user['lastname']);
        $this->statementRegister->execute();
        return;
    }
    public function isLoggedIn(): array | false
    {
        $cookie = filter_input_array(INPUT_COOKIE);
        $sessionId = $cookie['session'] ?? '';
        if ($sessionId) {
            $this->statementReadSession->bindValue(':id', $sessionId);
            $this->statementReadSession->execute();
            $session =  $this->statementReadSession->fetch();
            if ($session) {
                $this->statementReadUser->bindValue(':id', $session['userid']);
                $this->statementReadUser->execute();
                $user = $this->statementReadUser->fetch(); //changer le type
            }
        }
        return $user ?? false;
    }
    public function logout(string $sessionId): void
    {
        $this->statementDelete->bindValue(':id', $sessionId);
        $this->statementDelete->execute();
        setcookie('session', '', time() -1);
        return;
    }
    public function getUserFromEmail(string $email): array | false
    {
        $this->statementFromEmail->bindValue(':email', $email);
        $this->statementFromEmail->execute();
        return $this->statementFromEmail->fetch();
    }
}
