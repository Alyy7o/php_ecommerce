<?php 
session_start();

?>


<!DOCTYPE html>
<html>
  <head>  
  <?php include("css.php") ?>
    
</head>
<body>
      <?php include("header.php") ?>
      
      <!-- Sidebar Navigation start-->
      
      <?php include("sidebar.php") ?>

      
      <!-- Sidebar Navigation end-->
      
      <div class="page-content">
          <div class="page-header">
              <div class="container-fluid">
             
              <?php include("body.php") ?>

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
  </body>
</html>