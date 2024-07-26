<?php include ("../connection/conn.php");
session_start();

?>

<?php 

    if(isset($_GET['id'])){

      $id = $_GET['id'];
      
      $query = "SELECT * FROM products WHERE `id` = '$id' ";
      $result = mysqli_query($connection, $query);
      
      if(!$result){
        die("Query Failed" . mysqli_error());
      }
      else{
        
        $row = mysqli_fetch_assoc($result);
            
      }
    }

?>

<!DOCTYPE html>
<html>

<head>
<?php include('css.php') ?>
  <style>
    .div_center{
        display:flex;
        justify-content: center;
        align-items: center;
        padding: 20px
    }
    .detail-box{
        padding: 15px;
    }
  </style>
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    <?php include('header.php') ?>

    <!-- end header section -->


<!-- Product Details start -->
<section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Latest Products
        </h2>
      </div>
      <div class="row">


        <div class="col-md-12">
          <div class="box">

          <!-- Image -->
              <div class="div_center">
                <img width="250" src="../admin/products/pics/<?php echo $row['image'] ?>" alt="product_img">
              </div>

              <!-- Title -->
              <div class="detail-box">
                <h6><?php echo $row['title'] ?></h6>

                <!-- Price -->
                <h6>
                    Price
                  <span>
                  <?php echo $row['price'] ?>
                  </span>
                </h6>
              </div>
              
              <div class="detail-box">
                <!-- Category -->
                <h6>Category : 
                  <?php echo $row['sub_categories_name'] ?>
                </h6>

                <!-- Quantity -->
                <h6>
                    Available Quantity
                  <span>
                    :<?php echo $row['quantity'] ?>
                  </span>
                </h6>
              </div>
              
              <!-- Product Description -->
              <div class="detail-box">
                <p>
                  <?php echo $row['description'] ?>
                </p>
              </div>

              <div class="new">
                <span>
                  New
                </span>
              </div>
          </div>
        </div>



        </div>
      </div>
      
    </div>
  </section>
  

  
  
  
  <!-- info section -->
  <?php include('footer.php') ?>

  
</body>

</html>