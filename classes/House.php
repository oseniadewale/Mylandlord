<?php


include_once __DIR__ ."/Db.php";



class House extends Db
{
    private $dbconn;


    public function uploadHouse($house_type, $price_id,
    $picture1, $picture2, $picture3, $picture4, $picture5, $picture6, $picture7,
    $location, $state_id, $lg_id, $landlord_id, $actual_price, $rent_duration, $features_string, $landlord_notice)
    {
        
        $state_name = $_POST["state"];
        $sqlstate = "SELECT state_id FROM states WHERE state_name = ?";
        $stmtstate = $this->connect()->prepare($sqlstate);
        $stmtstate->execute([$state_name]);
        $state_id = $stmtstate->fetchColumn();


        $lg_name = $_POST["lga"];
        $sqlg = "SELECT lg_id FROM local_governments WHERE lg_name = ?";
        $stmtlg = $this->connect()->prepare($sqlg);
        $stmtlg->execute([$lg_name]);
        $lg_id = $stmtlg->fetchColumn();







        $sql = "INSERT INTO house(house_type, price_id, picture_1, picture_2, picture_3, picture_4, picture_5, picture_6, picture_7,location, state_id, lg_id,landlord_id,actual_price,rent_duration,house_features, landlord_notice ) VALUES (?,?,?,?,?,?,?,?,?,?,?, ?, ?,?,?,?, ?)";
        $stmt = $this->connect()->prepare($sql);

        try {
          

              $stmt->execute([ $house_type, $price_id,
    $picture1, $picture2, $picture3, $picture4, $picture5, $picture6, $picture7,
    $location, $state_id, $lg_id, $landlord_id, $actual_price, $rent_duration, $features_string, $landlord_notice]);
       
       
       
        $house_id =  $this->connect()->lastInsertId(); 
       
          // fetch the full inserted row (including DB defaults)
        $sqlFetch = "SELECT * FROM house WHERE house_id = ?";
        $stmtFetch = $this->connect()->prepare($sqlFetch);
        $stmtFetch->execute([$house_id]);
        $row = $stmtFetch->fetch(PDO::FETCH_ASSOC);

        return $row; // now you get availability_status too

       
       
       
        } catch (PDOException $e) {
            die("DB Error: " . $e->getMessage());
        }
    }


//    public function getHousesByLandlord($landlord_id)
// {
//     $sql = "SELECT DISTINCT house.*, 
//                    prices.price_range, 
//                    states.state_name, 
//                    local_governments.lg_name, 
//                    tenant.tenant_username,
//                    landlord.landlord_username AS LANDLORD,
//                    payments.payment_date,
//                    payments.payment_status
//             FROM house
//             LEFT JOIN prices ON house.price_id = prices.price_id
//             LEFT JOIN states ON house.state_id = states.state_id
//             LEFT JOIN local_governments ON house.lg_id = local_governments.lg_id
//             LEFT JOIN landlord ON house.landlord_id = landlord.landlord_id
//             LEFT JOIN payments 
//                    ON payments.house_id = house.house_id
//                   AND payments.payment_status = 'completed'
//             LEFT JOIN tenant 
//                    ON tenant.tenant_id = payments.tenant_id
//             WHERE house.landlord_id = ?
//             ORDER BY house.house_id DESC, payments.payment_date DESC";

//     $stmt = $this->connect()->prepare($sql);
//     $stmt->execute([$landlord_id]);
//     return $stmt->fetchAll(PDO::FETCH_ASSOC);
// }
public function getHousesByLandlord($landlord_id)
{
    $sql = "
    SELECT house.*,
           prices.price_range,
           states.state_name,
           local_governments.lg_name,
           landlord.landlord_username AS landlord_username,
           latest_payments.payment_date,
           latest_payments.payment_status,
           tenant.tenant_username
    FROM house
    LEFT JOIN prices 
        ON house.price_id = prices.price_id
    LEFT JOIN states 
        ON house.state_id = states.state_id
    LEFT JOIN local_governments 
        ON house.lg_id = local_governments.lg_id
    LEFT JOIN landlord 
        ON house.landlord_id = landlord.landlord_id
    LEFT JOIN (
        SELECT payments.house_id,
               payments.payment_date,
               payments.payment_status,
               payments.tenant_id
        FROM payments
        INNER JOIN (
            SELECT house_id, MAX(payment_date) AS latest_payment_date
            FROM payments
            WHERE payment_status = 'completed'
            GROUP BY house_id
        ) AS latest 
        ON payments.house_id = latest.house_id 
        AND payments.payment_date = latest.latest_payment_date
    ) AS latest_payments 
        ON latest_payments.house_id = house.house_id
    LEFT JOIN tenant 
        ON tenant.tenant_id = latest_payments.tenant_id
    WHERE house.landlord_id = ?
    ORDER BY house.house_id DESC;
    ";

    $statement = $this->connect()->prepare($sql);
    $statement->execute([$landlord_id]);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}


    public function getHouseById($tenant_id){
        $sql = "SELECT house.*, states.state_name, local_governments.lg_name
        FROM house
        LEFT JOIN states ON house.state_id = states.state_id
        LEFT JOIN local_governments ON house.lg_id = local_governments.lg_id
        

        WHERE house_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$tenant_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    

    public function getAvailableHouses() {
        $conn = $this->connect();

        $sql =  "SELECT 
            house.*, 
            states.state_name, 
            local_governments.lg_name, 
            landlord.landlord_username
        FROM house
        JOIN states 
            ON house.state_id = states.state_id
        JOIN local_governments 
            ON house.lg_id = local_governments.lg_id
        JOIN landlord 
            ON house.landlord_id = landlord.landlord_id
        WHERE house.availability_status = 'available' ";

            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $houses = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $houses;
    }

    public function getRecentAvailableHouses($limit = 10) {
        $sql = "SELECT * FROM house 
                WHERE availability_status = 'available' 
                ORDER BY house_id DESC 
                LIMIT ?";
        
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindValue(1, (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    public function getPaginatedHouses($limit, $offset) {
        $stmt = $this->connect()->prepare("
            SELECT house.*, landlord_username, state_name, lg_name
            FROM house
            LEFT JOIN landlord ON house.landlord_id = landlord.landlord_id
            LEFT JOIN states ON house.state_id = states.state_id
            LEFT JOIN local_governments ON house.lg_id = local_governments.lg_id
            ORDER BY house.house_id DESC
            LIMIT ? OFFSET ?
        ");
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->bindValue(2, $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countAllHouses() {
        $stmt = $this->connect()->query("SELECT COUNT(*) AS total FROM house");
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function deleteHouse($house_id) {
        $stmt = $this->connect()->prepare("DELETE FROM house WHERE house_id = ?");
        return $stmt->execute([$house_id]);
    }

    public function updateHouseStatus($house_id, $house_payment, $availability_status) {
        $sql = "UPDATE house 
                SET house_payment = ?, availability_status = ? 
                WHERE house_id = ?";
        $stmt = $this->connect()->prepare($sql);
        try {
            return $stmt->execute([$house_payment, $availability_status, $house_id]);
        } catch (PDOException $e) {
            die("DB Error: " . $e->getMessage());
        }
    }


     public function get_more_details_on_house($house_id){
        $sql = "SELECT house.*,states.state_name, local_governments.lg_name,landlord.landlord_username, landlord_mobile
        FROM house
        LEFT JOIN states ON house.state_id = states.state_id
        LEFT JOIN local_governments ON house.lg_id = local_governments.lg_id
         LEFT JOIN landlord ON house.landlord_id = landlord.landlord_id
        

        WHERE house_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$house_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


  public function searchHouses($searchKey, $limit, $offset) {
    $conn = $this->connect(); // PDO connection

    // Add wildcards
    $searchKey = "%$searchKey%";

    // Force integers (safety)
    $limit = (int)$limit;
    $offset = (int)$offset;

    $sql = "SELECT house.*, landlord.landlord_username, landlord_firstname, landlord_surname, landlord_mobile, states.state_name, local_governments.lg_name
            FROM house
            JOIN landlord ON house.landlord_id = landlord.landlord_id
            JOIN states ON house.state_id = states.state_id
            JOIN local_governments ON house.lg_id = local_governments.lg_id
            WHERE house.location LIKE ? 
               OR house.house_type LIKE ? 
               OR landlord.landlord_username LIKE ? 
                OR landlord.landlord_firstname LIKE ? 
                 OR landlord.landlord_mobile LIKE ? 
               OR states.state_name LIKE ? 
               OR local_governments.lg_name LIKE ?
            ORDER BY house.house_id DESC
            LIMIT $limit OFFSET $offset";  // insert directly

    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$searchKey, $searchKey, $searchKey,$searchKey,$searchKey, $searchKey, $searchKey]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


public function countSearchHouses($searchKey) {
    $conn = $this->connect();

    $searchKey = "%$searchKey%";

    $sql = "SELECT COUNT(*) as total
            FROM house
            JOIN landlord ON house.landlord_id = landlord.landlord_id
            JOIN states ON house.state_id = states.state_id
            JOIN local_governments ON house.lg_id = local_governments.lg_id
            WHERE house.location LIKE ? 
               OR house.house_type LIKE ? 
               OR landlord.landlord_username LIKE ? 
               OR landlord.landlord_firstname LIKE ? 
                 OR landlord.landlord_mobile LIKE ? 
               OR states.state_name LIKE ? 
               OR local_governments.lg_name LIKE ?";

    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$searchKey, $searchKey, $searchKey,$searchKey,$searchKey, $searchKey, $searchKey]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row['total'];
}


}















?>
