<?php 
session_start();
$base_url = 'http://localhost/mylandlord';
include_once("header.php");
include_once "classes/Tenant.php";
include_once "classes/Payment.php";

if (!isset($_SESSION["tenant_id"])) {
    header("Location: tenant_signup_form3.php");
    exit();
}

if(  isset($_SESSION['tenant_show_index_error'])){
    echo  "<span style='margin-top:30px'>".$_SESSION['tenant_show_index_error']."</span>" ;
    unset($_SESSION['tenant_show_index_error']); // Clear the error after displaying
}

$show_dashboard = true;
$nysc_message = ""; // Collect NYSC messages here

// NYSC logic
if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'nysc') {
    if (!isset($_SESSION['nysc_rent_start'])) {
        $nysc_message .= "<div class='alert alert-danger mt-3'>You have not rented a house. Do browse for your choice house below:</div>";
        $show_dashboard = false;
    } else {
        $start = new DateTime($_SESSION['nysc_rent_start']);
        $now = new DateTime();
        $interval = $start->diff($now);
        $total_months = $interval->y * 12 + $interval->m;

        if ($total_months >= 10 && $total_months < 12) {
            $months_left = 12 - $total_months;
            $nysc_message .= "<div class='alert alert-warning'>
                Your NYSC account will expire in <strong>$months_left</strong> month(s).
                <a href='upgrade_to_tenant.php' class='btn btn-sm btn-primary'>Upgrade now</a>.
            </div>";
        } elseif ($total_months >= 12) {
            $nysc_message .= "<div class='alert alert-danger'>
                Your NYSC account has expired.
                <a href='upgrade_to_tenant.php' class='btn btn-sm btn-danger'>Upgrade now</a> to continue using the dashboard.
            </div>";
            $show_dashboard = false;
        }
    }
}

// Load payments only if dashboard should show
$payments = [];
$number = 1;
if ($show_dashboard) {
    $paymentObj = new Payment();
    $payments = $paymentObj->getPaymentsByTenant($_SESSION["tenant_id"]);
}
?>
<?php 
if (isset($_SESSION["tenant_not_set"])) {
    echo '<div class="alert alert-danger mt-4">' . $_SESSION["tenant_not_set"] . '</div>';
    unset($_SESSION["tenant_not_set"]); // optional: clears the message after displaying
}


?>

<h5 class="mt-4 ms-1 d-flex align-items-center justify-content-center">
    <img src="images/tenant_icon.png" alt="icon" class="img-fluid me-2" style="width: 20px; height: 20px;">
    Welcome 
    <span style="color:blue; margin-left: 5px"><?= ($_SESSION["tenant_username"]) ?>!</span> 
    <span style="margin-left:10px">This is your personal dashboard(<span style="color:blue; margin-left:3px">as a tenant</span>).</span>
</h5>

<h6 class="mt-4 ms-1" style="display:flex;justify-content:center">
    <?php 

    date_default_timezone_set('Africa/Lagos');

$now = new DateTime(); // or set your timezone as needed

$day   = $now->format('j');         // Day without leading 0
$month = $now->format('F');         // Full month name
$year  = $now->format('Y');         // 4-digit year
$time  = $now->format('g:ia');      // 12-hour format, no leading zero, with am/pm

// Get the ordinal suffix (st, nd, rd, th)
function getOrdinal($day) {
    if (!in_array(($day % 100), [11, 12, 13])) {
        switch ($day % 10) {
            case 1: return 'st';
            case 2: return 'nd';
            case 3: return 'rd';
        }
    }
    return 'th';
}

$ordinal = getOrdinal($day);

// Final output
echo "Today is {$day}{$ordinal} {$month}, {$year} and currently the time is {$time} in Nigeria(Africa/Lagos time zone).";
?>

</h6>



 

<?= $nysc_message ?>

<?php if ($show_dashboard): ?>
    <hr>
    <div class="row">
        <div class="col">

        </div>
    </div>
    <?php if (empty($payments)): ?>
        <div class="alert alert-success ms-1 me-1">
            You have not made any rent payments yet.
            <a href="available_houses.php" class="btn btn-success mt-2 ms-1">Browse Houses</a>
        </div>
    <?php else: ?>
        <div style="margin-left:3px; padding:3px">
             <h3>Your Payment History</h3>
        <table class="table table-bordered table-striped" border='1'>
            <thead>
                <tr>
                    <th>SN</th>
                    <th>House Type</th>
                    <th>Amount Paid</th>
                    <th>Status</th>
                    <th>Payment Date</th>
                    <th>Paid by</th>
                    <th>Reference Code</th>
                      <th>Image of house rented</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($payments as $pay): ?>
                    <tr>
                        <td><?= $number++ ?></td>
                        <td><?= ($pay['house_type']) ?></td>
                        <td>₦<?= number_format($pay['amount_paid'], 2) ?></td>
                        <td><?= ($pay['payment_status']) ?></td>
                        <td><?= ($pay['payment_date']) ?></td>
                         <td><?= ($pay['tenant_username']) ?></td>
                        <td><?= ($pay['reference_code']) ?></td>
                        <td><img src="<?= $base_url . '/' . ($pay['picture_1']) ?>" width="150px"></td> 
                        
                       
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
       
    <?php endif; ?>
<?php endif; ?>

        </div>
       
 <div class="mt-4">
            <a href="available_houses.php" class="btn btn-success ms-1">Browse Houses(s)</a>
        </div>

        <hr>

        <h6 style="padding: 5px; margin-left:5px">You can also do your search here using the following criteria to tailor your search here: <b><span  style='color:blue;'>⇓</span></b></h6> <br>

        <div class="container-fluid">
            <form action="process/tenant_show_index_process.php" method="POST">
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

                            <label for="price" class="form-label"><b>Price Range:</b></label>
                          

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
                        <button type="submit" name="search_index" class="btn btn-success" style='color:white'>Criteria Search</button>


                    </div>





                </form>

        </div>

<div class="mt-3" style="margin:10px">
    <p>Register here as a landlord <a href="register_tenant_as_landlord.php"><b>Register As Landlord</b></a> </p>

    <p>Switch to a landlord <a href="landlord_dashboard.php"><img src="" alt=""> <img src="images/switch_icon.png" alt="icon" class="img-fluid me-2" style="width: 20px; height: 20px;">Switch to a landlord</a>

   <?php $_SESSION["landlord_id"] = $_SESSION["tenant_id"] ?>
</p>
 <p>Drop a Suggestion here: <a href="landlord_suggestion.php"><button style="color:green"><img src="images/suggestion_icon.png" alt="icon" width="20px" style="margin-right:3px">Tenant Suggest</button></a></p>
<p>Recommend a <strong style="color:black">house</strong> here: <a href="house_recommendation.php"><button style="color:green"><img src="images/house2_icon.png" alt="icon" width="20px" style="margin-right:3px">Tenant recommend</button></a></p>


<p>Recommend a <strong style="color:green">landlord</strong> here: <a href="tenant_recommendation_form
.php"><button style="color:green"><img src="images/recommendation_icon.png" alt="icon" width="20px" style="margin-right:3px">Tenant recommend</button></a></p>
   
    <a href="tenant_rentals.php" ><button style="color:green"><img src="images/my_rentals_icon.png" width="25px" class="margin-right:10px">My Rentals</button></a>

<a href="tenant_logout.php" class="btn btn-danger ms-1" >Logout From App</a>
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

<?php include_once "footer.php"; ?>
