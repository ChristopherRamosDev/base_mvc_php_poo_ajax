<?php
require_once 'Model/LoginModel.php';

class Login extends Controller
{

    function __construct()
    {
        /* parent::__construct();
        $this->view->render('Login'); */
    }
    public function render()
    {
        require_once 'View/Login.php';
    }

    function login(string $usuario = "", string $clave = "")
    {
        $user = new LoginModel();
        $save = $user->login($usuario, $clave);
        return  $save;
    }
}


