
<?php
      define("BASE_URL", "http://localhost/Jewellery%20Shop/")
?>


<div class="sidebar">
                  <div class="text">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15"><path fill="currentColor" d="m15 5.5l-3.5-4h-8L0 5.5L7.5 14zm-4.25 0l.75-3l2.5 3zm-.25.75h2.75L8.5 12zM10 5.5L8 2.25h2.75zm-4.5.75h4l-2 6.25zm.25-.75l1.75-3l1.75 3zM5 5.5l-.75-3.25H7zM6.5 12l-5-5.75h3zm-3-9.5l.75 3H1z"/></svg>
                        <h1>Jewellery</h1>
                  </div>
                  <div class="column1">
                        <p>GENERAL</p>
                        <div class="content">
                               <div class="i-p-i dashboard-ipi">
                                     <div class="i-p dashboard-ip">
                                           <i class="ri-dashboard-3-line"></i>
                                           <a href="<?php echo BASE_URL;  ?>admin/dashboard.php">Dashboard</a>
                                     </div>
                                     
                               </div>
                        </div>
                        <div class="content">
                               <div class="i-p-i products-ipi">
                                     <div class="i-p products-ip">
                                           <i class="ri-dashboard-3-line"></i>
                                           <a href="">Products</a>
                                     </div>
                                     <div class="i dropdown-btn">
                                           <i class="ri-arrow-down-s-line "></i>
                                     </div>
                               </div>
                               <div class="content-dropdown">
                                     <div class="a">
                                           <a href="<?php echo BASE_URL;  ?>admin/products/index.php">List</a>
                                     </div>
                                     <div class="a">
                                           <a href="<?php echo BASE_URL;  ?>admin/products/create.php">Create</a>
                                     </div>
                               </div>
                        </div>
                        <div class="content">
                               <div class="i-p-i category_ipi">
                                     <div class="i-p category_ip">
                                           <i class="ri-dashboard-3-line"></i>
                                           <a href="">Category</a>
                                     </div>
                                     <div class="i dropdown-btn">
                                           <i class="ri-arrow-down-s-line"></i>
                                     </div>
                               </div>
                               <div class="content-dropdown">
                                     <div class="a">
                                           <a href="<?php echo BASE_URL;  ?>admin/category/index.php">List</a>
                                     </div>
                                     <div class="a">
                                           <a href="<?php echo BASE_URL;  ?>admin/category/create.php">Create</a>
                                     </div>
                               </div>
                        </div>
                        <div class="content">
                               <div class="i-p-i order-ipi">
                                     <div class="i-p order-ip">
                                           <i class="ri-dashboard-3-line"></i>
                                           <a href="">Order</a>
                                     </div>
                                     <div class="i dropdown-btn">
                                           <i class="ri-arrow-down-s-line"></i>
                                     </div>
                               </div>
                               <div class="content-dropdown">
                                     <div class="a">
                                           <a href="<?php echo BASE_URL; ?>admin/order/orders.php">List</a>
                                     </div>
                                     <div class="a">
                                           <a href="">Create</a>
                                     </div>
                                     <div class="a">
                                           <a href="">Update</a>
                                     </div>
                               </div>
                        </div>
                        <div class="content">
                               <div class="i-p-i users-ipi">
                                     <div class="i-p users-ip">
                                           <i class="ri-dashboard-3-line"></i>
                                           <a href="">Users</a>
                                     </div>
                                     <div class="i dropdown-btn">
                                           <i class="ri-arrow-down-s-line"></i>
                                     </div>
                               </div>
                               <div class="content-dropdown">
                                     <div class="a">
                                           <a href="<?php echo BASE_URL; ?>admin/users/index.php">List</a>
                                     </div>
                               </div>
                        </div>
                  </div>
            </div>
<div class="sidebar-overlay" id="sidebar-overlay"></div>

            