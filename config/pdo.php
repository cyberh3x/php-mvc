<?php


class DB
{
    public function __construct()
    {
        $connectionInfo = $this->getDbConnectionInformation();
        $host = $connectionInfo['host'];
        $database = $connectionInfo['database'];
        $username = $connectionInfo['username'];
        $password = $connectionInfo['password'];
        try {
            $connection = new PDO("mysql:host=$host;dbname=$database", $username, $password);
            // set the PDO error mode to exception
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return false;
        }
    }

    private function getDbConnectionInformation()
    {
        $dbConfig = require_once APP_ROOT . '/config/db.php';
        $mySql = $dbConfig['connections']['mysql'];
        $host = $mySql['host'];
        $database = $mySql['database'];
        $username = $mySql['username'];
        $password = $mySql['password'];
        return [
            'host' => $host,
            'database' => $database,
            'username' => $username,
            'password' => $password
        ];
    }
}