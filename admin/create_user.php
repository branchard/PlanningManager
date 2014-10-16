<?php
define('ROOT_PATH', '../');
define('INCLUDES_PATH', ROOT_PATH . 'includes/');// on peut faire comme ça aussi
require INCLUDES_PATH . 'connect.php';
if (isset($_POST['login']) && isset($_POST['password'])) {
    if (empty($connection->query('select LoginU from User where LoginU = \'' . $_POST['login'] . '\'')->fetch()[0])) { // pour éviter les doublon, il faut aussi une contrainte dans la bdd
        $nom_array = array(
            'Dupond',
            'Durand',
            'Mendez',
            'Tsonga',
            'Barthez',
            'Lloris',
            'Benzema',
            'Ribery',
            'Ronaldo',
            'Croft'
        );
        $prenom_array = array(
            'Franck',
            'Gerard',
            'Sylvie',
            'Joe',
            'Lara',
            'Margane',
            'Brice',
            'Willie',
            'Karim',
            'Simone'
        );
        $prepare_statement = $connection->prepare('INSERT INTO User (NomU, PrenomU, LoginU, PasswordHashU) VALUES (:NOM, :PRENOM, :LOGIN, :PWD)');
        $nom = $nom_array[array_rand($nom_array, 1)]; // choisi un nom au hazard dans la liste
        $prepare_statement->bindParam('NOM', $nom);
        $prenom = $prenom_array[array_rand($prenom_array, 1)];
        $prepare_statement->bindParam('PRENOM', $prenom);
        $prepare_statement->bindParam('LOGIN', $_POST['login']);
        $prepare_statement->bindParam('PWD', $_POST['password']);
        $prepare_statement->execute();

        $prepare_statement = null;
        $connection = null;

        echo 'Ajouté : ' . $prenom . ' ' . $nom . ' login : ' . $_POST['login'] . ' password : ' . $_POST['password'];
    }
    else{
        echo $_POST['login'].' existe déja dans la base de donnée';
    }
} else {
    header('Location: ./create_user_form.php');// redirection si il n'a pas utilisé les formulaire
}
?>
