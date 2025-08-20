<?php
session_start();
include_once "../classes/TenantSignup.php";
$base_url = 'http://localhost/tenant'; // or use $_SERVER for dynamic path
include_once("../header.php");

$mysignup = new TenantSignup;





if (strlen($_POST["tenant_username"]) < 6) {
    $_SESSION["tenant_username_error"] = "Your username should be at least 6 characters";
    header("Location: ../tenant_signup_form3.php");
    exit;
}

if (strlen($_POST["tenant_password"]) < 6) {
    $_SESSION["tenant_password_error"] = "Your password should be at least 6 characters";
    header("Location: ../tenant_signup_form3.php");
    exit;
}


if(strlen($_POST["tenant_password"] )< 6){
    $_SESSION["tenant_password_error"] = "Your username should be at least 6 characters";
    header("Location: ../tenant_signup_form3.php");
    exit;

}

if($_POST["tenant_password"] !== $_POST["confirm_tenant_password"]){
    $_SESSION["confirm_tenant_password_error"] =  "Mismatch password";
    header("Location: ../tenant_signup_form3.php");
    exit;
    
}










if (isset($_POST["tenant_signup_btn"])) {




    $tenant_password = htmlspecialchars($_POST["tenant_password"]);
    $tenant_username = htmlspecialchars($_POST["tenant_username"]);
    $tenant_email = htmlspecialchars($_POST["tenant_email"]);
    $tenant_mobile = htmlspecialchars($_POST["tenant_mobile"]);

    $_SESSION["tenant_username"] = $_POST["tenant_username"];
    
      $_SESSION["tenant_email"] = $_POST["tenant_email"];
       $_SESSION["tenant_mobile"] = $_POST["tenant_mobile"];



    $mysignup->tenant_signup($tenant_username, $tenant_password, $tenant_email, $tenant_mobile);
    header("Location: ../work_tenant.php");
    exit;

} else {
    echo "Something is wrong";
}












?>