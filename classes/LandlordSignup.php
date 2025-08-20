<?php

include_once "Db.php";

class LandlordSignup extends Db{
    private $dbconn;


    public function landlord_signup($landlord_username, $landlord_password, $landlord_email, $landlord_mobile){
        $hashe = password_hash($landlord_password, PASSWORD_DEFAULT);


        $sql = "INSERT INTO landlord (landlord_username, landlord_password, landlord_email, landlord_mobile) VALUES(?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);


        try {
            $stmt->execute([$landlord_username, $hashe, $landlord_email, $landlord_mobile]);
        } catch ( PDOException $e) {

            $e->getMessage();

            echo "Error dey";

        }



    }
}

// $a = new LandlordSignup;









?>