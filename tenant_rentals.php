<?php
session_start();
include_once "classes/db.php";
include_once "classes/Recommendation.php";
include_once "header.php";
$myrecommend = new Recommendation;

$tenant_id = $_SESSION['tenant_id'];

$row = $myrecommend->Fetch_Landlord_and_house_id($tenant_id);

if (!isset($_SESSION['tenant_id'])) {
    header("Location: tenant_login.php");
    exit();
}



// Fetch all rentals for this tenant

?>
<h2>Your Rentals</h2>

<?php
if ($row !== null) {
    echo "<table class='table table-striped table-bordered' border='1'>
        <tr>
            <th>Landlord</th>
            <th>House</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Action</th>
        </tr>";

    // Loop through all rows
    while ($row) {
        echo "<tr>
            <td>" . htmlspecialchars($row['landlord_name']) . "</td>
            <td>" . htmlspecialchars($row['house_title']) . "</td>
            <td>" . htmlspecialchars($row['start_date']) . "</td>
            <td>" . htmlspecialchars($row['end_date'] ?? 'Ongoing') . "</td>
            <td>
                <a href='tenant_recommendation_form.php?type=landlord&id=" ($row['landlord_id']) . "'> <button class='btn btn-success'>Recommend Landlord</button></a> |
                <a href='house_recommendation_form.php?type=house&id=" .($row['house_id']) . "'> <button class='btn btn-success'>Recommend House</button></a>
            </td>
        </tr>";

    
    }

    echo "</table>";
}else{
    echo "<p style='color:red; font-size:24px' margin>You have not initiated any rentals yet.</p>";
}

include_once "footer.php";
?>

