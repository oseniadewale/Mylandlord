// <?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// echo "<h3>✅ PHP is running</h3>";

// require_once __DIR__ . '/classes/config.php';
// require_once __DIR__ . '/classes/Db.php';

// try {
//     $db = new Db();
//     $pdo = $db->connect();
//     echo "<h3 style='color:green'>✅ DB connected successfully!</h3>";
//     $tables = $pdo->query("SHOW TABLES");
//     foreach ($tables as $t) {
//         echo $t[0] . "<br>";
//     }
// } catch (Throwable $e) {
//     echo "<h3 style='color:red'>❌ DB Error:</h3> " . $e->getMessage();
// }
// ?>

<?php
// Enable full error reporting temporarily
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Run the login process manually to capture exact errors
include_once __DIR__ . '/process/landlord_login_process.php';
?>

