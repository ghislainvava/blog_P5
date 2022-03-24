<?php
require('db_config.php');

try {
   //$pdo = new PDO('mysql:host=' .$db_infos['db']['db_host'] .';dbname=' .$db_infos['db']['db_name'], $db_infos['db']['db_username'], $db_infos['db']['db_password']);
  $pdo = new PDO('mysql:host=localhost;dbname=blogOCp5;', 'root', 'rootpwd');
} catch(PDOException $e) {
    echo $e->getMessage();
};



// class Database{
//     protected function dbConnect() {
//         require('db_config.php');

//  $db = new PDO('mysql:host=' .$db_infos['db']['db_host'] .';dbname=' .$db_infos['db']['db_name'], $db_infos['db']['db_username'], $db_infos['db']['db_password']);
// 		return $db;


//     }

// }
// $pdo = new PDO('mysql:host=localhost;dbname=blogOC', 'root', "");