<?php

require_once 'Model/PerfilModel.php';
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
        $answer = "Llene todos los datos";
        $answerParsed = "Tipo de dato incorrecto y/o debe ingresar un monto mayor a 0";
        $answerInsert = "Error al agregar nuevo presupuesto, intente correctamente";
        $data = $_POST;

        if (!empty($data) && isset($_POST)) {
            $nombres = $data['nombreUpdateGasto'];
            $monto = $data['montoUpdate'];
            $idPre = $data['idGasto'];
            if ($nombres !== ""  && $monto !== "" && $idPre !== "") {
                $gastosModel = new GastosModel;
                $data = $_POST;
                $nombres = $data['nombreUpdateGasto'];
                $nombres = trim($nombres);
                $idPre = $data['idGasto'];
                $monto = $data['montoUpdate'];
                $montoCorrecto = str_replace(",", ".", $monto);
                $montoRecotado = trim($montoCorrecto);
                $montoRecotado = substr($montoRecotado, -1);
                if ($montoRecotado !== ".") {
                    $montoValidado = filter_var($montoCorrecto, FILTER_VALIDATE_FLOAT);
                    if ($montoValidado !== false && $montoValidado > 0) {
                        $getNot = $gastosModel->getNotIdGasto($idPre, $_SESSION['idUsaGasto']);
                        $diffRe =   $_SESSION['dataBudget']['cantidad'] -  ($getNot[0]['sum(monto)'] + $montoValidado);
                        if ($diffRe < 0) {
                            $answerRestante = "Error, usted ha sobrepasado el presupuesto";
                            echo json_encode($answerRestante);
                        } else {
                            $presupuesto = $gastosModel->update($nombres, $montoValidado, $_SESSION['idUsaGasto'], $idPre);
                            if ($presupuesto === true) {
                                $last = $gastosModel->idLast($_SESSION['idUsaGasto']);
                                $dataCreate = array(
                                    "create" => $last,
                                    "restante" => $diffRe
                                );
                                echo json_encode($dataCreate);
                            } else {
                                echo json_encode($answerInsert);
                            }
                        }
                    } else {
                        echo json_encode($answerParsed);
                    }
                } else {
                    echo json_encode($answerInsert);
                }
            } else {
                echo json_encode($answer);
            }
        } else {
            require_once 'View/404.php';
        }
    }
}
