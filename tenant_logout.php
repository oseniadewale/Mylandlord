<?php 
session_start();
session_unset();
session_destroy();

$base_url = 'http://localhost/LANDLORD'; // or use $_SERVER for dynamic path
$page_title = "Tenant's logout Page";
include_once("header.php");

header("Location: index5.php");
exit();










?>