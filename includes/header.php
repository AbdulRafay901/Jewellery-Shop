
<?php
define("BASE_URL", "http://localhost/Jewellery%20Shop/");


if(session_status() === PHP_SESSION_NONE){
      session_start();
}

if(empty($_SESSION['csrf_token'])){
      $token = bin2hex(random_bytes(32));
      $_SESSION['csrf_token'] = $token;
}
$token = $_SESSION['csrf_token'];


$header_total = 0

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
 

    <!-- AOS Library Cdn -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Remix icon Cdn  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.css" integrity="sha512-kJlvECunwXftkPwyvHbclArO8wszgBGisiLeuDFwNM8ws+wKIw0sv1os3ClWZOcrEB2eRXULYUsm8OVRGJKwGA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     
    <!-- Font Awesome Cdn -->
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Link Swiper's CSS -->
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />    

    <!-- Bootstrap Cdn Link -->
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

         <link rel="stylesheet" href="<?php echo BASE_URL;  ?>assets/css/style.css?v=<?php echo time(); ?>">

</head>
<body>
       <!-- Header + Navbar Start-->
        <section>
            <div class="header-nav"  >
                  <!-- Header --- Start -->
                   <div class="header-container">
                         <div class="header-content">
                               <div class="header-column1">
                                     <p>PHONE SHOPING (01) 123 456 UJ</p>
                               </div>
                               <div class="header-column2">
                                     <div class="authen">
                                           <div class="account">
                                                 <!-- <p>MY ACCOUNT<p> -->
                                           </div>
                                           <div class="login-regis">
                                                 <div class="login-div">
                                                       <p><a href="<?php echo BASE_URL;?>authentication/login.php" style="text-decoration:none; color:black;">LOGIN</a></p>
                                                       <div class="login-form">
                                                             <form method="POST" action="<?php echo BASE_URL; ?>authentication/login.php">
                                                                     <div class="input">
                                                                           <label>Email Address <span style="color:red;"> * </span></label>
                                                                           <input type="email" name="email">
                                                                     </div>
                                                                     <div class="input" style="margin-top:20px;">
                                                                           <label>Password <span style="color:red;"> * </span></label>
                                                                           <input type="password" name="password">
                                                                     </div>
                                                                     <div class="buttons">
                                                                           <button type="submit" name="login">LOGIN</button>
                                                                           <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                                                                           <button><a href="<?php echo BASE_URL;?>authentication/registration.php">CREATE AN ACCOUNT</a></button>
                                                                     </div>
                                                             </form>
                                                       </div>
                                                 </div>
                                                       <span>/</span>
                                                       <p><a href="<?php echo BASE_URL;?>authentication/registration.php" style="text-decoration:none; color:black;">CREATE AN ACCOUNT</a></p>
                                           </div>  
                                     </div>
                                     <div class="icon-currency">
                                           <div class="icons">
                                                  <div class="icon">
                                                        <i class="ri-facebook-fill"></i>
                                                        <div class="facebook"><i class="ri-arrow-drop-up-fill"></i> FACEBOOK </div>
                                                  </div>
                                                  <div class="icon">
                                                        <i class="ri-twitter-fill"></i>
                                                        <div class="facebook"><i class="ri-arrow-drop-up-fill"></i> TWITTER </div>
                                                  </div>   
                                                  <div class="icon">
                                                        <i class="ri-pinterest-fill"></i>
                                                        <div class="facebook"><i class="ri-arrow-drop-up-fill"></i> PINTEREST </div>
                                                  </div>  
                                           </div>
                                           <div class="currency">
                                                 <p>CURRENCY <i class="ri-arrow-down-s-fill"></i></p>
                                                 <div class="currency-dropdown">
                                                       <button>USD</button>
                                                       <button>EUR</button>
                                                       <button>GBP</button>
                                                 </div>
                                           </div>
                                     </div>
                               </div>
                         </div>
                   </div>
                  <!-- Header --- End -->

                   <hr class="header-hr">
                   
                  <!-- Navbar --- Start -->
                  <nav>
                        <div class="nav-container">
                              <div class="nav-content">
                                    <div class="nav-column1">
                                           <img src="<?php echo BASE_URL; ?>assets/images/logo.webp">
                                    </div>
                                    <div class="nav-icons-767px">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" class="Menu" style="cursor:pointer;"><path fill="currentColor" d="M4.5 17.27q-.213 0-.356-.145T4 16.768t.144-.356t.356-.143h15q.213 0 .356.144q.144.144.144.357t-.144.356t-.356.143zm0-4.77q-.213 0-.356-.144T4 11.999t.144-.356t.356-.143h15q.213 0 .356.144t.144.357t-.144.356t-.356.143zm0-4.77q-.213 0-.356-.143Q4 7.443 4 7.23t.144-.356t.356-.143h15q.213 0 .356.144T20 7.23t-.144.356t-.356.144z"/></svg>
                                          <div class="nav-account-767px">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="currentColor" d="M11.5 14c4.14 0 7.5 1.57 7.5 3.5V20H4v-2.5c0-1.93 3.36-3.5 7.5-3.5m6.5 3.5c0-1.38-2.91-2.5-6.5-2.5S5 16.12 5 17.5V19h13zM11.5 5A3.5 3.5 0 0 1 15 8.5a3.5 3.5 0 0 1-3.5 3.5A3.5 3.5 0 0 1 8 8.5A3.5 3.5 0 0 1 11.5 5m0 1A2.5 2.5 0 0 0 9 8.5a2.5 2.5 0 0 0 2.5 2.5A2.5 2.5 0 0 0 14 8.5A2.5 2.5 0 0 0 11.5 6"/></svg>
                                                <div class="nav-account-767px-absolute">
                                                      <a href="<?php echo BASE_URL;?>authentication/login.php">LOGIN</a>
                                                      <a href="<?php echo BASE_URL;?>authentication/registration.php">REGISTER</a>
                                                </div>
                                          </div>
                                          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="currentColor" d="M4.24 12.25a4.2 4.2 0 0 1-1.24-3A4.25 4.25 0 0 1 7.25 5c1.58 0 2.96.86 3.69 2.14h1.12A4.24 4.24 0 0 1 15.75 5A4.25 4.25 0 0 1 20 9.25c0 1.17-.5 2.25-1.24 3L11.5 19.5zm15.22.71C20.41 12 21 10.7 21 9.25A5.25 5.25 0 0 0 15.75 4c-1.75 0-3.3.85-4.25 2.17A5.22 5.22 0 0 0 7.25 4A5.25 5.25 0 0 0 2 9.25c0 1.45.59 2.75 1.54 3.71l7.96 7.96z"/></svg>
                                          <a href="<?php echo BASE_URL; ?>pages/cart.php" style="text-decoration:none; color:#202020;"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="currentColor" d="M6.241 20.682q-.433-.434-.433-1.066t.433-1.067q.434-.433 1.067-.433t1.066.433t.434 1.067t-.434 1.066t-1.066.434t-1.067-.434m9.385 0q-.434-.434-.434-1.066t.434-1.067q.434-.433 1.066-.433t1.067.433q.433.434.433 1.067q0 .632-.433 1.066q-.434.434-1.067.434t-1.066-.434M5.881 5.5l2.669 5.616h6.635q.173 0 .307-.087q.135-.087.231-.24l2.616-4.75q.115-.212.019-.375q-.097-.164-.327-.164zm-.489-1h13.02q.651 0 .98.532q.33.531.035 1.095l-2.858 5.208q-.217.365-.564.573t-.763.208H8.1l-1.215 2.23q-.154.231-.01.5t.433.27h10.384q.214 0 .357.143t.143.357t-.143.356t-.357.144H7.308q-.875 0-1.306-.738t-.021-1.482l1.504-2.68L3.808 3.5H2.5q-.213 0-.357-.143T2 3t.143-.357T2.5 2.5h1.433q.236 0 .429.121q.192.121.298.338zm3.158 6.616h7z"/></svg></a>
                                    </div>
                                    <div class="nav-column2">
                                           <div class="links">
                                                 <div class="home">
                                                       <a href="<?php echo BASE_URL; ?>index.php">HOME <span style="opacity:0;">hi</span></a>
                                                 </div>
                                                 <div class="home">
                                                       <a href="">COLLECTIONS <i class="ri-arrow-drop-down-fill"></i></a>
                                                       <!-- <div class="links-dropdown">
                                                             <p>COLLECTION LINKS</p>
                                                             <div class="a">
                                                                   <a href="">DOLOREM SED</a>
                                                             </div>
                                                             <div class="a">
                                                                   <a href="">PROIDENT NULLA</a>
                                                             </div>
                                                             <div class="a">
                                                                  <div class="absolute">
                                                                   <div class="hot">
                                                                        <img src="<?php echo BASE_URL;  ?>assets/images/bkg_hot.png">
                                                                         <p>Hot</p>
                                                                   </div>
                                                                   </div>
                                                                   <a href="">PHASELLUSEO</a>
                                                             </div>
                                                             <div class="a">
                                                                  <div class="absolute" style="top:-120%; left:45%;">
                                                                   <div class="hot">
                                                                        <img src="<?php echo BASE_URL; ?>assets/images/bkg_featured.png">
                                                                         <p>Featured</p>
                                                                   </div>
                                                                   </div>
                                                                   <a href="">TRISTIQUE AMET</a>
                                                             </div>
                                                       </div> -->

                                                       <div class="links-dropdown" style="display:flex; gap:50px;width:220px;">
                                                            <div class="column1">
                                                             <p>PAGE LAYOUT</p>
                                                             <div class="a">
                                                                   <a href="<?php echo BASE_URL; ?>pages/collection.php">COLLECTIONS</a>
                                                             </div>
                                                            </div>
                                                            
                                                       </div>
                                                       
                                                       
                                                 </div>
                                                 <div class="home">
                                                       <a href="">PAGES <i class="ri-arrow-drop-down-fill"></i></a>
                                                       <div class="links-dropdown" style="display:flex; gap:50px;width:250px;">
                                                            <div class="column1">
                                                             <p>PAGE CONTENT</p>
                                                             <div class="a">
                                                                   <a href="<?php echo BASE_URL; ?>pages/about.php">ABOUT</a>
                                                             </div>
                                                             <div class="a">
                                                                   <a href="<?php echo BASE_URL; ?>pages/pricing.php">PRICE TABLE</a>
                                                             </div>
                                                             <div class="a">
                                                                   <a href="<?php echo BASE_URL; ?>pages/faqs.php">FAQS</a>
                                                             </div>
                                                             <div class="a">
                                                                   <a href="<?php echo BASE_URL; ?>pages/testimonial.php">TESTIMONIAL</a>
                                                             </div>
                                                             <!-- <div class="a">
                                                                  <div class="absolute">
                                                                   <div class="hot">
                                                                        <img src="assets/images/bkg_hot.png">
                                                                         <p>Hot</p>
                                                                   </div>
                                                                   </div>
                                                                   <a href="">PHASELLUSEO</a>
                                                             </div> -->
                                                             <!-- <div class="a">
                                                                  <div class="absolute" style="top:-120%; left:45%;">
                                                                   <div class="hot">
                                                                        <img src="assets/images/bkg_featured.png">
                                                                         <p>Featured</p>
                                                                   </div>
                                                                   </div>
                                                                   <a href="">TRISTIQUE AMET</a>
                                                             </div> -->
                                                            </div>
                                                       </div>
                                                 </div>
                                                 <div class="home" >
                                                       <a href="">BLOG <i class="ri-arrow-drop-down-fill"></i></a>
                                                       <div class="links-dropdown" style="width:120px; padding:12px 20px;">
                                                             <div class="a">
                                                                   <a href="<?php echo BASE_URL;?>pages/blog.php" style="margin:0;">BLOG GRID</a>
                                                             </div>
                                                             <!-- <div class="a">
                                                                  <div class="absolute">
                                                                   <div class="hot">
                                                                        <img src="assets/images/bkg_hot.png">
                                                                         <p>Hot</p>
                                                                   </div>
                                                                   </div>
                                                                   <a href="">PHASELLUSEO</a>
                                                             </div>
                                                             <div class="a">
                                                                  <div class="absolute" style="top:-120%; left:45%;">
                                                                   <div class="hot">
                                                                        <img src="assets/images/bkg_featured.png">
                                                                         <p>Featured</p>
                                                                   </div>
                                                                   </div>
                                                                   <a href="">TRISTIQUE AMET</a>
                                                             </div> -->
                                                       </div>
                                                 </div>
                                                 <div class="home">
                                                       <a href="<?php echo BASE_URL; ?>pages/contact.php">CONTACT</a>
                                                 </div>
                                           </div>
                                           <div class="search-cart">
                                                 <div class="search">
                                                       <i class="ri-search-line"></i>
                                                       <div class="search-absolute">
                                                             <input type="search" placeholder="Search something">
                                                             <button>SEARCH</button>
                                                       </div>
                                                 </div>
                                                 <span>|</span>
                                                 <div class="cart">
                                                       <a href="<?php echo BASE_URL; ?>pages/cart.php"><p>CART <span><?php  echo $_SESSION['count'] ?? 0; ?></span></p></a>
                                                       <?php if(empty($_SESSION['cart'])){ ?>
                                                              <div class="cart-absolute">
                                                                    <p>Your shopping cart is empty..</p>
                                                                    <a href="<?php  BASE_URL; ?>pages/collection.php"><button>CONTINUE SHOPPING</button></a>
                                                              </div>
                                                       <?php } else{ ?>
                                                                 <div class="cart-absolute2">
                                                                        <?php foreach($_SESSION['cart'] as $id => $item){  ?>
                                                                                  <div class="product-details">
                                                                                        <div class="img-content">
                                                                                              <img src="<?php echo BASE_URL; ?>assets/images/<?php echo $item['image'] ?>">
                                                                                              <div class="content">
                                                                                                    <div class="p">
                                                                                                          <p><?php echo $item['name'] ?></p>
                                                                                                    </div>
                                                                                                    <div class="price-remove">
                                                                                                          <div class="price">
                                                                                                                <p>$<?php echo $item['price']  ?></p>
                                                                                                                <p>x</p>
                                                                                                                <p><?php echo $item['qty'] ?></p>
                                                                                                          </div>
                                                                                                          <div class="remove">
                                                                                                                <a href="<?php echo BASE_URL;?>pages/remove.php?id=<?php echo $id ?>"><i class="ri-close-circle-line"></i></a>
                                                                                                          </div>
                                                                                                    </div>
                                                                                                    <div class="subtotal">
                                                                                                          <p>Subtotal</p>
                                                                                                          <p>$<?php echo $subtotal = $item['price'] * $item['qty'] ?>.00</p>
                                                                                                    </div>
                                                                                              </div>
                                                                                        </div>
                                                                                  </div>
                                                                                  <?php } ?>
                                                                                  <div class="total-buttons">
                                                                                        <div class="total">
                                                                                              <p>Total</p>
                                                                                              <p>$<?php echo $header_total += $subtotal ?>.00</p>
                                                                                        </div>
                                                                                        <div class="buttons">
                                                                                              <button><a href="<?php echo BASE_URL;  ?>pages/billing.php">CHECKOUT</a></button>
                                                                                              <button><a href="<?php echo BASE_URL;  ?>pages/cart.php">VIEW CART</a></button>
                                                                                        </div>
                                                                                  </div>
                                                                 </div>
                                                       <?php } ?>
                                                 </div>
                                           </div>
                                    </div>
                                    <div class="search-767px">
                                           <input type="search" placeholder="Search something">
                                           <button><i class="ri-search-line"></i></button>
                                    </div>
                              </div>
                        </div>
                  </nav>
                  <!-- Navbar --- End -->
            </div>
        </section>
       <!-- Header + Navbar End-->
