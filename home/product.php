<?php include ("../connection/conn.php"); ?>

<section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Latest Products
          </h2>
          </div>
          <div class="row">
            
           
          <!-- PHP Start -->
   <?php 
      
        $query = "SELECT * FROM products";
        $result = mysqli_query($connection, $query);

        if(!$result){
          die("Query Failed" . mysqli_error());
        }
        else{
      
        while($row = mysqli_fetch_assoc($result)){
      
          ?>


        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="box">
            
          <!-- Product Details -->
            <a href="products_details.php?id=<?php echo $row['id'] ?>">

            <!-- Image -->
              <div class="img-box">
                <img src="../admin/products/pics/<?php echo $row['image'] ?>" height="120" width="120" alt="">
              </div>

              <div class="detail-box">

              <!-- Title -->
                <h6>
                  <?php echo $row['title'] ?>
                </h6>

                <!-- Price -->
                <h6>
                  Price
                  <span>
                    Rs. <?php echo $row['price'] ?>
                  </span>
                </h6>
              </div>

              <!-- Add To Cart -->
              <div class="p-1">
                <a class="btn btn-success" href="add_to_cart.php?product_id=<?php echo $row['id'] ?>">Add to Cart</a>
              </div>


              <div class="new">
                <span>
                  New
                </span>
              </div>
            </a>
          </div>
        </div>


        <!-- PHP End -->

        <?php 
        }
  }

?>


        </div>
      </div>
      
    </div>
  </section>