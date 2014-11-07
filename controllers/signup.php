<?php

class signup extends Controller{

    function index()
    {
        $this->loadModel('User');
        $signupres = $this->User->signup($_POST['username'], $_POST['name'], $_POST['surname'], $_POST['password1'], $_POST['password2']);
        if($signupres === 0)
        {
            $_SESSION['success'] = array(
                'signup' => 'Inscription réussie',
            );
        }
        elseif($signupres === 1)
        {
            $_SESSION['errors'] = array(
                'signup' => 'Vous n\'avez pas renseigné tous les champs',
            );
            $_SESSION['inputs'] = array(
                'signup' => $_POST,
            );
        }
        elseif($signupres === 2)
        {
            $_SESSION['errors'] = array(
                'signup' => 'Les mots de passes ne sont pas identiques',
            );
            $_SESSION['inputs'] = array(
                'signup' => $_POST,
            );
        }
        elseif($signupres === 3)
        {
            $_SESSION['errors'] = array(
                'signup' => 'Le mot de passe doit contenir 8 caratères',
            );
            $_SESSION['inputs'] = array(
                'signup' => $_POST,
            );
        }
        elseif($signupres === 4)
        {
            $_SESSION['errors'] = array(
                'signup' => 'Cet utilisateur existe déja',
            );
            $_SESSION['inputs'] = array(
                'signup' => $_POST,
            );
        }
        header('Location: ' . WEBROOT);
    }
} 