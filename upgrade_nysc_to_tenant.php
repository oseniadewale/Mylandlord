<?php
session_start();
require_once "classes/Db.php"; // adjust to your DB connection class

// Ensure only logged-in NYSC members can access
if (!isset($_SESSION['tenant_id']) || $_SESSION['user_type'] !== 'nysc') {
    header("Location: tenant_login.php");
    exit();
}

$tenant_id = $_SESSION['tenant_id'];

try {
    $db = new Db();
    $conn = $db->connect();

    // Update user_type in database
    $sql = "UPDATE tenant SET user_type = 'tenant' WHERE tenant_id = :tenant_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':tenant_id', $tenant_id, PDO::PARAM_INT);
    $stmt->execute();

    // Update session
    $_SESSION['user_type'] = 'tenant';

    // Optional: reset rent start tracking since NYSC expiry no longer applies
    unset($_SESSION['nysc_rent_start']);

    // Redirect to tenant dashboard
    $_SESSION['upgrade_success'] = "Congratulations! Your account has been upgraded to Tenant.";
    header("Location: tenant_dashboard.php");
    exit();

} catch (PDOException $e) {
    $_SESSION['upgrade_error'] = "Error upgrading account: " . $e->getMessage();
    header("Location: tenant_dashboard.php");
    exit();
}
