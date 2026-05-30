

<?php

require_once __DIR__. '/includes/db.php';

if(session_start() === PHP_SESSION_NONE){
      session_start();
}

if(isset($_COOKIE['token'])){
      $cookie_token = $_COOKIE['token'];
      $stmt = $conn->prepare("SELECT * FROM users WHERE cookie_token = ?");
      $stmt->execute([$cookie_token]);

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      if($row){
            $_SESSION['username'] = $row['Name'];
            $_SESSION['Role'] = $row['Role'];
      }
}

$new_products = $conn->prepare("SELECT * FROM products ORDER BY created_at DESC LIMIT 6");
$new_products->execute();
$Product = $new_products->fetchAll(PDO::FETCH_ASSOC);


$stmt = $conn->prepare("SELECT * FROM products WHERE type = ?");
$stmt->execute(["popular"]);

$popular_product = $stmt->fetchAll(PDO::FETCH_ASSOC);

$featured = $conn->prepare("SELECT * FROM products WHERE type = ?");
$featured->execute(["featured"]);

$featured_product = $featured->fetchAll(PDO::FETCH_ASSOC);





?>


<?php
      require_once __DIR__. '/includes/header.php';
?>


<!-- Section --- 1 --- Start -->
<section>
         <div class="S1-container">
            <!-- Swiper -->
             <div class="swiper mySwiper1">
               <div class="swiper-wrapper">
                     <div class="swiper-slide">
                           <div class="S1-slider1">
                                 <div class="img" data-aos="fade">
                                       <div class="overlay">
                                             <div class="content" data-aos="fade-right" data-aos-duration="800" data-aos-delay="300">
                                                   <h1 >Live the moment</h1>
                                                   <img src="assets/images/slide-image-caption-1.webp">
                                                   <div class="p" >
                                                         <p>LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISICING ELIT, SED DO EIUSMOD</p>
                                                   </div>
                                                   <button><a href="">SEE COLLECTION</a></button>
                                             </div>
                                       </div>
                                 </div>
                           </div>
                     </div>
                     <div class="swiper-slide">
                           <div class="S1-slider1 S1-slider2">
                                 <div class="img">
                                       <div class="overlay">
                                             <div class="content">
                                                   <img src="assets/images/slide-image-caption-2.webp">
                                                   <div class="p">
                                                         <p>Love's embrace</p>
                                                   </div>
                                                   <button><a href="">SEE COLLECTION</a></button>
                                             </div>
                                       </div>
                                 </div>
                           </div>
                     </div>
                     <div class="swiper-slide">
                           <div class="S1-slider1 S1-slider3">
                                 <div class="img">
                                       <div class="overlay">
                                             <div class="content">
                                                   <img src="assets/images/slide-image-caption-3.webp">
                                                   <button><a href="">SEE COLLECTION</a></button>
                                             </div>
                                       </div>
                                 </div>
                           </div>
                     </div>
               </div>
                     <div class="swiper-button-next"></div>
                     <div class="swiper-button-prev"></div>
             </div>
         </div>
</section>
<!-- Section --- 1 --- End -->


<!-- Section --- 2 --- Start -->
<section>
          <div class="container-fluid">
                <div class="S2-container">
                      <div class="S2-content">
                            <div class="S2-text" data-aos="fade-up" data-aos-duration="500">
                                  <h1>POPULAR COLLECTIONS</h1>
                                  <img src="assets/images/home_line.png">
                            </div>
                            <div class="row gy-4" data-aos="fade-up" data-aos-duration="500">
                                 <?php  foreach($popular_product as $p){ ?>
                                  <div class="col-lg-3 col-md-6 col-sm-6">
                                         <div class="S2-column1">
                                               <img src="assets/images/<?php echo $p['main_image'] ?>">
                                               <div class="text">
                                                     <p><?php echo $p['name']  ?></p>
                                                     <hr>
                                                     <span>See the Collection</span>
                                               </div>
                                         </div>
                                  </div>
                                  <?php } ?>
                                 
                            </div>
                      </div>
                </div>
          </div>
</section>
<!-- Section --- 2 --- End -->


<!-- Section --- 3 --- Start -->
<section>
          <div class="S3-container">
                <div class="S3-content">
                      <div class="S2-text" data-aos="fade" data-aos-duration="800">
                            <h1 >NEW PRODUCTS</h1>
                            <img src="assets/images/home_line.png">
                      </div>
                      <div class="container-fluid" data-aos="fade" data-aos-duration="800">
                            <div class="row gy-5">
                                  <?php foreach($Product as $new){ ?>

                                  <div class="col-lg-4 col-md-6 col-sm-6">
                                        <div class="S3-column1">
                                              <div class="img-div">
                                                    <div class="img" style="background-image: url('assets/images/<?php echo $new['main_image']; ?>');">
                                                    </div>
                                                    <div class="overlay">
                                                          <div class="sale">
                                                                <p>Sale</p>
                                                          </div>
                                                          <div class="icons">
                                                                <a href="pages/productDetails.php?id=<?php echo $new['id'];?>"><i class="ri-list-check"></i></a>
                                                                <a href=""><i class="ri-eye-line"></i></a>
                                                                <a href=""><i class="ri-heart-line"></i></a>
                                                          </div>
                                                    </div>
                                              </div>
                                              <div class="text-div">
                                                    <div class="text1">
                                                          <p><?php echo $new['name']; ?></p>
                                                    </div>
                                                    <div class="text2">
                                                          <p>$<?php echo $new['new_price']  ?></p>
                                                          <span>$<?php echo $new['old_price']  ?></span>
                                                    </div>
                                              </div>
                                        </div>
                                  </div>

                                 <?php } ?>
                            </div>
                      </div>
                </div>
          </div>
</section>
<!-- Section --- 3 --- End -->


<!-- Section --- 4 --- Start -->
<section>
          <div class="S4-container">
                <div class="S4-content">
                       <img src="assets/images/home_banner_image_text.webp">
                       <div class="text">
                             <p>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                             <hr>
                             <span>Shop Now</span>
                       </div>
                </div>
          </div>
</section>
<!-- Section --- 4 --- End -->

<!-- Section --- 5 --- Start -->
<section>
          <div class="S5-container">
                <div class="S5-content">
                      <div class="S2-text S5-text">
                            <h1>LATEST NEWS</h1>
                            <img src="assets/images/home_line.png">
                      </div>
                      <div class="container-fluid" style="overflow:hidden;">
                            <div class="row gx-4 gy-4">
                                  <div class="col-lg-6" data-aos="fade-right" data-aos-duration="800">
                                        <div class="S5-column1">
                                              <div class="img">
                                                     <div class="overlay">
                                                    
                                                     </div>
                                              </div>
                                        </div>
                                  </div>     
                                  <div class="col-lg-6" data-aos="fade-left" data-aos-duration="800">
                                        <div class="S5-column2">
                                                <div class="div1">
                                                      <div class="calendar">
                                                      <p>JULY</p>
                                                      <span>08</span>
                                                      </div>
                                                      <div class="texts">
                                                       <div class="text1">
                                                             <h4>Sample Blog Post With Left Slidebar</h4>
                                                             <div class="icon-p">
                                                                   <p><i class="ri-user-3-fill"></i>  Jin Alkaid</p>
                                                                   <p>/</p>
                                                                   <p><i class="ri-file-edit-line"></i> 58 Comments</p>
                                                             </div>
                                                       </div>
                                                       <div class="text2">
                                                             <p>Shoe street style leather tote oversized sweatshirt A.P.C. Prada Saffiano crop slipper denim shorts spearmint....</p>
                                                       </div>
                                                      </div>
                                                </div>
                                                <div class="div1">
                                                      <div class="calendar">
                                                      <p>JUNE</p>
                                                      <span>30</span>
                                                      </div>
                                                      <div class="texts">
                                                       <div class="text1">
                                                             <h4>Vel Lllum Qui Dolorem Eum Fugiat</h4>
                                                             <div class="icon-p">
                                                                   <p><i class="ri-user-3-fill"></i>  Jin Alkaid</p>
                                                                   <p>/</p>
                                                                   <p><i class="ri-file-edit-line"></i> 4 Comments</p>
                                                             </div>
                                                       </div>
                                                       <div class="text2">
                                                             <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem...</p>
                                                       </div>
                                                      </div>
                                                </div>
                                                <div class="div1">
                                                      <div class="calendar">
                                                      <p>JULY</p>
                                                      <span>30</span>
                                                      </div>
                                                      <div class="texts">
                                                       <div class="text1">
                                                             <h4>Sample Blog Post Full Width</h4>
                                                             <div class="icon-p">
                                                                   <p><i class="ri-user-3-fill"></i>  Jin Alkaid</p>
                                                                   <p>/</p>
                                                                   <p><i class="ri-file-edit-line"></i> 149 Comments</p>
                                                             </div>
                                                       </div>
                                                       <div class="text2">
                                                             <p>Shoe street style leather tote oversized sweatshirt A.P.C. Prada Saffiano crop slipper denim shorts spearmint....</p>
                                                       </div>
                                                      </div>
                                                </div>
                                        </div>
                                  </div>
                            </div>
                      </div>
                </div>
          </div>
</section>
<!-- Section --- 5 --- End -->


<!-- Section --- 6 --- Start -->
<section>
          <div class="S6-container">
                <div class="S6-content">
                       <div class="S2-text" data-aos="fade" data-aos-duration="800">
                              <h1>FEATURED PRODUCTS</h1>
                              <img src="assets/images/home_line.png">
                        </div>
                        <div class="S6-swiperSlider" data-aos="fade" data-aos-duration="800">
                               <div class="swiper mySwiper6">
                                    <div class="swiper-wrapper">
                                          <?php foreach($featured_product as $f){ ?>
                                          <div class="swiper-slide">
                                               <div class="S3-column1 S6-column1">
                                                      <div class="img-div">
                                                    <div class="img" style="background-image: url('assets/images/<?php echo $f['main_image']; ?>');">
                                                           
                                                    </div>
                                                    <div class="overlay">
                                                          <div class="sale">
                                                                <p>Sale</p>
                                                          </div>
                                                          <div class="icons">
                                                                <a href="pages/productDetails.php?id=<?php echo $f['id'];?>"><i class="ri-list-check"></i></a>
                                                                <a href=""><i class="ri-eye-line"></i></a>
                                                                <a href=""><i class="ri-heart-line"></i></a>
                                                          </div>
                                                    </div>
                                                      </div>
                                                      <div class="text-div">
                                                    <div class="text1">
                                                          <p><?php echo $f['name'] ?></p>
                                                    </div>
                                                    <div class="text2">
                                                          <p>$<?php echo $f['new_price'] ?></p>
                                                          <span>$<?php echo $f['old_price'] ?></span>
                                                    </div>
                                                      </div>
                                                </div>
                                          </div>
                                          <?php  }  ?>
                                          
                                    </div>
                                          <!-- <div class="swiper-pagination"></div> -->
                                           <div class="swiper-button-next"></div>
                                           <div class="swiper-button-prev"></div>
                               </div>
                        </div>
                </div>
          </div>
</section>
<!-- Section --- 6 --- End -->

<!-- Section --- 7 --- Start -->
<section>
         <div class="S7-container">
              <div class="S7-content">
                    <div class="S2-text">
                          <h1>POPULAR BRANDS</h1>
                          <img src="assets/images/home_line.png">
                    </div>
                    <div class="S7-swiperSlider">
                          <div class="swiper mySwiper7">
                              
                               <div class="swiper-wrapper">
                                     <div class="swiper-slide">
                                           <div class="S7-slider1">
                                                 <img src="assets/images/partners_logo_1.webp">
                                           </div>
                                     </div>
                                     <div class="swiper-slide">
                                           <div class="S7-slider1">
                                                 <img src="assets/images/partners_logo_2.webp">
                                           </div>
                                     </div>
                                     <div class="swiper-slide">
                                           <div class="S7-slider1">
                                                 <img src="assets/images/partners_logo_3.png">
                                           </div>
                                     </div>
                                     <div class="swiper-slide">
                                           <div class="S7-slider1">
                                                 <img src="assets/images/partners_logo_4.webp">
                                           </div>
                                     </div>
                                     <div class="swiper-slide">
                                           <div class="S7-slider1">
                                                 <img src="assets/images/partners_logo_5.webp">
                                           </div>
                                     </div>
                                     <div class="swiper-slide">
                                           <div class="S7-slider1">
                                                 <img src="assets/images/partners_logo_6.png">
                                           </div>
                                     </div>
                                     <div class="swiper-slide">
                                           <div class="S7-slider1">
                                                 <img src="assets/images/partners_logo_1.webp">
                                           </div>
                                     </div>
                               </div>
                                    
                          </div>
                    </div>
              </div>
         </div>
</section>
<!-- Section --- 7 --- End -->


<!-- Section --- 8 --- Start -->
<?php require_once __DIR__. '/includes/newsletter.php'  ?>
<!-- Section --- 8 --- End -->


<?php

require_once __DIR__. '/includes/footer.php';

?>

