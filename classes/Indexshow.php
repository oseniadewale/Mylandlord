<?php 
include_once "Db.php";

class Indexshow extends Db {


public function Index_show($state, $lg, $price_id, $house_type) {
    $sql = "SELECT house.*, states.state_name, local_governments.lg_name, prices.price_range 
            FROM house
            INNER JOIN states ON house.state_id = states.state_id
            INNER JOIN local_governments ON house.lg_id = local_governments.lg_id
            INNER JOIN prices ON house.price_id = prices.price_id
            WHERE states.state_name = ?
              AND local_governments.lg_name = ?
              AND prices.price_id = ?
              AND house.house_type = ?";

    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$state, $lg, $price_id, $house_type]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


//     public function Index_show($state, $lg, $price_id, $house_type) {
//     $sql = "SELECT house.*, states.state_name, local_governments.lg_name, prices.price_range 
//             FROM house
//             INNER JOIN states ON house.state_id = states.state_id
//             INNER JOIN local_governments ON house.lg_id = local_governments.lg_id
//             INNER JOIN prices ON house.price_id = prices.price_id
//             WHERE states.state_name = ?
//               AND local_governments.lg_name = ?
//               AND prices.price_id = ?
//               AND house.house_type = ?";

//     $stmt = $this->connect()->prepare($sql);
//     $stmt->execute([$state, $lg, $price_id, $house_type]);
//     return $stmt->fetchAll(PDO::FETCH_ASSOC);
// }



// public function Index_show($state, $lg, $price_id, $house_type) {


// $sql = "SELECT states.state_name, local_governments.lg_name, prices.price_range, house.house_type 
//         FROM house
//          JOIN local_governments ON house.lg_id = local_governments.lg_id
//         JOIN states ON house.state_id = states.state_id
//         JOIN prices ON house.price_id = prices.price_id
//         WHERE states.state_name = ?
//           AND local_governments.lg_name = ?
//           AND prices.price_id = ?
//           AND house.house_type = ?";






    // $sql = "SELECT states.state_name, local_governments.lg_name, prices.price_range, house.house_type 
    //     FROM house
    //     JOIN local_governments ON house.lg_id = local_governments.lg_id
    //     JOIN states ON house.state_id = states.state_id
    //     JOIN prices ON house.price_id = prices.price_id
    //     WHERE states.state_name = ?
    //       AND local_governments.lg_name = ?
    //       AND prices.price_id = ?
    //       AND house.house_type = ?";



//  $sql = "SELECT house.*, 
//                    prices.price_range, 
//                    states.state_name, 
//                    local_governments.lg_name, 
//                    landlord.landlord_username AS LANDLORD
//             FROM house
//             LEFT JOIN prices ON house.price_id = prices.price_id
//             LEFT JOIN states ON house.state_id = states.state_id
//             LEFT JOIN local_governments ON house.lg_id = local_governments.lg_id
//             LEFT JOIN landlord ON house.landlord_id = landlord.landlord_id
//             WHERE house.landlord_id = ?";







//     $stmt = $this->connect()->prepare($sql);
//     $stmt->execute([$state, $lg, $price_id, $house_type]);
//     return $stmt->fetchAll(PDO::FETCH_ASSOC);
// }


   

}

?>

