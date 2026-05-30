
<?php

require_once __DIR__. '/../includes/db.php';

session_start();


$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM products Where id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);


?>

<?php

require_once __DIR__. '/../includes/header.php';


?>

<style>
        .header-nav{
            position: static;
            background-color:#F7F7F7;
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
      <div class="PD-S1-content">
            <p>Home</p>
            <p>/</p>
            <p style="color:#A07936;">Products Details<p>
      </div>
</div>
<!-- ProductDetails --- Section --- 1 --- End -->



<!-- ProductDetails --- Section --- 2 --- Start -->
<section>
          <div class="PD-S2-container">
                <div class="PD-S2-content">
                      <form action="add_to_cart.php" method="POST">
                      <div class="products-details">
                            <div class="title-image">
                                  <div class="title">
                                        <p><?php echo $product['name'];  ?></p>
                                        <input type="hidden" name="product_name" value="<?php echo $product['name'];?>">
                                        <input type="hidden" name="product_id" value="<?php echo $product['id'] ?>">
                                  </div>
                                  <div class="img">
                                        <img src="../assets/images/<?php echo $product['main_image']; ?>">
                                        <input type="hidden" name="product_image" value="<?php echo $product['main_image'] ?>">
                                  </div>
                            </div>
                            <div class="description-details">
                                   <div class="container-fluid p-0">
                                         <div class="row">
                                                <div class="col-lg-6">
                                                      <div class="description-column">
                                                            <p>Product Descriptiton</p>
                                                            <p><?php echo $product['description'];?></p>
                                                            <input type="hidden" name="product_description" value="<?php echo $product['description'] ?>">
                                                      </div>
                                                </div>
                                                <div class="col-lg-6">
                                                      <div class="details-column">
                                                            <div class="line"></div>
                                                            <div class="content">
                                                                  <div class="colors">
                                                                        <p>Color</p>
                                                                        <div class="radio">
                                                                              <input type="radio" id="Golden" name="product_color" value="golden" hidden>
                                                                              <label for="Golden"></label>

                                                                              <input type="radio" id="Silver" name="product_color" value="silver" hidden>
                                                                              <label for="Silver"></label>
                                                                        </div>
                                                                  </div>
                                                                  <p style="color:red; margin-top:10px;"><?php echo $_SESSION['color'] ?? ''?></p>
                                                                  <div class="size">
                                                                        <p>Size</p>
                                                                        <div class="radio">
                                                                              <input type="radio" id="Small" name="product_type" value="small" hidden>
                                                                              <label for="Small" >SMALL</label>

                                                                              <input type="radio" id="Medium" name="product_type" value="medium" hidden>
                                                                              <label for="Medium">MEDIUM</label>

                                                                              <input type="radio" id="Large" name="product_type" value="large" hidden>
                                                                              <label for="Large">LARGE</label>
                                                                        </div>
                                                                  </div>
                                                                  <p style="color:red; margin-top:10px;"><?php echo $_SESSION['size'] ?? ''?></p>
                                                                  <div class="qty">
                                                                         <p>Quantity</p>
                                                                         <div class="quantity">
                                                                                <button type="button" onclick="minus()"><i class="ri-arrow-left-s-fill"></i></button>
                                                                                <div class="quantity-display">
                                                                                      <input type="number" name="product_qty" value="1" min="1" id="qty-input">
                                                                                </div>
                                                                                <button type="button" onclick="plus()"><i class="ri-arrow-right-s-fill"></i></button>
                                                                         </div>
                                                                  </div>
                                                                  <div class="price">     
                                                                        <p>$<?php echo $product['new_price']  ?></p>
                                                                        <input type="hidden" name="product_price" value="<?php echo $product['new_price'] ?>">
                                                                        <p>/</p>
                                                                        <p>$<?php echo $product['old_price']  ?></p>
                                                                  </div>
                                                                  <div class="add-to-cart">
                                                                        <button type="submit" name="submit">ADD TO CART</button>
                                                                  </div>
                                                                  <div class="wishList-email">
                                                                         <div class="wishList">
                                                                               <i class="ri-heart-fill"></i>
                                                                               <p>Wish list</p>
                                                                         </div>
                                                                         <div class="p">
                                                                               <p>|</p>
                                                                         </div>
                                                                         <div class="wishList">
                                                                               <i class="ri-mail-fill"></i>
                                                                               <p>SEND EMAIL</p>
                                                                         </div>
                                                                  </div>
                                                                  <div class="p-border">
                                                                         <p>MEASURMENTS & SPECS</p>
                                                                  </div>
                                                                  <div class="p-border">
                                                                         <p>SHIPPING & RETURNS</p>
                                                                  </div>
                                                                  <div class="p-border">
                                                                         <p>SIZE CHARTS</p>
                                                                  </div>
                                                            </div>
                                                      </div>
                                                </div>
                                         </div>
                                   </div>
                            </div>
                      </div>
                      </form>
                </div>
          </div>
</section>
<!-- ProductDetails --- Section --- 2 --- End -->


<!-- ProductDetails --- Section --- 3 --- Start -->

<?php require_once __DIR__. '/../includes/newsletter.php'?>

<!-- ProductDetails --- Section --- 3 --- End -->








<?php

require_once __DIR__. '/../includes/footer.php';

?>