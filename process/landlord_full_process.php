<?php
session_start();
include_once "../classes/Landlord.php";

if (isset($_POST["landlord_full_btn"])) {
    $landlord_username   = htmlspecialchars($_POST["landlord_username"]);
    $landlord_password   = $_POST["landlord_password"];
    $landlord_email      = htmlspecialchars($_POST["landlord_email"]);
    $landlord_mobile     = htmlspecialchars($_POST["landlord_mobile"]);
    $landlord_surname    = htmlspecialchars($_POST["landlord_surname"]);
    $landlord_firstname  = htmlspecialchars($_POST["landlord_firstname"]);
    $landlord_middlename = htmlspecialchars($_POST["landlord_middlename"]);
    $landlord_homeaddress= htmlspecialchars($_POST["landlord_homeaddress"]);

    $landlord = new Landlord;

    $insertedId = $landlord->landlord_full_reg(
        $landlord_username, $landlord_password, $landlord_email, $landlord_mobile,
        $landlord_surname, $landlord_firstname, $landlord_middlename, $landlord_homeaddress
    );


    if ($insertedId) {
        
        $_SESSION["landlord_id"]      = $insertedId;
        $_SESSION["landlord_username"]= $landlord_username;
        $_SESSION["landlord_email"]   = $landlord_email;
        $_SESSION["landlord_mobile"]  = $landlord_mobile;

        header("Location: ../landlord_dashboard.php");
        exit();
    } else {
        echo "Registration failed.";
    }
}
 else {
    echo "Invalid access.";
    header("Location: ../landlord_full_register.php");
    exit();
}
