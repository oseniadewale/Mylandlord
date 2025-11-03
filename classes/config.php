<?php

if (file_exists(__DIR__ . '/../.env')) {
    $env = parse_ini_file(__DIR__ . '/../.env');
    foreach ($env as $key => $value) {
        putenv("$key=$value");
    }
}

// 2️⃣ Define constants (works locally or in Railway)
define('DBHOST', getenv('DBHOST') ?: 'localhost');
define('DBNAME', getenv('DBNAME') ?: 'mylandlord');
define('DBUSER', getenv('DBUSER') ?: 'root');
define('DBPASS', getenv('DBPASS') ?: '');
?>
