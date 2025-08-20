<?php
$base_url = 'http://localhost/LANDLORD';
include_once("../header.php");
include_once "../classes/Indexshow.php";

$index = new Indexshow();
?>

<?php
if (isset($_POST['search_index'])) {
    $state = trim($_POST['state']);
    $lga = trim($_POST['lga']);
    $price = intval($_POST['price']); // must match a real price_id
    $house_type = trim($_POST['house_type']);
    $house_type = ucwords(str_replace('_', ' ', $house_type)); // 🔥 Normalize house type

    $results = $index->Index_show($state, $lga, $price, $house_type);

    if ($results && count($results) > 0) {
        echo "<h5 class='mt-5'; style='display:flex; justify-content:center; color:green'>Search result:</h5>";
        echo '<table class="table table-bordered table-striped ms-2 me-2 mt-2 " border="1">';
        echo '<thead class="thead-dark">';
        echo '<tr>';
        echo '<th>Serial Number</th>';
        echo '<th>Residing State</th>';
        echo '<th>LGA</th>';
         echo '<th>Actual Location</th>';
        echo '<th>Price Range</th>';
         echo '<th>Actual Price</th>';
           echo '<th>Rent duration</th>';
          
        echo '<th>House Type</th>';
         echo '<th>Availability status</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        $serial_number = 1;
        foreach ($results as $house) {
            echo '<tr>';
            echo '<td>' . $serial_number++ . '</td>';
            echo '<td>' . $house["state_name"] . '</td>';
            echo '<td>' . $house["lg_name"] . '</td>';
              echo '<td>' . $house["location"] . '</td>';
            echo '<td>' . $house["price_range"] . '</td>';
            
              echo '<td>'.'₦' . number_format($house["actual_price"]) . '</td>';
              echo '<td>' . $house["rent_duration"] . '</td>';

            echo '<td>' . $house["house_type"] . '</td>';
             echo '<td>' . $house["availability_status"] . '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
       echo '<div class="ms-3">';
echo '  <p>';
echo '    Consider registering here as a <span class="fw-bold">landlord</span> if not already registered for full optimization of this app: ';
echo '    <a href="../landlord_signup_form3.php">Landlord signup</a><br>';
echo '    Consider registering here as a <span  class="fw-semibold">tenant</span> if not already registered for full optimization of this application ';
echo '    <a href="../tenant_signup_form3.php">Tenant signup</a><br>';

echo '    Consider registering here as a'.' <span class="fw-bold" style="color:green">'.'Corper'."</span>".' if not already registered for full optimization of this application ';

echo '    <a href="../nysc_full_register.php">Corper signup</a>';
echo "<br>";
echo '<a href="../index5.php" class="btn btn-sm btn-success mt-2">← Go back to index page here</a>';

echo '  </p>';
echo '</div>';

    } else {
        echo"<br>";
        echo '<div class="alert alert-danger mt-4 pb-2" role="alert">';
        echo '<b style="display:flex; justify-content:center">No matching house(s) found using the selected criteria</b><br>';
        echo '<a href="../index5.php" class="btn btn-sm btn-success mt-2"> ← Go back to index page here</a>';
        echo '</div>';
        echo '<div class="ms-3">';
echo '  <p>';
echo '    Consider registering here as a <span class="fw-bold">landlord</span> if not already registered for full optimization of this app: ';
echo '    <a href="../landlord_signup_form3.php">Landlord signup</a><br>';
echo '    Consider registering here as a <span  class="fw-semibold">tenant</span> if not already registered for full optimization of this application ';
echo '    <a href="../tenant_signup_form3.php">Tenant signup</a><br>';

echo '    Consider registering here as a'.' <span class="fw-bold" style="color:green">'.'Corper'."</span>".' if not already registered for full optimization of this application ';

echo '    <a href="../nysc_full_register.php">Corper signup</a>';
echo "<br>";
echo '</div>';
    }
}
?>

<?php include_once "../footer.php"; ?>
