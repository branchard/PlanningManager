<?php
// database.php
//$database = array(
//    'driver' => 'mysql',
//    'host' => '***',
//    'login' => '***',
//    'password' => '***',
//    'database' => '***',
//);
require 'database.php';
try {
    $connection = new PDO($database['driver'] . ':host=' . $database['host'] . ';dbname=' . $database['database'], $database['login'], $database['password'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    echo "Connection à MySQL impossible : ", $e->getMessage();
    die();
}
?>
