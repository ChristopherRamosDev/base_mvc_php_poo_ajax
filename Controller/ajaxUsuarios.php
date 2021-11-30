
<?php

require_once 'utils/helpers.php';
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
        $password = hashPass($data['password']);
        $insert = $userRegister->insert($nombres, $apellidos, $email, $usuario, $password);
        echo json_encode($insert);
    }
    function login()
    {
        $userLogin = new Login();
        $data = $_POST;
        $usuario = $data['user'];
        $password = $data['pass'];
        $passByUser = $userLogin->getPass($usuario);
        $passVerify = verifyPass($password, $passByUser[0]['pass']);
        /* s */
        $Respuesta = "El usuario o la clave son incorrectos";
        $login = $userLogin->login($usuario, $passByUser[0]['pass']);
        /* echo json_encode($login); */
        if ($passVerify) {
            $_SESSION['user'] = $usuario;
            echo json_encode($login);
        } else {
            echo json_encode($Respuesta);
        }
    }
    function logout()
    {
        $destroy = session_destroy();
        echo json_encode($destroy);
    }
}
