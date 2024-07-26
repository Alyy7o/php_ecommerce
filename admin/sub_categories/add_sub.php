<?php include ("../../connection/conn.php");
session_start();

?>

<?php 

if(isset($_POST['add_sub'])){

    $categories_id = $_POST['categories_id'];
    $name = $_POST['title'];

    $file_name = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    $folder = 'pics/'.$file_name;
  
    $query = mysqli_query($connection,"INSERT INTO sub_categories( `categories_id`, `sub_categories_name`, `image`) Value ( '$categories_id', '$name','$file_name')");
  if(!$query){
    die("Query Failed" . mysqli_error());
  }
  else{

    move_uploaded_file($tempname,$folder);
    header('location:view_sub.php?insert_msg=SUB Category ADDED SUCCESSFULLY');
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
      
      <!-- Sidebar Navigation start-->
      <?php include("sidebar.php") ?>
      
      <!-- Sidebar Navigation end-->
      
      <div class="page-content">
          <div class="page-header">
              <div class="container-fluid">

              <h1  style="color: white">Add Sub-Category</h1>

              <div class="div_deg">

                <form action="add_sub.php" method="post" enctype="multipart/form-data">

                    
                    <div class="input_deg">
                        <label>Title</label>
                        <input type="text" name="title" required>
                    </div>


                    <div class="input_deg">
                        <label>Sub-Category</label>

                        <select name="categories_id" required>
                            <option>Select an Option</option>

                    <?php 
                                                
                        $query = ("SELECT * FROM categories ");
                        $result = mysqli_query($connection, $query);
                        
                        if(!$result){
                    
                        die("Query Failed" . mysqli_error());
                        }

                        else{

                        while($row = mysqli_fetch_assoc($result)){
                                            
                        ?>

                           

                            <option value="<?php echo $row['id']; ?>"><?php echo $row['category_name']; ?></option>

                        <?php 

                            }
                        }
                        
                        ?>

                        </select>                    
                    </div>

                    <div class="input_deg">
                        <label>Sub Category Image</label>
                        <input type="file" name="image" value="" accept=".jpg, .jpeg, .png">
                    </div>
                    
                    <div class="input_deg">
                        <input class="btn btn-success" type="submit" value="Add Product" name="add_sub">
                    </div>
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