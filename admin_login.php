<?php
session_start();

$base_url = 'http://localhost/LANDLORD';
$page_title = "Admin Login";
include_once("header.php");
?>

<div class="container mt-5 pt-5">
    
   <h2 class="text-center text-success mb-4">Admin Login</h2>

    <form action="process/admin_login_process.php" method="POST" class="col-md-6 offset-md-3">
        <div class="form-group mb-3">
            <label for="username">Admin Username:</label>
            <input type="text" name="admin_username" class="form-control" placeholder="enter your admin username here" required>
            <?php if (isset($_SESSION["admin_username_error"])): ?>
                <small class="text-danger">
                    <?= $_SESSION["admin_username_error"]; ?>
                </small>
                <?php unset($_SESSION["admin_username_error"]); ?>
            <?php endif; ?>
        </div>

        <div class="form-group mb-3">
            <label for="password">Password:</label>
            <input type="password" name="admin_password" class="form-control" placeholder="enter your admin password here" required>
            <?php if (isset($_SESSION["admin_password_error"])): ?>
                <small class="text-danger">
                    <?= $_SESSION["admin_password_error"]; ?>
                </small>
                <?php unset($_SESSION["admin_password_error"]); ?>
            <?php endif; ?>
        </div>

        <button type="submit" name="admin_login_btn" class="btn btn-success w-100">Login</button>
    </form>
</div>

<?php include_once("footer.php"); ?>
