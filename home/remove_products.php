<?php
include ("../connection/conn.php");
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login/login.php');
    exit();
}

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $user_id = $_SESSION['user_id'];

    // Remove the product from the cart session
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }

    // Remove the product from the cart table in the database
    $query = "DELETE FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($connection));
    } else {
        header('Location: mycart.php?remove_cart=Product removed successfully');
        exit();
    }
} else {
    echo "Product ID is not set.<br>";
    header('Location: product.php');
    exit();
}
?>
