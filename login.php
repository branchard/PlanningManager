<?php
session_start();
define('ROOT_PATH', './');
define('INCLUDES_PATH', ROOT_PATH . 'includes/');
require INCLUDES_PATH . 'connect.php';
if (isset($_POST['login']) && isset($_POST['password']) && $_POST['login'] != '' && $_POST['password'] != '') {
    // essayons d'éviter les injections sql de préférence :D
    //if (!empty($connection->query('select idU from User where LoginU = \'' . $_POST['login'] . '\' AND PasswordHashU = \'' . sha1($_POST['password']) . '\'')->fetch()[0]))// check mode de passe et login
    $prepare_statement = $connection->prepare('select idU, LoginU, NomU, PrenomU, PasswordHashU from User where LoginU = ?');
    $prepare_statement->execute(array($_POST['login']));
    $prepare_statement_result = $prepare_statement->fetch();
    if(password_verify($_POST['password'], $prepare_statement_result[4])){// méthode de verification plus sûr
        $_SESSION['id'] = $prepare_statement_result[0];
        $_SESSION['login'] = $prepare_statement_result[1];
        $_SESSION['nom'] = $prepare_statement_result[2];
        $_SESSION['prenom'] = $prepare_statement_result[3];

        header('Location: ./manager.php');
    } else {
        header('Location: ./?reason=login_bad');//redirection si mauvais mdp
    }
} else {
    header('Location: ./?reason=login_missed');// redirection si il n'a pas utilisé le formulaire
}
?>
