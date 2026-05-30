<?php

if(session_status() === PHP_SESSION_NONE){
     session_start();
}


require_once __DIR__. '/../../includes/db.php';

require_once __DIR__.  '/../auth_check.php'; 


$stmt = $conn->prepare("SELECT * FROM orders ORDER BY id DESC");
$stmt->execute();

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$status = $conn->prepare("SELECT 
SUM(status = ?) as pending,
SUM(status = ?) as shipped,
SUM(status = ?) as complete
FROM orders 
");

$status->execute(["pending", "shipped", "complete"]);

$row = $status->fetch(PDO::FETCH_ASSOC);



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

    <link rel="stylesheet" href="../../assets/css/admin.css">
    <style>
            .order-ipi{
                  background-color: #A07936;
            }
            .order-ipi i,
            .order-ip a{
                  color:white !important;
            }
    </style>
   

</head>
<body>

      <div class="sidebar-content">
            <?php require_once __DIR__. '/../includes/sidebar.php'; ?>
            <div class="content">
                   <?php require_once __DIR__. '/../includes/header.php'; ?>
                        <div class="order">
                              <div class="order-carts">
                                    <div class="container-fluid p-0">
                                          <div class="row gy-4">
                                                <div class="col-lg-3">
                                                      <div class="order-carts-1">
                                                            <div class="text">
                                                                  <p>Order Shipped</p>
                                                                  <p>
                                                                     <?php echo $row['shipped']?>
                                                                  </p>
                                                            </div>
                                                            <div class="icon">
                                                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M12 1.25c-.605 0-1.162.15-1.771.402c-.589.244-1.273.603-2.124 1.05L6.037 3.787c-1.045.548-1.88.987-2.527 1.418c-.668.447-1.184.917-1.559 1.554c-.374.635-.542 1.323-.623 2.142c-.078.795-.078 1.772-.078 3.002v.194c0 1.23 0 2.207.078 3.002c.081.82.25 1.507.623 2.142c.375.637.89 1.107 1.56 1.554c.645.431 1.481.87 2.526 1.418l2.068 1.085c.851.447 1.535.806 2.124 1.05c.61.252 1.166.402 1.771.402s1.162-.15 1.771-.402c.589-.244 1.273-.603 2.124-1.05l2.068-1.084c1.045-.549 1.88-.988 2.526-1.419c.67-.447 1.185-.917 1.56-1.554c.374-.635.542-1.323.623-2.142c.078-.795.078-1.772.078-3.001v-.196c0-1.229 0-2.206-.078-3.001c-.081-.82-.25-1.507-.623-2.142c-.375-.637-.89-1.107-1.56-1.554c-.645-.431-1.481-.87-2.526-1.418l-2.068-1.085c-.851-.447-1.535-.806-2.124-1.05c-.61-.252-1.166-.402-1.771-.402M8.77 4.046c.89-.467 1.514-.793 2.032-1.007c.504-.209.859-.289 1.198-.289c.34 0 .694.08 1.198.289c.518.214 1.141.54 2.031 1.007l2 1.05c1.09.571 1.855.974 2.428 1.356c.282.189.503.364.683.54l-3.331 1.665l-8.5-4.474zm-1.825.958l-.174.092c-1.09.571-1.855.974-2.427 1.356a4.7 4.7 0 0 0-.683.54L12 11.162l3.357-1.68l-8.206-4.318a.8.8 0 0 1-.206-.16M2.938 8.307c-.05.214-.089.457-.117.74c-.07.714-.071 1.617-.071 2.894v.117c0 1.278 0 2.181.071 2.894c.069.697.2 1.148.423 1.528c.222.377.543.696 1.1 1.068c.572.382 1.337.785 2.427 1.356l2 1.05c.89.467 1.513.793 2.031 1.007q.244.101.448.165v-8.663zm9.812 12.818q.204-.063.448-.164c.518-.214 1.141-.54 2.031-1.007l2-1.05c1.09-.572 1.855-.974 2.428-1.356c.556-.372.877-.691 1.1-1.068c.223-.38.353-.83.422-1.528c.07-.713.071-1.616.071-2.893v-.117c0-1.278 0-2.181-.071-2.894a6 6 0 0 0-.117-.74L17.75 9.963V13a.75.75 0 0 1-1.5 0v-2.286l-3.5 1.75z" clip-rule="evenodd"/></svg>
                                                            </div>
                                                      </div>
                                                </div>
                                                <div class="col-lg-3">
                                                      <div class="order-carts-1">
                                                            <div class="text">
                                                                  <p>Order Delivering</p>
                                                                  <p>2</p>
                                                            </div>
                                                            <div class="icon">
                                                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5" d="M4 12h16M8 15.5a.5.5 0 1 1-1 0a.5.5 0 0 1 1 0m9 0a.5.5 0 1 1-1 0a.5.5 0 0 1 1 0M6.4 2h11.2A2.4 2.4 0 0 1 20 4.4v16a1.6 1.6 0 0 1-1.6 1.6h-.8a1.6 1.6 0 0 1-1.6-1.6V19H8v1.4A1.6 1.6 0 0 1 6.4 22h-.8A1.6 1.6 0 0 1 4 20.4v-16A2.4 2.4 0 0 1 6.4 2"/></svg>
                                                            </div>
                                                      </div>
                                                </div>
                                                <div class="col-lg-3">
                                                      <div class="order-carts-1">
                                                            <div class="text">
                                                                  <p>Delivered</p>
                                                                  <p>
                                                                       <?php echo $row['complete']?>
                                                                  </p>
                                                            </div>
                                                            <div class="icon">
                                                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="1.5"><path d="M16.755 2h-9.51c-1.159 0-1.738 0-2.206.163a3.05 3.05 0 0 0-1.881 1.936C3 4.581 3 5.177 3 6.37v14.004c0 .858.985 1.314 1.608.744a.946.946 0 0 1 1.284 0l.483.442a1.657 1.657 0 0 0 2.25 0a1.657 1.657 0 0 1 2.25 0a1.657 1.657 0 0 0 2.25 0a1.657 1.657 0 0 1 2.25 0a1.657 1.657 0 0 0 2.25 0l.483-.442a.946.946 0 0 1 1.284 0c.623.57 1.608.114 1.608-.744V6.37c0-1.193 0-1.79-.158-2.27a3.05 3.05 0 0 0-1.881-1.937C18.493 2 17.914 2 16.755 2Z" opacity="0.5"/><path stroke-linecap="round" stroke-linejoin="round" d="m9.5 10.4l1.429 1.6L14.5 8"/><path stroke-linecap="round" d="M7.5 15.5h9"/></g></svg>
                                                            </div>
                                                      </div>
                                                </div>
                                                <div class="col-lg-3">
                                                      <div class="order-carts-1">
                                                            <div class="text">
                                                                  <p>In Pending</p>
                                                                  <p><?php echo $row['pending']?></p>
                                                            </div>
                                                            <div class="icon">
                                                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20.777a9 9 0 0 1-2.48-.969M14 3.223a9.003 9.003 0 0 1 0 17.554m-9.421-3.684a9 9 0 0 1-1.227-2.592M3.124 10.5c.16-.95.468-1.85.9-2.675l.169-.305m2.714-2.941A9 9 0 0 1 10 3.223"/></svg>
                                                            </div>
                                                      </div>
                                                </div>
                                          </div>
                                    </div>
                              </div>
                              <div class="order-list">
                                    <div class="text">
                                          <p>All Order List</p>
                                    </div>
                                    <div class="list">
                                          <div class="columns">
                                                <p>Order ID</p>
                                                <p>Create at</p>
                                                <p>Customer</p>
                                                <p>Total</p>
                                                <p>Order Status</p>
                                                <p>Action</p>
                                          </div>
                                          <?php foreach($data as $orders){ ?>
                                          <div class="columns">
                                                <p><?php echo $orders['order_number']; ?></p>
                                                <p><?php echo $orders['create_at'] ?></p>
                                                <p><?php echo $orders['first_name'] ?></p>
                                                <p>$<?php echo $orders['total_amount'] ?></p>
                                                <div id="status"><p id="text"><?php echo $orders['status'] ?></p></div>
                                                
                                                <div>
                                                    <form method="POST" action="update_status.php"> 
                                                           <a href="order_items.php?id=<?php echo $orders['id']; ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"><path fill="currentColor" d="M245.48 125.57c-.34-.78-8.66-19.23-27.24-37.81C201 70.54 171.38 50 128 50S55 70.54 37.76 87.76c-18.58 18.58-26.9 37-27.24 37.81a6 6 0 0 0 0 4.88c.34.77 8.66 19.22 27.24 37.8C55 185.47 84.62 206 128 206s73-20.53 90.24-37.75c18.58-18.58 26.9-37 27.24-37.8a6 6 0 0 0 0-4.88M128 194c-31.38 0-58.78-11.42-81.45-33.93A134.8 134.8 0 0 1 22.69 128a134.6 134.6 0 0 1 23.86-32.06C69.22 73.42 96.62 62 128 62s58.78 11.42 81.45 33.94A134.6 134.6 0 0 1 233.31 128C226.94 140.21 195 194 128 194m0-112a46 46 0 1 0 46 46a46.06 46.06 0 0 0-46-46m0 80a34 34 0 1 1 34-34a34 34 0 0 1-34 34"/></svg></a>
                                                           <input type="hidden" name="id" value="<?php echo $orders['id'] ?>">
                                                           <select  id="status-dropdown" name="status" onchange="this.form.submit()">
                                                                   <option value="">Status</option>
                                                                   <option value="pending">Pending</option>
                                                                   <option value="shipped">Shipped</option>
                                                                   <option value="complete">Complete</option>
                                                           </select>
                                                    </form>
                                                </div>
                                          </div>
                                         <?php }  ?>
                                    </div>
                              </div>
                        </div>
            </div>
      </div>

       <!-- Boostrap Cdn -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  <script src="../../assets/javascript/admin.js"></script>
  
</body>
</html>