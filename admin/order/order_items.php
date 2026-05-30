
<?php

if(session_status() === PHP_SESSION_NONE){
      session_start();
}


require_once __DIR__. '/../../includes/db.php';

require_once __DIR__. '/../auth_check.php';



if(isset($_GET['id'])){
      $id = $_GET['id'];

      $order = $conn->prepare("SELECT * FROM orders WHERE id = ?");
      $order->execute([$id]);

      $order_table = $order->fetch(PDO::FETCH_ASSOC);

      $stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id = ?");
      $stmt->execute([$id]);

      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

}



?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Remix icon Cdn  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.css" integrity="sha512-kJlvECunwXftkPwyvHbclArO8wszgBGisiLeuDFwNM8ws+wKIw0sv1os3ClWZOcrEB2eRXULYUsm8OVRGJKwGA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     
    <!-- Font Awesome Cdn -->
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Link Swiper's CSS -->
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />    

    <!-- Bootstrap Cdn Link -->
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <link rel="stylesheet" href="../../assets/css/admin.css">
   
    <style>
            .order-ipi{
                  background-color: #A07936;
            }
            .order-ipi i,
            .order-ip a{
                  color:white !important;
            }
    </style>

</head>
<body>

      <div class="sidebar-content">
            <?php require_once __DIR__. '/../includes/sidebar.php'; ?>
            <div class="content">
                   <?php require_once __DIR__. '/../includes/header.php'; ?>
                    <div class="order-items">
                          <div class="h1">
                                <h1><?php echo $order_table['order_number'] ?></h1>
                          </div>
                          <div class="container-fluid p-0">
                                <div class="row">
                                      <div class="col-lg-8 col-md-7">
                                            <div class="order-items-C1">
                                                  <div class="all-item">
                                                        <div class="p">
                                                              <p>All item</p>
                                                        </div>
                                                        <?php foreach ($data as $item){ ?>
                                                        <div class="item">
                                                              <div class="img-name">
                                                                     <img src="../../assets/images/<?php echo $item['image']  ?>">
                                                                     <div class="name">
                                                                           <p><?php echo $item['product_name'] ?></p>
                                                                           <p>Size: <?php echo $item['size']  ?></p>
                                                                           <!-- <p>Color: Silver</p> -->
                                                                     </div>
                                                              </div>
                                                              <div class="color">
                                                                    <p>Color</p>
                                                                    <p><?php echo $item['color']  ?></p>
                                                              </div>
                                                              <div class="color qty">
                                                                    <p>Quantity</p>
                                                                    <p><?php echo $item['quantity'] ?></p>
                                                              </div>
                                                              <div class="color price">
                                                                    <p>Price</p>
                                                                    <p>$<?php echo $item['price'] ?></p>
                                                              </div>
                                                              <div class="color subtotal">
                                                                    <p>Subtotal</p>
                                                                    <p>$<?php echo $item['subtotal'] ?></p>
                                                              </div>
                                                        </div>
                                                        <?php } ?>
                                                        
                                                  </div>
                                            </div>
                                      </div>
                                      <div class="col-lg-4 col-md-5">
                                            <div class="order-items-C2">
                                                  <div class="summary">
                                                        <div class="p">
                                                              <p>Summary</p>
                                                        </div>
                                                        <div class="order-details">
                                                              <div class="id">
                                                                    <p>Order ID</p>
                                                                    <p><?php echo $order_table['order_number']  ?></p>
                                                              </div>
                                                              <div class="id">
                                                                    <p>Date</p>
                                                                    <p><?php echo $order_table['create_at']  ?></p>
                                                              </div>
                                                              <div class="id">
                                                                    <p>Total</p>
                                                                    <p>$<?php echo $order_table['total_amount']  ?></p>
                                                              </div>
                                                        </div>
                                                  </div>
                                                  <div class="shipping">
                                                      <div class="address">
                                                              <p>Customer Name</p>
                                                              <p><?php echo $order_table['first_name']." ".$order_table['last_name']  ?></p>
                                                        </div>
                                                        <div class="address">
                                                              <p>Shipping Address</p>
                                                              <p><?php echo $order_table['country_region']." ".$order_table['town_city']." ". $order_table['state_country']." ". $order_table['street_address']." ". $order_table['apartment']." ". $order_table['additional'] ?></p>
                                                        </div>
                                                        <div class="address">
                                                              <p>Contact Number</p>
                                                              <p>03493332883</p>
                                                        </div>
                                                  </div>
                                            </div>
                                      </div>
                                </div>
                          </div>
                    </div>
            </div>
      </div>

       <!-- Boostrap Cdn -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  <script src="../../assets/javascript/admin.js"></script>
  
</body>
</html>