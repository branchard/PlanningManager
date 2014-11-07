<?php

class manager extends Controller
{

    function index()
    {

        $this->loadModel('User');
        $this->loadModel('Day');
        if (!$this->User->sessionIsSet())
        {
            header('Location: ' . WEBROOT);
        }

        $d = array(
            'title' => 'Planning Manager manager',
            'name' => $this->User->getName(),
            'surname' => $this->User->getSurname(),
            'pseudo' => $this->User->getLogin(),
        );
        if (isset($_SESSION['success']))
        {
            $d['success'] = $_SESSION['success'];
            unset($_SESSION['success']);
        }
        if (isset($_GET['date']))
        {
            if ($_GET['date'] == '')
            {
                $d['dateerror'] = 'Vous ne pouvez pas afficher une date vide';
            }
            else// la date doit etre en anglais(les gens qui font tout à l'envers) YYYY-MM-DD
            {
                if (!$this->Day->is_valide_date($_GET['date']))
                {
                    $d['dateerror'] = 'Vous ne pouvez pas afficher une date non valide';
                }
                else
                {// tout est OK
                    $date = new DateTime($_GET['date']);
                    $this->Day->getDay($date, $this->User->getId());
                }
            }
        }
        $this->set($d);
        $this->render('index');

    }

}