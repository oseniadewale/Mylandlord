<?php
session_start();
include_once "../classes/TenantSignup.php";
$base_url = 'http://localhost/mylandlord';
include_once "../header.php";

$mysignup = new TenantSignup;

if (isset($_POST["tenant_signup_btn"])) {

    // ✅ Input sanitization
    $tenant_username = htmlspecialchars($_POST["tenant_username"]);
    $tenant_password = htmlspecialchars($_POST["tenant_password"]);
    $tenant_email    = htmlspecialchars($_POST["tenant_email"]);
    $tenant_mobile   = htmlspecialchars($_POST["tenant_mobile"]);

    // ✅ Password validation
    if (strlen($tenant_username) < 6) {
        $_SESSION["tenant_username_error"] = "Your username should be at least 6 characters";
        header("Location: ../tenant_signup_form3.php");
        exit;
    }

    if (strlen($tenant_password) < 6) {
        $_SESSION["tenant_password_error"] = "Your password should be at least 6 characters";
        header("Location: ../tenant_signup_form3.php");
        exit;
    }

    if ($tenant_password !== $_POST["confirm_tenant_password"]) {
        $_SESSION["confirm_tenant_password_error"] = "Mismatch password";
        header("Location: ../tenant_signup_form3.php");
        exit;
    }

    try {
        // ✅ Will throw exception if not unique
        $tenant_id = $mysignup->tenant_signup($tenant_username, $tenant_password, $tenant_email, $tenant_mobile);

        // ✅ Success
        $_SESSION["tenant_username"] = $tenant_username;
        $_SESSION["tenant_email"]    = $tenant_email;
        $_SESSION["tenant_mobile"]   = $tenant_mobile;
        $_SESSION["active_role"]     = 'tenant';
        $_SESSION["tenant_id"]       = $tenant_id;

        header("Location: ../work_tenant.php");
        exit;

    } catch (Exception $e) {
        // ✅ Show DB/uniqueness errors
        $_SESSION['Db_unique_error'] = $e->getMessage();
        header("Location: ../tenant_signup_form3.php");
        exit;
    }

} else {
    echo "<br>
    <div class='alert alert-danger mt-4'>
        <span style='color:red'>Tenant signup failed</span>
    </div>
    <div>
        <a href='tenant_signup3.php' class='btn btn-success'>
            Click here to go to tenant signup page
        </a>
    </div>";
}

include_once "footer.php";
?>
