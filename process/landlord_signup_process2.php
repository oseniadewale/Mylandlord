<?php
session_start();



require_once "../classes/config.php";
include_once "../classes/LandlordSignup2.php";

$base_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

include_once __DIR__ . "/header.php";


include_once("../header.php");





$mysignup = new LandlordSignup2;






if (!isset($_SESSION['valid_signup'])) {
    echo "Unauthorized access.";
    exit();
}

$data = $_SESSION['valid_signup'];
unset($_SESSION['valid_signup']); // Destroy after use

// Sanitize
$username = htmlspecialchars($data['username']);
$password = htmlspecialchars($data['password']);
$email = htmlspecialchars($data['email']);
$mobile = htmlspecialchars($data['mobile']);

$signup = new LandlordSignup2;
$signup->landlord_signup($username, $password, $email, $mobile);
?>


<div class="container mt-5">
    <h2>Signup Successful</h2>
    <p class="text-success">Congratulations <strong><?= $username ?></strong>, your landlord account has been created!</p>
</div>






<?php 

include_once "../footer.php";
?>

