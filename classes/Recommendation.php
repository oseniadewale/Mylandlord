<?php
include_once "Db.php";
class Recommendation extends Db {
    private $dbcon;
    // public function __construct($db) {
    //     $this->dbcon = $db;
    // }

    // Check if landlord and tenant had a past rental relationship
    public function hasRentedBefore($landlord_id, $tenant_id) {
        $landlord_id = (int)$landlord_id;
        $tenant_id = (int)$tenant_id;

        $sql = "SELECT COUNT(*) AS total 
                FROM rentals 
                WHERE landlord_id = '$landlord_id' 
                  AND tenant_id = '$tenant_id' 
                  AND status = 'completed'";

        $result = $this->dbcon->query($sql);
        if ($result && $row = $result->fetch_assoc()) {
            return $row['total'] > 0;
        }
        return false;
    }

    // Save recommendation
    public function addRecommendation($recommender_id, $recommender_type, $target_id, $target_type, $message) {
        $recommender_id = (int)$recommender_id;
        $target_id = (int)$target_id;
        $recommender_type = $this->dbcon->real_escape_string($recommender_type);
        $target_type = $this->dbcon->real_escape_string($target_type);
        $message = $this->dbcon->real_escape_string($message);

        $sql = "INSERT INTO recommendations 
                (recommender_id, recommender_type, target_id, target_type, message) 
                VALUES ('$recommender_id', '$recommender_type', '$target_id', '$target_type', '$message')";

        return $this->dbcon->query($sql);
    }

    // Get all recommendations for a given target
    public function getRecommendationsForTarget($target_id, $target_type) {
        $target_id = (int)$target_id;
        $target_type = $this->dbcon->real_escape_string($target_type);

        $sql = "SELECT * FROM recommendations 
                WHERE target_id = '$target_id' 
                  AND target_type = '$target_type' 
                ORDER BY created_at DESC";

        return $this->dbcon->query($sql);
    }


    public function Fetch_Landlord_and_house_id($tenant_id){

         $conn = $this->connect();
          
      $sql = "SELECT rentals.*, landlord_username, house_type
        FROM rentals 
        JOIN landlord ON rentals.landlord_id = landlord.landlord_id
        JOIN house  ON rentals.house_id = house.house_id
        WHERE rentals.tenant_id = ?

        ORDER BY rentals.start_date DESC";

    $stmt = $conn->prepare($sql);

     $stmt->execute([$tenant_id]);

$result = $stmt->fetchAll();

return $result;

// $landlord_id = $house_id = null;
// if ($result && $row = $result->fetch_assoc()) {
//     $landlord_id = $row['landlord_id'];
//     $house_id = $row['house_id'];
// }
//     }
}

}
?>
