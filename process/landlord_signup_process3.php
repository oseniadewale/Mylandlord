<?php
session_start();
include_once "../classes/landlordSignup.php";
$base_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

include_once __DIR__ . "/../header.php";


$mysignup = new landlordSignup;

if (isset($_POST["landlord_signup_btn"])) {

    // ✅ Input sanitization
    $landlord_username = htmlspecialchars($_POST["landlord_username"]);
    $landlord_password = htmlspecialchars($_POST["landlord_password"]);
    $landlord_email    = htmlspecialchars($_POST["landlord_email"]);
    $landlord_mobile   = htmlspecialchars($_POST["landlord_mobile"]);

    // ✅ Password validation
    if (strlen($landlord_username) < 6) {
        $_SESSION["landlord_username_error"] = "Your username should be at least 6 characters";
        header("Location: ../landlord_signup_form3.php");
        exit;
    }

    if (strlen($landlord_password) < 6) {
        $_SESSION["landlord_password_error"] = "Your password should be at least 6 characters";
        header("Location: ../landlord_signup_form3.php");
        exit;
    }

    if ($landlord_password !== $_POST["confirm_landlord_password"]) {
        $_SESSION["confirm_landlord_password_error"] = "Mismatch password";
        header("Location: ../landlord_signup_form3.php");
        exit;
    }

    try {
        // ✅ Will throw exception if not unique
        $landlord_id = $mysignup->landlord_signup($landlord_username, $landlord_password, $landlord_email, $landlord_mobile);

        // ✅ Success
        $_SESSION["landlord_username"] = $landlord_username;
        $_SESSION["landlord_email"]    = $landlord_email;
        $_SESSION["landlord_mobile"]   = $landlord_mobile;
        $_SESSION["active_role"]     = 'landlord';
        $_SESSION["landlord_id"]       = $landlord_id;

        header("Location: ../work_landlord.php");
        exit;

    } catch (Exception $e) {
        // ✅ Show DB/uniqueness errors
        $_SESSION['Db_unique_error'] = $e->getMessage();
        header("Location: ../landlord_signup_form3.php");
        exit;
    }

} else {
    echo "<br>
    <div class='alert alert-danger mt-4'>
        <span style='color:red'>landlord signup failed</span>
    </div>
    <div>
        <a href='landlord_signup3.php' class='btn btn-success'>
            Click here to go to landlord signup page
        </a>
    </div>";
}

include_once "footer.php";
?>
