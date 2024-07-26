<?php include ("../../connection/conn.php");
session_start();

?>

<?php 

//Insertion

if(isset($_POST['add_category'])){

    $category_name = $_POST['category'];

    $query = "INSERT INTO `categories`(`category_name`) VALUE ('$category_name') ";

    $result = mysqli_query($connection,$query);

    if(!$result){

        die("Query Failed" . mysqli_error());
    }
    else{
        echo "Category Addded Successfully!";
    }
}

?>



<!DOCTYPE html>
<html>
  <head> 
  <?php include("css.php") ?>

    <style>
        input[type='text']{
            width: 400px;
            height: 50px;
        }

        .tabel_deg{
            border: 2px solid yellowgreen;
            width: 600px;
            text-align: center;

        }
        th{
            background: skyblue;
            padding: 15px;
            font-size: 20px;
            font-weight: bold;
            color: white;
        }
        td{
            text-align: center;
            color: white;
            padding: 10px;
            border: 1px solid skyblue;
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
             
                  <h1 style="color: white">Add Category</h1>
              <div class="div_deg d-flex justify-content-center align-item-center m-4">

                  <form method="post">

                        <div>
                          <input type="text" name="category">
                          
                          <input name="add_category" type="submit" class="btn btn-primary" value="Add Category">
                        </div>

                    </form>

                </div>

                <div>
                    <table class="m-auto mt-4 tabel_deg">

                    <thead>
                        <tr>
                            <th>Category Name</th>

                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>

        <?php 
        
        $query = ("SELECT * FROM categories ");
        $result = mysqli_query($connection, $query);
            
        if(!$result){
        
            die("Query Failed" . mysqli_error());
        }
        else{
            while($row = mysqli_fetch_assoc($result)){
            
        ?>
            <tr>
                <td><?php echo $row['category_name']; ?></td>
                <td><a href="edit_category.php?id=<?php echo $row['id']; ?>" class="btn btn-success">Edit</a></td>
                <td><a href="delete_category.php?id=<?php echo $row['id']; ?>" onclick="confirmation(event)" class="btn btn-danger">Delete</a></td>
                
            </tr>

            <?php 
              }
            }
            ?>

                        </tbody>


                    </table>

                </div>
        
        </div>
      </div>
    </div>
    <!-- JavaScript files-->

    <script>
        function confirmation(ev){
            ev.preventDefault();

            var urlToRedirect = ev.currentTarget.getAttribute('href');

            console.log(urlToRedirect);

            swal({
                title: "Are You Sure to Delete This",
                text: "This delete will be permanent",
                icon: "Warning",
                buttons: true,
                dangerMode: true,
            })

            .then((willCancel)=>
            {
                if(willCancel){
                    window.location.href = urlToRedirect;
                }

        }); 
        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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