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
        $tenant_serving_state = $_POST["serving_state"];
        $files1 = $_FILES["pic1"];
   $filename1 = $_FILES["pic1"]['name'];
   $filesize1 = $_FILES["pic1"]['size'];
   $tmpname1 = $_FILES["pic1"]['tmp_name'];
   $error1 = $_FILES["pic1"]['error'];
   $filetype1 = $_FILES["pic1"]['type'];
   //validation

   if ($error1 > 0) {
      $_SESSION["nysc_picture1_error"] = "You have not uploaded any picture for <span style='color:red'>picture 1</span>";
      header("location: ../nysc_full_register.php");
      exit();
   }

   //size check

   if ($filesize1 > 2097158) {
      $_SESSION["nysc_picture1_size"] = "Your <span style='color:red'>picture 1</span> is larger than 2MB, please resize";
      header("location: ../nysc_full_register.php");
      exit();
   }

   $allowed_extension1 = array('png', 'jpg', 'gif', 'svg', 'jpeg');

   $arrfilename1 = explode(".", $filename1);
   $file_ext1 = strtolower(end($arrfilename1)); // normalize to lowercase

   if (!in_array($file_ext1, $allowed_extension1)) {
      $_SESSION["picture1_type_error"] = "Picture format of <span style='color:red'>picture 1</span> is not supported";
      header("location: ../nysc_full_register.php");
      exit();
   }

   $filename1 = uniqid("nysc_", true) . "." . $file_ext1;


   $destination1 = "../uploads/$filename1";
   $picture1 = "uploads/$filename1";
   $ok = move_uploaded_file($tmpname1, $destination1);


   try{
     $tenant_id = $nysc_full_reg->nysc_full_reg($tenant_username, $tenant_password, $tenant_email, $tenant_mobile,$tenant_surname, $tenant_firstname,$tenant_middlename,$tenant_homeaddress,  $picture1,   $tenant_usertype,$tenant_serving_state);
    
     $tenant_data = $nysc_full_reg->getTenantById($tenant_id);
         $_SESSION["tenant_id"]      =  $tenant_data["tenant_id"];
        $_SESSION["tenant_username"]=  $tenant_data["tenant_username"];
        $_SESSION["tenant_email"]   =  $tenant_data["tenant_email"];
        $_SESSION["tenant_mobile"]  =  $tenant_data["tenant_mobile"];
          $_SESSION["user_type"] =  $tenant_data["user_type"];
          $_SESSION["start_date"] = $tenant_data["start_date"];
          $_SESSION['nysc_rent_start'] = $tenant_data["nysc_rent_start"];

          
        header("Location: ../tenant_dashboard.php");
        exit;
    
   
    } catch (Exception $e) {
        // ✅ Show DB/uniqueness errors
        $_SESSION['Db_unique_error'] = $e->getMessage();
        header("Location: ../nysc_full_register.php");
        exit;
    }

} else {
    echo "<br>
    <div class='alert alert-danger mt-4'>
        <span style='color:red'>Tenant signup failed</span>
    </div>
    <div>
        <a href='../nysc_full_register.php' class='btn btn-success'>
           ← Click here to go to tenant signup page
        </a>
    </div>";
}

include_once "footer.php";









?>