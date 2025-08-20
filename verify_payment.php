<?php
session_start();
include_once("classes/Payment.php");

// 1. Collect tenant & house info (store them in session or hidden form during initialization)
$tenant_id = $_SESSION['tenant_id'] ?? null;
$house_id  = $_SESSION['house_id'] ?? null;

// 2. Get reference from Paystack redirect URL
if (!isset($_GET['reference'])) {
    die("❌ No reference supplied by Paystack");
}
$reference = $_GET['reference'];

// 3. Verify transaction with Paystack
$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . $reference,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        "Authorization: sk_test_a448a17b91a165c065c90489b8254cf605ee75de", // 🔑 Replace with your Paystack secret key
        "Cache-Control: no-cache",
    ],
]);

$response = curl_exec($curl);
curl_close($curl);

$response = json_decode($response, true);

// 4. Check verification response
if ($response && isset($response['data']['status']) && $response['data']['status'] === 'success') {
    $amount = $response['data']['amount']; // in kobo
    $ref    = $response['data']['reference'];

    $paymentObj = new Payment();
    if ($paymentObj->recordPayment($tenant_id, $house_id, $amount, $ref)) {
        echo "✅ Payment recorded successfully!";
    } else {
        echo "⚠️ Payment verification succeeded, but failed to save record.";
    }
} else {
    echo "❌ Payment verification failed!";
}
