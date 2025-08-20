<?php 
session_start();
include_once "classes/landlord.php";
$base_url = 'http://localhost/LANDLORD'; // or use $_SERVER for dynamic path
include_once("header.php");



if (!isset($_SESSION['tenant_id'])) {
    $_SESSION["tenant_not_set"] = "you cant register as a landlord yet as you have not properly signed in; do logout and login again ";
    header("Location: tenant_dashboard.php");

    exit();

}




?>

<div class="row">
    <div class="col-lg-6 mt-4">
        <form action="process/register_tenant_as_landlord_process.php" method="POST">
            <label for="landlord_username" class="form-label">Username:</label>
    <input type="text" name="landlord_username"  value="<?= $_SESSION['tenant_username'] ?>" class="form-control" required>
    <label for="landlord_email" class="form-label">Email:</label>
    <input type="email" name="landlord_email" value="<?= $_SESSION['tenant_email'] ?>" class="form-control"required>

    <label for="landlord_mobile" class="form-label">Phone Number:</label>
    <input type="text" name="landlord_mobile" value="<?= $_SESSION['tenant_mobile'] ?>" class="form-control" required>

    <label for="landlord_password" class="form-label">Password</label>
    <input type="password" name="landlord_password" class="form-control" placeholder="enter the same password you used for your tenant registration"required>
    <button type="submit" class="btn btn-success">Create landlord Profile</button>
</form>

    </div>
</div>

<?php include_once "footer.php";?>