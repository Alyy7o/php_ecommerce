<?php include ("../../connection/conn.php");
session_start();

?>

<?php 

if(isset($_POST['add_products'])){


    $sub_categories_id = mysqli_real_escape_string($connection, $_POST['sub_categories_id']);
    $title = mysqli_real_escape_string($connection, $_POST['title']);
    $description = mysqli_real_escape_string($connection, $_POST['description']);
    $price = mysqli_real_escape_string($connection, $_POST['price']);
    $quantity = mysqli_real_escape_string($connection, $_POST['quantity']);


    // Retrieve the sub_categories_name based on the sub_categories_id
    $sub_query = "SELECT sub_categories_name FROM sub_categories WHERE id = '$sub_categories_id'";
    $sub_result = mysqli_query($connection, $sub_query);


    if(!$sub_result) {
        die("Query Failed: " . mysqli_error($connection));
    } else {
        $sub_row = mysqli_fetch_assoc($sub_result);
        $sub_categories_name = mysqli_real_escape_string($connection, $sub_row['sub_categories_name']);
    }

    $file_name = mysqli_real_escape_string($connection, $_FILES['image']['name']);
    $tempname = $_FILES['image']['tmp_name'];
    $folder = 'pics/'.$file_name;

    $query = "INSERT INTO products (`sub_categories_id`, `title`, `description`, `price`, `quantity`, `sub_categories_name`, `image`) VALUES ('$sub_categories_id', '$title', '$description', '$price', '$quantity', '$sub_categories_name', '$file_name')";

    $query_result = mysqli_query($connection, $query);
    if(!$query_result){
        die("Query Failed: " . mysqli_error($connection));
    } else {
        move_uploaded_file($tempname, $folder);
        header('Location: view_products.php?insert_msg=PRODUCT ADDED SUCCESSFULLY');
        exit();
    }
}

?>

<!DOCTYPE html>
<html>
<head> 
    <?php include("css.php") ?>
    <style>
        .div_deg{
            display: flex; 
            justify-content: center; 
            align-items: center;
            margin-top: 60px;
        }
        label{
            display: inline-block;
            width: 200px;
            font-size: 18px !important;
            color: white !important;
        }
        input[type='text']{
            width: 350px;
            height: 50px;
        }
        textarea{
            height: 80px;
            width: 450px
        }
        .input_deg{
            padding: 15px;
        }
    </style>
</head>
<body>
    <?php include("header.php") ?>
    <?php include("sidebar.php") ?>

    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <h1 style="color: white">Add Product</h1>
                <div class="div_deg">
                    <form action="add_products.php" method="post" enctype="multipart/form-data">
                        <div class="input_deg">
                            <label>Product Title</label>
                            <input type="text" name="title" required>
                        </div>
                        <div class="input_deg">
                            <label>Description</label>
                            <textarea name="description" id="description" required></textarea>
                        </div>
                        <div class="input_deg">
                            <label>Price</label>
                            <input type="text" name="price" required>
                        </div>
                        <div class="input_deg">
                            <label>Quantity</label>
                            <input type="number" name="quantity" required>
                        </div>
                        <div class="input_deg">
                            <label>Product Category</label>
                            <select name="sub_categories_id" required>
                                <option>Select an Option</option>
                                <?php 
                                $query = "SELECT * FROM sub_categories";
                                $result = mysqli_query($connection, $query);
                                if(!$result){
                                    die("Query Failed: " . mysqli_error($connection));
                                } else {
                                    while($row = mysqli_fetch_assoc($result)){
                                        echo '<option value="'.htmlspecialchars($row['id']).'">'.htmlspecialchars($row['sub_categories_name']).'</option>';
                                    }
                                }
                                ?>
                            </select>                    
                        </div>
                        <div class="input_deg">
                            <label>Product Image</label>
                            <input type="file" name="image" accept=".jpg, .jpeg, .png">
                        </div>
                        <div class="input_deg">
                            <input class="btn btn-success" type="submit" value="Add Product" name="add_products">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- JavaScript files-->
    <script src="../../vendor/popper.js/umd/popper.min.js"></script>
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../vendor/jquery.cookie/jquery.cookie.js"></script>
    <script src="../../vendor/chart.js/Chart.min.js"></script>
    <script src="../../vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="../../js/charts-home.js"></script>
    <script src="../../js/front.js"></script>
</body>
</html>
