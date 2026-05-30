<?php

session_start();
require_once __DIR__. '/../../includes/db.php';

require_once __DIR__. '/../auth_check.php';

$error = "";
$success = "";
$category = null;

if(isset($_GET['id'])){
    $c_id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM categories WHERE c_id = ?");
    $stmt->execute([$c_id]);
    $category = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!$category){
        header("Location: index.php");
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}

if(isset($_POST['update'])){
    $name = trim($_POST['name']);

    if($name == ""){
        $error = "Category Name is Required!";
    } else {
        $update = $conn->prepare("UPDATE categories SET name = ? WHERE c_id = ?");
        $update->execute([$name, $c_id]);
        
        $_SESSION['success_msg'] = "Category updated successfully!";
        header("Location: index.php");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>

    <!-- Remix icon Cdn  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.css" />
     
    <!-- Font Awesome Cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />

    <!-- Bootstrap Cdn Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../../assets/css/admin.css">

    <style>
        .category_ipi{ background-color: #A07936; }
        .category_ipi i, .category_ip a{ color:white !important; }
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
                    <p>Edit Category</p>
                </div>
                <div class="hr">
                    <hr>
                </div>
                <div class="input">
                    <form method="POST">
                        <p>Category Name</p>
                        <input type="text" placeholder="Enter Name" name="name" value="<?php echo htmlspecialchars($category['name']); ?>">
                        <?php if($error): ?><span class="text-danger mt-1 d-block"><?php echo $error; ?></span><?php endif; ?>
                        
                        <div class="buttons mt-4">
                            <button type="submit" name="update">Update Category</button>
                            <a href="index.php" class="btn btn-secondary ms-2 text-dark" style="background:#f1f1f1; border:none; padding:10px 20px;">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/javascript/admin.js"></script>

</body>
</html>
