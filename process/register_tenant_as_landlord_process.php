<?php
session_start();
include_once "../classes/landlord.php";

if ($_SERVER["REQUEST_METHOD"] === 'POST') {

    $landlord_username = htmlspecialchars($_POST["landlord_username"]);
    $landlord_email = htmlspecialchars($_POST["landlord_email"]);
    $landlord_mobile = htmlspecialchars($_POST["landlord_mobile"]);
    $landlord_password = $_POST["landlord_password"];

}

$landlord = new Landlord;

$landlord_id = $landlord->tenant_as_landlord_insert($landlord_username, $landlord_password, $landlord_email, $landlord_mobile);


if ($landlord_id) {
    $_SESSION['landlord_id'] = $landlord_id;
    $_SESSION["landlord_username"] = $landlord_username;
    header("Location: ../landlord_dashboard.php");
    exit();
} else {
    echo "landlord creation failed.";
}






?>