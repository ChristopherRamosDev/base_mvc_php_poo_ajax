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
    public function update(string $nombres, string $apellidos, string $correo, string $user)
    {
        $idUser = $_SESSION['idUser'];
        try {
            $this->query = "UPDATE users set nombres=?,apellidos=?,correo=?,user=? WHERE idUser =?";
            $stmt = $this->conn->prepare($this->query);
            $stmt->bindValue(1, $nombres, PDO::PARAM_STR);
            $stmt->bindValue(2, $apellidos, PDO::PARAM_STR);
            $stmt->bindValue(3, $correo, PDO::PARAM_STR);
            $stmt->bindValue(4, $user, PDO::PARAM_STR);
            $stmt->bindValue(5, $idUser, PDO::PARAM_INT);
            /* var_dump($this->query);  */
            return $stmt->execute();
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }
    public function updatePass(string $pass, string $idUser)
    {
        try {
            $this->query = "UPDATE users set pass=? WHERE idUser =?";
            $stmt = $this->conn->prepare($this->query);
            $stmt->bindValue(1, $pass, PDO::PARAM_STR);
            $stmt->bindValue(2, $idUser, PDO::PARAM_INT);
            /* var_dump($this->query);  */
            return $stmt->execute();
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }
    public function idLast($idUser)
    {

        try {
            $this->query = "SELECT * FROM users  WHERE idUser =:user ";
            $stmt = $this->conn->prepare($this->query);
            $stmt->execute(array(':user' => $idUser));
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }
    public function hashPass($pass)
    {
        $hashPassword = password_hash($pass, PASSWORD_DEFAULT);
        return $hashPassword;
    }
}
