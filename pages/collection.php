<?php
require_once __DIR__. '/../includes/header.php';
require_once __DIR__. '/../includes/db.php';

$stmt = $conn->prepare("SELECT * FROM products");
$stmt->execute();
$all = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<style>
    
    .header-nav { position: static; background-color: #F7F7F7; }
    body {
          background-color: #F7F7F7;
        }
        .search-767px input {       
           background-color: #F7F7F7;
    }
    
</style>

<!-- Section 1 -->
<div class="PD-S1-container">
    <div class="PD-S1-content">
        <p>Home</p>
        <p>/</p>
        <p style="color:#A07936;">Collection</p>
    </div>
</div>

<!-- Collection --- Section --- 2 --- Filters   Start-->
<section>
    <div class="Collection-S2-container" style="background-color: #F7F7F7;">
        <div class="Collection-S2-content">
            <div class="filter-sort">
                <div class="filter">
                    <div class="text"><p>Filter by</p></div>
                    <div class="price-category">

                        <!-- Price Filter -->
                        <div class="price">
                            <p class="collection-price" style="cursor:pointer;">Price</p>
                            <i class="ri-arrow-down-s-line collection-price"></i>
                            <div class="price-dropdown">
                                <div class="text-btn">
                                    <div class="text">
                                        <p>The highest price is $299.00</p>
                                        <p style="margin-top:5px;">Default input value is USD</p>
                                    </div>
                                    <button onclick="resetFilters()">Reset</button>
                                </div>
                                <hr>
                                <div class="inputs">
                                    <div class="from">
                                        <p>$</p>
                                        <input type="number" placeholder="From" id="from">
                                    </div>
                                    <div class="from">
                                        <p>$</p>
                                        <input type="number" placeholder="To" id="to">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Category Filter -->
                        <div class="price">
                            <p class="collection-price" style="cursor:pointer;">Category</p>
                            <i class="ri-arrow-down-s-line collection-price"></i>
                            <div class="price-dropdown category-dropdown">
                                <div class="text-btn">
                                    <div class="text"><p>0 Selected</p></div>
                                    <button onclick="resetCheckbox()">Reset</button>
                                </div>
                                <hr>
                                <div class="inputs">
                                    <div class="from">
                                        <input type="checkbox" value="Ring"> <p>Rings</p>
                                    </div>
                                    <div class="from">
                                        <input type="checkbox" value="Necklaces"> <p>Necklaces</p>
                                    </div>
                                    <div class="from">
                                        <input type="checkbox" value="Earrings"> <p>Earings</p>
                                    </div>
                                    <div class="from">
                                        <input type="checkbox" value="Braclet"> <p>Braclet</p>
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

<!-- Collection --- Section --- 2 --- Filters   End-->

<!-- Collection --- Section --- 3 --- Products   Start-->
<section>
    <div class="Collection-S3-container" style="background-color: #F7F7F7;">
        <div class="Collection-S3-content">
            <div class="container-fluid p-0">
                <div class="row gy-5" id="products-container">
                    <?php foreach($all as $p): ?>
                        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                            <div class="swiper-slide">
                                <div class="S3-column1 S6-column1 collection-S3-column1">
                                    <div class="img-div">
                                        <div class="img" style="background-image: url('../assets/images/<?= $p['main_image'] ?>');"></div>
                                        <div class="overlay">
                                            <div class="sale"><p>Sale</p></div>
                                            <div class="icons">
                                                <a href="productDetails.php?id=<?= $p['id'] ?>"><i class="ri-list-check"></i></a>
                                                <a href=""><i class="ri-eye-line"></i></a>
                                                <a href=""><i class="ri-heart-line"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-div">
                                        <div class="text1"><p><?= $p['name'] ?></p></div>
                                        <div class="text2">
                                            <p>$<?= $p['new_price'] ?></p>
                                            <span>$<?= $p['old_price'] ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Collection --- Section --- 3 --- Products   End-->


<!-- NewsLetter  -- Section --- Start -->
   <?php require_once __DIR__. '/../includes/newsletter.php'?>
<!-- NewsLetter  -- Section --- End  --> 





<?php require_once __DIR__. '/../includes/footer.php'; ?>