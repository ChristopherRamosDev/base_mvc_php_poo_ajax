<?php

require_once 'Model/PresupuestosModel.php';
class Presupuestos
{
    public function __construct()
    {
    }
    public function render()
    {
        require_once 'View/Presupuestos.php';
    }
    public function getBudgets($usuario)
    {
        $presupuesto = new PresupuestosModel();
        $getAll = $presupuesto->getAllBudgets($usuario);
        return $getAll;
    }
    public function edit()
    {
        $url = $_GET['url'];
        $url = explode('/', $url);
        if (isset($_SESSION['user'])) {

            if ($url[1] == "edit") {
                if (isset($url[2]) && !empty($url[2])) {
                    $intVal = intval($url[2]);
                    $val = filter_var($intVal, FILTER_SANITIZE_NUMBER_INT);
                    $isValid = filter_var($val, FILTER_VALIDATE_INT);
                    if ($isValid) {
                        echo "nice";
                        die();
                    } else {
                        echo "mal";
                        die();
                    }
                    require_once 'View/Presupuestos.php';
                } else {
                    require_once 'View/404.php';
                }
            } else {
                require_once 'View/404.php';
            }
        } else {
            require_once 'View/error_login.php';
        }
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
            $descripcion = $data['descripcion'];
            $monto = $data['cantidad'];
            if ($nombres !== "" && $descripcion !== "" && $monto !== "") {
                $presupuestoModel = new PresupuestosModel;
                $data = $_POST;
                $nombres = $data['nombre'];
                $descripcion = $data['descripcion'];
                $monto = $data['cantidad'];
                $montoCorrecto = str_replace(",", ".", $monto);
                $montoRecotado = trim($montoCorrecto);
                $montoRecotado = substr($montoRecotado, -1);
                if ($montoRecotado !== ".") {
                    $montoValidado = filter_var($montoCorrecto, FILTER_VALIDATE_FLOAT);
                    if ($montoValidado !== false) {
                        $presupuesto = $presupuestoModel->insert($nombres, $descripcion, $montoValidado);
                        if ($presupuesto === true) {
                            $last = $presupuestoModel->idLast();
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
}
