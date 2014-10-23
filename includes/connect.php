<?php
// Connection au serveur
try {
    $dns = 'mysql:host=servinfo-db;dbname=dbtoto';// à changer
    $utilisateur = 'toto';// à changer
    $motDePasse = '';// à changer
    $connection = new PDO($dns, $utilisateur, $motDePasse, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    echo "Connection à MySQL impossible : ", $e->getMessage();
    die();
}
?>
