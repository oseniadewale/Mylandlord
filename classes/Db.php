<?php

require_once __DIR__ . '/config.php';

class Db
{
    private $dbhost = DBHOST;
    private $dbport = DBPORT;
    private $dbname = DBNAME;
    private $dbuser = DBUSER;
    private $dbpass = DBPASS;

    public function connect(){
        $dsn = "mysql:host={$this->dbhost};port={$this->dbport};dbname={$this->dbname};charset=utf8mb4";

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        try{
            $con = new PDO($dsn, $this->DBUSER, $this->DBPASS, $options);
            return $con;
        } catch(PDOException $e){
            // Do not expose credentials in production — but useful while debugging
            die("Database connection failed: " . $e->getMessage());
        }
    }
}
?>
