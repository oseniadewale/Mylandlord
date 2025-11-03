<?php
session_start();


if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}
$base_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

include_once __DIR__ . "/header.php";



require_once "classes/Admin.php";



$admin = new Admin();
$landlords = $admin->getAllLandlords();
$tenants = $admin->getAllTenants();
$houses = $admin->getAllHouses();


?>

<div class="container mt-5 pt-5">
    <h5 class="mt-4 ms-1 d-flex align-items-center justify-content-center">
    <img src="images/admin_icon.png" alt="icon" class="img-fluid me-2" style="width: 20px; height: 20px;">
    Welcome 
    <span style="color:blue; margin-left: 5px"><?php echo $_SESSION["admin_username"] ?>!</span> 
    <span style="margin-left:10px">This is your personal admin's dashboard.</span>
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


   

    <h4 class="mt-5">Landlords</h4>
    <table class="table table-bordered table-striped" border="1">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($landlords as $i => $landlord): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= $landlord['landlord_username'] ?></td>
                <td><?= $landlord['landlord_email'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <h4 class="mt-5">Tenants</h4>
    <table class="table table-bordered table-striped" border="1">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($tenants as $i => $tenant): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= $tenant['tenant_username'] ?></td>
                <td><?= $tenant['tenant_email'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <h4 class="mt-5">Houses</h4>
    <table class="table table-bordered table-striped" border="1">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Location</th>
                <th>Type</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($houses as $i => $house): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= $house['location'] ?></td>
                <td><?= $house['house_type'] ?></td>
                <td><?= '₦'.number_format($house['actual_price'], 2)?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php  include_once __DIR__ . "/footer.php" ?>
