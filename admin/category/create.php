<?php

if(session_status() === PHP_SESSION_NONE){
     session_start();
}

     require_once __DIR__. '/../../includes/db.php';

     require_once __DIR__. '/../auth_check.php';

    $error = "";
    
    if(isset($_POST['create'])){
       $name = $_POST['name'];

       if($name == ""){
            $error = "Enter Category Required!";
       }
       else{
            $insert = $conn->prepare("INSERT INTO categories (name) VALUES (?)");
            $insert->execute([$name]);

            header("Location: create.php");
       }
       
    }

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
            .category_ipi{
               background-color: #A07936;
            }
            .category_ipi i,
            .category_ip a{
               color:white !important;
            }
            
    </style>
   

</head>
<body>

      <div class="sidebar-content">
            <?php require_once __DIR__. '/../includes/sidebar.php'; ?>
            <div class="content">
                   <?php require_once __DIR__. '/../includes/header.php'; ?>
                   <div class="add-category">
                          <div class="category">
                                <div class="title">
                                      <p>Add Category</p>
                                </div>
                                <div class="hr">
                                      <hr>
                                </div>
                                <div class="input">
                                      <form method="POST">
                                             <p>Category Name</p>
                                             <input type="text" placeholder="Enter Name" name="name">
                                             <span><?php echo $error; ?></span>
                                             <div class="buttons">
                                                    <button type="submit" name="create">Add Category</button>
                                                    <button onclick="cancel()">Cancel</button>
                                             </div>
                                      </form>
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