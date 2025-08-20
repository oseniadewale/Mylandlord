<?php 
 include_once "Db.php";


 class Tenant extends Db{
 private $dbconn;

    

    public function tenant_full_reg($tenant_username, $tenant_password, $tenant_email, $tenant_mobile,$tenant_surname, $tenant_firstname,$tenant_middlename,$tenant_permanent_homeaddress){
        $hash = password_hash($tenant_password, PASSWORD_DEFAULT);
            $conn = $this->connect();
          $sql = "INSERT INTO tenant (tenant_username, tenant_password,tenant_email, tenant_mobile, tenant_surname, tenant_firstname, tenant_middlename , permanent_home_address) VALUES(?,?, ?, ?, ?,?,?, ?)";
         $stmt = $conn->prepare($sql);
      
      
         try{
            $stmt->execute([$tenant_username, $hash,$tenant_email, $tenant_mobile, $tenant_surname, $tenant_firstname,$tenant_middlename, $tenant_permanent_homeaddress]);
         return $conn->lastInsertId();
        } 
           
         catch(  PDOException $e){
      die("Database Error: " . $e->getMessage());

       
    }
    }

    public function nysc_full_reg($tenant_username, $tenant_password, $tenant_email, $tenant_mobile, $tenant_surname, $tenant_firstname, $tenant_middlename,$tenant_homeaddress, $user_type){

         $hash = password_hash($tenant_password, PASSWORD_DEFAULT);
           $conn = $this->connect();
       
$sql = "INSERT INTO tenant (tenant_username, tenant_password,tenant_email, tenant_mobile, tenant_surname, tenant_firstname, tenant_middlename , permanent_home_address, user_type) VALUES (?, ?, ?, ?,?,?,?,?,?)";

  $stmt = $conn->prepare($sql);
         try{
            $stmt->execute([$tenant_username, $hash,$tenant_email, $tenant_mobile, $tenant_surname, $tenant_firstname,$tenant_middlename, $tenant_homeaddress, $user_type]);
         return $conn->lastInsertId();
        } catch(  PDOException $e){
        die("Database Error: " . $e->getMessage());

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

    public function landlord_as_tenant_insert($tenant_username, $tenant_password, $tenant_email, $tenant_mobile){
        $myhash = password_hash($tenant_password, PASSWORD_DEFAULT);
        $conn = $this->connect();
        $sql = "INSERT INTO tenant(tenant_username, tenant_password, tenant_email,tenant_mobile) VALUES(?,?,?,?)";
        $stmt = $conn->prepare($sql);

        try{
            $stmt->execute([$tenant_username, $myhash, $tenant_email, $tenant_mobile]);
            return $conn->lastInsertId();
           
        } catch(PDOException $e){
             echo "insert failed: " .$e->getMessage();  
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


   
}