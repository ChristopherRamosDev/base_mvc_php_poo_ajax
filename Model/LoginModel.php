<?php

require_once  "config/db.php";
class LoginModel
{
    /* protected int $id;
    protected string $usuario;
    protected string $clave;
    protected $conn; */


    public function __construct()
    {
        $db = new DataBase();
        $this->conn = $db->connection();
    }

    public function getUsuario()
    {
        return $this->usuario;
    }
    public function getPass()
    {
        return $this->clave;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }
    public function setClave($clave)
    {
        $this->clave = $clave;
    }


    public function hashPass($pass)
    {
        $hashPassword = password_hash($pass, PASSWORD_DEFAULT);
        return $hashPassword;
    }


    public function login(string $usuario, string $clave)
    {
        try {
            $this->query = "SELECT * FROM users where user = ? and pass = ?";
            $stmt = $this->conn->prepare($this->query);
            $stmt->bindValue(1, $usuario, PDO::PARAM_STR);
            $stmt->bindValue(2, $clave, PDO::PARAM_STR);
            $stmt->execute();
            $count = $stmt->rowCount();
            if ($count > 0) {
                return $stmt->fetchAll();
            } else {
                return "No existe el usuario o la contraseña es incorrecta";
            }
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
    public function getPassByUser($usuario = "")
    {
        try {
            $this->query = "SELECT pass FROM users where user  = :user";
            $stmt = $this->conn->prepare($this->query);
            $stmt->execute(array(':user' => $usuario));
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }
}
