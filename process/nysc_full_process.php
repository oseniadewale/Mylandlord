<?php
session_start();
include_once "../classes/Tenant.php";

$nysc_full_reg = new Tenant;




if (strlen($_POST["tenant_username"]) < 6) {
    $_SESSION["tenant_username_error"] = "Your username should be at least 6 characters";
    header("Location: ../nysc_full_register.php");
    exit;
}

if (strlen($_POST["tenant_password"]) < 6) {
    $_SESSION["tenant_password_error"] = "Your password should be at least 6 characters";
    header("Location: ../nysc_full_register.php");
    exit;
}


if(strlen($_POST["tenant_password"] )< 6){
    $_SESSION["tenant_password_error"] = "Your username should be at least 6 characters";
    header("Location: ../nysc_full_register.php");
    exit;

}

if($_POST["tenant_password"] !== $_POST["confirm_tenant_password"]){
    $_SESSION["confirm_tenant_password_error"] =  "Mismatch password";
    header("Location: ../nysc_full_register.php");
    exit;
    
}





if (isset($_POST["nysc_full_btn"])) {




    $tenant_password = $_POST["tenant_password"];
    $tenant_username = htmlspecialchars($_POST["tenant_username"]);
    $tenant_email = htmlspecialchars($_POST["tenant_email"]);
    $tenant_mobile = htmlspecialchars($_POST["tenant_mobile"]);
     $tenant_surname = htmlspecialchars($_POST["tenant_surname"]);
      $tenant_firstname = htmlspecialchars($_POST["tenant_firstname"]);
       $tenant_middlename = htmlspecialchars($_POST["tenant_middlename"]);
        $tenant_homeaddress = htmlspecialchars($_POST["tenant_home_address"]);
        $tenant_usertype = htmlspecialchars($_POST["nysc_user"]);


   


   $tenant_id = $nysc_full_reg->nysc_full_reg($tenant_username, $tenant_password, $tenant_email, $tenant_mobile,$tenant_surname, $tenant_firstname,$tenant_middlename,$tenant_homeaddress,  $tenant_usertype);
    
    if($tenant_id){
         $tenant_data = $nysc_full_reg->getTenantById($tenant_id);
         $_SESSION["tenant_id"]      =  $tenant_data["tenant_id"];
        $_SESSION["tenant_username"]=  $tenant_data["tenant_username"];
        $_SESSION["tenant_email"]   =  $tenant_data["tenant_email"];
        $_SESSION["tenant_mobile"]  =  $tenant_data["tenant_mobile"];
          $_SESSION["user_type"] =  $tenant_data["user_type"];
          $_SESSION["start_date"] = $nysc_success["start_date"];
          $_SESSION['nysc_rent_start'] = $nysc_success["nysc_rent_start"];

        header("Location: ../tenant_dashboard.php");
    exit;

    }
    
    
    
} else {
    echo "Something is wrong";
    header("Location: ../nysc_full_register.php");
}












?>