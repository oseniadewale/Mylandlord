<?php 
session_start();
session_unset();
session_destroy();

$base_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

include_once __DIR__ . "/header.php";



header("Location: index.php");
exit();










?>