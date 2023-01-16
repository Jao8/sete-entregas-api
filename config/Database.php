<?php
class Database
{
    // DB Params
    private $db = 'pgsql';
    private $host = 'localhost';
    private $port = '5432';
    private $db_name = 'sete';
    private $username = 'postgres';
    private $password = 'postgres';
    private $conn;

    // DB Connect
    public function connect()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO($this->db . ':host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }

        return $this->conn;
    }
}
