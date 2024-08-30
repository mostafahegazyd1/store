<?php
class Connection
{
    public $connection;
    public function connectionDB(){
        $servername = "localhost";
        $username = "root";
        $password = "";

        try {
            $connection = new PDO("mysql:host=$servername;dbname=store", $username, $password);
            // set the PDO error mode to exception
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}