<?php include ("../../connection/conn.php");
session_start();

?>

<?php 
// Initialize $row to avoid undefined variable error
$row = [
    'title' => '',
    'description' => '',
    'price' => '',
    'quantity' => '',
    'sub_categories_id' => '',
    'sub_categories_name' => '',
    'image' => ''
];

// Show data in Fields
if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($connection,$_GET['id']) ;
    $query = "SELECT * FROM `products` WHERE `id` = '$id' ";
    $result = mysqli_query($connection, $query);

    if(!$result) {
        die("Query Failed: " . mysqli_error($connection));
    } else {
        $row = mysqli_fetch_assoc($result);
    }
}
?>

<?php 
// Update Product
if(isset($_POST['edit_products'])) {
    if(isset($_GET['id_new'])) {
        $new_id = $_GET['id_new'];
    }

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

    // Handle file upload
    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {

        $file_name = mysqli_real_escape_string($connection, $_FILES['image']['name']);
        $tempname = $_FILES['image']['tmp_name'];
        $folder = 'pics/'.$file_name;
        move_uploaded_file($tempname, $folder);
        $image_update = ", `image` = '$file_name'";

    }
    else 
    {
        $image_update = '';
    }

    $query = "UPDATE `products` SET `title` = '$title', `description` = '$description', `price` = '$price', `quantity` = '$quantity', `sub_categories_id` = '$sub_categories_id', `sub_categories_name` = '$sub_categories_name', $image_update WHERE `id` = '$new_id' ";
    $result = mysqli_query($connection, $query);
    
    if(!$result) {
        die("Query failed: " . mysqli_error($connection));
    } else {
        header('Location: view_products.php?update_msg=PRODUCT UPDATED SUCCESSFULLY');
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head> 
    <?php include("css.php") ?>
    <style>
        h2 {
            display: inline-block;
            width: 200px;
            padding: 20px;
        }
        label {
            display: inline-block;
            width: 200px;
            padding: 20px;
            color: white;
        }
        textarea {
            height: 110px;
            width: 450px;
        }
        input[type="text"] {
            height: 40px;
            width: 300px;
        }
    </style>
</head>
<body>
    <?php include("header.php") ?>
    <?php include("sidebar.php") ?>

    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <h2 style="color: white;">Edit Product</h2>
                <div class="div_deg d-flex justify-content-center align-item-center">
                    <form action="edit_products.php?id_new=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
                        <div>
                            <label for="">Title</label>
                            <input type="text" name="title" value="<?php echo htmlspecialchars($row['title']); ?>">
                        </div>
                        <div>
                            <label for="">Description</label>
                            <textarea name="description" id="description"><?php echo htmlspecialchars($row['description']); ?></textarea>
                        </div>
                        <div>
                            <label for="">Sub Category</label>
                            <select name="sub_categories_id">
                                <?php 
                                $query = "SELECT * FROM sub_categories";
                                $result = mysqli_query($connection, $query);
                                if(!$result) {
                                    die("Query Failed: " . mysqli_error($connection));
                                } else {
                                    while($roww = mysqli_fetch_assoc($result)) {
                                        $selected = ($roww['id'] == $row['sub_categories_id']) ? 'selected' : '';
                                        echo '<option value="'.htmlspecialchars($roww['id']).'" '.$selected.'>'.htmlspecialchars($roww['sub_categories_name']).'</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="">Price</label>
                            <input type="number" name="price" value="<?php echo htmlspecialchars($row['price']); ?>">
                        </div>
                        <div>
                            <label for="">Quantity</label>
                            <input type="number" name="quantity" value="<?php echo htmlspecialchars($row['quantity']); ?>">
                        </div>
                        <div>
                            <label for="">Current Image</label>
                            <img src="pics/<?php echo htmlspecialchars($row['image']); ?>" height="120" width="120">
                        </div>
                        <div>
                            <label for="">New Image</label>
                            <input type="file" name="image" accept=".jpg, .jpeg, .png">
                        </div>
                        <div>
                            <input class="btn btn-success" type="submit" name="edit_products" value="Update Product">
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
