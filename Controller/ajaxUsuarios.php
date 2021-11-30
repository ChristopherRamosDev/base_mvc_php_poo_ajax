
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
        $names = trim(filter_var($data['nombres'], FILTER_SANITIZE_STRING));
        $lastNames = trim(filter_var($data['apellidos'], FILTER_SANITIZE_STRING));
        $email = trim(filter_var($data['email'], FILTER_VALIDATE_EMAIL, FILTER_SANITIZE_EMAIL));
        $user = trim(filter_var($data['usuario'], FILTER_SANITIZE_STRING));
        $pass = hashPass($data['password']);
        $insert = $userRegister->insert($names, $lastNames, $email, $user, $pass);
        echo json_encode($insert);
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
                echo json_encode($login);
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
}
