
<?php

require_once 'utils/helpers.php';
class ajaxPresupuestos
{
    public function __construct()
    {
    }
    public function render()
    {
    }
    public function index()
    {
        $usuario = $_SESSION['idUser'];
        $presupuestoIndex = new Presupuestos;
        $all = $presupuestoIndex->getBudgets($usuario);
        echo json_encode($all);
    }
    function login()
    {
        $userLogin = new Login();
        $data = $_POST;
        $user = $data['user'];
        $password = $data['pass'];
        $passByUser = $userLogin->getPass($user);
        $getUser = $userLogin->getUser($user);
        $answer = "El usuario incorrecto o la clave son incorrectos";
        if (is_array($getUser)) {
            $passVerify = verifyPass($password, $passByUser[0]['pass']);
            if ($passVerify) {
                $_SESSION['user'] = $user;
                $login = $userLogin->login($getUser[0]['user'], $passByUser[0]['pass']);
                /* echo json_encode($login[2]); */
            } else {
                echo json_encode($answer);
            }
        } else {
            echo json_encode($answer);
        }
    }
    function logout()
    {
        $destroy = session_destroy();
        echo json_encode($destroy);
    }
    function edit()
    {
        $url = $_GET['url'];
        $url = explode('/', $url);
        var_dump($url[2]);
        /* require_once 'View/Perfil.php'; */
    }
}
