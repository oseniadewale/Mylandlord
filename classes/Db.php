<?php 
//a class that connects to db
require_once "config.php";
class Db
{

    //create everything parameter needed as properties
    private $dbhost = DBHOST;
    private $dbname = DBNAME;
    private $dbuser = DBUSER;
    private $dbpass = DBPASS;

    //a method that connects to the database
    public function connect(){
        // $dsn ="mysql:dbhost=$this->dbhost;dbname=$this->dbname";
       $dsn = "mysql:host=$this->dbhost;port=3306;dbname=$this->dbname;charset=utf8mb4";
        $option = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try{
            $con = new PDO($dsn, $this->dbuser, $this->dbpass, $option);
            return $con;
        }catch(PDOException $e){
            echo "Error dey:".$e->getMessage();
        }
        
    }

    //  function fetchStateData(){
    //     $dsn = "mysql:dbhost=$this->dbhost;dbname=$this->dbname";
    //      $option = [
    //         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    //     ];
    //     try{
    //         $pdo = new PDO($dsn, $this->dbuser, $this->dbpass, $option);
    //         $stmt = $pdo->prepare("SELECT state_name FROM states" );
    //         $stmt->execute();
    //         $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //         return $data;
         
    //     }
    //     catch(PDOException $e){
    //         echo "Failed to retrieve states from database";
    //     }
    // }


    //  function fetchLgData(){
    //     $dsn = "mysql:dbhost=$this->dbhost;dbname=$this->dbname";
    //      $option = [
    //         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    //     ];
    //     try{
    //         $pdo = new PDO($dsn, $this->dbuser, $this->dbpass, $option);
    //         // RETRIEVING STATES FROM DATABASE
    //         $stmt = $pdo->prepare("SELECT state_id, state_name FROM states" );
    //         $stmt->execute();
    //         $states = $stmt->fetchAll(PDO::ASSOC);
    //         if(isset($_POST['state_id'])){
    //             $state_id = $_POST['state_id'];

    //             //Retrieve local government from Database based on state_id
    //             $stmt = $pdo->prepare("SELECT lg_name FROM local_governments WHERE state_id = :state_id");
    //             $stmt->execute([':state_id'=> $state_id]);
    //             $local_governments = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
    //             $options = '';
    //             foreach($local_governments as $lg){
    //                 $options .='<option value="'"'. $lg['lg_name']."'">'.$lg['lg_name'].'</option>';
    //             }

    //         }
    //         $stmt->execute([':state_id' => $_POST['state_id']]);
    //         $ = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //         return $data;
         
    //     }
    //     catch(PDOException $e){
    //         echo "Failed to retrieve states from database";
    //     }
    // }

    
    
}






?>