<?php
require_once 'Model/LoginModel.php'; 
require_once 'utils/helpers.php';

class Login extends Controller
{

    function __construct()
    {
    }
    public function render()
    {
        require_once 'View/Login.php';
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
    function login()
    {
        $userModel = new LoginModel();
        $data = $_POST;
        $user = $data['user'];
        $password = $data['pass'];
        $passByUser = $this->getPass($user);
        $getUser = $this->getUser($user);
        $answer = "Usuario o clave incorretos";
        if (is_array($getUser)) {
            $passVerify = verifyPass($password, $passByUser[0]['pass']);
            if ($passVerify == true) {
                $_SESSION['user'] = $getUser;
                $login = $userModel->login($getUser[0]['user'], $passByUser[0]['pass']);
                echo json_encode($login);
                $_SESSION['idUser'] = $login[0][2];
            } else {
                echo json_encode($answer);
            }
        } else {
            echo json_encode($answer);
        }
    }
}
