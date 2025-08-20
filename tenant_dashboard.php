<?php 
session_start();
$base_url = 'http://localhost/LANDLORD';
include_once("header.php");
include_once "classes/Tenant.php";
include_once "classes/Payment.php";

if (!isset($_SESSION["tenant_id"])) {
    header("Location: tenant_signup_form3.php");
    exit();
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
    <span style="color:blue; margin-left: 5px"><?= htmlspecialchars($_SESSION["tenant_username"]) ?>!</span> 
    <span style="margin-left:10px">This is your personal dashboard.</span>
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
    <?php if (empty($payments)): ?>
        <div class="alert alert-success ms-1 me-1">
            You have not made any rent payments yet.
            <a href="available_houses.php" class="btn btn-success mt-2 ms-1">Browse Houses</a>
        </div>
    <?php else: ?>
        <h4>Your Payment History</h4>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>House Type</th>
                    <th>Amount Paid</th>
                    <th>Status</th>
                    <th>Payment Date</th>
                    <th>Reference Code</th>
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
                        <td><?= ($pay['reference_code']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
       
    <?php endif; ?>
<?php endif; ?>
 <div class="mt-4">
            <a href="available_houses.php" class="btn btn-success ms-1">Browse Houses(s)</a>
        </div>

<div class="mt-3">
    <p>Register here as a landlord <a href="register_tenant_as_landlord.php"><b>Register As Landlord</b></a> </p>

    <p>Drop a Suggestion here: <a href="landlord_suggestion.php"><button style="color:green"><img src="images/suggestion_icon.png" alt="icon" width="20px" style="margin-right:3px">Tenant Suggest</button></a></p>



</p>
<p>Recommend a <strong style="color:black">house</strong> here: <a href="house_recommendation.php"><button style="color:green"><img src="images/house2_icon.png" alt="icon" width="20px" style="margin-right:3px">Tenant recommend</button></a></p>


<p>Recommend a <strong style="color:green">landlord</strong> here: <a href="tenant_recommendation_form
.php"><button style="color:green"><img src="images/recommendation_icon.png" alt="icon" width="20px" style="margin-right:3px">Tenant recommend</button></a></p>
   
    <a href="tenant_rentals.php" ><button style="color:green"><img src="images/my_rentals_icon.png" width="25px" class="margin-right:10px">My Rentals</button></a>

<a href="tenant_logout.php" class="btn btn-danger ms-1" >Logout</a>
</div>

<?php include_once "footer.php"; ?>
