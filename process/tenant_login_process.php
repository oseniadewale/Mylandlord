<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// include_once $_SERVER['DOCUMENT_ROOT'] . "/LANDLORD/classes/Tenant.php";
include_once __DIR__ . "/../classes/Tenant.php";

if (isset($_POST["btn_tenant_login"])) {
    $username = trim($_POST["tenant_username"]);
    $password = trim($_POST["tenant_password"]);

    $tenant = new Tenant();
    $tenant_data = $tenant->authenticate($username, $password);

    if ($tenant_data) {
        $_SESSION["tenant_id"]       = $tenant_data["tenant_id"];
        $_SESSION["tenant_email"]    = $tenant_data["tenant_email"];
        $_SESSION["tenant_username"] = $tenant_data["tenant_username"];
        $_SESSION["user_type"]       = $tenant_data["user_type"] ?? "tenant"; // optional
        $_SESSION["tenant_mobile"]   = $tenant_data["tenant_mobile"];
        $_SESSION["tenant_firstname"]   = $tenant_data["tenant_firstname"];
        $_SESSION["tenant_surname"]   = $tenant_data["tenant_surname"];
        $_SESSION["tenant_middlename"]   = $tenant_data["tenant_middlename"];
        $_SESSION["tenant_permanent_homeaddress"]   = $tenant_data["permanent_homeaddress"];
        $_SESSION['active_role'] = 'tenant';

          $_SESSION["tenant_as_landlord"] = $tenant_data["tenant_as_landlord"];

        // header("Location: ../tenant_dashboard.php");
        // exit();
// Assume $tenant is fetched from DB after login
if ($tenant_data['profile_completed'] == 0) {
        $_SESSION["incomplete_tenant_profile"] = "Please complete your profile to access your dashboard.";
    header("Location: ../work_tenant.php");
    exit();
} else {
    
    header("Location: ../tenant_dashboard.php");
    exit();
}



    } else {
        // Set error and redirect back to login form
        $_SESSION["login_error"] = "Invalid login details. Try again see you bro.";
        header("Location: ../tenant_login.php");
        exit();
    }
}
ob_end_flush();
