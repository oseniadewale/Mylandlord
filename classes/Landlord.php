<?php 
 include_once "Db.php";


 class Landlord extends Db{
 private $dbconn;


public function landlord_full_reg($landlord_username, $landlord_password, $landlord_email, $landlord_mobile, $landlord_surname, $landlord_firstname, $landlord_middlename, $landlord_homeaddress) {
    $hash = password_hash($landlord_password, PASSWORD_DEFAULT);

    $conn = $this->connect();

    $sql = "INSERT INTO landlord (landlord_username, landlord_password, landlord_email, landlord_mobile, landlord_surname, landlord_firstname, landlord_middlename, home_address)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    try {
        $stmt->execute([
            $landlord_username, $hash, $landlord_email, $landlord_mobile,
            $landlord_surname, $landlord_firstname, $landlord_middlename, $landlord_homeaddress
        ]);
        return $conn->lastInsertId(); 
    } catch (PDOException $e) {
        die("Database Error: " . $e->getMessage());
    }
}

//     public function get_landlord(){
//         $dbconn =$this->connect();
// $sql = "SELECT * FROM landlord where landlord_id=1";
// $stmt = $dbconn->prepare($sql);
// $stmt->execute();
// $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
// return $result;

//     }



//      public function get_landlord2(){
//         $dbconn =$this->connect();
// $sql = "SELECT * FROM landlord where landlord_id=1";
// $stmt = $dbconn->prepare($sql);
// $stmt->execute();
// $result = $stmt->fetchAll(PDO::FETCH_BOTH);
// return $result;

//     }


//      public function get_landlord3(){
//         $dbconn =$this->connect();
// $sql = "SELECT * FROM landlord";
// $stmt = $dbconn->prepare($sql);
// $stmt->execute();
// $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
// if(count($result)<0){
//   echo "<span >No result is found in the database</span>";
  
// }

//    return $result;

//     }



    public function authenticate($username, $password) {
    $conn = $this->connect();
    $sql = "SELECT * FROM landlord WHERE landlord_username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$username]);
    $landlord = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($landlord && password_verify($password, $landlord["landlord_password"])) {
        return $landlord; // return full landlord data
    } else {
        return false;
    }
}


 public function tenant_as_landlord($tenant_email){
        $sql = "SELECT landlord_id FROM landlord WHERE landlord_email = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$tenant_email]);
        $existing_landlord = $stmt->fetch();
        return $existing_landlord;
    }


public function tenant_as_landlord_insert($landlord_username, $landlord_password, $landlord_email, $landlord_mobile){
        $myhash = password_hash($landlord_password, PASSWORD_DEFAULT);
        $conn = $this->connect();
        $sql = "INSERT INTO landlord(landlord_username, landlord_password, landlord_email,landlord_mobile) VALUES(?,?,?,?)";
        $stmt = $conn->prepare($sql);

        try{
            $stmt->execute([$landlord_username, $myhash, $landlord_email, $landlord_mobile]);
            return $conn->lastInsertId();
           
        } catch(PDOException $e){
             echo "insert failed: " .$e->getMessage();  
             return false; 
            }
    }
   

    
    // Update landlord or tenant profile
    public function update_Landlord_profile($user_id, $name, $email, $phone)
    {
        $stmt = $this->connect()->prepare("
            UPDATE users
            SET name = ?, email = ?, phone = ?
            WHERE user_id = ?
        ");
        return $stmt->execute([$name, $email, $phone, $user_id]);
    }
    

   

 }

 








?>