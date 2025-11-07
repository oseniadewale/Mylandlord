<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
$base_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

include_once __DIR__ . "/header.php";


include_once __DIR__ . "/classes/House.php";
include_once __DIR__ . "/classes/Landlord.php";
$page_title = 'landlord dashboard';



// if(isset($_SESSION["active_role"]) && $_SESSION["active_role"] == 'landlord' ){
//     $active_role = new Landlord;
//     $now_Landlord = $active_role->getsingleLandlordById($_SESSION['landlord_id']);
   
     

// }

if (!isset($_SESSION["landlord_id"])) {
    header("Location: landlord_login.php");
    exit();
}







$landlordObj = new Landlord();
$landlord = $landlordObj->getLandlordById($_SESSION['landlord_id']);
if ($landlord['profile_completed'] == 0) {
     $_SESSION["incomplete_landlord_profile"] = "Please complete your profile to access your dashboard.";
    header("Location: work_landlord.php");
    exit();
}



$house = new House();
$houses = $house->getHousesByLandlord($_SESSION["landlord_id"]);

$number = 1;
?>

<div class="container-fluid pt-4 mt-4">
    <?php 
    if(isset( $_SESSION["house_uploaded"])){
        echo "<div>".
          $_SESSION["house_uploaded"]
          
        
        ."</div>";
        unset( $_SESSION["house_uploaded"]);
    }
    
    ?>
    <h5 class="mt-4 pt-4 ms-1 col-sm-12" style="display:flex; align-items:center; justify-content:center ">
    <img src="images/landlord_icon.png" alt="icon" class="img-fluid me-2" style="width: 20px; height: 20px;">
    Welcome
    <span style="color:blue; margin-left: 5px"><?php if(isset($_SESSION["landlord_username"])) {
        echo $_SESSION["landlord_username"];
    } else{
        header("location: landlord_signup3.php");
    }?>!</span>
    </h5>
<p style="display:flex; align-items:center; justify-content:center ">
    This is your personal dashboard as a
            <span style='margin-left:5px; flex-wrap:wrap; color:blue'>landlord</span>
</p>

<h6 class="mt-4 ms-1" style="display:flex;justify-content:center">
    <?php

    date_default_timezone_set('Africa/Lagos');

    $now = new DateTime(); // or set your timezone as needed
    
    $day = $now->format('j');         // Day without leading 0
    $month = $now->format('F');         // Full month name
    $year = $now->format('Y');         // 4-digit year
    $time = $now->format('g:ia');      // 12-hour format, no leading zero, with am/pm
    
    // Get the ordinal suffix (st, nd, rd, th)
    function getOrdinal($day)
    {
        if (!in_array(($day % 100), [11, 12, 13])) {
            switch ($day % 10) {
                case 1:
                    return 'st';
                case 2:
                    return 'nd';
                case 3:
                    return 'rd';
            }
        }
        return 'th';
    }

    $ordinal = getOrdinal($day);

    // Final output
    echo "Today is {$day}{$ordinal} {$month}, {$year} and currently the time is {$time} in Nigeria(Africa/Lagos time zone).";
    ?>

</h6>


</div>











<?php if (empty($houses)): ?>
    <div class="alert alert-danger" role="alert">
        You currently do not have any house listed for rent.
        <a href="house_upload.php" class="btn btn-sm btn-success mt-2">Click here to upload a house</a>
    </div>
<?php else: ?>
    <span class="ps-2">This is your dashboard and the houses you have for rent:</span><br><br>
    <table class="table table-striped table-bordered table-success mx-2 pe-2" border="1">
        <thead>
            <tr>

                <th>Serial Number</th>
                <th>House Type</th>
                <th>Price Range</th>
                <th>Rentage Price</th>
                <th>Rentage duration</th>
                <th>State</th>
                <th>LGA</th>
                <th>Location</th>
                <th>House Features</th>
                <th>Payment Date</th>
                <th>Availabilty status</th>
                <th>Payment status</th>
                <th>House rented by</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($houses as $house): ?>
                <tr>
                    <td><?php echo $number++ ?></td>
                    <td><?= ($house['house_type']) ?></td>
                    <td><?= ($house['price_range']) ?></td>
                    <td><?= '₦' . number_format($house['actual_price']) ?></td>
                    <td><?= ($house['rent_duration']) ?></td>
                    <td><?= ($house['state_name']) ?></td>
                    <td><?= ($house['lg_name']) ?></td>
                    <td><?= ($house['location']) ?></td>
                    <td><?= ($house['house_features']) ?></td>
                     <td><?= ($house['payment_date']) ?></td>

                    <td><?= ($house['availability_status']) ?></td>
               
                     

                   <td>
    <span style="color: <?= ($house['house_payment'] === 'approved' ) ? 'green' : 'inherit' ?>">
        <?= ($house['house_payment']) ?>
    </span>
</td>

                     <td><?php echo "<span style='color:blue'>".($house['tenant_username'])."</span>" ?></td>

                    <td>
                        <img src="<?= $base_url . '/' . $house['picture_1'] ?>" width="100" alt="uploaded house image">


                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>


<?php if (!empty($houses)) {

    echo " <div>" .
        '<span>' . 'You can upload more houses here' . ' <a href="house_upload.php">' . '<button style="color:green">' . '<img src="images/house2_icon.png" width=15px style="margin-right:3px">' . 'Upload House' . '</button>' . '</a>' .
        '</span>' .
        "</div>";

} else {
    echo '';
}




?>



<p style="display:flex;  justify-content: center;">Logout from the application here <a href="landlord_logout.php"><button class="btn btn-danger" style="margin-left:5px;">Logout</button></a>

</p>







<?php include_once __DIR__ . "/footer.php";
 ?>
