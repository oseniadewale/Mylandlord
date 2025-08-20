<?php
session_start();
require_once "../classes/Admin.php";

if (isset($_POST['admin_login_btn'])) {
    $admin_username = trim($_POST['admin_username']);
    $admin_password = trim($_POST['admin_password']);
    

    $admin = new Admin();
    $login = $admin->login($admin_username, $admin_password);


    if(!$login){
        $_SESSION["admin_username_error"] = "Incorrect username";
        $_SESSION["admin_password_error"] = "Incorrect password";
        header("Location: ../admin_login.php");
    }

    if ($login) {
        $_SESSION['admin_id'] = $login['admin_id'];
        $_SESSION['admin_username'] = $login['admin_username'];
        $_SESSION["admin_role"] = "super_admin";
        header("Location: ../admin_dashboard.php");
        exit();
        
    }

    
}
