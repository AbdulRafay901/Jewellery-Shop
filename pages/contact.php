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
            <p style="color:#A07936;">Contact</p>
      </div>
</div>
<!-- Breadcrumb --- End -->

<!-- Contact Section --- Start -->
<section class="contact-section">
    <div class="contact-container">
        <div class="contact-title">
            <h1>CONTACT</h1>
        </div>
        
        <div class="contact-grid">
            <!-- Drop Us A Line -->
            <div class="contact-form-section">
                <h2>DROP US A LINE</h2>
                <form action="" class="contact-form">
                    <div class="form-group">
                        <label for="name">Your Name</label>
                        <input type="text" id="name" name="name" placeholder="Enter your name">
                    </div>
                    <div class="form-group">
                        <label for="email">Your Email <span style="color:red;">*</span></label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Your Message <span style="color:red;">*</span></label>
                        <textarea id="message" name="message" placeholder="Enter your message" required></textarea>
                    </div>
                    <button type="submit" class="submit-btn">SUBMIT CONTACT</button>
                </form>
            </div>

            <!-- Contact Information -->
            <div class="contact-info-section">
                <h2><i class="ri-home-4-line"></i> CONTACT INFORMATION</h2>
                
                <div class="info-item">
                    <h3>OFFICE ADDRESS</h3>
                    <p>249 Ung Van Khiem Street, Binh Thanh Dist, HCM city +84 0123456xxx</p>
                </div>

                <div class="info-item">
                    <p><i class="ri-mail-line"></i> support@gmail.com</p>
                </div>

                <div class="social-section">
                    <h3>FOLLOW US ON</h3>
                    <div class="social-icons">
                        <a href="#"><i class="ri-facebook-fill"></i></a>
                        <a href="#"><i class="ri-twitter-fill"></i></a>
                        <a href="#"><i class="ri-instagram-line"></i></a>
                        <a href="#"><i class="ri-pinterest-fill"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Map Placeholder -->
        <div class="map-placeholder">
            <div class="map-overlay">
                <i class="ri-map-pin-2-fill"></i>
                <p>Map Placeholder</p>
            </div>
        </div>
    </div>
</section>
<!-- Contact Section --- End -->

<!-- Newsletter --- Start -->
<?php require_once __DIR__. '/../includes/newsletter.php'; ?>
<!-- Newsletter --- End -->

<?php require_once __DIR__. '/../includes/footer.php'; ?>
