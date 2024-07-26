<?php
// JazzCash sandbox credentials
$merchant_id = 'YOUR_SANDBOX_MERCHANT_ID';
$password = 'YOUR_SANDBOX_PASSWORD';
$integrity_salt = 'YOUR_SANDBOX_INTEGRITY_SALT';

// Payment details
$amount = $_POST['amount']; // Amount in paisas
$customer_name = $_POST['customer_name'];
$customer_email = $_POST['customer_email'];
$customer_mobile = $_POST['customer_mobile'];

// Transaction details
$transaction_id = uniqid();
$timestamp = date('YmdHis');
$expiry_time = date('YmdHis', strtotime('+1 hour'));

// Hash creation
$hash_string = $integrity_salt . '&' . $timestamp . '&' . $transaction_id . '&' . $amount . '&' . 'PKR' . '&' . 'web' . '&' . $customer_email . '&' . $customer_mobile . '&' . $expiry_time;
$hash = hash_hmac('sha256', $hash_string, $integrity_salt);

$payload = [
    'pp_Version' => '1.1',
    'pp_TxnType' => 'MWALLET',
    'pp_Language' => 'EN',
    'pp_MerchantID' => $merchant_id,
    'pp_SubMerchantID' => '',
    'pp_Password' => $password,
    'pp_BankID' => '',
    'pp_ProductID' => '',
    'pp_TxnRefNo' => $transaction_id,
    'pp_Amount' => $amount,
    'pp_TxnCurrency' => 'PKR',
    'pp_TxnDateTime' => $timestamp,
    'pp_BillReference' => 'billRef',
    'pp_Description' => 'Test transaction',
    'pp_TxnExpiryDateTime' => $expiry_time,
    'pp_ReturnURL' => 'http://yourwebsite.com/jazzcash_response.php',
    'pp_SecureHash' => $hash,
    'ppmpf_1' => $customer_name,
    'ppmpf_2' => '',
    'ppmpf_3' => '',
    'ppmpf_4' => '',
    'ppmpf_5' => ''
];

$ch = curl_init('https://sandbox.jazzcash.com.pk/ApplicationAPI/API/2.0/Purchase/DoMWalletTransaction');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
$response = curl_exec($ch);
curl_close($ch);

$response_data = json_decode($response, true);

if ($response_data['pp_ResponseCode'] == '000') {
    // Redirect to JazzCash payment page (sandbox)
    header('Location: ' . $response_data['pp_ResponseURL']);
} else {
    echo 'Error: ' . $response_data['pp_ResponseMessage'];
}
?>
