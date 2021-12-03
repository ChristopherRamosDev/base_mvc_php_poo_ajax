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
            $this->query = "SELECT user,pass,idUser FROM users where user = :user and pass = :pass";
            $stmt = $this->conn->prepare($this->query);
            $stmt->execute(array(':user' => $usuario, ':pass' => $clave));
            return $stmt->fetchAll();
            /* $count = $stmt->rowCount(); */
            /*  if ($count > 0) {
                
            } else {
                return "No existe el usuario o la contraseña es incorrecta";
            } */
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
    public function getPassByUser(string $usuario = "")
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
    public function getUserByUser($usuario = "")
    {
        try {
            $this->query = "SELECT user FROM users where user  = :user";
            $stmt = $this->conn->prepare($this->query);
            $stmt->execute(array(':user' => $usuario));
            $count = $stmt->rowCount();
            if ($count > 0) {
                return $stmt->fetchAll();
            } else {
                return "No existe el usuario";
            }
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }
}
