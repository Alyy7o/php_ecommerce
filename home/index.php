<?php
session_start();

?>

<!DOCTYPE html>
<html>

<head>
  <?php include ('css.php') ?>
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    
    <?php include('header.php') ?>
    
    <!-- end header section -->
    <!-- slider section -->
    
    <?php include('slider.php') ?>
    
    <!-- end slider section -->
  </div>
  <!-- end hero area -->

  <!-- shop section -->
  <?php include('product.php') ?>
  
  <!-- end shop section -->
  
  <!-- contact section -->
  <?php include('contact.php') ?>
  
  
  <br><br><br>
  
  <!-- end contact section -->
  
  
  
  <!-- info section -->
  <?php include('footer.php') ?>

  
</body>

</html>