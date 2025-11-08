// <?php
// include_once __DIR__ . '/../vendor/autoload.php';

// use Dotenv\Dotenv;

// // Load .env if it exists
// $envPath = __DIR__ . '/../';
// if (file_exists($envPath . '.env')) {
//     $dotenv = Dotenv::createImmutable($envPath);
//     $dotenv->load();
// }

// // If app is local (not on Railway), use the public proxy host
// $defaultHost = (getenv('RAILWAY_ENVIRONMENT') || getenv('RAILWAY_PROJECT_ID'))
//     ? 'mysql.railway.internal'
//     : 'ballast.proxy.rlwy.net';

// define('DBHOST', getenv('DBHOST') ?: $defaultHost);
// define('DBPORT', getenv('DBPORT') ?: '35446');
// define('DBNAME', getenv('DBNAME') ?: 'railway');
// define('DBUSER', getenv('DBUSER') ?: 'root');
// define('DBPASS', getenv('DBPASS') ?: 'GcYDdKWnzRwiZLLRoMWqlhNaEIqRBqUn');
// ?>

<?php
define('DBHOST', 'ballast.proxy.rlwy.net');
define('DBPORT', '35446');
define('DBNAME', 'railway');
define('DBUSER', 'root');
define('DBPASS', 'GcYDdKWnzRwiZLLRoMWqlhNaEIqRBqUn');
?>

