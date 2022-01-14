<?php

class GastosModel
{
    protected $conn;
    public function __construct()
    {
        $db = new DataBase();
        $this->conn = $db->connection();
    }
    public function getAllGastos(int $idPresupuesto)
    {
        
        try {
            $this->query = "SELECT nombre,monto,fecha FROM gastos where idPresupuesto  = :idPresupuesto";
            $stmt = $this->conn->prepare($this->query);
            $stmt->execute(array(':idPresupuesto' => $idPresupuesto));
            return $stmt->fetchAll();
            /*             $count = $stmt->rowCount();
            if ($count == 0) {
                
            } else if ($count >= 1) {
                return "Usuario existente";
            } */
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }
}
