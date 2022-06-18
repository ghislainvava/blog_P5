<?php
namespace BlogOC\Database;

use PDO;
use Dotenv;

class DatabaseConnection
{
    public ?PDO $pdo = null;
    
    public function getConnection(): PDO
    {
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/..');
        $dotenv->load();
        $host = $_ENV['DATABASE_HOST'];
        $user = $_ENV['DATABASE_USER'];
        $password = $_ENV['DATABASE_PASSWORD'];
        $database = $_ENV['DATABASE'];
        if ($this->pdo === null) {
            $this->pdo = new PDO(
                'mysql:host=' .$host.';dbname='.$database.';charset=utf8',
                $user,
                $password,
                [ PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
            );
        }
        return $this->pdo;
    }
}
