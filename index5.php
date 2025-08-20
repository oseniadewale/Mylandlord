
<?php 

$page_title = "Home Page"; // or "Login", "Dashboard", etc.);
$base_url = 'http://localhost/LANDLORD';
include_once("header.php");



?>



   
    <style>
        

        .colA p {
            font-size: 50px;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            margin-top: 20px;
        }

        .colA {
            background-color: #D1E7DD;";

        }

        .mybtn {
            display: flex;
            align-items: end;
        }

        .myimgcover{
            background-image: linear-gradient(rgba(0,0,0,0.1)), url("images/house12.jpg");
            background-position: center;
            background-repeat: no-repeat;
            background-size: 123vh;
            display:flex;
            align-items: end;
            justify-items: center;
            color: black;
            
           
        }

        .indexbtn {
          background-color:green;
            color: white;
      
            padding: 10px 20px;
           
            justify-self: center;

        }

        .indexbtn:hover {
            filter: brightness(0.9);
             background-color:green;
              font-weight: bold;
               color: white;
        }
    </style>
</head>

<body>
    <div class="container-fluid">

        
    </div>
    <div class="container">
        <br><br><br>
        <div class="row">


            <div class="col-lg-7 colA">
                <p style="color:green">Connecting Directly Home Owners with Tenants</p>
                <h4 style="color:green">Begin your search here using the below criteria:</h4>


                <form action="process/show_index_process.php" method="POST">
                    <div class="row">

                        <div class="col-md-6 mb-3 form-group">
                            <label for="state" class="form-label"><b>State:</b></label>





                            <select onchange="toggleLGA(this);" name="state" id="state" class="form-control "  required>
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


                        <div class="col-md-6 mb-3 form-group">


                            <label class="control-label"><b>LGA Of House location:</b></label>
                            <select name="lga" id="lga" class="form-control select-lga mt-4">
                            </select>



                        </div>


                        <div class="col-md-6 mb-3">

                            <label for="price" class="form-label"><b>Price:</b></label>
                            <!-- <select name="price" id="price" class="form-select" required> <i>fa-</i>
                                <option value="fifty_thousand">0 - ₦50,000</option>
                                <option value="one_hundred_thousand">₦50,000 - ₦100,000</option>
                                <option value="two_hundred_thousand">₦100,000 - ₦200,000</option>
                                <option value="five_hundred_thousand">₦200,000 - ₦500,000</option>
                                <option value="one_million">₦500,000 - ₦1,000,000</option>
                                <option value="two_million">₦1,000,000 - ₦2,000,000</option>
                                <option value="five_million">₦2,000,000 - ₦5,000,000</option>
                                <option value="ten_million">₦5,000,000 - ₦10,000,000</option>
                                <option value="twenty_million">₦10,000,000 - ₦20,000,000</option>
                                <option value="fifty_million">₦20,000,000 - ₦50,000,000</option>
                                <option value="one_hundred_million">₦50,000,000 - ₦100,000,000</option>
                                <option value="above_one_hundred_million">Above ₦100,000,000</option>




                            </select> -->

                            <select name="price" id="price" class="form-select" required> <i>fa-</i>
                        <option value="1">0 - ₦50,000</option>
                        <option value="2">₦50,000 - ₦100,000</option>
                        <option value="3">₦100,000 - ₦200,000</option>
                        <option value="4">₦200,000 - ₦500,000</option>
                        <option value="5">₦500,000 - ₦1,000,000</option>
                        <option value="6">₦1,000,000 - ₦2,000,000</option>
                        <option value="7">₦2,000,000 - ₦5,000,000</option>
                        <option value="8">₦5,000,000 - ₦10,000,000</option>
                        <option value="9">₦10,000,000 - ₦20,000,000</option>
                        <option value="10">₦20,000,000 - ₦50,000,000</option>
                        <option value="11">₦50,000,000 - ₦100,000,000</option>
                        <option value="12">Above ₦100,000,000</option>




                    </select>





                        </div>

                        <div class="col-md-6 mb-3">

                            <label for="house_type" class="form-label"><b>House Type:</b></label>
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
                    </div>

                    <div class="col-12 text-center mt-3">
                        <button type="submit" name="search_index" class="btn indexbtn mt-2">Search</button>


                    </div>





                </form>

            </div>


            <div class="col-lg-5 myimgcover ">
               

                
            </div>
        </div>

    </div>
    <div class="container">
        <br>
        <div class="row">
            <div class="col-lg-6" style="display:flex; align-items:center; justify-content:center">
                <span style="margin-right:5px"> <b style="color:green"> If new, signup here as Landlord </b>⇒ </span>
                 <a href="landlord_signup_form3.php"><button class="btn mybtn btn-success mt-4">Landlord Signup</button></a>


            </div>
            <div class="col-lg-6" style="display:flex; align-items:center; justify-content:center">
                <span> <b style="color:green"> If new, signup here as Tenant</b> ⇒ </span> <br>
                 <a href="tenant_signup_form3.php"><button class="btn mybtn btn-success mt-4">Tenant Signup</button></a>


            </div>



 </div>

 <br>
 <br>





<div class="row">
    <div class="col-lg-6"  style="display:flex; align-items:center; justify-content:center">
          <span> <b  style="color:green"> Already Registered, login here as a landlord</b> ⇒  </span> <br>
                    <a href="landlord_login.php"> <button class="btn mybtn btn-success btn-sm mt-4 " style=" color:white; border-radius:30%">Landlord Login</button></a> 



    </div>

    <div class="col-lg-6"  style="display:flex; align-items:center; justify-content:center">
          <span> <b style="color:green"> Already Registered, login here as a Tenant</b> ⇒  </span>
                     <a href="tenant_login.php"><button class="btn mybtn btn-success btn-sm mt-4 " style=" color:white; border-radius:30%">Tenant Login</button></a> 


    </div>
</div>

<br>
<br>



         
       
        <div class="row mt-3">

            <h4 style="display:flex; justify-content:center"><i>Simplifying your house renting experience...</i></h4>

        </div>


        <div class="row">
            <div class="col col-lg-6 mt-3">
                <img src="images/house2.jpg" alt="picture of a house" class="img-fluid">

            </div>
            <div class="col col-lg-6 mt-3">
                <img src="images/house3.jpg" alt="picture of a second house" class="img-fluid">

            </div>
            <h3 class="mt-4" style="margin-left:40px">TESTIMONIALS</h3>
            <br>
            <span class="mb-4">See our testimonials:</span>

            <br>
            <br>
            <br>


        </div>

        <div class="row " style="display:flex; justify-content:center">
            <div class="col-lg-3">
                <img src="images/house4.jpg" alt="" class="img-fluid">
            </div>
            <div class="col-lg-3">
                <img src="images/house9.jpg" alt="" class="img-fluid">

            </div>
            <div class="col-lg-3">
                <img src="images/house6.jpg" alt="" class="img-fluid">

            </div>
            <div class="col-lg-3">
                <img src="images/house7.jpg" alt="" class="img-fluid">

            </div>

           

        </div>

    </div>
    <div class="row mt-5">
        <?php

        include_once "footer.php";


        ?>

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

</body>

</html>