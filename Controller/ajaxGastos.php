<?php

require_once 'utils/helpers.php';
class ajaxGastos
{
    public function __construct()
    {
    }
    public function render()
    {
    }
    public function index()
    {
        $usuario = $_SESSION['idUser'];
        $presupuestoIndex = new Gastos;
        $all = $presupuestoIndex->getGastos(101);
        echo json_encode($all);
    }
}
