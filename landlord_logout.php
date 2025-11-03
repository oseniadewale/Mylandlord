<?php 
session_start();
session_unset();
session_destroy();

$base_url = 'http://localhost/mylandlord'; // or use $_SERVER for dynamic path
include_once("header.php");

header("Location: index.php");
exit();










?>