<?php
session_start();
include_once "../classes/House.php";

if (!isset($_SESSION["landlord_id"])) {
    die("Landlord not logged in.");
}
$landlord_id = $_SESSION["landlord_id"];




if (isset($_POST["housebtn"]) && ($_SESSION["landlord_id"])) {
   $house = $_POST["house_type"];
   $state = $_POST["state"];
   $lga = $_POST["lga"];
   $price = $_POST["price"];
   $actual_price = $_POST["actual_price"];
   $actual_price = preg_replace('/[^\d.]/', '', $actual_price);

   $actual_price = htmlspecialchars($actual_price);
   $location = htmlspecialchars($_POST["house_location"]);



   $rent_duration = htmlspecialchars($_POST["rent_duration"]);
   $features = $_POST["house_features"];



   $features_string = implode(", ", $features);
    $features_string= str_replace("_"," ",$features_string);
   $house_explode = explode('_', $house);
   $house = implode(' ', $house_explode);
  
   $landlord_notice =htmlspecialchars($_POST["notice_for_tenant"]);


   $files1 = $_FILES["pic1"];
   $filename1 = $_FILES["pic1"]['name'];
   $filesize1 = $_FILES["pic1"]['size'];
   $tmpname1 = $_FILES["pic1"]['tmp_name'];
   $error1 = $_FILES["pic1"]['error'];
   $filetype1 = $_FILES["pic1"]['type'];
   //validation

   if ($error1 > 0) {
      $_SESSION["picture1_error"] = "You have not uploaded any picture for <span style='color:red'>picture 1</span>";
      header("location: ../house_uploads.php");
      exit();
   }

   //size check

   if ($filesize1 > 2097158) {
      $_SESSION["picture1_size"] = "Your <span style='color:red'>picture 1</span> is larger than 2MB, please resize";
      header("location: ../house_uploads.php");
      exit();
   }

   $allowed_extension1 = array('png', 'jpg', 'gif', 'svg', 'jpeg');

   $arrfilename1 = explode(".", $filename1);
   $file_ext1 = strtolower(end($arrfilename1)); // normalize to lowercase

   if (!in_array($file_ext1, $allowed_extension1)) {
      $_SESSION["picture1_type_error"] = "Picture format of <span style='color:red'>picture 1</span> is not supported";
      header("location: ../house_uploads.php");
      exit();
   }

   $filename1 = uniqid("house_", true) . "." . $file_ext1;


   $files2 = $_FILES["pic2"];
   $filename2 = $_FILES["pic2"]['name'];
   $filesize2 = $_FILES["pic2"]['size'];
   $tmpname2 = $_FILES["pic2"]['tmp_name'];
   $error2 = $_FILES["pic2"]['error'];
   $filetype2 = $_FILES["pic2"]['type'];
   //validation

   if ($error2 > 0) {
      $_SESSION["picture2_error"] = "You have not uploaded any picture for <span style='color:red'>picture 2</span>";
      header("location: ../house_uploads.php");
      exit();
   }

   //size check

   if ($filesize2 > 2097158) {
      $_SESSION["picture2_size"] = "Your <span style='color:red'>picture 2</span> is larger than 2MB, please resize";
      header("location: ../house_uploads.php");
      exit();
   }

   $allowed_extension2 = array('png', 'jpg', 'gif', 'svg', 'jpeg');

   $arrfilename2 = explode(".", $filename2);
   $file_ext2 = strtolower(end($arrfilename2)); // normalize to lowercase

   if (!in_array($file_ext2, $allowed_extension2)) {
      $_SESSION["picture2_type_error"] = "Picture format of <span style='color:red'>picture 2</span> is not supported";
      header("location: ../house_uploads.php");
      exit();
   }

$filename2 = uniqid("house_", true) . "." . $file_ext2;

   $files3 = $_FILES["pic3"];
   $filename3 = $_FILES["pic3"]['name'];
   $filesize3 = $_FILES["pic3"]['size'];
   $tmpname3 = $_FILES["pic3"]['tmp_name'];
   $error3 = $_FILES["pic3"]['error'];
   $filetype3 = $_FILES["pic3"]['type'];
   //validation

   if ($error3 > 0) {
      $_SESSION["picture3_error"] = "You have not uploaded any picture for <span style='color:red'>picture 3</span>";
      header("location: ../house_uploads.php");
      exit();
   }

   //size check

   if ($filesize3 > 2097158) {
      $_SESSION["picture3_size"] = "Your <span style='color:red'>picture 3</span> is larger than 2MB, please resize";
      header("location: ../house_uploads.php");
      exit();
   }

   $allowed_extension3 = array('png', 'jpg', 'gif', 'svg', 'jpeg');

   $arrfilename3 = explode(".", $filename3);
   $file_ext3 = strtolower(end($arrfilename3)); // normalize to lowercase

   if (!in_array($file_ext3, $allowed_extension3)) {
      $_SESSION["picture3_type_error"] = "Picture format of <span style='color:red'>picture 3</span> is not supported";
      header("location: ../house_uploads.php");
      exit();
   }
   $filename3 = uniqid("house_", true) . "." . $file_ext3;

   $filename4 = $filename5 = $filename6 = $filename7 = null;
   $tmpname4 = $tmpname5 = $tmpname6 = $tmpname7 = null;
   $destination4 = $destination5 = $destination6 = $destination7 = null;


   if (isset($_FILES["pic4"]) && $_FILES["pic4"]["error"] === UPLOAD_ERR_OK) {

      $files4 = $_FILES["pic4"];
      $filename4 = $_FILES["pic4"]['name'];
      $filesize4 = $_FILES["pic4"]['size'];
      $tmpname4 = $_FILES["pic4"]['tmp_name'];
      $error4 = $_FILES["pic4"]['error'];
      $filetype4 = $_FILES["pic4"]['type'];
   
      //validation



      //size check

      if ($filesize4 > 2097158) {
         $_SESSION["picture4_size"] = "Your <span style='color:red'>picture 4</span> is larger than 2MB, please resize";
         header("location: ../house_uploads.php");
         exit();
      }

      $allowed_extension4 = array('png', 'jpg', 'gif', 'svg', 'jpeg');

      $arrfilename4 = explode(".", $filename4);
      $file_ext4 = strtolower(end($arrfilename4)); // normalize to lowercase

      if (!in_array($file_ext4, $allowed_extension4)) {
         $_SESSION["picture4_type_error"] = "Picture format of <span style='color:red'>picture 4</span> is not supported";
         header("location: ../house_uploads.php");
         exit();
      }

      $filename4 = uniqid("house_", true) . "." . $file_ext4;

   }


   if (isset($_FILES["pic5"]) && $_FILES["pic5"]["error"] === UPLOAD_ERR_OK) {


      $files5 = $_FILES["pic5"];
      $filename5 = $_FILES["pic5"]['name'];
      $filesize5 = $_FILES["pic5"]['size'];
      $tmpname5 = $_FILES["pic5"]['tmp_name'];
      $error5 = $_FILES["pic5"]['error'];
      $filetype5 = $_FILES["pic5"]['type'];
   
      //validation



      //size check

      if ($filesize5 > 2097158) {
         $_SESSION["picture5_size"] = "Your <span style='color:red'>picture 5</span> is larger than 2MB, please resize";
         header("location: ../house_uploads.php");
         exit();
      }

      $allowed_extension5 = array('png', 'jpg', 'gif', 'svg', 'jpeg');

      $arrfilename5 = explode(".", $filename5);
      $file_ext5 = strtolower(end($arrfilename5)); // normalize to lowercase

      if (!in_array($file_ext5, $allowed_extension5)) {
         $_SESSION["picture5_type_error"] = "Picture format of <span style='color:red'>picture 5</span> is not supported";
         header("location: ../house_uploads.php");
         exit();
      }

      $filename5 = uniqid("house_", true) . "." . $file_ext5;
   }

   if (isset($_FILES["pic6"]) && $_FILES["pic6"]["error"] === UPLOAD_ERR_OK) {


      $files6 = $_FILES["pic6"];
      $filename6 = $_FILES["pic6"]['name'];
      $filesize6 = $_FILES["pic6"]['size'];
      $tmpname6 = $_FILES["pic6"]['tmp_name'];
      $error6 = $_FILES["pic6"]['error'];
      $filetype6 = $_FILES["pic6"]['type'];
    
      //validation



      //size check

      if ($filesize6 > 2097158) {
         $_SESSION["picture6_size"] = "Your <span style='color:red'>picture 6</span> is larger than 2MB, please resize";
         header("location: ../house_uploads.php");
         exit();
      }

      $allowed_extension6 = array('png', 'jpg', 'gif', 'svg', 'jpeg');

      $arrfilename6 = explode(".", $filename6);
      $file_ext6 = strtolower(end($arrfilename6)); // normalize to lowercase

      if (!in_array($file_ext6, $allowed_extension6)) {
        $_SESSION["picture6_type_error"] = "Picture format of <span style='color:red'>picture 6</span> is not supported";
         header("location: ../house_uploads.php");
         exit();
      }

      $filename6 = uniqid("house_", true) . "." . $file_ext6;
   }


   if (isset($_FILES["pic7"]) && $_FILES["pic7"]["error"] === UPLOAD_ERR_OK) {

      $files7 = $_FILES["pic7"];
      $filename7 = $_FILES["pic7"]['name'];
      $filesize7 = $_FILES["pic7"]['size'];
      $tmpname7 = $_FILES["pic7"]['tmp_name'];
      $error7 = $_FILES["pic7"]['error'];
      $filetype7 = $_FILES["pic7"]['type'];
   
      //validation



      //size check

      if ($filesize7 > 2097158) {
         $_SESSION["picture7_size"] = "Your <span style='color:red'>picture 7</span> is larger than 2MB, please resize";
         header("location: ../house_uploads.php");
         exit();
      }

      $allowed_extension7 = array('png', 'jpg', 'gif', 'svg', 'jpeg');

      $arrfilename7 = explode(".", $filename7);
      $file_ext7 = strtolower(end($arrfilename7)); // normalize to lowercase

      if (!in_array($file_ext7, $allowed_extension7)) {
        $_SESSION["picture7_type_error"] = "Picture format of <span style='color:red'>picture 7</span> is not supported";
         header("location: ../house_uploads.php");
         exit();
      }
      $filename7 = uniqid("house_", true) . "." . $file_ext7;
   }



  // Required pics
$destination1 = "../uploads/$filename1";
$destination2 = "../uploads/$filename2";
$destination3 = "../uploads/$filename3";

$picture1 = "uploads/$filename1";
$picture2 = "uploads/$filename2";
$picture3 = "uploads/$filename3";

// Optional pics
if ($filename4) {
    $destination4 = "../uploads/$filename4";
    $picture4 = "uploads/$filename4";
} else {
    $picture4 = null;
}

if ($filename5) {
    $destination5 = "../uploads/$filename5";
    $picture5 = "uploads/$filename5";
} else {
    $picture5 = null;
}

if ($filename6) {
    $destination6 = "../uploads/$filename6";
    $picture6 = "uploads/$filename6";
} else {
    $picture6 = null;
}

if ($filename7) {
    $destination7 = "../uploads/$filename7";
    $picture7 = "uploads/$filename7";
} else {
    $picture7 = null;
}

// ✅ Now move files
$ok = move_uploaded_file($tmpname1, $destination1) &&
      move_uploaded_file($tmpname2, $destination2) &&
      move_uploaded_file($tmpname3, $destination3);

if ($tmpname4) $ok = $ok && move_uploaded_file($tmpname4, $destination4);
if ($tmpname5) $ok = $ok && move_uploaded_file($tmpname5, $destination5);
if ($tmpname6) $ok = $ok && move_uploaded_file($tmpname6, $destination6);
if ($tmpname7) $ok = $ok && move_uploaded_file($tmpname7, $destination7);

if ($ok) {
    $image = new House;
    $image->uploadHouse(
        $house, $price,
        $picture1, $picture2, $picture3,
        $picture4, $picture5, $picture6, $picture7,
        $location, $state, $lga, $landlord_id,
        $actual_price, $rent_duration, $features_string, $landlord_notice
    );

    echo "<p style='color:green'>House successfully uploaded</p>";
    echo "<p>Go back to your dashboard here <a href='../landlord_dashboard.php'>My Dashboard</a></p>";
} else {
    echo "Something went wrong with your upload";
}

}











?>