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
            <p style="color:#A07936;">Price Table</p>
      </div>
</div>
<!-- Breadcrumb --- End -->


<!-- Pricing Section --- Start -->
<section class="pricing-section">
    <div class="pricing-container">
        <div class="pricing-title">
            <h1>PRICE TABLE</h1>
        </div>

        <div class="pricing-row">
            <!-- Starter Plan -->
            <div class="pricing-column">
                <div class="plan-name">Starter</div>
                <div class="price">
                    <h2>$9</h2>
                    <span>/MONTH</span>
                </div>
                <a href="#" class="buy-btn">BUY THIS PACKAGE</a>
                <ul class="features-list">
                    <li>Gravida Est Quis Euismod</li>
                    <li>Maximus Quam Posuere</li>
                    <li>Maximus Quam Posuere</li>
                    <li>Curabitur Cursus Dignis</li>
                    <li class="disabled">Donec Aliquam Ante Non</li>
                    <li class="disabled">Donec Condimentum Fer</li>
                    <li class="disabled">Gravida Est Quis Euismod</li>
                    <li class="disabled">Maximus Quam Posuere</li>
                </ul>
            </div>

            <!-- Regular Plan (Featured) -->
            <div class="pricing-column featured">
                <div class="best-choice">
                    <span>BEST CHOICE</span>
                </div>
                <div class="plan-name">Regular</div>
                <div class="price">
                    <h2>$59</h2>
                    <span>/MONTH</span>
                </div>
                <a href="#" class="buy-btn">BUY THIS PACKAGE</a>
                <ul class="features-list">
                    <li>Gravida Est Quis Euismod</li>
                    <li>Maximus Quam Posuere</li>
                    <li>Maximus Quam Posuere</li>
                    <li>Curabitur Cursus Dignis</li>
                    <li>Donec Aliquam Ante Non</li>
                    <li>Donec Condimentum Fer</li>
                    <li class="disabled">Gravida Est Quis Euismod</li>
                    <li class="disabled">Maximus Quam Posuere</li>
                </ul>
            </div>

            <!-- Premium Plan -->
            <div class="pricing-column">
                <div class="plan-name">Premium</div>
                <div class="price">
                    <h2>$99</h2>
                    <span>/MONTH</span>
                </div>
                <a href="#" class="buy-btn">BUY THIS PACKAGE</a>
                <ul class="features-list">
                    <li>Gravida Est Quis Euismod</li>
                    <li>Maximus Quam Posuere</li>
                    <li>Maximus Quam Posuere</li>
                    <li>Curabitur Cursus Dignis</li>
                    <li>Donec Aliquam Ante Non</li>
                    <li>Donec Condimentum Fer</li>
                    <li>Gravida Est Quis Euismod</li>
                    <li class="disabled">Maximus Quam Posuere</li>
                </ul>
            </div>

            <!-- Ultimate Plan -->
            <div class="pricing-column">
                <div class="plan-name">Ultimate</div>
                <div class="price">
                    <h2>$199</h2>
                    <span>/MONTH</span>
                </div>
                <a href="#" class="buy-btn">BUY THIS PACKAGE</a>
                <ul class="features-list">
                    <li>Gravida Est Quis Euismod</li>
                    <li>Maximus Quam Posuere</li>
                    <li>Maximus Quam Posuere</li>
                    <li>Curabitur Cursus Dignis</li>
                    <li>Donec Aliquam Ante Non</li>
                    <li>Donec Condimentum Fer</li>
                    <li>Gravida Est Quis Euismod</li>
                    <li>Maximus Quam Posuere</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- Pricing Section --- End -->


<!-- Newsletter --- Start -->
<?php require_once __DIR__. '/../includes/newsletter.php'; ?>
<!-- Newsletter --- End -->

<?php require_once __DIR__. '/../includes/footer.php'; ?>
