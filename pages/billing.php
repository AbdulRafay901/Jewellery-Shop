<?php



require_once __DIR__. '/../includes/db.php';
require_once __DIR__. '/../includes/send_email.php';

if(session_status() === PHP_SESSION_NONE){
      session_start();
}

if(!$_SESSION['username']){
      header("Location: ../authentication/login.php");
}

if(isset($_SESSION['success-message'])){
      echo '<div class="Order-Success-msg">'.$_SESSION['success-message'].'</div>';
      unset($_SESSION['success-message']);
}

$total = 0;


$error = [];



if(isset($_POST['submit'])){

// $_SESSION['success-message'] = "<div class='icon'>
//                                                   <i class='ri-check-line'></i>
//                                             </div>
//                                             <div class='text'>
//                                                   <p>Thank you Rafay"."<br>"." Your ORD-2026-#8972x has been placed</p>
//                                             </div>";
      $first = $_POST['first'];
      $last = $_POST['last'];
      $company = $_POST['company'];
      $country = $_POST['country'];
      $street = $_POST['street'];
      $apartment = $_POST['apartment'];
      $city = $_POST['city'];
      $state = $_POST['state'];
      $zip = $_POST['zip'];
      $phone = $_POST['phone'];
      $email = $_POST['email'];
      $additional = $_POST['additional'];
      // $subtotal = $_POST['subtotal'];
      $product_total = $_POST['total'];

      foreach($_SESSION['cart'] as $id => $item){
            $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
            $stmt->execute([$id]);
            $product = $stmt->fetch(PDO::FETCH_ASSOC);

            if(!$product){
                  die("Product Not found");
            }
            if($item['price'] != $product['new_price']){
                  die("Price mismatch this product".$product['name']);
            }
      }

      if($first == ""){
            $error['first'] = "Billing First name is a required field.";
      }
      if($last == ""){
            $error['last'] = "Billing Last name is a required field.";
      }
      if($country == ""){
            $error['country'] = "Billing Country name is a required field.";
      }
      if($street == ""){
            $error['street'] = "Billing Street name is a required field.";
      }
      if($city == ""){
            $error['city'] = "Billing City name is a required field.";
      }
      if($state == ""){
            $error['state'] = "Billing State name is a required field.";
      }
      if($zip == ""){
            $error['zip'] = "Billing Zip name is a required field.";
      }
      if($phone == ""){
            $error['phone'] = "Billing Phone name is a required field.";
      }
      if($email == ""){
            $error['email'] = "Billing Email name is a required field.";
      }
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error['email'] = "invalid Email";
      }
      // if(!preg_match("/^\+?[0-9]{10,15}$/",$phone)){
      //       $error['phone'] = "invalid Number";
      // }
      if(empty($_SESSION['cart'])){
            $cart_empty = "Cart is Empty";
      }
      if(!ctype_digit($phone)){
            $error['phone'] = "invalid Number";
      }
      if(strlen($phone) < 10 || strlen($phone) > 15 ){
            $error['phone'] = "invalid Length";
      }

      else{
            $order_number =   "ORD-".date('Y')."-"."#".random_int(100000,900000);
            $status = "pending";

            $stmt = $conn->prepare("INSERT INTO orders (first_name, last_name, company_name, country_region, street_address, apartment, town_city, state_country, zip, Phone, Email, additional, order_number, total_amount, status)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$first,$last,$company,$country,$street,$apartment,$city,$state,$zip,$phone,$email,$additional,$order_number,$product_total,$status]);

            $order_id = $conn->lastInsertId();

            foreach($_SESSION['cart'] as $id => $item){
                  $subtotal = $item['price'] * $item['qty'];
                  $stmt = $conn->prepare("INSERT INTO order_items (order_id,product_id,product_name,image,price,quantity,size,color,subtotal) VALUES 
                  (?, ?, ?, ?, ?, ?, ?, ?,?)");
                  $stmt->execute([$order_id, $id, $item['name'], $item['image'], $item['price'], $item['qty'], $item['type'], $item['color'], $subtotal]);
            }

            unset($_SESSION['cart']);
            unset($_SESSION['count']);

            $_SESSION['success-message'] = "<div class='icon'>
                                                  <i class='ri-check-line'></i>
                                            </div>
                                            <div class='text'>
                                                  <p>Thank you ".$first."<br>"." Your ".$order_number." has been placed</p>
                                            </div>";

            
            sendOrderConfirmationEmail($email, $first, $last, $order_number, $product_total);
            

            header("Location: billing.php");
            exit;


            
      }
      

 
}
require_once __DIR__. '/../includes/header.php';
?>

<style>
        .header-nav{
            position: static;
            background-color:#F7F7F7;
            height:auto;
        }
        body {
          background-color: #F7F7F7;
        }
        .search-767px input {       
           background-color: #F7F7F7;
    }
</style>



<!-- ProductDetails --- Section --- 1 --- Start -->
<div class="PD-S1-container">
      <!-- <div class="Order-Success-msg">
            <div class='icon'>
                                                  <i class='ri-check-line'></i>
                                            </div>
                                            <div class='text'>
                                                  <p>Thank you Rafay <br> Your ORD-2026-#298374 has been placed</p>
                                            </div>
      </div> -->
      <div class="PD-S1-content">
            <p>Home</p>
            <p>/</p>
            <p style="color:#A07936;">Checkout <p>
      </div>
</div>
<!-- ProductDetails --- Section --- 1 --- End -->



<!-- Billing --- Section --- 2 --- Start -->
<!-- <div class="Order-Success-msg">
      <div class="icon">
            <i class="ri-check-line"></i>
      </div>
      <div class="text">
            <p>Thank You Rafay, your order #ORD-2026-48212<br> has been placed successfully</p>
      </div>
</div> -->

<?php  if(empty($_SESSION['cart'])){ ?>
         <div class="empty-cart">
                <div class="content">
                      <h1>SHOPPING CART</h1>
                      <div class="p-btn">
                            <p>Your shopping cart is empty.</p>
                            <a href="../index.php"><button>CONTINUE SHOPPING</button></a>
                      </div>
                </div>
          </div>
<?php } else{ ?>



<section>
         <div class="B-S2-container">
               <div class="B-S2-content">
                     <div class="B-S2-text">
                           <h1>Checkout</h1>
                     </div>
                     <div class="container-fluid">
                           <div class="row">
                                 <div class="col-lg-8">
                                       <div class="B-S2-column1">
                                             <div class="text-btn">
                                                   <h4>Billing details</h4>
                                                   <a href="cart.php"><i class="ri-arrow-left-long-line"></i> Back to Cart</a>
                                             </div>
                                             <form method="POST">
                                             <div class="inputs">
                                                   <div class="first-last">
                                                         <div class="first">
                                                               <label for="text">First name *</label>
                                                               <input type="text" name="first">
                                                               <span style="color:red; font-size:13.5px;"><?php echo $error['first'] ?? '' ?></span>
                                                         </div>
                                                         <div class="first">
                                                               <label for="text">Last name *</label>
                                                               <input type="text" name="last">
                                                               <span style="color:red; font-size:13.5px;"><?php echo $error['last'] ?? '' ?></span>
                                                         </div>
                                                   </div>
                                                   <div class="first-last">
                                                         <div class="first">
                                                               <label for="text">Company name (optional) *</label>
                                                               <input type="text" name="company">
                                                         </div>
                                                         <div class="first">
                                                               <label for="text">Country / Region*</label>
                                                               <input type="text" name="country">
                                                               <span style="color:red; font-size:13.5px;"><?php echo $error['country'] ?? '' ?></span>
                                                         </div>
                                                   </div>
                                                   <div class="first-last">
                                                         <div class="first">
                                                               <label for="text">Street address *</label>
                                                               <input type="text" name="street">
                                                               <span style="color:red; font-size:13.5px;"><?php echo $error['street'] ?? '' ?></span>
                                                         </div>
                                                         <div class="first">
                                                               <label for="text">Apartment, suite, unit etc. (optional)*</label>
                                                               <input type="text" name="apartment">
                                                         </div>
                                                   </div>
                                                   <div class="first-last">
                                                         <div class="first">
                                                               <label for="text">Town / City *</label>
                                                               <input type="text" name="city">
                                                               <span style="color:red; font-size:13.5px;"><?php echo $error['city'] ?? '' ?></span>
                                                         </div>
                                                         <div class="first">
                                                               <label for="text">State / Country *</label>
                                                               <input type="text" name="state">
                                                               <span style="color:red; font-size:13.5px;"><?php echo $error['state'] ?? '' ?></span>
                                                         </div>
                                                   </div>
                                                   <div class="first-last">
                                                         <div class="first">
                                                               <label for="text">Postcode / Zip *</label>
                                                               <input type="text" name="zip">
                                                               <span style="color:red; font-size:13.5px;"><?php echo $error['zip'] ?? '' ?></span>
                                                         </div>
                                                         <div class="first">
                                                               <label for="text">Phone *</label>
                                                               <input type="text" name="phone">
                                                               <span style="color:red; font-size:13.5px;"><?php echo $error['phone'] ?? '' ?></span>
                                                         </div>
                                                   </div>
                                                   <div class="first-last">
                                                         <div class="first">
                                                               <label for="text">Email *</label>
                                                               <input type="text" name="email">
                                                               <span style="color:red; font-size:13.5px;"><?php echo $error['email'] ?? '' ?></span>
                                                         </div>
                                                         <!-- <div class="first">
                                                               <label for="text">Phone *</label>
                                                               <input type="text">
                                                         </div> -->
                                                   </div>
                                                   <div class="first-last">
                                                         <div class="first">
                                                               <label for="text">Additional information *</label>
                                                               <textarea placeholder="Notes about your order, e.g. special notes for delivery" name="additional"></textarea>
                                                         </div>
                                                         
                                                   </div>
                                             </div>
                                       </div>
                                 </div>
                                 <div class="col-lg-4">
                                       <div class="B-S2-column2">
                                             <div class="text">
                                                   <h4>Your order</h4>
                                             </div>
                                             <div class="product-sub">
                                                   <p>Product</p>
                                                   <p>Subtotal</p>
                                             </div>
                                             <?php
                                                  foreach($_SESSION['cart'] as $id => $item){ 
                                                      $subtotal = $item['price'] * $item['qty'];
                                                      $total += $subtotal;
                                             ?>
                                             <div class="name-sub">
                                                   <div class="name-qty">
                                                         <p><?php echo $item['name'] ?></p>
                                                         <input type="hidden">
                                                         <p>X</p>
                                                         <p><?php echo $item['qty'] ?></p>
                                                         <input type="hidden">
                                                   </div>
                                                   <div class="sub">
                                                         <p>$<?php echo $subtotal ?>.00<p>
                                                         <!-- <input type="hidden" name="subtotal" value="<?php echo $subtotal ?>"> -->
                                                   </div>
                                             </div>
                                             <?php } ?>
                                             <div class="product-sub total">
                                                   <p>Total</p>
                                                   <p>$<?php echo $total ?>.00</p>
                                                   <input type="hidden" name="total" value="<?php echo $total; ?>">
                                             </div>
                                             <div class="order-btn">
                                                   <button type="submit" name="submit" onclick="submit()">Place order</button>
                                             </div>
                                       </div>
                                 </div>
                                 </form>
                           </div>
                     </div>
               </div>
         </div>
</section>

<?php } ?>

<!-- Billing --- Section --- 2 --- End -->



<?php

require_once __DIR__. '/../includes/footer.php';

?>