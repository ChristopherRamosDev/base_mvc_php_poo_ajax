<?php


class ErroreLogin extends Controller
{

    function __construct()
    {
        parent::__construct();
        $this->view->render('error_login');
    }
    function render()
    {
        require_once 'View/error_login.php';
    }
}
