<?php
include_once __DIR__ . '/classes/config.php';

try {
    $dsn = "mysql:host=" . DBHOST . ";dbname=" . DBNAME . ";charset=utf8mb4";
    $pdo = new PDO($dsn, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "<h2 style='color:green'>✅ Database connection successful!</h2>";

    $stmt = $pdo->query("SHOW TABLES");
    echo "<h4>Tables in your database:</h4><ul>";
    while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
        echo "<li>" . htmlspecialchars($row[0]) . "</li>";
    }
    echo "</ul>";
} catch (PDOException $e) {
    echo "<h2 style='color:red'>❌ Connection failed:</h2> " . $e->getMessage();
}
?>
