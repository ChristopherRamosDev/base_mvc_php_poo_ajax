<?php


class DataBase
{
    private $conn;
    private $config = [
        "driver" => "mysql",
        "host" => "localhost",
        "database" => "tasks-app",
        "port" => "3306",
        "user" => "root",
        "pass" => "",
        "charset" => "utf8"
    ];


    public function connection()
    {
        try {
            $driver = $this->config["driver"];
            $server = $this->config["host"];
            $db = $this->config["database"];
            $port = $this->config["port"];
            $user = $this->config["user"];
            $pass = $this->config["pass"];
            $code = $this->config["charset"];

            $url = "{$driver}:host={$server};dbname={$db};charset{$code};port={$port}";
            $this->conn = new PDO($url, $user, $pass);
            return $this->conn;
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }
}


