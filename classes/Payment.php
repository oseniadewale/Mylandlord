<?php 
include_once "Db.php";

class Payment extends Db{

    private $dbconn;


    public function addPayment($tenant_id, $house_id, $amount_paid, $reference_code, $status = 'pending') {
        $sql = "INSERT INTO payments (tenant_id, house_id, amount_paid, reference_code, payment_status, payment_date)
                VALUES (?, ?, ?, ?, ?, NOW())";

        $stmt = $this->connect()->prepare($sql);
        try {
            $stmt->execute([$tenant_id, $house_id, $amount_paid, $reference_code, $status]);
            return true;
        } catch (PDOException $e) {
            echo "Payment failed: " . $e->getMessage();
            return false;
        }
    }

     public function getPaymentsByTenant($tenant_id) {
        $sql = "SELECT 
                    payments.amount_paid, 
                    payments.payment_status, 
                    payments.payment_date, 
                    payments.reference_code, 
                    tenant.tenant_username,
                    house.house_type,
                    house.picture_1

                FROM payments 
                INNER JOIN house ON payments.house_id = house.house_id
                   
                INNER JOIN tenant ON payments.tenant_id = tenant.tenant_id
                WHERE payments.tenant_id = ?
                ORDER BY payments.payment_date DESC";

        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$tenant_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

 public function recordPayment($tenant_id, $house_id, $amount, $reference) {
        try {
            $sql = "INSERT INTO payments (tenant_id, house_id, amount_paid, reference_code, payment_status, payment_date) 
                    VALUES (:tenant_id, :house_id, :amount, :reference, :status, NOW())";

            $stmt = $this->connect()->prepare($sql);
            $status = "success"; // since Paystack verification already confirmed

            $success = $stmt->execute([
                ':tenant_id' => $tenant_id,
                ':house_id'  => $house_id,
                ':amount'    => $amount,
                ':reference' => $reference,
                ':status'    => $status
            ]);

            return $success;

        } catch (PDOException $e) {
            error_log("Payment insert error: " . $e->getMessage());
            return false;
        }
    }

    // Fetch all payments for a tenant
    public function getTenantPayments($tenant_id) {
        $sql = "SELECT p.*, h.house_type, h.location, h.actual_price
                FROM payments p
                JOIN houses h ON p.house_id = h.house_id
                WHERE p.tenant_id = :tenant_id
                ORDER BY p.created_at DESC";
        
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([':tenant_id' => $tenant_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    
}











?>