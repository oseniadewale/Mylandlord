<?php 





include_once __DIR__ ."/Db.php";


class Admin extends Db{


    private $dbconn;

     public function registerAdmin($admin_username, $admin_email, $admin_password, $role = 'moderator') {
          $hashedPassword = password_hash($admin_password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO admins (admin_username, admin_email, admin_password, admin_role) 
                VALUES (?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
      
        return $stmt->execute([$admin_username, $admin_email, $hashedPassword, $role]);
    }





    public function login($admin_username, $admin_password)
{
    $sql = "SELECT * FROM admins WHERE admin_username = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$admin_username]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    // If no admin found, return false
    if (!$admin) {
        return false;
    }

    // Check password
    if (password_verify($admin_password, $admin['admin_password'])) {
        return $admin;
    } else {
        return false;
    }
}

    public function getAllLandlords()
    {
        $sql = "SELECT * FROM landlord";
        return $this->connect()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteLandlord($id)
{
    $stmt = $this->connect()->prepare("DELETE FROM landlord WHERE landlord_id = ?");
    $stmt->execute([$id]);
}

    public function getAllTenants()
    {
        $sql = "SELECT * FROM tenant";
        return $this->connect()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

        public function deleteTenant($id)
{
    $stmt = $this->connect()->prepare("DELETE FROM tenant WHERE tenant_id = ?");
    $stmt->execute([$id]);
}

    public function getAllHouses()
    {
        $sql = "SELECT * FROM house";
        return $this->connect()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }


public function getTenantsWithLimit($limit, $offset) {
    $sql = "SELECT * FROM tenant ORDER BY date_registered DESC LIMIT :limit OFFSET :offset";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getTenantsCount() {
    $sql = "SELECT COUNT(*) AS total FROM tenant";
    $stmt = $this->connect()->query($sql);
    return (int) $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}

public function getLandlordCount() {
    $stmt = $this->connect()->prepare("SELECT COUNT(*) as count FROM landlord");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['count'];
}

public function getLandlordsPaginated($limit, $offset) {
    $stmt = $this->connect()->prepare("SELECT * FROM landlord ORDER BY date_registered DESC LIMIT :limit OFFSET :offset");
    $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


    


}










?>
