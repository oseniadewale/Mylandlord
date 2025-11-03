<?php
session_start();
$base_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

include_once __DIR__ . "/header.php";


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
    
    // if ($updated) {
    //     $_SESSION['message'] = "House rent paid successfully.";
    // } else {
    //     $_SESSION['message'] =  "Failed to update house status.";
    // }

    $paymentObj = new Payment();
   $payment_success = $paymentObj->addPayment($tenant_id, $house_id, $amount, $reference, $status = 'completed');
    
   
   if($payment_success){
   echo "<div class='container-fluid alert alert-success mt-4'>
    <p class='me-3' style='color:brown'>
        <img src='images/success_icon.png' alt='icon' class='img-fluid me-1' style='width: 25px; height: 20px;'>
        Payment successful for the chosen house. 
        Your reference is <b style='color:blue'>{$reference}</b> 
        and the amount paid is <b style='color:blue'>₦" . number_format($amount) . "</b>.
    </p>
</div>";

   echo "<div class='container-fluid mt-4'>
   <p><span style='margin-right:3px'>Go back to dashboard here</span><a href='tenant_dashboard.php' class='btn btn-success'>←Back to dashboard</a></p>
   </div>";
    } else{
        echo "<div class='container-fluid alert alert-danger mt-4'>
        <p class='me-3' style='color:brown'><img src='images/error_icon.png' alt='icon' class='img-fluid me-2' style='width: 20px; height: 20px'> Payment not successful .</p>
        
        </div>";
         echo "<div class='container-fluid mt-4'>
   <p><span style='margin-right:3px'>Go back to dashboard here</span><a href='tenant_dashboard.php' class='btn btn-success'>←Back to dashboard</a></p>
   </div>";
    }
  
    // if ($payment_success) {

    //     echo "<div></div>";
    //     $_SESSION['payment_successful'] = "Payment status updated successfully."
    // } else {
    //     $_SESSION['error_payment'] =  "Failed to update payment status.";
    // }
}
// print_r("Reference $reference Tenant ID $tenant_id House ID $house_id Amount Paid $amount ". $_SESSION['message']);


 include_once __DIR__ . "/footer.php";

?>