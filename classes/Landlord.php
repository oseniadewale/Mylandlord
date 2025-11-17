<?php 

include_once __DIR__ . "/Db.php";


 class Landlord extends Db{
 private $dbconn;



  public function landlord_full_reg(
    $Landlord_username, 
    $Landlord_password, 
    $Landlord_email, 
    $Landlord_mobile,
    $Landlord_surname, 
    $Landlord_firstname,
    $Landlord_middlename, 
    $Landlord_permanent_homeaddress,
    $landlord_passport,
    $Landlord_id
) {
    $hash = password_hash($Landlord_password, PASSWORD_DEFAULT);
    $conn = $this->connect();

    $sql = "UPDATE landlord
            SET landlord_username = ?, 
                landlord_password = ?, 
                landlord_email = ?, 
                landlord_mobile = ?, 
                landlord_surname = ?, 
                landlord_firstname = ?, 
                landlord_middlename = ?, 
                landlord_permanent_home_address = ?, 
                landlord_passport = ?,
                profile_completed = 1
            WHERE landlord_id = ?";

    $stmt = $conn->prepare($sql);

    try {
        $ok = $stmt->execute([
            $Landlord_username, 
            $hash,
            $Landlord_email, 
            $Landlord_mobile, 
            $Landlord_surname, 
            $Landlord_firstname,
            $Landlord_middlename, 
            $Landlord_permanent_homeaddress,
            $landlord_passport,
            $Landlord_id
        ]);

        if ($ok) {
            return $Landlord_id;  // ✅ return id if execute() ran, regardless of rowCount()
        } else {
            return false;
        }

    } catch (PDOException $e) {
        die("Database Error: " . $e->getMessage());
    }
}



//  public function landlord_full_reg(
//     $landlord_username, 
//     $landlord_password, 
//     $landlord_email, 
//     $landlord_mobile,
//     $landlord_surname, 
//     $landlord_firstname,
//     $landlord_middlename,
//     $landlord_permanent_homeaddress
// ) {
//     $hash = password_hash($landlord_password, PASSWORD_DEFAULT);
//     $conn = $this->connect();

//     $sql = "INSERT INTO landlord (
//                 landlord_username, 
//                 landlord_password,
//                 landlord_email, 
//                 landlord_mobile, 
//                 landlord_surname, 
//                 landlord_firstname, 
//                 landlord_middlename, 
//                 permanent_home_address
//             ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
//     $stmt = $conn->prepare($sql);

//     try {
//         // Insert landlord
//         $stmt->execute([
//             $landlord_username, 
//             $hash,
//             $landlord_email, 
//             $landlord_mobile, 
//             $landlord_surname, 
//             $landlord_firstname,
//             $landlord_middlename, 
//             $landlord_permanent_homeaddress
//         ]);

//         // Get inserted landlord_id
//         $landlord_id = $conn->lastInsertId();

//         // Mark profile as completed
//         $updateSql = "UPDATE landlord SET profile_completed = 1 WHERE landlord_id = ?";
//         $updateStmt = $conn->prepare($updateSql);
//         $updateStmt->execute([$landlord_id]);

//         return $landlord_id;

//     } catch (PDOException $e) {
//         die("Database Error: " . $e->getMessage());
//     }
// }


// public function landlord_full_reg($landlord_username, $landlord_password, $landlord_email, $landlord_mobile, $landlord_surname, $landlord_firstname, $landlord_middlename, $landlord_homeaddress) {
//     $hash = password_hash($landlord_password, PASSWORD_DEFAULT);

//     $conn = $this->connect();

//     $sql = "INSERT INTO landlord (landlord_username, landlord_password, landlord_email, landlord_mobile, landlord_surname, landlord_firstname, landlord_middlename, home_address)
//             VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

//     $stmt = $conn->prepare($sql);

//     try {
//         $stmt->execute([
//             $landlord_username, $hash, $landlord_email, $landlord_mobile,
//             $landlord_surname, $landlord_firstname, $landlord_middlename, $landlord_homeaddress
//         ]);
//         return $conn->lastInsertId(); 
//     } catch (PDOException $e) {
//         die("Database Error: " . $e->getMessage());
//     }
// }

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


//  public function tenant_as_landlord($tenant_email){
//         $sql = "SELECT landlord_id FROM landlord WHERE landlord_email = ?";
//         $stmt = $this->connect()->prepare($sql);
//         $stmt->execute([$tenant_email]);
//         $existing_landlord = $stmt->fetch();
//         return $existing_landlord;
//     }


// public function tenant_as_landlord_insert($landlord_username, $landlord_password, $landlord_email, $landlord_mobile){
//         $myhash = password_hash($landlord_password, PASSWORD_DEFAULT);
//         $conn = $this->connect();
//         $sql = "INSERT INTO landlord(landlord_username, landlord_password, landlord_email,landlord_mobile) VALUES(?,?,?,?)";
//         $stmt = $conn->prepare($sql);

//         try{
//             $stmt->execute([$landlord_username, $myhash, $landlord_email, $landlord_mobile]);
//             return $conn->lastInsertId();
           
//         } catch(PDOException $e){
//              echo "insert failed: " .$e->getMessage();  
//              return false; 
//             }
//     }










// public function landlord_as_tenant_insert(
  
//     $tenant_username,
//     $tenant_password,
//     $tenant_email,
//     $tenant_mobile,
//     $tenant_surname,
//     $tenant_firstname,
//     $tenant_middlename,
//     $tenant_permanent_homeaddress,
//     $picture1
// ) {
//     $conn = $this->connect();

//     try {
//         // Step 1: Check if tenant already exists by email
//         $sql = "SELECT tenant_id FROM tenant WHERE tenant_email = ?";
//         $stmt = $conn->prepare($sql);
//         $stmt->execute([$tenant_email]);
//         $existingTenant = $stmt->fetch(PDO::FETCH_ASSOC);

//         if ($existingTenant) {
//             $tenant_id = $existingTenant['tenant_id'];
//         } else {
//             // Step 2: Insert new tenant
//             $myhash = password_hash($tenant_password, PASSWORD_DEFAULT);
//             $sql = "INSERT INTO tenant (
//                         tenant_username,
//                         tenant_password,
//                         tenant_email,
//                         tenant_mobile,
//                         tenant_surname,
//                         tenant_firstname,
//                         tenant_middlename,
//                         tenant_permanent_homeaddress,
//                         tenant_passport,
//                         profile_completed,
//                         landlord_as_tenant
//                     ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 1, 1)";
//             $stmt = $conn->prepare($sql);
//             $stmt->execute([
//                 $tenant_username,
//                 $myhash,
//                 $tenant_email,
//                 $tenant_mobile,
//                 $tenant_surname,
//                 $tenant_firstname,
//                 $tenant_middlename,
//                 $tenant_permanent_homeaddress,
//                 $picture1
//             ]);
//             $tenant_id = $conn->lastInsertId();
//         }

//         // Step 3: Update landlord record
//         $sql = "UPDATE landlord SET tenant_as_landlord = 1, WHERE tenant_id = ?";
//         $stmt = $conn->prepare($sql);
//         $stmt->execute([$tenant_id]);

//         return $tenant_id;

//     } catch (PDOException $e) {
//         error_log("Landlord as tenant insert failed: " . $e->getMessage());
//         return false;
//     }
// }






























   

    
    // Update tenant or tenant profile
    public function update_tenant_profile($user_id, $name, $email, $phone)
    {
        $stmt = $this->connect()->prepare("
            UPDATE users
            SET name = ?, email = ?, phone = ?
            WHERE user_id = ?
        ");
        return $stmt->execute([$name, $email, $phone, $user_id]);
    }
    

    public function getlandlordById($landlord_id) {
    $sql = "SELECT * FROM landlord WHERE landlord_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$landlord_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


public function getsingleLandlordById($landlord_id) {
     $conn = $this->connect();
    $sql = "SELECT * FROM landlord WHERE landlord_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$landlord_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
   

 }

 








?>
