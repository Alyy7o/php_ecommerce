<?php 
include ("../connection/conn.php");
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login/login.php');
    exit();
}

// Check if the user is an admin
$user_id = $_SESSION['user_id'];
$query = "SELECT role FROM users WHERE id = '$user_id'";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);

if ($row['role'] != 'admin') {
    header('Location: ../home/index.php');
    exit();
}

// Update order status if requested
if (isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];
    $update_query = "UPDATE orders SET status = '$status' WHERE id = '$order_id'";
    mysqli_query($connection, $update_query);
}

// Retrieve orders
$orders_query = "SELECT orders.id, users.name, orders.total_amount, orders.status, orders.image FROM orders JOIN users ON orders.user_id = users.id";
$orders_result = mysqli_query($connection, $orders_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <?php include("css.php") ?>

    <style>
        input[type='text'] {
            width: 400px;
            height: 50px;
        }

        .tabel_deg {
            border: 2px solid skyblue;
            width: 100%;
            text-align: center;
            margin-top: 20px;
        }

        th {
            background: skyblue;
            padding: 15px;
            font-size: 20px;
            font-weight: bold;
            color: white;
        }

        td {
            text-align: center;
            color: white;
            padding: 10px;
            border: 1px solid skyblue;
        }
    </style>
</head>
<body>
    <?php include("header.php"); ?>
    <?php include("sidebar.php"); ?>

    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <h1 style="color: white">Orders</h1>
                <div class="div_deg">
                    <table class="tabel_deg">
                        <thead>
                            <th>Order ID</th>
                            <th>Customer Name</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Image</th>
                            <th>Update Status</th>
                        </thead>
                        <tbody>
                            <?php while ($order = mysqli_fetch_assoc($orders_result)) { ?>
                                <tr>
                                    <td><?php echo $order['id']; ?></td>
                                    <td><?php echo $order['name']; ?></td>
                                    <td><?php echo $order['total_amount']; ?></td>
                                    <td><?php echo $order['status']; ?></td>
                                    <td><?php echo $order['image']; ?></td>
                                    <td>
                                        <form method="post" action="">
                                            <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                                            <select name="status" class="form-control">
                                                <option value="pending" <?php if ($order['status'] == 'pending') echo 'selected'; ?>>Pending</option>
                                                <option value="processing" <?php if ($order['status'] == 'processing') echo 'selected'; ?>>Processing</option>
                                                <option value="completed" <?php if ($order['status'] == 'completed') echo 'selected'; ?>>Completed</option>
                                            </select>
                                            <button type="submit" name="update_status" class="btn btn-primary mt-2">Update</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript files-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper.js/umd/popper.min.js"> </script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="js/charts-home.js"></script>
    <script src="js/front.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
