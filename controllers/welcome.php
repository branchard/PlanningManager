<?php

class welcome extends Controller
{
    function index()
    {
        $this->loadModel('User');
        if($this->User->sessionIsSet())
        {
            header('Location: ' . WEBROOT . 'manager');
        }
        $d = array(
            'title' => 'Planning Manager',
        );
        if (isset($_SESSION['errors']))
        {
            $d['errors'] = $_SESSION['errors'];
            unset($_SESSION['errors']);
        }
        if (isset($_SESSION['inputs']))
        {
            $d['inputs'] = $_SESSION['inputs'];
            unset($_SESSION['inputs']);
        }
        if (isset($_SESSION['success']))
        {
            $d['success'] = $_SESSION['success'];
            unset($_SESSION['success']);
        }
        $this->set($d);
        $this->render('index');
    }
} 