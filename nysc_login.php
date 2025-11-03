<?php
session_start();
$base_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

include_once __DIR__ . "/header.php";


$page_title = "Tenant Login Page";


?>
<style>
    .mycontainer{
        background-image: url("images/nigerian_image2.jpg");
        background-size:cover;
    }
</style>

<div class="container mycontainer mt-4">
    <div class="row">
        <?php
    if (isset($_SESSION["login_error"])) {
        echo '<div class="alert alert-danger">'.$_SESSION["login_error"].'</div>';
        unset($_SESSION["login_error"]); // clear after displaying
    }?>
    </div>
    <div class="row">
        <div class="mt-4" style="display:flex; justify-content:center">
            
            <div class="card w-50 mt-4">
                <div class="card-header">
                    <h2 class=""style="display:flex; justify-content:center; color:green">NYSC's login page</h2>

                </div>
                <div class="card-body">
                    <form action="process/tenant_login_process.php" method="post">
                        <label for="tenant_username" class="label-control"><b>Username</b></label>
                        <input type="text" name="tenant_username" class="form-control"
                            placeholder="input your username here"><br>

                        <label for="password" class="label-control"> <b>Password</b></label>
                        <input type="password" name="tenant_password" class="form-control"
                            placeholder="input your password here">

                             <div class="card-footer text-center">
                    <button class="btn btn-success" name="btn_tenant_login">Submit</button>
                <p style="color:black; font-size:20px" class="text-center"><img src="images/nigerian_flag_icon.png" alt="icon" class="img-fluid me-2" style="width: 20px; height: 20px">If not registered before as a nysc signup here 
            <a href="nysc_full_register.php" style="color:green">Signup</a>
        </p>
                
                </div>
                    </form>

                </div>

               


            </div>


        </div>
    </div>
   
   
</div>
 <br>
<div class="container">

 <div class="row">
        <div class="col-lg-4">
            <img src="images/lagos_city_pix.jpg" alt="lagos city image"  class="img-fluid">
        </div>
        <div class="col-lg-4">
            <img src="images/national_theatre_pix.jpg" alt="national theatre image" class="img-fluid">
        </div>
        <div class="col-lg-4">
            <img src="images/north_nigeria_pix.jpg" alt="northern nigeria image" class="img-fluid">
        </div>
    </div>
    <div class="row">

    <div class="col-lg-4">
        <img src="images/dancing_pix.jpg" alt="dancing image" class="img-fluid">
    </div>
    <div class="col-lg-4">
        <img src="images/Nigerian_flag.jpg" alt="nigerian flag image" class="img-fluid">
    </div>

    <div class="col-lg-4">
        <img src="images/street_pix.jpg" alt="street image" class="img-fluid">
    </div>

    </div>
    

</div>
   

    




<?php

 include_once __DIR__ . "/footer.php"
?>