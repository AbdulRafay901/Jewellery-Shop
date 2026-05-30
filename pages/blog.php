<?php
require_once __DIR__. '/../includes/db.php';

if(session_status() === PHP_SESSION_NONE){
      session_start();
}

require_once __DIR__. '/../includes/header.php'; 
?>

<style>
    .header-nav {
        position: static;
        background-color: #F7F7F7;
    }
    body {
        background-color: #F7F7F7;
    }
    .search-767px input {       
        background-color: #F7F7F7;
    }
</style>

<!-- Breadcrumb --- Start -->
<div class="PD-S1-container">
      <div class="PD-S1-content">
            <p><a href="../index.php" style="text-decoration: none; color: inherit;">Home</a></p>
            <p>/</p>
            <p style="color:#A07936;">Blog</p>
      </div>
</div>
<!-- Breadcrumb --- End -->

<!-- Blog Section --- Start -->
<section class="blog-section">
    <div class="blog-container">
        <div class="blog-title">
            <h1>BLOG</h1>
        </div>
        
        <div class="blog-grid">
            <!-- Blog Card 1 -->
            <div class="blog-card">
                <div class="blog-date">
                    <span class="month">JUNE</span>
                    <span class="day">30</span>
                </div>
                <div class="blog-header">
                    <h2 class="blog-card-title">Vel Illum Qui Dolorem</h2>
                </div>
                <div class="blog-image">
                    <img src="../assets/images/image2_4eaf121b-5673-4e0a-a5bd-7c6d017d7907.webp" alt="Blog Image 1">
                </div>
                <div class="blog-excerpt">
                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia dolore consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae...</p>
                </div>
                <div class="blog-footer">
                    <div class="blog-meta">
                        <span class="author">JIN ALKAID</span>
                        <span class="separator">/</span>
                        <span class="comments">5 COMMENT(S)</span>
                    </div>
                    <button class="post-comment-btn">POST COMMENT</button>
                </div>
            </div>

            <!-- Blog Card 2 -->
            <div class="blog-card">
                <div class="blog-date">
                    <span class="month">JUNE</span>
                    <span class="day">30</span>
                </div>
                <div class="blog-header">
                    <h2 class="blog-card-title">Enim Ipsam Voluptatem</h2>
                </div>
                <div class="blog-image">
                    <img src="../assets/images/img_blog1.webp" alt="Blog Image 2">
                </div>
                <div class="blog-excerpt">
                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia dolore consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae...</p>
                </div>
                <div class="blog-footer">
                    <div class="blog-meta">
                        <span class="author">JIN ALKAID</span>
                        <span class="separator">/</span>
                        <span class="comments">0 COMMENT(S)</span>
                    </div>
                    <button class="post-comment-btn">POST COMMENT</button>
                </div>
            </div>

            <!-- Blog Card 3 -->
            <div class="blog-card">
                <div class="blog-date">
                    <span class="month">JUNE</span>
                    <span class="day">30</span>
                </div>
                <div class="blog-header">
                    <h2 class="blog-card-title">Luxe Gold Collar</h2>
                </div>
                <div class="blog-image">
                    <img src="../assets/images/img_blog1_95b0dca7-a981-43fb-bef7-6a6dcba5f6ec.webp" alt="Blog Image 3">
                </div>
                <div class="blog-excerpt">
                    <p>Shoe street style leather tote oversized sweatshirt A.P.C. Prada Saffiano crop slipper denim shorts spearmint. Braid skirt round sunglasses seam leather vintage Levi plaited. Flats holographic Acne grunge collarless denim chunky sole cuff tucked t-shirt strong eyebrows. Clutch center part dress dungaree slip dress. Skinny jeans knitwear minimal tortoise-shell sunglasses Céline sandal Cara D. lilac. Black floral 90s oxford chambray bomber powder blue cotton boots print. Cable knit knot ponytail ribbed sneaker sports luxe pastel Paris. Washed out skort white shirt Hermès vintage Givenchy razor pleats. Tee loafer knot ponytail sandal shoe oversized sweatshirt Maison Martin Margiela chunky sole spearmint...</p>
                </div>
                <div class="blog-footer">
                    <div class="blog-meta">
                        <span class="author">JIN ALKAID</span>
                        <span class="separator">/</span>
                        <span class="comments">0 COMMENT(S)</span>
                    </div>
                    <button class="post-comment-btn">POST COMMENT</button>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Section --- End -->

<!-- Newsletter --- Start -->
<?php require_once __DIR__. '/../includes/newsletter.php'; ?>
<!-- Newsletter --- End -->

<?php require_once __DIR__. '/../includes/footer.php'; ?>
