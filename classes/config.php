<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

// Load .env file only if it exists (for local use)
$envPath = __DIR__ . '/../';
if (file_exists($envPath . '.env')) {
    $dotenv = Dotenv::createImmutable($envPath);
    $dotenv->load();
}

// Use environment variables (Railway auto-provides these)
define('DBHOST', getenv('DBHOST') ?: $_ENV['DBHOST'] ?? 'localhost');
define('DBPORT', getenv('DBPORT') ?: $_ENV['DBPORT'] ?? '3306');
define('DBNAME', getenv('DBNAME') ?: $_ENV['DBNAME'] ?? 'your_local_db_name');
define('DBUSER', getenv('DBUSER') ?: $_ENV['DBUSER'] ?? 'root');
define('DBPASS', getenv('DBPASS') ?: $_ENV['DBPASS'] ?? '');

?>

