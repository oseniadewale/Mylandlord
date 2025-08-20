<?php 
session_start();
$base_url = 'http://localhost/LANDLORD'; // or use $_SERVER for dynamic path
include_once("header.php");






?>


<div class="container-fluid mb-3">
    <br>
    <br>
    <br>
    <br>
    <p class="mt-3">Congratulations <?php echo '<span style="color:blue">'.  $_SESSION["landlord_username"].'!'.'</span>'; ?> on your signup. Do well to update your profile here
        <a href="landlord_full_register.php">Full Register Here</a>

      


</p>
</div>

<?php

include_once "footer.php";







?>