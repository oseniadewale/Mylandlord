<?php 
session_start();
$base_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

include_once __DIR__ . "/header.php";








?>


<div class="container-fluid mb-3">
    <br>
    <br>
    <br>
    <br>
   <?php if (isset($_SESSION["incomplete_tenant_profile"])): ?>
    <div class="alert alert-danger">
        <?= $_SESSION["incomplete_tenant_profile"]; ?>
    </div>
    <?php unset($_SESSION["incomplete_tenant_profile"]); ?>
<?php endif; ?>

    <p class="mt-3">Congratulations <?php echo '<span style="color:blue">'.  $_SESSION["tenant_username"].'!'.'</span>'; ?> on your signup. Do well to update your profile here →
        <a href="tenant_full_register.php" class="btn btn-success"><img src="images/star.png" width="20" alt="star image"> Click here for full Tenant Registration <img src="images/star.png" alt="star image" width="20"></a>


</p>
<div class="row">
    <div class="col-lg-6 col-sm-12">
        <img src="images/house17.jpg" alt="house image" class="img-fluid">
    </div>
    <div class="col-lg-6 col-lg-sm-12"  >
        <img src="images/house14.jpg" alt="house image" class="img-fluid">
        
    </div>
</div>
</div>

<?php

include_once "footer.php";







?>