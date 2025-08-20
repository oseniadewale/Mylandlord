<?php 
session_start();
session_unset();
session_destroy();

$base_url = 'http://localhost/LANDLORD'; // or use $_SERVER for dynamic path
include_once("header.php");

header("Location: index5.php");
exit();










?>