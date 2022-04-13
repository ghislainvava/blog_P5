<?php
require('db_config.php');

try {
 $pdo = new PDO('mysql:host=' .$db_infos['db']['db_host'] .';dbname=' .$db_infos['db']['db_name'], $db_infos['db']['db_username'], $db_infos['db']['db_password'],
 [ PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);

} catch(PDOException $e) {
    throw new Exception ($e->getMessage()); //on utilise ici le try/catch avant le throw pour pas que les identifiants de connection apparaissent dans le message d'erreur
};
return $pdo;