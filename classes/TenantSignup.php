<?php
include_once "Db.php";
include_once "../helpers/Db_Unique.php";

class TenantSignup extends Db {

    public function tenant_signup($tenant_username, $tenant_password, $tenant_email, $tenant_mobile) {
        $hash = password_hash($tenant_password, PASSWORD_DEFAULT);
        $conn = $this->connect(); 

        // ✅ Let exceptions bubble up to process script
        assert_global_uniqueness($conn, $tenant_username, $tenant_email, $tenant_mobile);

        $sql = "INSERT INTO tenant 
                   (tenant_username, tenant_password, tenant_email, tenant_mobile, profile_completed) 
                VALUES (?, ?, ?, ?, 0)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$tenant_username, $hash, $tenant_email, $tenant_mobile]);

        return $conn->lastInsertId(); 
    }
}
?>
 