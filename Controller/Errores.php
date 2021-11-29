<?php


class Errores extends Controller
{

    function __construct()
    {
        parent::__construct();
        $this->view->render('404');
    }
    function render()
    {
        require_once 'View/404.php';
    }
}
