<?php
session_start();
include_once "../classes/LandlordSignup.php";

$mysignup = new LandlordSignup;







if (strlen($_POST["landlord_username"]) < 6) {
    $_SESSION["landlord_username_error"] = "Your username should be at least 6 characters";
    header("Location: ../landlord_signup_form3.php");
    exit;
}

if (strlen($_POST["landlord_password"]) < 6) {
    $_SESSION["landlord_password_error"] = "Your password should be at least 6 characters";
    header("Location: ../landlord_signup_form3.php");
    exit;
}


if(strlen($_POST["landlord_password"] )< 6){
    $_SESSION["landlord_password_error"] = "Your username should be at least 6 characters";
    header("Location: ../landlord_signup_form3.php");
    exit;

}

if($_POST["landlord_password"] !== $_POST["confirm_landlord_password"]){
    $_SESSION["confirm_landlord_password_error"] =  "Mismatch password";
    header("Location: ../landlord_signup_form3.php");
    exit;
    
}






if (isset($_POST["landlord_signup_btn"])) {




    $landlord_password = htmlspecialchars($_POST["landlord_password"]);
    $landlord_username = htmlspecialchars($_POST["landlord_username"]);
    $landlord_email = htmlspecialchars($_POST["landlord_email"]);
    $landlord_mobile = htmlspecialchars($_POST["landlord_mobile"]);

    $_SESSION["landlord_username"] = $_POST["landlord_username"];
      $_SESSION["landlord_email"] = $_POST["landlord_email"];
       $_SESSION["landlord_mobile"] = $_POST["landlord_mobile"];


    $mysignup->landlord_signup($landlord_username, $landlord_password, $landlord_email, $landlord_mobile);
    header("Location: ../work_landlord.php");
    exit;

} else {
    echo "Something is wrong";
}












?>