<?php
session_start();
$base_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

include_once __DIR__ . "/header.php";


include_once("classes/House.php");

if (!isset($_SESSION["tenant_id"])) {
    header("Location: tenant_login.php");
    exit();
}



$houseObj = new House();
$houses = $houseObj->getAvailableHouses();
?>

<div class="container-fluid mt-5">
    <?php 
    if(isset( $_SESSION["reference_error"] )){
          echo "<div class='container-fluid alert alert-danger' >".

           "<p style='margin-top:20px; color:red'>".$_SESSION['reference_error']."</p>".
        "</div>";
    }
    
    
    ?>
    <h2 class="text-center mb-4">Available House(s) for Rent</h2>

    <?php if (empty($houses)): ?>
        <div class="alert alert-danger">No houses available for rent at this time.</div>
        <div>
            <p>Go back to your dashboard here <a href="tenant_dashboard.php" class="btn btn-success"> ←Back to dashboard</a></p>
        </div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($houses as $house): ?>
                <div class="col-md-4 col-lg-3 col-sm-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="<?= $base_url . '/' . $house['picture_1'] ?>" class="card-img-top"
                            style="height: 200px; object-fit: cover;" loading="lazy">
                        <div class="card-body">
                            <h5 class="card-title text-success"> <span>Type: </span><?= ($house['house_type']) ?></h5>
                            <p class="card-text">
                                It is ₦<?= number_format($house['actual_price']) ?><br> and located in
                                <?= ($house['location']) ?>,<br> in
                                <?= ($house['lg_name']) ?>,<br> within
                                <?= ($house['state_name']) . " " ?>state. It has the following features:
                                <?= ($house['house_features']) ?>
                            </p>
                        </div>
                        <div class="card-footer text-center">
                           
                             <a class="btn btn-success" href="more_details_on_house.php?house_id=<?= $house['house_id'] ?>">Click here for More details</a>

                           
                               
                            
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center">
            <p> <a href="tenant_dashboard.php" style="color:green"><b>Click here to go back to your dashboard here</b></a></p>
        </div>
    <?php endif; ?>
</div>





<?php  include_once __DIR__ . "/footer.php" ?>