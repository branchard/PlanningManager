<?php

class manager extends Controller
{

    function index()
    {

        $this->loadModel('User');
        $this->loadModel('Day');
        if(!$this->User->sessionIsSet())
        {
            header('Location: ' . WEBROOT);
        }
        if(!isset($_GET['date']))// on ne teste pas si la date est valide comme ça si date('Y-m-d') retour un mauvaise valeur on aurra pas de boucle de redirection
        {
            header('Location: ' . WEBROOT.'manager?date='.date('Y-m-d'));
        }
        $d = array(
            'title' => 'Planning Manager manager',
            'name' => $this->User->getName(),
            'surname' => $this->User->getSurname(),
            'pseudo' => $this->User->getLogin(),
        );
        if(isset($_SESSION['success']))
        {
            $d['success'] = $_SESSION['success'];
            unset($_SESSION['success']);
        }
        if(isset($_POST['hour_modification']) && !empty($_POST['hour_modification']) && isset($_POST['activity_modification']) && !empty($_POST['activity_modification']) && isset($_GET['date']) && $this->Day->is_valide_date($_GET['date']))
        {
            $idH = intval($_POST['hour_modification']);
            $idA = intval($_POST['activity_modification']);
            if($this->Day->checkHour($idH) && $this->Day->checkActivity($idA))
            {
                $this->Day->changeActivity($this->User->getId(), $_GET['date'], $idH, $idA);
            }
        }
        if(isset($_GET['date']))
        {
            if($_GET['date'] == '')
            {
                $d['dateerror'] = 'Vous ne pouvez pas afficher une date vide';
            }
            else// la date doit etre en anglais(les gens qui font tout à l'envers) YYYY-MM-DD
            {
                if(!$this->Day->is_valide_date($_GET['date']))
                {
                    $d['dateerror'] = 'Vous ne pouvez pas afficher une date non valide, la date doir être au format (YYYY-MM-DD)';
                }
                else
                {// tout est OK
                    $date = new DateTime($_GET['date']);
                    $d['day'] = $this->Day->getDay($date, $this->User->getId());
                    $d['date'] = $_GET['date'];
                    $d['activities'] = $this->Day->getActivitiesList();
                }
            }
        }
        $this->set($d);
        $this->render('index');

    }

}