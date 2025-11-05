<?php
require_once "config.php";

class Db
{
    private $dbhost = DBHOST;
    private $dbname = DBNAME;
    private $dbuser = DBUSER;
    private $dbpass = DBPASS;
    private $dbport; // We'll add this dynamically

    public function __construct()
    {
        // Add DBPORT if it exists in your .env
        $this->dbport = defined('DBPORT') ? DBPORT : 3306;
    }

    public function connect()
    {
        // Include the port in your DSN
        $dsn = "mysql:host={$this->dbhost};port={$this->dbport};dbname={$this->dbname};charset=utf8mb4";

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ];

        try {
            $con = new PDO($dsn, $this->dbuser, $this->dbpass, $options);
            return $con;
        } catch (PDOException $e) {
            echo "Database connection failed: " . $e->getMessage();
            return null;
        }
    }
}
?>
