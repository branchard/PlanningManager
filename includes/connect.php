<?php
// Connection au serveur
try {
    $dns = 'mysql:host=localhost;dbname=planning_manager';// à changer
    $utilisateur = 'benoit';// à changer
    $motDePasse = 'azerty';// à changer
    $connection = new PDO($dns, $utilisateur, $motDePasse, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    echo "Connection à MySQL impossible : ", $e->getMessage();
    die();
}
?>
