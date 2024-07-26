<?php
// JazzCash sandbox credentials
$integrity_salt = 'YOUR_SANDBOX_INTEGRITY_SALT';

// Payment response
$response_data = $_POST;

// Hash verification
$response_hash_string = $response_data['pp_ResponseCode'] . '&' . $response_data['pp_TxnRefNo'] . '&' . $response_data['pp_Amount'] . '&' . $response_data['pp_TxnCurrency'] . '&' . $response_data['pp_TxnDateTime'] . '&' . $response_data['pp_TxnExpiryDateTime'] . '&' . $response_data['pp_ResponseMessage'];
$response_hash = hash_hmac('sha256', $response_hash_string, $integrity_salt);

if ($response_hash === $response_data['pp_SecureHash']) {
    if ($response_data['pp_ResponseCode'] == '000') {
        // Payment successful (sandbox)
        echo 'Payment successful! Transaction ID: ' . $response_data['pp_TxnRefNo'];
    } else {
        // Payment failed (sandbox)
        echo 'Payment failed: ' . $response_data['pp_ResponseMessage'];
    }
} else {
    echo 'Invalid response. Hash mismatch.';
}
?>
