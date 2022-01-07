
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
            $this->query = "SELECT nombre,descripcion,cantidad,fecha FROM presupuesto where idUsuario  = :user";
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
    public function insert(string $nombre, string $descripcion, float $monto)
    {
        $usuario = $_SESSION['idUser'];
        try {
            $this->query = "INSERT INTO presupuesto(`nombre`,`descripcion`,`cantidad`,`idUsuario`) VALUES (?,?,?,?)";
            $stmt = $this->conn->prepare($this->query);
            $stmt->bindValue(1, $nombre, PDO::PARAM_STR);
            $stmt->bindValue(2, $descripcion, PDO::PARAM_STR);
            $stmt->bindValue(3, $monto, PDO::PARAM_STR);
            $stmt->bindValue(4, $usuario, PDO::PARAM_INT);
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
            $this->query = "SELECT * FROM presupuesto where idUsuario = $usuario ORDER by idPresupuesto DESC limit 1";
            $stmt = $this->conn->prepare($this->query);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }
}
