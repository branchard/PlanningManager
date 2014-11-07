<?php

class User extends Model
{
    protected $_table = 'User';
    protected $_idname = 'IdU';

    function signup($login, $name, $surname, $password1, $password2)
    {
        if (isset($login) && isset($name) && isset($surname) && isset($password1) && isset($password2) && $login != '' && $name != '' && $surname != '' && $password1 != '' && $password2 != '')
        {
            if ($password1 === $password2)
            {
                if (strlen($password2) >= 8)
                {
                    if(count($this->find(array('conditions' => 'LoginU = \''.$login.'\''))) == 0)// vérifie si l'user n'est pas déja présent
                    {//tout est OK
                        $pass=password_hash($password1, PASSWORD_DEFAULT);
                        $this->save(array('LoginU' => $login, 'NomU' => $surname, 'PrenomU' => $name, 'PasswordHashU' => $pass));
                        return 0;//pas d'erreur
                    }
                    else
                    {
                        return 4;//login existe déja
                    }
                }
                else
                {
                    return 3;//mot de passe trop court
                }
            }
            else
            {
                return 2;// les passwd ne sont pas identiques
            }
        }
        else
        {
            return 1;// erreur lors de l'inscription, vous navez pas rempli tous les champs
        }
    }

    function login($login, $password)
    {
        $data = $this->find(array(
            'fields' => 'IdU, LoginU, NomU, PrenomU, PasswordHashU',
            'conditions' => 'LoginU = \'' . $login . '\'',
            'limit' => 1,
        ));

        if (password_verify($password, $data[0]['PasswordHashU']))
        {// méthode de verification plus sûr
            $_SESSION['id'] = $data[0]['IdU'];
            $_SESSION['login'] = $data[0]['LoginU'];
            $_SESSION['surname'] = $data[0]['NomU'];
            $_SESSION['name'] = $data[0]['PrenomU'];

            $res = true;

        }
        else
        {
            $res = false;

        }

        return $res;
    }

    function sessionIsSet()
    {
        return (isset($_SESSION['id']) && isset($_SESSION['login']) && isset($_SESSION['surname']) && isset($_SESSION['name']));
    }

    function getId()
    {
        if ($this->sessionIsSet())
        {
            return $_SESSION['id'];
        }
        else
        {
            return '';
        }
    }

    function getLogin()
    {
        if ($this->sessionIsSet())
        {
            return $_SESSION['login'];
        }
        else
        {
            return '';
        }
    }

    function getName()
    {
        if ($this->sessionIsSet())
        {
            return $_SESSION['name'];
        }
        else
        {
            return '';
        }
    }

    function getSurname()
    {
        if ($this->sessionIsSet())
        {
            return $_SESSION['surname'];
        }
        else
        {
            return '';
        }
    }

    function logout()
    {
        session_destroy();
    }
} 