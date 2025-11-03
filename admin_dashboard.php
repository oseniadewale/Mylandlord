<?php
session_start();



include_once __DIR__ . "/header.php";

include_once "classes/Admin.php";

// Redirect if not logged in
if (!isset($_SESSION["admin_id"])) {
    header("Location: admin_login.php");
    exit();
}

if(isset( $_SESSION["admin_register_error"])){
    echo  $_SESSION["admin_register_error"];
}







// Initialize Admin class
$admin = new Admin();

// Fetch counts
$landlords = $admin->getAllLandlords();
$tenants = $admin->getAllTenants();
$houses = $admin->getAllHouses();

?>

<style>
    .dashboard-card {
        padding: 20px;
        margin: 15px;
        background-color: #f8f9fa;
        border-left: 5px solid #033d10d6;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .dashboard-card h3 {
        margin: 0;
        font-size: 1.5rem;
    }

    .dashboard-link {
        margin: 10px 0;
        display: block;
        font-weight: bold;
    }
</style>

<div class="container mt-5">
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



    <!-- Summary Widgets -->
    <div class="row">
        <div class="col-md-4">
            <div class="dashboard-card">
               
                <p>Total Registered Landlords: 
                  <?php echo "<strong>".count($landlords)."</strong>";?> 
            
            </p>
            </div>
        </div>
       
        <div class="col-md-4">
            <div class="dashboard-card">
                <p>Total houses uploaded:
                  <?php echo "<strong>".count($houses)."</strong>";?> 
            
            </p>
            </div>
        </div>
         <div class="col-md-4">
            <div class="dashboard-card">
                <p>Total Registered tenants:
                  <?php echo "<strong>".count($tenants)."</strong>";?> 
            
            </p>
            </div>
        </div>
    </div>

   <div class="row mt-4">
    <div class="col-lg-4" style="display:flex; justify-content:center" >
        <a class=" btn btn-success" style="color:black" href="manage_landlords.php"> Manage Landlords<img src="images/landlord_icon.png" style="margin-left:5px" width="30px"></a>

    </div>

     <div class="col-lg-4 ">
         <a class="dashboard-link btn btn-success"style="color:black" href="manage_houses.php"><img src="images/house_icon.png" width="30px"> Manage Houses</a>

    </div>
    <div class="col-lg-4" style="display:flex; justify-content:center">
          <a class=" btn btn-success" style="color:black" href="manage_tenants.php"><img src="images/tenant_icon.png"  style="margin-right:5px"width="30px"> Manage Tenants</a>

    </div>
   
   </div>

    <div class="mt-4">


        
       
        <a class="dashboard-link btn btn-success" href="admin_register.php"> Add New Admin</a>
        <a class="dashboard-link btn btn-danger" href="admin_logout.php"> Logout</a>
    </div>
</div>

<?php include_once __DIR__ . "/footer.php";
 ?>
