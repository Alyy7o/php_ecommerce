<?php
include ("../connection/conn.php");
session_start();

// // Check if the user is logged in
// if (!isset($_SESSION['user_id'])) {
//     header('location: ../login/login.php');
//     exit();
// }

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $user_id = $_SESSION['user_id'];

    // Initialize the cart session if not already set
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Add the product to the cart session
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]++;
    } else {
        $_SESSION['cart'][$product_id] = 1;
    }

    // Optional: Store the cart in the database
    $query = "INSERT INTO cart(`user_id`, `product_id`) VALUES ('$user_id', '$product_id')";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($connection));
    } else {
        header('location: index.php?add_cart=Product added successfully');
        exit();
    }
} else {
    echo "Product ID is not set.<br>";
    header('location: ../login/login.php');
    exit();
}
?>
