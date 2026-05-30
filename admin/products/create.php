

<?php

session_start();

require_once __DIR__. '/../../includes/db.php';

require_once __DIR__. '/../auth_check.php';

    $category = $conn->prepare("SELECT * FROM categories");
    $category->execute();
    $data = $category->fetchAll(PDO::FETCH_ASSOC);

    

   
   
    if($_SERVER['REQUEST_METHOD'] == "POST"){
      
           if(isset($_POST['submit'])){
            $product_name = $_POST['product-name'];
            $category_id = $_POST['category-id'];
            $description = $_POST['description'];
            $type = $_POST['type'] ?? ''; 
            $new_price = $_POST['new-price'];
            $old_price = $_POST['old-price'];
            $image_name = $_FILES['main-image']['name'];
            $image_tmp = $_FILES['main-image']['tmp_name'];

             $error = [];

            if(empty($product_name)){
                  $error['product-name'] = "Product Name Required";
            }
            if(empty($category_id)){
                  $error['category-id'] = "Category Required";
            }
            if(empty($description)){
                  $error['description'] = "Description Required";
            }
            if(empty($type)){
                  $error['type'] = "Product Type Reuqired";
            }
            if(empty($new_price) || !is_numeric($new_price) || $new_price <= 0){
                  $error['new-price'] = "Enter valid new price ";
            }
            if (empty($old_price) || !is_numeric($old_price) || $old_price < 0){
                  $error['old-price'] = "Enter valid old price";
            }
            if(empty($image_name)){
                  $error['image'] = "Main image Required";
                 
            }

            else{
                  if(empty($error)){
                        $ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
                        $newName = uniqid("img_", true). "." .$ext;
                        $folder = "../../assets/images/" . $newName;

                        if(!move_uploaded_file($image_tmp,$folder)){
                              $error['image'] = "Failed to upload image";
                        }
                        else{
                              $stmt = $conn->prepare(
                                    "INSERT INTO products 
                                    (name, category_id, description, main_image, old_price, new_price,type) VALUES
                                    (?, ?, ?, ?, ?, ?, ?)");
                              $stmt->execute([$product_name, $category_id, $description, $newName, $old_price, $new_price, $type]);
                              header("Location: create.php");
                        }

                  }
            }


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
            .products-ipi{
                  background-color: #A07936;
            }
            .products-ipi i,
            .products-ip a{
                  color:white !important;
            }
     </style>

</head>
<body>

      <div class="sidebar-content">
            <?php require_once __DIR__. '/../includes/sidebar.php'; ?>
            <div class="content">
                   <?php require_once __DIR__. '/../includes/header.php'; ?>
                   <form method="POST" enctype="multipart/form-data">
                          <div class="add-product">
                                <div class="product-images">
                                <div class="images-title">
                                      <p>Add Product Main image</p>
                                      <p>Add Product Slider images</p>
                                </div>
                                <div class="hr">
                                      <hr>
                                </div>
                                <div class="images-file">
                                      <input type="file" id="main-image" name="main-image" hidden>
                                      <label for="main-image" class="file-upload">
                                                      <i class="ri-upload-cloud-2-line"></i>
                                                      <div class="text">
                                                            <h4>Drop your images here, or <span>click to browse</span></h4>
                                                            <p>1600 x 1200 (4:3) recommended. PNG, JPG and GIF files are allowed</p>
                                                      </div>
                                                      <p style="color:red;"><?php echo $error['image'] ?? ''?></p>
                                      </label>
                                      
                                       
                                      <input type="file" id="slider-image" name="slider-image" hidden>
                                      <label for="slider-image" class="file-upload">
                                                      <i class="ri-upload-cloud-2-line"></i>
                                                      <div class="text">
                                                            <h4>Drop your images here, or <span>click to browse</span></h4>
                                                            <p>1600 x 1200 (4:3) recommended. PNG, JPG and GIF files are allowed</p>
                                                      </div>
                                      </label>
                                </div>
                                </div>
                                <div class="product-details">
                              <div class="title">
                                     <p>Product information</p>
                               </div>
                               <div class="hr">
                                     <hr>
                               </div>
                               <div class="product-inputs">
                                      <div class="title-category">
                                                   <div class="title">
                                                         <p>Product Name</p>
                                                         <input type="text" placeholder="Items Name" name="product-name">
                                                         <p style="color:red;"><?php echo $error['product-name'] ?? ''?></p>
                                                   </div>
                                                   <div class="title">
                                                         <p>Product Category</p>
                                                         <select name="category-id">
                                                                  <option value="">Select Category</option>

                                                                  <?php foreach($data as $category_id){ ?>
                                                                         <option value="<?php echo $category_id['c_id'] ?>"><?php echo $category_id['name'] ?></option>
                                                                  <?php }?>
                                                                  
                                                         </select>
                                                         <p style="color:red;"><?php echo $error['category-id'] ?? ''?></p>
                                                   </div>
                                      </div>
                                      <div class="description">
                                                   <p>Description</p>
                                                   <textarea placeholder="Short description about the product" name="description"></textarea>
                                                   <p style="color:red;"><?php echo $error['description'] ?? ''?></p>
                                      </div>
                                      <div class="type-size">
                                                   <div class="type">
                                                         <p>Product Type</p>
                                                               <div class="radios">
                                                               <input type="radio" id="featured" name="type" value="featured" hidden>
                                                               <label for="featured">Featured</label>

                                                               <input type="radio" id="popular" name="type" value="popular" hidden>
                                                               <label for="popular">Popular</label>
                                                         </div>
                                                         <p style="color:red;"><?php echo $error['type'] ?? ''?></p>
                                                   </div>
                                      </div>
                               </div>
                                </div>
                                <div class="product-price">
                               <div class="title">
                                     <p>Pricing Details</p>
                               </div>
                               <div class="hr">
                                     <hr>
                               </div>
                               <div class="new-old">
                                      <div class="new">
                                           <p>Current price</p>
                                           <div class="icon-input">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="currentColor" d="M8 15.5H6c0 2.59 2.43 4.12 5 4.44V22h2v-2.07c2.25-.3 5-1.59 5-4.43s-2.75-4.13-5-4.43V6.1c1.33.24 3 .94 3 2.4h2c0-2.84-2.75-4.13-5-4.43V2h-2v2.07c-2.25.3-5 1.59-5 4.43s2.67 4.11 5 4.43v4.97c-1.45-.25-3-1.02-3-2.4m8 0c0 1.46-1.67 2.16-3 2.4v-4.8c1.33.24 3 .94 3 2.4m-8-7c0-1.46 1.67-2.16 3-2.4v4.8c-1.37-.25-3-1-3-2.4"/></svg>
                                                 <input type="number" placeholder="Price" name="new-price">
                                           </div>
                                            <p style="color:red;"><?php echo $error['new-price'] ?? ''?></p>
                                      </div>
                                      <div class="new">
                                           <p style="text-decoration:line-through;">Old price</p>
                                           <div class="icon-input">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="currentColor" d="M8 15.5H6c0 2.59 2.43 4.12 5 4.44V22h2v-2.07c2.25-.3 5-1.59 5-4.43s-2.75-4.13-5-4.43V6.1c1.33.24 3 .94 3 2.4h2c0-2.84-2.75-4.13-5-4.43V2h-2v2.07c-2.25.3-5 1.59-5 4.43s2.67 4.11 5 4.43v4.97c-1.45-.25-3-1.02-3-2.4m8 0c0 1.46-1.67 2.16-3 2.4v-4.8c1.33.24 3 .94 3 2.4m-8-7c0-1.46 1.67-2.16 3-2.4v4.8c-1.37-.25-3-1-3-2.4"/></svg>
                                                 <input type="number" placeholder="Price" name="old-price">
                                           </div>
                                            <p style="color:red;"><?php echo $error['old-price'] ?? ''?></p>
                                      </div>
                               </div>
                                </div>
                                <div class="buttons">
                                        <button type="submit" name="submit">Create product</button>
                                        <button type="button" onclick="cancel()">Cancel</button>
                                </div>
                          </div>
                   </form>
            </div>
      </div>

       <!-- Boostrap Cdn -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  <script src="../../assets/javascript/admin.js"></script>
  
</body>
</html>