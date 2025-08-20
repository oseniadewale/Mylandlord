<?php
session_start();
include_once "../classes/Tenant.php";

if ($_SERVER["REQUEST_METHOD"] === 'POST') {

    $tenant_username = htmlspecialchars($_POST["tenant_username"]);
    $tenant_email = htmlspecialchars($_POST["tenant_email"]);
    $tenant_mobile = htmlspecialchars($_POST["tenant_mobile"]);
    $tenant_password = $_POST["tenant_password"];

}

$tenant = new Tenant;

$tenant_id = $tenant->landlord_as_tenant_insert($tenant_username, $tenant_password, $tenant_email, $tenant_mobile);


if ($tenant_id) {
    $_SESSION['tenant_id'] = $tenant_id;
    $_SESSION["tenant_username"] = $tenant_username;
    header("Location: ../tenant_dashboard.php");
    exit();
} else {
    echo "Tenant creation failed.";
}






?>