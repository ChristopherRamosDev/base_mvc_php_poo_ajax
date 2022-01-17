<?php

class PerfilModel
{
    protected $conn;
    public function __construct()
    {
        $db = new DataBase();
        $this->conn = $db->connection();
    }
    public function getDataByUser()
    {
        $usuario = $_SESSION['idUser'];
        try {
            $this->query = "SELECT idUser,nombres,apellidos,correo,user,pass FROM users where idUser  = :user";
            $stmt = $this->conn->prepare($this->query);
            $stmt->execute(array(':user' => $usuario));
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
