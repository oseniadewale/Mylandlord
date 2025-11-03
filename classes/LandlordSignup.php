<?php
include_once "Db.php";
include_once "../helpers/Db_Unique.php";

class landlordSignup extends Db {

    public function landlord_signup($landlord_username, $landlord_password, $landlord_email, $landlord_mobile) {
        $hash = password_hash($landlord_password, PASSWORD_DEFAULT);
        $conn = $this->connect(); 

        // ✅ Let exceptions bubble up to process script
        assert_global_uniqueness($conn, $landlord_username, $landlord_email, $landlord_mobile);

        $sql = "INSERT INTO landlord 
                   (landlord_username, landlord_password, landlord_email, landlord_mobile, profile_completed) 
                VALUES (?, ?, ?, ?, 0)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$landlord_username, $hash, $landlord_email, $landlord_mobile]);

        return $conn->lastInsertId(); 
    }
}
?>
