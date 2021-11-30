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
    public function getfirstName()
    {
        return $this->nombres;
    }
    public function getlastName()
    {
        return $this->apellidos;
    }
    public function getemail()
    {
        return $this->email;
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
    public function setfirstName($nombres)
    {
        $this->nombres = $nombres;
    }
    public function setlastName($apellidos)
    {
        $this->apellidos = $apellidos;
    }
    public function setemail($email)
    {
        $this->email = $email;
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


    public function insert(string $nombres, string $apellidos, string $email, string $usuario, string $clave)
    {
        /* $firstName = $this->getfirstName();
        $lastName = $this->getlastName();
        $email = $this->getemail();
        $usuario = $this->getUsuario();
        $clave = $this->getPass();
        $hashedPass = $this->hashPass($clave); */
        try {
            $this->query = "INSERT INTO users(`nombres`,`apellidos`,`correo`,`user`,`pass`,`rolID`) VALUES (?,?,?,?,?,?)";
            $stmt = $this->conn->prepare($this->query);
            $stmt->bindValue(1, $nombres, PDO::PARAM_STR);
            $stmt->bindValue(2, $apellidos, PDO::PARAM_STR);
            $stmt->bindValue(3, $email, PDO::PARAM_STR);
            $stmt->bindValue(4, $usuario, PDO::PARAM_STR);
            $stmt->bindValue(5, $clave, PDO::PARAM_STR);
            $stmt->bindValue(6, 2, PDO::PARAM_INT);
            /* var_dump($this->query);  */
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
}
