<?php
session_start();
include_once "classes/House.php";
include_once "classes/Payment.php";

$base_url = 'http://localhost/LANDLORD';
include_once "header.php";


if (!isset($_SESSION["tenant_id"])) {
    header("Location: tenant_login.php");
    exit();
}


$house_id = $_GET["id"] ?? null;
if (!$house_id) {
    die("Invalid request. House not selected.");
}


$houseObj = new House();
$house = $houseObj->getHouseById($house_id);

if (!$house) {
    die("House not found.");
}



?>
<body>
<h4 class="mt-4">Confirm Rent</h4>
<div class="">

<table class="table table-bordered table-striped mt-4">
    <thead class="table-success">
        <tr>
            <th>Serial Number</th>
            <th>House Image</th>
            <th>House Type</th>
            <th>City/Town/Street</th>
            <th>Local Government</th>
            <th>State</th> 
            <th>Price</th>
            <th>Features</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td style="width: 200px;">
                <img src="<?= $base_url . '/' . $house['picture_1'] ?>" alt="House Image" style="width: 100%; height: auto;">
            </td>
            <td><?= ($house["house_type"]) ?></td>
            <td><?= ($house["location"]) ?></td>
            <td><?= ($house["state_name"]) ?></td>
            <td><?= ($house["lg_name"]) ?></td>
            <td>₦<?= number_format((float)$house["actual_price"]) ?></td>
            <td><?= ($house["house_features"]) ?></td>
        </tr>
    </tbody>
</table>



   


<form method="post">
    <button type="submit" class="btn btn-success">Proceed to Payment</button>
</form>

 <div class="text-center"><p> <a href="tenant_dashboard.php" style="color:green"><b>Click here to go back to your dashboard here</b></a></p></div>
    
</div>

<?php include_once "footer.php"?>


