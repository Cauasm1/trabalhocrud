<?php
class Database
{
    private $host = "127.0.0.1";
    private $dbName = "bdcrud";
    private $username = "root";

    private $password = "";

    public $conn;

    public function getConnection()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->dbName, $this->username, $this->password);
        } catch (PDOException $exception) {
            echo "erro de conexão: ".$exception->getMessage();
        }
        return $this->conn;
    }
}
