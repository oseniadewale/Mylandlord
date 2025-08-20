<?php 
require_once "../classes/config.php";
include_once "../classes/Landlord.php";
  $newlandlord = new Landlord;



  




if(isset($_POST["landlordbtn"]) && ($_SESSION["landlord_username"] = true)){





    
    $landlord_username = htmlspecialchars($_POST["landlordusername"]);
    $landlord_password = ($_POST["landlordpassword"]);
    $landlord_surname = htmlspecialchars($_POST["landlordsurname"]);
    $landlord_firstname = htmlspecialchars($_POST["landlordfirstname"]);
   $landlord_middlename = htmlspecialchars($_POST["landlordmiddlename"]);
   $landlord_email = ($_POST["landlordemail"]);
    $landlord_mobile = htmlspecialchars($_POST["landlordmobile"]);

    $landlord_homeaddress =    htmlspecialchars($_POST["homeaddress"]);

    if($landlord_username == ""){
        echo "NOTHING DEY HERE";
       
    }

    


    



  

 $newlandlord->landlord_reg($landlord_username, $landlord_password, $landlord_surname,$landlord_firstname,$landlord_middlename, $landlord_email, $landlord_mobile,$landlord_homeaddress);
    
 echo "<p style='color:blue'>Landlord's registration successful into the database </p>";
 
} else {
    echo "<p style='color:red'>Landlord's registration not successful</p>";
    header("Location:index.php");
}













?>