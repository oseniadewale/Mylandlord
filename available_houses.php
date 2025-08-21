<?php
session_start();
$base_url = 'http://localhost/LANDLORD';
include_once("header.php");
include_once("classes/House.php");

if (!isset($_SESSION["tenant_id"])) {
    header("Location: tenant_login.php");
    exit();
}

$houseObj = new House();
$houses = $houseObj->getAvailableHouses();
?>

<div class="container-fluid mt-5">
    <h2 class="text-center mb-4">Available House(s) for Rent</h2>

    <?php if (empty($houses)): ?>
        <div class="alert alert-danger">No houses available for rent at this time.</div>
        <div>
            <p>Go back to your dashboard here <a href="tenant_dashboard.php"><button style="color:green">Back to dashboard</button></a></p>
        </div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($houses as $house): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="<?= $base_url . '/' . $house['picture_1'] ?>" class="card-img-top"
                            style="height: 200px; object-fit: cover;" loading="lazy">
                        <div class="card-body">
                            <h5 class="card-title text-success"><?= ($house['house_type']) ?></h5>
                            <p class="card-text">
                                It is ₦<?= number_format($house['actual_price']) ?><br> and located in
                                <?= ($house['location']) ?>,<br> in
                                <?= ($house['lg_name']) ?>,<br> within
                                <?= ($house['state_name']) . " " ?>state. It has the following features:
                                <?= ($house['house_features']) ?>
                            </p>
                        </div>
                        <div class="card-footer text-center">
                            <button class="btn btn-success"
                                onclick="payWithPaystack('<?= $_SESSION['tenant_email'] ?>', '<?= $house['actual_price'] ?>', '<?= $house['house_id'] ?>', '<?= $_SESSION['tenant_id'] ?>')">
                                Rent Now
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center">
            <p> <a href="tenant_dashboard.php" style="color:green"><b>Click here to go back to your dashboard here</b></a></p>
        </div>
    <?php endif; ?>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script src="https://js.paystack.co/v1/inline.js"></script>


<script>
  
  function payWithPaystack(email, amount, houseId, tenantId) {
      let handler = PaystackPop.setup({
          key: 'pk_test_403c7467f1ebb26b9227a432b34805ed18309963', 
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

<?php include_once("footer.php"); ?>