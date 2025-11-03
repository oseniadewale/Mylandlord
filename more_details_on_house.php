<?php
session_start();
$base_url = 'http://localhost/mylandlord';
include_once("header.php");
include_once("classes/House.php");

if (!isset($_SESSION["tenant_id"])) {
    header("Location: tenant_login.php");
    exit();
}

if (!isset($_GET['house_id'])) {
    echo "<div class='alert alert-danger'>No house selected.</div>";
    exit();
}

$house_id = $_GET['house_id'];


$houseObj = new House();
$detailed_single_house = $houseObj->get_more_details_on_house($house_id);


    if(isset( $_SESSION["reference_error"] )){
          echo "<div class='container-fluid alert alert-danger' >".

           "<p style='margin-top:20px; color:red'>".$_SESSION['reference_error']."</p>".
        "</div>";
    }
    
?>

<div class="container-fluid mt-4">





    <?php if ($detailed_single_house): ?>

        <div class="row">
            <div class="col">
                <h4 class="mt-4" style="display:flex; color:green; justify-content:center">Detailed information on the clicked house:</h4>
                <table class="table table-bordered table-striped" border="1">

                    <thead>
                        <th>S/N</th>
                        <th>House Type</th>
                        <th>Location</th>
                        <th>State</th>
                        <th>LG</th>
                        <th>Landlord Username</th>
                        <th>Landlord Mobile</th>
                        <th>Actual Price</th>
                        <th>Rent duration</th>
                        <th>Availability Status</th>
                        <th>House Features</th>
                        <th>Landlord Notice</th>
                    </thead>

                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><?= $detailed_single_house["house_type"]; ?></td>
                            <td><?= $detailed_single_house["location"]; ?></td>
                            <td><?= $detailed_single_house["state_name"]; ?></td>
                            <td><?= $detailed_single_house["lg_name"]; ?></td>
                            <td><?= $detailed_single_house["landlord_username"]; ?></td>
                            <td><?= $detailed_single_house["landlord_mobile"]; ?></td>
                            <td>₦<?= number_format($detailed_single_house["actual_price"]); ?></td>
                            <td><?= $detailed_single_house["rent_duration"]; ?></td>
                            <td><?= $detailed_single_house["availability_status"]; ?></td>
                            <td><?= $detailed_single_house["house_features"]; ?></td>
                            <td><?= $detailed_single_house["landlord_notice"]; ?></td>

                        </tr>
                    </tbody>


                </table>

            </div>

        </div>


<div class="row">
    <h5 class="mt-2"style="display:flex; justify-content:center; color:green">Below are pictures of the interested house:</h5>
</div>
        <div class="row">


            <div class="col-lg-4 ">
                <small>Picture 1:</small>
                <img src="<?= $base_url . '/' . $detailed_single_house['picture_1'] ?>" class="img-fluid" alt="picture 1 not available now">

            </div>

            <div class="col-lg-4">
                <small>Picture 2:</small>
                <img src="<?= $base_url . '/' . $detailed_single_house['picture_2'] ?>" class="img-fluid" alt="picture 2 not available now">
            </div>

            <div class="col-lg-4">
                <small>Picture 3:</small>
                <img src="<?= $base_url . '/' . $detailed_single_house['picture_3'] ?>" class="img-fluid" alt="picture 3 not available now">
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3">
                <small>Picture 4:</small>
                <img src=" <?= $base_url . '/' . $detailed_single_house['picture_4'] ?>" class="img-fluid" alt="picture 4 not available now">
            </div>
            <div class="col-lg-3">
                <small>Picture 5:</small>
                <img src=" <?= $base_url . '/' . $detailed_single_house['picture_5'] ?>" class="img-fluid" alt="picture 5 not available now">
            </div>
            <div class="col-lg-3">
                <small>Picture 6:</small>
                <img src="<?= $base_url . '/' . $detailed_single_house['picture_6'] ?>" class="img-fluid" alt="picture 6 not available now">
            </div>
            <div class="col-lg-3">
                <small>Picture 7:</small>
                <img src="<?= $base_url . '/' . $detailed_single_house['picture_7'] ?>" class="img-fluid" alt="picture 7 not available now">
            </div>
        </div>

 <?php else: ?>

        <?php if (!empty($detailed_single_house)){
           echo "<div class='alert alert-danger'>House details not found.</div>";

        } ?>
            
            
        
   
        
    <?php endif; ?>


</div>

<div class="row">
    <div class="col mt-4" style="display:flex; justify-content:center;">
        <?php if (strtolower($detailed_single_house['availability_status']) === 'rented'): ?>
            <button class="btn btn-secondary" style="font-weight:red" disabled>
                Not Available for rent
            </button>
        <?php else: ?>
            <button class="btn btn-success"
                onclick="payWithPaystack('<?= $_SESSION['tenant_email'] ?>', '<?= $detailed_single_house['actual_price'] ?>', '<?= $detailed_single_house['house_id'] ?>', '<?= $_SESSION['tenant_id'] ?>')">
                Rent
            </button>
        <?php endif; ?>
    </div>
</div>


<div class="row">
    <div class="col-lg-6 text-center">
            <p> <a href="tenant_dashboard.php" style="color:green; margin-left:30px; display:flex; justify-content:start"><b>Click here to go back to your dashboard here</b></a></p>
        </div>
        <div class="col-lg-6">
            <p> <a href="available_houses.php" style="color:green; margin-right:30px; display:flex; justify-content:end"><b>Click here to go back</b></a></p>
        </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script src="https://js.paystack.co/v1/inline.js"></script>


<script>

    
    
  
  function payWithPaystack(email, amount, houseId, tenantId) {
      let handler = PaystackPop.setup({
          key: 'pk_test_70cc747242b486bcac8f1f339999610588bd0308', 
          email: email,
          amount: amount * 100, // Paystack amount is in kobo if NGN
          currency: 'NGN',
          ref: ''+Math.floor((Math.random() * 1000000000) + 1), 
          callback: function(response) {
              alert('Success. Transaction ref is ' + response.reference);
              const reference = response.reference;
              // use encodeURIComponent for safety
              window.location.href = `verify_payment.php?reference=${encodeURIComponent(reference)}&house_id=${encodeURIComponent(houseId)}&amount=${encodeURIComponent(amount)}&tenant_id=${encodeURIComponent(tenantId)}`;
          },
          onClose: function() {
              alert('Transaction cancelled');
          }
      });
      handler.openIframe();
  }

</script>


<?php include "footer.php"; ?>