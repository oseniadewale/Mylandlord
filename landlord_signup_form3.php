<?php
session_start();


$base_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

include_once __DIR__ . "/header.php";





 ?>

<style>
    

    .firstcol{
        background-image: linear-gradient(rgba(0,0,0,0.1)),url("images/house10.jpg");
        color:rgb(0,0,0);
        font-size: 20px;
        font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    }

    .button-container {
    display: flex;
    justify-content: center;
}

   
    
</style>








<div class="container">
    <div class="row">

        <?php if (isset($_SESSION['Db_unique_error'])): ?>
        <div class="alert alert-danger container-fluid mt-4">
            <?= $_SESSION['Db_unique_error']; ?>
        </div>
        <?php unset($_SESSION['Db_unique_error']); ?>
    <?php endif; ?>
    </div>
    <div class="row mt-4 ">
        <h2 class="mt-5" style="color:green; display:flex; flex-direction:column; text-align:center">LANDLORD SIGNUP FORM</h2>
        <div class="col-lg-6 firstcol">
             <form action="process/landlord_signup_process3.php" method="post" class="mt-5">

            <div>
                <div class="sm">
                          <?php if (isset($_SESSION["landlord_username_error"])) {
                            echo "<span style='color:red'>". $_SESSION['landlord_username_error']." </span>";
                            unset($_SESSION["landlord_username_error"]);
                        } ?>
                    </div>

                <label for="landlord_username" class="label-control"><b>Username:</b></label>

                <input type="text" class="form-control mb-3" name="landlord_username"
                    placeholder="enter the username you want to use" required>
                    


            </div>

            <div>

            <div class="sm">
                          <?php if (isset($_SESSION["landlord_password_error"])) {
                            echo "<span style='color:red'>". $_SESSION['landlord_password_error']." </span>";
                            unset($_SESSION["landlord_password_error"]);
                        } ?>
                    </div>


                <label for="landlord_password" class="label-control"><b>Password:</b></label>
                <input type="password" class="form-control mb-3" name="landlord_password"
                    placeholder="enter your 6 digit password you want to use" required>



            </div>

            <div>
                 <div class="sm">
                          <?php if (isset($_SESSION["confirm_landlord_password_error"])) {
                            echo "<span style='color:red'>". $_SESSION['confirm_landlord_password_error']." </span>";
                            unset($_SESSION["confirm_landlord_password_error"]);
                        } ?>
                    </div>
                 <label for="confirm_landlord_password" class="label-control"><b>Confirm Password:</b></label>
                <input type="password" class="form-control mb-3" name="confirm_landlord_password"
                    placeholder="reenter the password here again" required>
               
            </div>




            <div>

                <label for="landlord_email"><b>Email Address:</b></label>
                <input type="email" class="form-control mb-3" name="landlord_email"
                    placeholder="enter the email you want to use" required>



            </div>

            <div>

                <label for="landlord_mobile" class="label-form"><b>Phone Number:</b></label>
                <input type="text" class="form-control mb-3" name="landlord_mobile"
                    placeholder="enter the phone number you want to use" required>


            </div>

            <?php



           

            ?>



            <div class="button-container">
    <button class="btn btn-success mb-3 mt-3" name="landlord_signup_btn" type="submit">SignUp</button>
</div>











        </form>

        </div>

        <div class="col-lg-6 mt-4">
            <img src="images/house13.jpg" alt="">
        </div>

       

    </div>
</div>



<?php

 include_once __DIR__ . "/footer.php"




?>
</body>

</html>