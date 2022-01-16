<?php
require_once 'Model/PresupuestosModel.php';
require_once 'Model/GastosModel.php';
class Gastos
{
    public function __construct()
    {
    }
    public function render()
    {
        /*  require_once 'View/Perfil.php';  */
    }
    public function index()
    {
        $url = $_GET['url'];
        $url = explode('/', $url);
        if (isset($_SESSION['user'])) {

            if ($url[1] == "index") {
                if (isset($url[2]) && !empty($url[2])) {
                    $intVal = intval($url[2]);
                    $val = filter_var($intVal, FILTER_SANITIZE_NUMBER_INT);
                    $isValid = filter_var($val, FILTER_VALIDATE_INT);
                    if ($isValid) {
                        $presupuestoModel = new PresupuestosModel;
                        $_SESSION['idBudget'] = $val;
                        $getOne = $presupuestoModel->getOne($val);
                        $_SESSION['dataBudget'] = $getOne[0];
                        $_SESSION['idUsaGasto'] = $intVal;
                        require_once 'View/Gastos.php';
                    } else {
                        require_once 'View/404.php';
                    }
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
    /*    public function getGastosa(){
        $gastosModel = new GastosModel;
        $getGastos = $gastosModel->getAllGastos(101);
        echo json_encode($getGastos);

    } */
    public function create()
    {
        $answer = "Llene todos los datos";
        $answerParsed = "Tipo de dato incorrecto";
        $answerInsert = "Error al agregar nuevo presupuesto, intente correctamente";
        $data = $_POST;

        if (!empty($data) && isset($_POST)) {
            $nombres = $data['nombre'];

            $monto = $data['monto'];
            if ($nombres !== "" && $monto !== "") {
                $gastosModel = new GastosModel;
                $data = $_POST;
                $nombres = $data['nombre'];
                $nombres = trim($nombres);
                $monto = $data['monto'];
                $montoCorrecto = str_replace(",", ".", $monto);
                $montoRecotado = trim($montoCorrecto);
                $montoRecotado = substr($montoRecotado, -1);
                if ($montoRecotado !== ".") {
                    $montoValidado = filter_var($montoCorrecto, FILTER_VALIDATE_FLOAT);
                    if ($montoValidado !== false) {
                        $restante = $gastosModel->restante($_SESSION['idUsaGasto']);
                        if (is_null($restante[0][0])) {
                            $presupuesto = $gastosModel->insert($nombres,  $montoValidado, $_SESSION['idUsaGasto']);
                            if ($presupuesto === true) {
                                $last = $gastosModel->idLast($_SESSION['idUsaGasto']);
                                $diff = $_SESSION['dataBudget']['cantidad'] - $last[0]['monto'];
                                /* $_SESSION['difference'] = $diff; */
                                $dataCreate = array(
                                    "create" => $last,
                                    "restante" => $diff
                                );
                                echo json_encode($dataCreate);
                            } else {
                                echo json_encode($answerInsert);
                            }
                        } else {
                            $last = $gastosModel->idLast($_SESSION['idUsaGasto']);
                            $diff = $_SESSION['dataBudget']['cantidad'] - $last[0]['monto'];
                            $diffRe = $_SESSION['dataBudget']['cantidad'] - ($restante[0]['sum(monto)'] + $montoValidado);
                            /* echo json_encode($diffRe); */
                             if ($diffRe < 0) {
                                $answerRestante = "Error, usted ha sobrepasado el presupuesto";
                                echo json_encode($answerRestante);
                            } else {
                             
                                $presupuesto = $gastosModel->insert($nombres,  $montoValidado, $_SESSION['idUsaGasto']);
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
    public function getGastos()
    {

        $gastosModel = new GastosModel;
        $getGastos = $gastosModel->getAllGastos($_SESSION['idUsaGasto']);
        echo json_encode($getGastos);
    }
    public function getMonto()
    {
        $presupuestoModel = new PresupuestosModel;
        $gastosModel = new GastosModel;
        $getOne = $presupuestoModel->getOne($_SESSION['idUsaGasto']);
        /* $_SESSION['montoTotal'] = $getOne[0][2]; */
        $restante = $gastosModel->restante($_SESSION['idUsaGasto']);
        $diff = $_SESSION['dataBudget']['cantidad'] - $restante[0]['sum(monto)'];

        $dataArray = array(
            "one" => $getOne[0],
            "restante" => $diff
        );
        echo json_encode($dataArray);
    }
    public function getMontoRestante()
    {
        $gastosModel = new GastosModel;
        $restante = $gastosModel->restante($_SESSION['idUsaGasto']);
        $diff = $_SESSION['montoTotal'] - $restante[0]['sum(monto)'];
        echo json_encode($diff);
    }
}
