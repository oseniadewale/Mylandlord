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
define('DBHOST', getenv('DBHOST') ?: 'ballast.proxy.rlwy.net');
define('DBPORT', getenv('DBPORT') ?: '35446');
define('DBNAME', getenv('DBNAME') ?: 'railway');
define('DBUSER', getenv('DBUSER') ?: 'root');
define('DBPASS', getenv('DBPASS') ?: 'GcYDdKWnzRwiZLLRoMWqlhNaEIqRBqUn');

?>

