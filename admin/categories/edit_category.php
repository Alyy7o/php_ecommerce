<?php include ("../connection/conn.php");
session_start();

?>

<?php 

//Show data in Fields

if(isset($_GET['id'])){

    $id = $_GET['id'];

    $query = "SELECT * FROM `categories` WHERE `id` = '$id' ";

    $result = mysqli_query($connection,$query);

    if(!$result){

        die("Query Failed" . mysqli_error());
    }
    else{
        $row = mysqli_fetch_assoc($result);
    }
}

?>



<?php 

//Update Category

if(isset($_POST['edit_category'])){

  if(isset($_GET['id_new'])){
    $new_id = $_GET['id_new'];
}

  $category_name = $_POST['category'];

  $query = ("UPDATE `categories` SET `category_name` = '$category_name' WHERE `id` = '$new_id' ");

  $result = mysqli_query($connection, $query);
    
    if(!$result){
        die("Query failed" . mysqli_error());
    }
    else{
        header('location:category.php?update_msg=Category UPDATED SUCCESSFULLY');
        exit();
    }
}

?>



<!DOCTYPE html>
<html>
  <head> 
  <?php include("css.php") ?>    
</head>
<body>
<?php include("../header.php") ?>
      
      <!-- Sidebar Navigation start-->
      <?php include("../sidebar.php") ?>
      
      <!-- Sidebar Navigation end-->
      
      <div class="page-content">
          <div class="page-header">
              <div class="container-fluid">
             
                  <h1 style="color: white">Edit Category</h1>

              <div class="d-flex justify-content-center align-items-center m-5">

                <form action="edit_category.php?id_new=<?php echo $id; ?>" method="post">

                    <input style="height: 43px; width: 400px" type="text" name="category" value="<?php echo $row['category_name']; ?>">

                    <input type="submit" name="edit_category" class="btn btn-primary" value="Update Category">
                </form>
              </div>
        
        </div>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="../../vendor/popper.js/umd/popper.min.js"> </script>
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="../../vendor/chart.js/Chart.min.js"></script>
    <script src="../../vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="../../js/charts-home.js"></script>
    <script src="../../js/front.js"></script>
  </body>
</html>