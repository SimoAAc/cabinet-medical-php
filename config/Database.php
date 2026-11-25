
<?php

class Database
{
    private $host = "localhost";
    private $dbname = "cabinet_medical";
    private $username = "root";
    private $password = "";

    public function connect()
    {
        $pdo = new PDO(
            "mysql:host=$this->host;dbname=$this->dbname;charset=utf8mb4",
            $this->username,
            $this->password
        );

        $pdo->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );

        return $pdo;
    }
}
