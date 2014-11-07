<?php

class login extends Controller
{
    function index()
    {
        $this->loadModel('User');
        if (!isset($_POST['username']) || !isset($_POST['password']) || $_POST['username'] == '' || $_POST['password'] == '')
        {
            $_SESSION['errors'] = array(
                'login' => 'Vous n\'avez pas renseigné votre indentifiant ou votre mot de passe',
            );
            header('Location: ' . WEBROOT);
        }
        else
        {
            if ($this->User->login($_POST['username'], $_POST['password']))
            {
                $_SESSION['success'] = array(
                    'login' => 'Vous êtes connecté',
                );
                header('Location: ' . WEBROOT . 'manager');
            }
            else
            {
                $_SESSION['errors'] = array(
                    'login' => 'L\'indentifiant ou le mot de passe que vous avez renseigné sont incorects',
                );
                $_SESSION['inputs'] = array(
                    'login' => $_POST,
                );
                header('Location: ' . WEBROOT);
            }
        }
    }
} 
