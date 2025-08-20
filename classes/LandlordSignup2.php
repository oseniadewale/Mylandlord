<?php
include_once "Db.php";

class LandlordSignup2 extends Db {
    private $dbconn;
    public function landlord_signup($username, $password, $email, $mobile) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO landlord (landlord_username, landlord_password, landlord_email, landlord_mobile)
                VALUES (?, ?, ?, ?)";

        $stmt = $this->connect()->prepare($sql);

        try {
            $stmt->execute([$username, $hashed, $email, $mobile]);
        } catch (PDOException $e) {
            echo "Signup error: " . $e->getMessage();
            exit();
        }
    }
}
