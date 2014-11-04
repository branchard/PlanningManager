<?php
// il faut créer le fichier database.php avec :
//$database = array(
//    'driver' => 'mysql',
//    'host' => 'localhost',
//    'login' => 'toto',
//    'password' => 'azerty1234',
//    'database' => 'dbname',
//);
require INCLUDES_PATH.'database.php';
try {
    $connection = new PDO($database['driver'] . ':host=' . $database['host'] . ';dbname=' . $database['database'], $database['login'], $database['password'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    echo "Connection à MySQL impossible : ", $e->getMessage();
    die();
}


?>
