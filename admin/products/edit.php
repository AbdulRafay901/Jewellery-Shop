<?php

session_start();
require_once __DIR__. '/../../includes/db.php';

require_once __DIR__. '/../auth_check.php';

$error = [];
$product = null;

if(isset($_GET['id'])){
    $p_id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$p_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!$product){
        header("Location: index.php");
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}

// Fetch categories for dropdown
$catStmt = $conn->prepare("SELECT * FROM categories");
$catStmt->execute();
$categories = $catStmt->fetchAll(PDO::FETCH_ASSOC);

if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['update'])){
        $product_name = $_POST['product-name'];
        $category_id = $_POST['category-id'];
        $description = $_POST['description'];
        $type = $_POST['type'] ?? ''; 
        $new_price = $_POST['new-price'];
        $old_price = $_POST['old-price'];

        if(empty($product_name)) $error['product-name'] = "Product Name Required";
        if(empty($category_id)) $error['category-id'] = "Category Required";
        if(empty($description)) $error['description'] = "Description Required";
        if(empty($type)) $error['type'] = "Product Type Required";
        if(empty($new_price) || !is_numeric($new_price) || $new_price <= 0) $error['new-price'] = "Enter valid new price";
        if(empty($old_price) || !is_numeric($old_price) || $old_price < 0) $error['old-price'] = "Enter valid old price";

        if(empty($error)){
            $updateImageQuery = "";
            $params = [$product_name, $category_id, $description, $type, $old_price, $new_price];

            // Image Update Logic
            if(isset($_FILES['main-image']) && !empty($_FILES['main-image']['name'])) {
                $image_name = $_FILES['main-image']['name'];
                $image_tmp = $_FILES['main-image']['tmp_name'];
                $ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
                $newName = uniqid("img_", true). "." .$ext;
                $folder = "../../assets/images/" . $newName;

                if(move_uploaded_file($image_tmp, $folder)){
                    // Delete old image
                    if(!empty($product['main_image']) && file_exists("../../assets/images/" . $product['main_image'])){
                        unlink("../../assets/images/" . $product['main_image']);
                    }
                    $updateImageQuery = ", main_image = ?";
                    $params[] = $newName;
                } else {
                    $error['image'] = "Failed to upload image";
                }
            }

            if(empty($error)){
                $params[] = $p_id; 
                $sql = "UPDATE products SET name=?, category_id=?, description=?, type=?, old_price=?, new_price=? $updateImageQuery WHERE id=?";
                $stmt = $conn->prepare($sql);
                $stmt->execute($params);
                
                $_SESSION['success_msg'] = "Product Updated Successfully";
                header("Location: index.php");
                exit;
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
    <title>Edit Product</title>

    <!-- Remix icon Cdn  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.css" />
     
    <!-- Font Awesome Cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />

    <!-- Bootstrap Cdn Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <link rel="stylesheet" href="../../assets/css/admin.css">
    <style>
        .products-ipi { background-color: #A07936; }
        .products-ipi i, .products-ip a { color: white !important; }
        .edit-img-preview { width: 150px; height: 150px; object-fit: cover; border-radius: 8px; margin-top: 10px; border: 1px solid #ddd; padding: 5px; }
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
                        <p>Change Product Main image (Leave empty to keep current)</p>
                    </div>
                    <div class="hr"><hr></div>
                    <div class="images-file">
                        <input type="file" id="main-image" name="main-image" hidden>
                        <label for="main-image" class="file-upload">
                            <i class="ri-upload-cloud-2-line"></i>
                            <div class="text">
                                <h4>Drop your image here, or <span>click to browse</span></h4>
                                <p>1600 x 1200 (4:3) recommended. PNG, JPG and GIF files are allowed</p>
                            </div>
                            <p style="color:red;"><?php echo $error['image'] ?? ''?></p>
                        </label>
                        <?php if(!empty($product['main_image']) && file_exists("../../assets/images/".$product['main_image'])): ?>
                            <div class="mt-3">
                                <p class="mb-1 text-muted">Current Image:</p>
                                <img src="../../assets/images/<?php echo $product['main_image']; ?>" class="edit-img-preview" alt="Current Image">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="product-details">
                    <div class="title"><p>Edit Product information</p></div>
                    <div class="hr"><hr></div>
                    <div class="product-inputs">
                        <div class="title-category">
                            <div class="title">
                                <p>Product Name</p>
                                <input type="text" placeholder="Items Name" name="product-name" value="<?php echo htmlspecialchars($product['name']); ?>">
                                <p style="color:red;"><?php echo $error['product-name'] ?? ''?></p>
                            </div>
                            <div class="title">
                                <p>Product Category</p>
                                <select name="category-id">
                                    <option value="">Select Category</option>
                                    <?php foreach($categories as $cat): ?>
                                        <option value="<?php echo $cat['c_id']; ?>" <?php echo ($cat['c_id'] == $product['category_id']) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($cat['name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <p style="color:red;"><?php echo $error['category-id'] ?? ''?></p>
                            </div>
                        </div>
                        <div class="description">
                            <p>Description</p>
                            <textarea placeholder="Short description about the product" name="description"><?php echo htmlspecialchars($product['description']); ?></textarea>
                            <p style="color:red;"><?php echo $error['description'] ?? ''?></p>
                        </div>
                        <div class="type-size">
                            <div class="type">
                                <p>Product Type</p>
                                <div class="radios">
                                    <input type="radio" id="featured" name="type" value="featured" <?php echo ($product['type'] == 'featured') ? 'checked' : ''; ?> hidden>
                                    <label for="featured">Featured</label>

                                    <input type="radio" id="popular" name="type" value="popular" <?php echo ($product['type'] == 'popular') ? 'checked' : ''; ?> hidden>
                                    <label for="popular">Popular</label>
                                </div>
                                <p style="color:red;"><?php echo $error['type'] ?? ''?></p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="product-price">
                    <div class="title"><p>Pricing Details</p></div>
                    <div class="hr"><hr></div>
                    <div class="new-old">
                        <div class="new">
                            <p>Current price</p>
                            <div class="icon-input">
                                <span class="px-2 border-end">$</span>
                                <input type="number" placeholder="Price" name="new-price" value="<?php echo htmlspecialchars($product['new_price']); ?>">
                            </div>
                            <p style="color:red;"><?php echo $error['new-price'] ?? ''?></p>
                        </div>
                        <div class="new">
                            <p style="text-decoration:line-through;">Old price</p>
                            <div class="icon-input">
                                <span class="px-2 border-end">$</span>
                                <input type="number" placeholder="Price" name="old-price" value="<?php echo htmlspecialchars($product['old_price']); ?>">
                            </div>
                            <p style="color:red;"><?php echo $error['old-price'] ?? ''?></p>
                        </div>
                    </div>
                </div>
                
                <div class="buttons">
                    <button type="submit" name="update">Update product</button>
                    <a href="index.php" class="btn btn-secondary text-dark" style="background:#f1f1f1; border:none; padding:10px 20px;">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/javascript/admin.js"></script>

</body>
</html>
