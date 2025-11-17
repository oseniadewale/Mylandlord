<?php
include_once __DIR__."/Db.php";


class Payment extends Db
{

    private $dbconn;


    public function addPayment($tenant_id, $house_id, $amount_paid, $reference_code, $status = 'pending')
    {
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

    // public function getPaymentsByTenant($tenant_id)
    // {
    //     $sql = "SELECT 
    //                 payments.amount_paid, 
    //                 payments.payment_status, 
    //                 payments.payment_date, 
    //                 payments.reference_code, 
    //                 landlord.landlord_username,
    //                 landlord.landlord_mobile,
    //                 tenant.tenant_username,
    //                 house.house_type,
    //                   house.house_features,
    //                     house.landlord_notice,
    //                 house.location,
    //                 house.picture_1,
    //                   states.state_name,
    //             local_governments.lg_name

    //             FROM payments 
    //             INNER JOIN house ON payments.house_id = house.house_id
                   
    //             INNER JOIN tenant ON payments.tenant_id = tenant.tenant_id
    //             LEFT JOIN landlord ON house.landlord_id = landlord.landlord_id
    //              LEFT JOIN states 
    //             ON house.state_id = states.state_id
    //         LEFT JOIN local_governments 
    //             ON house.lg_id = local_governments.lg_id
                
    //             WHERE payments.tenant_id = ?
    //             ORDER BY payments.payment_date DESC";

    //     $stmt = $this->connect()->prepare($sql);
    //     $stmt->execute([$tenant_id]);
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }

    public function getPaymentsByTenant($tenant_id)
{
    $sql = "
        SELECT 
            payments.amount_paid, 
            payments.payment_status, 
            payments.payment_date, 
            payments.reference_code, 
            landlord.landlord_username,
            landlord.landlord_mobile,
            tenant.tenant_username,
            house.house_type,
            house.house_features,
            house.landlord_notice,
            house.location,
            house.picture_1,
            states.state_name,
            local_governments.lg_name
        FROM payments
        INNER JOIN house ON payments.house_id = house.house_id
        INNER JOIN tenant ON payments.tenant_id = tenant.tenant_id
        LEFT JOIN landlord ON house.landlord_id = landlord.landlord_id
        LEFT JOIN states ON house.state_id = states.state_id
        LEFT JOIN local_governments ON house.lg_id = local_governments.lg_id
        WHERE payments.tenant_id = ?
          AND payments.payment_date = (
              SELECT MAX(payment_date)
              FROM payments
              WHERE tenant_id = payments.tenant_id
                AND house_id = payments.house_id
          )
        ORDER BY payments.payment_date DESC
    ";

    $statement = $this->connect()->prepare($sql);
    $statement->execute([$tenant_id]);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}


    public function recordPayment($tenant_id, $house_id, $amount, $reference)
    {
        try {
            $sql = "INSERT INTO payments (tenant_id, house_id, amount_paid, reference_code, payment_status, payment_date) 
                    VALUES (:tenant_id, :house_id, :amount, :reference, :status, NOW())";

            $stmt = $this->connect()->prepare($sql);
            $status = "success"; // since Paystack verification already confirmed

            $success = $stmt->execute([
                ':tenant_id' => $tenant_id,
                ':house_id' => $house_id,
                ':amount' => $amount,
                ':reference' => $reference,
                ':status' => $status
            ]);

            return $success;

        } catch (PDOException $e) {
            error_log("Payment insert error: " . $e->getMessage());
            return false;
        }
    }

    // Fetch all payments for a tenant
    public function getTenantPayments($tenant_id)
    {
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
