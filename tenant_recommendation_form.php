<?php
session_start();
include_once "classes/db.php";
include_once "classes/Recommendation.php";
include_once "header.php";

if (!isset($_SESSION['tenant_id'])) {
    header("Location: tenant_login.php");
    exit();
}

$tenant_id = $_SESSION['tenant_id'];

// Fetch landlord_id and house_id from last completed rental

?>
<!DOCTYPE html>
<html>
<head>
    <title>Recommend Landlord or House</title>
</head>
<body>
<h2>Make a Recommendation</h2>
<form action="process/tenant_recommendation_process.php" method="POST">
    <label>Recommendation Type:</label>
    <select name="target_type" id="target_type" required onchange="updateTargetId()">
        <option value="">-- Select --</option>
        <option value="landlord">Landlord</option>
        <option value="house">House</option>
    </select><br><br>

    <!-- Auto-filled Target ID -->
    <input type="hidden" name="target_id" id="target_id">

    <label>Message:</label><br>
    <textarea name="message" required></textarea><br><br>

    <button type="submit" name="recommend_btn">Submit Recommendation</button>
</form>

<script>
// Preload landlord & house IDs from PHP
const landlordId = "<?php echo $landlord_id; ?>";
const houseId = "<?php echo $house_id; ?>";

function updateTargetId() {
    let type = document.getElementById('target_type').value;
    document.getElementById('target_id').value = (type === 'landlord') ? landlordId : houseId;
}
</script>
</body>
</html>
