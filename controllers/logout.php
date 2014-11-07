<?php

class logout extends Controller
{

    function index()
    {
        $this->loadModel('User');
        $this->User->logout();
        header('Location: ' . WEBROOT);
    }
} 