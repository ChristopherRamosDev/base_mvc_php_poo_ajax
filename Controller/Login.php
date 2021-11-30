<?php
require_once 'Model/LoginModel.php';

class Login extends Controller
{

    function __construct()
    {
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
    function getPass(string $usuario = "")
    {
        $userModel = new LoginModel();
        $save = $userModel->getPassByUser($usuario);
        return  $save;
    }
    function getUser(string $usuario)
    {
        $userModel = new LoginModel();
        $save = $userModel->getUserByUser($usuario);
        return  $save;
    }
}
