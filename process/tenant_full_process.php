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
    $tenant_permanent_homeaddress= htmlspecialchars($_POST["tenant_permanent_homeaddress"]);


     $files1 = $_FILES["pic1"];
   $filename1 = $_FILES["pic1"]['name'];
   $filesize1 = $_FILES["pic1"]['size'];
   $tmpname1 = $_FILES["pic1"]['tmp_name'];
   $error1 = $_FILES["pic1"]['error'];
   $filetype1 = $_FILES["pic1"]['type'];

   //validation
   if ($error1 > 0) {
      $_SESSION["tenant_picture1_error"] = "You have not uploaded any picture for <span style='color:red'>picture 1</span>";
      header("location: ../tenant_full_register.php");
      exit();
   }

   //size check
   
   if ($filesize1 > 2097158) {
      $_SESSION["tenant_picture1_size"] = "Your <span style='color:red'>picture 1</span> is larger than 2MB, please resize";
      header("location: ../tenant_full_register.php");
      exit();
   }

   $allowed_extension1 = array('png', 'jpg', 'gif', 'svg', 'jpeg');

   $arrfilename1 = explode(".", $filename1);
   $file_ext1 = strtolower(end($arrfilename1)); // normalize to lowercase

   if (!in_array($file_ext1, $allowed_extension1)) {
      $_SESSION["picture1_type_error"] = "Picture format of <span style='color:red'>picture 1</span> is not supported";
      header("location: ../tenant_full_register.php");
      exit();
   }

   $filename1 = uniqid("Tenant_passport_", true) . "." . $file_ext1;


   $destination1 = "../uploads/$filename1";
   $picture1 = "uploads/$filename1";
   $ok = move_uploaded_file($tmpname1, $destination1);













    $tenant = new Tenant;

    $insertedId = $tenant->tenant_full_reg(
         $tenant_username, $tenant_password, $tenant_email, $tenant_mobile,
        $tenant_surname, $tenant_firstname, $tenant_middlename, $tenant_permanent_homeaddress,$picture1, $_SESSION["tenant_id"] 
    );

if ($insertedId) {
    // ✅ check actual DB value before redirect
    // $tenantData = $tenant->getTenantById($insertedId);
    
          $_SESSION["tenant_id"]      = $insertedId;
        $_SESSION["tenant_username"]= $tenant_username;
        $_SESSION["tenant_email"]   = $tenant_email;
        $_SESSION["tenant_mobile"]  = $tenant_mobile;
        $_SESSION["tenant_surname"] = $tenant_surname;
        $_SESSION["tenant_firstname"] = $tenant_firstname;
        $_SESSION["tenant_middlename"] = $tenant_middlename;
        $_SESSION["tenant_permanent_homeaddress"] = $tenant_permanent_homeaddress;
        $_SESSION['active_role'] = 'tenant';

        header("Location: ../tenant_dashboard.php");
        exit();
    } else {
        echo "Registration failed.";
    }
} else {
    echo "Invalid access";
     header("Location: ../tenant_full_register.php");
}



