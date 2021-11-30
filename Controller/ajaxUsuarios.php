
<?php

class ajaxUsuarios
{
    public function __construct()
    {
    }
    public function render()
    {
    }
    public function insert()
    {
        $data = $_POST;
        $userRegister = new Register;
        $nombres = $data['nombres'];
        $apellidos = $data['apellidos'];
        $email = $data['email'];
        $usuario = $data['usuario'];
        $password = $data['password'];
        $insert = $userRegister->insert($nombres, $apellidos, $email, $usuario, $password);
        echo json_encode($insert);
    }
    function login()
    {
        $data = $_POST;
        $userLogin = new Login();
        $usuario = $data['user'];
        $password = $data['pass'];
        $login = $userLogin->login($usuario, $password);
        if (is_array($login)) {
            $_SESSION['user'] = $usuario;
            echo json_encode($login);
            
        } else {
            echo json_encode($login);
             
        }
    }
    function logout(){
        $destroy = session_destroy();
        echo json_encode($destroy);
    }
}
