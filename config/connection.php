<?php
class DatabaseConnection
{
    private $host = "localhost";
    private $database = "library";
    private $username = "root";
    private $password = "";
    private $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO("mysql:host=$this->host;port=3308;dbname=$this->database", $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection Faild: " . $e->getMessage();
        }
    }

    public function getConnection()
    {
        return $this->pdo;
    }
}

//$connection = new DatabaseConnection();
//$connection->getConnection();
