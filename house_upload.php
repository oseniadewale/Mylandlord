<?php
session_start();
$base_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

include_once __DIR__ . "/header.php";





if (!isset($_SESSION["landlord_id"])) {
    echo "You are not logged in.";
    exit();
}
















?>

<style>
    button {
        text: center;
    }
</style>

<body>
    <div class="container">
        <div class="row">
            <div class="col mt-4 pt-4">
                <?php if(isset($_SESSION["house_not_uploaded"])){

                    echo $_SESSION["house_not_uploaded"];
                    unset($_SESSION["house_not_uploaded"]);
                }?>

            </div>
        </div>
        <div class="row">
            <div class="col mt-4">
                            <h3 class="mt-4 pt-4" style="display:flex; justify-content:center; color:green"><img src="images/star.png" width="28" alt="star image">House Upload Page <img src="images/star.png" class="img-fluid" width="28" alt="star image"></h3>
            </div>
        </div> 
        <div class="row">

            <div class="col col-lg-7">

 
                <?php

                if(isset( $_SESSION["picture1_error"]) || isset($_SESSION["picture1_size"]) || isset($_SESSION["picture1_type_error"])
                    
                   || isset( $_SESSION["picture2_error"]) || isset($_SESSION["picture2_size"]) || isset($_SESSION["picture2_type_error"])

                     || isset( $_SESSION["picture3_error"]) || isset($_SESSION["picture3_size"]) || isset($_SESSION["picture3_type_error"])
                         || isset( $_SESSION["picture4_error"]) || isset($_SESSION["picture4_size"]) || isset($_SESSION["picture4_type_error"])
                          || isset( $_SESSION["picture3_error"]) || isset($_SESSION["picture3_size"]) || isset($_SESSION["picture3_type_error"])
                            || isset( $_SESSION["picture5_error"]) || isset($_SESSION["picture5_size"]) || isset($_SESSION["picture5_type_error"])
                             || isset( $_SESSION["picture6_error"]) || isset($_SESSION["picture6_size"]) || isset($_SESSION["picture6_type_error"])
                              || isset( $_SESSION["picture7_error"]) || isset($_SESSION["picture7_size"]) || isset($_SESSION["picture7_type_error"])

                    
                    
                    ){
                        echo"<div alert alert-danger>
                         <span style='color:red'>There is an error in your upload</span>
                        
                        </div>";
                       
                    }
                
                ?>
          

                <form action="process/house_process.php" method="post" enctype="multipart/form-data">
                    <div>
                        <label for="house_type"><b>House Type</b></label>
                        <select name="house_type" id="house_type" class="form-select" required>
                            <option value="one_room">One room</option>
                            <option value="one_room_self_contain">One room self contain</option>
                            <option value="room_and_parlor">One room with Parlor</option>
                            <option value="two_bedroom_flat">Two bedroom flat</option>
                            <option value="three_bedroom_flat">Three bedroom flat</option>
                            <option value="four_bedroom_flat">Four Bedroom flat</option>
                            <option value="five_bedroom_flat">Five Bedroom Flat</option>
                            <option value="duplex">Duplex</option>
                            <option value="others">Others</option>
                        </select>
                    </div>

                    <div>
                        <label for="state"><b>State:</b></label>
                        <select onchange="toggleLGA(this);" name="state" id="state" class="form-control " required>
                            <option value="" selected="selected">- Select -</option>
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

                    <div>
                        <label class="control-label"><b>LGA Of House location:</b></label>
                        <select name="lga" id="lga" class="form-control select-lga mt-4">
                        </select>

                    </div>





                    <div>

                        <label for="price" class="form-label"><b>Price Range For the House:</b></label>
                        <select name="price" id="price" class="form-select" required> <i>fa-</i>
                            <option value="1">0 - ₦50,000</option>
                            <option value="2">₦50,000 - ₦100,000</option>
                            <option value="3">₦100,000 - ₦200,000</option>
                            <option value="4">₦200,000 - ₦500,000</option>
                            <option value="5">₦500,000 - ₦1,000,000</option>
                            <option value="5">₦1,000,000 - ₦2,000,000</option>
                            <option value="6">₦2,000,000 - ₦5,000,000</option>
                            <option value="7">₦5,000,000 - ₦10,000,000</option>
                            <option value="8">₦10,000,000 - ₦20,000,000</option>
                            <option value="9">₦20,000,000 - ₦50,000,000</option>
                            <option value="10">₦50,000,000 - ₦100,000,000</option>
                            <option value="11">Above ₦100,000,000</option>

                        </select>

                    </div>

                    <div>
                        <label for="actual_price" class="label-form"><b>Actual price in ₦</b></label>
                        <input type="number" name="actual_price" class="form-control">

                    </div>



                    <div>
                        <label for="rent_duration"><b>Rentage Period</b></label>
                        <input type="text" name="rent_duration" class="form-control">



                    </div>





                    <div>


                        <label for="picture_1"><b>Picture 1</b></label>
                        <input type="file" class="form-control" name="pic1" required
                            placeholder="compulsory picture upload">
                        <small style="color:grey">Compulsory upload .Allowed formats: JPG, PNG, GIF not more than 2MB</small><br>
                        <label for="picture_2"><b>Picture 2</b></label>

                        <input type="file" class="form-control" name="pic2" required
                            placeholder="compulsory picture upload">
                        <small style="color:grey">Compulsory upload. Allowed formats: JPG, PNG, GIF not more than 2MB</small><br>
                        <label for="picture_3"><b>Picture 3</b></label>
                        <input type="file" class="form-control" name="pic3" placeholder="compulsory picture upload">
                        <small style="color:grey">Compulsory upload. Allowed formats: JPG, PNG, GIF not more than 2MB</small><br>
                        <br>
                        <label for="picture_4"><b>Picture 4</b></label>
                        <input type="file" class="form-control" name="pic4">
                        <small style="color:grey">Not Compulsory but recommended upload. Allowed formats: JPG, PNG, GIF not more than
                            2MB</small><br>
                        <br>
                        <label for="picture_5"><b>Picture 5</b></label>
                        <input type="file" class="form-control" name="pic5">
                        <small style="color:grey">Not Compulsory but recommended upload. Allowed formats: JPG, PNG, GIF not more than
                            2MB</small><br>
                        <br>
                        <label for="picture_6"><b>Picture 6</b></label>
                        <input type="file" class="form-control" name="pic6">
                        <small style="color:grey">Not Compulsory but recommended upload. Allowed formats: JPG, PNG, GIF not more than
                            2MB</small><br>
                        <br>
                        <label for="picture_7"><b>Picture 7</b></label>
                        <input type="file" class="form-control" name="pic7">
                        <small style="color:grey">Not Compulsory but recommended upload. Allowed formats: JPG, PNG, GIF not more than
                            2MB</small><br>
                        <br>


                    </div>



                    <div>
                        <label for="landlord_house_location" class="label-control"><b>Actual House Location :</b></label>
                        <textarea name="house_location" id="" class="form-control"
                            placeholder="write the actual location of the house here" required></textarea>

                    </div>
                    <div>
                        <b>House features</b> <br>

                        <label><input type="checkbox" name="house_features[]" value="Gated"> Gated</label><br>
                        <label><input type="checkbox" name="house_features[]" value="has_no_gate"> No Gate</label><br>
                        <label><input type="checkbox" name="house_features[]" value="fenced">Has Fence</label><br>
                        <label><input type="checkbox" name="house_features[]" value="not_fenced">Has no
                            Fence</label><br>
                        <label><input type="checkbox" name="house_features[]" value="Metered Electricity"> Metered
                            Electricity</label><br>
                        <label><input type="checkbox" name="house_features[]" value="Shared Metered Electricity"> Shared
                            Metered Electricity</label><br>

                        <label><input type="checkbox" name="house_features[]"
                                value="currently_has_no_metered_electricity_but_working_to_get_one"> No meter yet but
                            working to get one</label><br>
                        <label><input type="checkbox" name="house_features[]" value="has_parking_space"> Has parking
                            space</label> <br>
                        <label><input type="checkbox" name="house_features[]" value="has_no_parking_space"> Has no
                            parking space</label><br>
                        <label><input type="checkbox" name="house_features[]" value="Allow pets"> Allow pet
                        </label> <br>
                        <label><input type="checkbox" name="house_features[]" value="room_or_house_tiled">Room or house
                            tiled</label> <br>

                        <label><input type="checkbox" name="house_features[]" value="room_or_house_not_tiled">Room or
                            house not tiled</label> <br>
                        <label><input type="checkbox" name="house_features[]" value="bore_hole_water">Borehole
                            Water</label> <br>

                        <label><input type="checkbox" name="house_features[]" value="well_water">Well Water</label> <br>
                        <label><input type="checkbox" name="house_features[]" value="no_water_in_compound">No water
                            source in compound</label> <br>



                    </div>
                    <br>

                    <div>
                        <label for="notice_for_tenant" class="label-control"> Any other notice for tenant: </label>
                            <textarea name="notice_for_tenant" id="" class="form-control" placeholder="write any other notification for the tenant here"></textarea>
                        
                    </div> 
                    <div style="margin-top:4px; display:flex; justify-content:center; text-center">

                      <button name="housebtn" class="btn btn-success house_btn">Submit</button>


                    </div>

                  











                </form>

            </div>
            <div class="col-lg-5 col-sm-12">
                <img src="images/house8.jpg" alt="house picture 1" class="img-fluid">
                
                <img src="images/house9.jpg" alt="house picture 2" class="img-fluid">
                 <img src="images/house10.jpg" alt="house picture 3" class="img-fluid">
                  <img src="images/house13.jpg" alt="house picture 4" class="img-fluid">
                   <img src="images/house14.jpg" alt="house picture 5" class="img-fluid">
                   
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col" style="display:flex; align-items:center; justify-content:center">
                <a href="landlord_dashboard.php" class="btn btn-success"> ← Go back to Landlord dashboard</a>
            </div>



        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
        crossorigin="anonymous"></script>
    <script src="js/lga.min.js"></script>



    <?php  include_once __DIR__ . "/footer.php"?>