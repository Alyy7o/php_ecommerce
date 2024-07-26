<?php
include ("../connection/conn.php");
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>

<?php 

if(isset($_SESSION['user_id'])){

    $user_id = $_SESSION['user_id'];
    
    $query = "SELECT * FROM users WHERE `id` = '$user_id' ";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    

}



?>


<!DOCTYPE html>
<html>

<head>
<?php include ('css.php') ?>
</head>

<style>
    table{
        border: 2px solid black;
        text-align: center;
        width: 800px;
    }
    th{
        border: 2px solid black;
        text-align: center;
        color: white;
        font: 20px;
        font-weight: bold;
        background-color: black;
    }
    td{
        border: 1px solid skyblue;
    }
    .order_deg{
        padding-right: 100px;
        /* margin-top: -100px; */
    }
    label{
        display: block;
        width: 200px;
        font-weight: bold;
    }
    .div_gap{
        padding: 15px;
    }
</style>


<body>
  <div class="hero_area">
    <!-- header section strats -->
    <?php include('header.php') ?>

  </div>

  <div class="d-flex justify-content-center align-items-center m-5">

  <div class="order_deg">

    <form action="confirm_order.php" method="post">
    

    <div class="div_gap">
        <label for="">Receiver Name</label>
        <input type="text" name="name" value="<?php echo $row['name']; ?>">
    </div>

    <div class="div_gap">
        <label for="">Email</label>
        <textarea  name="address"><?php echo $row['email']; ?></textarea>
    </div>

    <div class="div_gap">
        <label for="">Receiver Phone</label>
        <input type="text" name="phone" value="<?php echo $row['phone']; ?>">
    </div>

    <div class="div_gap">
        <label for="">Shipping Address</label>
        <textarea  name="address"><?php echo $row['address']; ?></textarea>
    </div>

    <div class="div_gap">
        <!-- <input type="submit" value="Place Order" class="btn btn-primary"> -->
        <a href="order_proceed.php?user_id=<?php echo $row['id']; ?>" type="submit" class="btn btn-primary">Place Order</a>
    </div>
    
    </form>



  </div>

    <table>
        <thead>
        <tr>
            <th>Product Title</th>
            <th>Price</th>
            <th>Image</th>
            <th>Remove</th>
        </tr>
        </thead>

        <tbody>

        <?php 
        $value = 0;
        ?>

                <?php

                $user_id = $_SESSION['user_id'];

                $query = "SELECT products.id, products.title, products.price, products.image FROM cart 
                        JOIN products ON cart.product_id = products.id 
                        WHERE cart.user_id = '$user_id'";

                $result = mysqli_query($connection, $query);
                if(!$result){
                    die("Query Failed" . mysqli_error());
                }
                else{
                    while($row = mysqli_fetch_assoc($result)){
                ?>

            <tr>
                
                <td><?php echo $row['title']; ?></td> 
                <td><?php echo $row['price']; ?></td>
                <td><img src="../admin/products/pics/<?php echo $row['image']; ?>" height="120" width="120"></td>

                <!-- <td><a href="remove_products.php?product_id=<?php echo $row['id']; ?>" onclick="confirmation(event)" class="btn btn-danger">REMOVE</a></td> -->
                <td><a href="remove_products.php?product_id=<?php echo $row['id']; ?>" class="btn btn-danger">REMOVE</a></td>
            </tr>

        <?php 

        $value = $value + $row['price'] ;

        ?>
                    
                <?php
                    

                }
            }
            ?>
                    </tbody>

        

    </table>

  </div>

  <div class="d-flex justify-content-center mb-5 p-5">
    <h3>Total Value of Cart is : Rs. <?php echo $value ?></h3>
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
  
  <!-- info section -->
  <?php include('footer.php') ?>

  
</body>

</html>