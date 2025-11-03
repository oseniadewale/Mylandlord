<?php
session_start();
$base_url = 'http://localhost/mylandlord';
$page_title = "Tenant Full Registration";
include_once("header.php");





?>











<body>
    <div class="container">
        <div class="row">
            <div class="col pt-4 mt-4">
                <h3 class="mt-4 pt-4" style="display:flex; justify-content: center; color:green"><img
                        src="images/star.png" width="30">Tenant full Registration page <img src="images/star.png"
                        width="30"></h3>

                <div class="col-6 col-sm-12 mt-4"></div>
            </div>
        </div>

        <div class="row">
        <div class="col" style="display:flex; justify-content:center">
            <?php 
            if(isset(  $_SESSION["tenant_picture1_error"])){
                echo   $_SESSION["tenant_picture1_error"];
                unset(  $_SESSION["tenant_picture1_error"]);
            }
            if(isset($_SESSION["tenant_picture1_size"])){
                echo $_SESSION["tenant_picture1_size"];
                unset($_SESSION["tenant_picture1_size"]);
            }

            if(isset($_SESSION["picture1_type_error"])){
                echo $_SESSION["picture1_type_error"];
                unset($_SESSION["picture1_type_error"]);
            }
            
            ?>
        </div>
    </div>
        <div class="row">



            <form action="process/tenant_full_process.php" method="post" enctype="multipart/form-data">


                <div>


                    <label for="username"><b>Username:</b></label>
                    <input type="text" name="tenant_username" class="form-control"
                        value="<?php echo $_SESSION["tenant_username"]; ?>" placeholder="type your username here">





                </div>

                <div>

                    <label for="email" class="form-label"><b>tenant's email:</b></label>
                    <input type="email" name="tenant_email" class="form-control" value="<?php echo $_SESSION["tenant_email"];











                    ?>" placeholder="type your email here">

                </div>


                <div>

                    <label for="phone_number" class="form-label"><b>tenant's Phone Number:</b></label>
                    <input type="text" name="tenant_mobile" class="form-control"
                        value="<?php echo $_SESSION["tenant_mobile"]; ?>" placeholder="type your phone number here">

                </div>


                <div>
                    <label for="Password" class="form-label"><b>Password:</b></label>
                    <input type="password" name="tenant_password" class="form-control" value=""
                        placeholder="type your password here" required>



                </div>


                <div>
                    <label for="surname" class="form-label"><b>tenant's surname:</b></label>
                    <input type="text" name="tenant_surname" class="form-control " placeholder="type your surname here"
                        required>



                </div>


                <div>


                    <label for="firstname" class="form-label"><b>tenant's firstname:</b></label>
                    <input type="text" name="tenant_firstname" class="form-control "
                        placeholder="type your firstname here" required>

                </div>

                <div>

                    <label for="middlename" class="form-label"><b>tenant's middlename:</b></label>
                    <input type="text" name="tenant_middlename" class="form-control"
                        placeholder="type your surname here">

                </div>




                <div>
                    <label for="tenant_permanent_homeaddress" class="form-label"><b>tenant's permanent home
                            address:</b></label>
                    <textarea name="tenant_permanent_homeaddress" id="" class="form-control"></textarea>
                </div>

                 <div>
                    <label for="pic1" class="form-label"><b>Tenant's Passport photo:</b></label>
                    <input type="file" name="pic1" class="form-control">
                    <small>Compulsory upload. Allowed formats: JPG, PNG, GIF not more than 2MB & clear</small><br>
                </div>



                <div style="display: flex; justify-content: center;">
                    <button class="btn btn-success mb-3 mt-3" name="tenant_full_btn" style="">Submit</button>
                </div>


            </form>

        </div>

        <div class="col-6 col-sm-12">
            <img src="images/house17.jpg" alt="house image" class="img-fluid">
        </div>



    </div>
    </div>



    <?php include_once "footer.php" ?>