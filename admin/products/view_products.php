<?php include ("../../connection/conn.php");
session_start();

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
        input[type='search']{
            height: 50px;
            width: 400px;
            margin-right: 10px;
        }
        form{
            display: flex;
            justify-content: center;

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
             
                
                <h1 style="color: white">Add Product</h1>
              <div class="div_deg d-flex justify-content-center align-item-center m-4">

                <div>
                    <table class="m-auto mt-4 tabel_deg">

                    <thead>

                        <tr>
                            <th>Product Title</th>
                            <th>Description</th>
                            <th>Sub Category</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Image</th>
                            
                            <th>Edit</th>
                            <th>Remove</th>
   
                        </tr>
                    </thead>

                    <tbody>
                    <?php
                    $query = ("SELECT * FROM products ");
                    $result = mysqli_query($connection, $query);

                    if(!$result){
                        die("Query Failed" . mysqli_error());
                    }
                    else{
                        while($row = mysqli_fetch_assoc($result)){
                    ?>

            <tr>
                
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo $row['sub_categories_name']; ?></td>
                <td><?php echo $row['price']; ?></td>
                <td><?php echo $row['quantity']; ?></td>
                <td><img src="pics/<?php echo $row['image']; ?>" height="120" width="120"></td>

                <td><a href="edit_products.php?id=<?php echo $row['id']; ?>" class="btn btn-success">EDIT</a></td>
                <td><a href="delete_products.php?id=<?php echo $row['id']; ?>" onclick="confirmation(event)" class="btn btn-danger">DELETE</a></td>
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