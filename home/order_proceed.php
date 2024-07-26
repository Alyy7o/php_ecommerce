<?php
session_start();
include("../connection/conn.php");

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('location: ../login/login.php');
    exit();
}

if (isset($_SESSION['user_id']) && isset($_SESSION['cart'])) {
    $user_id = $_SESSION['user_id'];
    $cart = $_SESSION['cart'];

    // Calculate the total amount
    $total_amount = 0;
    foreach ($cart as $product_id => $quantity) {
        $query = "SELECT * FROM products WHERE id = $product_id";
        $result = mysqli_query($connection, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $total_amount += $row['price'] * $quantity;
        }
        
        $file_name = mysqli_real_escape_string($connection, $_FILES['image']['name']);
        $tempname = $_FILES['image']['tmp_name'];
        $folder = '../admin/products/pics/'.$file_name;
    }

    // Retrieve user details
    $query = "SELECT * FROM users WHERE id = '$user_id'";
    $result = mysqli_query($connection, $query);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $address = $row['address'];
        $phone = $row['phone'];

        // Insert order details into orders table
        $order_query = "INSERT INTO orders (`name`, `phone`, `user_id`, `total_amount`, `address`, `image`) VALUES ('$name', '$phone', '$user_id', '$total_amount', '$address', '$file_name')";
        $order_result = mysqli_query($connection, $order_query);

        if ($order_result) {
            // Retrieve the order ID of the inserted order
            $order_id = mysqli_insert_id($connection);

            // Insert each cart item into order_details table
            foreach ($cart as $product_id => $quantity) {
                $order_details_query = "INSERT INTO order_details (order_id, product_id, quantity) VALUES ('$order_id', '$product_id', '$quantity')";
                mysqli_query($connection, $order_details_query);

                // Remove the item from the cart table
                $delete_cart_query = "DELETE FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'";
                mysqli_query($connection, $delete_cart_query);
            }

            // Clear the cart session
            unset($_SESSION['cart']);

            // Redirect to a confirmation page or display a success message
            header('Location: order_confirmation.php');
            exit();
        } else {
            // Handle the case where the order insertion fails
            echo "Failed to place order.";
        }
    } else {
        // Handle the case where user details retrieval fails
        echo "Failed to retrieve user details.";
    }
} else {
    // Handle the case where the user is not logged in or the cart is empty
    header('Location: ../login/login.php');
    exit();
}
?>
