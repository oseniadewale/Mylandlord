<?php
session_start();
$base_url = 'http://localhost/tenant';
include_once("header.php");
?>

<div class="container">
    <div class="row">

        <h2 class="mt-4" style="color:green; display:flex; align-items:center; justify-content:center;">
            Corper's House Registration:
        </h2>

        <div class="col-6 mt-4">
            <p style="color:green">Do fill this form as an NYSC corper</p>

            <form action="process/nysc_full_process.php" method="post">

                <div>
                    <div class="sm">
                          <?php if (isset($_SESSION["tenant_username_error"])) {
                            echo "<span style='color:red'>". $_SESSION['tenant_username_error']." </span>";
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
                            echo "<span style='color:red'>". $_SESSION['tenant_password_error']." </span>";
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
                            echo "<span style='color:red'>". $_SESSION['confirm_tenant_password_error']." </span>";
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

                <div class="form-check mt-3">
                    <input type="checkbox" class="form-check-input" name="nysc_user" value="nysc" required>
                    <label class="form-check-label" for="nysc_user">
                        <span style="color:green"><b>Corper's</b></span> confirmation box
                    </label>
                </div>

                <div class="text-center">
                    <button class="btn mb-3 mt-3" style="background: linear-gradient(to right, green 33.33%, white 33.33%, white 66.66%, green 66.66%);
            color: black; border: 2px solid green; padding: 10px 20px; font-weight: bold;justify-self: border-radius:30% center;
        }" name="nysc_full_btn">Submit</button>
                </div>

            </form>
        </div>

        <div class="col-lg-6 secondcol">
            <img src="images/house4.jpg" alt="houseimage"><br>
            <img src="images/house5.jpg" alt="houseimage2">

        </div>

    </div>
</div>

<?php include_once "footer.php"; ?>