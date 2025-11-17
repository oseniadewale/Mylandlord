<?php 

include_once __DIR__ ."/Db.php";



 class Tenant extends Db{
 private $dbconn;


 public function tenant_full_reg(
    $tenant_username, 
    $tenant_password, 
    $tenant_email, 
    $tenant_mobile,
    $tenant_surname, 
    $tenant_firstname,
    $tenant_middlename, 
    $tenant_permanent_homeaddress,
    $tenant_passport,
    $tenant_id
) {
    $hash = password_hash($tenant_password, PASSWORD_DEFAULT);
    

    $sql = "UPDATE tenant 
            SET tenant_username = ?, 
                tenant_password = ?, 
                tenant_email = ?, 
                tenant_mobile = ?, 
                tenant_surname = ?, 
                tenant_firstname = ?, 
                tenant_middlename = ?, 
                tenant_permanent_homeaddress = ?, 
                tenant_passport = ?,
                profile_completed = 1
            WHERE tenant_id = ?";

    $stmt = $this->connect()->prepare($sql);

    try {
        $ok = $stmt->execute([
            $tenant_username, 
            $hash,
            $tenant_email, 
            $tenant_mobile, 
            $tenant_surname, 
            $tenant_firstname,
            $tenant_middlename, 
            $tenant_permanent_homeaddress,
            $tenant_passport,
            $tenant_id
        ]);

        if ($ok) {
            return $tenant_id;  // ✅ return id if execute() ran, regardless of rowCount()
        } else {
            return false;
        }

    } catch (PDOException $e) {
        die("Database Error: " . $e->getMessage());
    }
}


// public function tenant_full_reg(
//     $tenant_username, 
//     $tenant_password, 
//     $tenant_email, 
//     $tenant_mobile,
//     $tenant_surname, 
//     $tenant_firstname,
//     $tenant_middlename,
//     $tenant_permanent_homeaddress,
//     $tenant_id
// ) {
//     $conn = $this->connect();
//     $hash = password_hash($tenant_password, PASSWORD_DEFAULT);

//     $sql = "UPDATE tenant 
//             SET tenant_username = ?, 
//                 tenant_password = ?, 
//                 tenant_email = ?, 
//                 tenant_mobile = ?, 
//                 tenant_surname = ?, 
//                 tenant_firstname = ?, 
//                 tenant_middlename = ?, 
//                 permanent_home_address = ?, 
//                 profile_completed = 1
//             WHERE tenant_id = ?";

//     $stmt = $conn->prepare($sql);

//     try {
//         $stmt->execute([
//             $tenant_username, 
//             $hash,
//             $tenant_email, 
//             $tenant_mobile, 
//             $tenant_surname, 
//             $tenant_firstname,
//             $tenant_middlename, 
//             $tenant_permanent_homeaddress,
//             $tenant_id
//         ]);

//         // ✅ Check if update really happened
//         if ($stmt->rowCount() > 0) {
//             return $tenant_id;
//         } else {
//             return false; // nothing updated (maybe wrong tenant_id)
//         }

//     } catch (PDOException $e) {
//         die("Database Error: " . $e->getMessage());
//     }
// }


// public function tenant_full_reg(
//     $tenant_username, 
//     $tenant_password, 
//     $tenant_email, 
//     $tenant_mobile,
//     $tenant_surname, 
//     $tenant_firstname,
//     $tenant_middlename,
//     $tenant_permanent_homeaddress,
//     $tenant_id // ← this identifies which row to update
// ) {
//     $conn = $this->connect();
//     $hash = password_hash($tenant_password, PASSWORD_DEFAULT);

//     $sql = "UPDATE tenant 
//             SET tenant_username = ?, 
//                 tenant_password = ?, 
//                 tenant_email = ?, 
//                 tenant_mobile = ?, 
//                 tenant_surname = ?, 
//                 tenant_firstname = ?, 
//                 tenant_middlename = ?, 
//                 permanent_home_address = ?, 
//                 profile_completed = 1
//             WHERE tenant_id = ?";

//     $stmt = $conn->prepare($sql);

//     try {
//         $stmt->execute([
//             $tenant_username, 
//             $hash,
//             $tenant_email, 
//             $tenant_mobile, 
//             $tenant_surname, 
//             $tenant_firstname,
//             $tenant_middlename, 
//             $tenant_permanent_homeaddress,
//             $tenant_id
//         ]);

//         return $tenant_id;

//     } catch (PDOException $e) {
//         die("Database Error: " . $e->getMessage());
//     }
// }


    

    // public function tenant_full_reg($tenant_username, $tenant_password, $tenant_email, $tenant_mobile,$tenant_surname, $tenant_firstname,$tenant_middlename,$tenant_permanent_homeaddress){
    //     $hash = password_hash($tenant_password, PASSWORD_DEFAULT);
    //         $conn = $this->connect();
    //       $sql = "INSERT INTO tenant (tenant_username, tenant_password,tenant_email, tenant_mobile, tenant_surname, tenant_firstname, tenant_middlename , permanent_home_address) VALUES(?,?, ?, ?, ?,?,?, ?)";
    //      $stmt = $conn->prepare($sql);
      
      
    //      try{
    //         $stmt->execute([$tenant_username, $hash,$tenant_email, $tenant_mobile, $tenant_surname, $tenant_firstname,$tenant_middlename, $tenant_permanent_homeaddress]);
    //      return $conn->lastInsertId();
    //     } 
           
    //      catch(  PDOException $e){
    //   die("Database Error: " . $e->getMessage());

       
    // }
    // }


//     public function tenant_full_reg(
//     $tenant_username, 
//     $tenant_password, 
//     $tenant_email, 
//     $tenant_mobile,
//     $tenant_surname, 
//     $tenant_firstname,
//     $tenant_middlename,
//     $tenant_permanent_homeaddress
// ) {
//     $hash = password_hash($tenant_password, PASSWORD_DEFAULT);
//     $conn = $this->connect();

//     $sql = "UPDATE SET tenant (
//                 tenant_username, 
//                 tenant_password,
//                 tenant_email, 
//                 tenant_mobile, 
//                 tenant_surname, 
//                 tenant_firstname, 
//                 tenant_middlename, 
//                 permanent_home_address
//             ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
//     $stmt = $conn->prepare($sql);

//     try {
//         // Insert tenant
//         $stmt->execute([
//             $tenant_username, 
//             $hash,
//             $tenant_email, 
//             $tenant_mobile, 
//             $tenant_surname, 
//             $tenant_firstname,
//             $tenant_middlename, 
//             $tenant_permanent_homeaddress
//         ]);

//         // Get inserted tenant_id
//         $tenant_id = $conn->lastInsertId();

//         // Mark profile as completed
//         $updateSql = "UPDATE tenant SET profile_completed = 1 WHERE tenant_id = ?";
//         $updateStmt = $conn->prepare($updateSql);
//         $updateStmt->execute([$tenant_id]);

//         return $tenant_id;

//     } catch (PDOException $e) {
//         die("Database Error: " . $e->getMessage());
//     }
// }


//     public function nysc_full_reg($tenant_username, $tenant_password, $tenant_email, $tenant_mobile, $tenant_surname, $tenant_firstname, $tenant_middlename,$tenant_homeaddress, $picture1, $user_type, $tenant_serving_state){

//          $hash = password_hash($tenant_password, PASSWORD_DEFAULT);
//            $conn = $this->connect();

//              assert_global_uniqueness($conn, $tenant_username, $tenant_email, $tenant_mobile);

       
// $sql = "INSERT INTO tenant (tenant_username, tenant_password,tenant_email, tenant_mobile, tenant_surname, tenant_firstname, tenant_middlename , tenant_permanent_home_address,tenant_passport_photo, user_type,nysc_state,profile_completed) VALUES (?,?, ?,?, ?, ?,?,?,?,?,?,1)";

//   $stmt = $conn->prepare($sql);
        
//             $stmt->execute([$tenant_username, $hash,$tenant_email, $tenant_mobile, $tenant_surname, $tenant_firstname,$tenant_middlename, $tenant_homeaddress, $picture1, $user_type,$tenant_serving_state]);
//          return $conn->lastInsertId();
    
    
    

//     }


public function nysc_full_reg(
    $tenant_username,
    $tenant_password,
    $tenant_email,
    $tenant_mobile,
    $tenant_surname,
    $tenant_firstname,
    $tenant_middlename,
    $tenant_homeaddress,
    $picture1,
    $user_type,
    $tenant_serving_state
){
    $hash = password_hash($tenant_password, PASSWORD_DEFAULT);
    $conn = $this->connect();

    // call the uniqueness checker as a class method
    $this->assert_global_uniqueness($conn, $tenant_username, $tenant_email, $tenant_mobile);

    $sql = "INSERT INTO tenant 
      (tenant_username, tenant_password, tenant_email, tenant_mobile, tenant_surname, tenant_firstname, tenant_middlename, tenant_permanent_homeaddress, tenant_passport, user_type, nysc_state, profile_completed) 
      VALUES (?,?,?,?,?,?,?,?,?,?,?,1)";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        $tenant_username,
        $hash,
        $tenant_email,
        $tenant_mobile,
        $tenant_surname,
        $tenant_firstname,
        $tenant_middlename,
        $tenant_homeaddress,
        $picture1,
        $user_type,
        $tenant_serving_state
    ]);

    return $conn->lastInsertId();
}

// add this method to your class
private function assert_global_uniqueness($conn, $tenant_username, $tenant_email, $tenant_mobile) {
    $sql = "SELECT 1 FROM tenant 
            WHERE tenant_username = ? 
               OR tenant_email = ? 
               OR tenant_mobile = ?
            LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$tenant_username, $tenant_email, $tenant_mobile]);
    if ($stmt->fetch()) {
        throw new Exception("Username, email or mobile already exists");
    }
}


    public function nysc_confirm($tenant_id){
        $sql = "SELECT user_type, start_date FROM tenant WHERE tenant_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$tenant_id]);
        $tenant = $stmt->fetch();
        return $tenant;
    }

    public function landlord_as_tenant($landlord_email){
        $sql = "SELECT tenant_id FROM tenant WHERE tenant_email = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$landlord_email]);
        $existingTenant = $stmt->fetch();
        return $existingTenant;
    }

    // public function landlord_as_tenant_insert($tenant_username, $tenant_password, $tenant_email, $tenant_mobile){
    //     $myhash = password_hash($tenant_password, PASSWORD_DEFAULT);
    //     $conn = $this->connect();
    //     $sql = "INSERT INTO tenant(tenant_username, tenant_password, tenant_email,tenant_mobile) VALUES(?,?,?,?)";
    //     $stmt = $conn->prepare($sql);

    //     try{
    //         $stmt->execute([$tenant_username, $myhash, $tenant_email, $tenant_mobile]);
    //         return $conn->lastInsertId();
           
    //     } catch(PDOException $e){
    //          echo "insert failed: " .$e->getMessage();  
    //          return false; 
    //         }
    // }


//     public function landlord_as_tenant_insert($tenant_username,
//         $tenant_password,
//         $tenant_email,
//         $tenant_mobile,
//         $tenant_surname,
//         $tenant_firstname,
//         $tenant_middlename,
//         $tenant_permanent_homeaddress,
//         $picture1,
//         ) {
//     $conn = $this->connect();

//     try {
//         // Step 1: Check if tenant already exists by email
//         $sql = "SELECT tenant_id FROM tenant WHERE tenant_email = ?";
//         $stmt = $conn->prepare($sql);
//         $stmt->execute([$tenant_email]);
//         $existingTenant = $stmt->fetch(PDO::FETCH_ASSOC);

//         if ($existingTenant) {
//             // Already exists, return existing tenant_id
//             return $existingTenant['tenant_id'];
//         }

//         // Step 2: Insert new tenant
//         $myhash = password_hash($tenant_password, PASSWORD_DEFAULT);
//         $sql = "INSERT INTO tenant (tenant_username, tenant_password, tenant_email, tenant_mobile,tenant_surname,tenant_firstname,tenant_middlename,tenant_permanent_homeaddress,profile_completed) 
//                 VALUES (?, ?, ?,?,?,?,?,?,?,?,1)";
//         $stmt = $conn->prepare($sql);
//         $stmt->execute([$tenant_username,
//         $myhash,
//         $tenant_email,
//         $tenant_mobile,
//         $tenant_surname,
//         $tenant_firstname,
//         $tenant_middlename,
//         $tenant_permanent_homeaddress,
//         $picture1,
//     ]);

//         // return $conn->lastInsertId();

//     } catch (PDOException $e) {
//         error_log("Landlord as tenant insert failed: " . $e->getMessage());
//         return false;
//     }
// }


public function landlord_as_tenant_insert(
  
    $tenant_username,
    $tenant_password,
    $tenant_email,
    $tenant_mobile,
    $tenant_surname,
    $tenant_firstname,
    $tenant_middlename,
    $tenant_permanent_homeaddress,
    $picture1
) {
    $conn = $this->connect();

    try {
        // Step 1: Check if tenant already exists by email
        $sql = "SELECT tenant_id FROM tenant WHERE tenant_email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$tenant_email]);
        $existingTenant = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingTenant) {
            $tenant_id = $existingTenant['tenant_id'];
        } else {
            // Step 2: Insert new tenant
            $myhash = password_hash($tenant_password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO tenant (
                        tenant_username,
                        tenant_password,
                        tenant_email,
                        tenant_mobile,
                        tenant_surname,
                        tenant_firstname,
                        tenant_middlename,
                        tenant_permanent_homeaddress,
                        tenant_passport,
                        profile_completed,
                        landlord_as_tenant
                    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 1, 1)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                $tenant_username,
                $myhash,
                $tenant_email,
                $tenant_mobile,
                $tenant_surname,
                $tenant_firstname,
                $tenant_middlename,
                $tenant_permanent_homeaddress,
                $picture1
            ]);
            $tenant_id = $conn->lastInsertId();
        }

        // Step 3: Update landlord record
        $sql = "UPDATE landlord SET tenant_as_landlord = 1, WHERE tenant_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$tenant_id]);

        return $tenant_id;

    } catch (PDOException $e) {
        error_log("Landlord as tenant insert failed: " . $e->getMessage());
        return false;
    }
}



    public function authenticate($username, $password) {
    $conn = $this->connect();
    $sql = "SELECT * FROM tenant WHERE tenant_username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$username]);
    $tenant = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($tenant && password_verify($password, $tenant["tenant_password"])) {
        return $tenant; // return full landlord data
    } else {
        return false;
    }
}

public function getTenantById($tenant_id) {
    $sql = "SELECT * FROM tenant WHERE tenant_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$tenant_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


public function nyscdonpay($tenant_id) {
    $sql = "UPDATE tenant 
            SET nysc_rent_start = NOW() 
            WHERE tenant_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$tenant_id]);
    return $stmt->rowCount(); // returns how many rows were updated
}

public function getsingleTenantById($tenant_id) {
     $conn = $this->connect();
    $sql = "SELECT * FROM tenant WHERE tenant_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$tenant_id]);
     return $stmt->fetch(PDO::FETCH_ASSOC);
}


   
}
