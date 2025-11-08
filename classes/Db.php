<?php

include_once __DIR__ . '/config.php';

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

        try {
            // ✅ Use correct property names (lowercase)
            $con = new PDO($dsn, $this->dbuser, $this->dbpass, $options);
            return $con;
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
}
?>
