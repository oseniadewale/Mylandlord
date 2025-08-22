<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// include_once $_SERVER['DOCUMENT_ROOT'] . "/LANDLORD/classes/Tenant.php";
include_once("../classes/Tenant.php");
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

        header("Location: ../tenant_dashboard.php");
        exit();
    } else {
        // Set error and redirect back to login form
        $_SESSION["login_error"] = "Invalid login details. Try again.";
        header("Location: ../tenant_login.php");
        exit();
    }
}
ob_end_flush();
