<?php

require_once 'Model/RegistroModel.php';
require_once 'utils/helpers.php';
class Register /* extends Controller  */
{

    function __construct()
    {
    }
    public function render()
    {
        require_once 'View/register.php';
    }
    public function verifyUser(string $usuario)
    {
        $user = new RegistroModel();
        $save = $user->existsUser($usuario);
        return  $save;
    }
    public function insert()
    {
        $data = $_POST;
        $answerEmpty = "Debe llenar todos los campos correctamente";
        $passLegth = "La clave debe tener mas de 8 caracteres";
        $answeUser = "El usuario ya existe, intente con otro";

        if (!empty($data)) {
            $userModel = new RegistroModel();
            $names = trim(filter_var($data['nombres'], FILTER_SANITIZE_STRING));
            $lastNames = trim(filter_var($data['apellidos'], FILTER_SANITIZE_STRING));
            $email = trim(filter_var($data['email'], FILTER_VALIDATE_EMAIL, FILTER_SANITIZE_EMAIL));
            $user = trim(filter_var($data['usuario'], FILTER_SANITIZE_STRING));
            $pass = $data['password'];
            if ($names !== '' && $lastNames !== '' && $email !== '' && $user !== '' && $pass !== '') {
                $userVerify = $this->verifyUser($user);
                if (is_array($userVerify)) {
                    if (strlen($pass) > 7) {
                        $passHashed = hashPass($pass);
                        $insert = $userModel->insert($names, $lastNames, $email, $user, $passHashed);
                        echo json_encode($insert);
                    } else {
                        echo json_encode($passLegth);
                    }
                } else {
                    echo json_encode($answeUser);
                }
            } else {
                echo json_encode($answerEmpty);
            }
        } else {
            echo json_encode($answerEmpty);
        }
    }
}
