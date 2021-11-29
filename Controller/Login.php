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
    function saludar($usu,$clave){
        return "hola" .$usu . " " . $clave;
    }
    function login(/* string $usuario ="", string $clave="" */)
    {
        $usuario = $_POST['user'];
        $clave = $_POST['pass'];
        echo json_encode("Hola " .$usuario. " " . $clave);
        die();
        $user = new LoginModel();
        $user->setUsuario($usuario);
        $user->setClave($clave);
        $save = $user->login();
        /* var_dump($save); */
        return $save;
    }
    
}

if(!empty($_POST) && isset($_GET['action']) && $_GET['action'] == 'login') {
    echo json_encode("hola");
}

