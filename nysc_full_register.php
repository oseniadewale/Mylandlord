<?php
session_start();
$base_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

include_once __DIR__ . "/header.php";


?>

<div class="container">
    <div class="row">
        <div class="col">
             <?php if (isset($_SESSION['Db_unique_error'])): ?>
        <div class="alert alert-danger container-fluid mt-4">
            <?= $_SESSION['Db_unique_error']; ?>
        </div>
        <?php unset($_SESSION['Db_unique_error']); ?>
    <?php endif; ?>
        </div>
    </div>
     <div class="row">
        <div class="col" style="display:flex; justify-content:center">
            <?php 
            if(isset(  $_SESSION["nysc_picture1_error"])){
                echo   $_SESSION["nysc_picture1_error"];
                unset(  $_SESSION["nysc_picture1_error"]);
            }
            if(isset($_SESSION["nysc_picture1_size"])){
                echo $_SESSION["nysc_picture1_size"];
                unset($_SESSION["nysc_picture1_size"]);
            }
            
            ?>
        </div>
    </div>
    <div class="row">

        <h2 class="mt-4" style="color:green; display:flex; align-items:center; justify-content:center;">
            NYSC ONLY Registration:
        </h2>

        <div class="col-6 mt-4">
            <p style="color:green">Do fill this form as an NYSC corper</p>

            <form action="process/nysc_full_process.php" method="post" enctype="multipart/form-data">

                <div>
                    <div class="sm">
                        <?php if (isset($_SESSION["tenant_username_error"])) {
                            echo "<span style='color:red'>" . $_SESSION['tenant_username_error'] . " </span>";
                            unset($_SESSION["tenant_username_error"]);
                        } ?>
                    </div>
                    <label for="tenant_username"><b>Corper's Username:</b></label>
                    <input type="text" name="tenant_username" class="form-control"
                        placeholder="Type your username here">
                </div>

                <div>

                    <label for="email" class="form-label"><b>Corper's Email:</b></label>
                    <input type="email" name="tenant_email" class="form-control" placeholder="Type your email here">
                </div>

                <div>
                    <label for="tenant_number" class="form-label"><b>Corper's Phone Number:</b></label>
                    <input type="text" name="tenant_mobile" class="form-control"
                        placeholder="Type your phone number here">
                </div>

                <div>
                    <div class="sm">
                        <?php if (isset($_SESSION["tenant_password_error"])) {
                            echo "<span style='color:red'>" . $_SESSION['tenant_password_error'] . " </span>";
                            unset($_SESSION["tenant_password_error"]);
                        } ?>
                    </div>
                    <label for="tenant_password" class="form-label"><b>Password:</b></label>
                    <input type="password" name="tenant_password" class="form-control"
                        placeholder="Type your password here" required>
                </div>

                <div>
                    <div class="sm">
                        <?php if (isset($_SESSION["confirm_tenant_password_error"])) {
                            echo "<span style='color:red'>" . $_SESSION['confirm_tenant_password_error'] . " </span>";
                            unset($_SESSION["confirm_tenant_password_error"]);
                        } ?>
                    </div>
                    <label for="confirm_tenant_password" class="label-control"><b>Confirm Password:</b></label>
                    <input type="password" class="form-control mb-3" name="confirm_tenant_password"
                        placeholder="reenter the password here again" required>

                </div>


                <div>
                    <label for="surname" class="form-label"><b>Corper's Surname:</b></label>
                    <input type="text" name="tenant_surname" class="form-control" placeholder="Type your surname here"
                        required>
                </div>

                <div>
                    <label for="firstname" class="form-label"><b>Corper's Firstname:</b></label>
                    <input type="text" name="tenant_firstname" class="form-control"
                        placeholder="Type your firstname here" required>
                </div>

                <div>
                    <label for="middlename" class="form-label"><b>Corper's Middlename:</b></label>
                    <input type="text" name="tenant_middlename" class="form-control"
                        placeholder="Type your middlename here">
                </div>

                <div>
                    <label for="tenant_home_address" class="form-label"><b>Corper's Home Address:</b></label>
                    <textarea name="tenant_home_address" class="form-control"
                        placeholder="Enter your address here"></textarea>
                </div>

                <div>
                    <label for="pic1" class="form-label"><b>Corper's Passport photo:</b></label>
                    <input type="file" name="pic1" class="form-control">
                    <small>Compulsory upload. Allowed formats: JPG, PNG, GIF not more than 2MB & clear</small><br>
                </div>

                
                <div>
                    <label for="serving_state" class="label-control"><b>Serving State:</b></label>
                    <select name="serving_state" id="" class="form-control" required>
                        <option value="" selected="selected">- Select state -</option>
                        <option value="Abia">Abia</option>
                        <option value="Adamawa">Adamawa</option>
                        <option value="AkwaIbom">AkwaIbom</option>
                        <option value="Anambra">Anambra</option>
                        <option value="Bauchi">Bauchi</option>
                        <option value="Bayelsa">Bayelsa</option>
                        <option value="Benue">Benue</option>
                        <option value="Borno">Borno</option>
                        <option value="Cross River">Cross River</option>
                        <option value="Delta">Delta</option>
                        <option value="Ebonyi">Ebonyi</option>
                        <option value="Edo">Edo</option>
                        <option value="Ekiti">Ekiti</option>
                        <option value="Enugu">Enugu</option>
                        <option value="FCT">FCT</option>
                        <option value="Gombe">Gombe</option>
                        <option value="Imo">Imo</option>
                        <option value="Jigawa">Jigawa</option>
                        <option value="Kaduna">Kaduna</option>
                        <option value="Kano">Kano</option>
                        <option value="Katsina">Katsina</option>
                        <option value="Kebbi">Kebbi</option>
                        <option value="Kogi">Kogi</option>
                        <option value="Kwara">Kwara</option>
                        <option value="Lagos">Lagos</option>
                        <option value="Nasarawa">Nasarawa</option>
                        <option value="Niger">Niger</option>
                        <option value="Ogun">Ogun</option>
                        <option value="Ondo">Ondo</option>
                        <option value="Osun">Osun</option>
                        <option value="Oyo">Oyo</option>
                        <option value="Plateau">Plateau</option>
                        <option value="Rivers">Rivers</option>
                        <option value="Sokoto">Sokoto</option>
                        <option value="Taraba">Taraba</option>
                        <option value="Yobe">Yobe</option>
                        <option value="Zamfara">Zamafara</option>
                    </select>
                </div>

                <div class="form-check mt-3">
                    <input type="checkbox" class="form-check-input" name="nysc_user" value="nysc" required>
                    <label class="form-check-label" for="nysc_user">
                        <span style="color:green"><b>Corper's</b></span> confirmation box
                    </label>
                </div>

                <div class="text-center">
                    <button class="btn mb-3 mt-3" style="background: linear-gradient(to right, green 33.33%, white 33.33%, white 66.66%, green 66.66%);
            color: black; border: 2px solid green; padding: 10px 20px; font-weight: bold;justify-self: border-radius:30% center;
        }" name="nysc_full_btn" type="submit">Submit</button>
                </div>

            </form>
        </div>

        <div class="col-lg-6 secondcol">

            <img src="images/house4.jpg" alt="houseimage"><br>
            <img src="images/house5.jpg" alt="houseimage2">

        </div>

    </div>
</div>

<?php  include_once __DIR__ . "/footer.php" ?>