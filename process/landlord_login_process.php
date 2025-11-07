<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// include_once $_SERVER['DOCUMENT_ROOT'] . "/mylandlord/classes/landlord.php";
include_once __DIR__ . "/../classes/Landlord.php";

if (isset($_POST["btn_landlord_login"])) {
    $username = trim($_POST["landlord_username"]);
    $password = trim($_POST["landlord_password"]);

    $landlord = new landlord();
    $landlord_data = $landlord->authenticate($username, $password);

    if ($landlord_data) {
        $_SESSION["landlord_id"] = $landlord_data["landlord_id"];
        $_SESSION["landlord_email"] = $landlord_data["landlord_email"];
        $_SESSION["landlord_username"] = $landlord_data["landlord_username"];
        $_SESSION["user_type"] = $landlord_data["user_type"] ?? "landlord"; // optional
        $_SESSION["landlord_mobile"] = $landlord_data["landlord_mobile"];
        $_SESSION["landlord_surname"] = $landlord_data["landlord_surname"];
        $_SESSION["landlord_firstname"] = $landlord_data["landlord_firstname"];
        $_SESSION["landlord_middlename"] = $landlord_data["landlord_middlename"];
        $_SESSION["landlord_permanent_homeaddress"] = $landlord_data["landlord_permanent_homeaddress"];

        $_SESSION["active_role"] = 'landlord';

        $_SESSION["landlord_as_tenant"] = $landlord_data["landlord_as_tenant"];


        // $_SESSION['active_role'] = 'landlord';

        if ($landlord_data['profile_completed'] == 0) {
            $_SESSION["incomplete_landlord_profile"] = "Please complete your profile to access your dashboard.";
            header("Location: ../work_landlord.php");
            exit();
        } else {

            header("Location: ../landlord_dashboard.php");
            exit();
        }
        // header("Location: ../landlord_dashboard.php");
        // exit();
    } else {
        // Set error and redirect back to login form
        $_SESSION["login_error"] = "Invalid login details. Try again se you hear.";
        header("Location: ../landlord_login.php");
        exit();
    }
}
ob_end_flush();
