<?php
session_start();
include_once "../classes/Landlord.php";

if (isset($_POST["landlord_full_btn"])) {
    $landlord_username   = htmlspecialchars($_POST["landlord_username"]);
    $landlord_password   = $_POST["landlord_password"];
    $landlord_email      = htmlspecialchars($_POST["landlord_email"]);
    $landlord_mobile     = htmlspecialchars($_POST["landlord_mobile"]);
    $landlord_surname    = htmlspecialchars($_POST["landlord_surname"]);
    $landlord_firstname  = htmlspecialchars($_POST["landlord_firstname"]);
    $landlord_middlename = htmlspecialchars($_POST["landlord_middlename"]);
    $landlord_permanent_homeaddress= htmlspecialchars($_POST["landlord_permanent_homeaddress"]);
 $files1 = $_FILES["pic1"];
   $filename1 = $_FILES["pic1"]['name'];
   $filesize1 = $_FILES["pic1"]['size'];
   $tmpname1 = $_FILES["pic1"]['tmp_name'];
   $error1 = $_FILES["pic1"]['error'];
   $filetype1 = $_FILES["pic1"]['type'];

   //validation
   if ($error1 > 0) {
      $_SESSION["landlord_picture1_error"] = "You have not uploaded any picture for <span style='color:red'>picture 1</span>";
      header("location: ../landlord_full_register.php");
      exit();
   }

   //size check
   
   if ($filesize1 > 2097158) {
      $_SESSION["landlord_picture1_size"] = "Your <span style='color:red'>picture 1</span> is larger than 2MB, please resize";
      header("location: ../landlord_full_register.php");
      exit();
   }

   $allowed_extension1 = array('png', 'jpg', 'gif', 'svg', 'jpeg');

   $arrfilename1 = explode(".", $filename1);
   $file_ext1 = strtolower(end($arrfilename1)); // normalize to lowercase

   if (!in_array($file_ext1, $allowed_extension1)) {
      $_SESSION["picture1_type_error"] = "Picture format of <span style='color:red'>picture 1</span> is not supported";
      header("location: ../landlord_full_register.php");
      exit();
   }

   $filename1 = uniqid("Landlord_passport_", true) . "." . $file_ext1;


   $destination1 = "../uploads/$filename1";
   $picture1 = "uploads/$filename1";
   $ok = move_uploaded_file($tmpname1, $destination1);









    $landlord = new Landlord;

    $insertedId = $landlord->landlord_full_reg(
        $landlord_username, $landlord_password, $landlord_email, $landlord_mobile,
        $landlord_surname, $landlord_firstname, $landlord_middlename, $landlord_permanent_homeaddress,$picture1, $_SESSION["landlord_id"] 
    );


    if ($insertedId) {
        
        $_SESSION["landlord_id"]      = $insertedId;
        $_SESSION["landlord_username"]= $landlord_username;
        $_SESSION["landlord_email"]   = $landlord_email;
        $_SESSION["landlord_mobile"]  = $landlord_mobile;
        $_SESSION["landlord_surname"] = $landlord_surname;
        $_SESSION["landlord_firstname"] = $landlord_firstname;
        $_SESSION["landlord_middlename"] = $landlord_middlename;
        $_SESSION["landlord_permanent_homeaddress"] = $landlord_permanent_homeaddress;
          $_SESSION["active_role"] = 'landlord';

        header("Location: ../landlord_dashboard.php");
        exit();
    } else {
        echo "Registration failed.";
    }
}
 else {
    echo "Invalid access.";
    header("Location: ../landlord_full_register.php");
    exit();
}
