<?php
require_once __DIR__. '/../includes/db.php';

if(session_start() === PHP_SESSION_NONE){
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
            <p style="color:#A07936;">About Us</p>
      </div>
</div>
<!-- Breadcrumb --- End -->

<!-- About Section --- Start -->
<section class="about-section">
    <div class="about-container">
        <div class="about-title">
            <h1>ABOUT US</h1>
        </div>
        
        <div class="about-image">
            <img src="../assets/images/banner.webp" alt="About Us Banner">
        </div>

        <div class="about-content">
            <p>The About Us page of your shop is vital because it's where users go when first trying to determine a level of trust. Since trust is such an important part of selling online, it's a good idea to give people a fair amount of information about yourself and your shop. Here are a few things you should touch on:</p>
            
            <ul class="about-list">
                <li><i class="ri-check-line"></i> Who you are</li>
                <li><i class="ri-check-line"></i> Why you sell the items you sell</li>
                <li><i class="ri-check-line"></i> Where you are located</li>
                <li><i class="ri-check-line"></i> How long you have been in business</li>
                <li><i class="ri-check-line"></i> How long you have been running your online shop</li>
                <li><i class="ri-check-line"></i> Who are the people on your team</li>
                <li><i class="ri-check-line"></i> Contact information</li>
                <li><i class="ri-check-line"></i> Social links (Twitter, Facebook)</li>
            </ul>

            <p>To edit the content on this page, go to the Pages section of your Shopify admin.</p>

            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur ut labore et dolore magnam aliquam quaerat voluptatem.</p>

            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur</p>
        </div>
    </div>
</section>
<!-- About Section --- End -->


<!-- Newsletter --- Start -->
<?php require_once __DIR__. '/../includes/newsletter.php'; ?>
<!-- Newsletter --- End -->

<?php require_once __DIR__. '/../includes/footer.php'; ?>
