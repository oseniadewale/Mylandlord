<?php 
include_once "classes/Db.php";
include_once "classes/Landlord.php";

$n = new Landlord;

// $a= $n->get_landlord();
// echo "<pre>";
// print_r($a);
// echo "</pre>";
// echo "<br>";


// $c= $n->get_landlord2();
// echo "<pre>";
// print_r($c);
// echo "</pre>";


$d= $n->get_landlord3();


// echo "<pre>";
// print_r($d);
// echo "</pre>";
// echo "<br>";


            
        













?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <title>Document</title>
</head>
<body>

<table border="1" class="table table-striped">

<?php foreach($d as $e){
?>

<tr>
<th>Landlord's id</th>
<th>landlord_username</th>
<th>landlord's surname</th>
<th>landlord firstname</th>
<th>landlord middlename</th>
<th>landlord email</th>
<th>landlord mobile</th>
<th>landlord home address</th>
</tr>




<tr>
    <td><?php echo $e["landlord_id"]?></td>
    <td><?php echo $e["landlord_username"]?></td>
    
    <td><?php echo $e["landlord_surname"]?></td>
    <td><?php echo $e["landlord_firstname"]?></td>
    <td><?php echo $e["landlord_middlename"]?></td>
     <td><?php echo $e["landlord_email"]?></td>
     <td><?php echo $e["landlord_mobile"]?></td>
      <td><?php echo $e["home_address"]?></td>
    </tr>
   
   





<?php

}

?>
</table>
    
        
      
    
  
    
</body>
</html>