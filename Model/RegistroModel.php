<?php

require_once  "config/db.php";
class RegistroModel
{
    protected int $id;
    protected string $nombres;
    protected string $apellidos;
    protected string $email;
    protected string $usuario;
    protected string $clave;
    protected $conn;
    
    public function __construct()
    {
        $db = new DataBase();
        $this->conn = $db->connection();
    }

    public function hashPass($pass)
    {
        $hashPassword = password_hash($pass, PASSWORD_DEFAULT);
        return $hashPassword;
    }


    public function insert(string $nombres, string $apellidos, string $email, string $usuario, string $clave)
    {
        try {
            $this->query = "INSERT INTO users(`nombres`,`apellidos`,`correo`,`user`,`pass`,`idRol`) VALUES (?,?,?,?,?,?)";
            $stmt = $this->conn->prepare($this->query);
            $stmt->bindValue(1, $nombres, PDO::PARAM_STR);
            $stmt->bindValue(2, $apellidos, PDO::PARAM_STR);
            $stmt->bindValue(3, $email, PDO::PARAM_STR);
            $stmt->bindValue(4, $usuario, PDO::PARAM_STR);
            $stmt->bindValue(5, $clave, PDO::PARAM_STR);
            $stmt->bindValue(6, 2, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }
    public function idLast()
    {
        try {
            $this->query = "SELECT * FROM users ORDER by idUser DESC limit 1";
            $stmt = $this->conn->prepare($this->query);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }
    public function existsUser(string $usuario)
    {
        try {
            $this->query = "SELECT user FROM users where user  = :user";
            $stmt = $this->conn->prepare($this->query);
            $stmt->execute(array(':user' => $usuario));
            $count = $stmt->rowCount();
            if ($count == 0) {
                return $stmt->fetchAll();
            } else if ($count >= 1) {
                return "Usuario existente";
            }
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }
}
