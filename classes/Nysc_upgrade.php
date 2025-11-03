<?php
include_once "Db.php";
class NyscUpgrade extends Db {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Check if a user can upgrade
    public function canUpgrade($tenant_id, $userType, $rentStartDate) {
        if ($userType !== 'nysc') {
            return false;
        }

        $eligible = false;

        // Rule 1: Check if 12 months passed
        if (!empty($rentStartDate)) {
            $start = new DateTime($rentStartDate);
            $now = new DateTime();
            $interval = $start->diff($now);
            $months = $interval->y * 12 + $interval->m;

            if ($months >= 12) {
                $eligible = true;
            }
        }

        // Rule 2: Check admin override
        $stmt = $this->pdo->prepare("SELECT force_upgrade FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        $row = $stmt->fetch();

        if ($row && $row['force_upgrade'] == 1) {
            $eligible = true;
        }

        return $eligible;
    }
}
