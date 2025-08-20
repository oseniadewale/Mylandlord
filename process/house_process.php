<?php 
session_start();
include_once "../classes/House.php";



if(isset($_POST["housebtn"]) && ($_SESSION["landlord_id"])){
   $house =  $_POST["house_type"];
  $state =  $_POST["state"];
   $lga =  $_POST["lga"];
  $price =  $_POST["price"];
  $location = htmlspecialchars($_POST["house_location"]) ;
  $actual_price = htmlspecialchars($_POST["actual_price"]);
  $rent_duration = htmlspecialchars($_POST["rent_duration"]);
  $features = $_POST["house_features"];

   $files = $_FILES["pic1"];
   $filename = $_FILES["pic1"]['name'];
   $filesize = $_FILES["pic1"]['size'];
   $tmpname = $_FILES["pic1"]['tmp_name'];
   $error = $_FILES["pic1"]['error'];
   $filetype = $_FILES["pic1"]['type'];

     $features_string = implode(", ", $features);
   $house_explode = explode('_',$house);
$house = implode(' ',$house_explode);



   //validation

   if($error > 0){
    echo "You have not uploaded any file or the file is invalid";
    exit();
   }

   //size check

   if($filesize > 3145728 ){
    echo "Your file is greater than 3MB";
    exit();
   }

  $allowed_extension = array('png', 'jpg', 'gif', 'svg', 'jpeg');

$arrfilename = explode(".", $filename);
$file_ext = strtolower(end($arrfilename)); // normalize to lowercase

if (!in_array($file_ext, $allowed_extension)) {
    echo "Your file is not supported";
    exit();
}


   //upload the file

 $destination = "../uploads/$filename"; 
 $picture_path_for_db = "uploads/$filename";

$landlord_id = $_SESSION["landlord_id"];


   if(move_uploaded_file($tmpname, $destination)){

    $image = new House;
     
$image->uploadHouse($house, $price, $picture_path_for_db, $location, $state, $lga, $landlord_id, $actual_price, $rent_duration, $features_string);

  
   echo "<p style='color:green'>".'House successfully uploaded Successful upload'."</p>";
   echo "<p>".'Go back to your dashboard here'.'<a href="../landlord_dashboard.php">'.'My Dashboard'.'</a>'."</p>";
   }else{
    echo "Something is wrong with your upload";
   }


    
}











?>