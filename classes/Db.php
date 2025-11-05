<?php 
require_once "config.php";

class Db {
    private $dbhost = DBHOST;
    private $dbport = DBPORT;
    private $dbname = DBNAME;
    private $dbuser = DBUSER;
    private $dbpass = DBPASS;

    public function connect(){
        $dsn = "mysql:host={$this->dbhost};port={$this->dbport};dbname={$this->dbname};charset=utf8mb4";
        $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

        try {
            $con = new PDO($dsn, $this->dbuser, $this->dbpass, $options);
            return $con;
        } catch (PDOException $e) {
            echo "Error dey: " . $e->getMessage();
        }
    }
}
?>
