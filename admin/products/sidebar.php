<div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      <nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
          <div class="avatar"><img src="../img/avatar-6.jpg" alt="..." class="img-fluid rounded-circle"></div>
          <div class="title">
            <h1 class="h5">Ali Javed</h1>
            <p>Web Developer</p>
          </div>
        </div>
        <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
        <ul class="list-unstyled">
                <li class="active"><a href="../index.php"> <i class="icon-home"></i>Home </a></li>

                <li>
                    <a href="../categories/category.php"> <i class="icon-grid"></i>Category </a>
                </li>
                <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>SUB-Category </a>
                  <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                  <li><a href="sub_categories/view_sub.php">View Sub-Category</a></li>
                  <li><a href="sub_categories/add_sub.php">Add Sub-Category</a></li>
                </ul>
                </li>

                <li><a href="#exampledropdownDropdown1" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Products </a>
                  <ul id="exampledropdownDropdown1" class="collapse list-unstyled ">
                  <li><a href="products/view_products.php">View Products</a></li>
                  <li><a href="products/add_products.php">Add Products</a></li>
                </ul>
                </li>
                
                <li>
                    <a href="{{asset('view_orders')}}"> <i class="icon-grid"></i>Orders </a>
                </li>
        
        </ul>
               
      </nav>