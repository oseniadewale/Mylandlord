 <?php 
session_start();
include_once "header.php";

// Check if admin is logged in
if (!isset($_SESSION["admin_username"])) {
    header("Location: admin_dashboard.php");
    exit();
}

// Only allow super_admin to register another admin
if (isset($_SESSION["admin_role"]) && $_SESSION["admin_role"] === "super_admin") {

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        require_once "classes/Db.php";
        $db = new Db();
        $conn = $db->connect();

        $username = trim($_POST["admin_username"]);
        $password = trim($_POST["admin_password"]);
        $email = $_POST["admin_email"];

        // Hash the password
        $hashed = password_hash($password, PASSWORD_DEFAULT);

        // Insert new admin as moderator
        $sql = "INSERT INTO admins (admin_username, admin_password,admin_email, admin_role) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$username, $email, $hashed, 'moderator']);

        echo "✅ Admin registered successfully!";
    }

} else {
    $_SESSION["admin_register_error"] = "❌ You do not have permission to register a new admin. Contact the super admin.";
    header("Location: admin_dashboard.php");
    exit();
}
?>

<div class="container-fluid">
    <form method="POST">
        <input type="text" name="admin_username" placeholder="Admin Username" required><br>
        <input type="password" name="admin_password" placeholder="Password" required><br>
         <input type="email" name="admin_email" placeholder="email" required><br>
        <button type="submit">Register Admin</button>
    </form>
</div>
