<?php

require_once 'Model/PerfilModel.php';
require_once 'Model/LoginModel.php';
require_once 'utils/helpers.php';
class Perfil
{
    public function __construct()
    {
    }
    public function render()
    {
        require_once 'View/Perfil.php';
    }
    public function getData()
    {
        $perfilModel = new PerfilModel;
        $getData = $perfilModel->getDataByUser();
        echo json_encode($getData[0]);
    }
    public function edit()
    {
        $perfilModel = new PerfilModel;
        $loginModel = new LoginModel;
        $answer = "Llene todos los datos";
        $answerParsed = "Tipo de dato incorrecto";
        $answerInsert = "Error al agregar nuevo presupuesto, intente correctamente";
        $data = $_POST;
        if (!empty($data)) {

            $nombreUpdateInfo = trim(filter_var($data['nombreUpdateInfo'], FILTER_SANITIZE_STRING));
            $apellidoUpdate = trim(filter_var($data['apellidoInfo'], FILTER_SANITIZE_STRING));
            $correoInfo = trim(filter_var($data['correoInfo'], FILTER_SANITIZE_STRING, FILTER_SANITIZE_EMAIL));
            $usuarioInfo = trim(filter_var($data['usuarioInfo'], FILTER_SANITIZE_STRING));
            $claveAnterior = trim(filter_var($data['claveAnterior'], FILTER_SANITIZE_STRING));
            if ($nombreUpdateInfo !== '' && $apellidoUpdate !== '' && $correoInfo !== '' && $usuarioInfo !== '' && $claveAnterior !== '') {
                if (strlen($claveAnterior) > 7) {
                    $getPassByUser = $loginModel->getPassByUser($_SESSION['user'][0][0]);
                    $passVerify = password_verify($claveAnterior, $getPassByUser[0][0]);
                    if ($passVerify === true) {
                        $updateData = $perfilModel->update($nombreUpdateInfo, $apellidoUpdate, $correoInfo, $usuarioInfo);
                        if ($updateData === true) {
                            $getDataUpdated = $perfilModel->idLast($_SESSION['idUser']);
                            echo json_encode($getDataUpdated);
                        } else {
                            echo json_encode("Fallo al actualizar");
                        }
                    } else {
                        echo json_encode("Clave anterior incorrecta");
                    }
                } else {
                    echo json_encode("Clave menor a 8 caracteres");
                }
            } else {
                echo json_encode("Llena todos los datos");
            }
        } else {
            echo json_encode("Llena todos los datos");
            /* echo json_encode($answer); */
        }
    }
    public function editPass()
    {
        $perfilModel = new PerfilModel;
        $loginModel = new LoginModel;
        $answer = "Llene todos los datos";
        $answerParsed = "Tipo de dato incorrecto";
        $answerInsert = "Error al agregar nuevo presupuesto, intente correctamente";
        $data = $_POST;
        if (!empty($data)) {
            $claveAnteriorEdit = trim(filter_var($data['claveAnteriorEdit'], FILTER_SANITIZE_STRING));
            $nuevaClave = trim(filter_var($data['nuevaClave'], FILTER_SANITIZE_STRING));
            $repeteriClave = trim(filter_var($data['repeteriClave'], FILTER_SANITIZE_STRING));
            $idUser = trim(filter_var($data['idUser'], FILTER_SANITIZE_STRING));
            if ($claveAnteriorEdit !== '' && $nuevaClave !== '' && $repeteriClave !== '') {
                if (strlen($claveAnteriorEdit) > 7 && strlen($nuevaClave) > 7 && strlen($repeteriClave) > 7) {
                    if ($nuevaClave === $repeteriClave) {
                        $getPassByIdUser = $loginModel->getPassById($idUser);
                        $passVerify = password_verify($claveAnteriorEdit, $getPassByIdUser[0][0]);
                        if ($passVerify === true) {
                            $passHashed = hashPass($repeteriClave);
                            $updateData = $perfilModel->updatePass($passHashed, $idUser);
                            if ($updateData === true) {
                                echo json_encode("Actualizacion correcta");
                            } else {
                                echo json_encode("Fallo al actualizar");
                            }
                        } else {
                            echo json_encode("Clave anterior incorrecta");
                        }
                    } else {
                        echo json_encode("Las claves no coinciden");
                    }
                } else {
                    echo json_encode("Clave menor a 8 caracteres");
                }
            } else {
                echo json_encode("Llena todos los datos");
            }
        } else {
            echo json_encode("Llena todos los datos");
            /* echo json_encode($answer); */
        }
    }
}
