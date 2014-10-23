<?php
// Connection au serveur
try {
    $dns = 'mysql:host=servinfo-db;dbname=dbbranchard';// à changer
    $utilisateur = 'branchard';// à changer
    $motDePasse = 'vis3soin';// à changer
    $connection = new PDO($dns, $utilisateur, $motDePasse, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    echo "Connection à MySQL impossible : ", $e->getMessage();
    die();
}
?>
