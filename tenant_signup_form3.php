<?php
session_start();


$base_url = 'http://localhost/mylandlord';
include_once("header.php");



?>
<title>Tenant signup form page</title>
<style>
 

    .firstcol {
        background-image: linear-gradient(rgba(0, 0, 0, 0.1)), url("images/housekey.jpg");
        background-repeat: no-repeat;
        background-size: cover;
        color: rgb(0, 0, 0);
        font-size: 20px;
        font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    }

    .secondcol {
        background-size: cover;
        background-position: center;
        background-size: 300px;
        
    }

       .button-container {
    display: flex;
    justify-content: center;
    
}
</style>








<div class="container">
    <div class="row">
         <?php if (isset($_SESSION['Db_unique_error'])): ?>
        <div class="alert alert-danger container-fluid">
            <?= $_SESSION['Db_unique_error']; ?>
        </div>
        <?php unset($_SESSION['Db_unique_error']); ?>
    <?php endif; ?>
    </div>
    <div class="row mt-4 ">
       

        <h2 class="mt-5" style="color:green; display:flex; flex-direction:column; text-align:center">CLIENT(TENANT)
            SIGNUP FORM</h2>
        <div class="col-lg-6 firstcol">
            <form action="process/tenant_signup_process3.php" method="post" class="mt-5">

                <div>

                 <div class="sm">
                          <?php if (isset($_SESSION["tenant_username_error"])) {
                            echo "<span style='color:red'>". $_SESSION['tenant_username_error']." </span>";
                            unset($_SESSION["tenant_username_error"]);
                        } ?>
                    </div>

                    <label for="tenant_username" class="label-control"><b>Username:</b></label>

                    <input type="text" class="form-control" name="tenant_username"
                        placeholder="enter the username you want to use">


                </div>

                <div>

                 <div class="sm">
                          <?php if (isset($_SESSION["tenant_password_error"])) {
                            echo "<span style='color:red'>". $_SESSION['tenant_password_error']." </span>";
                            unset($_SESSION["tenant_password_error"]);
                        } ?>
                    </div>


                    <label for="tenant_password" class="label-control"><b>Password:</b></label>
                    <input type="password" class="form-control mb-3" name="tenant_password"
                        placeholder="enter the password you want to use">



                </div>


                  <div>
                 <div class="sm">
                          <?php if (isset($_SESSION["confirm_tenant_password_error"])) {
                            echo "<span style='color:red'>". $_SESSION['confirm_tenant_password_error']." </span>";
                            unset($_SESSION["confirm_tenant_password_error"]);
                        } ?>
                    </div>
                 <label for="confirm_tenant_password" class="label-control"><b>Confirm Password:</b></label>
                <input type="password" class="form-control mb-3" name="confirm_tenant_password"
                    placeholder="reenter the password here again" required>
               
            </div>




                <div>

                    <label for="tenant_email"><b>Email Address:</b></label>
                    <input type="email" class="form-control mb-3" name="tenant_email"
                        placeholder="enter the email you want to use">



                </div>

                <div>

                    <label for="tenant_mobile" class="label-form"><b>Phone Number:</b></label>
                    <input type="text" class="form-control mb-3" name="tenant_mobile"
                        placeholder="enter the phone number you want to use">


                </div>

                
                <br>

                <div class="button-container">

                    <button class="btn btn-success mb-3 mt-3" name="tenant_signup_btn" type="submit">SignUp</button>

                </div>













            </form>

        </div>

        <div class="col-lg-6 mt-4 secondcol">
            <img src="images/house14.jpg" alt="image-background">
        </div>



    </div>
</div>



<?php

include_once "footer.php";




