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
            $this->query = "SELECT nombre,monto,fecha,idGasto FROM gastos where idPresupuesto  = :idPresupuesto";
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
    public function restante(int $idPresupuesto)
    {

        try {
            $this->query = "SELECT sum(monto) FROM gastos where idPresupuesto  = :idPresupuesto";
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
    public function insert(string $nombre, float $monto, int $idPresupuesto)
    {
        try {
            $this->query = "INSERT INTO gastos(`nombre`,`monto`,`idPresupuesto`) VALUES (?,?,?)";
            $stmt = $this->conn->prepare($this->query);
            $stmt->bindValue(1, $nombre, PDO::PARAM_STR);
            $stmt->bindValue(2, $monto, PDO::PARAM_STR);
            $stmt->bindValue(3, $idPresupuesto, PDO::PARAM_INT);
            /* var_dump($this->query);  */
            return $stmt->execute();
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }
    public function idLast(int $idPresupuesto)
    {

        try {
            $this->query = "SELECT nombre,monto,fecha FROM gastos where idPresupuesto = $idPresupuesto ORDER BY idGasto DESC limit 1 ";
            $stmt = $this->conn->prepare($this->query);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }
}
