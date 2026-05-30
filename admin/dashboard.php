
<?php

require_once __DIR__. '/../includes/db.php';

session_start();

require_once __DIR__. '/auth_check.php';


$total_earning = $conn->prepare("SELECT SUM(total_amount) FROM orders WHERE status = ? ");
$total_earning->execute(["complete"]);

$earning = $total_earning->fetchColumn();

$total_order = $conn->prepare("SELECT COUNT(*) FROM orders");
$total_order->execute();

$orders = $total_order->fetchColumn();

$total_users = $conn->prepare("SELECT COUNT(*) FROM users");
$total_users->execute();

$users = $total_users->fetchColumn();

$new = $conn->prepare("SELECT * FROM orders ORDER BY ? DESC LIMIT 5");
$new->execute(['create_at']);

$recentOrders = $new->fetchAll(PDO::FETCH_ASSOC);


$top = $conn->prepare("SELECT COUNT(product_id) as count, products.main_image, products.name, products.new_price FROM order_items JOIN products ON order_items.product_id = products.id GROUP BY product_id ORDER BY COUNT(product_id) DESC LIMIT 5");
$top->execute();

$top_sales = $top->fetchAll(PDO::FETCH_ASSOC);






?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Remix icon Cdn  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.css" integrity="sha512-kJlvECunwXftkPwyvHbclArO8wszgBGisiLeuDFwNM8ws+wKIw0sv1os3ClWZOcrEB2eRXULYUsm8OVRGJKwGA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     
    <!-- Font Awesome Cdn -->
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Link Swiper's CSS -->
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />    

    <!-- Bootstrap Cdn Link -->
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <link rel="stylesheet" href="../assets/css/admin.css">

    <style>
            .dashboard-ipi{
               background-color: #A07936;
            }
            .dashboard-ip,
            .dashboard-ip a{
               color:white !important;
            }
    </style>
   

</head>
<body>

      <div class="sidebar-content">
            <?php require_once __DIR__. '/includes/sidebar.php'; ?>
            <div class="content">
                   <?php require_once __DIR__. '/includes/header.php'; ?>
                    <div class="dashboard-wrapper p-4">
                        <!-- Stats Cards Section -->
                        <div class="row g-4 mb-4">
                            <!-- Total Earnings -->
                            <div class="col-xl-6 col-md-6">
                                <div class="dash-card card-earnings p-4">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="icon-box bg-success-light">
                                                <i class="ri-wallet-line text-success fs-4"></i>
                                            </div>
                                            <div>
                                                <p class="text-muted small mb-0">Total Earnings</p>
                                                <h4 class="mb-0 fw-bold">$<?php echo $earning;?></h4>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <span class="text-success small fw-bold"><i class="ri-arrow-right-up-line"></i> 1.56%</span>
                                            <p class="text-muted tiny mb-0">Weekly <i class="ri-arrow-down-s-line"></i></p>
                                        </div>
                                    </div>
                                    <div class="sparkline-container mt-2">
                                        <div class="myChart"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Orders -->
                            <div class="col-xl-6 col-md-6">
                                <div class="dash-card card-orders p-4">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="icon-box bg-warning-light">
                                                <i class="ri-shopping-cart-2-line text-warning fs-4"></i>
                                            </div>
                                            <div>
                                                <p class="text-muted small mb-0">Total Orders</p>
                                                <h4 class="mb-0 fw-bold"><?php echo $orders; ?></h4>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <span class="text-danger small fw-bold"><i class="ri-arrow-right-down-line"></i> 1.56%</span>
                                            <p class="text-muted tiny mb-0">Monthly <i class="ri-arrow-down-s-line"></i></p>
                                        </div>
                                    </div>
                                    <div class="sparkline-container mt-2">
                                           <div class="myChart2"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Customers -->
                            <div class="col-xl-6 col-md-6">
                                <div class="dash-card card-customers p-4">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="icon-box bg-primary-light">
                                                <i class="ri-user-heart-line text-primary fs-4"></i>
                                            </div>
                                            <div>
                                                <p class="text-muted small mb-0">Customers</p>
                                                <h4 class="mb-0 fw-bold"><?php echo $users;?></h4>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <span class="text-primary small fw-bold"><i class="ri-arrow-right-up-line"></i> 1.66%</span>
                                            <p class="text-muted tiny mb-0">Yearly <i class="ri-arrow-down-s-line"></i></p>
                                        </div>
                                    </div>
                                    <div class="sparkline-container mt-2">
                                        <div class="myChart3"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- My Balance -->
                            <div class="col-xl-6 col-md-6">
                                <div class="dash-card card-balance p-4">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="icon-box bg-info-light">
                                                <i class="ri-bank-card-line text-info fs-4"></i>
                                            </div>
                                            <div>
                                                <p class="text-muted small mb-0">My Balance</p>
                                                <h4 class="mb-0 fw-bold">$4,945</h4>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <span class="text-info small fw-bold"><i class="ri-arrow-right-up-line"></i> 1.56%</span>
                                            <p class="text-muted tiny mb-0">Yearly <i class="ri-arrow-down-s-line"></i></p>
                                        </div>
                                    </div>
                                    <div class="sparkline-container mt-2">
                                        <div class="myChart4"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Revenue Chart Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="dash-card p-4">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h5 class="fw-bold mb-0">Revenue</h5>
                                        <div class="dropdown">
                                            <button class="btn btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                Yearly
                                            </button>
                                        </div>
                                    </div>
                                    <div class="chart-legend d-flex flex-wrap gap-4 mb-4">
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="dot bg-warning"></span>
                                            <div>
                                                <span class="small fw-bold">Revenue</span>
                                                <div class="d-flex align-items-center gap-2">
                                                    <span class="fs-6 fw-bold">$37,802</span>
                                                    <span class="text-success small"><i class="ri-arrow-right-up-line"></i> 0.56%</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="dot bg-primary"></span>
                                            <div>
                                                <span class="small fw-bold">Order</span>
                                                <div class="d-flex align-items-center gap-2">
                                                    <span class="fs-6 fw-bold">$28,305</span>
                                                    <span class="text-success small"><i class="ri-arrow-right-up-line"></i> 0.56%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="revenue-chart-placeholder" style="height: 300px; position: relative;">
                                        <!-- Grid Lines Background -->
                                        <div class="revenue-grid-lines d-flex flex-column justify-content-between pb-5" style="position: absolute; top:0; left:0; width:100%; height:100%;">
                                            <div class="border-top" style="opacity: 0.1;"></div>
                                            <div class="border-top" style="opacity: 0.1;"></div>
                                            <div class="border-top" style="opacity: 0.1;"></div>
                                            <div class="border-top" style="opacity: 0.1;"></div>
                                            <div class="border-top" style="opacity: 0.1;"></div>
                                            <div class="border-top" style="opacity: 0.1;"></div>
                                        </div>
                                        
                                        <!-- Mock Bar Chart -->
                                        <div class="d-flex justify-content-between align-items-end h-100 px-2 pb-5 border-bottom" style="position: relative; z-index: 1;">
                                            <div class="bg-warning rounded-top" style="height: 42%; width: 20px;"></div>
                                            <div class="bg-warning rounded-top" style="height: 32%; width: 20px;"></div>
                                            <div class="bg-warning rounded-top" style="height: 55%; width: 20px;"></div>
                                            <div class="bg-warning rounded-top" style="height: 48%; width: 20px;"></div>
                                            <div class="bg-warning rounded-top" style="height: 38%; width: 20px;"></div>
                                            <div class="bg-warning rounded-top" style="height: 88%; width: 20px;"></div>
                                            <div class="bg-warning rounded-top" style="height: 75%; width: 20px;"></div>
                                            <div class="bg-warning rounded-top" style="height: 58%; width: 20px;"></div>
                                            <div class="bg-warning rounded-top" style="height: 48%; width: 20px;"></div>
                                            <div class="bg-warning rounded-top" style="height: 78%; width: 20px;"></div>
                                            <div class="bg-warning rounded-top" style="height: 82%; width: 20px;"></div>
                                            <div class="bg-warning rounded-top" style="height: 92%; width: 20px;"></div>
                                        </div>
                                        <!-- Mock Line Overlay -->
                                        <svg class="line-overlay position-absolute top-0 start-0 w-100 h-100" viewBox="0 0 1200 300" preserveAspectRatio="none" style="z-index: 2; pointer-events: none;">
                                            <path d="M50 220 C 150 210, 200 240, 250 230 C 350 200, 400 210, 450 190 C 550 210, 600 220, 650 210 C 750 180, 800 190, 850 180 C 1000 200, 1100 210, 1150 200" fill="none" stroke="#A07936" stroke-width="3"></path>
                                        </svg>
                                        <div class="month-labels d-flex justify-content-between text-muted small mt-2 px-2">
                                            <span>Jan</span><span>Feb</span><span>Mar</span><span>Apr</span><span>May</span><span>Jun</span>
                                            <span>Jul</span><span>Aug</span><span>Sep</span><span>Oct</span><span>Nov</span><span>Dec</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Promotional & Top Sale Section -->
                        <div class="row g-4 mb-4">
                            <!-- Promotional Sales -->
                            <div class="col-lg-6">
                                <div class="dash-card p-4">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h5 class="fw-bold mb-0">Promotional Sales</h5>
                                        <div class="dropdown">
                                            <button class="btn btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                Weekly
                                            </button>
                                        </div>
                                    </div>
                                    <p class="text-muted small mb-1">Visitors</p>
                                    <h5 class="fw-bold fs-4">7,802 <span class="text-success small fw-normal ms-2"><i class="ri-arrow-right-up-line"></i> 0.56%</span></h5>
                                    
                                    <div class="donut-container d-flex align-items-center justify-content-center my-4" style="height: 200px;">
                                        <div class="donut-placeholder" style="width: 150px; height: 150px; border-radius: 50%; border: 20px solid #f8f9fa; border-top-color: #A07936; border-right-color: #0EA5E9; border-bottom-color: #22C55E; position: relative;">
                                            <div class="center-text position-absolute top-50 start-50 translate-middle text-center" style="transform: translate(-50%, -50%) !important;">
                                                <small class="text-muted d-block tiny">Social Media</small>
                                                <span class="fw-bold">3,432</span>
                                                <small class="text-success d-block tiny"><i class="ri-arrow-right-up-line"></i> 5.6%</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-center gap-3">
                                        <div class="d-flex align-items-center gap-1 small"><span class="dot bg-primary"></span> Social Media</div>
                                        <div class="d-flex align-items-center gap-1 small"><span class="dot bg-info"></span> Website</div>
                                        <div class="d-flex align-items-center gap-1 small"><span class="dot bg-warning"></span> Store</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Top Sale -->
                            <div class="col-lg-6">
                                <div class="dash-card p-4">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h5 class="fw-bold mb-0">Top sale</h5>
                                        <div class="dropdown">
                                            <button class="btn btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                Weekly
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <div class="top-sale-list">
                                        <?php 
                                        
                                        foreach($top_sales as $sale):
                                        ?>
                                        <div class="sale-item d-flex align-items-center justify-content-between mb-3 last-child-mb-0">
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="../assets/images/<?php echo $sale['main_image']; ?>" class="rounded" style="width: 45px; height: 45px; object-fit: cover;">
                                                <div>
                                                    <p class="mb-0 small fw-bold"><?php echo $sale['name']; ?></p>
                                                    <p class="mb-0 tiny text-muted"><?php echo $sale['new_price']; ?></p>
                                                </div>
                                            </div>
                                            <p class="mb-0 small fw-bold"><?php echo $sale['count'] ?></p>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Orders & User Location Section -->
                        <div class="row g-4">
                            <!-- Recent Orders -->
                            <div class="col-lg-8">
                                <div class="dash-card p-4">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h5 class="fw-bold mb-0">Recent Orders</h5>
                                        <a href="#" class="text-muted small text-decoration-none">View All</a>
                                    </div>
                                    <div class="table-responsive" style="overflow-x: auto;">
                                        <table class="table table-borderless align-middle" style="min-width: 600px;">
                                            <thead class="text-muted tiny text-uppercase fw-bold" style="font-size: 0.70rem; letter-spacing: 0.05em;">
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Customer Name</th>
                                                    <th>Product ID</th>
                                                    <th>Price</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody style="font-size: 0.85rem;">
                                                <?php 
                                            
                                                foreach($recentOrders as $order):
                                                    
                                                ?>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center gap-2">
                                                            <p><?php echo $order['order_number']; ?></p>
                                                            <!-- <span class="fw-bold"><?php echo $order['first_name']; ?></span> -->
                                                        </div>
                                                    </td>
                                                    <td><?php echo $order['first_name']; ?></td>
                                                    <td class="text-muted"><?php echo $order['order_number']; ?></td>
                                                    <td class="fw-bold">$<?php echo $order['total_amount']; ?></td>
                                                    <td><div id="d-status"><p id="d-text"><?php echo $order['status'] ?></p></div></td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- Pagination -->
                                    <div class="d-flex justify-content-between align-items-center mt-4">
                                        <p class="text-muted tiny mb-0">Showing 1-5 of 15</p>
                                        <div class="d-flex gap-2">
                                            <button class="btn btn-sm btn-light tiny p-2"><i class="ri-arrow-left-s-line"></i></button>
                                            <button class="btn btn-sm btn-light tiny px-2">1</button>
                                            <button class="btn btn-sm btn-primary text-white tiny px-2" style="background:#A07936; border-color:#A07936;">2</button>
                                            <button class="btn btn-sm btn-light tiny px-2">3</button>
                                            <button class="btn btn-sm btn-light tiny p-2"><i class="ri-arrow-right-s-line"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- User Location -->
                            <div class="col-lg-4">
                                <div class="dash-card p-4">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h5 class="fw-bold mb-0">User Location</h5>
                                        <div class="dropdown">
                                            <button class="btn btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                USA
                                            </button>
                                        </div>
                                    </div>
                                    <div class="map-container mb-4 d-flex align-items-center justify-content-center" style="height: 200px; background: #f8fafc; border-radius: 12px; position: relative;">
                                        <!-- Mock Map SVG with highlighted states -->
                                        <svg viewBox="0 0 300 150" style="width: 100%; height: 100%;">
                                            <path d="M50 30 L80 30 L90 50 L70 70 L40 60 Z" fill="#e2e8f0" stroke="#cbd5e1" />
                                            <path d="M100 40 L130 35 L140 55 L120 70 L95 60 Z" fill="#e2e8f0" stroke="#cbd5e1" />
                                            <path d="M20 50 L50 60 L45 90 L15 85 Z" fill="#f97316" stroke="#ea580c" /> <!-- California -->
                                            <path d="M60 65 L90 70 L85 95 L55 90 Z" fill="#8b5cf6" stroke="#7c3aed" /> <!-- Arizona -->
                                            <path d="M110 80 L140 85 L135 115 L105 110 Z" fill="#f59e0b" stroke="#d97706" /> <!-- Texas -->
                                            <path d="M180 70 L210 75 L205 95 L175 90 Z" fill="#3b82f6" stroke="#2563eb" /> <!-- Georgia -->
                                            <path d="M220 50 L250 45 L260 65 L230 75 Z" fill="#2563eb" stroke="#1d4ed8" /> <!-- NC -->
                                            <path d="M210 100 L230 130 L215 135 L200 110 Z" fill="#0ea5e9" stroke="#0284c7" /> <!-- Florida -->
                                        </svg>
                                    </div>
                                    <div class="location-list">
                                        <div class="row g-2">
                                            <?php 
                                            $locations = [
                                                ['name' => 'California', 'val' => '40%', 'class' => 'bg-warning'],
                                                ['name' => 'Arizona', 'val' => '15%', 'class' => 'bg-primary'],
                                                ['name' => 'Texas', 'val' => '10%', 'class' => 'bg-danger'],
                                                ['name' => 'Georgia', 'val' => '3.5%', 'class' => 'bg-info'],
                                                ['name' => 'North Carolina', 'val' => '2%', 'class' => 'bg-primary'],
                                                ['name' => 'Florida', 'val' => '1.5%', 'class' => 'bg-info']
                                            ];
                                            foreach($locations as $loc):
                                            ?>
                                            <div class="col-6 mb-3">
                                                <div class="d-flex justify-content-between small mb-1">
                                                    <span><?php echo $loc['name']; ?></span>
                                                    <span class="fw-bold"><?php echo $loc['val']; ?></span>
                                                </div>
                                                <div style="height: 6px; background:#f1f5f9; border-radius:3px;">
                                                    <div class="<?php echo $loc['class']; ?>" style="width: <?php echo $loc['val']; ?>; height:100%; border-radius:3px; opacity:0.8;"></div>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

       <!-- Boostrap Cdn -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <script src="../assets/javascript/admin.js"></script>


 
</body>
</html>