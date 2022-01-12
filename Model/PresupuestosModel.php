<?php

class PresupuestosModel
{
    protected $conn;
    public function __construct()
    {
        $db = new DataBase();
        $this->conn = $db->connection();
    }
    public function getAllBudgets(string $usuario)
    {
        $usuario = $_SESSION['idUser'];
        try {
            $this->query = "SELECT nombre,cantidad,fecha,idPresupuesto FROM presupuesto where idUsuario  = :user";
            $stmt = $this->conn->prepare($this->query);
            $stmt->execute(array(':user' => $usuario));
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
    public function insert(string $nombre, float $monto)
    {
        $usuario = $_SESSION['idUser'];
        try {
            $this->query = "INSERT INTO presupuesto(`nombre`,`cantidad`,`idUsuario`) VALUES (?,?,?)";
            $stmt = $this->conn->prepare($this->query);
            $stmt->bindValue(1, $nombre, PDO::PARAM_STR);
            $stmt->bindValue(2, $monto, PDO::PARAM_STR);
            $stmt->bindValue(3, $usuario, PDO::PARAM_INT);
            /* var_dump($this->query);  */
            return $stmt->execute();
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }
    public function idLast()
    {
        $usuario = $_SESSION['idUser'];
        try {
            $this->query = "SELECT nombre,cantidad,fecha FROM presupuesto where idUsuario = $usuario ";
            $stmt = $this->conn->prepare($this->query);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }
    public function getOne(int $id)
    {
        $usuario = $_SESSION['idUser'];
        try {
            $this->query = "SELECT nombre,cantidad FROM presupuesto where idUsuario = :user and idPresupuesto=:id";
            $stmt = $this->conn->prepare($this->query);
            $stmt->execute(array(':user' => $usuario, ':id' => $id));
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }
    public function update(string $nombre, float $monto, int $id)
    {
        $usuario = $_SESSION['idUser'];
        try {
            $this->query = "UPDATE presupuesto set nombre=?,cantidad=?,idUsuario=?, fecha=CURDATE() WHERE idPresupuesto =?";
            $stmt = $this->conn->prepare($this->query);
            $stmt->bindValue(1, $nombre, PDO::PARAM_STR);
            $stmt->bindValue(2, $monto, PDO::PARAM_STR);
            $stmt->bindValue(3, $usuario, PDO::PARAM_INT);
            $stmt->bindValue(4, $id, PDO::PARAM_INT);
            /* var_dump($this->query);  */
            return $stmt->execute();
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }
}
