<?php

require_once 'Model/PresupuestosModel.php';
require_once 'Model/GastosModel.php';
class Presupuestos
{
    public function __construct()
    {
    }
    public function render()
    {
        require_once 'View/Presupuestos.php';
    }
    public function getBudgets()
    {
        $usuario = $_SESSION['idUser'];
        $presupuesto = new PresupuestosModel();
        $getAll = $presupuesto->getAllBudgets($usuario);
        echo json_encode($getAll);
    }
    public function getOnes()
    {

        $presupuesto = new PresupuestosModel();
        $data = $_POST;
        $id = $data['id'];
        $getOne = $presupuesto->getOne($id);
        echo json_encode($getOne);
    }
    public function nuevoPresupuesto()
    {
        require_once 'View/NuevoPresupuesto.php';
    }
    public function create()
    {
        $answer = "Llene todos los datos";
        $answerParsed = "Tipo de dato incorrecto";
        $answerInsert = "Error al agregar nuevo presupuesto, intente correctamente";
        $data = $_POST;

        if (!empty($data) && isset($_POST)) {
            $nombres = $data['nombre'];

            $monto = $data['cantidad'];
            if ($nombres !== "" && $monto !== "") {
                $presupuestoModel = new PresupuestosModel;
                $data = $_POST;
                $nombres = $data['nombre'];
                $nombres = trim($nombres);
                $monto = $data['cantidad'];
                $montoCorrecto = str_replace(",", ".", $monto);
                $montoRecotado = trim($montoCorrecto);
                $montoRecotado = substr($montoRecotado, -1);
                if ($montoRecotado !== ".") {
                    $montoValidado = filter_var($montoCorrecto, FILTER_VALIDATE_FLOAT);
                    if ($montoValidado !== false) {
                        $presupuesto = $presupuestoModel->insert($nombres,  $montoValidado);
                        if ($presupuesto === true) {
                            $last = $presupuestoModel->idLast();
                            /* $_SESSION['lastBudget'] = $last[0]; */
                            echo json_encode($last);
                        } else {
                            echo json_encode($answerInsert);
                        }
                    } else {
                        echo json_encode($answerParsed);
                    }
                } else {
                    echo json_encode($answerInsert);
                }
                /*  $montoValidado = filter_var($montoCorrecto, FILTER_VALIDATE_FLOAT);
                if ($montoValidado !== false) {
                    $presupuesto = $presupuestoModel->insert($nombres, $descripcion, $montoValidado);
                    if ($presupuesto) {
                        echo json_encode($presupuesto);
                    } else {
                        echo json_encode($answerInsert);
                    }
                } else {
                    echo json_encode($answerParsed);
                } */
            } else {
                echo json_encode($answer);
            }
        } else {
            require_once 'View/404.php';
            /* echo json_encode($answer); */
        }
    }
    public function edit()
    {
        $answer = "Llene todos los datos";
        $answerParsed = "Tipo de dato incorrecto";
        $answerInsert = "Error al agregar nuevo presupuesto, intente correctamente";
        $answerUpdate = "No puedes actualizar a un presupuesto menor si tus gastos superan el presupuesto inicial";
        $data = $_POST;

        if (!empty($data) && isset($_POST)) {
            $nombres = $data['nombreUpdate'];
            $monto = $data['cantidadUpdate'];
            $idPre = $data['idPresu'];
            $_SESSION['idPresupuestoUpdate'] = $idPre;
            if ($nombres !== ""  && $monto !== "" && $idPre !== "") {
                $presupuestoModel = new PresupuestosModel;
                $gastosModel = new GastosModel;
                $data = $_POST;
                $nombres = $data['nombreUpdate'];
                $nombres = trim($nombres);
                $idPre = $data['idPresu'];
                $monto = $data['cantidadUpdate'];
                $montoCorrecto = str_replace(",", ".", $monto);
                $montoRecotado = trim($montoCorrecto);
                $montoRecotado = substr($montoRecotado, -1);
                if ($montoRecotado !== ".") {
                    $montoValidado = filter_var($montoCorrecto, FILTER_VALIDATE_FLOAT);
                    if ($montoValidado !== false) {
                        $restante = $gastosModel->restante($idPre);
                        $montoRestante = floatval($restante[0][0]) - floatval($montoCorrecto);
                        if (is_null($restante[0][0])) {
                            $presupuesto = $presupuestoModel->update($nombres, $montoValidado, $idPre);
                            if ($presupuesto === true) {
                                $getOne = $presupuestoModel->getOne($idPre);
                                echo json_encode($getOne);
                            } else {
                                echo json_encode($answerInsert);
                            }
                        } else if (floatval($restante[0][0]) > floatval($montoCorrecto)) {
                            echo json_encode($answerUpdate);
                        } else if (floatval($restante[0][0]) <= floatval($montoCorrecto)) {
                            $presupuesto = $presupuestoModel->update($nombres, $montoValidado, $idPre);
                            if ($presupuesto === true) {
                                $getOne = $presupuestoModel->getOne($idPre);
                                echo json_encode($getOne);
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
