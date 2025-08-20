<?php

include_once "Db.php";

class TenantSignup extends Db{
    private $dbconn;


    public function tenant_signup($tenant_username, $tenant_password, $tenant_email, $tenant_mobile){
        $hashe = password_hash($tenant_password, PASSWORD_DEFAULT);


        $sql = "INSERT INTO tenant (tenant_username, tenant_password, tenant_email, tenant_mobile) VALUES(?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);


        try {
            $stmt->execute([$tenant_username, $hashe, $tenant_email, $tenant_mobile]);
        } catch ( PDOException $e) {

            $e->getMessage();

            echo "Error dey";

        }



    }
}

// $a = new tenantSignup;









?>