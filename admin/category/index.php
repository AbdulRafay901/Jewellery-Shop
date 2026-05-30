<?php

session_start();
require_once __DIR__. '/../../includes/db.php';

require_once __DIR__. '/../auth_check.php';

// Handle Delete Request
if(isset($_POST['delete_id'])){
    $delete_id = $_POST['delete_id'];
    $stmt = $conn->prepare("DELETE FROM categories WHERE c_id = ?");
    $stmt->execute([$delete_id]);
    $_SESSION['success_msg'] = "Category deleted successfully!";
    header("Location: index.php");
    exit;
}

// Fetch Categories
$stmt = $conn->prepare("SELECT * FROM categories ORDER BY c_id DESC");
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories List</title>

    <!-- Remix icon Cdn  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.css" />
     
    <!-- Font Awesome Cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />

    <!-- Bootstrap Cdn Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <link rel="stylesheet" href="../../assets/css/admin.css">

    <style>
        .category_ipi { background-color: #A07936; }
        .category_ipi i, .category_ip a { color: white !important; }
        .list-container { padding: 30px; background: #fff; margin: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.05); }
        .table th { background-color: #f8f9fa; }
        .action-btns a, .action-btns button { margin-right: 10px; border: none; background: none; }
        .action-btns .edit { color: #0d6efd; }
        .action-btns .delete { color: #dc3545; }
    </style>
</head>
<body>

<div class="sidebar-content">
    <?php require_once __DIR__. '/../includes/sidebar.php'; ?>
    <div class="content">
        <?php require_once __DIR__. '/../includes/header.php'; ?>
        
        <div class="order">
            <div class="order-list">
                <div class="d-flex justify-content-between align-items-center" style="padding: 0 20px; margin-bottom: 25px;">
                    <div class="text" style="margin: 0; padding: 0;">
                        <p>All Categories List</p>
                    </div>
                    <a href="create.php" class="btn btn-primary" style="background-color: #A07936; border-color: #A07936;">Add New Category</a>
                </div>

                <?php if(isset($_SESSION['success_msg'])): ?>
                    <div class="alert alert-success mx-4"><?php echo $_SESSION['success_msg']; unset($_SESSION['success_msg']); ?></div>
                <?php endif; ?>

                <div class="list">
                    <div class="columns">
                        <p style="width: 150px;">ID</p>
                        <p style="width: 300px;">Category Name</p>
                        <p>Action</p>
                    </div>
                    
                    <?php if(count($categories) > 0): ?>
                        <?php foreach($categories as $category): ?>
                        <div class="columns">
                            <p style="width: 150px;"><?php echo $category['c_id']; ?></p>
                            <p style="width: 300px;"><?php echo htmlspecialchars($category['name']); ?></p>
                            
                            <div class="d-flex align-items-center gap-3">
                                <a href="edit.php?id=<?php echo $category['c_id']; ?>" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" width="20" height="20" style="color: #A07936;"><path fill="currentColor" d="M227.32 73.37L182.63 28.69a16 16 0 0 0-22.63 0L36.69 152a15.86 15.86 0 0 0-4.25 8.15l-12 55.77A16 16 0 0 0 36.14 236l55.77-12a15.86 15.86 0 0 0 8.15-4.25L223.37 96a16 16 0 0 0 3.95-22.63M84.53 207l-46.72 10l10-46.72l96-96l36.69 36.69zM196.69 76.69L160 40l11.31-11.31l36.69 36.69z"/></svg>
                                </a>
                                <form method="POST" class="d-inline m-0 p-0" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                    <input type="hidden" name="delete_id" value="<?php echo $category['c_id']; ?>">
                                    <button type="submit" style="background: none; border: none; padding: 0;" title="Delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" width="20" height="20" style="color: #FE0400;"><path fill="currentColor" d="M216 48h-40v-8a24 24 0 0 0-24-24h-48a24 24 0 0 0-24 24v8H40a8 8 0 0 0 0 16h8v144a16 16 0 0 0 16 16h128a16 16 0 0 0 16-16V64h8a8 8 0 0 0 0-16M96 40a8 8 0 0 1 8-8h48a8 8 0 0 1 8 8v8H96Zm96 168H64V64h128Zm-80-104v64a8 8 0 0 1-16 0v-64a8 8 0 0 1 16 0m48 0v64a8 8 0 0 1-16 0v-64a8 8 0 0 1 16 0"/></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="columns justify-content-center">
                            <p style="width: auto;">No categories found.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/javascript/admin.js"></script>

</body>
</html>
