<?php
namespace BlogOC\Database;

use PDO;

class DatabaseConnection
{
    public ?PDO $pdo = null;
    
    public function getConnection(): PDO
    {
        if ($this->pdo === null) {
            $this->pdo = new PDO('mysql:host=127.0.0.1;dbname=BlogOC;charset=utf8', 'root', '',
            [ PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
        }
        return $this->pdo; 
    }
}