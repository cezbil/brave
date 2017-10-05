<?php

class dbConfig{
    private $dbUser = 'root';
    private $dbPassword = '';
    private $dbConnection;
    private  $dsn = "mysql:host=localhost;dbname=brave;";

    public function __construct()
    {
        try {
            $this->dbConnection = new PDO($this->dsn, $this->dbUser, $this->dbPassword);
            $this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->dbConnection;

        } catch
        (PDOException $e) {
            echo $e->getMessage();
        }

    }

    public function getConn(){
        return $this->dbConnection;
}

}
session_start();
