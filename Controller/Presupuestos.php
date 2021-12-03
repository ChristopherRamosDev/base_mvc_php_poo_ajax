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
        if ($url[1] == "edit") {
            if (isset($url[2]) && !empty($url[2]) ) {
                $intVal = intval($url[2]);
                $val = filter_var($intVal,FILTER_SANITIZE_NUMBER_INT);
                $isValid = filter_var($val,FILTER_VALIDATE_INT);
                if($isValid){
                    echo "nice";
                    die();
                }else{
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
    }
}
