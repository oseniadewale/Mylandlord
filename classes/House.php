<?php

include_once "Db.php";



class House extends Db
{
    private $dbconn;


    public function uploadHouse($house_type, $price_id, $picture_path, $location, $state_id, $lg_id, $landlord_id,$actual_price, $rent_duration, $features_string)
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







        $sql = "INSERT INTO house(house_type, price_id, picture_1,location, state_id, lg_id,landlord_id,actual_price,rent_duration,house_features ) VALUES (?,?,?,?, ?, ?,?,?,?, ?)";
        $stmt = $this->connect()->prepare($sql);

        try {
            $stmt->execute([$house_type, $price_id, $picture_path, $location, $state_id, $lg_id, $landlord_id,$actual_price, $rent_duration, $features_string]);
        } catch (PDOException $e) {
            die("DB Error: " . $e->getMessage());
        }
    }


    public function getHousesByLandlord($landlord_id)
    {
        $sql = "SELECT house.*, 
                   prices.price_range, 
                   states.state_name, 
                   local_governments.lg_name, 
                   landlord.landlord_username AS LANDLORD
            FROM house
            LEFT JOIN prices ON house.price_id = prices.price_id
            LEFT JOIN states ON house.state_id = states.state_id
            LEFT JOIN local_governments ON house.lg_id = local_governments.lg_id
            LEFT JOIN landlord ON house.landlord_id = landlord.landlord_id
            WHERE house.landlord_id = ?";

        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$landlord_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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








}















?>