<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once $_SERVER['DOCUMENT_ROOT'] . "/LANDLORD/classes/landlord.php";

if (isset($_POST["btn_landlord_login"])) {
    $username = trim($_POST["landlord_username"]);
    $password = trim($_POST["landlord_password"]);

    $landlord = new landlord();
    $landlord_data = $landlord->authenticate($username, $password);

    if ($landlord_data) {
        $_SESSION["landlord_id"]       = $landlord_data["landlord_id"];
        $_SESSION["landlord_email"]    = $landlord_data["landlord_email"];
        $_SESSION["landlord_username"] = $landlord_data["landlord_username"];
        $_SESSION["user_type"]       = $landlord_data["user_type"] ?? "landlord"; // optional
        $_SESSION["landlord_mobile"]   = $landlord_data["landlord_mobile"];

        header("Location: ../landlord_dashboard.php");
        exit();
    } else {
        // Set error and redirect back to login form
        $_SESSION["login_error"] = "Invalid login details. Try again.";
        header("Location: ../landlord_login.php");
        exit();
    }
}
ob_end_flush();
