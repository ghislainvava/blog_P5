<?php
require('db_config.php');

try {
 $pdo = new PDO('mysql:host=' .$db_infos['db']['db_host'] .';dbname=' .$db_infos['db']['db_name'], $db_infos['db']['db_username'], $db_infos['db']['db_password'],
 [ PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
      echo "le pdo fonctionne ";
} catch(PDOException $e) {
    echo $e->getMessage();
};