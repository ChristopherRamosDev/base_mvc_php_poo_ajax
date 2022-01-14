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
    public function getGastos()
    {
      
        $gastosModel = new GastosModel;
        $getGastos = $gastosModel->getAllGastos($_SESSION['idUsaGasto']);
        echo json_encode($getGastos);
    }
}
