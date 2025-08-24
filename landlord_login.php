<?php
session_start();
$base_url = 'http://localhost/mylandlord';
include_once("header.php");

?>
<style>
    .mycontainer{
        background-image: url("images/house9.jpg");
        background-size:cover;
    }
</style>

<div class="container mycontainer mt-4">
    <class class="row">
        <?php
    if (isset($_SESSION["login_error"])) {
        echo '<div class="alert alert-danger">'.$_SESSION["login_error"].'</div>';
        unset($_SESSION["login_error"]); // clear after displaying
    }?>

    </class>
    <div class="row">
        <div class="mt-4" style="display:flex; justify-content:center">
            <div class="card w-50">
                <div class="card-header">
                    <h2 style="display:flex; justify-content:center; color:green">Landlord's login page</h2>

                </div>
                <div class="card-body">
                    <form action="process/landlord_login_process.php" method="post">
                        <label for="landlord_username" class="label-control"><b>Username</b></label>
                        <input type="text" name="landlord_username" class="form-control"
                            placeholder="input your username here"><br>

                        <label for="password" class="label-control"> <b>Password</b></label>
                        <input type="password" name="landlord_password" class="form-control"
                            placeholder="input your password here">

                            <div class="card-footer text-center">
                    <button class="btn btn-success" type="submit" name="btn_landlord_login">Submit</button>
                    <p style="color:black; font-size:20px" class="text-center">If not registered before as a landlord signup here 
            <a href="landlord_signup_form3.php" style="color:green">Signup</a>
        </p>
                </div>
                    </form>

                </div>

                


            </div>


        </div>
    </div>
    <br><br>

    <div class="row">
        
    </div>

</div>

<div class="container mt-3">
    <div class="row">
        <div class="col-lg-3">
        <img src="images/house6.jpg" class="form-control" alt="">
        </div>
         <div class="col-lg-3">
            <img src="images/house7.jpg" class="form-control" alt="">
        </div>
         <div class="col-lg-3">
            <img src="images/house8.jpg" class="form-control" alt="">
            
        </div>
         <div class="col-lg-3">
            <img src="images/house10.jpg" class="form-control" alt="">
            
        </div>
    </div>
</div>

<?php

include_once "footer.php";
?>