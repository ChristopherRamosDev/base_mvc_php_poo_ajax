
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
            $this->query = "SELECT * FROM presupuesto where idUsuario  = :user";
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
}
