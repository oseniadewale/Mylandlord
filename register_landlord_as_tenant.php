<?php 
session_start();
include_once "classes/Tenant.php";
$base_url = 'http://localhost/mylandlord'; // or use $_SERVER for dynamic path
include_once("header.php");



if (!isset($_SESSION['landlord_id'])) {
    header("Location: landlord_login.php");
    exit();

}




?>

<div class="row">
    <div class="col-lg-6 mt-4">
        <form action="process/register_landlord_as_tenant_process.php" method="POST">
            <label for="tenant_username" class="form-label">Username:</label>
    <input type="text" name="tenant_username"  value="<?= $_SESSION['landlord_username'] ?>" class="form-control" required>
    <label for="tenant_email" class="form-label">Email:</label>
    <input type="email" name="tenant_email" value="<?= $_SESSION['landlord_email'] ?>" class="form-control"required>

    <label for="tenant_mobile" class="form-label">Phone Number:</label>
    <input type="text" name="tenant_mobile" value="<?= $_SESSION['landlord_mobile'] ?>" class="form-control" required>

    <label for="tenant_password" class="form-label">Password</label>
    <input type="password" name="tenant_password" class="form-control" placeholder="enter the same password you used as a landlord"required>
    <button type="submit" class="btn btn-success">Create Tenant Profile</button>
</form>

    </div>
</div>

<?php include_once "footer.php";?>