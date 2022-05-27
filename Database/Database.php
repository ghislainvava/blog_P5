<?php
require('db_config.php');

// try {
//  $pdo = new PDO('mysql:host=' .$db_infos['db_host'] .';dbname=' .$db_infos['db_name'], $db_infos['db_username'], $db_infos['db_password'],
//  [ PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);

// } catch(PDOException $e) {
//     throw new Exception ($e->getMessage()); //on utilise ici le try/catch avant le throw pour pas que les identifiants de connection apparaissent dans le message d'erreur
// };
// return $pdo;

class DatabaseConnection
{
    public ?PDO $pdo = null;
    
  
    public function getConnection(): PDO
    {
        if ($this->pdo === null) {
            $this->pdo = new PDO('mysql:host=127.0.0.1;dbname=blogOCp5;charset=utf8', 'root', '',
            [ PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
        }

        return $this->pdo; 
    }
}