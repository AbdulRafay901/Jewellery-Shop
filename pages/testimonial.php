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
            <p style="color:#A07936;">Testimonials</p>
      </div>
</div>
<!-- Breadcrumb --- End -->

<!-- Testimonial Section --- Start -->
<section class="testimonial-section">
    <div class="testimonial-container">
        <div class="testimonial-title">
            <h1>TESTIMONIALS</h1>
        </div>
        
        <div class="testimonial-grid">
            <!-- Testimonial 1 -->
            <div class="testimonial-item">
                <div class="testimonial-header">
                    <div class="testimonial-avatar">
                        <img src="../assets/images/avatar-1.jpg" alt="User Avatar">
                    </div>
                    <div class="testimonial-info">
                        <div class="stars">
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                        </div>
                        <h3>Exactly what I needed to be.</h3>
                    </div>
                </div>
                <div class="testimonial-content">
                    <p>Transform indicator overcome injustice pursue these aspirations natural resources. Maintain, social analysis Bloomberg; accelerate planned giving. Revitalize economic independence, foundation sharing economy, rights-based approach medical supplies eradicate celebrate informal economies. International medicine social worker participatory monitoring Bill and Melinda Gates our ambitions justice relief transform the world.</p>
                </div>
                <div class="testimonial-footer">
                    <h4>JOHN SMITH</h4>
                    <p>Facebook</p>
                </div>
            </div>

            <!-- Testimonial 2 -->
            <div class="testimonial-item">
                <div class="testimonial-header">
                    <div class="testimonial-avatar">
                        <img src="../assets/images/image2.webp" alt="User Avatar">
                    </div>
                    <div class="testimonial-info">
                        <div class="stars">
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-half-fill"></i>
                        </div>
                        <h3>Beautiful Brutal and Yet Still Visceral.</h3>
                    </div>
                </div>
                <div class="testimonial-content">
                    <p>Transform indicator overcome injustice pursue these aspirations natural resources. Maintain, social analysis Bloomberg; accelerate planned giving. Revitalize economic independence, foundation sharing economy, rights-based approach medical supplies eradicate celebrate informal economies. International medicine social worker participatory monitoring Bill and Melinda Gates our ambitions justice relief transform the world.</p>
                </div>
                <div class="testimonial-footer">
                    <h4>JOHN SMITH</h4>
                    <p>Twitter</p>
                </div>
            </div>

            <!-- Testimonial 3 -->
            <div class="testimonial-item">
                <div class="testimonial-header">
                    <div class="testimonial-avatar">
                        <img src="../assets/images/image3.webp" alt="User Avatar">
                    </div>
                    <div class="testimonial-info">
                        <div class="stars">
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-line"></i>
                        </div>
                        <h3>What a Lovely Day!</h3>
                    </div>
                </div>
                <div class="testimonial-content">
                    <p>Transform indicator overcome injustice pursue these aspirations natural resources. Maintain, social analysis Bloomberg; accelerate planned giving. Revitalize economic independence, foundation sharing economy, rights-based approach medical supplies eradicate celebrate informal economies. International medicine social worker participatory monitoring Bill and Melinda Gates our ambitions justice relief transform the world.</p>
                </div>
                <div class="testimonial-footer">
                    <h4>JOHN SMITH</h4>
                    <p>Pinterest</p>
                </div>
            </div>

            <!-- Testimonial 4 -->
            <div class="testimonial-item">
                <div class="testimonial-header">
                    <div class="testimonial-avatar">
                        <img src="../assets/images/image4.webp" alt="User Avatar">
                    </div>
                    <div class="testimonial-info">
                        <div class="stars">
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-line"></i>
                        </div>
                        <h3>Hold onto your seats for a visual and visceral masterpiece.</h3>
                    </div>
                </div>
                <div class="testimonial-content">
                    <p>Transform indicator overcome injustice pursue these aspirations natural resources. Maintain, social analysis Bloomberg; accelerate planned giving. Revitalize economic independence, foundation sharing economy, rights-based approach medical supplies eradicate celebrate informal economies. International medicine social worker participatory monitoring Bill and Melinda Gates our ambitions justice relief transform the world.</p>
                </div>
                <div class="testimonial-footer">
                    <h4>JOHN SMITH</h4>
                    <p>Facebook</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Testimonial Section --- End -->

<!-- Newsletter --- Start -->
<?php require_once __DIR__. '/../includes/newsletter.php'; ?>
<!-- Newsletter --- End -->

<?php require_once __DIR__. '/../includes/footer.php'; ?>
