<?php
session_start();
$base_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

include_once __DIR__ . "/header.php";







?>












<div class="container-fluid mt-4 ">
    <div class="row">
        <div class="col mt-4 pt-4">
            
<h3 class="mt-4 pt-4" style="display:flex; justify-content: center; color:green"><img src="images/star.png" width="30">Landlord full Registration page <img src="images/star.png" width="30"></h3>

        </div>
    </div>

    <div class="row">
        <div class="col" style="display:flex; justify-content:center">
            <?php 
            if(isset(  $_SESSION["landlord_picture1_error"])){
                echo   $_SESSION["landlord_picture1_error"];
                unset(  $_SESSION["landlord_picture1_error"]);
            }
            if(isset($_SESSION["landlord_picture1_size"])){
                echo $_SESSION["landlord_picture1_size"];
                unset($_SESSION["landlord_picture1_size"]);
            }
            
            ?>
        </div>
    </div>

    <div class="row">

    

        <div class="col-lg-6 col-md-6 col-sm-12 mt-4">

            <form action="process/landlord_full_process.php" method="post" enctype="multipart/form-data">


                <div>


                    <label for="username"><b>Username:</b></label>
                    <input type="text" name="landlord_username" class="form-control"
                        value="<?php echo $_SESSION["landlord_username"] ?? ""; ?>"
                        placeholder="type your username here">





                </div>

                <div>

                    <label for="email" class="form-label"><b>Landlord's email:</b></label>
                    <input type="email" name="landlord_email" class="form-control"
                        value="<?php echo $_SESSION["landlord_email"] ?? ""; ?>" placeholder="type your email here">

                </div>


                <div>

                    <label for="phone_number" class="form-label"><b>Landlord's Phone Number:</b></label>
                    <input type="text" name="landlord_mobile" class="form-control"
                        value="<?php echo $_SESSION["landlord_mobile"] ?? ""; ?>"
                        placeholder="type your phone number here">

                </div>


                <div>
                    <label for="Password" class="form-label"><b>Password:</b></label>
                    <input type="password" name="landlord_password" class="form-control" value=""
                        placeholder="type your password here" required>



                </div>


                <div>
                    <label for="surname" class="form-label"><b>Landlord's surname:</b></label>
                    <input type="text" name="landlord_surname" class="form-control "
                        placeholder="type your surname here" required>



                </div>


                <div>


                    <label for="firstname" class="form-label"><b>Landlord's firstname:</b></label>
                    <input type="text" name="landlord_firstname" class="form-control "
                        placeholder="type your firstname here" required>


                </div>
                <div>

                    <label for="middlename" class="form-label"><b>Landlord's middlename:</b></label>
                    <input type="text" name="landlord_middlename" class="form-control"
                        placeholder="type your surname here" required>

                </div>




                <div>
                    <label for="house address" class="form-label"><b>Landlord's home address:</b></label>
                    <textarea name="landlord_permanent_homeaddress" id="" class="form-control" required></textarea>
                </div>

                <div>
                    <label for="pic1" class="form-label"><b>Landord's Passport photo:</b></label>
                    <input type="file" name="pic1" class="form-control">
                    <small>Compulsory upload. Allowed formats: JPG, PNG, GIF not more than 2MB & clear</small><br>
                </div>



                <div style="display: flex; justify-content: center;">
                    <button class="btn btn-success mb-3 mt-3" name="landlord_full_btn" type="submit"
                        style="">Submit</button>
                </div>


            </form>

        </div>

        <div class="col-lg-6 col-sm-12 col-md-6 mt-4 pt-4" >
            <img src="images/house14.jpg" alt="house image" class="img-fluid">
        </div>





    </div>
</div>




<?php  include_once __DIR__ . "/footer.php" ?>