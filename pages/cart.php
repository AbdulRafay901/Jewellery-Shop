
<?php

require_once __DIR__. "/../includes/header.php";

$total = 0;

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
            <p style="color:#A07936;">Curabitur cursus dignis<p>
      </div>
</div>
<!-- ProductDetails --- Section --- 1 --- End -->


<!-- Cart --- Section --- 2 --- Start -->

<?php if(empty($_SESSION['cart'])){ ?>
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
          <div class="C-S2-container">
                <div class="C-S2-content">
                       <div class="C-S2-text">
                             <h1>SHOPPING CART</h1>
                       </div>
                       <form action="update-qty.php" method="POST">
                       <div class="C-S2-cart">
                             <?php foreach($_SESSION['cart'] as $id => $item){ 
                             
                                   
                                   $subtotal = $item['price'] * $item['qty'];
                                   $total += $subtotal;
                              ?>
                             <div class="details">
                                    <div class="item">
                                          <div class="p">
                                                <p>ITEMS</p>
                                          </div>
                                          
                                          <div class="img-p">
                                                <img src="../assets/images/<?php echo $item['image'];  ?>">
                                                <p><?php echo $item['name'];  ?></p>
                                          </div>
                                          
                                    </div>
                                    <div class="item">
                                          <div class="p">
                                                <p>PRICE</p>
                                          </div>
                                          
                                          <div class="img-p">
                                                <span>$<?php echo $item['price']  ?></span>
                                          </div>
                                          
                                    </div>
                                    <div class="item">
                                          <div class="p">
                                                <p>QTY</p>
                                          </div>
                                         
                                          <div class="img-p">
                                                <input type="text" maxlength="5" inputmode="numeric"  name="qty[<?php echo $id ?>]" value="<?php echo $item['qty'] ?>">
                                          </div>
                                          
                                    </div>
                                    <div class="item">
                                          <div class="p">
                                                <p>SUBTOTAL</p>
                                          </div>
                                          
                                          <div class="img-p">
                                                <span>$<?php echo $subtotal; ?>.00</span>
                                          </div>
                                          
                                    </div>
                                    <div class="item">
                                          <div class="p">
                                                <p style="opacity:0;">SUBTOTAL</p>
                                          </div>
                                          
                                          <div class="img-p">
                                                <a href="remove.php?id=<?php echo $id?>"><i class="ri-close-circle-line"></i><h6>REMOVE</h6></a>
                                          </div>
                                         
                                    </div>

                                    
                             </div>
                             <?php } ?>
                             <div class="update-total">
                                   <div>
                                         <button type="submit" name="submit">UPDATE QTY</button>
                                         <p>$<?php echo $total ?>.00</p>
                                   </div>
                             </div>
                       </div>
                       </form>
                       <div class="checkout-btn">
                             <a href="billing.php"><button>PROCEED TO CHECKOUT</button></a>
                       </div>
                </div>
          </div>
</section>
<?php }?>
<!-- Cart --- Section --- 2 --- End -->

<?php

require_once __DIR__. "/../includes/footer.php";

?>