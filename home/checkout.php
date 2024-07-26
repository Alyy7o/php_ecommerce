<?php

// require __DIR__ . "/vendor/autoload.php";

// $stripe_secret_key = "sk_test_51PNZQuCo3tO8KBpF2tEtxYirNb52SGVUC4OF1YSxqC8oprM9fwMrOY4cWoZo5KLdiq0eb7iPkA3DV0Tvm21g6VUs00UbiLBJAx";

// \Stripe\Stripe::setApiKey($stripe_secret_key);

// $checkout_session = \Stripe\Checkout\Session::create([

//     "mode" => "payment",
//     "success_url" => "http://localhost/php_ecommerce/home/success.php",
//     "cancel_url" => "http://localhost/php_ecommerce/home/mycart.php",
//     "locale" => "es",
//     "line_items" => [
//         [

//             "quantity" => 5,
//             "price_data" => [
                
//                 "currency" => "usd",
//                 "unit_amount" => 200000,
//                 "product_data" => [
//                     "name" => "T-shirts"
//                     ]
//                 ]
//         ]

//     ]

// ]);

// http_response_code(303);
// header("location: " . $checkout_session->success_url);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<form method="POST" action="process_payment.php">
    <input type="hidden" name="amount" value="1000"> <!-- Amount in paisas (1000 = PKR 10) -->
    <input type="text" name="customer_name" placeholder="Enter your name" required>
    <input type="email" name="customer_email" placeholder="Enter your email" required>
    <input type="text" name="customer_mobile" placeholder="Enter your mobile number" required>
    <button type="submit">Pay with JazzCash</button>
</form>

</body>
</html>