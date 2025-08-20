<?php
session_start();
include_once "../classes/tenant.php";

if (isset($_POST["tenant_full_btn"])) {
    $tenant_username   = htmlspecialchars($_POST["tenant_username"]);
    $tenant_password   = $_POST["tenant_password"];
    $tenant_email      = htmlspecialchars($_POST["tenant_email"]);
    $tenant_mobile     = htmlspecialchars($_POST["tenant_mobile"]);
    $tenant_surname    = htmlspecialchars($_POST["tenant_surname"]);
    $tenant_firstname  = htmlspecialchars($_POST["tenant_firstname"]);
    $tenant_middlename = htmlspecialchars($_POST["tenant_middlename"]);
    $tenant_permant_homeaddress= htmlspecialchars($_POST["tenant_permanent_homeaddress"]);

    $tenant = new Tenant;

    $insertedId = $tenant->tenant_full_reg(
        $tenant_username, $tenant_password, $tenant_email, $tenant_mobile,
        $tenant_surname, $tenant_firstname, $tenant_middlename, $tenant_permanent_homeaddress
    );


    if ($insertedId) {
        
        $_SESSION["tenant_id"]      = $insertedId;
        $_SESSION["tenant_username"]= $tenant_username;
        $_SESSION["tenant_email"]   = $tenant_email;
        $_SESSION["tenant_mobile"]  = $tenant_mobile;
      
        

        header("Location: ../tenant_dashboard.php");
        exit();
    } else {
        echo "Registration failed.";
    }
}
 else {
    echo "Invalid access.";
    header("Location: ../tenant_full_register.php");
    exit();
}
