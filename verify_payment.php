<?php
session_start();
include_once("classes/Payment.php");
include_once("classes/House.php");

// Get reference from URL
if (!isset($_GET['reference'])) {
   

    $_SESSION["reference_error"] = "Payment transaction ID is missing. Do try again to initiate your transaction";
    
    header("location: available_houses.php");
    die(" No reference supplied.");
}
$reference = $_GET['reference']; //paystack transaction ID
$tenant_id = $_GET['tenant_id'];
$house_id  = $_GET['house_id'];
$amount = $_GET['amount']; // in Naira

if (isset($_GET['reference']) AND isset($_GET['tenant_id']) AND isset($_GET['house_id']) AND isset($_GET['amount'])) {
    $house_payment = 'approved'; // or 'unpaid'
    $availability_status = 'rented'; 
    $houseObj = new House();
    $updated = $houseObj->updateHouseStatus($house_id, $house_payment, $availability_status);
    
    if ($updated) {
        $_SESSION['message'] = "House status updated successfully.";
    } else {
        $_SESSION['message'] =  "Failed to update house status.";
    }

    $paymentObj = new Payment();
    $paymentObj->addPayment($tenant_id, $house_id, $amount, $reference, $status = 'completed');
    if ($updated) {
        $_SESSION['message'] = "Payment status updated successfully.";
    } else {
        $_SESSION['message'] =  "Failed to update payment status.";
    }
}
print_r("Reference $reference Tenant ID $tenant_id House ID $house_id Amount Paid $amount ". $_SESSION['message']);
?>